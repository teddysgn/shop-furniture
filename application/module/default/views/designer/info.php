<?php
    $nameFilter = URL::filterURL($this->DesignerInfo['name']);
?>
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h1><?php echo $this->DesignerInfo['name']?></h1>
                <span><?php echo $this->DesignerInfo['description']?></span>
            </div>
        </div>
    </div>
</div>
<aside id="fh5co-hero" class="js-fullheight">
    <div class="flexslider js-fullheight">
        <div class="flexslider js-fullheight">
            <img style="width: 100%" src="<?php echo UPLOAD_URL . 'designer' . DS . $this->DesignerInfo['name'] . DS . $this->DesignerInfo['picture_profile']?>" alt="">
        </div>
    </div>
</aside>
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <span><?php echo $this->DesignerInfo['about']?></span>
            </div>
        </div>
    </div>
</div>
<div class="row" id="fh5co-services">
    <div style="padding-left: 0" class="col-lg-6 col-md-6 slider-text">
        <img width="100%" height="100%" src="<?php echo UPLOAD_URL . 'designer' . DS . $this->DesignerInfo['name'] . DS . $this->DesignerInfo['picture1']?>" alt="">
    </div>
    <div style="padding-right: 0" class="col-lg-6 col-md-6 row">
        <div style="text-align: end">
            <img width="100%" height="100%" src="<?php echo UPLOAD_URL . 'designer' . DS . $this->DesignerInfo['name'] . DS . $this->DesignerInfo['picture2']?>" alt="">
        </div>
        <div style="padding: 9%; width: 70%">
            <h1>MEET ALL OUR DESIGNERS</h1>
            <span>We work with some of the most respected designers in Denmark and further afield. Meet them all here and explore the personality behind the designs.</span>
            <br>
            <br>
            <input type="button" onclick="window.location='<?php echo URL::createLink('default', 'designer', 'index', null, 'designers');?>'" class="btn btn-small btn-outline" style="padding: 15px 30px" value="See more">
        </div>
    </div>
</div>
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h1 style="text-transform: uppercase;font-weight: lighter; font-family: 'Times New Roman', serif;letter-spacing: 0.125em">"<?php echo $this->DesignerInfo['maxim']?>"</h1>
            </div>
        </div>
    </div>
</div>
<aside id="fh5co-hero" class="js-fullheight">
    <div class="flexslider js-fullheight">
        <img style="width: 100%" src="<?php echo UPLOAD_URL . 'designer' . DS . $this->DesignerInfo['name'] . DS . $this->DesignerInfo['picture_background']?>" alt="">
    </div>
</aside>
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <span>Our longest running partnership, the Danish designer has been conceiving designs for us since 1993.</span>
                <br>
                <br>
                <?php
                    if(strpos($this->DesignerInfo['name'], ' '))
                        $name = substr($this->DesignerInfo['name'], 0, strpos($this->DesignerInfo['name'], ' '));
                    else
                        $name = $this->DesignerInfo['name'];
                ?>
                <input type="button" onclick="window.location='<?php echo URL::createLink('default', 'designer', 'product', array('designer_id' => $this->DesignerInfo['id']), $this->DesignerInfo['id'].'-designs-by-'.$nameFilter);?>'" class="btn btn-small btn-outline" style="padding: 15px 30px" value="See <?php echo $name ?>'s Design">
            </div>
        </div>
    </div>
</div>
<div class="row" id="fh5co-services">

    <div style="padding-left: 0" class="col-lg-6 col-md-6 row">
        <img width="100%" height="100%" src="<?php echo UPLOAD_URL . 'designer' . DS . DS . $this->DesignerInfo['name'] . DS . DS . $this->DesignerInfo['picture3']?>" alt="">
    </div>
    <div style="padding-right: 0; text-align: end" class="col-lg-6 col-md-6 slider-text">
        <img width="100%" height="100%" src="<?php echo UPLOAD_URL . 'designer' . DS . DS . $this->DesignerInfo['name'] . DS . DS . $this->DesignerInfo['picture4']?>" alt="">
    </div>
</div>
<style>
    #fh5co-hero {
        min-height: 0;
    }
</style>