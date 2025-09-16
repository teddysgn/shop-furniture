<?php
$paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'collection', 'shop'));

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

echo  '<aside id="fh5co-hero" class="js-fullheight">
                    <div class="flexslider js-fullheight">
                        <ul class="slides">
                            <li style="background-image: url('.$imageURL.'/'.str_replace(' ','',$this->categoryName['name']).'.jpg);">
                                <div class="overlay-gradient"></div>
                                <div class="container d-flex">
                                     <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                                        <div class="slider-text-inner">
                                            <div class="desc">
                                                <h2>COLLECTION</h2>
                                                <h1 style="text-transform: uppercase; color: black; font-weight: bold; font-size: 60px; font-family: \'Abril Fatface\', serif;">'.$this->categoryName['name'].'</h1>
                                                <p><a href="#section" class="btn btn-primary btn-outline btn-lg">VIEW FULL COLLECTION</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>';
?>
<form action="#" method="post" name="adminForm" id="adminForm">
    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h4 style="line-height: inherit"><?php echo $this->categoryName['description'];?></h4>
                    <span id="section"><?php echo $result;?></span>
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
