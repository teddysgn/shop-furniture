<?php
    include "PHPMailer-master/src/PHPMailer.php";
    include "PHPMailer-master/src/Exception.php";
    include "PHPMailer-master/src/POP3.php";
    include "PHPMailer-master/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail           = new PHPMailer(true);
    if(isset($this->reset)){
        $email          = Session::get('emailReset');
        $fullname       = Session::get('nameReset');
    } else {
        $infoAccount    = $this->infoAccount;
        $email          = $infoAccount['email'];
        $fullname       = $infoAccount['fullname'];
    }

    $password       = Session::get('password');
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

//        $mail->addReplyTo('info@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        //Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Nội dung mail
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Activate Account';
        $mail->Body    = 'This is your password account. Use it to login!';
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//        // Gửi mail với các thẻ của HTML

        $body = "This is your password account. Use it to login! <b>$password</b>";
        $mail->msgHTML($body);

        $mail->send();
        if(isset($this->reset)){
            $message = "Your Account is Activated";
            $notification = "If you don't get any Code, make sure you registered by an correct Email!";
        }

        else
            $message = "You register a new account successfully!";

        $link    = "Please check your <a href='https://mail.google.com'>Email</a> to see the Passcode and return <a href='index.php?module=default&controller=index&action=login'>this page</a> to login";

    } catch (Exception $e) {
        echo '<div class="container">
                <div class="alert alert-danger">Message could not be sent.</div>',
            '<div class="alert alert-danger">Mailer Error: '.$mail->ErrorInfo.'</div> '
            .'</div>';
    }

    if(!isset($this->reset))
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
