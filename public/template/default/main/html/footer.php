
<div id="fh5co-started">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                <h2>Newsletter</h2>
                <p>Just stay tune for our latest Product. Now you can subscribe</p>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-inline">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-default btn-block">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div

<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="row row-pb-md container">
            <div class="col-md-4 fh5co-widget">
                <div id="fh5co-logo" style="margin-top: 30px"><a href="<?php echo $linkHome;?>"><img id="image-footer" style="width: 50%" src="<?php echo $imageURL?>/logo/logo.png" alt=""></a></div>
                <br>
                <p>We create unique furniture that improves the new ways in which people live, work and play.</p>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1" style="margin-top: 30px">
                <ul class="fh5co-footer-links">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Meetups</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1" style="margin-top: 30px">
                <ul class="fh5co-footer-links">
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Handbook</a></li>
                    <li><a href="#">Held Desk</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1" style="margin-top: 30px">
                <ul class="fh5co-footer-links">
                    <li><a href="#">Find Designers</a></li>
                    <li><a href="#">Find Developers</a></li>
                    <li><a href="#">Teams</a></li>
                    <li><a href="#">Advertise</a></li>
                    <li><a href="#">API</a></li>
                </ul>
            </div>
        </div>

        <div class="row copyright">
            <div class="col-md-12 text-center">
                <p>
                    <small class="block">&copy; 2023 Shop.Furniture</small>
                    <small class="block">Designed by <a href="http://hoangvupcx.com/" target="_blank">hoangvupcx.com</a></small>
                </p>
                <p>
                <ul class="fh5co-social-icons">
                    <li><a href="https://www.facebook.com/hoangvu.pcx"><i class="fa-brands fa-square-facebook"></i></a></li>
                    <li><a href="https://web.telegram.org/k/#@hoangvu_pcx"><i class="fa-brands fa-telegram"></i></a></li>
                    <li><a href="https://www.instagram.com/hoangvu_pcx/"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://m.me/+84936426452"><i class="fa-brands fa-facebook-messenger"></i></a></li>
                    <li><a href="https://hoangvupcx.com/"><i class="fa-solid fa-globe"></i></a></li>
                </ul>
                </p>
            </div>
        </div>

    </div>
</footer>
<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
</div>
<?php echo $this->_JSFile;?>
<script>
    const body = document.body;
    const switch_mode = document.querySelector('#switch-mode');
    const imgHeader = document.querySelector('#image-header');
    const imgFooter = document.querySelector('#image-footer');
    let mode = localStorage.getItem('darkmode');
    if(mode == 'true'){
        imgHeader.src = '/shop/public/template/default/main/images/logo/logo_white.png';
        imgFooter.src = '/shop/public/template/default/main/images/logo/logo_white.png';

        body.classList.add('dark');
    }
    switch_mode.addEventListener('click', () => {
        location.reload();
        let mode = body.classList.toggle('dark');
        localStorage.setItem('darkmode', mode);

    })
</script>
<script src="https://unpkg.com/intro.js/intro.js"></script>
<script>introJs().start()</script>
