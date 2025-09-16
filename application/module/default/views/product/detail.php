<?php
$productInfo	= $this->productInfo;
$name		= $productInfo['name'];
$stock		= $productInfo['stock'];
$sold		= $productInfo['sold'];
$id         = $_GET['product_id'];
$quantityInCart = $_SESSION['cart']['quantity'][$id];

$nameFilter     = URL::filterURL($productInfo['name']);
$linkThis	    = URL::createLink('default', 'product', 'detail', array('product_id' => $productInfo['id']), $nameFilter.'-'.$productInfo['id']);

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

$picture1Full	= '';
$picture2Full	= '';
$picture3Full	= '';
$picture4Full	= '';
$picture5Full	= '';
$picture6Full	= '';
$picture7Full	= '';
$picture8Full	= '';
$picture9Full	= '';
$picture10Full	= '';
$picture11Full	= '';
$picture12Full	= '';

$xhtml = '';
if(is_file($picture1Path)==true){
    if(file_exists($picture1Path)==true) {
        $picture1Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture1'];
        $xhtml .= ' <div class="item">
                    <div class="active text-center">
                        <figure>
                            <img data-fancybox="gallery" src="' . $picture1Full . '" alt="user">
                        </figure>
                    </div>
                </div>';
    }
}
if(is_file($picture2Path)==true){
    if(file_exists($picture2Path)==true) {
        $picture2Full = UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture2'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="' . $picture2Full . '" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture3Path)==true){
    if(file_exists($picture3Path)==true){
        $picture3Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture3'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture3Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture4Path)==true){
    if(file_exists($picture4Path)==true){
        $picture4Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture4'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture4Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture5Path)==true){
    if(file_exists($picture5Path)==true){
        $picture5Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture5'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture5Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture6Path)==true){
    if(file_exists($picture6Path)==true){
        $picture6Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture6'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture6Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture7Path)==true){
    if(file_exists($picture7Path)==true){
        $picture7Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture7'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture7Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture8Path)==true){
    if(file_exists($picture8Path)==true){
        $picture8Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture8'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture8Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture9Path)==true){
    if(file_exists($picture9Path)==true){
        $picture9Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture9'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture9Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture10Path)==true){
    if(file_exists($picture10Path)==true){
        $picture10Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture10'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture10Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture11Path)==true){
    if(file_exists($picture11Path)==true){
        $picture11Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture11'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture11Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}
if(is_file($picture12Path)==true){
    if(file_exists($picture12Path)==true){
        $picture12Full	= UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . $productInfo['picture12'];
        $xhtml .= ' <div class="item">
                        <div class="active text-center">
                            <figure>
                                <img data-fancybox="gallery" src="'.$picture12Full.'" alt="user">
                            </figure>
                        </div>
                    </div>';
    }
}

$description	            = $productInfo['description'];
$collection	                = $productInfo['collection_name'];
$collectionDescription	    = $productInfo['collection_description'];
$designer	                = $productInfo['designer_name'];

$nameDesigner   = URL::filterURL($productInfo['designer_name']);
$linkDesigner	= URL::createLink('default', 'designer', 'info', array('designer_id' => $productInfo['designer_id']), $productInfo['designer_id'].'-designer-'.$nameDesigner);

$linkCollection	    = URL::createLink('default', 'product', 'collection', array('collection_id' => $productInfo['collection_id']), 'collection-'.$productInfo['collection_id']);

$price = 0;
if($productInfo['sale_off'] > 0){
    $priceReal = (100-$productInfo['sale_off']) * $productInfo['price']/100;
    $price	 = ' <span class="red-through">'.number_format($productInfo['price']).' VNĐ</span>';
    $price	.= ' &nbsp;<span class="red">'.number_format($priceReal).' VNĐ</span>';
}else{
    $priceReal	= $productInfo['price'];
    $price	= ' <span class="red">'.number_format($priceReal).' VNĐ</span>';
}

$linkOrder	= URL::createLink('default', 'user', 'order', array('product_id' => $productInfo['id'], 'price' => $priceReal), $productInfo['id'] . '-' . $priceReal);

if($stock > 0 && $stock - $quantityInCart > 0){
    $blockOrder = '<a style="margin-right: 20px" href="'.$linkOrder.'" class="price hover"><i class="fa-solid fa-order-shopping"></i> Add to Cart</a>
                    <table class="table table-borderless text-left">
                    <thead>
                      <tr class="text-left">
                        <th>Sold</th>
                        <th>Inventory</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>'.$sold.'</td>
                        <td>'.$stock.'</td>
                      </tr>
                    </tbody>
                  </table>';
    if(isset($_SESSION['cart']['quantity'][$id]))
        $blockOrder = '<a style="margin-right: 20px" href="'.$linkOrder.'" class="price hover"><i class="fa-solid fa-order-shopping"></i> Add to Cart</a>
                    <table class="table table-borderless text-left">
                    <thead>
                      <tr>
                        <th>Sold</th>
                        <th>Inventory</th>
                        <th>In Cart</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>'.$sold.'</td>
                        <td>'.$stock.'</td>
                        <td>'.$quantityInCart.'</td>
                      </tr>
                    </tbody>
                  </table>';
}
else{
    $blockOrder .= '<a class="price btn-danger"><i class="fa-regular fa-face-sad-cry"></i>&nbsp; Out of Stock</a>
                    <table class="table table-borderless text-left">
                        <thead>
                          <tr>
                            <th>Sold</th>
                            <th>In Cart</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>'.$sold.'</td>
                            <td>'.$quantityInCart.'</td>
                          </tr>
                        </tbody>
                      </table>';
}
    

?>

<div id="fh5co-product" style="padding-bottom: 0px; margin-bottom: 100px" >
    <div class="container">
        <div class="row">
            <div class="col-md-6 animate-box">
                <div class="owl-carousel owl-carousel-fullwidth product-carousel">
                    <?php echo $xhtml;?>
                </div>
                <?php 
                    if(file_exists(UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . '360')){
                ?>
                <!--Modal 3D-->
                <div class="content-container text-center product-carousel">
                    <div class="img-container">
                        <button class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'">
                            3D View</button>
                    </div>
                </div>
                
                <div id="id01"  class="modal">
                    <div class="center">
                        <div class="rotation">
                            <?php                 
                                foreach (glob(UPLOAD_PATH . 'product' . DS . $productInfo['name'] . DS . '360' . '/*') as $filename) {
                                    if(is_file($filename) == true){
                                        $info = pathinfo($filename);
                                        $pictureName = $info['basename'];
                                        echo "<img src='". UPLOAD_URL . 'product' . DS . $productInfo['name'] . DS . '360' . DS .$pictureName."'>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <?php
                    }
                ?>
                <!--navigation-End-->

                <div class="row animate-box" style="margin: 10px">
                    <h3>Share on</h3>
                    <div class="col-md-12 text-center fh5co-heading">
                        <div class="social" style="display: flex; justify-content: space-evenly; font-size: 35px">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https:/hoangvupcx.com/<?php echo $linkThis?>" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&su=https:/hoangvupcx.com/<?php echo $linkThis?>"><i class="fab fa-twitter"></i></a>
                            <a href="https://ads.google.com/intl/vi_vn/getstarted/?subid=vn-vi-ha-awa-bk-c-l00!o3~Cj0KCQjwpreJBhDvARIsAF1_BU0gVty5XnpyxESqt2ekO4PX48hqa7GhxhUliWslavbkWfshDjcpb70aAhLTEALw_wcB~123593086017~kwd-21283811~13984401112~538552239800&amp;gclsrc=aw.ds&amp;gclid=Cj0KCQjwpreJBhDvARIsAF1_BU0gVty5XnpyxESqt2ekO4PX48hqa7GhxhUliWslavbkWfshDjcpb70aAhLTEALw_wcB"><i class="fab fa-google-plus-g"></i></a>
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 container">
                <div class="fh5co-tabs animate-box">
                    <!-- Tabs -->
                    <div class="fh5co-tab-content-wrap">
                        <div class="col-md-10 col-md-offset-1">
                            <div>
                                <span style="margin-right: 20px" class="price">
                                    <?php echo $price?>
                                </span>
                                <span style="width: 100%;">
                                    <?php echo $blockOrder?>
                                </span>
                                <h2 style="font-weight: bold"><?php echo $name?></h2>
                            <?php echo $description?>
                            <p style="margin-bottom: 0; font-weight: bolder">Collection: <a href="<?php echo $linkCollection?>"><?php echo $collection?></a> </p>
                            <p style="font-weight: bolder">Designer: <a href="#designer"><?php echo $designer?></a> </p>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <!--// Information Collection-->
        
    </div>
</div>


    <div class="container collection">
        <div class="row" style="margin: 0px">
            <div class="col-md-12">
                <h2 style="font-weight: bold">About the Collection</h2>
                <p><?php echo $collectionDescription?></p>
                <div class="row"  style="margin: 0px">
                    <div class="col-md-6">
                        <h2 class="uppercase">Keep it simple</h2>
                        <p>Ullam dolorum iure dolore dicta fuga ipsa velit veritatis</p>
                    </div>
                    <div class="col-md-6">
                        <h2 class="uppercase">Less is more</h2>
                        <p>Ullam dolorum iure dolore dicta fuga ipsa velit veritatis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Comment-->
    <div class="container">
        <div class="row" style="margin: 0px">
            <div class="col-md-12">
                <h2 style="font-weight: bold">Comment & Review</h2>
                <?php
                    if(isset($_SESSION['user']) && $this->show != null){
                ?>
            			<form action="#" method="post">
                			<div>
                				<div>
                				    <h3>Your Comment</h3>
                				    <small>
                				        <i class="fa-solid fa-triangle-exclamation" style="color: #F5C33B"></i>
                				        You're commenting as <?php echo $_SESSION['user']['info']['fullname']?>.
            				        </small>
                				    <div class="form-group">
                				        <textarea class="form-control" name="form[comment]" placeholder="Comment as <?php echo $_SESSION['user']['info']['fullname']?>"></textarea>
                				        <input type="hidden" name="form[id]" value="<?php echo $productInfo['id']?>">
                				    </div>
                				    <div class="form-group">
                				        <input type="hidden" name="form[token]" value="<?php echo time()?>">
                				        <button type="submit" class="btn btn-danger">Submit</button>
                				    </div>
                				</div>
                			</div>
            			</form>
    			<?php
                    }
    			?>
    			<div class="feed">
    			    <?php
    			    if($this->comment != null){
    			        foreach($this->comment as $key => $value){
    			            $userComment = $value['fullname'] == $_SESSION['user']['info']['fullname'] ? 'You Commented' : $value['fullname'];
    			            echo '
        			            <div>
        			                <blockquote>
                						<p>'.$value['content'].'</p>
                					</blockquote>
                					<small>'.$value['date'].'</small>
                					<h3>— '. $userComment .'</h3>
            					</div>
    			            ';
    			        }
    			    }else {
    			        echo '<h3>No Comment Yet!!!</h3>';
    			    }
    			        
    			    ?>
    			</div>
    		</div>
		</div>
        <div class="row" style="margin: 0px">
            <div class="col-md-10 col-md-offset-1">
                <div class="fh5co-tabs animate-box">
                    <ul class="fh5co-tab-nav">
                        <li class="active"><a href="#" data-tab="1"><span class="icon visible-xs"><i class="icon-file"></i></span><span class="hidden-xs">SPECIFICATION</span></a></li>
                        <li><a href="#" data-tab="2"><span class="icon visible-xs"><i class="icon-bar-graph"></i></span><span class="hidden-xs">RETURNS</span></a></li>
                    </ul>

                    <!-- Tabs -->
                    <div class="fh5co-tab-content-wrap">
                        <div class="fh5co-tab-content tab-content active" data-tab-content="1">
                            <div class="col-md-10 col-md-offset-1">
                                <h3>Product Specification</h3>
                                <ul>
                                    <li>&#10003; &nbsp;&nbsp;Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci dignissimos consectetur magni quas eius</li>
                                    <li>&#10003; &nbsp;&nbsp;adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta eligendi</li>
                                    <li>&#10003; &nbsp;&nbsp;Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                    <li>&#10003; &nbsp;&nbsp;Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                </ul>
                                <ul>
                                    <li>&#10003; &nbsp;&nbsp;Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci dignissimos consectetur magni quas eius</li>
                                    <li>&#10003; &nbsp;&nbsp;adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta eligendi</li>
                                    <li>&#10003; &nbsp;&nbsp;Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                    <li>&#10003; &nbsp;&nbsp;Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="fh5co-tab-content tab-content" data-tab-content="2">
                            <div class="col-md-10 col-md-offset-1">
                                <h3>1. SEND A RETURN AUTHORIZATION REQUEST</h3>
                                <ul>
                                    <li><img width="120" height="120" src="<?php echo $imageURL?>/ran_step_1.png" alt=""> &nbsp;&nbsp;Fill in and send the Return Proforma Invoice and place it inside your package.</li>
                                </ul>
                                <h3>2. ATTACH THE RETURN LABEL</h3>
                                <ul>
                                    <li><img width="120" height="120" src="<?php echo $imageURL?>/ran_step_2.png" alt=""> &nbsp;&nbsp;You can find it in the original package.</li>
                                </ul>
                                <h3>3. CALL THE COURIER</h3>
                                <ul>
                                    <li><img width="120" height="120" src="<?php echo $imageURL?>/ran_step_3.png" alt=""> &nbsp;&nbsp;Contact the courier indicated on the return label in the ways noted</li>
                                </ul>
                                <h3 id="designer">4. SHIPPING</h3>
                                <ul>
                                    <li><img width="120" height="120" src="<?php echo $imageURL?>/ran_step_4.png" alt=""> &nbsp;&nbsp;Wait for courier pickup or bring your package to the collection center</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div style="padding: 8em 4rem 0">
                    <div class="slider-text-inner">
                        <div class="desc">
                            <h1>MEET THE DESIGNER</h1>
                            <p style="padding-right: 30%"><?php echo $productInfo['comment'];?></p>
                            <input onclick="window.location='<?php echo $linkDesigner?>'" class="btn btn-small btn-outline" style="padding: 15px 30px; width: 50%" value="Get to know <?php echo $productInfo['designer_name']?>">
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding-left: 0" class="col-md-6 slider-text">
                <img width="100%" height="100%" src="<?php echo UPLOAD_URL . 'designer' . DS . $productInfo['designer_name'] . DS . $productInfo['picture_profile'];?>" alt="">
            </div>
        </div>
    </div>


<?php
$xhtmlRelateProducts = '';
if(!empty($this->productRelated)){
    foreach($this->productRelated as $key => $value){
        $nameFilter     = URL::filterURL($value['name']);
        $name           = $value['name'];
        $link	        = URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), $nameFilter.'-'.$value['id']);

        $picturePath	= UPLOAD_PATH . 'product' . DS . $value['name'] . DS . $value['picture1'];
        if(file_exists($picturePath)==true){
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'].'">';
        }else{
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
        }

        $xhtmlRelateProducts 	.= '<div class="col-md-4 col-sm-6 text-center animate-box">
                        <div class="product">
                        <a href="'.$link.'">
                            <div class="product-grid">
                                    '.$picture.'
                            </div>
                            <div class="desc">
                                <h3><a href="'.$link.'">'.$name.'</a></h3>
                            </div>
                            </a>
                        </div>
                    </div>';
    }
}
?>
<div id="fh5co-product">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                <h2>RELATED PRODUCTS</h2>
            </div>
        </div>
        <div class="row">
            <?php echo $xhtmlRelateProducts?>
        </div>
    </div>
</div>


<?php
$xhtmlCollectionProducts = '';
if(!empty($this->productCollection)){
    foreach($this->productCollection as $key => $value){
        $nameFilter     = URL::filterURL($value['name']);
        $name           = $value['name'];
        $link	        = URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), $nameFilter.'-'.$value['id']);

        $picturePath	= UPLOAD_PATH . 'product' . DS . $value['name'] . DS . $value['picture1'];
        if(file_exists($picturePath)==true){
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'].'">';
        }else{
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
        }

        $xhtmlCollectionProducts 	.= '<div class="col-md-4 col-sm-6 text-center animate-box">
                        <div class="product">
                        <a href="'.$link.'">
                            <div class="product-grid">
                                    '.$picture.'
                            </div>
                            <div class="desc">
                                <h3><a href="'.$link.'">'.$name.'</a></h3>
                            </div>
                            </a>
                        </div>
                    </div>';
    }
}
?>
<div id="fh5co-product">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                <h2>MORE FROM THIS COLLECTION</h2>
            </div>
        </div>
        <div class="row">
            <?php echo $xhtmlCollectionProducts?>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>
<script>
    Fancybox.bind('[data-fancybox="gallery"]', {
        // Your custom options for a specific gallery
    });
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>
    (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
            'use strict';

            function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

            var _circlr = require('circlr');

            var _circlr2 = _interopRequireDefault(_circlr);

            var el = document.querySelector('.rotation');
            var btnScroll = document.querySelector('.btn-scroll');
            var btnCycle = document.querySelector('.btn-cycle');
            var btnReverse = document.querySelector('.btn-reverse');
            var btnPrev = document.querySelector('.btn-prev');
            var btnNext = document.querySelector('.btn-next');
            var btnPlay = document.querySelector('.btn-play');
            var btnPlayTo = document.querySelector('.btn-play-to');
            var camera = (0, _circlr2['default'])(el).scroll(true);

            btnScroll.addEventListener('click', function (e) {
                toggleActive(e.target);
                camera.scroll(isActive(e.target));
            }, false);

            btnCycle.addEventListener('click', function (e) {
                toggleActive(e.target);
                camera.cycle(isActive(e.target));
            }, false);

            btnReverse.addEventListener('click', function (e) {
                toggleActive(e.target);
                camera.reverse(isActive(e.target));
            }, false);

            btnPrev.addEventListener('click', function () {
                camera.prev();
            }, false);

            btnNext.addEventListener('click', function () {
                camera.next();
            }, false);

            btnPlay.addEventListener('click', function (e) {
                if (e.target.innerHTML === 'Play') {
                    camera.play();
                    e.target.innerHTML = 'Stop';
                } else {
                    camera.stop();
                    e.target.innerHTML = 'Play';
                }
            }, false);

            btnPlayTo.addEventListener('click', function () {
                camera.play(0);
            }, false);

            function toggleActive(el) {
                if (isActive(el)) {
                    el.className = el.className.replace(/(active)/, '');
                } else {
                    el.className += ' active';
                }
            }

            function isActive(el) {
                return el.className.includes('active');
            }

        },{"circlr":2}],2:[function(require,module,exports){
            'use strict';
            var Emitter = require('component-emitter');
            var wheel = require('eventwheel');

            module.exports = Rotation;

            function Rotation(el) {
                if (!(this instanceof Rotation)) return new Rotation(el);
                if (typeof el === 'string') el = document.querySelector(el);
                this.el = el;
                this.current = 0;
                this.cycle(true);
                this.interval(75);
                this.start(0);
                this.onTouchStart = this.onTouchStart.bind(this);
                this.onTouchMove = this.onTouchMove.bind(this);
                this.onTouchEnd = this.onTouchEnd.bind(this);
                this.onWheel = this.onWheel.bind(this);
                this.bind();
            }

            Emitter(Rotation.prototype);

            Rotation.prototype.scroll = function (n) {
                if (this._scroll === n) return this;
                this._scroll = n;

                if (this._scroll) {
                    wheel.bind(this.el, this.onWheel);
                } else {
                    wheel.unbind(this.el, this.onWheel);
                }

                return this;
            };

            Rotation.prototype.vertical = function (n) {
                this._vertical = n;
                return this;
            };

            Rotation.prototype.reverse = function (n) {
                this._reverse = n;
                return this;
            };

            Rotation.prototype.cycle = function (n) {
                this._cycle = n;
                return this;
            };

            Rotation.prototype.interval = function (ms) {
                this._interval = ms;
                return this;
            };

            Rotation.prototype.start = function (n) {
                var children = this.children();
                this.el.style.position = 'relative';
                this.el.style.width = '100%';

                for (var i = 0, len = children.length; i < len; i++) {
                    children[i].style.display = 'none';
                    children[i].style.width = '100%';
                }

                this.show(n);
                return this;
            };

            Rotation.prototype.play = function (n) {
                if (this.timer) return;
                var self = this;

                function timer() {
                    if (n === undefined || n > self.current) self.next();
                    if (n < self.current) self.prev();
                    if (n === self.current) self.stop();
                }

                this.timer = setInterval(timer, this._interval);
                return this;
            };

            Rotation.prototype.stop = function () {
                clearInterval(this.timer);
                this.timer = null;
                return this;
            };

            Rotation.prototype.prev = function () {
                return this.show(this.current - 1);
            };

            Rotation.prototype.next = function () {
                return this.show(this.current + 1);
            };

            Rotation.prototype.show = function (n) {
                var children = this.children();
                var len = children.length;
                if (n < 0) n = this._cycle ? n + len : 0;
                if (n > len - 1) n = this._cycle ? n - len : len - 1;
                children[this.current].style.display = 'none';
                children[n].style.display = 'block';
                if (n !== this.current) this.emit('show', n, len);
                this.current = n;
                return this;
            };

            Rotation.prototype.bind = function () {
                this.el.addEventListener('touchstart', this.onTouchStart, false);
                this.el.addEventListener('touchmove', this.onTouchMove, false);
                this.el.addEventListener('touchend', this.onTouchEnd, false);
                this.el.addEventListener('mousedown', this.onTouchStart, false);
                this.el.addEventListener('mousemove', this.onTouchMove, false);
                document.addEventListener('mouseup', this.onTouchEnd, false);
                if (this._scroll) wheel.bind(this.el, this.onWheel);
            };

            Rotation.prototype.unbind = function () {
                this.el.removeEventListener('touchstart', this.onTouchStart, false);
                this.el.removeEventListener('touchmove', this.onTouchMove, false);
                this.el.removeEventListener('touchend', this.onTouchEnd, false);
                this.el.removeEventListener('mousedown', this.onTouchStart, false);
                this.el.removeEventListener('mousemove', this.onTouchMove, false);
                document.removeEventListener('mouseup', this.onTouchEnd, false);
                if (this._scroll) wheel.unbind(this.el, this.onWheel);
            };

            Rotation.prototype.onTouchStart = function (event) {
                if (this.timer) this.stop();
                event.preventDefault();
                this.touch = this.getTouch(event);
                this.currentTouched = this.current;
            };

            Rotation.prototype.onTouchMove = function (event) {
                if (typeof this.touch !== 'number') return;
                event.preventDefault();
                var touch = this.getTouch(event);
                var len = this.children().length;
                var max = this.el[this._vertical ? 'clientHeight' : 'clientWidth'];
                var offset = touch - this.touch;
                offset = this._reverse ? -offset : offset;
                offset = Math.floor(offset / max * len);
                this.show(this.currentTouched + offset);
            };

            Rotation.prototype.onTouchEnd = function (event) {
                if (typeof this.touch !== 'number') return;
                event.preventDefault();
                this.touch = null;
            };

            Rotation.prototype.onWheel = function (event) {
                if (this.timer) this.stop();
                event.preventDefault();
                var delta = event.deltaY || event.detail || (-event.wheelDelta);
                delta = delta !== 0 ? delta / Math.abs(delta) : delta;
                delta = this._reverse ? -delta : delta;
                this[delta > 0 ? 'next' : 'prev']();
            };

            Rotation.prototype.children = function () {
                var nodes = this.el.childNodes;
                var elements = [];

                for (var i = 0, len = nodes.length; i < len; i++) {
                    if (nodes[i].nodeType === 1) elements.push(nodes[i]);
                }

                return elements;
            };

            Rotation.prototype.getTouch = function (event) {
                event = /^touch/.test(event.type) ? event.changedTouches[0] : event;

                return this._vertical ?
                    event.clientY - this.el.offsetTop :
                    event.clientX - this.el.offsetLeft;
            };

        },{"component-emitter":3,"eventwheel":5}],3:[function(require,module,exports){

            /**
             * Expose `Emitter`.
             */

            if (typeof module !== 'undefined') {
                module.exports = Emitter;
            }

            /**
             * Initialize a new `Emitter`.
             *
             * @api public
             */

            function Emitter(obj) {
                if (obj) return mixin(obj);
            };

            /**
             * Mixin the emitter properties.
             *
             * @param {Object} obj
             * @return {Object}
             * @api private
             */

            function mixin(obj) {
                for (var key in Emitter.prototype) {
                    obj[key] = Emitter.prototype[key];
                }
                return obj;
            }

            /**
             * Listen on the given `event` with `fn`.
             *
             * @param {String} event
             * @param {Function} fn
             * @return {Emitter}
             * @api public
             */

            Emitter.prototype.on =
                Emitter.prototype.addEventListener = function(event, fn){
                    this._callbacks = this._callbacks || {};
                    (this._callbacks['$' + event] = this._callbacks['$' + event] || [])
                        .push(fn);
                    return this;
                };

            /**
             * Adds an `event` listener that will be invoked a single
             * time then automatically removed.
             *
             * @param {String} event
             * @param {Function} fn
             * @return {Emitter}
             * @api public
             */

            Emitter.prototype.once = function(event, fn){
                function on() {
                    this.off(event, on);
                    fn.apply(this, arguments);
                }

                on.fn = fn;
                this.on(event, on);
                return this;
            };

            /**
             * Remove the given callback for `event` or all
             * registered callbacks.
             *
             * @param {String} event
             * @param {Function} fn
             * @return {Emitter}
             * @api public
             */

            Emitter.prototype.off =
                Emitter.prototype.removeListener =
                    Emitter.prototype.removeAllListeners =
                        Emitter.prototype.removeEventListener = function(event, fn){
                            this._callbacks = this._callbacks || {};

                            // all
                            if (0 == arguments.length) {
                                this._callbacks = {};
                                return this;
                            }

                            // specific event
                            var callbacks = this._callbacks['$' + event];
                            if (!callbacks) return this;

                            // remove all handlers
                            if (1 == arguments.length) {
                                delete this._callbacks['$' + event];
                                return this;
                            }

                            // remove specific handler
                            var cb;
                            for (var i = 0; i < callbacks.length; i++) {
                                cb = callbacks[i];
                                if (cb === fn || cb.fn === fn) {
                                    callbacks.splice(i, 1);
                                    break;
                                }
                            }
                            return this;
                        };

            /**
             * Emit `event` with the given args.
             *
             * @param {String} event
             * @param {Mixed} ...
             * @return {Emitter}
             */

            Emitter.prototype.emit = function(event){
                this._callbacks = this._callbacks || {};
                var args = [].slice.call(arguments, 1)
                    , callbacks = this._callbacks['$' + event];

                if (callbacks) {
                    callbacks = callbacks.slice(0);
                    for (var i = 0, len = callbacks.length; i < len; ++i) {
                        callbacks[i].apply(this, args);
                    }
                }

                return this;
            };

            /**
             * Return array of callbacks for `event`.
             *
             * @param {String} event
             * @return {Array}
             * @api public
             */

            Emitter.prototype.listeners = function(event){
                this._callbacks = this._callbacks || {};
                return this._callbacks['$' + event] || [];
            };

            /**
             * Check if this emitter has `event` handlers.
             *
             * @param {String} event
             * @return {Boolean}
             * @api public
             */

            Emitter.prototype.hasListeners = function(event){
                return !! this.listeners(event).length;
            };

        },{}],4:[function(require,module,exports){
            var bind = window.addEventListener ? 'addEventListener' : 'attachEvent',
                unbind = window.removeEventListener ? 'removeEventListener' : 'detachEvent',
                prefix = bind !== 'addEventListener' ? 'on' : '';

            /**
             * Bind `el` event `type` to `fn`.
             *
             * @param {Element} el
             * @param {String} type
             * @param {Function} fn
             * @param {Boolean} capture
             * @return {Function}
             * @api public
             */

            exports.bind = function(el, type, fn, capture){
                el[bind](prefix + type, fn, capture || false);
                return fn;
            };

            /**
             * Unbind `el` event `type`'s callback `fn`.
             *
             * @param {Element} el
             * @param {String} type
             * @param {Function} fn
             * @param {Boolean} capture
             * @return {Function}
             * @api public
             */

            exports.unbind = function(el, type, fn, capture){
                el[unbind](prefix + type, fn, capture || false);
                return fn;
            };
        },{}],5:[function(require,module,exports){

            'use strict';

            /**
             * Module dependencies
             */

            try {
                var events = require('event');
            } catch (err) {
                var events = require('component-event');
            }

            /**
             * Wheel events
             */

            var wheelEventsMap = [
                'wheel',
                'mousewheel',
                'scroll',
                'DOMMouseScroll'
            ];

            /**
             * Wheel event name
             */

            var wheelEvent = 'mousewheel';

            if (window.addEventListener) {
                for (var e = 0; e < wheelEventsMap.length; e++) {
                    if ('on' + wheelEventsMap[e] in window) {
                        wheelEvent = wheelEventsMap[e];
                        break;
                    }
                }
            }

            /**
             * Expose bind
             */

            module.exports = bind.bind = bind;

            /**
             * Bind
             *
             * @param  {Element} element
             * @param  {Function} fn
             * @param  {Boolean} capture
             * @return {Function}
             * @api public
             */


            function bind(element, fn, capture) {
                return events.bind(element, wheelEvent, fn, capture || false);
            }

            /**
             * Expose unbind
             *
             * @param  {Element} element
             * @param  {Function} fn
             * @param  {Boolean} capture
             * @return {Function}
             * @api public
             */

            module.exports.unbind = function(element, fn, capture) {
                return events.unbind(element, wheelEvent, fn, capture || false);
            };

        },{"component-event":4,"event":4}]},{},[1]);

</script>
<style>
    .center{
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        width:800px;}
    .center img{
        display:flex;
        margin:auto;}

    .modal{
        display:none;
        position:fixed;
        z-index:1;
        left:0;
        top:0;
        width:100%;
        height:100%;
        overflow:auto;
        background-color:rgba(0,0,0,0.4);
        overflow-x: hidden;
    }
    th, td{
        text-align: left !important;
        font-weight: normal !important;
        border: none !important;
    }
</style>
<script type="text/javascript">
    !function (d) {
        var c = "portfilter";
        var b = function (e) {
            this.$element = d(e);
            this.stuff = d("[data-tag]");
            this.target = this.$element.data("target") || ""
        };
        b.prototype.filter = function (g) {
            var e = [], f = this.target;
            this.stuff.fadeOut("fast").promise().done(function () {
                d(this).each(function () {
                    if (d(this).data("tag") == f || f == "all") {
                        e.push(this)
                    }
                });
                d(e).show()
            })
        };
        var a = d.fn[c];
        d.fn[c] = function (e) {
            return this.each(function () {
                var g = d(this), f = g.data(c);
                if (!f) {
                    g.data(c, (f = new b(this)))
                }
                if (e == "filter") {
                    f.filter()
                }
            })
        };
        d.fn[c].defaults = {};
        d.fn[c].Constructor = b;
        d.fn[c].noConflict = function () {
            d.fn[c] = a;
            return this
        };
        d(document).on("click.portfilter.data-api", "[data-toggle^=portfilter]", function (f) {
            d(this).portfilter("filter")
        })
    }(window.jQuery);

</script>