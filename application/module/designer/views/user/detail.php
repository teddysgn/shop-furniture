<?php
$name = $this->info['name'];
$pictureProfile = UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture_profile'];

$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);
?>
<style>
    body #main{
        background-image:url("<?php echo $pictureProfile?>");
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
</style>
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
                                <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account is-active">
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

                        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
                        <?php echo $this->errorPassword?>
                        <div class="woocommerce-MyAccount-content">
                            <div class="woocommerce-notices-wrapper"></div>
                            <form action="#" method="post" enctype="multipart/form-data">

                                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                    <label>Name &nbsp;<span class="required">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="form[name]" value="<?php echo $this->info['name']?>" />
                                </p>
                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                    <label>Email Adress&nbsp;<span class="required">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="form[email]" value="<?php echo $this->info['email']?>" />
                                </p>
                                <div class="clear"></div>
                                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                    <label>Address&nbsp;<span class="required">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="form[address]"  value="<?php echo $this->info['address']?>" />
                                </p>
                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                    <label>Phone&nbsp;<span class="required">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="form[phone]"  value="<?php echo $this->info['phone']?>" />
                                </p>
                                <div class="clear"></div>
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="description">
                                        Description&nbsp;
                                        <span class="required">*</span>
                                    </label>
                                    <textarea class="woocommerce-Input woocommerce-Input--text input-text" style="height: 150px; text-align: left" type="text" name="form[description]">
                                        <?php echo trim($this->info['description'])?>
                                    </textarea>
                                </p>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="description">
                                        About&nbsp;
                                        <span class="required">*</span>
                                    </label>
                                    <textarea style="height: 150px" type="text" name="form[about]">
                                        <?php echo $this->info['about']?>
                                    </textarea>
                                </p>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="description">
                                        Maxim&nbsp;
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--email input-text" name="form[maxim]" value="<?php echo $this->info['maxim']?>"/>
                                </p>
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="description">
                                        Comment&nbsp;
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--email input-text" name="form[comment]" value="<?php echo $this->info['comment']?>"/>
                                </p>
                                <div class="woocommerce main-products columns-2 grid">
                                    <div class="products">
                                        <section class="product">
                                            <div class="product-wrapper">
                                                <div class="meta-wrapper">
                                                    <label>Picture Profile</label>
                                                    <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" id="image_input_profile" name="picture_profile"  />
                                                </div>
                                                <div class="thumbnail-wrapper">
                                                    <figure>
                                                        <img id="display_profile" src="<?php echo UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture_profile']?>" alt="" width="450" height="572">
                                                    </figure>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="product">
                                            <div class="product-wrapper">
                                                <div class="meta-wrapper">
                                                    <label>Picture Background</label>
                                                    <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" id="image_input_background" name="picture_background"  />
                                                </div>
                                                <div class="thumbnail-wrapper">
                                                    <figure>
                                                        <img id="display_background" src="<?php echo UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture_background']?>" alt="" width="450" height="572">
                                                    </figure>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="product">
                                            <div class="product-wrapper">
                                                <div class="meta-wrapper">
                                                    <label>Picture 1</label>
                                                    <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" id="image_input_picture1" name="picture1"  />
                                                </div>
                                                <div class="thumbnail-wrapper">
                                                    <figure>
                                                        <img id="display_picture1" src="<?php echo UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture1']?>" alt="" width="450" height="572">
                                                    </figure>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="product">
                                            <div class="product-wrapper">
                                                <div class="meta-wrapper">
                                                    <label>Picture 2</label>
                                                    <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" id="image_input_picture2" name="picture2"  />
                                                </div>
                                                <div class="thumbnail-wrapper">
                                                    <figure>
                                                        <img id="display_picture2" src="<?php echo UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture2']?>" alt="" width="450" height="572">
                                                    </figure>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="product">
                                            <div class="product-wrapper">
                                                <div class="meta-wrapper">
                                                    <label>Picture 3</label>
                                                    <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" id="image_input_picture3" name="picture3"  />
                                                </div>
                                                <div class="thumbnail-wrapper">
                                                    <figure>
                                                        <img id="display_picture3" src="<?php echo UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture3']?>" alt="" width="450" height="572">
                                                    </figure>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="product">
                                            <div class="product-wrapper">
                                                <div class="meta-wrapper">
                                                    <label>Picture 4</label>
                                                    <input type="file" class="woocommerce-Input woocommerce-Input--text input-text" id="image_input_picture4" name="picture4"  />
                                                </div>
                                                <div class="thumbnail-wrapper">
                                                    <figure>
                                                        <img id="display_picture4" src="<?php echo UPLOAD_URL . 'designer/' . $this->info['name'] . DS . $this->info['picture4']?>" alt="" width="450" height="572">
                                                    </figure>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    const   image_input_profile     = document.querySelector("#image_input_profile");
                                    var     upload_image_profile    = "";

                                    image_input_profile.addEventListener("change", function () {
                                        const reader_profile = new FileReader();
                                        reader_profile.addEventListener("load", () => {
                                            upload_image_profile = reader_profile.result;
                                            document.querySelector("#display_profile").src = `${upload_image_profile}`;
                                            document.querySelector("#main").style.backgroundImage = "url('" + `${upload_image_profile}` + "')";
                                        })
                                        reader_profile.readAsDataURL(this.files[0]);
                                    })

                                    const   image_input_background     = document.querySelector("#image_input_background");
                                    var     upload_image_background    = "";

                                    image_input_background.addEventListener("change", function () {
                                        const reader_background = new FileReader();
                                        reader_background.addEventListener("load", () => {
                                            upload_image_background = reader_background.result;
                                            document.querySelector("#display_background").src = `${upload_image_background}`;
                                        })
                                        reader_background.readAsDataURL(this.files[0]);
                                    })


                                    const   image_input_picture1     = document.querySelector("#image_input_picture1");
                                    var     upload_image_picture1    = "";

                                    image_input_picture1.addEventListener("change", function () {
                                        const reader_picture1 = new FileReader();
                                        reader_picture1.addEventListener("load", () => {
                                            upload_image_picture1 = reader_picture1.result;
                                            document.querySelector("#display_picture1").src = `${upload_image_picture1}`;
                                        })
                                        reader_picture1.readAsDataURL(this.files[0]);
                                    })

                                    const   image_input_picture2     = document.querySelector("#image_input_picture2");
                                    var     upload_image_picture2    = "";

                                    image_input_picture2.addEventListener("change", function () {
                                        const reader_picture2 = new FileReader();
                                        reader_picture2.addEventListener("load", () => {
                                            upload_image_picture2 = reader_picture2.result;
                                            document.querySelector("#display_picture2").src = `${upload_image_picture2}`;
                                        })
                                        reader_picture2.readAsDataURL(this.files[0]);
                                    })

                                    const   image_input_picture3     = document.querySelector("#image_input_picture3");
                                    var     upload_image_picture3    = "";

                                    image_input_picture3.addEventListener("change", function () {
                                        const reader_picture3 = new FileReader();
                                        reader_picture3.addEventListener("load", () => {
                                            upload_image_picture3 = reader_picture3.result;
                                            document.querySelector("#display_picture3").src = `${upload_image_picture3}`;
                                        })
                                        reader_picture3.readAsDataURL(this.files[0]);
                                    })

                                    const   image_input_picture4     = document.querySelector("#image_input_picture4");
                                    var     upload_image_picture4    = "";

                                    image_input_picture4.addEventListener("change", function () {
                                        const reader_picture4 = new FileReader();
                                        reader_picture4.addEventListener("load", () => {
                                            upload_image_picture4 = reader_picture4.result;
                                            document.querySelector("#display_picture4").src = `${upload_image_picture4}`;
                                        })
                                        reader_picture4.readAsDataURL(this.files[0]);
                                    })
                                </script>
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="password_current">Password</label>
                                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" required name="form[current_password]" id="current_password" autocomplete="off"/>
                                </p>
                                <div class="clear"></div>

                                <p>
                                    <input type="hidden" name="form[token]" value="<?php echo time();?>">
                                    <input type="hidden" name="form[id]" value="<?php echo $this->info['id'];?>">
                                    <input type="hidden" name="form[user_id]" value="<?php echo $this->info['user_id'];?>">
                                    <input type="hidden" name="form[upload_name]" value="<?php echo $this->info['name'];?>">
                                    <input type="hidden" name="form[change_email]" value="<?php echo $this->info['email'];?>">
                                    <input type="hidden" name="form[hidden_profile]" value="<?php echo $this->info['picture_profile'];?>">
                                    <input type="hidden" name="form[hidden_background]" value="<?php echo $this->info['picture_background'];?>">
                                    <input type="hidden" name="form[hidden_picture1]" value="<?php echo $this->info['picture1'];?>">
                                    <input type="hidden" name="form[hidden_picture2]" value="<?php echo $this->info['picture2'];?>">
                                    <input type="hidden" name="form[hidden_picture3]" value="<?php echo $this->info['picture3'];?>">
                                    <input type="hidden" name="form[hidden_picture4]" value="<?php echo $this->info['picture4'];?>">
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