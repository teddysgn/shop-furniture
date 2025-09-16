<?php
    $linkLogout     = URL::createLink('admin'   , 'index', 'logout');
    $linkSite       = URL::createLink('default' , 'index', 'index');

    $model 	= new Model();

    if(isset($_SESSION['user'])){
        $id = $_SESSION['user']['info']['id'];
        $linkProfile    = URL::createLink('admin'   , 'user', 'profile', array('id' => $id));
        
        $time = time();
        $url = $_SERVER['REQUEST_URI'];
        $update	= "UPDATE `user` SET `url` = '$url', `time` = $time WHERE `id` = $id";
        $model->query($update);
    };

    $queryRequest	    = "SELECT COUNT(`id`) AS `total` FROM `".TBL_REQUEST."`";
    $listRequest	    = $model->fetchRow($queryRequest);
    if($listRequest['total'] > 0)
        $newRequest = ' <small class="badge float-right badge-light">'.$listRequest['total'].' News</small>';


    $queryBecome	    = "SELECT COUNT(`id`) AS `total` FROM `".TBL_BECOME."`";
    $listBecome	        = $model->fetchRow($queryBecome);
    if($listBecome['total'] > 0)
        $newBecome = ' <small class="badge float-right badge-light">'.$listBecome['total'].' News</small>';


    $arrMenu	= array(
        array('link' => URL::createLink('admin', 'user', 'index')		, 'name' => 'User'		        , 'class' => 'fa-solid fa-user'                 , 'group' => 'AdminUser'        , 'new' => null         , 'intro' => 'Manage User & Account'),
        array('link' => URL::createLink('admin', 'group', 'index')	    , 'name' => 'Group'	            , 'class' => 'fa-solid fa-user-group'           , 'group' => 'AdminGroup'       , 'new' => null         , 'intro' => 'Manage Group'),
        array('link' => URL::createLink('admin', 'product', 'index')	, 'name' => 'Product'		    , 'class' => 'fa-solid fa-tag'                  , 'group' => 'AdminProduct'     , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'category', 'index')	, 'name' => 'Category'		    , 'class' => 'fa-solid fa-tags'                 , 'group' => 'AdminCategory'    , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'collection', 'index')	, 'name' => 'Collection'		, 'class' => 'fa-solid fa-sitemap'              , 'group' => 'AdminCollection'  , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'designer', 'index')	, 'name' => 'Designer'		    , 'class' => 'fa-solid fa-handshake-simple'     , 'group' => 'Admin'            , 'new' => $newBecome),
        array('link' => URL::createLink('admin', 'coupon', 'index')		, 'name' => 'Coupon'	        , 'class' => 'fa-solid fa-percent'              , 'group' => 'Dashboard'        , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'order', 'index')		, 'name' => 'Order'	            , 'class' => 'fa-solid fa-cart-shopping'        , 'group' => 'Dashboard'        , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'request', 'index')	    , 'name' => 'Request'		, 'class' => 'fa-solid fa-spinner'              , 'group' => 'Admin'            , 'new' => $newRequest) ,
        array('link' => URL::createLink('admin', 'cost', 'index')	    , 'name' => 'Cost'		        , 'class' => 'fa-solid fa-dollar-sign'          , 'group' => 'Admin'            , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'sku', 'index')	    , 'name' => 'SKU'		        , 'class' => 'fa-solid fa-barcode'              , 'group' => 'Admin'            , 'new' => null         , 'intro' => 'Fill in this field'),
        array('link' => URL::createLink('admin', 'comment', 'index')    , 'name' => 'Comment'		    , 'class' => 'fa-regular fa-comment'             , 'group' => 'Admin'            , 'new' => null         , 'intro' => 'Fill in this field'),
        );
    $xhtml .= '<li>
                   <a href="'.URL::createLink('admin', 'dashboard', 'index').'" data-intro="Statistic Revenue & Profit" data-title="Dashboard" data-position="right">
                       <i class="fa-solid fa-chart-pie"></i> <span>Dashboard</span>
                   </a>
               </li>';
    $group = $_SESSION['user']['info']['name'];
    if($group == 'Admin'){
        foreach($arrMenu as $key => $value){
            $xhtml .= '<li>
                           <a href="'.$value['link'].'" data-intro="'.$value['intro'].'" data-title="'.$value['name'].'" data-position="right">
                               <i class="'.$value['class'].'"></i> <span>'.$value['name'].'</span>
                               '.$value['new'].'
                               
                           </a>
                       </li>';
        }
    }


    if($group == 'AdminProduct')
        $xhtml .= '<li>
                       <a href="'.URL::createLink('admin', 'product', 'index').'">
                           <i class="zmdi zmdi-label"></i> <span>Product</span>
                       </a>
                   </li>';
    if($group == 'AdminCategory')
        $xhtml .= '<li>
                       <a href="'.URL::createLink('admin', 'category', 'index').'">
                           <i class="zmdi zmdi-labels"></i> <span>Category</span>
                       </a>
                   </li>
                   <li>
                       <a href="'.URL::createLink('admin', 'product', 'index').'">
                           <i class="zmdi zmdi-label"></i> <span>Product</span>
                       </a>
                   </li>';

    if($group == 'AdminUser')
        $xhtml .= '<li>
                           <a href="'.URL::createLink('admin', 'user', 'index').'">
                               <i class="zmdi zmdi-account"></i> <span>Product</span>
                           </a>
                       </li>';
    if($group == 'AdminGroup')
        $xhtml .= '<li>
                           <a href="'.URL::createLink('admin', 'group', 'index').'">
                               <i class="zmdi zmdi-accounts-alt"></i> <span>Group</span>
                           </a>
                       </li>
                       <li>
                           <a href="'.URL::createLink('admin', 'user', 'index').'">
                               <i class="zmdi zmdi-account"></i> <span>Product</span>
                           </a>
                       </li>';
    if($group == 'AdminCoupon')
        $xhtml .= '<li>
                               <a href="'.URL::createLink('admin', 'coupon', 'index').'">
                                   <i class="fa-solid fa-ticket"></i> <span>Coupon</span>
                               </a>
                           </li>';
    if($group == 'AdminCollection')
        $xhtml .= '<li>
                                   <a href="'.URL::createLink('admin', 'collection', 'index').'">
                                       <i class="zmdi zmdi-collection-text"></i> <span>Coupon</span>
                                   </a>
                               </li>';
    if($group == 'AdminDesigner')
        $xhtml .= '<li>
                                       <a href="'.URL::createLink('admin', 'designer', 'index').'">
                                           <i class="zmdi zmdi-face"></i> <span>Coupon</span>
                                       </a>
                                   </li>';
    if($group == 'AdminOrder')
        $xhtml .= '<li>
                               <a href="'.URL::createLink('admin', 'Order', 'index').'">
                                   <i class="fa-solid fa-cart-shopping"></i> <span>Order</span>
                               </a>
                           </li>';

    $xhtml .= '<li>
                       <a href="'.URL::createLink('admin', 'user', 'profile', array('id' => $_SESSION['user']['info']['id'])).'">
                           <i class="fa-solid fa-circle-info"></i> <span>Profile</span>
                       </a>
                   </li>
                   <li>
                       <a href="'.URL::createLink('admin', 'index', 'logout').'">
                           <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
                       </a>
                   </li>';
