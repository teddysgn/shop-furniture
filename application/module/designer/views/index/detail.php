<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div id="page" class="hfeed site">

    <div id="main" class="wrapper"><!-- Page slider -->

        <div class="page-container ts-2-columns no-sidebar">
            <div class="wpcf7-form-control-wrap" id="main-content">
                <div id="primary" class="site-content">
                    <article id="post-5095" class="post-5095 page type-page status-publish hentry">
                        <div data-elementor-type="wp-page" data-elementor-id="5095" class="elementor elementor-5095">
                            <div class="elementor-element elementor-element-2b8c9a2 e-flex e-con-boxed e-con e-parent" data-id="2b8c9a2" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-9b86f4e e-flex e-con-boxed e-con e-child" data-id="9b86f4e" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                                        <div class="e-con-inner">
                                            <div class="elementor-element elementor-element-f9740d9 e-con-full e-flex e-con e-child" data-id="f9740d9" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                                <div class="elementor-element elementor-element-9fbd8f8 elementor-widget elementor-widget-heading" data-id="9fbd8f8" data-element_type="widget" data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">Detail Request - <?php echo ucfirst($_GET['type'])?> </h2>		</div>
                                                </div>
                                                <div class="elementor-element elementor-element-160084e elementor-widget elementor-widget-spacer" data-id="160084e" data-element_type="widget" data-widget_type="spacer.default">
                                                    <div class="elementor-widget-container">
                                                        <div class="elementor-spacer">
                                                            <div class="elementor-spacer-inner"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-584a33a elementor-widget elementor-widget-shortcode" data-id="584a33a" data-element_type="widget" data-widget_type="shortcode.default">
                                                    <div class="elementor-widget-container">
                                                        <div class="elementor-shortcode">
                                                            <div class="wpcf7 js" id="wpcf7-f10-p5095-o1" lang="en-US" dir="ltr">
                                                                <div class="screen-reader-response">
                                                                    <p role="status" aria-live="polite" aria-atomic="true">
                                                                    </p>
                                                                    <ul></ul>
                                                                </div>
                                                                <form action="" method="post" class="wpcf7-form init" aria-label="Contact form" novalidate="novalidate" data-status="init">
                                                                    <div class="ts-2-columns">
                                                                        <?php
                                                                            $oldItem = $this->oldItem;
                                                                            $newItem = $this->newItem;
                                                                            if($oldItem != null){
                                                                                echo '<h4 class="elementor-heading-title elementor-size-default">Recent Content</h4>';
                                                                            }
                                                                        ?>

                                                                        <h4 class="elementor-heading-title elementor-size-default">Request Content</h4>
                                                                    </div>
                                                                    <br>
                                                                    <div>
<!--                                                                    Recent Content-->
                                                                        <?php
                                                                            $oldItem = $this->oldItem;
                                                                            $newItem = $this->newItem;
//                                                                            echo '<pre>';
//                                                                            print_r($oldItem);
//                                                                            echo '</pre>';
                                                                        ?>
                                                                        <div class="row">
