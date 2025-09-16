<?php
session_start();
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
        <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>

        <?php require_once 'block/link.php' ?>
    </head>

    <body>
    <?php require_once 'block/header.php' ?>
    <div id="fh5co-product">
    <div class="container text-center">
           <div class="header clearfix">

                <h3 class="text-muted">VNPAY DEMO</h3>
            </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-outline" onclick="pay()">Giao dịch thanh toán</button><br>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-outline" onclick="querydr()">API truy vấn kết quả thanh toán</button><br>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-outline" onclick="refund()">API hoàn tiền giao dịch</button><br>
                </div>
            <p>
                &nbsp;
            </p>
        </div>
    </div>
        <?php require_once 'block/footer.php' ?>
    <script>
         function pay() {
          window.location.href = "../vnpay_php/vnpay_pay.php";
        }
        function querydr() {
          window.location.href = "/vnpay_php/vnpay_querydr.php";
        }
         function refund() {
          window.location.href = "/vnpay_php/vnpay_refund.php";
        }
    </script>
    </body>
</html>
