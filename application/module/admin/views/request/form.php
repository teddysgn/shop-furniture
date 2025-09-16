<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<?php

// ----------------------------------------------------------------------------------Input Recent----------------------------------------------------------------------------------
$inputName              = Helper::cmsInput('text'   , 'form[product_name]'      , 'name'                , $this->arrayParam['form']['product_name']     , 'inputbox form-control');
$inputDesigner          = Helper::cmsInput('text'   , 'form[designer_name]'     , 'designer_name'       , $this->arrayParam['form']['designer_name']    , 'inputbox form-control'   , null, 'readonly');
$inputCategoryName      = Helper::cmsInput('text'   , 'form[category_name]'     , 'category_name'       , $this->arrayParam['form']['category_name']    , 'inputbox form-control'   , null, 'readonly');
$inputCollectionName    = Helper::cmsInput('text'   , 'form[collection_name]'   , 'collection_name'     , $this->arrayParam['form']['collection_name']  , 'inputbox form-control'   , null, 'readonly');
$inputPicture1          = Helper::cmsInput('file'   , 'picture1'                , 'picture1'            , $this->arrayParam['form']['picture1']         , 'inputbox form-control'   , '40');
$inputToken             = Helper::cmsInput('hidden' , 'form[token]'             , 'token'               , time());
$inputID                = Helper::cmsInput('hidden' , 'form[id]'                , 'id'                  , $this->arrayParam['form']['id']);
$inputIDRequest         = Helper::cmsInput('hidden' , 'form[request]'           , 'request'             , $this->arrayParam['id']);
$inputDescription       = $this->arrayParam['form']['description'];

$picture            = '';
if(isset($this->arrayParam['id']) || $this->arrayParam['form']['id']) {
    $inputName                  = Helper::cmsInput('text', 'form[name]', 'name', $this->arrayParam['form']['name'], 'inputbox form-control readonly', null, 'readonly');
    $rowName                    = Helper::cmsRowForm('Name', $inputName);
    $picture1	                = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture1'].'">';
    if($this->arrayParam['form']['picture2'] != null)
        $picture2	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture2'].'">';
    if($this->arrayParam['form']['picture3'] != null)
        $picture3	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture3'].'">';
    if($this->arrayParam['form']['picture4'] != null)
        $picture4	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture4'].'">';
    if($this->arrayParam['form']['picture5'] != null)
        $picture5	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture5'].'">';
    if($this->arrayParam['form']['picture6'] != null)
        $picture6	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture6'].'">';
    if($this->arrayParam['form']['picture7'] != null)
        $picture7	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture7'].'">';
    if($this->arrayParam['form']['picture8'] != null)
        $picture8	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture8'].'">';
    if($this->arrayParam['form']['picture9'] != null)
        $picture9	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture9'].'">';
    if($this->arrayParam['form']['picture10'] != null)
        $picture10	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture10'].'">';
    if($this->arrayParam['form']['picture11'] != null)
        $picture11	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture11'].'">';
    if($this->arrayParam['form']['picture12'] != null)
        $picture12	            = '<img style="width: 100%" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture12'].'">';
}


// Row
$rowName            = Helper::cmsRowForm('Name'         , $inputName, true);
$rowDescription     = Helper::cmsRowForm('Description'  , $inputDescription);
$rowDesigner        = Helper::cmsRowForm('Designer'     , $inputDesigner);
$rowCategory        = Helper::cmsRowForm('Category'     , $inputCategoryName);
$rowCollection      = Helper::cmsRowForm('Collection'     , $inputCollectionName);

// ----------------------------------------------------------------------------------Input New----------------------------------------------------------------------------------
$inputCategoryNew           = Helper::cmsInput('text'   , 'form[category_name]'      , 'name'             , $this->Request['category_name']      , 'inputbox form-control', null, 'readonly');
$inputCategoryIDNew         = Helper::cmsInput('hidden' , 'form[category_id]'        , 'name'             , $this->Request['category_id']);
$inputCollectionNew         = Helper::cmsInput('text'   , 'form[collection_name]'    , 'name'             , $this->Request['collection_name']    , 'inputbox form-control', null, 'readonly');
$inputCollectionIDNew       = Helper::cmsInput('hidden' , 'form[collection_id]'      , 'name'             , $this->Request['collection_id']);
$inputDesignerNew           = Helper::cmsInput('text'   , 'form[designer_name]'      , 'designer_name'    , $this->Request['designer_name']      , 'inputbox form-control', null, 'readonly');
$inputDesignerIDNew         = Helper::cmsInput('hidden' , 'form[designer_id]'        , 'name'             , $this->Request['designer_id']);
$inputPicture1New           = Helper::cmsInput('file'   , 'picture1'                 , 'picture1'         , $this->Request['picture1']           , 'inputbox form-control', null, 'readonly');
$inputNameNew               = Helper::cmsInput('text'   , 'form[name]'               , 'name'             , $this->Request['name']               , 'inputbox form-control', null, 'readonly');
$inputDescriptionNew        = $this->Request['description'];
$inputDescriptionHidden     = Helper::cmsInput('hidden' , 'form[description]'        , 'name'             , $this->Request['description']);



