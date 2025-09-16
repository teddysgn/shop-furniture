<div id="main" class="wrapper">
    <div class="breadcrumb-title-wrapper breadcrumb-v1">
        <div class="breadcrumb-content">
            <div class="breadcrumb-title">
                <h1 class="heading-title page-title entry-title ">Request - Edit</h1>
            </div>
        </div>
    </div>
    <div class="page-container show_breadcrumb_v1 no-sidebar">
        <!-- Left Sidebar -->

        <div id="main-content" class="style-floating-sidebar">
            <div id="primary" class="site-content">


                <div class="ts-active-filters"></div>
                <div class="woocommerce main-products columns-4 grid">
                    <div class="products">
                        <?php
                            $xhtml = '';
                            foreach ($this->requestEdit as $key => $value){
                                $picture1   = UPLOAD_URL . 'product' . DS . $value['product_name'] . DS . $value['picture1'];
                                $picture2   = UPLOAD_URL . 'product' . DS . $value['product_name'] . DS . $value['picture2'];
                                $link       = URL::createLink('designer', 'index', 'detail', array('id' => $value['id'], 'product_id' => $value['product_id'], 'type' => $value['type']));
                                $xhtml .= '<section class="product add-to-wishlist-after_add_to_cart type-product post-3578 status-publish first instock product_cat-accent-chairs product_cat-chair product_cat-chairs-loungers product_cat-dining-kitchen-furniture product_cat-dining-chairs product_cat-home-office-furniture product_cat-kids-desks-desk-chairs product_cat-living-room-furniture product_cat-new-now product_cat-new-arrivals product_cat-office-accessories product_cat-office-chairs product_cat-outdoor-lounge-furniture product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion product_tag-furniture product_tag-trending product_tag-wood has-post-thumbnail sale featured shipping-taxable purchasable product-type-variable" data-product_id="3578">
                                            <div class="product-wrapper">
                                                <div class="thumbnail-wrapper">
                                                    <a href="'.$link.'">
                                                        <figure class="has-back-image">
                                                            <img src="'.$picture1.'" data-src="'.$picture1.'" class="attachment-shop_catalog wp-post-image ts-lazy-load loaded" alt="" style="height: 371px">
                                                            <img src="'.$picture2.'" data-src="'.$picture2.'" class="product-image-back ts-lazy-load loaded" alt="" style="height: 371px">
                                                        </figure>
                                                    </a>
                                                    <div class="product-group-button">
                                                        <div class="loop-add-to-cart">
                                                            <a href="'.$link.'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="3578" data-product_sku="0093" aria-label="Select options for “Wood Outdoor Adirondack Chair”" rel="nofollow">
                                                                <span class="ts-tooltip button-tooltip">See Details Request</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="meta-wrapper">
                                                    <h3 class="heading-title product-name">
                                                    <a href="https://demo.theme-sky.com/nooni/shop/wood-outdoor-adirondack-chair/">'.$value['product_name'].'</a></h3>
                                                    <p>'.$value['date'].'</p>
                                                    <div class="short-description list">
                                                        Aliquam condimentum dictum gravida. Sed eu odio id lorem fermentum faucibus. Cras tempor semper ligula.		</div>
                                                    <div class="product-group-button-meta"><div class="loop-add-to-cart"><a href="https://demo.theme-sky.com/nooni/shop/wood-outdoor-adirondack-chair/" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="3578" data-product_sku="0093" aria-label="Select options for “Wood Outdoor Adirondack Chair”" rel="nofollow"><span class="ts-tooltip button-tooltip">Select options</span></a></div></div>		</div>
                                            </div>
                                        </section>';
                            }
                            echo $xhtml;
                        ?>
            </div>
        </div>
        <!-- Right Sidebar -->


    </div>
</div><!-- #main .wrapper -->
    </div>

    <div class="breadcrumb-title-wrapper breadcrumb-v1">
        <div class="breadcrumb-content">
            <div class="breadcrumb-title">
                <h1 class="heading-title page-title entry-title ">Request - Add</h1>
            </div>
        </div>
    </div>
    <div class="page-container show_breadcrumb_v1 no-sidebar">
        <!-- Left Sidebar -->

        <div id="main-content" class="style-floating-sidebar">
            <div id="primary" class="site-content">


                <div class="ts-active-filters"></div>
                <div class="woocommerce main-products columns-4 grid">
                    <div class="products">
                        <?php
                        $xhtml = '';
                        foreach ($this->requestAdd as $key => $value){
                            $picture1   = UPLOAD_URL . 'cache' . DS . $value['type'] . DS . $value['name'] . DS . $value['picture1'];
                            $picture2   = UPLOAD_URL . 'cache' . DS . $value['type'] . DS . $value['name'] . DS . $value['picture2'];
                            $link       = URL::createLink('designer', 'index', 'detail', array('id' => $value['id'], 'type' => $value['type']));
                            $xhtml .= '<section class="product add-to-wishlist-after_add_to_cart type-product post-3578 status-publish first instock product_cat-accent-chairs product_cat-chair product_cat-chairs-loungers product_cat-dining-kitchen-furniture product_cat-dining-chairs product_cat-home-office-furniture product_cat-kids-desks-desk-chairs product_cat-living-room-furniture product_cat-new-now product_cat-new-arrivals product_cat-office-accessories product_cat-office-chairs product_cat-outdoor-lounge-furniture product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion product_tag-furniture product_tag-trending product_tag-wood has-post-thumbnail sale featured shipping-taxable purchasable product-type-variable" data-product_id="3578">
                                            <div class="product-wrapper">
                                                <div class="thumbnail-wrapper">
                                                    <a href="'.$link.'">
                                                        <figure class="has-back-image">
                                                            <img src="'.$picture1.'" data-src="'.$picture1.'" class="attachment-shop_catalog wp-post-image ts-lazy-load loaded" alt="" style="height: 371px">
                                                            <img src="'.$picture2.'" data-src="'.$picture2.'" class="product-image-back ts-lazy-load loaded" alt="" style="height: 371px">
                                                        </figure>
                                                    </a>
                                                    <div class="product-group-button">
                                                        <div class="loop-add-to-cart">
                                                            <a href="'.$link.'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="3578" data-product_sku="0093" aria-label="Select options for “Wood Outdoor Adirondack Chair”" rel="nofollow">
                                                                <span class="ts-tooltip button-tooltip">See Details Request</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="meta-wrapper">
                                                    <h3 class="heading-title product-name">
                                                    <a href="https://demo.theme-sky.com/nooni/shop/wood-outdoor-adirondack-chair/">'.$value['name'].'</a></h3>
                                                    <p>'.$value['date'].'</p>
                                                    <div class="short-description list">
                                                        Aliquam condimentum dictum gravida. Sed eu odio id lorem fermentum faucibus. Cras tempor semper ligula.		</div>
                                                    <div class="product-group-button-meta"><div class="loop-add-to-cart"><a href="https://demo.theme-sky.com/nooni/shop/wood-outdoor-adirondack-chair/" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="3578" data-product_sku="0093" aria-label="Select options for “Wood Outdoor Adirondack Chair”" rel="nofollow"><span class="ts-tooltip button-tooltip">Select options</span></a></div></div>		</div>
                                            </div>
                                        </section>';
                        }
                        echo $xhtml;
                        ?>
                    </div>
                </div>
                <!-- Right Sidebar -->


            </div>
        </div><!-- #main .wrapper -->
    </div>
</div>