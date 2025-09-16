<?php
$link = mysqli_connect('31.220.110.51', 'u580409902_nguyenhoangvu', 'Nguyenhoangvu@123', 'u580409902_shop');
if(!$link) {
    die('Connect failed!'.mysqli_error());
}



function randomString($length = 5){
        $arrCharacter = array_merge(range('a','z'), range(0,9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result		= substr($arrCharacter, 0, $length);
        return $result;
    }

    include "PHPMailer-master/src/PHPMailer.php";
    include "PHPMailer-master/src/Exception.php";
    include "PHPMailer-master/src/POP3.php";
    include "PHPMailer-master/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail           = new PHPMailer(true);

    $email          =  $this->email['email'];
    $name           =  $this->email['fullname'];
    $username       =  $this->email['username'];
    $password       = randomString(7);

    Session::set('password', $password);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'hoangvu.pcx@gmail.com';                 // SMTP username
        $mail->Password = 'dbnihuoqqndpvsey';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        // Thiết lập người gửi
        $mail->setFrom('hoangvu.pcx@gmail.com', 'Administrator');

        // Thiết lập người nhận
        $mail->addAddress("$email", "$fullname");     // Add a recipient

        // Thiết lập UTF-8
        $mail->CharSet = 'utf-8';

        // Nội dung mail
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Activate Account';
        $mail->Body    = 'This is your password account. Use it to login!';

        $body = "Hi $name,</br>
                A password reset was requested for your $email Shop. account.</br>
                Please use it to login and set a new one.</br> <b>$password</b>";
        $mail->msgHTML($body);

        $mail->send();
        if(isset($this->reset)){
            $message = "Your Account is Activated";
            $notification = "If you don't get any Code, make sure you registered by an correct Email!";
        }else
            $message = "You renewed a Passcode";

        $query   = "UPDATE `user` SET `password` = '".md5($password)."' WHERE `email` = '$email' AND `username` = '$username'";
        mysqli_query($link, $query);

        $link    = "Please check your <a href='https://mail.google.com'>Email</a> to see the Passcode and return <a href='user'>this page</a> to login";

    } catch (Exception $e) {
        echo '<div class="container">
                <div class="alert alert-danger">Message could not be sent.</div>',
            '<div class="alert alert-danger">Mailer Error: '.$mail->ErrorInfo.'</div> '
            .'</div>';
    }
    Session::delete('password');
?>
<div id="fh5co-user">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="system-message-container"><?php echo $strMessage . $this->error . $this->errorPassword;?></div>
                <div class="fh5co-tabs animate-box">
                    <ul class="fh5co-tab-nav">
                        <li style="width:100%" class="active"><a href="#" data-tab="1"><span><i class="fa-solid fa-envelope"></i>&nbsp; MESSAGES</span></a></li>
                    </ul>

                    <!-- Tabs -->
                    <div class="fh5co-tab-content-wrap">
                        <div class="fh5co-tab-content tab-content active" data-tab-content="1">
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>

                                <div class="alert-message">
                                    <span><strong>Info! <?php echo $message;?></strong></span>
                                    </br>
                                    <span><?php echo $link;?></span>
                                    </br>
                                    <span><?php echo $notification;?></span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