$picture            = '';
if(isset($this->Request['id'])) {
   if ($this->Request['picture1'] != null) {
        $picture1New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture1'] . '">';
        $inputPicture1Hidden    = Helper::cmsInput('hidden', 'form[picture1]', 'picture1', $this->Request['picture1'], 'inputbox', '40');
        $rowPicture1New        = Helper::cmsRowForm('Picture 1'    , $picture1New.$inputPicture1Hidden);
        $rowPicture1            = Helper::cmsRowForm('Picture 1'    , $picture1);
    } else {
        $inputPicture1Hidden    = Helper::cmsInput('hidden', 'form[picture1]', 'picture1', $this->arrayParam['form']['picture1'], 'inputbox', '40');
    }
    if ($this->Request['picture2'] != null) {
        $picture2New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture2'] . '">';
        $inputPicture2Hidden    = Helper::cmsInput('hidden', 'form[picture2]', 'picture2', $this->Request['picture2'], 'inputbox', '40');
        $rowPicture2New        = Helper::cmsRowForm('Picture 2'    , $picture2New.$inputPicture2Hidden);
        $rowPicture2        = Helper::cmsRowForm('Picture 2'    , $picture2);
    } else {
        $inputPicture2Hidden    = Helper::cmsInput('hidden', 'form[picture2]', 'picture2', $this->arrayParam['form']['picture2'], 'inputbox', '40');
    }
    if ($this->Request['picture3'] != null) {
        $picture3New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture3'] . '">';
        $inputPicture3Hidden    = Helper::cmsInput('hidden', 'form[picture3]', 'picture3', $this->Request['picture3'], 'inputbox', '40');
        $rowPicture3New         = Helper::cmsRowForm('Picture 3'    , $picture3New.$inputPicture3Hidden);
        $rowPicture3            = Helper::cmsRowForm('Picture 3'    , $picture3);
    }else {
        $inputPicture3Hidden    = Helper::cmsInput('hidden', 'form[picture3]', 'picture3', $this->arrayParam['form']['picture3'], 'inputbox', '40');
    }
    if ($this->Request['picture4'] != null) {
        $picture4New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture4'] . '">';
        $inputPicture4Hidden    = Helper::cmsInput('hidden', 'form[picture4]', 'picture4', $this->Request['picture4'], 'inputbox', '40');
        $rowPicture4New         = Helper::cmsRowForm('Picture 4'    , $picture4New.$inputPicture4Hidden);
        $rowPicture4            = Helper::cmsRowForm('Picture 4'    , $picture4);
    } else {
        $inputPicture4Hidden    = Helper::cmsInput('hidden', 'form[picture4]', 'picture4', $this->arrayParam['form']['picture4'], 'inputbox', '40');
    }
    if ($this->Request['picture5'] != null) {
        $picture5New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture5'] . '">';
        $inputPicture5Hidden    = Helper::cmsInput('hidden', 'form[picture5]', 'picture5', $this->Request['picture5'], 'inputbox', '40');
        $rowPicture5New         = Helper::cmsRowForm('Picture 5'    , $picture5New.$inputPicture5Hidden);
        $rowPicture5            = Helper::cmsRowForm('Picture 5'    , $picture5);
    }else {
        $inputPicture5Hidden    = Helper::cmsInput('hidden', 'form[picture5]', 'picture5', $this->arrayParam['form']['picture5'], 'inputbox', '40');
    }
    if ($this->Request['picture6'] != null) {
        $picture6New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture6'] . '">';
        $inputPicture6Hidden    = Helper::cmsInput('hidden', 'form[picture6]', 'picture6', $this->Request['picture6'], 'inputbox', '40');
        $rowPicture6New         = Helper::cmsRowForm('Picture 6'    , $picture6New.$inputPicture6Hidden);
        $rowPicture6            = Helper::cmsRowForm('Picture 6'    , $picture6);
    }else {
        $inputPicture6Hidden    = Helper::cmsInput('hidden', 'form[picture6]', 'picture1', $this->arrayParam['form']['picture6'], 'inputbox', '40');
    }
    if ($this->Request['picture7'] != null) {
        $picture7New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture7'] . '">';
        $inputPicture7Hidden    = Helper::cmsInput('hidden', 'form[picture7]', 'picture7', $this->Request['picture7'], 'inputbox', '40');
        $rowPicture7New         = Helper::cmsRowForm('Picture 7'    , $picture7New.$inputPicture7Hidden);
        $rowPicture7            = Helper::cmsRowForm('Picture 7'    , $picture7);
    }else {
        $inputPicture7Hidden    = Helper::cmsInput('hidden', 'form[picture7]', 'picture7', $this->arrayParam['form']['picture7'], 'inputbox', '40');
    }
    if ($this->Request['picture8'] != null) {
        $picture8New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture8'] . '">';
        $inputPicture8Hidden    = Helper::cmsInput('hidden', 'form[picture8]', 'picture8', $this->Request['picture8'], 'inputbox', '40');
        $rowPicture8New        = Helper::cmsRowForm('Picture 8'    , $picture8New.$inputPicture8Hidden);
        $rowPicture8        = Helper::cmsRowForm('Picture 8'    , $picture8);
    }else {
        $inputPicture8Hidden    = Helper::cmsInput('hidden', 'form[picture8]', 'picture8', $this->arrayParam['form']['picture8'], 'inputbox', '40');
    }
    if ($this->Request['picture9'] != null) {
        $picture9New            = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture9'] . '">';
        $inputPicture9Hidden    = Helper::cmsInput('hidden', 'form[picture9]', 'picture9', $this->Request['picture9'], 'inputbox', '40');
        $rowPicture9New        = Helper::cmsRowForm('Picture 9'    , $picture9New.$inputPicture9Hidden);
        $rowPicture9        = Helper::cmsRowForm('Picture 9'    , $picture9);
    }else {
        $inputPicture9Hidden    = Helper::cmsInput('hidden', 'form[picture9]', 'picture9', $this->arrayParam['form']['picture9'], 'inputbox', '40');
    }
    if ($this->Request['picture10'] != null) {
        $picture10New           = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture10'] . '">';
        $inputPicture10Hidden   = Helper::cmsInput('hidden', 'form[picture10]', 'picture10', $this->Request['picture10'], 'inputbox', '40');
        $rowPicture10New       = Helper::cmsRowForm('Picture 10'   , $picture10New.$inputPicture10Hidden);
        $rowPicture10       = Helper::cmsRowForm('Picture 10'   , $picture10);
    }else {
        $inputPicture10Hidden    = Helper::cmsInput('hidden', 'form[picture10]', 'picture10', $this->arrayParam['form']['picture10'], 'inputbox', '40');
    }
    if ($this->Request['picture11'] != null) {
        $picture11New           = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture11'] . '">';
        $inputPicture11Hidden   = Helper::cmsInput('hidden', 'form[picture11]', 'picture11', $this->Request['picture11'], 'inputbox', '40');
        $rowPicture11New       = Helper::cmsRowForm('Picture 11'   , $picture11New.$inputPicture11Hidden);
        $rowPicture11       = Helper::cmsRowForm('Picture 11'   , $picture11);
    }else {
        $inputPicture11Hidden    = Helper::cmsInput('hidden', 'form[picture11]', 'picture11', $this->arrayParam['form']['picture11'], 'inputbox', '40');
    }
    if ($this->Request['picture12'] != null) {
        $picture12New           = '<img style="width: 100%" src="' . UPLOAD_URL . 'cache/' . $this->arrayParam['type'] . DS . $this->Request['name'] . DS . $this->Request['picture12'] . '">';
        $inputPicture12Hidden   = Helper::cmsInput('hidden', 'form[picture12]', 'picture12', $this->Request['picture12'], 'inputbox', '40');
        $rowPicture12New       = Helper::cmsRowForm('Picture 12'   , $picture12New.$inputPicture12Hidden);
        $rowPicture12       = Helper::cmsRowForm('Picture 12'   , $picture12);
    }else {
        $inputPicture12Hidden    = Helper::cmsInput('hidden', 'form[picture12]', 'picture12', $this->arrayParam['form']['picture12'], 'inputbox', '40');
    }
}


