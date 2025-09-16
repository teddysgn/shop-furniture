<?php
    echo '<aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                <li style="background-image: url('.$imageURL.'/background-1.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container d-flex">
                         <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>QUALITY & CRAFTMANSHIP ELEVATE YOUR BEDROOM
                                    </h2>
                                    <p><a href="'.$linkBedroom.'" class="btn btn-primary btn-outline btn-lg">SHOP BEDROOM</a></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </li>
                <li style="background-image: url('.$imageURL.'/background-2.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container d-flex">
                         <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>modern ELEMENTS WITH </br> YOUR CHOSEN
                                    </h2>
                                    <p><a href="'.$linkLiving.'" class="btn btn-primary btn-outline btn-lg">SHOP LIVING ROOM</a></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </li>
                <li style="background-image: url('.$imageURL.'/background-3.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container d-flex">
                         <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>Flexible and functional
                                    </h2>
                                    <p><a href="'.$linkDining.'" class="btn btn-primary btn-outline btn-lg">EXPLORE DINING ROOM FURNITURE</a></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </li>
            </ul>
        </div>
    </aside>';
?>

<div id="fh5co-about">
    <div class="container">
        <div class="row">
            <a href="<?php echo $linkBedroom?>">
                <div class="col-md-4 col-sm-4 animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-staff">
                        <img src="<?php echo $imageURL; ?>/home-bed.jpg">
                        <h3>BEDROOM</h3>

                    </div>
                </div>
            </a>
            <a href="<?php echo $linkDining?>">
                <div class="col-md-4 col-sm-4 animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-staff">
                        <img src="<?php echo $imageURL; ?>/home-dining.jpg">
                        <h3>DINING ROOM</h3>

                    </div>
                </div>
            </a>
            <a href="<?php echo $linkLiving?>">
                <div class="col-md-4 col-sm-4 animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-staff">
                        <img src="<?php echo $imageURL; ?>/home-living.jpg">
                        <h3>LIVING ROOM</h3>

                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row" id="fh5co-about" style="padding-top: 0">
    <div style="padding-left: 0" class="col-md-8 slider-text">
        <img src="<?php echo $imageURL; ?>/register.jpg" alt="" width="100%">
    </div>
    <div class="col-md-4">
        <div style="padding: 8em 4rem 0">
            <div class="slider-text-inner">
                <div class="desc">
                    <h1>Join Our Trade Network</h1>
                    <p>Access our self-service trade platform to browse products, manage projects, place orders, and more!</p>
                    <a href="<?php echo $linkUser?>"><input type="button" value="Register" class="btn btn-primary"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="fh5co-about" style="padding-top: 0">
    <div style="padding: 0" class="col-md-4 slider-text">
        <img src="<?php echo $imageURL; ?>/block-2.jpg" width="100%" alt="" style="height: 600px; filter: brightness(0.8)">
    </div>
    <div style="padding: 0" class="col-md-4 slider-text">
        <div style="background-image: url('<?php echo $imageURL; ?>/block-1.jpg'); width: 100%; height: 600px; background-position: center">
            <div style="height: 600px; text-align: center; padding: 40% 30px; background-color: rgba(0, 0, 0, 0.2)">
                <h1 style="color: white">What’s to Come</h1>
                <p style="color: white">>We’re excited about our upcoming release including new pieces, new styles and new collections!</p>
                <a href="<?php echo $linkUser?>"><input type="button" value="Register" class="btn btn-primary"></a>
            </div>
        </div>
    </div>
    <div style="padding: 0" class="col-md-4 slider-text">
        <img src="<?php echo $imageURL; ?>/block-3.jpg" width="100%" alt="" style="height: 600px; filter: brightness(0.8)">
    </div>

</div>

<div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url(<?php echo $imageURL; ?>/img_bg_5.jpg);">
    <div class="container">
        <div class="row">
            <div class="display-t">
                <div class="display-tc">
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="feature-center">
                            <span class="icon">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                            <span class="counter js-counter" data-from="0" data-to="<?php echo $this->Total['view']?>" data-speed="3000" data-refresh-interval="50">1</span>
                            <span class="counter-label">Views</span>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="feature-center">
                            <span class="icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>

                            <span class="counter js-counter" data-from="0" data-to="<?php echo $this->Order['total']?>" data-speed="3000" data-refresh-interval="50">1</span>
                            <span class="counter-label">Orders</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="feature-center">
                            <span class="icon">
                                <i class="fa-solid fa-shop"></i>
                            </span>
                            <span class="counter js-counter" data-from="0" data-to="<?php echo $this->Total['total']?>" data-speed="3000" data-refresh-interval="50">1</span>
                            <span class="counter-label">Products</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 animate-box">
                        <div class="feature-center">
                            <span class="icon">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <span class="counter js-counter" data-from="0" data-to="<?php echo $this->User['total']?>" data-speed="3000" data-refresh-interval="50">1</span>
                            <span class="counter-label">Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-about">
    <h1 class="text-center">BESTSELLER</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
            	<div class="row">
            		<div class="MultiCarousel" data-items="1,2,2,3" data-slide="1" id="MultiCarousel"  data-interval="1000">
                        <div class="MultiCarousel-inner">
                            <?php
                                $i = 0;
                                foreach ($this->Special as $key => $value){
                                    $active = '';
                                    $name           = URL::filterURL($value['name']);
                                    $link	        = URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), $name.'-'.$value['id']);
                                    $picturePath	= UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'];
                                    if($i == 0) $active = 'active';
                                    $carousel .='<div class="item">
                                                    <div class="pad15">
                                                        <a href="'.$link.'" class="text-center lead">
                                                            <img src="'.$picturePath.'" class="img-responsive">
                                                            <h4>'.$value['name'].'</h4>
                                                        </a>
                                                    </div>
                                                </div>';
                                    $i++;
                                }
                                echo $carousel;
                            ?>
                            
                        </div>
                        <button class="btn btn-primary leftLst"><</button>
                        <button class="btn btn-primary rightLst">></button>
                    </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    .MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
    .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
        .MultiCarousel .MultiCarousel-inner .item { float: left;}
        .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:10px; margin:10px; color:#666;}
    .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
    .MultiCarousel .leftLst { left:0; }
    .MultiCarousel .rightLst { right:0; }
    
        .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
</style>
<script type="text/javascript">
    $(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});
</script>
