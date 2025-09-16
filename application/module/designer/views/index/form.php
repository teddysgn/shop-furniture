<?php
    $imageURL       = $this->_dirImg;
    $linkHome = URL::createLink('designer', 'index', 'index', null, 'builder');

    $productInfo = $this->productInfo;
    $linkForm = URL::createLink('designer', 'index', 'form', array('product_id' => $productInfo['id']));

    $slbCategory		= Helper::cmsSelectbox('form[category_id]'  , 'inputbox form-control', $this->slbCategory   , $this->productInfo['category_id']  , 'width: 17.5rem; border: 1px solid black');
    $rowCategory        = Helper::cmsRowForm(''     , $slbCategory);

    $slbCollection		= Helper::cmsSelectbox('form[collection_id]'  , 'inputbox form-control', $this->slbCollection   , $this->productInfo['collection_id']  , 'width: 17.5rem;border: 1px solid black');
    $rowCollection        = Helper::cmsRowForm(''     , $slbCollection);



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
            $xhtml .= '<section class="product-category product">
                            <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                    <img id="display_image1" loading="lazy" decoding="async" 
                                         src="'.$picture1Full.'"
                                         alt="Chair" width="600" height="600"
                                         sizes="(max-width: 310px) 310px"/> </a>
                                <div class="meta-wrapper">
                                    <div class="category-name">
                                        <h3 class="heading-title">
                                            <input id="image_input1" type="file" name="picture1">
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </section>
                        ';
        }
    }
    if(is_file($picture2Path)==true){
            if(file_exists($picture2Path)==true) {
                $picture2Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture2'];
                $xhtml .= '<section class="product-category product">
                            <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                    <img id="display_image2" loading="lazy" decoding="async"
                                         src="'.$picture2Full.'"
                                         alt="Chair" width="600" height="600"
                                         sizes="(max-width: 310px) 100vw, 310px"/> </a>
                                <div class="meta-wrapper">
                                    <div class="category-name">
                                        <h3 class="heading-title">
                                            <input id="image_input2" type="file" name="picture2">
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </section>
                        ';
            }
        }
    if(is_file($picture3Path)==true){
        if(file_exists($picture3Path)==true) {
            $picture3Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture3'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image3" loading="lazy" decoding="async"
                                     src="'.$picture3Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input3" type="file" name="picture3">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture4Path)==true){
        if(file_exists($picture4Path)==true) {
            $picture4Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture4'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image4" loading="lazy" decoding="async"
                                     src="'.$picture4Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input4" type="file" name="picture4">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture5Path)==true){
        if(file_exists($picture5Path)==true) {
            $picture5Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture5'];
            $xhtml .= '<section class="product-category product">
                        <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image5" loading="lazy" decoding="async"
                                     src="'.$picture5Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input5" type="file" name="picture5">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture6Path)==true){
        if(file_exists($picture6Path)==true) {
            $picture6Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture6'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image6" loading="lazy" decoding="async"
                                     src="'.$picture6Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input6" type="file" name="picture6">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture7Path)==true){
        if(file_exists($picture7Path)==true) {
            $picture7Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture7'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image7" loading="lazy" decoding="async"
                                     src="'.$picture7Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input7" type="file" name="picture7">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture8Path)==true){
        if(file_exists($picture8Path)==true) {
            $picture8Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture8'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image8" loading="lazy" decoding="async"
                                     src="'.$picture8Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input8" type="file" name="picture8">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture9Path)==true){
        if(file_exists($picture9Path)==true) {
            $picture9Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture9'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image9" loading="lazy" decoding="async"
                                     src="'.$picture9Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input9" type="file" name="picture9">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture10Path)==true){
        if(file_exists($picture10Path)==true) {
            $picture10Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture10'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image10" loading="lazy" decoding="async"
                                     src="'.$picture10Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input10" type="file" name="picture10">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture11Path)==true){
        if(file_exists($picture11Path)==true) {
            $picture11Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture11'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image11" loading="lazy" decoding="async"
                                     src="'.$picture11Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input11" type="file" name="picture11">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }
    if(is_file($picture12Path)==true){
        if(file_exists($picture12Path)==true) {
            $picture12Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture12'];
            $xhtml .= '<section class="product-category product">
                       <div class="product-wrapper" style="flex-flow: unset">
                                <a style="border-radius: unset; width: 100%; border: 1px solid black">
                                <img id="display_image12" loading="lazy" decoding="async"
                                     src="'.$picture12Full.'"
                                     alt="Chair" width="600" height="600"
                                     sizes="(max-width: 310px) 100vw, 310px"/> </a>
                            <div class="meta-wrapper">
                                <div class="category-name">
                                    <h3 class="heading-title">
                                        <input id="image_input12" type="file" name="picture12">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
        }
    }


for($i = 1; $i <= 12; $i++){
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
                                        <input style="padding: 15px" placeholder="Name" id="author" class="input-text" name="form[name]" type="text" value="<?php echo $productInfo['name']?>" size="30" />
                                        <br><br><br><br><br><br><br>
                                        <div style="display: flex; justify-content: space-between">
                                            <?php echo $rowCategory.$rowCollection?>
                                        </div>
                                        <input type="hidden" name="form[product_name]" value="<?php echo $productInfo['name']?>">
                                        <br>
                                        <textarea id="editor1"  name="form[description]" class="input-text" aria-required="true" placeholder="Description...">
                                            <?php echo $productInfo['description']?>
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



<?php } else  URL::redirect('designer', 'index', 'index');?>