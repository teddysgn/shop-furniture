<?php
$imageURL       = $this->_dirImg;
$model 	= new Model();
if(isset($_SESSION['user'])){
    $id = $_SESSION['user']['info']['id'];
    $time = time();
    $url = $_SERVER['REQUEST_URI'];
    $update	= "UPDATE `user` SET `url` = '$url', `time` = $time WHERE `id` = $id";
    $model->query($update);
};
?>

<header class="ts-header has-sticky">
    <div class="header-container">
        <div class="header-template">
            <div class="header-sticky">
                <div class="header-middle">
                    <div class="container">
                        <div class="header-left">
                            <div class="ts-sidebar-menu-icon">
                                <span class="icon"></span>
                            </div>

                            <div class="search-button search-icon">
                                <span class="icon"></span>
                            </div>

                        </div>

                        <div class="header-center">
                            <div class="logo-wrapper">
                                <div class="logo">
                                    <a href="builder">
                                        <img src="<?php echo $imageURL?>/logo/logo.png"
                                             alt="Nooni" title="Nooni" class="normal-logo"/>

                                        <img src="<?php echo $imageURL?>/logo/logo.png"
                                             alt="Nooni" title="Nooni" class="mobile-logo"/>

                                        <img src="<?php echo $imageURL?>/logo/logo.png"
                                             alt="Nooni" title="Nooni" class="sticky-logo"/>

                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="header-right">
                            <div class="my-account-wrapper hidden-phone">
                                <div class="ts-tiny-account-wrapper">
                                    <div class="account-control">
                                        <a class="my-account" href="index.php?module=designer&controller=user&action=index" title="My Account">My Account</a>
                                        <div class="account-dropdown-form dropdown-container" style="width: 100%">
                                            <div class="form-content">
                                                <ul>
                                                    <li style="list-style-type: none"><a class="my-account" href="index.php?module=designer&controller=user&action=index">Account</a></li>
                                                    <li style="list-style-type: none"><a class="log-out" href="index.php?module=designer&controller=index&action=logout">Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="vertical-menu-sidebar" class="vertical-menu-sidebar hidden-phone">
    <div class="ts-sidebar-content">
        <span class="close"></span>
        <div class="vertical-menu-wrapper">
            <?php
                $linkShop       = URL::createLink('designer', 'index', 'shop');
                $linkRequest    = URL::createLink('designer', 'index', 'request');
                $linkLogout     = URL::createLink('designer', 'index', 'logout');
                $linkUser       = URL::createLink('designer', 'user', 'index');
            ?>
            <nav class="vertical-menu"><ul id="menu-vertical-menu" class="menu">
                    <li id="menu-item-6004" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-6004 ts-normal-menu parent">
                        <a href="builder"><span class="menu-label">Home</span></a><span class="ts-menu-drop-icon"></span>
                        <ul class="sub-menu">
                            <li id="menu-item-5593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-5593">
                                <a href="<?php echo $linkShop?>"><span class="menu-label">Products</span></a></li>
                            <li id="menu-item-5593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-5593">
                                <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                        </ul>
                    </li>
                    <li id="menu-item-5930" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-5930 ts-normal-menu parent">
                        <a><span class="menu-label">User</span></a><span class="ts-menu-drop-icon"></span>
                        <ul class="sub-menu">
                            <li id="menu-item-6059" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6059">
                                <a href="<?php echo $linkUser?>"><span class="menu-label">Account</span></a></li>
                            <li id="menu-item-6060" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6060">
                                <a href="<?php echo $linkLogout?>"><span class="menu-label">Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Group Header Button -->
<div id="group-icon-header" class="ts-floating-sidebar">
    <div class="overlay"></div>
    <div class="ts-sidebar-content no-tab">

        <div class="sidebar-content">
            <div class="logo-wrapper">
                <div class="logo">
                    <a href="<?php echo $linkShop?>">
                        <img src="<?php echo $imageURL?>/logo/logo.png" loading="lazy" alt="Nooni" class="menu-mobile-logo" />
                    </a>
                </div>
            </div>

            <ul class="tab-mobile-menu">
                <li id="main-menu" class="active"><span>Menu</span></li>
                <li id="vertical-menu"><span>Categories</span></li>
            </ul>

            <h6 class="menu-title"><span>Menu</span></h6>

            <div class="mobile-menu-wrapper ts-menu tab-menu-mobile">
                <div class="menu-main-mobile">
                    <nav class="mobile-menu"><ul id="menu-mobile-menu" class="menu"><li id="menu-item-4097" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-4097 ts-normal-menu parent">
                                <a href="<?php echo $linkHome?>"><span class="menu-label">Home</span></a><span class="ts-menu-drop-icon"></span>
                                <ul class="sub-menu">
                                    <li id="menu-item-4096" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-4096">
                                        <a href="<?php echo $linkShop?>"><span class="menu-label">Products</span></a></li>
                                    <li id="menu-item-2301" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2301">
                                        <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                                </ul>
                            </li>
                            <li id="menu-item-2287" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-2287 ts-normal-menu parent">
                                <a href="<?php echo $linkShop?>"><span class="menu-label">Shop</span></a><span class="ts-menu-drop-icon"></span>
                                <ul class="sub-menu">
                                    <li id="menu-item-6093" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6093">
                                        <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                                    <li id="menu-item-4103" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4103">
                                        <a href="<?php echo $linkLogout?>"><span class="menu-label">Logout</span></a></li>
                                </ul>
                            </li>
                            <li id="menu-item-2308" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2308 ts-normal-menu">
                                <a href="<?php echo $linkDefault?>"><span class="menu-label">Default</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>


            <div class="group-button-header">
                <div class="meta-bottom">
                    <div class="my-account-wrapper">
                        <div class="ts-tiny-account-wrapper">
                            <div class="account-control">
                                <a class="login" href="<?php echo $linkUser?>" title="My Account">Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Search Sidebar -->

<div id="ts-search-sidebar" class="ts-floating-sidebar">
    <div class="overlay"></div>
    <div class="ts-sidebar-content">
        <div class="ts-search-by-category woocommerce">
            <div class="search--header">
                <h2 class="title">Search for products (<span class="count">0</span>)</h2>
                <span class="close"></span>
            </div>

            <div class="search--form">

                <form method="post" action="index.php?module=designer&controller=index&action=shop" id="searchform-742">
                    <div class="search-table">
                        <div class="search-field search-content">
                            <input type="text" value="" name="form[name]" placeholder="Search for products..." autocomplete="off" />
                        </div>
                        <div class="search-button">
                            <input type="submit" id="searchsubmit-742" value="Search" />
                        </div>
                    </div>
                </form>
            </div>

            <div class="ts-search-result-container"></div>
        </div>
    </div>
</div>
<div id="to-top" class="scroll-button">
    <a class="scroll-button" href="javascript:void(0)" title="Back to Top">Back to Top</a>
</div>
<style>

    .success {
        color: green
    }

    .error{
        color: red
    }
</style>