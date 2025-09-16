<?php
    $xhtml = '';
    foreach ($this->Items as $key => $value){
        $nameFilter = URL::filterURL($value['name']);
        $link	    = URL::createLink('default', 'designer', 'info', array('designer_id' => $value['id']), $value['id'].'-designer-'.$nameFilter);
        if($key % 2 == 0){
            $xhtml .= '<div class="col-lg-12">
                            <div style="padding: 0; margin: 0" class="col-md-8">
                                <img width="100%" height="100%" src="'.UPLOAD_URL . 'designer' . DS . $value['name'] . DS . $value['picture_profile'].'" alt="">
                            </div>
                            <div style="padding: 20% calc(3% + 2.5rem) 10rem 5.5rem" class="col-md-4">
                                <div>
                                    <h1>'.$value['name'].'</h1>
                                    <span>'.$value['comment'].'</span>
                                    <br>
                                    <br>
                                    <input type="button" onclick="window.location=\''.$link.'\'" class="btn btn-small btn-outline" style="padding: 15px 30px" value="See more">
                                </div>
                            </div>
                        </div>';
        }else {
            $xhtml .= ' <div class="col-lg-12">
                            <div style="padding: 20% calc(3% + 2.5rem) 10rem 5.5rem" class="col-md-4">
                                <div>
                                    <h1>'.$value['name'].'</h1>
                                    <span>'.$value['comment'].'</span>
                                    <br>
                                    <br>
                                    <input type="button" onclick="window.location=\''.$link.'\'" class="btn btn-small btn-outline" style="padding: 15px 30px" value="See more">
                                    
                                </div>
                            </div>
                            <div style="padding: 0; margin: 0" class="col-md-8">
                                <img width="100%" height="100%" src="'.UPLOAD_URL . 'designer' . DS . $value['name'] . DS . $value['picture_profile'].'" alt="">
                            </div>
                        </div>';
        }
    }
?>
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h1>MEET OUR DESIGNERS</h1>
                <div>
                    <p>We work with some of the most respected designers in Denmark and further afield. They’re all award-winning experts, as you would expect. But perhaps more important is our mutual interpretation of great design: elegant, well considered products that reflect our time and improve our lives. </p>

                    <p>As the creatives behind our collection, we trust them with our life. And with over a hundred fabrics and leathers, and numerous material, colour and customisation options, you can trust our designs to enrich your home.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="fh5co-services">
   <?php echo $xhtml;?>
</div>