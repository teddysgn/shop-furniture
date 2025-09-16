<?php
$paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'product', 'shop'));
$xhtml = '';
if(!empty($this->Favorite)){
    foreach($this->Favorite as $key => $value){
        $nameFilter     = URL::filterURL($value['product_name']);
        $link	        = URL::createLink('default', 'product', 'detail', array('product_id' => $value['product_id']), $nameFilter.'-'.$value['product_id']);
        $name	        = $value['product_name'];
        $price          = $value['price'];
        $cost           = $value['cost'];
        $stock		= $value['stock'];

        $picturePath	= UPLOAD_PATH . 'product' . DS . $value['product_name'] . DS . $value['picture1'];
        if(file_exists($picturePath)==true){
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . $value['product_name'] . DS . $value['picture1'].'">';
        }else{
            $picture	= '<img class="product-grid" src="'.UPLOAD_URL . 'product' . DS . '98x150-default.jpg' .'">';
        }

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
        $linkFavorite = URL::createLink('default', 'user', 'like', array('user_id' => $user_id, 'product_id' => $value['product_id'], 'favorite' => 1));
        $blockFavorite = '<a style="padding: 15px; margin: 0 10px" href="'.$linkFavorite.'" class="price" title="Add to Favorites"><i class="fa-regular fa-heart"></i></a>';

        $linkOrder	= URL::createLink('default', 'user', 'order', array('product_id' => $value['product_id'], 'price' => $priceReal, 'cost' => $cost), $value['id'] . '-' . $priceReal . '-' . $cost);
        $blockOrder = '<a style="padding: 15px; margin: 0 10px" href="'.$linkOrder.'" class="price" title="Add to Cart"><i class="fa-solid fa-cart-shopping"></i></a>';

        if($stock <= 0 && $stock - $quantityInCart <= 0)
            $blockOrder = '<a style="margin: 0 10px; padding: 15px" class="price" title="Out of Stock"><i class="fa-solid fa-ban"></i></a>';

        foreach($this->infoFavorite as $keyFavorite => $valueFavorite){
            if($value['id'] == $valueFavorite['product_id']){
                $linkFavorite = URL::createLink('default', 'user', 'like', array('user_id' => $_SESSION['user']['info']['id'], 'product_id' => $value['id'], 'favorite' => 0, 'favorite_id' => $valueFavorite['id']));
                $blockFavorite = '<a style="padding: 15px; margin: 0 10px" href="'.$linkFavorite.'" class="price" title="Remove from Favorites"><i class="fa-solid fa-heart"></i></a>';
            }
        }



        $xhtml 	.= '<div class="col-md-4 col-sm-6 text-center filter '.strtolower(str_replace(' ', '', substr($value['category_name'], 0, strpos( $value['category_name'], '-')))).'" >
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
                        <div class="d-flex text-center product">
                            '.$blockFavorite.'
                            '.$blockOrder.'
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
    $result 	= 'You have no Favorite Products';
}

?>

<form action="#" method="post" name="adminForm" id="adminForm" >
    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2><?php echo $this->_title;?></h2>
                    <span><?php echo $result;?></span>
                </div>
            </div>
            <div>
                <div class="text-center">
                    <p class="btn btn-small filter-button" data-filter="all">
                        All
                    </p>
                    <p class="btn btn-small filter-button" data-filter="diningroom">
                        Dining Room
                    </p>
                    <p class="btn btn-small filter-button" data-filter="bedroom">
                        Bedroom
                    </p>
                    <p class="btn btn-small filter-button" data-filter="livingroom">
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
</script>
