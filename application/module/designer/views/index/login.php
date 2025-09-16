<?php
    $linkSubmit	    = URL::createLink('designer', 'index', 'login');
    $linkDefault	= URL::createLink('default', 'index', 'login');

?>
            <!-- Main Content -->
            <div id="main-content">
                <div id="primary" class="site-content">
                    <article id="post-9" class="post-9 page type-page status-publish hentry">
                        <div class="woocommerce"><div class="woocommerce-notices-wrapper"></div>
                            <div class="u-columns col12-set" id="customer_login">
                                <div class="u-column12 col-12">
                                    <?php echo $this->error; ?>
                                    <h2>Login</h2>
                                    <form action="<?php echo $linkSubmit?>" class="woocommerce-form woocommerce-form-login login" method="post">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="username">Username or email address&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="form[username]" id="username" autocomplete="username" value="" />			</p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="password">Password&nbsp;<span class="required">*</span></label>
                                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="form[password]" id="password" autocomplete="current-password" />
                                        </p>
                                        <input type="hidden" name="form[token]" value="<?php echo time()?>" />
                                        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" value="Log in">Log in</button>
                                        <p class="woocommerce-LostPassword lost_password">
                                            <a href="<?php echo $linkDefault?>">You are not Designer?</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Right Sidebar -->

        </div>

    </div><!-- #main .wrapper -->
