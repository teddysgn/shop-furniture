<?php

$paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'product', 'shop'));
$cate    = '';
switch ($_GET['category_id']){
    case '1':       $cate = 'dining-tables';        $video = 'diningroom';   $source = 'https://p3.aprimocdn.net/boconcept/f8cc088e-26bf-4d0d-89ce-af8f00b8e5ed/Dining-Room_1920x1080_MP4%20High%20%281080px%20heigh%29.MP4'             ;   break;
    case '2':       $cate = 'dining-chairs';        $video = 'diningroom';   $source = 'https://p3.aprimocdn.net/boconcept/f8cc088e-26bf-4d0d-89ce-af8f00b8e5ed/Dining-Room_1920x1080_MP4%20High%20%281080px%20heigh%29.MP4'             ;   break;
    case '3':       $cate = 'bed-beds';             $video = 'bedroom';      $source = 'https://p3.aprimocdn.net/boconcept/4ff0ea8a-6251-45e0-9bf3-af9a00b4e678/Bedroom%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4'       ;   break;
    case '4':       $cate = 'bed-dressers-chests';   $video = 'bedroom';      $source = 'https://p3.aprimocdn.net/boconcept/4ff0ea8a-6251-45e0-9bf3-af9a00b4e678/Bedroom%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4'       ;   break;
    case '5':       $cate = 'bed-nighstands';       $video = 'bedroom';      $source = 'https://p3.aprimocdn.net/boconcept/4ff0ea8a-6251-45e0-9bf3-af9a00b4e678/Bedroom%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4'       ;   break;
    case '6':       $cate = 'living-sofas';         $video = 'livingroom';   $source = 'https://p3.aprimocdn.net/boconcept/c7ad18d8-e9a0-44f3-9724-af9a00b4e58e/Living%20Room%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4' ;   break;
    case '7':       $cate = 'living-sectionals';    $video = 'livingroom';   $source = 'https://p3.aprimocdn.net/boconcept/c7ad18d8-e9a0-44f3-9724-af9a00b4e58e/Living%20Room%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4' ;   break;
    case '8':       $cate = 'living-chairs';        $video = 'livingroom';   $source = 'https://p3.aprimocdn.net/boconcept/c7ad18d8-e9a0-44f3-9724-af9a00b4e58e/Living%20Room%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4' ;   break;
    case '9':       $cate = 'living-ottomans';      $video = 'livingroom';   $source = 'https://p3.aprimocdn.net/boconcept/c7ad18d8-e9a0-44f3-9724-af9a00b4e58e/Living%20Room%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4' ;   break;
    case '1-2':     $cate = 'diningroom';          $video = 'diningroom';   $source = 'https://p3.aprimocdn.net/boconcept/f8cc088e-26bf-4d0d-89ce-af8f00b8e5ed/Dining-Room_1920x1080_MP4%20High%20%281080px%20heigh%29.MP4'             ;   break;
    case '3-4-5':   $cate = 'bedroom';             $video = 'bedroom';      $source = 'https://p3.aprimocdn.net/boconcept/4ff0ea8a-6251-45e0-9bf3-af9a00b4e678/Bedroom%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4'       ;   break;
    case '6-7-8-9': $cate = 'livingroom';          $video = 'livingroom';   $source = 'https://p3.aprimocdn.net/boconcept/c7ad18d8-e9a0-44f3-9724-af9a00b4e58e/Living%20Room%20CLP%20-%201920x1080_MP4%20Low%20%28420px%20heigh%29.MP4' ;   break;
}

switch ($video){
    case 'diningroom':
        $title  = 'DINING ROOM';
        $p      = 'The dining room is the heart of the home. Flexible and functional, it\'s a designated space to gather with loved ones to share meals and make memories. Be inspired to create a place made for entertaining with these modern dining room designs by Shop. stylists, featuring the best of Danish design.';
        break;
    case 'bedroom':
        $title  = 'BEDROOM';
        $p      = 'Your bedroom is one of the most important rooms in your home. It is where you come to rest and recharge. Discover how to transform your bedroom into a place for relaxation and create a space you’ll never want to leave with these modern bedroom ideas by Shop. stylists.';
        break;
    case 'livingroom':
        $title  = 'LIVING ROOM';
        $p      = 'The living room is one of the most important rooms in your home. Not only is it a space to socialise, but it is also a place for rest and relaxation. Allow our interior stylists to inspire you to create a functional living space you’ll never want to leave with these modern living room designs and ideas.';
        break;

}


