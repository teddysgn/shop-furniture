<?php
    // Input
    $inputName          = Helper::cmsInput('text', 'form[name]', 'name', $this->arrayParam['form']['name'], 'inputbox required form-control', '40');
    $inputValue         = '<input           type="text"     name="form[value]"        id="value"         value="'.number_format($this->arrayParam['form']['value']).'" placeholder="" class="inputbox required form-control" size="40" onkeyup="inputChange()">';
    $inputDate          = Helper::cmsInput('text', 'form[date]', 'date', $this->arrayParam['form']['date'], 'inputbox form-control', '40');
    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    $inputID            = '';
    $rowID              = '';

    if(isset($this->arrayParam['id'])) {
        $inputID        = Helper::cmsInput('text', 'form[id]', 'id', $this->arrayParam['form']['id'], 'inputbox form-control readonly', null, 'readonly');
        $rowID          = Helper::cmsRowForm('ID', $inputID);
    }

    // Row
    $rowName            = Helper::cmsRowForm('Name', $inputName, true);
    $rowValue           = Helper::cmsRowForm('Value', $inputValue);
    $rowDate            = Helper::cmsRowForm('Date', $inputDate);

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

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
    $( function() {
        $( "#date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
    } );
</script>
<div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><?php echo $this->_title?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" name="adminForm" id="adminForm">
                            <?php echo $rowName . $rowValue . $rowDate . $rowID; ?>
                            <div>
                                <?php echo $inputToken; ?>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <script>
        function inputChange(){
            const value = $( "#value" ).val();
            $( "input#value" ).val( Intl.NumberFormat().format(Number(value.replaceAll(',', ''))) )
        }
    </script>