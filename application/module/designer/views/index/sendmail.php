<?php

include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$model 	= new Model();

$queryAdminProduct	    = "SELECT `id`, `fullname`, `email` FROM `".TBL_USER."` WHERE `status`  = 1 AND (`group_id` = 3 OR `group_id` = 1)";
$listAdminProduct	    = $model->fetchAll($queryAdminProduct);
$adminProduct		    = '';

$address = array();
if(!empty($listAdminProduct)){
    foreach($listAdminProduct as $key => $value){
        $address[$value['id']]['name'] = $value['fullname'];
        $address[$value['id']]['email'] = $value['email'];
    }
}

$mail           = new PHPMailer(true);
if(($this->arrParams['form']['token'] + 15 > time())){
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

        // Thiết lập UTF-8
        $mail->CharSet = 'utf-8';

        // Nội dung mail
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Request From Designer';
        $mail->Body    = '';
        $body = "
                You have received a request form " . $_SESSION['user']['info']['fullname'] . " Designer<br>
                Comeback Administrator to Approve this!
            ";
        // Thiết lập người nhận
        foreach ($address as $key => $value){
            $mail->addAddress($value['email'], $value['name']);
        }
        $mail->msgHTML($body);
        $mail->send();



        echo '</br></br></br></br> 
                <div id="main" class="wrapper">
                <div class="page-container  no-sidebar">
                    <div id="main-content">
                        <div id="primary" class="site-content">
                            <article id="post-1023" class="post-1023 page type-page status-publish hentry">
                                <div data-elementor-type="wp-page" data-elementor-id="1023" class="elementor elementor-1023">
                                    
                                    <div class="elementor-element elementor-element-08b4d72 e-flex e-con-boxed e-con e-parent"
                                         data-id="08b4d72" data-element_type="container"
                                         data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}"
                                         data-core-v316-plus="true">
                                        <div class="e-con-inner">
                                            <div class="elementor-element elementor-element-bec7157 e-flex e-con-boxed e-con e-child"
                                                 data-id="bec7157" data-element_type="container"
                                                 data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                 data-e-bg-lazyload="">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-d34045f elementor-widget-mobile__width-inherit elementor-widget elementor-widget-text-editor"
                                                         data-id="d34045f" data-element_type="widget"
                                                         data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <h2 style="font-weight: normal; margin-bottom: 0;">You Submitted this Request</h2>
                                                            <p>Click <a href="index.php?module=designer&controller=index&action=add">Here</a> to Add more</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                </div>';

    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
} else {
    echo '</br></br></br></br> 
                <div id="main" class="wrapper">
                <div class="page-container  no-sidebar">
                    <div id="main-content">
                        <div id="primary" class="site-content">
                            <article id="post-1023" class="post-1023 page type-page status-publish hentry">
                                <div data-elementor-type="wp-page" data-elementor-id="1023" class="elementor elementor-1023">
                                    
                                    <div class="elementor-element elementor-element-08b4d72 e-flex e-con-boxed e-con e-parent"
                                         data-id="08b4d72" data-element_type="container"
                                         data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}"
                                         data-core-v316-plus="true">
                                        <div class="e-con-inner">
                                            <div class="elementor-element elementor-element-bec7157 e-flex e-con-boxed e-con e-child"
                                                 data-id="bec7157" data-element_type="container"
                                                 data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                 data-e-bg-lazyload="">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-d34045f elementor-widget-mobile__width-inherit elementor-widget elementor-widget-text-editor"
                                                         data-id="d34045f" data-element_type="widget"
                                                         data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <h2 style="font-weight: normal; margin-bottom: 0;">You Submitted this Request</h2>
                                                            <p>Click <a href="index.php?module=designer&controller=index&action=add">Here</a> to Add more</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                </div>';
}

?>


