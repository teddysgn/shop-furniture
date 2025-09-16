<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../vnpay_php/PHPMailer-master/src/PHPMailer.php';
include '../vnpay_php/PHPMailer-master/src/Exception.php';
include '../vnpay_php/PHPMailer-master/src/POP3.php';
include '../vnpay_php/PHPMailer-master/src/SMTP.php';

$imageURL = '/shop/public/template/default/main/images';
if( $_GET['vnp_ResponseCode'] == '00'){
    error_reporting(0);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    function randomString($length = 5){

        $arrCharacter = array_merge(range('a','z'), range(0,9), range('A','Z'));
        $arrCharacter = implode("", $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result		  = substr($arrCharacter, 0, $length);
        return $result;
    }




    // Connect Database
    $link = mysqli_connect('193.203.166.146', 'u580409902_nguyenhoangvu', 'Nguyenhoangvu@123', 'u580409902_shop');
    if(!$link) {
        die('Connect failed!'.mysqli_error());
    }

    $user           = $_SESSION['user'];
    $email          = $user['info']['email'];
    $fullname       = $user['info']['fullname'];
    $cart	        = $_SESSION['cart'];

    // Create ID Order
    $id			    = randomString(7);
    $_SESSION['idCart'] = $id;

    if(isset($_SESSION['ID']))
        $payment = 'Mobile banking';



    // Get ID Voucher to Update `used` and `quantity`
    $code = $_SESSION['couponCode'];
    $valueCode = 0;
    if(isset($code)) {
        $queryVoucher[] = "SELECT `id`, `name`, `code`, `value`, `status`, `quantity`, `used` ";
        $queryVoucher[] = "FROM `coupon`";
        $queryVoucher[] = "WHERE `code` = '" . $code . "' AND `status` = 1 AND `quantity` > 0";
        $queryVoucher   = implode(" ", $queryVoucher);
        $resultVoucher = mysqli_query($link, $queryVoucher);
        if(mysqli_num_rows($resultVoucher) > 0) {
            while ($row = mysqli_fetch_row($resultVoucher)) {
                $idCode = $row[0];
                $quantityCode = $row[5];
                $usedCode = $row[6];
                $valueCode = $row[3];
            }
        }
    }

    // Get
    if(!empty($cart)){
        $ids	= "(";
        foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
        $ids	.= " '0')" ;

        $queryProduct[]	= "SELECT `id`, `name`, `picture1`, `stock`, `sold`, `sale_off`, `price` ";
        $queryProduct[]	= "FROM `product`";
        $queryProduct[]	= "WHERE `status`  = 1 AND `id` IN $ids";
        $queryProduct[]	= "ORDER BY `ordering` ASC";

        $queryProduct	= implode(" ", $queryProduct);
        $resultProduct  = mysqli_query($link, $queryProduct);

        // Get Information User to Send Mail
        $username       = $user['info']['username'];
        $user_id        = $user['info']['id'];
        $phone          = '0'.$_SESSION['info']['phone'];
        $customer       = $_SESSION['info']['fullname'];
        $address        = $_SESSION['info']['address'];
        $memberDiscount = $_SESSION['memberDiscount'];
        $date		    = date('Y-m-d H:i:s', time());
        $payment        = 'Mobile banking';
        $invoice        = $_GET['vnp_TransactionNo'];

        $products       = '';
        $name           = '';
        $pictures       = '';
        $prices         = '';
        $quantities     = '';
        $totalQuantity  = 0;
        $totalPrice     = 0;
        $profit         = 0;

        if(mysqli_num_rows($resultProduct) > 0) {
            while ($row = mysqli_fetch_all($resultProduct)) {
                foreach($row as $key => $value){
                    if($row[$key][5] > 0){
                        $row[$key][6] = (100-$row[$key][5]) * $row[$key][6]/100;
                    }else{
                        $row[$key][6]	= $row[$key][6];
                    }
                    $products       .= ', '. json_encode($row[$key][0]);
                    $pictures       .= ', '. json_encode($row[$key][2]);
                    $names          .= ', '. json_encode($row[$key][1]);
                    $prices         .= ', '. json_encode($row[$key][6]);
                    $quantities     .= ', "'. json_encode($cart['quantity'][$value[0]]) . '"';
                    $totalQuantity  += $cart['quantity'][$value[0]];
                    $totalPrice     += $cart['price'][$value[0]];
                    $stock          = $row[$key][3] - $cart['quantity'][$value[0]];
                    $idStock        = $row[$key][0];
                    $sold           = $row[$key][4] + $cart['quantity'][$value[0]];
                    $updateProduct  = "UPDATE `product` SET `stock` = $stock, `sold` = $sold WHERE `id` = $idStock";
                    mysqli_query($link, $updateProduct);
                }
            }
        }

        $products = '[' . substr($products , 2) . ']';
        $pictures = '[' . substr($pictures , 2) . ']';
        $names = '[' . substr($names , 2) . ']';
        $prices = '[' . substr($prices , 2) . ']';
        $quantities = '[' . substr($quantities , 2) . ']';

        $totalPrice = $totalPrice - intval($valueCode) * $totalPrice / 100 + $memberDiscount;
        $profit = $totalPrice - array_sum($_SESSION['cart']['cost']);
        // Create Order
        $query	= "INSERT INTO `order`(`id`, `user_id`, `username`, `products`, `profit`, `prices`, `totalPrice`, `totalQuantity`, `quantities`, `names`, `pictures`, `status`, `completed`, `date`, `coupon_id`, `payment`, `invoice`, `customer`, `address`, `phone`, `memberDiscount`)
					VALUES ('$id', '$user_id', '$username', '$products', '$profit', '$prices', '$totalPrice', '$totalQuantity', '$quantities', '$names', '$pictures', '0', '0', '$date', '$idCode', '$payment', '$invoice', '$customer', '$address', '$phone',$memberDiscount)";
        mysqli_query($link, $query);

        // Update Coupon
        $quantityCoupon = $quantityCode;
        $usedCoupon     = $usedCode;
        $queryUpdate = "UPDATE `coupon` SET `quantity` = $quantityCoupon - 1, `used` = $usedCoupon + 1 WHERE `code` = '$code'";
        mysqli_query($link, $queryUpdate);


        // Add Notice
        $queryNotice = "INSERT INTO `notice` (`name`, `time`, `user_id`) VALUES ('Have just placed an order', '$date', '$user_id')";
        mysqli_query($link, $queryNotice);
    }


    // Get Information Cart
    if(!empty($cart)) {
        $ids = "(";
        foreach ($cart['quantity'] as $key => $value) $ids .= "'$key', ";
        $ids .= " '0')";

        $query = "SELECT `id`, `name`, `picture1`, `price`, `sale_off` ";
        $query .= "FROM `product`";
        $query .= "WHERE `status`  = 1 AND `id` IN $ids";
        $query .= "ORDER BY `ordering` ASC";


        $resultQuery = mysqli_query($link, $query);
        if(mysqli_num_rows($resultQuery) > 0) {
            while($row = mysqli_fetch_all($resultQuery)) {
                $totalPrice = 0;
                // Information Each Items
                foreach ($row as $key => $value) {
                    if($value[4] > 0){
                        $priceReal = (100-$value[4]) * $value[3]/100;
                    }else{
                        $priceReal	= $value[3];
                    }
                    $name			    = $value[1];
                    $quantity		    = $value['quantity'];
                    $id		            = $value['id'];
                    $priceProduct = $cart['quantity'][$value[0]] * $priceReal;
                    $totalPrice += $priceProduct;

                    $xhtml .= '
                            <tr>
                                <td style="border: solid black 1px; text-align: center">'.$name.'</td>
                                <td style="border: solid black 1px; text-align: center">'.number_format($priceReal).'</td>
                                <td style="border: solid black 1px; text-align: center">'.$cart['quantity'][$value[0]].'</td>
                                <td style="border: solid black 1px; text-align: center">'.number_format($priceProduct).'</td>
                            </tr>
                ';
                }
            }
        } else {
            echo 'No data found!';
        }

        // Information Cart to Send Mail
        $block = '<div id="fh5co-product" style="padding-bottom: 0">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-1">
                                            <h1 class="text-center">THANKS FOR  YOUR ORDER</h1>
                                            <div class="text-center">
                                                <strong>Order ID: ' . $_SESSION['idCart'] . '</strong></br>
                                                <strong>Time: ' . date('Y-m-d H:i:s', time()) . '</strong>
                                            </div>
                                            </br>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
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
                                                    <strong class="text-black">' . number_format($_SESSION['discountValue']) . '</strong>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <span class="text-black">Member</span>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <strong class="text-black">' . number_format($_SESSION['memberDiscount']) . '</strong>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <span class="text-black">Total</span>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <strong class="text-black">' . number_format($_SESSION['totalValueOrder']) . '</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                               </div>';
        $flag = true;
    }

$mail = new PHPMailer(true);
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
    $mail->Body = '';
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



?>


<?php
    unset($_SESSION['cart']);
    unset($_SESSION['totalPrice']);
    unset($_SESSION['totalValueOrder']);
    unset($_SESSION['fullname']);
    unset($_SESSION['address']);
    unset($_SESSION['phone']);
    unset($_SESSION['discountValue']);
    unset($_SESSION['idCart']);
    unset($_SESSION['couponCode']);
    unset($_SESSION['info']);
    unset($_SESSION['memberDiscount']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <link rel="shortcut icon" href="<?php echo $imageURL?>/logo/icon.png"/>
    <!-- Bootstrap core CSS -->
    <link href="../vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="../vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="../vnpay_php/assets/jquery-1.11.3.min.js"></script>

    <?php require_once 'block/link.php'?>
</head>
<body>
<div id="page">
    <?php require_once 'block/header.php'?>
    <?php
    require_once("./config.php");
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <?php echo $block;?>
    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box fadeInUp animated-fast">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>NOTIFICATION</h2>
                    <span><?php echo $error?></span>
                    <span>Click <a href="../index.php">here</a> to return</span>
                </div>
            </div>
        </div>
        <!--Begin display -->
        <div class="container text-center">
            <div class="header clearfix">
                <h1 class="text-center">PURCHASE RESPONSE</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td class="text-center">
                            <?php echo $_GET['vnp_TxnRef'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td class="text-center">
                            <?php echo number_format($_GET['vnp_Amount'] / 100) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td class="text-center">
                            <?php echo $_GET['vnp_OrderInfo'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Response Code</td>
                        <td class="text-center">
                            <?php echo $_GET['vnp_ResponseCode'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Transaction ID</td>
                        <td class="text-center">
                            <?php echo $_GET['vnp_TransactionNo'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>From Account</td>
                        <td class="text-center">
                            <?php echo $_GET['vnp_BankCode'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td class="text-center">
                            <?php
                            $date = $_GET['vnp_PayDate'];
                            $year = substr($date, 0, 4);
                            $month = substr($date, 4, 2);
                            $day = substr($date, 6, 2);
                            $hour = substr($date, 8, 2);
                            $minute = substr($date, 10, 2);
                            $second = substr($date, 12, 2);
                            echo $hour . ':' . $minute . ':' . $second . ' ' . $day . '/' . $month . '/' . $year;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Result</td>
                        <td class="text-center">
                            <?php

                            if ($secureHash == $vnp_SecureHash) {
                                if ($_GET['vnp_ResponseCode'] == '00') {
                                    echo "<span style='color:green'>Purchase Successfully</span>";
                                } else {
                                    echo "<span style='color:red'>Purchase Failed</span>";
                                }
                            } else {
                                echo "<span style='color:red'>Your sign is uncomfortable</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p>
                &nbsp;
            </p>

        </div>
    </div>
    <?php require_once 'block/footer.php'?>
</body>
</html>