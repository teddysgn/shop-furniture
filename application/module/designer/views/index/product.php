<?php

$linkHome = URL::createLink('designer', 'index', 'index', null, 'builder');

$productInfo = $this->productInfo;





if($productInfo != null){
$picture1Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture1'];
$picture2Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture2'];
$picture3Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture3'];
$picture4Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture4'];
$picture5Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture5'];
$picture6Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture6'];
$picture7Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture7'];
$picture8Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture8'];
$picture9Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture9'];
$picture10Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture10'];
$picture11Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture11'];
$picture12Path	= UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture12'];

if(is_file($picture1Path)==true){
    if(file_exists($picture1Path)==true) {
        $picture1Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture1'];
        $xhtml .= '<div data-thumb="'.$picture1Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture1Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture1Full.'"
                                class="wp-post-image" alt="" title="01" data-caption=""
                                data-src="'.$picture1Full.'"
                                data-large_image="'.$picture1Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture2Path)==true){
    if(file_exists($picture2Path)==true) {
        $picture2Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture2'];
        $xhtml .= '<div data-thumb="'.$picture2Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture2Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture2Full.'"
                                class="wp-post-image" alt="" title="02" data-caption=""
                                data-src="'.$picture2Full.'"
                                data-large_image="'.$picture2Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture3Path)==true){
    if(file_exists($picture3Path)==true) {
        $picture3Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture3'];
        $xhtml .= '<div data-thumb="'.$picture3Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture3Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture3Full.'"
                                class="wp-post-image" alt="" title="03" data-caption=""
                                data-src="'.$picture3Full.'"
                                data-large_image="'.$picture3Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture4Path)==true){
    if(file_exists($picture4Path)==true) {
        $picture4Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture4'];
        $xhtml .= '<div data-thumb="'.$picture4Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture4Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture4Full.'"
                                class="wp-post-image" alt="" title="04" data-caption=""
                                data-src="'.$picture4Full.'"
                                data-large_image="'.$picture4Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture5Path)==true){
    if(file_exists($picture5Path)==true) {
        $picture5Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture5'];
        $xhtml .= '<div data-thumb="'.$picture2Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture5Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture5Full.'"
                                class="wp-post-image" alt="" title="05" data-caption=""
                                data-src="'.$picture5Full.'"
                                data-large_image="'.$picture5Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture6Path)==true){
    if(file_exists($picture6Path)==true) {
        $picture6Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture6'];
        $xhtml .= '<div data-thumb="'.$picture6Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture6Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture6Full.'"
                                class="wp-post-image" alt="" title="06" data-caption=""
                                data-src="'.$picture6Full.'"
                                data-large_image="'.$picture6Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture7Path)==true){
    if(file_exists($picture7Path)==true) {
        $picture7Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture7'];
        $xhtml .= '<div data-thumb="'.$picture7Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture7Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture7Full.'"
                                class="wp-post-image" alt="" title="07" data-caption=""
                                data-src="'.$picture7Full.'"
                                data-large_image="'.$picture7Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture8Path)==true){
    if(file_exists($picture8Path)==true) {
        $picture8Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture8'];
        $xhtml .= '<div data-thumb="'.$picture8Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture8Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture8Full.'"
                                class="wp-post-image" alt="" title="08" data-caption=""
                                data-src="'.$picture8Full.'"
                                data-large_image="'.$picture8Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture9Path)==true){
    if(file_exists($picture9Path)==true) {
        $picture9Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture9'];
        $xhtml .= '<div data-thumb="'.$picture9Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture9Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture9Full.'"
                                class="wp-post-image" alt="" title="09" data-caption=""
                                data-src="'.$picture9Full.'"
                                data-large_image="'.$picture9Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture10Path)==true){
    if(file_exists($picture10Path)==true) {
        $picture10Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture10'];
        $xhtml .= '<div data-thumb="'.$picture10Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture10Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture10Full.'"
                                class="wp-post-image" alt="" title="10" data-caption=""
                                data-src="'.$picture10Full.'"
                                data-large_image="'.$picture10Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture11Path)==true){
    if(file_exists($picture11Path)==true) {
        $picture11Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture11'];
        $xhtml .= '<div data-thumb="'.$picture11Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture11Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture11Full.'"
                                class="wp-post-image" alt="" title="11" data-caption=""
                                data-src="'.$picture11Full.'"
                                data-large_image="'.$picture11Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}
if(is_file($picture12Path)==true){
    if(file_exists($picture12Path)==true) {
        $picture12Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture12'];
        $xhtml .= '<div data-thumb="'.$picture12Full.'" data-thumb-alt="" class="woocommerce-product-gallery__image">
                        <a href="'.$picture12Full.'">
                            <img
                                width="1000" height="1276"
                                src="'.$picture12Full.'"
                                class="wp-post-image" alt="" title="12" data-caption=""
                                data-src="'.$picture12Full.'"
                                data-large_image="'.$picture12Full.'"
                                data-large_image_width="1000" data-large_image_height="1276"
                                decoding="async"
                            />
                        </a>
                    </div>';
    }
}


?>



    <div id="main" class="wrapper">
        <div class="page-container show_breadcrumb_v1 no-sidebar">
            <div id="main-content">
                <div id="primary" class="site-content">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div id="product-3578"
                         class="gallery-layout-vertical has-gallery product type-product post-3578 status-publish first instock product_cat-accent-chairs product_cat-chair product_cat-chairs-loungers product_cat-dining-kitchen-furniture product_cat-dining-chairs product_cat-home-office-furniture product_cat-kids-desks-desk-chairs product_cat-living-room-furniture product_cat-new-now product_cat-new-arrivals product_cat-office-accessories product_cat-office-chairs product_cat-outdoor-lounge-furniture product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion product_tag-furniture product_tag-trending product_tag-wood has-post-thumbnail sale featured shipping-taxable purchasable product-type-variable">
                        <div class="product-images-summary">
                            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-12 images"
                                 data-columns="12" style="opacity: 0; transition: opacity .25s ease-in-out;">
                                <div class="woocommerce-product-gallery__wrapper">
                                    <?php echo $xhtml?>
                                </div>
                            </div>

                            <div class="summary entry-summary">
                                <h1 class="product_title entry-title"><?php echo $productInfo['name']?></h1>
                                <div class="woocommerce-product-details__short-description">
                                    <?php echo $productInfo['description']?>
                                </div>
                                <?php
                                    if($this->requestInfo['product_id'] == $productInfo['id']){
                                        $linkForm = URL::createLink('designer', 'index', 'detail', array('id' => $this->requestInfo['id'], 'product_id' => $productInfo['id'], 'type' => $this->requestInfo['type']));
                                        echo '<a href="'.$linkForm.'" class="button">You Submitted your Request - Click to View</a>';
                                    }else {
                                        $linkForm = URL::createLink('designer', 'index', 'form', array('product_id' => $productInfo['id']));
                                        echo '<a href="'.$linkForm.'" class="button">Edit Product</a>';
                                    }

                                ?>

                            </div>
                        </div>
                        <section class="related products">
                            <h2>More your Designs</h2>
                            <div class="products">
                                <?php
                                foreach ($this->productRelated as $key => $value){
                                    $name    = $value['name'];
                                    $id      = $value['id'];
                                    $picture1 = UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'];
                                    $picture2 = UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture2'];
                                    $link = URL::createLink('designer', 'index', 'product', array('product_id' => $value['id']));

                                    $related = '<section class="product add-to-wishlist-after_add_to_cart type-product post-'.$id.' status-publish first instock product_cat-bedroom-furniture product_cat-bookcases-shelves-storage-furniture product_cat-bookcases-shelves product_cat-cabinet product_cat-cabinets-armoires product_cat-dining-kitchen-furniture product_cat-filing-cabinets-credenzas product_cat-home-office-furniture product_cat-modular-storage-furniture product_cat-new-now product_cat-new-arrivals product_cat-nightstands product_cat-nightstands-dining-kitchen-furniture product_cat-office-accessories product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion has-post-thumbnail sale featured shipping-taxable purchasable product-type-simple" data-product_id="'.$id.'">
                                                    <div class="product-wrapper">
                                                        <div class="thumbnail-wrapper">
                                                            <a href="'.$link.'">
                                                                <figure class="has-back-image">
                                                                    <img
                                                                        src="'.$picture1.'"
                                                                        data-src="'.$picture1.'"
                                                                        class="attachment-shop_catalog wp-post-image ts-lazy-load"
                                                                        alt="" style="height: 300px"/>
                                                                    <img
                                                                        src="'.$picture2.'"
                                                                        data-src="'.$picture2.'"
                                                                        class="product-image-back ts-lazy-load" alt="" style="height: 300px"/>
                                                                </figure>
                                                            </a>
                                                        </div>
                                                        <div class="meta-wrapper">
                                                            <h3 class="heading-title product-name">
                                                                <a href="'.$link.'">
                                                                    '.$name.'
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </section>';
                                    echo $related;
                                }
                                ?>
                            </div>
                        </section>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php };?>