// Row
$rowNameNew            = Helper::cmsRowForm('Name'         , $inputNameNew);
$rowDescriptionNew     = Helper::cmsRowForm('Description'  , $inputDescriptionNew);
$rowDesignerNew        = Helper::cmsRowForm('Designer'     , $inputDesignerNew);
$rowCategoryNew        = Helper::cmsRowForm('Category'     , $inputCategoryNew);
$rowCollectionNew      = Helper::cmsRowForm('Category'     , $inputCollectionNew);


// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);


// Save
$linkSave                   = URL::createLink('admin', $controller, 'form', array('product_id' => $this->arrayParam['product_id'], 'type' => $this->arrayParam['type']));
$btnSave                    = Helper::cmsButton('Approve', 'toolbar-apply', $linkSave, null, 'submit');

// Deny
$linkDeny                   = URL::createLink('admin', $controller, 'form', array('product_id' => $this->arrayParam['product_id'], 'type' => 'deny'));
$btnDeny                    = Helper::cmsButton('Deny', 'toolbar-deny', $linkDeny, null, 'submit');

// Cancel
$linkCancel                 = URL::createLink('admin', $controller, 'index');
$btnCancel                  = Helper::cmsButton('Cancel', 'toolbar-cancel', $linkCancel, null);

?>



