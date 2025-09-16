<div class="feat_prod_box_details">

    <?php
    $linkSubimtForm	    = URL::createLink('formdefault', 'user', 'buy');
    $linkShop           = URL::createLink('default', 'product', 'shop', array('category_id' => '1-2'), 'diningroom');;
    $block = 'You do not have any orders yet';
    if(!empty($this->Items)){
        $xhtml      = '';
        $totalPrice	= 0;
        $voucher    = $this->Result['value'];

        foreach ($this->Items as $key => $value){
            $linkDetailProduct	= URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), URL::filterURL($value['name']) . $value['id']);
            $name			    = $value['name'];
            $price			    = number_format($value['price']);
            $priceTotal		    = number_format($value['totalprice']);
            $quantity		    = $value['quantity'];
            $id		            = $value['id'];
            $stock              = $value['stock'];

            $totalPrice		+= $value['totalprice'];
            $xhtml	.= '<tr>
                                <td style="border: solid black 1px; text-align: center">'.$id.'</td>
                                <td style="border: solid black 1px; text-align: center">'.$name.'</td>
                                <td style="border: solid black 1px; text-align: center">'.$price.'</td>
                                <td style="border: solid black 1px; text-align: center">'.$quantity.'</td>
                                <td style="border: solid black 1px; text-align: center">'.$priceTotal.'</td>
                            </tr>';

        }

        $priceDiscount  = Session::get('totalPrice');
        $memberDiscount = Session::get('memberDiscount');



        echo $block = '<div id="fh5co-product">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                    <h1 class="text-center">THANKS FOR  YOUR ORDER</h1>
                                    <div class="row animate-box fadeInUp animated-fast">
                                        <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                                            <h2>This is your DETAIlS ORDER</h2>
                                            <span>Please Check  <a href="https://mail.google.com">your gmail</a> to see</span>
                                            <span>Or see in  <a href="https://hoangvupcx.com/shop/history">your profile</a></span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <strong>Order ID: ' . $_SESSION['idCart'] . '</strong></br>
                                        <strong>Time: ' . date('Y-m-d H:i:s', time()) . '</strong></br>
                                        <strong>Payment Method: '.Session::get('method').'</strong>
                                    </div>
                                    </br>
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
                                            ' . $xhtml . '
                                        </tr>
                                        </tbody>
                                    </table>
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
                                </div>
                            </div>
                            </div>
                       </div>';
        $flag = true;
        ?>
        <?php
    } else{
        ?>
        <div id="fh5co-product">
            <div class="container">
                <div class="row animate-box fadeInUp animated-fast">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>DETAIlS CART</h2>
                        <span>Nothing in your cart</span>
                        <span>Click <a href="<?php echo $linkShop?>">here</a> to buy</span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
    include "PHPMailer-master/src/PHPMailer.php";
    include "PHPMailer-master/src/Exception.php";
    include "PHPMailer-master/src/POP3.php";
    include "PHPMailer-master/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $infoAccount    = $this->infoAccount;
    $email          = $infoAccount['email'];
    $fullname       = $infoAccount['fullname'];

    $mail           = new PHPMailer(true);
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
        $mail->Subject = 'Thank you for your Order';
        $mail->Body    = '';
        $body = "$block";
        $mail->msgHTML($body);

        if($flag)
            $mail->send();
    } catch (Exception $e) {
        echo '<div class="container">
                <div class="alert alert-danger">Message could not be sent.</div>',
            '<div class="alert alert-danger">Mailer Error: '.$mail->ErrorInfo.'</div> '
            .'</div>';
    }
    Session::delete('cart');
    Session::delete('form');
    Session::delete('totalPrice');
    Session::delete('totalValueOrder');
    Session::delete('fullname');
    Session::delete('phone');
    Session::delete('discountValue');
    Session::delete('idCart');
    Session::delete('couponCode');
    Session::delete('info');
    ?>
</div>