$linkSubmitForm = URL::createLink('default', 'product', 'shop', array('category_id' => $_GET['category_id']), $cate);

$xhtml = '';
if(!empty($this->Items)){
    foreach($this->Items as $key => $value){
        $nameFilter     = URL::filterURL($value['name']);
        $link	        = URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), $nameFilter.'-'.$value['id']);
        $name	        = $value['name'];
        $price          = $value['price'];

        $picturePath	= UPLOAD_PATH . 'product' . DS . $value['name'] . DS . $value['picture1'];
        if(file_exists($picturePath)==true){
            $picture	= '<img class="product-grid"  style="padding: 30px" src="'.UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'].'">';
        }else{
            $picture	= '<img class="product-grid"  style="padding: 30px" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
        }

        $stock		= $value['stock'];
        $price = 0;
        if($value['sale_off'] > 0){
            $priceReal = (100-$value['sale_off']) * $value['price']/100;
            $price	 = ' <span class="red-through">'.number_format($value['price']).' VNĐ</span>';
            $price	.= ' &nbsp;<span class="red">'.number_format($priceReal).' VNĐ</span>';
        }else{
            $priceReal	= $value['price'];
            $price	= ' <span class="red">'.number_format($priceReal).' VNĐ</span>';
        }

        $user_id = $_SESSION['user']['info']['id'];
        $linkFavorite = URL::createLink('default', 'product', 'like', array('user_id' => $user_id, 'product_id' => $value['id'], 'category_name' => $cate, 'favorite' => 1));
        $blockFavorite = '<a style="padding: 15px; margin: 0 10px" href="'.$linkFavorite.'" class="price" title="Add to Favorites"><i class="fa-regular fa-heart"></i></a>';

        $linkOrder	= URL::createLink('default', 'user', 'order', array('product_id' => $value['id'], 'price' => $priceReal), $value['id'] . '-' . $priceReal);
        $blockOrder = '<a style="padding: 15px; margin: 0 10px" href="'.$linkOrder.'" class="price" title="Add to Cart"><i class="fa-solid fa-cart-shopping"></i></a>';

        if($stock <= 0 && $stock - $quantityInCart <= 0)
            $blockOrder = '<a style="margin: 0 10px; padding: 15px" class="price" title="Out of Stock"><i class="fa-solid fa-ban"></i></a>';

        foreach($this->infoFavorite as $keyFavorite => $valueFavorite){
            if($value['id'] == $valueFavorite['product_id']){
                $linkFavorite = URL::createLink('default', 'product', 'like', array('user_id' => $_SESSION['user']['info']['id'], 'product_id' => $value['id'], 'category_name' => $cate, 'favorite' => 0, 'favorite_id' => $valueFavorite['id']));
                $blockFavorite = '<a style="padding: 15px; margin: 0 10px" href="'.$linkFavorite.'" class="price" title="Remove from Favorites"><i class="fa-solid fa-heart"></i></a>';
            }
        }



        $xhtml 	.= '<div class="col-lg-4 col-md-6 col-sm-6 text-center animate-box" >
                        <div class="product">
                            <div class="product-grid">
                                <a href="'.$link.'">
                                    '.$picture.'
                                </a>
                            </div>
                            <div class="desc">
                                <h3><a href="'.$link.'">'.$name.'</a></h3>
                            </div>
                        </div>
                        <div class="d-flex text-center product">
                            '.$blockFavorite.'
                            '.$blockOrder.'
                         </div>
                    </div>
                    ';

        if ($this->pagination->currentPage == $this->pagination->totalPage)
            $totalPage = $this->pagination->totalItem;
        else
            $totalPage = $this->pagination->totalItemPerPage *  $this->pagination->currentPage;


    }
    $itemFrom = ($this->pagination->currentPage - 1) * $this->pagination->totalItemPerPage + 1;
    $itemTo = $totalPage;
    $totalItem = $this->pagination->totalItem;
    $result = 'Showing '.$itemFrom . ' - ' . $itemTo . ' of ' . $this->allItems .' Results';
} else{
    $result 	= 'No products were found matching your selection.';
}


