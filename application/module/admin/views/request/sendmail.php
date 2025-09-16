<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    if(!empty($this->infoUser)){
        include "PHPMailer-master/src/PHPMailer.php";
        include "PHPMailer-master/src/Exception.php";
        include "PHPMailer-master/src/POP3.php";
        include "PHPMailer-master/src/SMTP.php";

        $infoAccount    = $this->infoUser;
        $email          = $infoAccount['email'];
        $fullname       = $infoAccount['fullname'];

        if($this->arrParam['type'] == 'deny'){
            $body = "Hi $fullname, </br>
                    We send you a Notification that Your Request -  has been denied. </br> 
                    We are so sorry for that!</br> 
                    Best Regards, 
                    Administrator";
            $message = 'You Denied successfully!';
        } else{
            $body = "Hi $fullname, </br>
                    Your Request - has been approved</br>
                    Best Regards, 
                    Administrator";
            $message = 'You Approved successfully!';
        }

        if(($this->arrParams['form']['token'] + 30 > time())) {
            $mail = new PHPMailer(true);
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
                $mail->addAddress("$email", "$fullname");      // Add a recipient

                // Thiết lập UTF-8
                $mail->CharSet = 'utf-8';

                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = "Request Respond from Administrator's Shop.Furniture";
                $mail->Body = '';

                $nameProduct = ucfirst($this->arrParam['product_name']);
                $mail->msgHTML($body);

                $mail->send();

                echo '<div id="wrapper">
                        <div id="wrapper">
                            <div class="content-wrapper">
                                <div class="container-fluid">
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                         <div class="col-lg-12 text-center">
                                                            <h1>'.$message.'</h1>
                                                            <br>
                                                            <a href="' . URL::createLink('admin', 'request', 'index') . '" class="btn btn-light btn-round px-5 mr-1">Back</a></li>
                                                         </div>         
                                                    </div><!--End Row-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            echo '<div id="wrapper">
                        <div id="wrapper">
                            <div class="content-wrapper">
                                <div class="container-fluid">
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                         <div class="col-lg-12 text-center">
                                                            <h1>'.$message.'</h1>
                                                            <br>
                                                            <a href="' . URL::createLink('admin', 'request', 'index') . '" class="btn btn-light btn-round px-5 mr-1">Back</a></li>
                                                         </div>         
                                                    </div><!--End Row-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    }


?>