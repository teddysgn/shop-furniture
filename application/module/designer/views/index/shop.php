<?php
$paginationHTML = $this->pagination->showPaginator(URL::createLink('designer', 'index', 'shop'));
?>
<div id="main" class="wrapper">
    <div class="breadcrumb-title-wrapper breadcrumb-v1">
        <div class="breadcrumb-content">
            <div class="breadcrumb-title"><h1 class="heading-title page-title entry-title ">Shop</h1>
                <div class="breadcrumbs">
                    <div class="breadcrumbs-container"><a href="<?php echo $linkHome?>">Home</a><span>&#47;</span>Shop
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-container show_breadcrumb_v1 has-1-sidebar">
        <!-- Left Sidebar -->
        <div id="left-sidebar" class="ts-sidebar">
            <aside>
                <section id="ts_product_categories-15" class="widget-container ts-product-categories-widget">
                    <div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a>
                        <h3 class="widget-title heading-title">Collection</h3></div>
                    <div class="ts-product-categories-widget-wrapper">
                        <ul class="product-categories">
                            <?php
                            $xhtmlCollection = '';
                            foreach($this->collection as $key => $value){
                                $class = '';
                                $linkCollection = URL::createLink('designer', 'index', 'shop', array('collection_id' => $value['id']));
                                if($_GET['collection_id'] == $value['id']){
                                    $class = 'current';
                                }

                                $xhtmlCollection .= '<li class="cat-item '.$class.'"><span class="icon-toggle"></span><a
                                                            href="'.$linkCollection.'">'.$value['name'].'<span
                                                                class="count">('.$value['total'].')</span></a></li>';
                            }
                            echo $xhtmlCollection;
                            ?>
                        </ul>
                        <div class="clear"></div>
                    </div>

                </section>
                <section id="woocommerce_layered_nav-24"
                         class="widget-container woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                    <div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a>
                        <h3 class="widget-title heading-title">Category</h3></div>
                    <ul class="woocommerce-widget-layered-nav-list">
                        <?php
                        $xhtmlCategory = '';
                        foreach($this->category as $key => $value){
                            $class = '';
                            $linkCategory = URL::createLink('designer', 'index', 'shop', array('category_id' => $value['id']));
                            if($_GET['category_id'] == $value['id']){
                                $class = 'current';
                            }
                            $xhtmlCategory .= '<li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term '.$class.'">
                                                        <a rel="nofollow" href="'.$linkCategory.'">'.$value['name'].'</a>
                                                        <span class="count">('.$value['total'].')</span>
                                                    </li>';
                        }
                        echo $xhtmlCategory;
                        ?>
                    </ul>
                </section>
            </aside>
        </div>

        <div id="main-content" class="">
            <div id="primary" class="site-content">
                <div class="before-loop-wrapper">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="filter-widget-area-button">
                        <a href="#">Filter</a>
                    </div>
                    <div class="overlay"></div>
                    <p class="woocommerce-result-count">
                        Showing 1&ndash;15 of 41 results</p>
                    <div class="gridlist-toggle">
                        <span class="list " data-style="list"></span>
                        <span class="grid active" data-style="grid"></span>
                    </div>
                </div>

                <div class="ts-active-filters"></div>
                <form action="#" method="post" name="adminForm" id="adminForm">
                    <div class="woocommerce main-products columns-3 grid">
                    <div class="products">
                        <?php
                        $block = '';
                        if($this->product != null){
                            foreach ($this->product as $key => $value) {
                                $picture1 = UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'];
                                $picture2 = UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture2'];
                                $link = URL::createLink('designer', 'index', 'product', array('product_id' => $value['id']));
                                $block = '<section class="product add-to-wishlist-after_add_to_cart type-product post-' . $value['id'] . ' status-publish first instock product_cat-accent-chairs product_cat-chair product_cat-chairs-loungers product_cat-dining-kitchen-furniture product_cat-dining-chairs product_cat-home-office-furniture product_cat-kids-desks-desk-chairs product_cat-living-room-furniture product_cat-new-now product_cat-new-arrivals product_cat-office-accessories product_cat-office-chairs product_cat-outdoor-lounge-furniture product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion product_tag-furniture product_tag-trending product_tag-wood has-post-thumbnail sale featured shipping-taxable purchasable product-type-variable" data-product_id="' . $value['id'] . '">
                                            <div class="product-wrapper">
                                                <div class="thumbnail-wrapper">
                                                    <a href="' . $link . '">
                                                        <figure class="has-back-image">
                                                            <img src="' . $picture1 . '" data-src="' . $picture1 . '" class="attachment-shop_catalog wp-post-image ts-lazy-load" alt="" style="height: 371px" />
                                                            <img src="' . $picture2 . '" data-src="' . $picture2 . '" class="product-image-back ts-lazy-load" alt="" style="height: 371px" />
                                                        </figure>			
                                                    </a>
                                                    <div class="product-group-button">
                                                        <div class="loop-add-to-cart">
                                                            <a href="' . $link . '" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="' . $value['id'] . '" data-product_sku="0093" aria-label="Select options for &ldquo;Wood Outdoor Adirondack Chair&rdquo;" rel="nofollow">
                                                                <span class="ts-tooltip button-tooltip">See Details</span>
                                                            </a>
                                                        </div>
                                                    </div>		
                                                </div>
                                                <div class="meta-wrapper">
                                                    <h3 class="heading-title product-name">
                                                        <a href="' . $link . '">' . $value['name'] . '</a>
                                                    </h3>
                                                    <div class="short-description list">
                                                        '.$value['category_name'].'		
                                                    </div>
                                                    <div class="product-group-button-meta">
                                                        <div class="loop-add-to-cart">
                                                            <a href="' . $link . '" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="' . $value['id'] . '" data-product_sku="0093" aria-label="Select options for &ldquo;Wood Outdoor Adirondack Chair&rdquo;" rel="nofollow">
                                                                <span class="ts-tooltip button-tooltip">
                                                                    See Details
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>		
                                                </div>
                                            </div>
                                        </section>';
                                echo $block;
                            }
                        } else {
                            echo '<div style="text-align: center">
                                     <h4>No products were found matching your search.</h4>
                                  </div>';
                        }

                        ?>



                        <div class="after-loop-wrapper">
                            <nav class="woocommerce-pagination" style="display: flex; justify-content: center">
                                <input type="hidden" name="filter_page" value="1">
                                <?php
                                if($this->pagination->totalPage > 1)
                                    echo $paginationHTML;
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .pagination{
        display: flex;
    }
    .pagination span {
        color: rgba(203,203,203,0.8);
    }
    .pagination span, .pagination a {
        margin-right: 10px;
    }
    .page span {
        background-color: black;
        color: white;
        padding: 15px;
    }
    .pagination {
        display: flex !important;
        justify-content: center !important;
    }
</style>
<script type="text/javascript"
        src="<?php echo TEMPLATE_URL . 'designer/main/js/custom.js';?>"
></script>
