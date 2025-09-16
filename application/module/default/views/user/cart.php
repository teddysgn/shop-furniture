<?php
    $linkShop               = URL::createLink('default', 'product', 'shop', array('category_id' => '1-2'), 'diningroom');;
    $linkCheckCode          = URL::createLink('default', 'user', 'cart', null, 'cart');
    $linkSubmitCart         = URL::createLink('default', 'user', 'buy');
    $linkSubmitMobile       = URL::createLink('default', 'user', 'banking');
    $linkSubmitMoMo         = URL::createLink('default', 'user', 'momo');
    $linkUpdate             = URL::createLink('default', 'user', 'update');

    $user                   = Session::get('user');
    $member                 = $this->member['discount'];

    if(!empty($this->Items)){
            $xhtml      = '';
            $totalPrice	= 0;
            $coupon    = intval($this->Coupon['value']);

            $i = 0;
            foreach ($this->Items as $key => $value){
                $nameLink           = URL::filterURL($value['name']);
                $linkDetailProduct	= URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), $nameLink.'-'.$value['id']);
                $name			    = $value['name'];
                $price			    = number_format($value['price']);
                $priceTotal		    = number_format($value['totalprice']);
                $quantity		    = $value['quantity'];
                $id		            = $value['id'];
                $stock              = $value['stock'];

                $linkDeleteAll  = URL::createLink('default', 'user', 'deleteAll', null, 'deleteAll');

                $totalPrice		+= $value['totalprice'];

                // Phần hình ảnh
                $picturePath	= UPLOAD_PATH . 'product' . DS . $name . DS . $value['picture1'];
                if(file_exists($picturePath)==true){
                    $picture	= '<img  width="180" width="240" src="'. UPLOAD_URL . 'product' . DS . $name . DS . $value['picture1'].'">';
                }else{
                    $picture	= '<img width="180" width="240" src="'. UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
                }

                $inputBookID	= Helper::cmsInput('hidden', 'form[product_id][]', 'input_product_' . $value['id'],  $value['id']);
                $inputQuantity	= Helper::cmsInput('hidden', 'form[quantity][]', 'input_quantity_' . $value['id'],  $value['quantity']);
                $inputPrice		= Helper::cmsInput('hidden', 'form[price][]', 'input_price_' . $value['id'],  $value['price']);
                $inputStock		= Helper::cmsInput('hidden', 'form[stock][]', 'input_stock_' . $value['id'],  $value['stock']);
                $inputName		= Helper::cmsInput('hidden', 'form[name][]', 'input_name_' . $value['id'],  $value['name']);
                $inputPicture	= Helper::cmsInput('hidden', 'form[picture1][]', 'input_picture1_' . $value['id'],  $value['picture1']);


                $linkAdd        = URL::createLink('default', 'user', 'add', array('id' => $id));
                $linkMinus      = URL::createLink('default', 'user', 'minus', array('id' => $id));

                $xhtml	.= ' <tr>
                                <td>
                                    <a href="' . $linkDetailProduct . '">
                                        ' . $picture . '
                                    </a>
                                </td>
                                <td>' . $name . '</td>
                                <td>' . $price . '</td>
                                <td>
                                    <div class="text-center d-flex" style="display: flex;">
                                        <input class="form-control" type="number" min="1" max="'.$stock.'" value="'.$quantity.'" name="quantity['.$id.']">                           
                                    </div>
                                </td>
                                <td>' . $priceTotal . '</td>
                                <td class="text-center">
                                    <a href="index.php?module=default&controller=user&action=delete&id='.$id.'">Delete</a>
                                </td>
                            </tr>';
                $xhtml	.= $inputBookID . $inputPrice . $inputQuantity . $inputName . $inputPicture;
                $i++;
                $priceDiscount = -$totalPrice * $coupon / 100;
                $memberDiscount = -$totalPrice * $member / 100;
                Session::set('totalPrice', $priceDiscount);
            }


    ?>


        <div class="container">
            <div id="fh5co-product">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="container">
                            <div class="fh5co-tabs animate-box">
                            <ul class="fh5co-tab-nav">
                                <li style="width: 100%" class="active"><a href="#" data-tab="1"><span>DETAILS CART</span></a></li>
                            </ul>
    
                            <!-- Tabs -->
                            <div class="fh5co-tab-content-wrap">
                                <form action="#" method="POST" name="adminForm" id="adminForm">
                                    <div class="fh5co-tab-content tab-content active" data-tab-content="1">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>
                                                            <th width="15%" class="text-center">
                                                                <a href="<?php echo $linkDeleteAll ?>">Delete All</a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php echo $xhtml; ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input onclick="javascript:submitForm('<?php echo $linkUpdate;?>')" style="background-color: #d1c286" value="Update Cart" class="form-control btn btn-primary ">
                                            <div class="row justify-content-end">
                                                <div class="col-md-12">
                                                    <form action="<?php echo $linkCheckCode?>">
                                                        <div class="col-md-8" style="padding: 8px; margin: 1em 0">
                                                            <!-- <label for="fname">First Name</label> -->
                                                            <?php
                                                                Session::set('couponCode', $_POST['form']['code']);
                                                                $couponMessage = '';
                                                                if(isset($this->Coupon['value']) && isset($_POST['form']['code']))
                                                                    $couponMessage = 'You save ' . $this->Coupon['value'] . '%';
                                                                elseif($_POST['form']['code'] != '')
                                                                    $couponMessage = 'Your Coupon is not exist';
                                                            ?>
                                                            <input type="text" name="form[code]" value="<?php echo $_SESSION['couponCode']?>" id="code" class="inputbox form-control" size="40">
                                                            <input style="background-color: transparent; border: none" type="text" readonly value="<?php echo $couponMessage?>" class="inputbox form-control" size="40">
    
                                                        </div>
                                                        <div class="col-md-4" style="padding: 8px; margin: 1em 0"
                                                        ">
                                                        <!-- <label for="fname">First Name</label> -->
                                                        <input type="submit" style="background-color: #d1c286" value="Check" class="form-control btn btn-primary ">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                                <strong class="text-black"><?php echo number_format($totalPrice) ?></strong>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <span class="text-black">Coupon</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black"><?php echo number_format($priceDiscount); Session::set('discountValue', $priceDiscount)?></strong>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-6">
                                                <span class="text-black">Member</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black"><?php echo number_format($memberDiscount); Session::set('memberDiscount', $memberDiscount) ?></strong>
                                            </div>
                                        </div>
                                        <div class="row mb-5 fh5co-heading">
                                            <div class="col-md-6">
                                                <span class="text-black">Total</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black"><?php echo number_format($totalPrice + $priceDiscount + $memberDiscount); Session::set('totalValueOrder', $totalPrice + $priceDiscount + $memberDiscount) ?></strong>
                                            </div>
                                        </div>
                                        <h2 style="text-align: center">YOUR INFORMATION</h2>
                                        </br>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="form[fullname]" type="text" value="<?php echo $user['info']['fullname']?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="form[phone]" type="text" value="<?php echo $user['info']['phone']?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="form[address]" type="text" value="<?php echo $user['info']['address']?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
    
                                <div id="fh5co-product">
                                    <form action="<?php echo $linkSubmitCart;?>" method="POST" name="adminForm" id="adminForm"  enctype="application/x-www-form-urlencoded">
                                        <div class="col-md-4" style="margin-bottom: 2em">
                                            <input onclick="javascript:submitForm('<?php echo $linkSubmitCart;?>')" style="width: 100%" class="btn btn-primary btn-outline btn-lg" value="Cash on Dilivery">
                                        </div>
                                        <div class="col-md-4" style="margin-bottom: 2em">
                                            <input style="width: 100%" onclick="javascript:submitForm('<?php echo $linkSubmitMobile;?>')" class="btn btn-primary btn-outline btn-lg" value="Mobile Banking">
                                        </div>
                                        <div class="col-md-4" style="margin-bottom: 2em">
                                            <input style="width: 100%" onclick="javascript:submitForm('<?php echo $linkSubmitMoMo;?>')" class="btn btn-primary btn-outline btn-lg" value="MoMo Banking">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    <?php
    } else{
        ?>
        <div id="fh5co-product">
            <div class="container">
                <div class="row animate-box fadeInUp animated-fast">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>DETAIS CART</h2>
                        <span>Nothing in your cart</span>
                        <span>Click <a href="<?php echo $linkShop?>">here</a> to buy</span>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

