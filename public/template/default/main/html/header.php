<?php
    $model 	= new Model();

    if(isset($_SESSION['user'])){
        $id = $_SESSION['user']['info']['id'];
        $time = time();
        $url = $_SERVER['REQUEST_URI'];
        $update	= "UPDATE `user` SET `url` = '$url', `time` = $time WHERE `id` = $id";
        $model->query($update);
    };

    $queryCollection	= "SELECT `id`, `name` FROM `".TBL_COLLECTION."` WHERE `status`  = 1 ORDER BY `name` ASC";
    $listCollection	    = $model->fetchAll($queryCollection);
    $collection		    = '';
    if(!empty($listCollection)){
        foreach($listCollection as $key => $value){
            $name	    = $value['name'];
            $nameFilter = URL::filterURL($value['name']);
            $link	    = URL::createLink('default', 'product', 'collection', array('collection_id' => $value['id']), 'collection-'.$value['id']);
            $collection	.= '<li><a href="'.$link.'">'.$name.'</a></li>';
        }
    }

    $queryDesigner	    = "SELECT `id`, `name` FROM `".TBL_DESIGNER."` ORDER BY `name` ASC";
    $listDesigner	    = $model->fetchAll($queryDesigner);
    $designer		    = '';
    if(!empty($listDesigner)){
        foreach($listDesigner as $key => $value){
            $name	    = $value['name'];
            $nameFilter = URL::filterURL($value['name']);
            $link	    = URL::createLink('default', 'designer', 'info', array('designer_id' => $value['id']), $value['id'].'-designer-'.$nameFilter);
            $designer	.= '<li><a href="'.$link.'">'.$name.'</a></li>';
        }
    }

    $imageURL       = $this->_dirImg;
    $linkHome       = URL::createLink('default', 'index', 'index'   , null, 'index');
    $linkAbout      = URL::createLink('default', 'index', 'about'   , null, 'about');
    $linkService    = URL::createLink('default', 'index', 'service' , null, 'service');
    $linkContact    = URL::createLink('default', 'index', 'contact' , null, 'contact');
    $linkBlog       = URL::createLink('default', 'index', 'blog'    , null, 'blog');
    $linkCart       = URL::createLink('default', 'user' , 'cart'    , null, 'cart');
    $linkFavorite   = URL::createLink('default', 'user' , 'favorite', null, 'favorite');
    $linkUser       = URL::createLink('default', 'index', 'user'    , null, 'user');


    $linkDiningTable            = URL::createLink('default', 'product', 'shop', array('category_id' => 1), 'dining-tables');
    $linkDiningChair            = URL::createLink('default', 'product', 'shop', array('category_id' => 2), 'dining-chairs');
    $linkBedroomBed             = URL::createLink('default', 'product', 'shop', array('category_id' => 3), 'bed-beds');
    $linkBedroomDresserChest    = URL::createLink('default', 'product', 'shop', array('category_id' => 4), 'bed-dressers-chests');
    $linkBedroomNightstand      = URL::createLink('default', 'product', 'shop', array('category_id' => 5), 'bed-nighstands');
    $linkLivingSofa             = URL::createLink('default', 'product', 'shop', array('category_id' => 6), 'living-sofas');
    $linkLivingSectional        = URL::createLink('default', 'product', 'shop', array('category_id' => 7), 'living-sectionals');
    $linkLivingChair            = URL::createLink('default', 'product', 'shop', array('category_id' => 8), 'living-chairs');
    $linkLivingOttoman          = URL::createLink('default', 'product', 'shop', array('category_id' => 9), 'living-ottomans');

    $linkDesigner               = URL::createLink('default', 'designer', 'index', null, 'designers');
    $linkBuilder                = URL::createLink('designer', 'index', 'index');

    $controller     = $_GET['controller'];
    $action         = $_GET['action'];
    $URL            = $controller . '-' . $action;

?>


    <nav class="fh5co-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-3">
                    <div id="fh5co-logo"><a href="<?php echo $linkHome;?>"><img id="image-header" src="<?php echo $imageURL?>/logo/logo.png" alt=""></a></div>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-8 text-center menu-1">
                    <ul>
                        <li <?php if($URL == 'index-index') echo 'class="active"'?>>
                            <a href="<?php echo $linkHome;?>">Home</a>
                        </li>

                        <li class="has-dropdown <?php if($URL == 'index-shop') echo 'active'?>">
                            <a>Dining Rooms</a>
                            <ul class="dropdown">
                                <li><a href="<?php echo $linkDiningTable;?>">Tables</a></li>
                                <li><a href="<?php echo $linkDiningChair;?>">Chairs</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown <?php if($URL == 'index-shop') echo 'active'?>">
                            <a>Bedrooms</a>
                            <ul class="dropdown">
                                <li><a href="<?php echo $linkBedroomBed;?>">Beds</a></li>
                                <li><a href="<?php echo $linkBedroomDresserChest;?>">Dressers & Chests</a></li>
                                <li><a href="<?php echo $linkBedroomNightstand;?>">Nightstands</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown <?php if($URL == 'index-shop') echo 'active'?>">
                            <a>Living Rooms</a>
                            <ul class="dropdown">
                                <li><a href="<?php echo $linkLivingSofa;?>">Sofas</a></li>
                                <li><a href="<?php echo $linkLivingSectional;?>">Sectionals</a></li>
                                <li><a href="<?php echo $linkLivingChair;?>">Chairs</a></li>
                                <li><a href="<?php echo $linkLivingOttoman;?>">Ottomans</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown">
                            <a>Collections</a>
                            <ul class="dropdown">
                                <?php echo $collection;?>
                            </ul>
                        </li>
                        <li class="has-dropdown">
                            <a>Designers</a>
                            <ul class="dropdown">
                                <?php echo $designer;?>
                            </ul>
                        </li>
                        <li class="has-dropdown">
                            <a>More</a>
                            <ul class="dropdown">
                                <li><a href="<?php echo $linkAbout;?>">About</a></li>
                                <li><a href="<?php echo $linkService;?>">Service</a></li>
                                <li><a href="<?php echo $linkContact;?>">Contact</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $linkBlog;?>">Blogs</a>
                        </li>
                        <?php
                            if($_SESSION['user']['info']['group_acp'] == 2){
                        ?>
                            <li class="has-dropdown">
                                <a href="<?php echo $linkBuilder;?>">Builder</a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <form action="#" name="filterForm" id="filterForm" method="post">
                <div class="col-lg-1 col-md-1 col-xs-1 text-right hidden-xs menu-2">
                    <ul>
                        <li class="search">
                            <div class="input-group">
                                <span class="input-group-btn">
                                     <button title="Favorite" onclick='window.location="<?php echo $linkFavorite?>"' class="btn btn-primary" type="button">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                    <button title="Your Account" onclick='window.location="<?php echo $linkUser?>"' class="btn btn-primary" type="button">
                                        <i class="fa-solid fa-user"></i>
                                    </button>
                                        <?php
                                        $totalQuantity = 0;
                                        $items          = Session::get('cart');
                                        foreach ($items['quantity'] as $key => $value)
                                            $totalQuantity		+= $value;
                                        ?>
                                    <button title="Your Cart" onclick='window.location="<?php echo $linkCart?>"' class="btn btn-primary" type="button">
                                        <span>
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <small><?php echo $totalQuantity;?></small>
                                        </span>
                                    </button>
                                    <button title="Change Mode" id="switch-mode" class="btn btn-primary" type="button">
                                       <i class="fa-solid fa-moon"></i>
                                    </button>

                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </nav>








