<?php

    // Input
    $inputName          = Helper::cmsInput('text', 'form[name]', 'name', $this->arrayParam['form']['name'], 'inputbox required form-control', '40');
    $inputOrdering      = Helper::cmsInput('text', 'form[ordering]', 'ordering', $this->arrayParam['form']['ordering'], 'inputbox form-control', '40');
    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());
    $selectStatus       = Helper::cmsSelectbox('form[status]', 'inputbox form-control' ,array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish'), $this->arrayParam['form']['status'], 'width: 230px; padding: 3px');
    $selectGroupACP     = Helper::cmsSelectbox('form[group_acp]', 'inputbox form-control' ,array('default' => 'Select Group ACP', 1 => 'Yes', 0 => 'No'), $this->arrayParam['form']['group_acp'], 'width: 230px; padding: 3px');

    $inputID            = '';
    $rowID              = '';
    if(isset($this->arrayParam['id'])) {
        $inputID        = Helper::cmsInput('text', 'form[id]', 'id', $this->arrayParam['form']['id'], 'inputbox readonly form-control', null, 'readonly');
        $rowID          = Helper::cmsRowForm('ID', $inputID);
    }
    // Row
    $rowName            = Helper::cmsRowForm('Name', $inputName, true);
    $rowOrdering        = Helper::cmsRowForm('Ordering', $inputOrdering);
    $rowStatus          = Helper::cmsRowForm('Status', $selectStatus);
    $rowGroupACP        = Helper::cmsRowForm('Group ACP', $selectGroupACP);

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
        <div class="row mt-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><?php echo $this->_title?></div>
                        <hr>
                        <form action="#" method="post" name="adminForm" id="adminForm">
                            <?php echo $rowName . $rowOrdering . $rowStatus . $rowGroupACP . $rowID; ?>                            
                            <div>
                                <div>
                                    <?php echo $inputToken; ?>
                                </div>
                                <div class="form-group" style="text-align: center">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End content-wrapper-->




