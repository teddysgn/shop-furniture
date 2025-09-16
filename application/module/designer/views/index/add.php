<?php
    $imageURL       = $this->_dirImg;
    $productInfo = $this->productInfo;

    $linkHome = URL::createLink('designer', 'index', 'index', null, 'builder');
    $linkForm = URL::createLink('designer', 'index', 'form', array('product_id' => $productInfo['id']));

    $slbCategory		= Helper::cmsSelectbox('form[category_id]'  , 'inputbox form-control', $this->slbCategory   , $this->arrParams['form']['category_id']  , 'width: 17.5rem; border: 1px solid black');
    $rowCategory        = Helper::cmsRowForm(''     , $slbCategory);

    $slbCollection		= Helper::cmsSelectbox('form[collection_id]'  , 'inputbox form-control', $this->slbCollection   , $this->arrParams['form']['collection_id']  , 'width: 17.5rem;border: 1px solid black');
    $rowCollection        = Helper::cmsRowForm(''     , $slbCollection);


for($i = 1; $i <= 12; $i++){
    $xhtml .='<section class="product-category product">
                        <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image'.$i.'" loading="lazy" decoding="async"
                                     src="'.$imageURL.'/default.png"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 3100px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input'.$i.'" type="file" name="picture'.$i.'">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>';
    $script .= '
                    const   image_input'.$i.'     = document.querySelector("#image_input'.$i.'");
                    var     upload_image'.$i.'    = "";

                    image_input'.$i.'.addEventListener("change", function () {
                        const reader = new FileReader();
                        reader.addEventListener("load", () => {
                            upload_image'.$i.' = reader.result;
                            document.querySelector("#display_image'.$i.'").src = `${upload_image'.$i.'}`;
                        });
                        reader.readAsDataURL(this.files[0]);
                    });
                ';
}

?>

    <div id="main" class="wrapper">
        <div class="page-container show_breadcrumb_v1 no-sidebar">
            <!-- Left Sidebar -->
            <div id="main-content">
                <div id="primary" class="site-content">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div id="product-3578"
                         class="gallery-layout-vertical has-gallery product type-product post-3578 status-publish first instock product_cat-accent-chairs product_cat-chair product_cat-chairs-loungers product_cat-dining-kitchen-furniture product_cat-dining-chairs product_cat-home-office-furniture product_cat-kids-desks-desk-chairs product_cat-living-room-furniture product_cat-new-now product_cat-new-arrivals product_cat-office-accessories product_cat-office-chairs product_cat-outdoor-lounge-furniture product_cat-room-inspiration product_cat-small-space-home-office product_cat-small-space-solutions product_cat-swivel-motion product_tag-furniture product_tag-trending product_tag-wood has-post-thumbnail sale featured shipping-taxable purchasable product-type-variable">
                        <div class="product-images-summary">
                            <form action="#" method="post" id="commentform" style="display: block" enctype="multipart/form-data">
                                <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-12 images"
                                     data-columns="12" style="opacity: 0; transition: opacity .25s ease-in-out;">
                                    <div class="content-wrapper loading">
                                        <div class="products">
                                            <?php echo $xhtml?>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary entry-summary">
                                    <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
                                        <input style="padding: 15px; margin-bottom: 2rem" placeholder="Name Product" id="author" class="input-text" name="form[name]" type="text" size="30" />
                                        <br>
                                        <div style="display: flex; justify-content: space-between">
                                            <?php echo $rowCategory.$rowCollection?>
                                        </div>


                                        <br>
                                        <textarea id="editor1"  name="form[description]" class="input-text" aria-required="true" placeholder="Description...">

                                        </textarea>

                                        <br>
                                    <script type="text/javascript">
                                        <?php echo $script;?>
                                    </script>
                                        <?php
                                            if($this->requestInfo == null){
                                                echo '<input name="form[token]" type="hidden" value="'.time().'"/>
                                                    <button style="padding: 15px" type="submit">Submit</button>';
                                            } else {
                                                echo '<button style="padding: 15px" type="button">Your request has been submitted</button>';
                                            }
                                        ?>
                                </div>
                            </form>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->

        </div>
    </div><!-- #main .wrapper -->
</div><!-- #page -->