foreach ($this->categoryName as $key => $value){
    $cateName = substr($value, strpos($value, '-') + 2);

    if($_GET['category_id'] == '1-2' || $_GET['category_id'] == '3-4-5' || $_GET['category_id'] == '6-7-8-9') {
        $cateName = substr($value, 0, strpos($value, '-'));
    }

    $checkBox .= '<div class="col-md-12 col-sm-12">
                    <label onclick="javascript:submitform('.$linkSubmitForm.')" class="checkbox">'.substr($value, strpos($value, '-') + 2).'
                        <input name="check['.$key.']" type="checkbox" value="'.$key.'" '?>

                        <?php if($_POST['check'][$key] != $key[$value])
                            $checkBox .= 'checked="checked"';
                        $checkBox .= '>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>';
                    }
?>

<div class="row video">
    <div style="padding-left: 0" class="col-md-6 slider-text">
        <video poster="" playsinline="" autoplay="autoplay" play="" muted="" loop="" width="100%" height="100%" class="full_width_video lazyloaded" style="object-fit: cover; aspect-ratio: 16 / 9;" data-desktop-vid="<?php echo $source?>" data-tablet-vid="<?php echo $source?>" data-mobile-vid="<?php echo $source?>">
            <source src="<?php echo $source?>" type="video/mp4"></video>
    </div>
    <div class="col-md-6">
        <div style="padding: 8em 4rem 0">
            <div class="slider-text-inner">
                <div class="desc">
                    <h1><?php echo $title;?></h1>
                    <p><?php echo $p;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="#" method="post" name="adminForm" id="adminForm" >
    <div id="fh5co-product" style="padding-bottom: 0">
        <div class="container">
            <div class="row container">
                <div class="col-md-12 container">
                    <?php
                    if($_GET['category_id'] == '1-2' || $_GET['category_id'] == '3-4-5' || $_GET['category_id'] == '6-7-8-9'){
                        echo '<div class="col-md-4 col-sm-4" style="padding-left: 0">
                                    <label class="label-filter" for="">CHOOSE A PIECE</label>
                                    <div class="custom-select row">
                                        '.$checkBox.'
                                    </div>
                                </div>';
                    }

                    ?>
                    <div class="col-md-4 col-sm-4">
                        <div class="row">
                            <label class="label-filter" for="">SETTING A PRICE RANGE</label>
                            <div class="col-md-12 col-sm-12" style="padding-left: 0">
                                <label class="checkbox">1M- 5M
                                    <input type="radio" name="filter_price" value="1-5" <?php if($_POST['filter_price'] == '1-5') echo 'checked="checked"'?>>
                                    <span class="radio"></span>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12" style="padding-left: 0">
                                <label class="checkbox">5M - 10M
                                    <input type="radio" name="filter_price" value="5-10" <?php if($_POST['filter_price'] == '5-10') echo 'checked="checked"'?>>
                                    <span class="radio"></span>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12" style="padding-left: 0">
                                <label class="checkbox">10M -20M
                                    <input type="radio" name="filter_price" value="10-20" <?php if($_POST['filter_price'] == '10-20') echo 'checked="checked"'?>>
                                    <span class="radio"></span>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12" style="padding-left: 0">
                                <label class="checkbox">20M+
                                    <input type="radio" name="filter_price" value="20-10000" <?php if($_POST['filter_price'] == '20-10000') echo 'checked="checked"'?>>
                                    <span class="radio"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="label-filter" for="email">FIND THE PERFECT PIECE</label>
                            <input type="text" list="nameProduct" onchange="javascript:submitForm('<?php echo $linkSubmitForm;?>')" class="form-control"  id="filter_search" name="filter_search" placeholder="Search..." value="<?php echo $_POST['filter_search']?>">
                            </br>
                            <datalist id="nameProduct">
                                <?php
                                $options = '';
                                    foreach ($this->nameProduct as $key => $value){
                                        $options .= '<option value="'.$value['name'].'"></option>';
                                    }
                                    echo $options;
                                ?>

                            </datalist>
                            <input type="submit" class="btn-primary form-control" style="color: black" value="Search">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2><?php echo $cateName;?></h2>
                    <span><?php echo $result;?></span>
                </div>
            </div>
            <div class="row">
                <?php echo $xhtml?>
            </div>
            <div class="container">
                <input type="hidden" name="filter_page" value="1">
                <?php
                if($this->pagination->totalPage > 1)
                    echo $paginationHTML;
                ?>
            </div>
        </div>
    </div>
</form>
