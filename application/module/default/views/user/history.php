<?php
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'user', 'history'));

    $linkShop          = URL::createLink('default', 'product', 'shop', array('category_id' => '1-2'), 'diningroom');
    $xhtml = '';
    if(!empty($this->Items)){
        foreach($this->Items as $key => $value){
            $i = (1 * $this->pagination->totalItemPerPage * ($this->pagination->currentPage - 1) + 1);
            $memberDiscount = $value['memberDiscount'];
            $cartId			= $value['id'];
            $payment		= $value['payment'];
            $status         = $value['status'];
            $completed      = $value['completed'];
            $cancel         = $value['cancel'];
            if($cancel == 1){
                $result = '<img width="120" height="120" src="'.$imageURL.'/cancel_step_1.png">
                                   <div style="width: 20%;">
                                        <p style="margin-bottom: 0">Sent Request</p>
                                        <hr style="border: 1px solid black; margin: 0px">
                                   </div>                     
                                   <img width="135" height="118" src="'.$imageURL.'/cancel_step_2.png">';
                $policy = '<p>
                            <small style="cursor: pointer" href="#" onclick="javascript:policy()" class="text-primary">Return & Refund Privacy <i class="fa-solid fa-circle-question"></i></small>
                        </p>';
            } elseif($cancel == 2){
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
            } else{
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
            

            $date			    = date("H:i:s d/m/Y", strtotime($value['date']));
            $arrBookID		    = json_decode($value['products']);
            $arrPrice		    = json_decode($value['prices']);
            $arrName		    = json_decode($value['names']);
            $arrQuantity	    = json_decode($value['quantities']);
            $arrPicture		    = json_decode($value['pictures']);
            $tableContent	    = '';
            $voucher    	    = '';
            $totalPrice		    = 0;
            $total              = 0;

            $arrVoucherValue    = $value['value'];
            $arrVoucherName	    = $value['name'];


            foreach ($arrBookID as $keyB => $valueB){
                $name = URL::filterURL($arrName[$keyB]);
                $linkDetail		= URL::createLink('default', 'product', 'detail', array('product_id' => $valueB), $name.'-'.$valueB);

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
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="text-center">
                                            <strong style="color: #d1c286">No. '.(1 * $this->pagination->totalItemPerPage * ($this->pagination->currentPage - 1) + 1 + intval($key)).'</strong>
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
                                        </div>
                                    </div>';
                                    if($completed != 1 && $cancel == 0){
                                        $linkCancel          = URL::createLink('default', 'user', 'history', array('id' => $cartId), 'cancel-' . $cartId);
                                        $xhtml .= '<div class="col-md-10 col-md-offset-1">
                                                        <button style="width: 100%; padding: 15px" id="'.$cartId.'" type="button" onclick="javascript:geek(\''.$linkCancel.'\')" name="form[submit]" class="btn btn-danger" value="'.$cartId.'">
                                                            CANCEL ORDER
                                                        </button>
                                                 </div>';
                                    }
                                    $xhtml .= '    
                                </div>
                            </div>
                       </div>';
            $i++;
        }
    }else{
        $xhtml = '<div id="fh5co-product">
            <div class="container">
                <div class="row animate-box fadeInUp animated-fast">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>YOUR HISTORY ORDERS</h2>
                        <span>YOU DO NOT HAVE ANY ORDERS YET</span>
                        <span>Click <a href="'.$linkShop.'">here</a> to buy</span>
                    </div>
                </div>
            </div>
        </div>';
    }
    if ($this->pagination->currentPage == $this->pagination->totalPage)
        $totalPage = $this->pagination->totalItem;
    else
        $totalPage = $this->pagination->totalItemPerPage *  $this->pagination->currentPage;
    $itemFrom = ($this->pagination->currentPage - 1) * $this->pagination->totalItemPerPage + 1;
    $itemTo = $totalPage;
    $totalItem = $this->pagination->totalItem;
    $result = 'Showing '.$itemFrom . ' - ' . $itemTo . ' of ' . $this->totalItems .' Results';
    
    // MESSAGE
	$message	= Session::get('message');
	Session::delete('message');
	$strMessage = Helper::cmsMessagePublic($message);
?>

<!-- LIST ORDER -->



<div class="container">
    <form action="#" method="post" name="adminForm" id="adminForm">
            <div id="fh5co-product">
                <div class="container">
                    <div class="row animate-box">
                        <div class="col-md-8 col-md-offset-2 text-center">
                        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
                            <h2>DETAILS ORDER</h2>
                            <span><?php echo $result;?></span>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php echo $xhtml?>
                        </div>
                    </div>
                    
                    <input type="hidden" name="filter_page" value="1">
                    <?php
                    if($this->pagination->totalPage > 1)
                        echo $paginationHTML;
                    ?>
                </div>
            </div>
    </form>
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


