<?php
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<div id="main" class="wrapper">
    <div class="page-container show_breadcrumb_v1 no-sidebar">
        <div id="main-content">
            <div id="primary" class="site-content">
                <article id="post-9" class="post-9 page type-page status-publish hentry">
                    <div class="woocommerce">
                        <nav class="woocommerce-MyAccount-navigation">
                            <ul>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
                                    <a href="index.php?module=designer&controller=user&action=index">Dashboard</a>
                                </li>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                                    <a href="index.php?module=designer&controller=user&action=detail&id=<?php echo $_SESSION['user']['info']['id']?>">Account details</a>
                                </li>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account is-active">
                                    <a href="index.php?module=designer&controller=user&action=password">Change Password</a>
                                </li>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                                    <a href="index.php?module=designer&controller=index&action=logout">Log out</a>
                                </li>
                            </ul>
                        </nav>

                        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
                        <?php echo $this->errorPassword?>
                        <div class="woocommerce-MyAccount-content">
                            <div class="woocommerce-notices-wrapper"></div>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <legend>Password change</legend>

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="password_current">Current password</label>
                                        <input type="password" required class="woocommerce-Input woocommerce-Input--password input-text" name="form[current_password]" id="current_password" autocomplete="off" />
                                    </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="password_1">New password</label>
                                        <input type="password" required class="woocommerce-Input woocommerce-Input--password input-text" name="form[new_password]" id="new_password" autocomplete="off" />
                                    </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="password_2">Confirm new password</label>
                                        <input type="password" required class="woocommerce-Input woocommerce-Input--password input-text" name="form[confirm_password]" id="confirm_password" autocomplete="off" />
                                    </p>
                                </fieldset>
                                <div class="clear"></div>

                                <p>
                                    <input type="hidden" name="form[token]" value="<?php echo time();?>">
                                    <input type="hidden" name="form[id]" value="<?php echo $_SESSION['user']['info']['id'];?>">
                                    <input type="submit" class="woocommerce-Button button" value="Save changes" >
                                </p>

                            </form>

                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>