<?php
$name = $_SESSION['user']['info']['username'];
$id = $_SESSION['user']['info']['designer_id'];
?>
<div id="main" class="wrapper">
    <div class="page-container show_breadcrumb_v1 no-sidebar">
        <div id="main-content">
            <div id="primary" class="site-content">
                <article id="post-9" class="post-9 page type-page status-publish hentry">
                    <div class="woocommerce">
                        <nav class="woocommerce-MyAccount-navigation">
                            <ul>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard is-active">
                                    <a href="index.php?module=designer&controller=user&action=index">Dashboard</a>
                                </li>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                                    <a href="index.php?module=designer&controller=user&action=detail&id=<?php echo $id?>">Account details</a>
                                </li>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                                    <a href="index.php?module=designer&controller=user&action=password">Change Password</a>
                                </li>
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                                    <a href="index.php?module=designer&controller=index&action=logout">Log out</a>
                                </li>
                            </ul>
                        </nav>


                        <div class="woocommerce-MyAccount-content">
                            <div class="woocommerce-notices-wrapper"></div>
                            <p>
                                Hello <strong><?php echo $name?></strong> (not <strong><?php echo $name?></strong>? <a
                                        href="index.php?module=designer&controller=index&action=logout">Log out</a>)</p>

                            <p>
                                From your account dashboard you can <a
                                        href="index.php?module=designer&controller=user&action=password"><strong>edit your
                                        password</strong></a> and <a href="index.php?module=designer&controller=user&action=detail&id=<?php echo $id?>"><strong>account details</strong></a>.</p>


                        </div>
                    </div>
                </article>
            </div>
        </div>

        <!-- Right Sidebar -->

    </div>

</div>