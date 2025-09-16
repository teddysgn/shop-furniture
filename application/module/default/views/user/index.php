<?php
    $userObj = Session::get('user');

    $linkProfile    = URL::createLink('default'     , 'user'    , 'profile' , array('id' => $userObj['info']['id']) , 'profile-'.$userObj['info']['id']);
    $linkCart       = URL::createLink('default'     , 'user'    , 'order'   , null                                  , 'cart');
    $linkHistory    = URL::createLink('default'     , 'user'    , 'history' , null                                  , 'history');
    $linkTracking   = URL::createLink('default'     , 'user'    , 'tracking', null                                  , 'tracking');
    $linkAdmin      = URL::createLink('admin'       , 'index'   , 'index');
    $linkDesigner   = URL::createLink('designer'    , 'index'   , 'index');
    $linkFavorite   = URL::createLink('admin'       , 'user'    , 'favorite', null                                  , 'favorite');
    $linkLogout     = URL::createLink('default'     , 'index'   , 'logout'  , null                                  , 'logout');
?>
<div id="fh5co-services" class="fh5co-bg-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 text-center">
                <a href="<?php echo $linkProfile?>">
                    <div class="feature-center animate-box" data-animate-effect="fadeIn">
                            <span class="icon">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        <h3>Profile</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <a href="<?php echo $linkCart?>">
                    <div class="feature-center animate-box" data-animate-effect="fadeIn">
                            <span class="icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                        <h3>Cart</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <a href="<?php echo $linkHistory?>">
                    <div class="feature-center animate-box" data-animate-effect="fadeIn">
                            <span class="icon">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </span>
                        <h3>History</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <a href="<?php echo $linkTracking?>">
                    <div class="feature-center animate-box" data-animate-effect="fadeIn">
                            <span class="icon">
                                <i class="fa-solid fa-route"></i>
                            </span>
                        <h3>Tracking</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <a href="<?php echo $linkFavorite?>">
                    <div class="feature-center animate-box" data-animate-effect="fadeIn">
                            <span class="icon">
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        <h3>Favorite</h3>
                    </div>
                </a>
            </div>
            <?php
                if($userObj['group_acp'] == 1)
                    echo '<div class="col-md-3 col-sm-3 text-center">
                            <a href="'.$linkAdmin.'">
                                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                                        <span class="icon">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </span>
                                    <h3>Admin</h3>
                                </div>
                            </a>
                        </div>';
            ?>
            <?php
            if($userObj['group_acp'] == 2)
                echo '<div class="col-md-3 col-sm-3 text-center">
                            <a href="'.$linkDesigner.'">
                                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                                        <span class="icon">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </span>
                                    <h3>Designer</h3>
                                </div>
                            </a>
                        </div>';
            ?>
            <div class="col-md-3 col-sm-3 text-center">
                <a href="<?php echo $linkLogout?>">
                    <div class="feature-center animate-box" data-animate-effect="fadeIn">
                            <span class="icon">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </span>
                        <h3>Logout</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>