?>
<div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
        <div class="loader-wrapper-inner" >
            <div class="loader">

            </div>
        </div>
    </div>
</div>
<!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">

    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
        <div class="brand-logo">
            <a href="index.html">
                <img style="width: 50%; padding-top: 10px" src="<?php echo $imageURL?>/logo/logo_white.png"  alt="logo icon">

            </a>
        </div>
        <ul class="sidebar-menu do-nicescrol">
          <?php echo $xhtml;?>
        </ul>

    </div>
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link toggle-menu" href="javascript:void();">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">
                <li class="nav-item dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" href="<?php echo $linkSite;?>"">
                    <i class="fa-solid fa-globe"></i></a>
                </li>
                <li class="nav-item dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" href="<?php echo $linkLogout;?>"">
                        <i class="fa-solid fa-right-from-bracket"></i></a>
                </li>
                <li class="nav-item dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                        <i class="fa fa-envelope-open-o"></i></a>
                </li>
                <li class="nav-item dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                        <i class="fa fa-bell-o"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="<?php echo $imageURL?>/logo/icon.png" class="img-circle" alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="<?php echo $linkProfile?>">
                                <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" src="<?php echo $imageURL?>/logo/icon.png"  alt="user avatar"></div>
                                    <div class="media-body">
                                        <h6 class="mt-2 user-title"><?php echo $id = $_SESSION['user']['info']['fullname']?></h6>
                                        <p class="user-subtitle"><?php echo $id = $_SESSION['user']['info']['email']?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><a href="<?php echo $linkProfile?>"><i class="zmdi zmdi-account"></i>&nbsp; Account</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><a href="<?php echo $linkLogout?>"><i class="fa-solid fa-right-from-bracket"></i>  Logout</a></li>
                        <li class="dropdown-divider"></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!--End topbar header-->
    <style>
        .sidebar-menu .fa-solid {
            width: 20.75px;
            height: 18.4px;
        }
    </style>