<?php
$linkHome   = URL::createLink('designer', 'index', 'index', null, 'builder');

?>

    <div id="main" class="wrapper">
        <div class="page-container  no-sidebar">
            <div id="main-content">
                <div id="primary" class="site-content">
                    <article id="post-1023" class="post-1023 page type-page status-publish hentry">
                        <div data-elementor-type="wp-page" data-elementor-id="1023" class="elementor elementor-1023">
                            <div class="elementor-element elementor-element-cc08847 e-con-full e-flex e-con e-parent"
                                 data-id="cc08847" data-element_type="container"
                                 data-settings="{&quot;content_width&quot;:&quot;full&quot;}"
                                 data-core-v316-plus="true">
                                <div class="elementor-element elementor-element-642585e elementor-widget elementor-widget-slider_revolution"
                                     data-id="642585e" data-element_type="widget"
                                     data-widget_type="slider_revolution.default">
                                    <div class="elementor-widget-container">

                                        <div class="wp-block-themepunch-revslider">
                                            <!-- START Furniture 1 REVOLUTION SLIDER 6.6.18 --><p
                                                    class="rs-p-wp-fix"></p>
                                            <rs-module-wrap id="rev_slider_52_1_wrapper" data-source="gallery"
                                                            style="visibility:hidden;background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                                                <rs-module id="rev_slider_52_1" style="" data-version="6.6.18">
                                                    <rs-slides style="overflow: hidden; position: absolute;">
                                                        <?php
                                                            $carousel = '';
                                                            foreach($this->product as $key => $value){
                                                                $picture	= UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'];
                                                                $start = strpos( $value['name'], ' ', 0);

                                                                $link	        = URL::createLink('designer', 'index', 'product', array('product_id' => $value['id']));

                                                                $carousel .= '<rs-slide style="position: absolute;" data-key="rs-'.$value['id'].'" data-title="Chairs &amp; Seating" data-in="o:0;y:-100%;" data-out="a:false;">
                                                                                <img decoding="async"
                                                                                     alt="Chairs &amp; Seating" title="Furniture 1"
                                                                                     class="rev-slidebg tp-rs-img rs-lazyload"
                                                                                     data-bg="p:center bottom;c:#f2f2f2;" data-no-retina>
                                                                                <rs-group
                                                                                        id="slider-52-slide-197-layer-5"
                                                                                        data-type="group"
                                                                                        data-rsp_ch="on"
                                                                                        data-xy="x:l,l,l,c;xo:70px,50px,30px,0;y:m,m,m,t;yo:50px,35px,30px,160px;"
                                                                                        data-text="w:normal;s:20,14,10,6;l:0,17,12,7;"
                                                                                        data-dim="w:677px,500px,450px,90%;h:328px,280px,240px,255px;"
                                                                                        data-frame_0="o:1;"
                                                                                        data-frame_999="o:1;st:w;sR:8700;sA:9000;"
                                                                                        style="z-index:7;">
                                                                                    <rs-layer
                                                                                            id="slider-52-slide-197-layer-6"
                                                                                            data-type="text"
                                                                                            data-color="#000000"
                                                                                            data-xy="x:l,l,l,c;"
                                                                                            data-pos="a"
                                                                                            data-text="w:normal;s:18,16,14,16;l:30,20,24,18;ls:1.2px,0px,1px,0px;a:left,left,left,center;"
                                                                                            data-rsp_bd="off"
                                                                                            data-frame_0="x:175%;o:1;"
                                                                                            data-frame_0_mask="u:t;x:-100%;"
                                                                                            data-frame_1="e:power3.out;st:200;sp:1000;sR:200;"
                                                                                            data-frame_1_mask="u:t;"
                                                                                            data-frame_999="x:175%;o:1;st:w;sp:1000;sR:7800;"
                                                                                            data-frame_999_mask="u:t;x:-100%;"
                                                                                            style="z-index:10;font-family:\'Inter\';"
                                                                                    >YOUR HOT DESIGNER
                                                                                    </rs-layer>
                                                                                    <rs-layer
                                                                                            id="slider-52-slide-197-layer-1"
                                                                                            data-type="text"
                                                                                            data-color="#000000"
                                                                                            data-rsp_ch="on"
                                                                                            data-xy="x:l,l,l,c;yo:35px,40px,40px,35px;"
                                                                                            data-pos="a"
                                                                                            data-text="w:normal;s:72,46,40,40;l:90,60,50,46;ls:5px,3px,2px,1px;a:left,left,left,center;"
                                                                                            data-dim="w:auto,auto,100%,100%;"
                                                                                            data-frame_0="o:1;"
                                                                                            data-frame_0_chars="d:5;x:-105%;o:0;rZ:-90deg;"
                                                                                            data-frame_0_mask="u:t;"
                                                                                            data-frame_1="sp:1000;"
                                                                                            data-frame_1_chars="e:back.inOut;dir:backward;d:5;rZ:0deg;"
                                                                                            data-frame_1_mask="u:t;"
                                                                                            data-frame_999="o:1;st:w;sp:1200;sR:7300;"
                                                                                            data-frame_999_chars="e:power4.inOut;d:5;x:-105%;o:0;rZ:-90deg;"
                                                                                            data-frame_999_mask="u:t;"
                                                                                            style="z-index:9;font-family:\'Inter\';">'.str_replace(',', '',substr($value['name'], 0, strpos( $value['name'], ' ', $start + 1))).'
                                                                                    </rs-layer>
                                                                                    <rs-layer
                                                                                            id="slider-52-slide-197-layer-8"
                                                                                            data-type="text"
                                                                                            data-color="#000000"
                                                                                            data-rsp_ch="on"
                                                                                            data-xy="x:l,l,l,c;yo:125px,100px,95px,90px;"
                                                                                            data-pos="a"
                                                                                            data-text="w:normal;s:72,46,40,40;l:90,60,50,46;ls:5px,3px,2px,1px;a:left,left,left,center;"
                                                                                            data-frame_0="o:1;"
                                                                                            data-frame_0_chars="d:5;x:105%;o:1;rY:45deg;rZ:90deg;"
                                                                                            data-frame_0_mask="u:t;"
                                                                                            data-frame_1="sp:1000;"
                                                                                            data-frame_1_chars="e:back.inOut;d:5;rZ:0deg;"
                                                                                            data-frame_1_mask="u:t;"
                                                                                            data-frame_999="o:1;st:w;sp:1000;sR:7500;"
                                                                                            data-frame_999_chars="e:back.in;dir:backward;d:5;x:105%;o:0;rY:45deg;rZ:90deg;"
                                                                                            data-frame_999_mask="u:t;"
                                                                                            style="z-index:8;font-family:\'Inter\';">You\'ll Love
                                                                                    </rs-layer>
                                                                                    <rs-layer
                                                                                            id="slider-52-slide-197-layer-2"
                                                                                            data-type="text"
                                                                                            data-color="#000000"
                                                                                            data-xy="x:l,l,l,c;yo:225px,180px,160px,155px;"
                                                                                            data-pos="a"
                                                                                            data-text="w:normal;s:16,16,14,15;l:30,20,20,24;a:left,left,left,center;"
                                                                                            data-dim="w:auto,auto,auto,65%;"
                                                                                            data-rsp_bd="off"
                                                                                            data-frame_0="x:175%;o:1;"
                                                                                            data-frame_0_mask="u:t;x:-100%;"
                                                                                            data-frame_1="e:power3.out;st:200;sp:1000;sR:200;"
                                                                                            data-frame_1_mask="u:t;"
                                                                                            data-frame_999="x:175%;o:1;st:w;sp:1000;sR:7800;"
                                                                                            data-frame_999_mask="u:t;x:-100%;"
                                                                                            style="z-index:7;font-family:\'Inter\';">Designer chair styles for every space -
                                                                                        <strong>Free Shipping</strong>
                                                                                    </rs-layer>
                                                                                    <a
                                                                                        id="slider-52-slide-197-layer-9"
                                                                                        class="rs-layer"
                                                                                        href="'.$link.'"
                                                                                        target="_self"
                                                                                        data-type="text"
                                                                                        data-color="#000000"
                                                                                        data-xy="x:l,l,l,c;y:t,t,t,b;yo:307px,260px,220px,0;"
                                                                                        data-pos="a"
                                                                                        data-text="w:normal;s:14,14,14,13;l:18;ls:1px;fw:700;"
                                                                                        data-wrpcls="ts-button"
                                                                                        data-rsp_bd="off"
                                                                                        data-frame_0="x:175%;o:1;"
                                                                                        data-frame_0_mask="u:t;x:-100%;"
                                                                                        data-frame_1="e:power3.out;st:200;sp:1000;sR:200;"
                                                                                        data-frame_1_mask="u:t;"
                                                                                        data-frame_999="x:175%;o:1;st:w;sp:1000;sR:7800;"
                                                                                        data-frame_999_mask="u:t;x:-100%;"
                                                                                        style="z-index:6;font-family:\'Inter\';">VIEW PRODUCT
                                                                                    </a>
                                                                                </rs-group>
                                                                                <rs-layer
                                                                                        id="slider-52-slide-197-layer-3"
                                                                                        data-type="image"
                                                                                        data-rsp_ch="on"
                                                                                        data-xy="x:r,r,r,c;xo:70px,50px,15px,0;y:m,m,m,b;yo:50px,50px,50px,60px;"
                                                                                        data-text="w:normal;s:20,14,10,6;l:0,17,12,7;"
                                                                                        data-dim="w:705px,460px,358px,72%;h:690px,450px,350px,auto;"
                                                                                        data-frame_0="x:100px,70px,50px,30px;"
                                                                                        data-frame_1="e:back.out;st:190;sp:1000;sR:190;"
                                                                                        data-frame_999="x:100px,70px,50px,30px;o:0;e:back.inOut;st:w;sp:1000;sR:7810;"
                                                                                        data-loop_999="y:20px;sp:2000;st:1000;e:sine.inOut;yym:t;"
                                                                                        style="z-index:6;"
                                                                                ><img fetchpriority="high" decoding="async"
                                                                                      src="'.$picture.'"
                                                                                      alt="slide-1-home1-2.png"
                                                                                      class="tp-rs-img rs-lazyload" width="705" height="690"
                                                                                      data-lazyload="'.$picture.'"
                                                                                      data-no-retina>
                                                                                </rs-layer><!--
                        -->                        </rs-slide>
    ';
                                                            }
                                                            echo $carousel;
                                                        ?>

                                                    </rs-slides>
                                                    <rs-static-layers>
                                                    </rs-static-layers>
                                                </rs-module>
                                                <script>
                                                    setREVStartSize({
                                                        c: 'rev_slider_52_1',
                                                        rl: [1400, 1280, 991, 480],
                                                        el: [940, 700, 650, 830],
                                                        gw: [1550, 1100, 800, 480],
                                                        gh: [940, 700, 650, 830],
                                                        type: 'standard',
                                                        justify: '',
                                                        layout: 'fullwidth',
                                                        mh: "0"
                                                    });
                                                    if (window.RS_MODULES !== undefined && window.RS_MODULES.modules !== undefined && window.RS_MODULES.modules["revslider521"] !== undefined) {
                                                        window.RS_MODULES.modules["revslider521"].once = false;
                                                        window.revapi52 = undefined;
                                                        if (window.RS_MODULES.checkMinimal !== undefined) window.RS_MODULES.checkMinimal()
                                                    }
                                                </script>
                                            </rs-module-wrap>
                                            <!-- END REVOLUTION SLIDER -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-1379184 e-flex e-con-boxed e-con e-parent"
                                 data-id="1379184" data-element_type="container"
                                 data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}"
                                 data-core-v316-plus="true">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-bd2fc02 title-align--tabletleft title-align--mobilecenter title-align-left elementor-widget elementor-widget-ts-product-categories"
                                         data-id="bd2fc02" data-element_type="widget"
                                         data-widget_type="ts-product-categories.default">
                                        <div class="elementor-widget-container">
                                            <div class="ts-product-category-wrapper ts-product ts-shortcode woocommerce columns-4 style-default ts-slider"
                                                 data-nav="0" data-autoplay="1" data-columns="4">
                                                <header class="shortcode-heading-wrapper">
                                                    <h2 class="shortcode-title">VIEW BY CATEGORY</h2>
                                                </header>

                                                <div class="content-wrapper loading">
                                                    <div class="products">
                                                        <?php
                                                        $arrCategory = array(
                                                            'chair'         => '2-8',
                                                            'table'         => '1',
                                                            'dresser&chest' => '4',
                                                            'nightstand'    => '5',
                                                            'ottoman'       => '9',
                                                            'bed'           => '3',
                                                            'sofa'          => '6'
                                                        );

                                                        foreach ($arrCategory as $key => $value) {
                                                            $link	        = URL::createLink('designer', 'index', 'category', array('category_id' => $value));
                                                            $category .= '<section class="product-category product">
                                                                                <div class="product-wrapper">
                                                                                    <a href="'.$link.'">
                                                                                        <img loading="lazy" decoding="async"
                                                                                             src="'.$imageURL.'/'.$key.'.png"
                                                                                             alt="Chair" width="600" height="600"
                                                                                             srcset="'.$imageURL.'/'.$key.'.png 310w, '.$imageURL.'/'.$key.'.png 300w, '.$imageURL.'/'.$key.'.png 150w, '.$imageURL.'/'.$key.'.png 180w, '.$imageURL.'/'.$key.'.png 46w, '.$imageURL.'/'.$key.'.png 100w, '.$imageURL.'/'.$key.'.png 54w, '.$imageURL.'/'.$key.'.png 80w, '.$imageURL.'/'.$key.'.png 450w"
                                                                                             sizes="(max-width: 310px) 100vw, 310px"/> </a>
                                                                                    <div class="meta-wrapper">
                                                                                        <div class="category-name">
                                                                                            <h3 class="heading-title">
                                                                                                <a href="'.$link.'"> '.ucfirst($key).' </a>
                                                                                            </h3>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section>';
                                                        }
                                                        echo $category;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-f111744 e-flex e-con-boxed e-con e-parent"
                                 data-id="f111744" data-element_type="container"
                                 data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}"
                                 data-core-v316-plus="true">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-cd2337a e-con-full e-flex e-con e-child"
                                         data-id="cd2337a" data-element_type="container"
                                         data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                        <div class="elementor-element elementor-element-b80062e text-left-top elementor-widget elementor-widget-ts-banner"
                                             data-id="b80062e" data-element_type="widget"
                                             data-widget_type="ts-banner.default">
                                            <div class="elementor-widget-container">
                                                <div class="ts-banner eff-zoom-in description-bottom">
                                                    <div class="banner-wrapper">

                                                        <a class="banner-link"
                                                           href="index.php?module=designer&controller=index&action=shop"
                                                           target="_blank" rel="nofollow"></a>

                                                        <div class="banner-bg">
                                                            <div class="bg-content">
                                                                <img loading="lazy" decoding="async" width="600"
                                                                     height="410"
                                                                     <?php
                                                                        $imgView =  UPLOAD_URL . 'product' . DS . $this->viewProduct['name'] . DS . $this->viewProduct['picture1']
                                                                     ?>
                                                                     src="<?php echo $imgView?>"
                                                                     class="img" alt=""
                                                                     srcset="<?php echo $imgView?> 690w, <?php echo $imgView?> 300w"
                                                                     sizes="(max-width: 690px) 100vw, 690px"/></div>
                                                        </div>

                                                        <div class="box-content">

                                                            <h2>Top View Furniture</h2>


                                                            <div class="ts-banner-button">
                                                                <a class="button button-text"
                                                                   href="index.php?module=designer&controller=index&action=shop"
                                                                   target="_blank" rel="nofollow">View All Products</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if($this->process != null){
                                     ?>
                                        <div class="elementor-element elementor-element-3691801 e-con-full e-flex e-con e-child"
                                             data-id="3691801" data-element_type="container"
                                             data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                            <div class="elementor-element elementor-element-01a0da4 text-center-top ts-aligncenter elementor-widget elementor-widget-ts-banner"
                                                 data-id="01a0da4" data-element_type="widget"
                                                 data-widget_type="ts-banner.default">
                                                <div class="elementor-widget-container">
                                                    <div class="ts-banner eff-line description-top">
                                                        <div class="banner-wrapper">
                                                            <?php
                                                                $imgProcess = UPLOAD_URL . 'product' . DS . $this->process['name'] . DS . $this->process['picture1']
                                                            ?>
                                                            <a class="banner-link"
                                                               href="index.php?module=designer&controller=index&action=shop"
                                                               target="_blank" rel="nofollow"></a>

                                                            <div class="banner-bg">
                                                                <div class="bg-content">
                                                                    <img loading="lazy" decoding="async" width="690"
                                                                         height="750"
                                                                         src="<?php echo $imgProcess?>"
                                                                         class="img" alt=""
                                                                         srcset="<?php echo $imgProcess?> 690w, <?php echo $imgProcess?> 276w"
                                                                         sizes="(max-width: 690px) 100vw, 690px"
                                                                         style="filter: brightness(0.7)"
                                                                    /></div>
                                                            </div>

                                                            <div class="box-content">

                                                                <h2>Designs in Process</h2>


                                                                <div class="ts-banner-button">
                                                                    <a class="button button-text"
                                                                       href="index.php?module=designer&controller=index&action=shop"
                                                                       target="_blank" rel="nofollow">View More</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-3043368 e-flex e-con-boxed e-con e-parent"
                                 data-id="3043368" data-element_type="container"
                                 data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}"
                                 data-core-v316-plus="true">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-b1a58e2 title-align--mobilecenter title-align-left elementor-widget elementor-widget-ts-products"
                                         data-id="b1a58e2" data-element_type="widget"
                                         data-widget_type="ts-products.default">
                                        <div class="elementor-widget-container">
                                            <div class="ts-product-wrapper ts-shortcode ts-product woocommerce columns-4 recent style-title-inside-content">
                                                <div class="content-wrapper ">
                                                    <div class="products">
                                                        <header class="shortcode-heading-wrapper">
                                                            <h2 class="shortcode-title">Best Modern Furniture</h2>
                                                            <div class="shop-more hidden-phone">
                                                                <a class="shop-more-button" href="https://demo.theme-sky.com/nooni/shop/" target="_blank" rel="nofollow">See All</a>
                                                            </div>
                                                        </header>
                                                        <?php
                                                            $xhtmlMore = '';
                                                            foreach ($this->more as $key => $value){
                                                                $picture1   = UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'];
                                                                $picture2   = UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture2'];
                                                                $linkDetail = 'index.php?module=designer&controller=index&action=product&product_id=' . $value['id'];
                                                                $name       = $value['name'];
                                                                $xhtmlMore .= '<section
                                                                class="product add-to-wishlist-after_add_to_cart type-product post-'.$value['id'].' status-publish first instock product_cat-accent-chairs product_cat-chair product_cat-chairs-loungers product_cat-dining-kitchen-furniture product_cat-dining-chairs product_cat-home-office-furniture product_cat-kids-desks-desk-chairs product_cat-living-room-furniture product_cat-new-now product_cat-new-arrivals product_cat-office-accessories product_cat-office-chairs product_cat-outdoor-lounge-furniture product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion product_tag-furniture product_tag-trending product_tag-wood has-post-thumbnail sale featured shipping-taxable purchasable product-type-variable"
                                                                data-product_id="'.$value['id'].'">
                                                            <div class="product-wrapper">

                                                                <div class="thumbnail-wrapper">
                                                                    <a href="'.$linkDetail.'">
                                                                        <figure class="has-back-image">
                                                                        <img
                                                                            loading="lazy" decoding="async"
                                                                            src="'.$picture1.'"
                                                                            data-src="'.$picture1.'"
                                                                            class="attachment-shop_catalog wp-post-image ts-lazy-load"
                                                                            alt="" 
                                                                            style="height: 371px"
                                                                        />
                                                                        <img loading="lazy"
                                                                               decoding="async"
                                                                               src="'.$picture2.'"
                                                                               data-src="'.$picture2.'"
                                                                               class="product-image-back ts-lazy-load"
                                                                               alt=""
                                                                               style="height: 371px"
                                                                       />
                                                                        </figure>
                                                                    </a>
                                                                    <div class="product-group-button">
                                                                        <div class="loop-add-to-cart"><a
                                                                                    href="'.$linkDetail.'"
                                                                                    data-quantity="1"
                                                                                    class="button product_type_variable add_to_cart_button"
                                                                                    data-product_id="'.$value['id'].'"
                                                                                    data-product_sku="0093"
                                                                                    aria-label="Select options for &ldquo;Wood Outdoor Adirondack Chair&rdquo;"
                                                                                    rel="nofollow"><span
                                                                                        class="ts-tooltip button-tooltip">See Deatils</span></a>
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="meta-wrapper">
                                                                    <h3 class="heading-title product-name"><a
                                                                                href="'.$linkDetail.'">'.$name.'</a></h3>
                                                                    <div class="product-group-button-meta"></div>
                                                                </div>
                                                            </div>
                                                        </section>';

                                                            }
                                                            echo $xhtmlMore;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="shop-more visible-phone">
                                                    <a class="shop-more-button" href="https://demo.theme-sky.com/nooni/shop/" target="_blank" rel="nofollow">See All</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

