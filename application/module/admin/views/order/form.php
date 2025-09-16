<?php
    // Input
    $inputUsername      = Helper::cmsInput('text', 'form[username]', 'username', $this->arrayParam['form']['username'], 'inputbox readonly form-control', null, 'readonly');
    $inputDate          = Helper::cmsInput('text', 'form[date]', 'date', $this->arrayParam['form']['date'], 'inputbox readonly form-control', null, 'readonly');
    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());
    $slbStatus          = Helper::cmsSelectbox('form[status]', 'inputbox form-control' ,array('default' => 'Select Pending', 0 => 'Not yet', 1 => 'Approved'), $this->arrayParam['form']['status'], 'width: 230px; padding: 3px');
    $inputStatus        = Helper::cmsInput('text', 'form[status]', 'status', $this->arrayParam['form']['status'] == 0 ? 'Not Yet' : 'Approved', 'inputbox readonly form-control', null, 'readonly');
    $slbCompleted       = Helper::cmsSelectbox('form[completed]', 'inputbox form-control' ,array('default' => 'Select Completed', 0 => 'Not Yet', 1 => 'Shipped'), $this->arrayParam['form']['completed'], 'width: 230px; padding: 3px');
    $inputCompleted     = Helper::cmsInput('text', 'form[completed]', 'status', $this->arrayParam['form']['completed'] == 0 ? 'Not Yet' : 'Shipped', 'inputbox readonly form-control', null, 'readonly');
    $slbCancel          = Helper::cmsSelectbox('form[cancel]', 'inputbox form-control' ,array('default' => 'Select Cancel', 1 => 'Pending', 2 => 'Approved'), $this->arrayParam['form']['cancel'], 'width: 230px; padding: 3px');
    $inputCancel        = Helper::cmsInput('text', '', 'cancel', 'Cancelled', 'inputbox readonly form-control', null, 'readonly');
    $inputCode          = Helper::cmsInput('text', 'form[coupon_name]', 'id', $this->arrayParam['form']['coupon_name'], 'inputbox readonly form-control form-control', null, 'readonly');
    $inputPayment       = Helper::cmsInput('text', 'form[payment]', 'id', $this->arrayParam['form']['payment'], 'inputbox readonly form-control', null, 'readonly');
    $inputInvoice       = Helper::cmsInput('text', 'form[invoice]', 'id', $this->arrayParam['form']['invoice'], 'inputbox readonly form-control', null, 'readonly');
    $inputCustomer      = Helper::cmsInput('text', 'form[customer]', 'id', $this->arrayParam['form']['customer'], 'inputbox readonly form-control', null, 'readonly');
    $inputAddress       = Helper::cmsInput('text', 'form[address]', 'id', $this->arrayParam['form']['address'], 'inputbox readonly form-control', null, 'readonly');
    $inputPhone         = Helper::cmsInput('text', 'form[phone]', 'id', $this->arrayParam['form']['phone'], 'inputbox readonly form-control', null, 'readonly');
    $inputUserID        = Helper::cmsInput('hidden', 'form[user_id]', 'user_id', $this->arrayParam['form']['user_id'], 'inputbox readonly form-control', null, 'readonly');

    // Row
    $rowUsername        = Helper::cmsRowForm('Customer Account', $inputUsername);
    $rowDate            = Helper::cmsRowForm('Date', $inputDate);
    $rowCode            = Helper::cmsRowForm('Voucher', $inputCode);
    $rowPayment         = Helper::cmsRowForm('Payment', $inputPayment);
    $rowInvoice         = Helper::cmsRowForm('Invoice', $inputInvoice);
    $rowCustomer        = Helper::cmsRowForm('Customer Name', $inputCustomer);
    $rowAddress         = Helper::cmsRowForm('Address', $inputAddress);
    $rowPhone           = Helper::cmsRowForm('Phone', $inputPhone);
    if($this->arrayParam['form']['cancel'] == 0){
        $rowStatus          = Helper::cmsRowForm('Status', $slbStatus, true);
        $rowCompleted       = Helper::cmsRowForm('Completed', $slbCompleted, true);
        $rowCancel          = '';
    } elseif($this->arrayParam['form']['cancel'] == 1) {
        $rowStatus          = Helper::cmsRowForm('Status', $inputStatus);
        $rowCompleted       = Helper::cmsRowForm('Completed', $inputCompleted);   
        $rowCancel          = Helper::cmsRowForm('Cancel', $slbCancel);   
    } else {
         $rowStatus          = Helper::cmsRowForm('Status', $inputStatus);
        $rowCompleted       = Helper::cmsRowForm('Completed', $inputCompleted);   
        $rowCancel          = Helper::cmsRowForm('Cancel', $inputCancel);   
    }
    


    $rowID ='';
    if(isset($this->arrayParam['id']) || isset($this->arrayParam['form']['id'])) {
        $inputID            = Helper::cmsInput('text', 'form[id]', 'id', $this->arrayParam['form']['id'], 'inputbox readonly form-control', null, 'readonly');
        $rowID              = Helper::cmsRowForm('ID', $inputID);
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

$xhtml = '';
if(!empty($this->Items)){
    foreach($this->Items as $key => $value){
        $cartId			= $value['id'];
        $status         = $value['status'];
        $completed      = $value['completed'];
        $member         = $value['memberDiscount'];


        $date			= date("H:i d/m/Y", strtotime($value['date']));
        $arrProuct		= json_decode($value['products']);
        $arrPrice		= json_decode($value['prices']);
        $arrName		= json_decode($value['names']);
        $arrQuantity	= json_decode($value['quantities']);
        $arrPicture		= json_decode($value['pictures']);
        $tableContent	= '';
        $totalPrice		= 0;

        $voucher = intval($this->arrayParam['form']['value']);

        foreach ($arrProuct as $keyB => $valueB){
            $arrName[$keyB] = str_replace('u2013', '–', $arrName[$keyB]);

            $picturePath	= UPLOAD_PATH . 'product' . DS . $arrName[$keyB] . DS . $arrPicture[$keyB];

            if(file_exists($picturePath)==true){
                $picture	= '<img  width="180" width="240" src="'.UPLOAD_URL . 'product' . DS . $arrName[$keyB] . DS . $arrPicture[$keyB].'">';
            }else{
                $picture	= '<img width="180" width="240" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
            }
            $totalPrice		+= $arrQuantity[$keyB] * $arrPrice[$keyB];
            $tableContent .= '<tr>
                                    <td>'.$picture.'</td>
                                    <td class="name">'.$arrName[$keyB].'</td>
                                    <td>'.number_format($arrPrice[$keyB]).'</td>
                                    <td class="text-center">'.$arrQuantity[$keyB].'</td>
                                    <td>'.number_format($arrQuantity[$keyB] * $arrPrice[$keyB]).'</td>
                                </tr>';
        }

        $priceDiscount = -$totalPrice * $voucher / 100;
        $xhtml .= ' <div id="fh5co-product">
            <div class="row">
                <div class="col-md-12 col-md-offset-1">
                    <div class="fh5co-tabs animate-box">

                        <!-- Tabs -->
                            <div class="fh5co-tab-content-wrap">
                                <div class="col-md-12 col-5">
                                    <div class="table-responsive order-table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                '.$tableContent.'
                                            </tr>
        
                                            </tbody>
                                        </table>
                                   </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-12 col-12 text-right border-bottom mb-5 text-center">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3 text-center">
                                    <div class="col-md-6 col-7 col-sm-12">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 col-3 text-right">
                                        <strong class="text-black">'.number_format($totalPrice).'</strong>
                                    </div>
                                </div>
                                <div class="row mb-3 text-center">
                                    <div class="col-md-6 col-7">
                                        <span class="text-black">Coupon</span>
                                    </div>
                                    <div class="col-md-6 col-3 text-right">
                                        <strong class="text-black">'.number_format($priceDiscount).'</strong>
                                    </div>
                                </div>
                                <div class="row mb-3 text-center">
                                    <div class="col-md-6 col-7">
                                        <span class="text-black">Member</span>
                                    </div>
                                    <div class="col-md-6 col-3 text-right">
                                        <strong class="text-black">'.number_format($member).'</strong>
                                    </div>
                                </div>
                                <div class="row mb-5 text-center">
                                    <div class="col-md-6 col-7">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 col-3 text-right">
                                        <strong class="text-black">'.number_format($totalPrice + $priceDiscount + $member).'</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
    </div>';
    }
}
?>

<style>
     td {
        border: 1px solid black;
        text-align: center;
        margin: 10px;
        padding: 5px 10px;
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error . $this->errorStatus;?></div>
        <div class="row mt-3" style="justify-content: center">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body" style="width: 100%">
                        <div class="card-title"><?php echo $this->_title?></div>
                        <hr>
                        <form action="#" method="post" name="adminForm" id="adminForm">
                            <?php echo $rowUsername . $rowCustomer . $rowAddress . $rowPhone . $rowStatus . $rowCompleted . $rowCancel . $rowID . $rowCode . $rowPayment . $rowDate; ?>
                            <div>
                                <?php echo $inputToken . $inputUserID; ?>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12">
                    <?php echo $xhtml;?>
                    <div class="form-group" style="text-align: center">
                        <div class="row" style="justify-content: center">
                            <div class="col-xl-10 col-sm-10 icon mb-3" style="width: 50%">
                                <?php echo $btnSave;?>
                            </div>
                            <div class="col-xl-10 col-sm-10 icon mb-3" style="width: 50%">
                                <?php echo $btnSaveClose;?>
                            </div>
                            <div class="col-xl-10 col-sm-10 icon mb-3" style="width: 50%">
                                <?php echo $btnSaveNew;?>
                            </div>
                            <div class="col-xl-10 col-sm-10 icon mb-3" style="width: 50%">
                                <?php echo $btnCancel;?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div><!--End content-wrapper-->






