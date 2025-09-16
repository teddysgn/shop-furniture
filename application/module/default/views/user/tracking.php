<?php

    $linkShop          = URL::createLink('default', 'product', 'shop', array('category_id' => '1-2'), 'diningroom');;

    $xhtml = '';
    
    // MESSAGE
	$message	= Session::get('message');
	Session::delete('message');
	$strMessage = Helper::cmsMessagePublic($message);
	
    if($_POST['form']['token'] > 0 && $_POST['form']['id'] != null) {
        if(!empty($this->Items)){
            $tracking       = $this->Items;
            $cartId			= $tracking['id'];
            $memberDiscount	= $tracking['memberDiscount'];
            $payment		= $tracking['payment'];
            $status         = $tracking['status'];
            $completed      = $tracking['completed'];
            $cancel         = $tracking['cancel'];
            if($cancel != 0){
                if($cancel == 1) {
                    $result = '<img width="120" height="120" src="'.$imageURL.'/cancel_step_1.png">
                                   <div style="width: 20%;">
                                        <p style="margin-bottom: 0">Sent Request</p>
                                        <hr style="border: 1px solid black; margin: 0px">
                                   </div>                     
                                   <img width="135" height="118" src="'.$imageURL.'/cancel_step_2.png">';
                    $policy = '<p>
                                <small style="cursor: pointer" href="#" onclick="javascript:policy()" class="text-primary">Return & Refund Privacy <i class="fa-solid fa-circle-question"></i></small>
                            </p>';
                }
                
                if($cancel == 2) {
                    $result = '<img width="140" height="118" src="'.$imageURL.'/cancel_step_1.png">
                               <div style="width: 20%;">
                                    <p style="margin-bottom: 0">Sent Request</p>
                                    <hr style="border: 1px solid black; margin: 0px">
                               </div>                     
                               <img width="120" height="120" src="'.$imageURL.'/cancel_step_3.png">
                               <div style="width: 20%;">
                                    <p style="margin-bottom: 0">Approved</p>
                                    <hr style="border: 1px solid black; margin: 0px">
                               </div>   
                               <img width="140" height="118" src="'.$imageURL.'/cancel_step_4.png">';
                    $policy = '<p>
                                    <small style="cursor: pointer" href="#" onclick="javascript:policy()" class="text-primary">Return & Refund Privacy <i class="fa-solid fa-circle-question"></i></small>
                                </p>';
                }
            } elseif($cancel == 0) {
                if($status == 0) {
                    $result = '<img width="100" height="120" src="'.$imageURL.'/step_1.png">';
                } elseif ($completed == 0) {
                    $result = '<img width="120" height="120" src="'.$imageURL.'/ran_step_1.png">
                               <div style="width: 20%;">
                                    <p style="margin-bottom: 0">To be Shipped</p>
                                    <hr style="border: 1px solid black; margin: 0px">
                               </div>                     
                               <img width="100" height="120" src="'.$imageURL.'/step_2.png">';
                } else {
                    $result = '<img width="120" height="120" src="'.$imageURL.'/ran_step_1.png">
                               <div style="width: 20%;">
                                    <p style="margin-bottom: 0">To be Shipped</p>
                                    <hr style="border: 1px solid black; margin: 0px">
                               </div>                     
                               <img width="120" height="120" src="'.$imageURL.'/ran_step_4.png">
                               <div style="width: 20%;">
                                    <p style="margin-bottom: 0">Shipping</p>
                                    <hr style="border: 1px solid black; margin: 0px">
                               </div>   
                               <img width="100" height="120" src="'.$imageURL.'/step_3.png">';
                }
            }

            $date			    = date("H:i:s d/m/Y", strtotime($tracking['date']));
            $arrBookID		    = json_decode($tracking['products']);
            $arrPrice		    = json_decode($tracking['prices']);
            $arrName		    = json_decode($tracking['names']);
            $arrQuantity	    = json_decode($tracking['quantities']);
            $arrPicture		    = json_decode($tracking['pictures']);
            $tableContent	    = '';
            $voucher    	    = '';
            $totalPrice		    = 0;
            $total              = 0;

            $arrVoucherValue    = $tracking['value'];
            $arrVoucherName	    = $tracking['name'];


            foreach ($arrBookID as $keyB => $valueB){
                $linkDetail		= URL::createLink('default', 'product', 'detail', array('product_id' => $valueB), URL::filterURL($arrName[$keyB]).'-'.$valueB);

                $linkDetail		= URL::createLink('default', 'product', 'detail', array('product_id' => $valueB));

                $arrName[$keyB] = str_replace('u2013', '–', $arrName[$keyB]);

                $picturePath	= UPLOAD_PATH . 'product' . DS . $arrName[$keyB] . DS . $arrPicture[$keyB];

                if(file_exists($picturePath)==true){
                    $picture	= '<img  width="180" width="240" src="'.UPLOAD_URL . 'product' . DS . $arrName[$keyB] . DS . $arrPicture[$keyB].'">';
                }else{
                    $picture	= '<img width="180" width="240" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
                }

                $totalPrice		+= $arrQuantity[$keyB] * $arrPrice[$keyB];

                $tableContent .= '<tr>
                                    <td><a href="'.$linkDetail.'">'.$picture.'</a></td>
                                    <td class="name">'.$arrName[$keyB].'</td>
                                    <td>'.number_format($arrPrice[$keyB]).'</td>
                                    <td class="text-center">'.$arrQuantity[$keyB].'</td>
                                    <td>'.number_format($arrQuantity[$keyB] * $arrPrice[$keyB]).'</td>
                                </tr>';
            }


            $discountValue = intval($arrVoucherValue);
            $discountName = '';
            if(isset($arrVoucherValue) && $arrVoucherValue > 0){
                $total = $totalPrice * (100 - $discountValue)/100;
                $discountName   = '<h3>Đơn hàng đã được giảm: '.$discountValue.'%</h3>';
            } else {
                $total = $totalPrice;
            }

            $priceDiscount = -$totalPrice * $discountValue / 100;
            $xhtml .= '<div id="fh5co-product">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 container">
                                    <div class="row animate-box fadeInUp animated-fast">
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                        
                                    <div id="system-message-container">'.$strMessage . $this->error.'</div>
                                            <h2>TRACKING ORDER</h2>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <strong>Order ID: ' . $cartId . '</strong></br>
                                        <strong>Payment Method: ' . $payment . '</strong></br>
                                        <strong>Time: ' . $date . '</strong></br>
                                        <strong>Status </br> <div style="display: flex; align-items: center; justify-content: center">' . $result . '</div></strong>
                                    </div>';
                                    if($cancel != 0){
                                        $xhtml .= '<br>
                                                        <div class="text-center">
                                                            ' . $policy . '
                                                        </div>';
                                    }
                                    
                                    $xhtml  .= '</br>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    ' . $tableContent . '
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 text-right border-bottom mb-5">
                                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <span class="text-black">Subtotal</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black">' . number_format($totalPrice) . '</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <span class="text-black">Coupon</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black">' . number_format($priceDiscount) . '</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <span class="text-black">Member</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black">' . number_format($memberDiscount) . '</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-6">
                                                <span class="text-black">Total</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black">' . number_format($totalPrice + $priceDiscount + $memberDiscount) . '</strong>
                                            </div>
                                        </div>';
                                        if($completed != 1 && $cancel == 0){
                                            $linkCancel          = URL::createLink('default', 'user', 'tracking', array('id' => $cartId), 'destroy-' . $cartId);
                                            $xhtml .= '<div class="col-md-10 col-md-offset-1">
                                                            <button style="width: 100%; padding: 15px" id="'.$cartId.'" type="button" onclick="javascript:geek(\''.$linkCancel.'\')" name="form[submit]" class="btn btn-danger" value="'.$cartId.'">
                                                                CANCEL ORDER
                                                            </button>
                                                     </div>';
                                        }
                                        $xhtml .= ' 
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>';

        }else{
            $xhtml = '<div id="fh5co-product">
            <div class="container">
                <div class="row animate-box fadeInUp animated-fast">
                    <div class="col-md-10 text-center fh5co-heading">
                        <h2>RESULT TRACKING</h2>
                        <span>YOU DO NOT HAVE ANY ORDER LIKE \''.$_POST['form']['id'].'\'</span>
                        <span>Click <a href="'.$linkShop.'">here</a> to buy</span>
                    </div>
                </div>
            </div>
        </div>';
        }
    }

?>

<!-- LIST ORDER -->

<div id="fh5co-user">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="fh5co-tabs animate-box">
                    <!-- Tabs -->
                    <div class="container">
                        <div class="fh5co-tab-content tab-content fh5co-tab-nav" style="background-color: transparent;">
                            <form action="#" method="post" name="adminForm" id="adminForm">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">ID Order</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="form[id]" type="text" value="<?php echo $_POST['form']['id']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="hidden" name="form[token]" value="<?php echo time();?>">
                                        <input type="submit" name="form[submit]" class="btn btn-primary" value="Tracking">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                        

                </div>
                
            </div>
             <div class="container">
                        <div class="row">
                            <?php echo $xhtml?>
                        </div>
                    </div>
        </div>
    </div>
</div>
<script>
        function geek(url) {
           $.confirm({
                title: 'Confirm!',
                content: 'Do you want to cancel this Order!',
                buttons: {
                    confirm: function () {
                        $('#adminForm').attr('action', url);
                        $('#adminForm').submit();
                    },
                    cancel: function () {
                    },
                }
            });
        }
        function policy() {
           $.alert({
                title: 'Return and Refund Policy',
                content: 'Contact Administrator to Get Help!',
            });
        }
       
       
    </script>



