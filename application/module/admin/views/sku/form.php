<?php
    // Input
    $selected           = isset($this->arrayParam['form']['product_id']) ? $this->arrayParam['form']['product_id'] : 'default';
    $inputProduct       = Helper::cmsInput('text'   , 'form[product]'       , 'product' , $this->arrayParam['form']['name'] , 'inputbox form-control', '40', null, '', 'list="nameProduct"');
    $inputQuantity      = Helper::cmsInput('number' , 'form[quantity]'      , 'quantity', $this->arrayParam['form']['quantity'] , 'inputbox form-control', '40');
    $inputCost         = '<input            type="text"     name="form[cost]"             id="cost"      value="'.number_format($this->arrayParam['form']['cost']).'" placeholder="" class="inputbox required form-control" size="40" onkeyup="inputChange()">';
    $inputDate          = Helper::cmsInput('text'   , 'form[date]'          , 'date'    , $this->arrayParam['form']['date']     , 'inputbox form-control', '40', null, 'yyyy-mm-dd');
    $inputToken         = Helper::cmsInput('hidden' , 'form[token]'         , 'token'   , time());

    $inputID            = '';
    $inputBarcode       = '';
    $rowID              = '';
    $rowBarcode         = '';

    if(isset($this->arrayParam['id'])) {
        $inputID        = Helper::cmsInput('text', 'form[id]'       , 'id'      , $this->arrayParam['form']['id']                       , 'inputbox form-control', null, 'readonly');
        $inputBarcode   = Helper::cmsInput('text', 'form[barcode]'  , 'barcode' , $this->arrayParam['form']['barcode']                  , 'inputbox form-control', '40', 'readonly');
        $inputProduct		= Helper::cmsInput('text', 'form[product]'  , 'product' , $this->arrayParam['form']['name']                     , 'inputbox form-control', '40', 'readonly');
        $inputQuantity  = Helper::cmsInput('text', 'form[quantity]' , 'quantity',number_format($this->arrayParam['form']['quantity'])   , 'inputbox form-control', '40','readonly');
        $inputCost      = Helper::cmsInput('text', 'form[cost]'     , 'cost'    , number_format($this->arrayParam['form']['cost'])      , 'inputbox form-control', '40','readonly');
        $inputDate      = Helper::cmsInput('text', 'form[date]'     , ''        , $this->arrayParam['form']['date']                     , 'inputbox form-control', '40', 'readonly', 'yyyy-mm-dd');
        $rowID          = Helper::cmsRowForm('ID', $inputID);
        $rowBarcode     = Helper::cmsRowForm('SKU', $inputBarcode);
    }

    // Row
    $rowProduct         = Helper::cmsRowForm('Product'  , $inputProduct   , true);
    $rowQuantity        = Helper::cmsRowForm('Quantity' , $inputQuantity, true);
    $rowCost            = Helper::cmsRowForm('Cost'     , $inputCost    , true);
    $rowDate            = Helper::cmsRowForm('Date'     , $inputDate);

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

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#date" ).datepicker({dateFormat: "yy-mm-dd"});
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
                            <?php echo $rowBarcode . $rowProduct . $rowQuantity . $rowCost . $rowDate . $rowID; ?>
                            <div>
                                <?php echo $inputToken; ?>
                            </div>
                            <datalist id="nameProduct">
                                <?php
                                $options = '';
                                foreach ($this->nameProduct as $key => $value){
                                    $options .= '<option value="'.$value['name'].'"></option>';
                                }
                                echo $options;
                                ?>

                            </datalist>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12" style="width: 100%">
                <div class="card">
                    <div class="card-body">
                            <div>
                                <?php echo $inputToken; ?>
                            </div>
                            <div class="form-group" style="text-align: center">
                                <div class="row">
                                <?php
                                    if(!isset($this->arrayParam['form']['id'])){

                                ?>
                                        <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                            <?php echo $btnSave;?>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                            <?php echo $btnSaveClose;?>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                            <?php echo $btnSaveNew;?>
                                        </div>
                                    <?php
                                        }
                                    ?>
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
    <script>
        function inputChange(){
            const value = $( "#cost" ).val();
            $( "input#cost" ).val( Intl.NumberFormat().format(Number(value.replaceAll(',', ''))) )
        }
    </script>