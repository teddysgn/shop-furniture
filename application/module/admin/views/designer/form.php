<?php
    // Input
    $inputName                  = Helper::cmsInput('text'   , 'form[name]'          , 'name'                , $this->arrayParam['form']['name']                 , 'inputbox form-control');
    $inputToken                 = Helper::cmsInput('hidden' , 'form[token]'         , 'token'               , time());
    $inputOrdering              = Helper::cmsInput('text'   , 'form[ordering]'      , 'ordering'            , $this->arrayParam['form']['ordering']             , 'inputbox form-control', '40');
    $inputPictureProfile        = Helper::cmsInput('file'   , 'picture_profile'     , 'picture5'            , $this->arrayParam['form']['picture_profile']      , 'inputbox form-control', '40');
    $inputPictureBackground     = Helper::cmsInput('file'   , 'picture_background'  , 'picture6'            , $this->arrayParam['form']['picture_background']   , 'inputbox form-control', '40');
    $inputPicture1              = Helper::cmsInput('file'   , 'picture1'            , 'picture1'            , $this->arrayParam['form']['picture1']             , 'inputbox form-control', '40');
    $inputPicture2              = Helper::cmsInput('file'   , 'picture2'            , 'picture2'            , $this->arrayParam['form']['picture2']             , 'inputbox form-control', '40');
    $inputPicture3              = Helper::cmsInput('file'   , 'picture3'            , 'picture3'            , $this->arrayParam['form']['picture3']             , 'inputbox form-control', '40');
    $inputPicture4              = Helper::cmsInput('file'   , 'picture4'            , 'picture4'            , $this->arrayParam['form']['picture4']             , 'inputbox form-control', '40');
    $inputDescription           = '<textarea  rows="10" name="form[description]" class="form-control" style="color: black;">'.$this->arrayParam['form']['description'].'</textarea>';
    $inputAbout                 = '<textarea  rows="10" name="form[about]" class="form-control" style="color: black;">'.$this->arrayParam['form']['about'].'</textarea>';
    $inputMaxim                 = '<textarea  rows="5" name="form[maxim]" class="form-control" style="color: black;">'.$this->arrayParam['form']['maxim'].'</textarea>';
    $inputComment               = '<textarea  rows="5" name="form[comment]" class="form-control" style="color: black;">'.$this->arrayParam['form']['comment'].'</textarea>';
    $slbStatus                  = Helper::cmsSelectbox('form[status]', 'inputbox form-control' ,array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish'), $this->arrayParam['form']['status'], 'width: 230px; padding: 3px');

    $inputID            = '';
    $rowID              = '';
    $rowName            = Helper::cmsRowForm('Name', $inputName, true);
    $picture            = '';

    $pictureProfile	        = '<img style="width:100%; background-color: #d1c286" id="display_image5" src="'.$imageURL.'/default.png">';
    $pictureBackground      = '<img style="width:100%; background-color: #d1c286" id="display_image6" src="'.$imageURL.'/default.png">';
    $picture1	            = '<img style="width:100%; background-color: #d1c286" id="display_image1" src="'.$imageURL.'/default.png">';
    $picture2	            = '<img style="width:100%; background-color: #d1c286" id="display_image2" src="'.$imageURL.'/default.png">';
    $picture3	            = '<img style="width:100%; background-color: #d1c286" id="display_image3" src="'.$imageURL.'/default.png">';
    $picture4	            = '<img style="width:100%; background-color: #d1c286" id="display_image4" src="'.$imageURL.'/default.png">';


if(isset($this->arrayParam['id']) || $this->arrayParam['form']['id']) {
        $inputID                        = Helper::cmsInput('number', 'form[id]', 'id', $this->arrayParam['form']['id'], 'inputbox form-control readonly', null, 'readonly');
        $rowID                          = Helper::cmsRowForm('ID', $inputID);
        $inputName                      = Helper::cmsInput('text', 'form[name]', 'name', $this->arrayParam['form']['name'], 'inputbox form-control readonly', null, 'readonly');
        $rowName                        = Helper::cmsRowForm('Name', $inputName);
        $inputPictureProfileHidden      = Helper::cmsInput('hidden', 'form[picture_profile_hidden]', 'picture_profile_hidden', $this->arrayParam['form']['picture_profile'], 'inputbox', '40');
        $inputPictureBackgroundHidden   = Helper::cmsInput('hidden', 'form[picture_background_hidden]', 'picture_background_hidden', $this->arrayParam['form']['picture_background'], 'inputbox', '40');
        $inputPicture1Hidden            = Helper::cmsInput('hidden', 'form[picture1_hidden]', 'picture1_hidden', $this->arrayParam['form']['picture1'], 'inputbox', '40');
        $inputPicture2Hidden            = Helper::cmsInput('hidden', 'form[picture1_hidden]', 'picture2_hidden', $this->arrayParam['form']['picture2'], 'inputbox', '40');
        $inputPicture3Hidden            = Helper::cmsInput('hidden', 'form[picture1_hidden]', 'picture3_hidden', $this->arrayParam['form']['picture3'], 'inputbox', '40');
        $inputPicture4Hidden            = Helper::cmsInput('hidden', 'form[picture4_hidden]', 'picture4_hidden', $this->arrayParam['form']['picture4'], 'inputbox', '40');

    }


    // Row
    $rowDescription     = Helper::cmsRowForm('Description'  , $inputDescription);
    $rowAbout           = Helper::cmsRowForm('About'        , $inputAbout);
    $rowMaxim           = Helper::cmsRowForm('Maxim'        , $inputMaxim);
    $rowComment         = Helper::cmsRowForm('Comment'      , $inputComment);
    $rowOrdering        = Helper::cmsRowForm('Ordering'     , $inputOrdering, true);
    $rowStatus          = Helper::cmsRowForm('Status'       , $slbStatus);

    if($this->arrayParam['form']['picture_profile'] == null)
        $rowPictureProfile = Helper::cmsRowForm('Picture Profile', $inputPictureProfile . $pictureProfile);
    else{
        $pictureProfile	   = '<img  style="width:100%" id="display_image5" src="'.UPLOAD_URL . 'designer/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture_profile'].'">';
        $rowPictureProfile = Helper::cmsRowForm('Picture Profile', $inputPictureProfile.$pictureProfile.$inputPictureProfileHidden);
    }
    if($this->arrayParam['form']['picture_background'] == null)
        $rowPictureBackground = Helper::cmsRowForm('Picture Background', $inputPictureBackground . $pictureBackground);
    else{
        $pictureBackground	  = '<img  style="width:100%" id="display_image6" src="'.UPLOAD_URL . 'designer/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture_background'].'">';
        $rowPictureBackground = Helper::cmsRowForm('Picture Background', $inputPictureBackground.$pictureBackground.$inputPictureBackgroundHidden);
    }

    if($this->arrayParam['form']['picture1'] == null)
        $rowPicture1 = Helper::cmsRowForm('Picture 1', $inputPicture1.$picture1);
    else{
        $picture1	 = '<img style="width:100%" id="display_image1" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture1'].'">';
        $rowPicture1 = Helper::cmsRowForm('Picture 1', $inputPicture1.$picture1.$inputPicture1Hidden);
    }
    if($this->arrayParam['form']['picture2'] == null)
        $rowPicture2 = Helper::cmsRowForm('Picture 2', $inputPicture2.$picture2);
    else{
        $picture2	 = '<img style="width:100%" id="display_image2" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture2'].'">';
        $rowPicture2 = Helper::cmsRowForm('Picture 2', $inputPicture2.$picture2.$inputPicture2Hidden);
    }

    if($this->arrayParam['form']['picture3'] == null){
        $rowPicture3 = Helper::cmsRowForm('Picture 3', $inputPicture3.$picture3);
    }
    else{
        $picture3	 = '<img style="width:100%" id="display_image3" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture3'].'">';
        $rowPicture3 = Helper::cmsRowForm('Picture 3', $inputPicture3.$picture3.$inputPicture3Hidden);
    }

    if($this->arrayParam['form']['picture4'] == null)
        $rowPicture4 = Helper::cmsRowForm('Picture 4', $inputPicture4.$picture4);
    else{
        $picture4	 = '<img style="width:100%" id="display_image4" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture4'].'">';
        $rowPicture4 = Helper::cmsRowForm('Picture 4', $inputPicture4.$picture4.$inputPicture4Hidden);
    }
    // MESSAGE
    $message	= Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);


    // Save
    $linkSave                   = URL::createLink('admin', $controller, 'form', array('type' => 'save'));
    $btnSave                    = Helper::cmsButton('Save', 'toolbar-apply', $linkSave, null, 'submit');

    // Save & Close
    $linkSaveClose              = URL::createLink('admin', $controller, 'form', array('type' => 'save-close'));
    $btnSaveClose               = Helper::cmsButton('Save & Close', 'toolbar-save', $linkSaveClose, null, 'submit');

    // Save & New
    $linkSaveNew                = URL::createLink('admin', $controller, 'form', array('type' => 'save-new'));
    $btnSaveNew                 = Helper::cmsButton('Save & New', 'toolbar-save-new', $linkSaveNew, null, 'submit');

    // Cancel
    $linkCancel                 = URL::createLink('admin', $controller, 'index');
    $btnCancel                  = Helper::cmsButton('Cancel', 'toolbar-cancel', $linkCancel, null);

