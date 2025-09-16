<?php
    $message    = '';
    switch ($this->arrParams['type']){
        case 'register-success':
            $message = 'You created a new account. Please Login and Activate this!';
            break;
        case 'not-permission':
            $message = 'You do not have permission to access this resource';
            $h1 = 'Access Denied';
            break;
        case 'not-url':
            $message = 'This is not a fault, just an accident that was not intentional.';
            $h1 = '404 - Page Not Found';
            break;
        case 'buy-success':
            Session::delete('code');
            Session::delete('information');
            Session::delete('Total');
            Session::delete('order');
            Session::delete('idCart');
            Session::delete('fullname');
            Session::delete('phone');
            Session::delete('address');
            Session::delete('ResultBanking');
            $message = 'Đơn hàng của bạn đã được xác nhận thành công! Click vào <a href="index.php?module=default&controller=user&action=history">đây</a> để xem lại lịch sử mua hàng';
            break;
    }
?>
<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(<?php echo $imageURL?>/deny_access.jpg); background-size: cover; background-position: top">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="display-t">
                    <div class="display-tc animate-box fadeIn animated-fast" data-animate-effect="fadeIn">
                        <h1><?php echo $h1?></h1>
                        <h2><?php echo $message?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
