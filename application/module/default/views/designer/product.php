<?php
$paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'product', 'shop'));

$nameFilter = URL::filterURL($this->designerName[$_GET['designer_id']]);
$linkSubmitForm = URL::createLink('default', 'designer', 'product', array('designer_id' => $_GET['designer_id']), $_GET['designer_id'].'-designs-by-'.$nameFilter);

$xhtml = '';
if(!empty($this->Items)){
    foreach($this->Items as $key => $value){
        $nameFilter     = URL::filterURL($value['name']);
        $link	        = URL::createLink('default', 'product', 'detail', array('product_id' => $value['id']), $nameFilter.'-'.$value['id']);
        $name	        = $value['name'];
        $price          = $value['price'];

        $picturePath	= UPLOAD_PATH . 'product' . DS . $value['name'] . DS . $value['picture1'];
        if(file_exists($picturePath)==true){
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . $value['name'] . DS . $value['picture1'].'">';
        }else{
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
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

        $linkOrder	= URL::createLink('default', 'user', 'order', array('product_id' => $value['id'], 'price' => $priceReal), $value['id'] . '-' . $priceReal);
        $blockOrder = '<a style="padding: 15px; margin: 0 10px" href="'.$linkOrder.'" class="price" title="Add to Cart"><i class="fa-solid fa-cart-shopping"></i></a>';

        if($stock <= 0 && $stock - $quantityInCart <= 0)
            $blockOrder = '<a style="margin: 0 10px; padding: 15px" class="price" title="Out of Stock"><i class="fa-solid fa-ban"></i></a>';

        $xhtml 	.= '<div class="col-md-4 col-sm-6 text-center" data-tag="'.strtolower(str_replace(' ', '', substr($value['category_name'], 0, strpos( $value['category_name'], '-')))).'">
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
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h1 style="text-transform: uppercase; font-weight: bolder">DESIGNS BY <?php echo $this->designerName[$_GET['designer_id']]?></h1>
                <p style="padding: 0 15%">Elegant designs with a purpose. Danish designer <?php echo $this->designerName[$_GET['designer_id']]?> has utilized a strong focus on purposeful designed to create designer furniture that work in the home. Whether you combine <?php echo $this->designerName[$_GET['designer_id']]?> designs or choose one select favourite, your interior will be lifted to new heights.</p>
            </div>
        </div>
    </div>
</div>
<form action="#" method="post" name="adminForm" id="adminForm" >
    <div id="fh5co-product" style="padding-bottom: 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

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
    <div id="fh5co-product" style="padding-top: 0">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2><?php echo $cateName;?></h2>
                    <span><?php echo $result;?></span>
                </div>
            </div>
            <div>
                <div class="text-center">
                    <p class="btn btn-small" data-toggle="portfilter" data-target="all">
                        All
                    </p>
                    <p class="btn btn-small" data-toggle="portfilter" data-target="diningroom">
                        Dining Room
                    </p>
                    <p class="btn btn-small" data-toggle="portfilter" data-target="bedroom">
                        Bedroom
                    </p>
                    <p class="btn btn-small" data-toggle="portfilter" data-target="livingroom">
                        Living Room
                    </p>
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
            <div class="row" id="out_put">
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