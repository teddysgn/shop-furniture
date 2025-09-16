<?php session_start();
$imageURL = '/shop/public/template/default/main/images';

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
        <link rel="shortcut icon" href="<?php echo $imageURL?>/logo/icon.png"/>
        <title>Create New Order</title>
        <!-- Bootstrap core CSS -->
        <link href="../vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="../vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
        <script src="../vnpay_php/assets/jquery-1.11.3.min.js"></script>
        <?php require_once 'block/link.php'?>
    </head>

    <body>
        <?php require_once("./config.php"); ?>
        <?php require_once 'block/header.php'?>
        <div id="fh5co-product">
            <div class="container">
            <h3>CREATE TRANSACTION</h3>
                <div class="table-responsive">
                    <form action="../vnpay_php/vnpay_create_payment.php" id="frmCreateOrder" method="post">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control" readonly type="text" value="<?php echo number_format($_SESSION['totalValueOrder'])?>" />
                            <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" name="amount" type="hidden" value="<?php echo $_SESSION['totalValueOrder']?>" />
                        </div>
                         <h4>SELECT YOUR OPTION</h4>
                        <div class="form-group">
                            <h5>Option 1: Redirect to VNPAY center and choose option</h5>
                           <input type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                           <label for="bankCode">Cổng thanh toán VNPAYQR</label><br>

                           <h5>Option 2: Choose exactly option below</h5>
                           <input type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
                           <label for="bankCode">VNPAY App</label><br>

                           <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
                           <label for="bankCode">ATM Card/Domestic Account</label><br>

                           <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
                           <label for="bankCode">Visa Card</label><br>

                        </div>
                        <div class="form-group">
                            <h5>Choose Language:</h5>
                             <input type="radio" id="language" Checked="True" name="language" value="vn">
                             <label for="language">Tiếng việt</label><br>
                             <input type="radio" id="language" name="language" value="en">
                             <label for="language">English</label><br>
                        </div>
                        <button type="submit" class="btn btn-primary btn-outline" href>Purchase</button>
                    </form>
                </div>
                <p>
                    &nbsp;
                </p>

            </div>
        <?php require_once 'block/footer.php'?>
    </body>
</html>
<style>
    .container input[type="radio"] {
        position: relative;
        opacity: 1;
        cursor: pointer;
    }
</style>