?>



<div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
        <form action="#" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
        <div class="row mt-3">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><?php echo $this->_title?></div>
                        <hr>
                        <?php echo $rowName . $rowDescription . $rowAbout . $rowMaxim . $rowComment . $rowSaleOff . $rowOrdering . $rowStatus . $rowSpecial . $rowCategory . $rowCollection . $rowID; ?>
                     </div>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12">
                <div class="card">
                    <div class="card-body row" style="justify-content: center">
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPictureProfile; ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPictureBackground; ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture1; ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture2; ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture3; ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture4; ?></div>
                        <div><?php echo $inputToken; ?></div>
                        <div class="form-group" >
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnSave;?>
                                </div>
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnSaveClose;?>
                                </div>
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnSaveNew;?>
                                </div>
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnCancel;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- End container-fluid-->
    </div><!--End content-wrapper-->
    <script>
        <?php
        for($i = 1; $i <= 6; $i++){
            $script .= '
            const   picture'.$i.'     = document.querySelector("#picture'.$i.'");
            var     upload_image'.$i.'    = "";

            picture'.$i.'.addEventListener("change", function () {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    upload_image'.$i.' = reader.result;
                    document.querySelector("#display_image'.$i.'").src = `${upload_image'.$i.'}`;
                });
                reader.readAsDataURL(this.files[0]);
            });
        ';
        }
        echo $script
        ?>
    </script>