<!--                                                                        Rencent Item-->
                                                                            <?php
                                                                                if($oldItem != null){

                                                                            ?>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="col-lg-12">
                                                                                            <label style="width: 90%;">
                                                                                                Name
                                                                                                <span class="wpcf7-form-control-wrap"">
                                                                                                    <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" readonly aria-required="true" aria-invalid="false" value="<?php echo $oldItem['name']?>" type="text" name="your-name">
                                                                                                </span>
                                                                                            </label>
                                                                                            </br>
                                                                                            </br>
                                                                                            <label style="width: 90%;">
                                                                                                Description
                                                                                                <span class="wpcf7-form-control-wrap pt-2">
                                                                                                    <?php echo $oldItem['description']?>
                                                                                                </span>
                                                                                            </label>
                                                                                            </br>
                                                                                            </br>
                                                                                            <label style="width: 90%;">
                                                                                                Category Name
                                                                                                <span class="wpcf7-form-control-wrap">
                                                                                                    <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" readonly aria-required="true" aria-invalid="false" value="<?php echo $oldItem['category_name']?>" type="text" name="your-name">
                                                                                                </span>
                                                                                            </label>
                                                                                            </br>
                                                                                            </br>
                                                                                            <label style="width: 90%;">
                                                                                                Collection Name
                                                                                                <span class="wpcf7-form-control-wrap">
                                                                                                    <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" readonly aria-required="true" aria-invalid="false" value="<?php echo $oldItem['collection_name']?>" type="text" name="your-name">
                                                                                                </span>
                                                                                            </label>
                                                                                            <?php
                                                                                            $picture = '';
                                                                                            if($newItem['picture1'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 1
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture1'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture2'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                           </br>
                                                                                                                           </br>
                                                                                                                               <label>
                                                                                                                                   Picture 2
                                                                                                                                   <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture2'].'">
                                                                                                                               </label>
                                                                                                                           </div>';
                                                                                            if($newItem['picture3'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 3
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture3'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture4'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 4
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture4'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture5'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 5
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture5'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture6'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 6
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture6'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture7'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 7
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture7'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture8'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 8
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture8'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture9'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 9
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture9'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture10'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 10
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture10'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture11'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 11
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture11'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                            if($newItem['picture12'] != null)
                                                                                                $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 12
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'product/' . $oldItem['name'] . DS . $oldItem['picture12'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';

                                                                                            ?>
                                                                                            <div class="row">
                                                                                                <?php echo $picture?>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                            <?php
                                                                                }
                                                                            ?>
<!--                                                                        End Rencent Item-->
<!--                                                                        Request Item-->
                                                                            <div class="col-lg-6">
                                                                                <div class="col-lg-12">
                                                                                    <label style="width: 90%;">
                                                                                        Name
                                                                                        <span class="wpcf7-form-control-wrap"">
                                                                                        <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" readonly aria-required="true" aria-invalid="false" value="<?php echo $newItem['name']?>" type="text" name="your-name">
                                                                                        </span>
                                                                                    </label>
                                                                                    </br>
                                                                                    </br>
                                                                                    <label style="width: 90%;">
                                                                                        Description
                                                                                        <span class="wpcf7-form-control-wrap pt-2">
                                                                                                    <?php echo $newItem['description']?>
                                                                                                </span>
                                                                                    </label>
                                                                                    </br>
                                                                                    </br>
                                                                                    <label style="width: 90%;">
                                                                                        Category Name
                                                                                        <span class="wpcf7-form-control-wrap">
                                                                                                    <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" readonly aria-required="true" aria-invalid="false" value="<?php echo $newItem['category_name']?>" type="text" name="your-name">
                                                                                                </span>
                                                                                    </label>
                                                                                    </br>
                                                                                    </br>
                                                                                    <label style="width: 90%;">
                                                                                        Collection Name
                                                                                        <span class="wpcf7-form-control-wrap">
                                                                                                    <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" readonly aria-required="true" aria-invalid="false" value="<?php echo $newItem['collection_name']?>" type="text" name="your-name">
                                                                                                </span>
                                                                                    </label>
                                                                                    <?php
                                                                                    $picture = '';
                                                                                    $type = $this->arrParams['type'];
                                                                                    if($newItem['picture1'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 1
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture1'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture2'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                           </br>
                                                                                                                           </br>
                                                                                                                               <label>
                                                                                                                                   Picture 2
                                                                                                                                   <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture2'].'">
                                                                                                                               </label>
                                                                                                                           </div>';
                                                                                    if($newItem['picture3'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 3
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture3'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture4'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 4
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture4'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture5'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 5
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture5'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture6'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 6
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture6'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture7'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 7
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture7'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture8'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 8
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture8'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture9'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 9
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture9'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture10'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 10
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture10'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture11'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 11
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture11'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';
                                                                                    if($newItem['picture12'] != null)
                                                                                        $picture	            .= '<div class="col-lg-6">
                                                                                                                               </br>
                                                                                                                               </br>
                                                                                                                                   <label>
                                                                                                                                       Picture 12
                                                                                                                                       <img width="300" height="450" src="'.UPLOAD_URL . 'cache/' . $type . DS . $newItem['name'] . DS . $newItem['picture12'].'">
                                                                                                                                   </label>
                                                                                                                               </div>';

                                                                                    ?>
                                                                                    <div class="row">
                                                                                        <?php echo $picture?>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
<!--                                                                        End Request Item-->

                                                                            <?php
                                                                                $linkEdit = URL::createLink('designer', 'index', 'edit', array('product_id' => $newItem['product_id'], 'type' => $type, 'id' => $newItem['id']));
                                                                            ?>
                                                                            <a href="<?php echo $linkEdit?>" class="button mt-5">
                                                                                Edit Request
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                                                                </form>
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
                    </article>
                </div>
            </div>
        </div>
    </div><!-- #main .wrapper -->
</div><!-- #page -->