<?php
    if($this->arrayParam['type'] == 'edit'){
?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
        <form action="#" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Recent Content</div>
                            <hr>
                            <?php echo $rowName . $rowDescription . $inputID . $rowCategory . $rowCollection . $inputIDRequest; ?>
                        </div>
                    </div>
                    <div class="card-body row" style="justify-content: center">
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture1; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture2; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture3; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture4; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture5; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture6; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture7; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture8; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture9; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture10; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture11; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture12; ?>
                        </div>
                        <?php echo $inputPicture1Hidden.$inputPicture2Hidden.$inputPicture3Hidden.$inputPicture4Hidden.$inputPicture5Hidden.$inputPicture6Hidden.$inputPicture7Hidden.$inputPicture8Hidden.$inputPicture9Hidden.$inputPicture10Hidden.$inputPicture11Hidden.$inputPicture12Hidden?>

                        <div>
                            <?php echo $inputToken; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Request Content</div>
                            <hr>
                            <?php echo $rowNameNew . $rowDescriptionNew . $rowCategoryNew . $rowCollectionNew . $inputCategoryIDNew . $inputCollectionIDNew . $inputDesignerIDNew . $inputDescriptionHidden; ?>
                        </div>
                    </div>
                    <div class="card-body row" style="justify-content: center">
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture1New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture2New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture3New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture4New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture5New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture6New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture7New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture8New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture9New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture10New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture11New; ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php echo $rowPicture12New; ?>
                        </div>

                        <div>
                            <?php echo $inputToken; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12" style="width: 100%">
                    <div class="card-body row" style="justify-content: center">
                        <div>
                            <?php echo $inputToken; ?>
                        </div>
                        <div class="form-group" >
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 icon mb-3" style="width: 50%">
                                    <?php echo $btnSave;?>
                                </div>
                                <div class="col-xl-12 col-sm-12 icon mb-3" style="width: 50%">
                                    <?php echo $btnDeny;?>
                                </div>
                                <div class="col-xl-12 col-sm-12 icon mb-3" style="width: 50%">
                                    <?php echo $btnCancel;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    }else{
?>
    <div class="content-wrapper">
            <div class="container-fluid">
                <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
                <form action="#" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
                    <div class="row mt-3">
                        <div class="col-lg-6" style="width: 100%">
                            <div class="card row">
                                <div class="card-body col-lg-12">
                                    <div class="card-title">Request Content</div>
                                    <hr>
                                    <?php echo $rowNameNew . $rowDescriptionNew . $rowCategoryNew . $rowCollectionNew . $inputCategoryIDNew . $inputCollectionIDNew . $inputDesignerIDNew . $inputDescriptionHidden; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body row col-lg-12" style="justify-content: center">
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture1New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture2New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture3New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture4New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture5New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture6New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture7New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture8New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture9New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture10New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture11New; ?>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <?php echo $rowPicture12New; ?>
                                </div>

                                <div>
                                    <?php echo $inputToken; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12" style="width: 100%">
                            <div class="card-body row" style="justify-content: center">
                                <div>
                                    <?php echo $inputToken; ?>
                                </div>
                                <div class="form-group" >
                                    <div class="row">
                                        <div class="col-xl-12 col-sm-12 icon mb-3" style="width: 50%">
                                            <?php echo $btnSave;?>
                                        </div>
                                        <div class="col-xl-12 col-sm-12 icon mb-3" style="width: 50%">
                                            <?php echo $btnDeny;?>
                                        </div>
                                        <div class="col-xl-12 col-sm-12 icon mb-3" style="width: 50%">
                                            <?php echo $btnCancel;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

<?php
    }
?>


