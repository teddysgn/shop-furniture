<?php
    $imageURL       = $this->_dirImg;

    $linkHome       = URL::createLink('designer', 'index', 'index');
    $linkShop       = URL::createLink('designer', 'index', 'shop');
    $linkRequest    = URL::createLink('designer', 'index', 'request');
    $linkLogout     = URL::createLink('designer', 'index', 'logout');
    $linkUser       = URL::createLink('designer', 'user', 'index');
    $linkDefault	= URL::createLink('default', 'index', 'login');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

    <link rel="profile" href="//gmpg.org/xfn/11" />
    <link rel="shortcut icon" href="<?php echo $imageURL?>/logo/icon.png" />
    <script>document.documentElement.className = document.documentElement.className + ' yes-js js_active js'</script>
    <title>My Account &#8211; Shop.</title>
    <meta name='robots' content='noindex, nofollow' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
    <link rel="alternate" type="application/rss+xml" title="Nooni &raquo; Feed" href="https://demo.theme-sky.com/nooni/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Nooni &raquo; Comments Feed" href="https://demo.theme-sky.com/nooni/comments/feed/" />
    <style id='classic-theme-styles-inline-css' type='text/css'>
        /*! This file is auto-generated */
        .wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
    </style>
    <style id='global-styles-inline-css' type='text/css'>
        body{--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);}:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flow > .alignleft{float: left;margin-inline-start: 0;margin-inline-end: 2em;}body .is-layout-flow > .alignright{float: right;margin-inline-start: 2em;margin-inline-end: 0;}body .is-layout-flow > .aligncenter{margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > .alignleft{float: left;margin-inline-start: 0;margin-inline-end: 2em;}body .is-layout-constrained > .alignright{float: right;margin-inline-start: 2em;margin-inline-end: 0;}body .is-layout-constrained > .aligncenter{margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > :where(:not(.alignleft):not(.alignright):not(.alignfull)){max-width: var(--wp--style--global--content-size);margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > .alignwide{max-width: var(--wp--style--global--wide-size);}body .is-layout-flex{display: flex;}body .is-layout-flex{flex-wrap: wrap;align-items: center;}body .is-layout-flex > *{margin: 0;}body .is-layout-grid{display: grid;}body .is-layout-grid > *{margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
        .wp-block-navigation a:where(:not(.wp-element-button)){color: inherit;}
        :where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}
        :where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}
        .wp-block-pullquote{font-size: 1.5em;line-height: 1.6;}
    </style>
    <link rel='stylesheet' id='ts-style-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/themesky/css/themesky.css?ver=1.0.2' type='text/css' media='all' />
    <link rel='stylesheet' id='swiper-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/themesky/css/swiper-bundle.min.css?ver=1.0.2' type='text/css' media='all' />
    <link rel='stylesheet' id='select2-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/css/select2.css?ver=8.2.1' type='text/css' media='all' />
    <link rel='stylesheet' id='woocommerce-layout-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css?ver=8.2.1' type='text/css' media='all' />
    <link rel='stylesheet' id='woocommerce-smallscreen-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=8.2.1' type='text/css' media='only screen and (max-width: 768px)' />
    <link rel='stylesheet' id='woocommerce-general-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=8.2.1' type='text/css' media='all' />
    <style id='woocommerce-inline-inline-css' type='text/css'>
        .woocommerce form .form-row .required { visibility: visible; }
    </style>
    <link rel='stylesheet' id='jquery-colorbox-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/yith-woocommerce-compare/assets/css/colorbox.css?ver=1.4.21' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-lazyload-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/elementor/assets/css/modules/lazyload/frontend.min.css?ver=3.16.6' type='text/css' media='all' />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&#038;display=swap&#038;ver=1693901252" /><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&#038;display=swap&#038;ver=1693901252" media="print" onload="this.media='all'"><noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&#038;display=swap&#038;ver=1693901252" /></noscript><link rel='stylesheet' id='font-awesome-5-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/css/fontawesome.min.css?ver=1.0.3' type='text/css' media='all' />
    <link rel='stylesheet' id='font-tb-icons-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/css/tb-icons.min.css?ver=1.0.3' type='text/css' media='all' />
    <link rel='stylesheet' id='nooni-reset-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/css/reset.css?ver=1.0.3' type='text/css' media='all' />
    <link rel='stylesheet' id='nooni-style-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/style.css?ver=1.0.3' type='text/css' media='all' />
    <link rel='stylesheet' id='nooni-responsive-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/css/responsive.css?ver=1.0.3' type='text/css' media='all' />
    <link rel='stylesheet' id='nooni-dynamic-css-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/uploads/nooni.css?ver=1693901252' type='text/css' media='all' />
    <script type="text/template" id="tmpl-variation-template">
        <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
        <div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
        <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
    </script>
    <script type="text/template" id="tmpl-unavailable-variation-template">
        <p>Sorry, this product is unavailable. Please choose a different combination.</p>
    </script>
    <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script>
    <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script>
    <script type="text/javascript" id="zxcvbn-async-js-extra">
        /* <![CDATA[ */
        var _zxcvbnSettings = {"src":"https:\/\/demo.theme-sky.com\/nooni\/wp-includes\/js\/zxcvbn.min.js"};
        /* ]]> */
    </script>
    <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/zxcvbn-async.min.js?ver=1.0" id="zxcvbn-async-js"></script>
    <link rel="https://api.w.org/" href="https://demo.theme-sky.com/nooni/wp-json/" /><link rel="alternate" type="application/json" href="https://demo.theme-sky.com/nooni/wp-json/wp/v2/pages/9" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://demo.theme-sky.com/nooni/xmlrpc.php?rsd" />
    <meta name="generator" content="WordPress 6.4.2" />
    <meta name="generator" content="WooCommerce 8.2.1" />
    <link rel="canonical" href="https://demo.theme-sky.com/nooni/my-account/" />
    <link rel='shortlink' href='https://demo.theme-sky.com/nooni/?p=9' />
    <link rel="alternate" type="application/json+oembed" href="https://demo.theme-sky.com/nooni/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdemo.theme-sky.com%2Fnooni%2Fmy-account%2F" />
    <link rel="alternate" type="text/xml+oembed" href="https://demo.theme-sky.com/nooni/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdemo.theme-sky.com%2Fnooni%2Fmy-account%2F&#038;format=xml" />
    <meta name="generator" content="Redux 4.4.8" />	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
    <meta name="generator" content="Elementor 3.16.6; features: e_dom_optimization, e_optimized_assets_loading, additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-auto">
    <meta name="generator" content="Powered by Slider Revolution 6.6.18 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
    <script>function setREVStartSize(e){
            //window.requestAnimationFrame(function() {
            window.RSIW = window.RSIW===undefined ? window.innerWidth : window.RSIW;
            window.RSIH = window.RSIH===undefined ? window.innerHeight : window.RSIH;
            try {
                var pw = document.getElementById(e.c).parentNode.offsetWidth,
                    newh;
                pw = pw===0 || isNaN(pw) || (e.l=="fullwidth" || e.layout=="fullwidth") ? window.RSIW : pw;
                e.tabw = e.tabw===undefined ? 0 : parseInt(e.tabw);
                e.thumbw = e.thumbw===undefined ? 0 : parseInt(e.thumbw);
                e.tabh = e.tabh===undefined ? 0 : parseInt(e.tabh);
                e.thumbh = e.thumbh===undefined ? 0 : parseInt(e.thumbh);
                e.tabhide = e.tabhide===undefined ? 0 : parseInt(e.tabhide);
                e.thumbhide = e.thumbhide===undefined ? 0 : parseInt(e.thumbhide);
                e.mh = e.mh===undefined || e.mh=="" || e.mh==="auto" ? 0 : parseInt(e.mh,0);
                if(e.layout==="fullscreen" || e.l==="fullscreen")
                    newh = Math.max(e.mh,window.RSIH);
                else{
                    e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                    for (var i in e.rl) if (e.gw[i]===undefined || e.gw[i]===0) e.gw[i] = e.gw[i-1];
                    e.gh = e.el===undefined || e.el==="" || (Array.isArray(e.el) && e.el.length==0)? e.gh : e.el;
                    e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                    for (var i in e.rl) if (e.gh[i]===undefined || e.gh[i]===0) e.gh[i] = e.gh[i-1];

                    var nl = new Array(e.rl.length),
                        ix = 0,
                        sl;
                    e.tabw = e.tabhide>=pw ? 0 : e.tabw;
                    e.thumbw = e.thumbhide>=pw ? 0 : e.thumbw;
                    e.tabh = e.tabhide>=pw ? 0 : e.tabh;
                    e.thumbh = e.thumbhide>=pw ? 0 : e.thumbh;
                    for (var i in e.rl) nl[i] = e.rl[i]<window.RSIW ? 0 : e.rl[i];
                    sl = nl[0];
                    for (var i in nl) if (sl>nl[i] && nl[i]>0) { sl = nl[i]; ix=i;}
                    var m = pw>(e.gw[ix]+e.tabw+e.thumbw) ? 1 : (pw-(e.tabw+e.thumbw)) / (e.gw[ix]);
                    newh =  (e.gh[ix] * m) + (e.tabh + e.thumbh);
                }
                var el = document.getElementById(e.c);
                if (el!==null && el) el.style.height = newh+"px";
                el = document.getElementById(e.c+"_wrapper");
                if (el!==null && el) {
                    el.style.height = newh+"px";
                    el.style.display = "block";
                }
            } catch(e){
                console.log("Failure at Presize of Slider:" + e)
            }
            //});
        };</script>
</head>
<body class="page-template-default page page-id-9 theme-nooni woocommerce-account woocommerce-page woocommerce-no-js wide header-v1 product-label-rectangle product-hover-vertical-style ts_desktop e-lazyload elementor-default elementor-kit-12">

<div id="page" class="hfeed site">


    <!-- Page Slider -->


    <header class="ts-header has-sticky">
        <div class="header-container">
            <div class="header-template">

                <div class="header-sticky">
                    <div class="header-middle">
                        <div class="container">

                            <div class="header-left">

                                <div class="ts-sidebar-menu-icon">
                                    <span class="icon"></span>
                                </div>

                                <div class="search-button search-icon">
                                    <span class="icon"></span>
                                </div>

                            </div>

                            <div class="header-center">
                                <div class="logo-wrapper">
                                    <div class="logo">
                                        <a href="https://demo.theme-sky.com/nooni/">
                                            <img src="<?php echo $imageURL?>/logo/logo.png"
                                                 alt="Nooni" title="Nooni" class="normal-logo"/>

                                            <img src="<?php echo $imageURL?>/logo/logo.png"
                                                 alt="Nooni" title="Nooni" class="mobile-logo"/>

                                            <img src="<?php echo $imageURL?>/logo/logo.png"
                                                 alt="Nooni" title="Nooni" class="sticky-logo"/>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="header-right">
                                <div class="my-account-wrapper hidden-phone">
                                    <div class="ts-tiny-account-wrapper">
                                        <div class="account-control">
                                            <a class="my-account" href="index.php?module=designer&controller=user&action=index" title="My Account">My Account</a>
                                            <div class="account-dropdown-form dropdown-container" style="width: 100%">
                                                <div class="form-content">
                                                    <ul>
                                                        <li style="list-style-type: none"><a class="my-account" href="index.php?module=designer&controller=index&action=login">Login</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div id="main" class="wrapper"><div class="breadcrumb-title-wrapper breadcrumb-v1 no-title" ><div class="breadcrumb-content"><div class="breadcrumb-title"><div class="breadcrumbs"><div class="breadcrumbs-container"><a href="https://demo.theme-sky.com/nooni/">Home</a> <span class="brn_arrow">&#047;</span> <span class="current">My Account</span></div></div></div></div></div><!-- Page slider -->

        <div class="page-container show_breadcrumb_v1 no-sidebar">
    <?php
        require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
    ?>
            <footer id="colophon" class="footer-container footer-area loading">
                <div data-elementor-type="wp-post" data-elementor-id="5283" class="elementor elementor-5283">
                    <div class="elementor-element elementor-element-b09b0ec e-con-full e-flex e-con e-parent" data-id="b09b0ec" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}" data-core-v316-plus="true">
                        <div class="elementor-element elementor-element-2a81998 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="2a81998" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-5b3c421 e-flex e-con-boxed e-con e-parent" data-id="5b3c421" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                        <div class="e-con-inner">
                            <div class="elementor-element elementor-element-69991c4 e-con-full e-flex e-con e-child" data-id="69991c4" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-abe2a43 elementor-widget__width-initial elementor-widget elementor-widget-image" data-id="abe2a43" data-element_type="widget" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img width="480" height="108" src="<?php echo $imageURL?>/logo/logo.png" class="attachment-full size-full wp-image-5886" alt="" srcset="<?php echo $imageURL?>/logo/logo.png 480w, <?php echo $imageURL?>/logo/logo.png 300w" sizes="(max-width: 480px) 100vw, 480px" />															</div>
                                </div>
                                <div class="elementor-element elementor-element-29c3c7b elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="29c3c7b" data-element_type="widget" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <p>Text: +00(234)23-45-666<br />Mon &#8211; Fri: 8 am &#8211; 8 pm<br />Sat &#8211; Sun: 8 am &#8211; 7 pm</p>						</div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-b7ea210 e-con-full e-flex e-con e-child" data-id="b7ea210" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-18f88f3 elementor-widget elementor-widget-heading" data-id="18f88f3" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h6 class="elementor-heading-title elementor-size-default">ABOUT</h6>		</div>
                                </div>
                                <div class="elementor-element elementor-element-5d7e940 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="5d7e940" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items">
                                            <li class="elementor-icon-list-item">
                                                <a href="#">

                                                    <span class="elementor-icon-list-text">Our Story</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="#">

                                                    <span class="elementor-icon-list-text">Careers</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="#">

                                                    <span class="elementor-icon-list-text">Influencers</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="#">

                                                    <span class="elementor-icon-list-text">Join our team</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-91281a9 e-con-full e-flex e-con e-child" data-id="91281a9" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-ae3b24a elementor-widget elementor-widget-heading" data-id="ae3b24a" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h6 class="elementor-heading-title elementor-size-default">CUSTOMER SERVICES</h6>		</div>
                                </div>
                                <div class="elementor-element elementor-element-0b7e960 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="0b7e960" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items">
                                            <li class="elementor-icon-list-item">
                                                <a href="https://demo.theme-sky.com/nooni/contact-us/">

                                                    <span class="elementor-icon-list-text">Contact Us</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="https://demo.theme-sky.com/nooni/about-us/">

                                                    <span class="elementor-icon-list-text">Customer Service</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="https://demo.theme-sky.com/nooni/contact-us/">

                                                    <span class="elementor-icon-list-text">Find Store</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="https://demo.theme-sky.com/nooni/contact-us/">

                                                    <span class="elementor-icon-list-text">Book appointment</span>
                                                </a>
                                            </li>
                                            <li class="elementor-icon-list-item">
                                                <a href="#">

                                                    <span class="elementor-icon-list-text">Shipping & Returns</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-a784b10 e-con-full e-flex e-con e-child" data-id="a784b10" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-a17a5fe elementor-widget-mobile__width-inherit ts-align-tabletcenter elementor-widget-tablet_extra__width-initial ts-align-tablet_extracenter ts-align-mobilecenter elementor-widget elementor-widget-ts-mailchimp" data-id="a17a5fe" data-element_type="widget" data-widget_type="ts-mailchimp.default">
                                    <div class="elementor-widget-container">
                                        <div class="ts-mailchimp-subscription-shortcode " ><section class="widget-container mailchimp-subscription"><div class="widget-title-wrapper"><h3 class="widget-title heading-title">SIGN UP FOR EMAILS</h3></div>			<div class="subscribe-widget">
                                                    <div class="newsletter">
                                                        <p>Enjoy 15% off* your first order when sign up to our newsletter</p>
                                                    </div>

                                                    <script>(function() {
                                                            window.mc4wp = window.mc4wp || {
                                                                listeners: [],
                                                                forms: {
                                                                    on: function(evt, cb) {
                                                                        window.mc4wp.listeners.push(
                                                                            {
                                                                                event   : evt,
                                                                                callback: cb
                                                                            }
                                                                        );
                                                                    }
                                                                }
                                                            }
                                                        })();
                                                    </script><!-- Mailchimp for WordPress v4.9.9 - https://wordpress.org/plugins/mailchimp-for-wp/ --><form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-348" method="post" data-id="348" data-name="Subscription Form" ><div class="mc4wp-form-fields"><div class="subscribe-email">
                                                                <input type="email" name="EMAIL" placeholder="Your e-mail address" required />
                                                                <button class="button" type="submit">Subscribe</button>
                                                            </div></div><label style="display: none !important;">Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" /></label><input type="hidden" name="_mc4wp_timestamp" value="1705067303" /><input type="hidden" name="_mc4wp_form_id" value="348" /><input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" /><div class="mc4wp-response"></div></form><!-- / Mailchimp for WordPress Plugin -->			</div>

                                            </section></div>		</div>
                                </div>
                                <div class="elementor-element elementor-element-db7bb61 e-grid-align-tablet_extra-center elementor-shape-rounded elementor-grid-0 elementor-widget elementor-widget-social-icons" data-id="db7bb61" data-element_type="widget" data-widget_type="social-icons.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-social-icons-wrapper elementor-grid">
							<span class="elementor-grid-item">
					<a class="elementor-icon elementor-social-icon elementor-social-icon-tb-icon-brand-facebook elementor-repeater-item-eb8d31c" href="#" target="_blank">
						<span class="elementor-screen-only">Tb-icon-brand-facebook</span>
						<i class="tb-icon tb-icon-brand-facebook"></i>					</a>
				</span>
                                            <span class="elementor-grid-item">
					<a class="elementor-icon elementor-social-icon elementor-social-icon-tb-icon-brand-twitter elementor-repeater-item-1e06185" href="#" target="_blank">
						<span class="elementor-screen-only">Tb-icon-brand-twitter</span>
						<i class="tb-icon tb-icon-brand-twitter"></i>					</a>
				</span>
                                            <span class="elementor-grid-item">
					<a class="elementor-icon elementor-social-icon elementor-social-icon-tb-icon-brand-instagram elementor-repeater-item-143d5fc" href="#" target="_blank">
						<span class="elementor-screen-only">Tb-icon-brand-instagram</span>
						<i class="tb-icon tb-icon-brand-instagram"></i>					</a>
				</span>
                                            <span class="elementor-grid-item">
					<a class="elementor-icon elementor-social-icon elementor-social-icon-tb-icon-brand-pinterest elementor-repeater-item-f2d7723" href="#" target="_blank">
						<span class="elementor-screen-only">Tb-icon-brand-pinterest</span>
						<i class="tb-icon tb-icon-brand-pinterest"></i>					</a>
				</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-a062bd4 e-flex e-con-boxed e-con e-parent" data-id="a062bd4" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                        <div class="e-con-inner">
                            <div class="elementor-element elementor-element-b59d73d elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="b59d73d" data-element_type="widget" data-widget_type="divider.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-aea81c8 e-flex e-con-boxed e-con e-parent" data-id="aea81c8" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                        <div class="e-con-inner">
                            <div class="elementor-element elementor-element-0725798 elementor-icon-list--layout-inline elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="0725798" data-element_type="widget" data-widget_type="icon-list.default">
                                <div class="elementor-widget-container">
                                    <ul class="elementor-icon-list-items elementor-inline-items">
                                        <li class="elementor-icon-list-item elementor-inline-item">
                                            <a href="#">

                                                <span class="elementor-icon-list-text">Privacy Policy</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item elementor-inline-item">
                                            <a href="#">

                                                <span class="elementor-icon-list-text">Help</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item elementor-inline-item">
                                            <a href="#">

                                                <span class="elementor-icon-list-text">FAQs</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-74e06cf elementor-widget elementor-widget-text-editor" data-id="74e06cf" data-element_type="widget" data-widget_type="text-editor.default">
                                <div class="elementor-widget-container">
                                    <p>© Shop. All Rights Reserved.</p>						</div>
                            </div>
                            <div class="elementor-element elementor-element-fdbb9a4 elementor-widget elementor-widget-image" data-id="fdbb9a4" data-element_type="widget" data-widget_type="image.default">
                                <div class="elementor-widget-container">
                                    <img width="286" height="26" src="https://nooni-be87.kxcdn.com/nooni/wp-content/uploads/2022/12/payment.png" class="attachment-full size-full wp-image-5887" alt="" />															</div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- #page -->


        <div id="vertical-menu-sidebar" class="vertical-menu-sidebar hidden-phone">
            <div class="overlay"></div>
            <div class="ts-sidebar-content">
                <span class="close"></span>
                <div class="vertical-menu-wrapper">
                    <nav class="vertical-menu"><ul id="menu-vertical-menu" class="menu">
                            <li id="menu-item-6004" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-6004 ts-normal-menu parent">
                                <a href="builder"><span class="menu-label">Home</span></a><span class="ts-menu-drop-icon"></span>
                                <ul class="sub-menu">
                                    <li id="menu-item-5593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-5593">
                                        <a href="<?php echo $linkShop?>"><span class="menu-label">Products</span></a></li>
                                    <li id="menu-item-5593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-5593">
                                        <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                                </ul>
                            </li>
                            <li id="menu-item-5930" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-5930 ts-normal-menu parent">
                                <a><span class="menu-label">User</span></a><span class="ts-menu-drop-icon"></span>
                                <ul class="sub-menu">
                                    <li id="menu-item-6059" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6059">
                                        <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                                    <li id="menu-item-6060" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6060">
                                        <a href="<?php echo $linkLogout?>"><span class="menu-label">Logout</span></a></li>
                                </ul>
                            </li>
                            <li id="menu-item-6001" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-6001 ts-normal-menu">
                                <a href="<?php echo $linkDefault?>"><span class="menu-label">Default</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Group Header Button -->
        <div id="group-icon-header" class="ts-floating-sidebar">
            <div class="overlay"></div>
            <div class="ts-sidebar-content no-tab">

                <div class="sidebar-content">
                    <div class="logo-wrapper">
                        <div class="logo">
                            <a href="<?php echo $linkShop?>">
                                <img src="<?php echo $imageURL?>/logo/logo.png" loading="lazy" alt="Nooni" class="menu-mobile-logo" />
                            </a>
                        </div>
                    </div>

                    <ul class="tab-mobile-menu">
                        <li id="main-menu" class="active"><span>Menu</span></li>
                        <li id="vertical-menu"><span>Categories</span></li>
                    </ul>

                    <h6 class="menu-title"><span>Menu</span></h6>

                    <div class="mobile-menu-wrapper ts-menu tab-menu-mobile">
                        <div class="menu-main-mobile">
                            <nav class="mobile-menu"><ul id="menu-mobile-menu" class="menu"><li id="menu-item-4097" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-4097 ts-normal-menu parent">
                                        <a href="<?php echo $linkHome?>"><span class="menu-label">Home</span></a><span class="ts-menu-drop-icon"></span>
                                        <ul class="sub-menu">
                                            <li id="menu-item-4096" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-4096">
                                                <a href="<?php echo $linkShop?>"><span class="menu-label">Products</span></a></li>
                                            <li id="menu-item-2301" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2301">
                                                <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-2287" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-2287 ts-normal-menu parent">
                                        <a href="<?php echo $linkShop?>"><span class="menu-label">Shop</span></a><span class="ts-menu-drop-icon"></span>
                                        <ul class="sub-menu">
                                            <li id="menu-item-6093" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6093">
                                                <a href="<?php echo $linkRequest?>"><span class="menu-label">Requests</span></a></li>
                                            <li id="menu-item-4103" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4103">
                                                <a href="<?php echo $linkLogout?>"><span class="menu-label">Logout</span></a></li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-2308" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2308 ts-normal-menu">
                                        <a href="<?php echo $linkDefault?>"><span class="menu-label">Default</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>


                    <div class="group-button-header">
                        <div class="meta-bottom">
                            <div class="my-account-wrapper">
                                <div class="ts-tiny-account-wrapper">
                                    <div class="account-control">
                                        <a class="login" href="<?php echo $linkUser?>" title="My Account">Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Search Sidebar -->

        <div id="ts-search-sidebar" class="ts-floating-sidebar">
            <div class="overlay"></div>
            <div class="ts-sidebar-content">
                <div class="ts-search-by-category woocommerce">
                    <div class="search--header">
                        <h2 class="title">Search for products (<span class="count">0</span>)</h2>
                        <span class="close"></span>
                    </div>

                    <div class="search--form">
                        <form method="get" action="https://demo.theme-sky.com/nooni/" id="searchform-175">
                            <div class="search-table">
                                <div class="search-field search-content">
                                    <input type="text" value="" name="s" id="s-175" placeholder="Search for products..." autocomplete="off" />
                                    <input type="hidden" name="post_type" value="product" />
                                </div>
                                <div class="search-button">
                                    <input type="submit" id="searchsubmit-175" value="Search" />
                                </div>
                            </div>
                        </form>				</div>

                    <div class="ts-search-result-container"></div>
                </div>
            </div>
        </div>


        <!-- Shopping Cart Floating Sidebar -->
        <div id="ts-shopping-cart-sidebar" class="ts-floating-sidebar">
            <div class="overlay"></div>
            <div class="ts-sidebar-content">
                <span class="close"></span>
                <div class="ts-tiny-cart-wrapper"></div>
            </div>
        </div>

        <div id="to-top" class="scroll-button">
            <a class="scroll-button" href="javascript:void(0)" title="Back to Top">Back to Top</a>
        </div>


        <script>
            window.RS_MODULES = window.RS_MODULES || {};
            window.RS_MODULES.modules = window.RS_MODULES.modules || {};
            window.RS_MODULES.waiting = window.RS_MODULES.waiting || [];
            window.RS_MODULES.defered = true;
            window.RS_MODULES.moduleWaiting = window.RS_MODULES.moduleWaiting || {};
            window.RS_MODULES.type = 'compiled';
        </script>
        <script>(function() {function maybePrefixUrlField () {
                const value = this.value.trim()
                if (value !== '' && value.indexOf('http') !== 0) {
                    this.value = 'http://' + value
                }
            }

                const urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]')
                for (let j = 0; j < urlFields.length; j++) {
                    urlFields[j].addEventListener('blur', maybePrefixUrlField)
                }
            })();</script>	<div id="ts-add-to-cart-popup-modal" class="ts-popup-modal">
            <div class="overlay"></div>
            <div class="add-to-cart-popup-container popup-container">
                <span class="close"></span>
                <div class="add-to-cart-popup-content"></div>
            </div>
        </div>
        <div id="ts-ajax-add-to-cart-message">
            <span>Product has been added to your cart</span>
            <span class="error-message"></span>
        </div>
        <script type='text/javascript'>
            const lazyloadRunObserver = () => {
                const dataAttribute = 'data-e-bg-lazyload';
                const lazyloadBackgrounds = document.querySelectorAll( `[${ dataAttribute }]:not(.lazyloaded)` );
                const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
                    entries.forEach( ( entry ) => {
                        if ( entry.isIntersecting ) {
                            let lazyloadBackground = entry.target;
                            const lazyloadSelector = lazyloadBackground.getAttribute( dataAttribute );
                            if ( lazyloadSelector ) {
                                lazyloadBackground = entry.target.querySelector( lazyloadSelector );
                            }
                            if( lazyloadBackground ) {
                                lazyloadBackground.classList.add( 'lazyloaded' );
                            }
                            lazyloadBackgroundObserver.unobserve( entry.target );
                        }
                    });
                }, { rootMargin: '100px 0px 100px 0px' } );
                lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
                    lazyloadBackgroundObserver.observe( lazyloadBackground );
                } );
            };
            const events = [
                'DOMContentLoaded',
                'elementor/lazyload/observe',
            ];
            events.forEach( ( event ) => {
                document.addEventListener( event, lazyloadRunObserver );
            } );
        </script>
        <script type="text/javascript">
            (function () {
                var c = document.body.className;
                c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
                document.body.className = c;
            })();
        </script>
        <link rel='stylesheet' id='redux-custom-fonts-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/uploads/redux/custom-fonts/fonts.css?ver=1705067303' type='text/css' media='all' />
        <link rel='stylesheet' id='elementor-frontend-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/uploads/elementor/css/custom-frontend.min.css?ver=1698216470' type='text/css' media='all' />
        <link rel='stylesheet' id='elementor-post-5283-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/uploads/elementor/css/post-5283.css?ver=1698216526' type='text/css' media='all' />
        <link rel='stylesheet' id='elementor-icons-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.23.0' type='text/css' media='all' />
        <link rel='stylesheet' id='elementor-post-12-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/uploads/elementor/css/post-12.css?ver=1698216470' type='text/css' media='all' />
        <link rel='stylesheet' id='elementor-icons-ts-tb-icon-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/css/tb-icons.min.css?ver=1.0.2' type='text/css' media='all' />
        <link rel='stylesheet' id='rs-plugin-settings-css' href='https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/revslider/public/assets/css/rs6.css?ver=6.6.18' type='text/css' media='all' />
        <style id='rs-plugin-settings-inline-css' type='text/css'>
            #rs-demo-id {}
        </style>
        <script type="text/javascript" id="jquery-yith-wcwl-js-extra">
            /* <![CDATA[ */
            var yith_wcwl_l10n = {"ajax_url":"\/nooni\/wp-admin\/admin-ajax.php","redirect_to_cart":"no","yith_wcwl_button_position":"add-to-cart","multi_wishlist":"","hide_add_button":"1","enable_ajax_loading":"","ajax_loader_url":"https:\/\/demo.theme-sky.com\/nooni\/wp-content\/plugins\/yith-woocommerce-wishlist\/assets\/images\/ajax-loader-alt.svg","remove_from_wishlist_after_add_to_cart":"1","is_wishlist_responsive":"1","time_to_close_prettyphoto":"3000","fragments_index_glue":".","reload_on_found_variation":"1","mobile_media_query":"768","labels":{"cookie_disabled":"We are sorry, but this feature is available only if cookies on your browser are enabled.","added_to_cart_message":"<div class=\"woocommerce-notices-wrapper\"><div class=\"woocommerce-message\" role=\"alert\">Product added to cart successfully<\/div><\/div>"},"actions":{"add_to_wishlist_action":"add_to_wishlist","remove_from_wishlist_action":"remove_from_wishlist","reload_wishlist_and_adding_elem_action":"reload_wishlist_and_adding_elem","load_mobile_action":"load_mobile","delete_item_action":"delete_item","save_title_action":"save_title","save_privacy_action":"save_privacy","load_fragments":"load_fragments"},"nonce":{"add_to_wishlist_nonce":"e84fb5a26f","remove_from_wishlist_nonce":"e3b9aa5ece","reload_wishlist_and_adding_elem_nonce":"65fb26e96f","load_mobile_nonce":"8d0c4ee4b4","delete_item_nonce":"4a3eb59e58","save_title_nonce":"efcfad5dcf","save_privacy_nonce":"a1dbb4c35a","load_fragments_nonce":"a1cf7acb91"},"redirect_after_ask_estimate":"","ask_estimate_redirect_url":"https:\/\/demo.theme-sky.com\/nooni"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl.min.js?ver=3.26.0" id="jquery-yith-wcwl-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/revslider/public/assets/js/rbtools.min.js?ver=6.6.18" defer async id="tp-tools-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/revslider/public/assets/js/rs6.min.js?ver=6.6.18" defer async id="revmin-js"></script>
        <script type="text/javascript" id="ts-script-js-extra">
            /* <![CDATA[ */
            var themesky_params = {"ajax_uri":"\/nooni\/wp-admin\/admin-ajax.php"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/themesky/js/themesky.js?ver=1.0.2" id="ts-script-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/themesky/js/swiper-bundle.min.js?ver=1.0.2" id="swiper-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.8.2.1" id="jquery-blockui-js"></script>
        <script type="text/javascript" id="wc-add-to-cart-js-extra">
            /* <![CDATA[ */
            var wc_add_to_cart_params = {"ajax_url":"\/nooni\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/nooni\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"https:\/\/demo.theme-sky.com\/nooni\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=8.2.1" id="wc-add-to-cart-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.9-wc.8.2.1" id="selectWoo-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2" id="wp-polyfill-inert-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.14.0" id="regenerator-runtime-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0" id="wp-polyfill-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/dist/hooks.min.js?ver=c6aec9a8d4e5a5d543a1" id="wp-hooks-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/dist/i18n.min.js?ver=7701b0c3857f914212ef" id="wp-i18n-js"></script>
        <script type="text/javascript" id="wp-i18n-js-after">
            /* <![CDATA[ */
            wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
            /* ]]> */
        </script>
        <script type="text/javascript" id="password-strength-meter-js-extra">
            /* <![CDATA[ */
            var pwsL10n = {"unknown":"Password strength unknown","short":"Very weak","bad":"Weak","good":"Medium","strong":"Strong","mismatch":"Mismatch"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://demo.theme-sky.com/nooni/wp-admin/js/password-strength-meter.min.js?ver=6.4.2" id="password-strength-meter-js"></script>
        <script type="text/javascript" id="wc-password-strength-meter-js-extra">
            /* <![CDATA[ */
            var wc_password_strength_meter_params = {"min_password_strength":"3","stop_checkout":"","i18n_password_error":"Please enter a stronger password.","i18n_password_hint":"Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! \" ? $ % ^ & )."};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/frontend/password-strength-meter.min.js?ver=8.2.1" id="wc-password-strength-meter-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4-wc.8.2.1" id="js-cookie-js"></script>
        <script type="text/javascript" id="woocommerce-js-extra">
            /* <![CDATA[ */
            var woocommerce_params = {"ajax_url":"\/nooni\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/nooni\/?wc-ajax=%%endpoint%%"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=8.2.1" id="woocommerce-js"></script>
        <script type="text/javascript" id="yith-woocompare-main-js-extra">
            /* <![CDATA[ */
            var yith_woocompare = {"ajaxurl":"\/nooni\/?wc-ajax=%%endpoint%%","actionadd":"yith-woocompare-add-product","actionremove":"yith-woocompare-remove-product","actionview":"yith-woocompare-view-table","actionreload":"yith-woocompare-reload-product","added_label":"Added","table_title":"Product Comparison","auto_open":"yes","loader":"https:\/\/demo.theme-sky.com\/nooni\/wp-content\/plugins\/yith-woocommerce-compare\/assets\/images\/loader.gif","button_text":"<span class=\"ts-tooltip button-tooltip\" data-title=\"Add to compare\">Compare<\/span>","cookie_name":"yith_woocompare_list","close_label":"Close"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/yith-woocommerce-compare/assets/js/woocompare.min.js?ver=2.32.0" id="yith-woocompare-main-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/yith-woocommerce-compare/assets/js/jquery.colorbox-min.js?ver=1.4.21" id="jquery-colorbox-js"></script>
        <script type="text/javascript" id="wc-cart-fragments-js-extra">
            /* <![CDATA[ */
            var wc_cart_fragments_params = {"ajax_url":"\/nooni\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/nooni\/?wc-ajax=%%endpoint%%","cart_hash_key":"wc_cart_hash_73d5d9d3e10c33f3e350fee441fa1baf","fragment_name":"wc_fragments_73d5d9d3e10c33f3e350fee441fa1baf","request_timeout":"5000"};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=8.2.1" id="wc-cart-fragments-js"></script>
        <script type="text/javascript" id="nooni-script-js-extra">
            /* <![CDATA[ */
            var nooni_params = {"ajax_url":"\/nooni\/wp-admin\/admin-ajax.php","sticky_header":"1","menu_overlay":"0","ajax_search":"1","show_cart_after_adding":"1","ajax_add_to_cart":"1","add_to_cart_effect":"show_popup","shop_loading_type":"ajax-pagination","flexslider":{"rtl":false,"animation":"slide","smoothHeight":true,"directionNav":false,"controlNav":"thumbnails","slideshow":false,"animationSpeed":500,"animationLoop":false,"allowOneSlide":false},"zoom_options":[],"placeholder_form":{"usernamePlaceholder":"Username or email address*","passwordPlaceholder":"Password*"}};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/js/main.js?ver=1.0.3" id="nooni-script-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/themes/nooni/js/jquery.sticky.js?ver=1.0.3" id="jquery-sticky-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/flexslider/jquery.flexslider.min.js?ver=2.7.2-wc.8.2.1" id="flexslider-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/underscore.min.js?ver=1.13.4" id="underscore-js"></script>
        <script type="text/javascript" id="wp-util-js-extra">
            /* <![CDATA[ */
            var _wpUtilSettings = {"ajax":{"url":"\/nooni\/wp-admin\/admin-ajax.php"}};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/wp-util.min.js?ver=6.4.2" id="wp-util-js"></script>
        <script type="text/javascript" id="wc-add-to-cart-variation-js-extra">
            /* <![CDATA[ */
            var wc_add_to_cart_variation_params = {"wc_ajax_url":"\/nooni\/?wc-ajax=%%endpoint%%","i18n_no_matching_variations_text":"Sorry, no products matched your selection. Please choose a different combination.","i18n_make_a_selection_text":"Please select some product options before adding this product to your cart.","i18n_unavailable_text":"Sorry, this product is unavailable. Please choose a different combination."};
            /* ]]> */
        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js?ver=8.2.1" id="wc-add-to-cart-variation-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/woocommerce/assets/js/zoom/jquery.zoom.min.js?ver=1.7.21-wc.8.2.1" id="zoom-js"></script>
        <script type="text/javascript" defer src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/mailchimp-for-wp/assets/js/forms.js?ver=4.9.9" id="mc4wp-forms-api-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.16.6" id="elementor-webpack-runtime-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.16.6" id="elementor-frontend-modules-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-includes/js/jquery/ui/core.min.js?ver=1.13.2" id="jquery-ui-core-js"></script>
        <script type="text/javascript" id="elementor-frontend-js-before">

            var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselWrapperAriaLabel":"Carousel | Horizontal scrolling: Arrow Left & Right","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":993,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":767,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":992,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":true},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":true},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.16.6","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"e_optimized_assets_loading":true,"additional_custom_breakpoints":true,"container":true,"landing-pages":true,"e_lazyload":true},"urls":{"assets":"https:\/\/demo.theme-sky.com\/nooni\/wp-content\/plugins\/elementor\/assets\/"},"swiperClass":"swiper-container","settings":{"page":[],"editorPreferences":[]},"kit":{"viewport_tablet":992,"active_breakpoints":["viewport_mobile","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_laptop":1366,"stretched_section_container":"#main","viewport_mobile":767,"viewport_tablet_extra":1200,"lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":9,"title":"My%20Account%20%E2%80%93%20Nooni","excerpt":"","featuredImage":false}};

        </script>
        <script type="text/javascript" src="https://nooni-be87.kxcdn.com/nooni/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.16.6" id="elementor-frontend-js"></script>
        <div id="ts-quickshop-modal" class="ts-popup-modal">
            <div class="overlay"></div>
            <div class="quickshop-container popup-container">
                <span class="close"></span>
                <div class="quickshop-content"></div>
            </div>
        </div>
</body>
</html>
