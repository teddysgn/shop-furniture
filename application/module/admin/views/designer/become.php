<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($this->arrayParam['type'])){
    if($this->arrayParam['token'] + 10 > time()){

    include "PHPMailer-master/src/PHPMailer.php";
    include "PHPMailer-master/src/Exception.php";
    include "PHPMailer-master/src/POP3.php";
    include "PHPMailer-master/src/SMTP.php";

    $infoAccount    = $this->arrayParam['form'];
    $email          = $infoAccount['user_email'];
    $fullname       = $infoAccount['user_name'];
    $message = '';
    if($this->arrayParam['type'] == 'deny'){
        $body = "Hi $fullname, </br>
                    We send you a Notification that Your Request to Become our Designer has been denied. </br> 
                    We are so sorry for that!</br> 
                    Best Regards, 
                    Administrator";
        $message = 'You Denied successfully!';
    } elseif($this->arrayParam['type'] == 'save'){
        $body = "Hi $fullname, </br>
                    Your Request to Become our Designer has been approved</br>
                    Congratulation to a part of our Shop.
                    Best Regards, 
                    Administrator";
        $message = 'You Approved successfully!';
    }

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

            $mail->msgHTML($body);
            $mail->send();


        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }
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
                                                            <a href="' . URL::createLink('admin', 'designer', 'index') . '" class="btn btn-light btn-round px-5 mr-1">Back</a></li>
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
}else{
// Input
$inputName                  = Helper::cmsInput('text'   , 'form[name]'          , 'name'                , $this->arrayParam['form']['name']                 , 'inputbox form-control', null, 'readonly');
$inputWebsite               = Helper::cmsInput('text'   , 'form[website]'       , 'website'             , $this->arrayParam['form']['website']              , 'inputbox form-control', null, 'readonly');
$inputDesignAbout           = Helper::cmsInput('text'   , 'form[design_about]'  , 'design_about'        , $this->arrayParam['form']['design_about']         , 'inputbox form-control', null, 'readonly');
$inputProfession            = Helper::cmsInput('text'   , 'form[profession]'    , 'profession'          , $this->arrayParam['form']['profession']           , 'inputbox form-control', null, 'readonly');
$inputMessage               = Helper::cmsInput('text'   , 'form[message]'       , 'message'             , $this->arrayParam['form']['message']              , 'inputbox form-control', null, 'readonly');
$inputDate                  = Helper::cmsInput('text'   , 'form[date]'          , 'date'                , $this->arrayParam['form']['date']                 , 'inputbox form-control', null, 'readonly');
$inputToken                 = Helper::cmsInput('hidden' , 'form[token]'         , 'token'               , time());
$inputUserID                = Helper::cmsInput('hidden' , 'form[user_id]'       , 'id'                  , $this->arrayParam['form']['user_id']);
$inputRequestID             = Helper::cmsInput('hidden' , 'form[request_id]'    , 'request_id'          , $this->arrayParam['form']['id']);


// Row
$rowName            = Helper::cmsRowForm('Name'         , $inputName);
$rowWebsite         = Helper::cmsRowForm('Website'      , $inputWebsite);
$rowDesignAbout     = Helper::cmsRowForm('Design About' , $inputDesignAbout);
$rowProfession      = Helper::cmsRowForm('Profession'   , $inputProfession);
$rowMessage         = Helper::cmsRowForm('Message'      , $inputMessage);
$rowDate            = Helper::cmsRowForm('Date'         , $inputDate);


// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);


// Save
$linkSave                   = URL::createLink('admin', $controller, 'become', array('type' => 'save', 'id' => $this->arrayParam['form']['id']));
$btnSave                    = Helper::cmsButton('Approve', 'toolbar-apply', $linkSave, null, 'submit');

// Save
$linkDeny                   = URL::createLink('admin', $controller, 'become', array('type' => 'deny', 'id' => $this->arrayParam['form']['id']));
$btnDeny                    = Helper::cmsButton('Deny', 'toolbar-deny', $linkDeny, null, 'submit');

// Cancel
$linkCancel                 = URL::createLink('admin', $controller, 'index');
$btnCancel                  = Helper::cmsButton('Cancel', 'toolbar-cancel', $linkCancel, null);

?>



<div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
        <form action="#" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="card-title col-lg-12"><?php echo $this->_title?></div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <hr>
                            <?php echo $rowName . $rowWebsite . $rowDesignAbout . $rowProfession . $rowDate . $rowMessage; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <label for="">Picture</label>
                            <img style="width: 100%" src="<?php echo UPLOAD_URL . 'cache/designer/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture']?>" alt="">
                            <?php echo  $inputToken . $inputUserID . $inputRequestID; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-center col-lg-6">
                <div class="row text-center">
                    <div class="col-xl-6 col-sm-6 icon mb-3">
                        <?php echo $btnSave;?>
                    </div>
                    <div class="col-xl-6 col-sm-6 icon mb-3">
                        <?php echo $btnDeny;?>
                    </div>
                    <div class="col-xl-6 col-sm-6 icon mb-3">
                        <?php echo $btnCancel;?>
                    </div>
                </div>
            </div>
        </form>
        <!-- End container-fluid-->
    </div><!--End content-wrapper-->
    <?php
}
?>