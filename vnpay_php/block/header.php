<nav class="fh5co-nav" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-2">
                <div id="fh5co-logo"><a href="../shop/index.php?module=default&controller=index&action=index"><img id="image-footer" style="width: 50%" src="<?php echo $imageURL?>/logo/logo.png" alt=""></a></div>
            </div>
            <div class="col-md-6 col-xs-6 text-center menu-1">
                <ul>
                    <li ">
                    <a href="../shop/index.php?module=default&controller=index&action=index">Home</a>
                    </li>

                    <li class="has-dropdown ">
                        <a href="../shop/index.php?module=default&controller=product&action=shop&category_id=1-2">Dining Room &nbsp;<i class="fa-solid fa-caret-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=1">Tables</a></li>
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=2">Chairs</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown ">
                        <a href="../shop/index.php?module=default&controller=product&action=shop&category_id=3-4-5">Bedroom &nbsp;<i class="fa-solid fa-caret-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=3">Beds</a></li>
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=4">Dressers & Chests</a></li>
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=5">Nightstands</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown ">
                        <a href="../shop/index.php?module=default&controller=product&action=shop&category_id=6-7-8-9">Living Room &nbsp;<i class="fa-solid fa-caret-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=6">Sofas</a></li>
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=7">Sectionals</a></li>
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=8">Chairs</a></li>
                            <li><a href="../shop/index.php?module=default&controller=product&action=shop&category_id=9">Ottomans</a></li>
                        </ul>
                    </li>

                    <!--                        <li --><!-->
                    <!--                            <a href="--><!--">About</a>-->
                    <!--                        </li>-->
                    <!--                        <li --><!-->
                    <!--                            <a href="--><!--">Services</a>-->
                    <!--                        </li>-->
                    <!--                        <li --><!-->
                    <!--                            <a href="--><!--">Contact</a>-->
                    <!--                        </li>-->
                    <!--                        -->                    </ul>
            </div>
            <form action="#" name="filterForm" id="filterForm" method="post">
                <div class="col-md-3 col-xs-4 text-right hidden-xs menu-2">
                    <ul>
                        <li class="search">
                            <div class="input-group">
                                <input name="filter_search" type="text" placeholder="Search.." value="">
                                <span class="input-group-btn">
                                    <button name="btn-search" class="btn btn-primary" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    <button onclick='window.location="../shop/index.php?module=default&controller=index&action=user"' class="btn btn-primary" type="button">
                                        <i class="fa-solid fa-user"></i>
                                    </button>
                                                                            <button onclick='window.location="../shop/index.php?module=default&controller=user&action=cart"' class="btn btn-primary" type="button">
                                        <span>
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <small>2</small>
                                        </span>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

    </div>
</nav>

<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(/shop/public/template/default/main/images/img_bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="display-t">
                    <div class="display-tc animate-box" data-animate-effect="fadeIn">
                        <h1></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
