<!--Start footer-->
<footer class="footer">
    <div class="container">
        <div class="text-center">
            Copyright © 2023 Shop. Admin
        </div>
    </div>
</footer>
<!--End footer-->

<!--start color switcher-->
<div class="right-sidebar">
    <div class="switcher-icon">
        <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

        <p class="mb-0">Gaussion Texture</p>
        <hr>

        <ul class="switcher">
            <li id="theme1"></li>
            <li id="theme2"></li>
            <li id="theme3"></li>
            <li id="theme4"></li>
            <li id="theme5"></li>
            <li id="theme6"></li>
            <li id="theme16"></li>
            <li id="theme17"></li>
            <li id="theme18"></li>
            <li id="theme19"></li>
            <li id="theme20"></li>
            <li id="theme21"></li>
        </ul>

        <p class="mb-0">Gradient Background</p>
        <hr>

        <ul class="switcher">
            <li id="theme7"></li>
            <li id="theme8"></li>
            <li id="theme9"></li>
            <li id="theme10"></li>
            <li id="theme11"></li>
            <li id="theme12"></li>
            <li id="theme13"></li>
            <li id="theme14"></li>
            <li id="theme15"></li>
        </ul>

    </div>
</div>
<!--end color switcher-->
<script src="https://unpkg.com/intro.js/intro.js"></script>
<script>introJs().setOptions({
        dontShowAgain: true,
    }).start()
</script>
<style>
    .introjs-tooltip {
        box-shadow: 0px 11px 12px rgba(0, 0, 0, 0.4);
    }
    .introjs-tooltip, .introjs-tooltip-title, .introjs-dontShowAgain label, .introjs-tooltip-text{
        background-color: #d6cec7;
        color: #000;
    }
    .introjs-bullets ul li a.active {
        background-color: #000;
    }
    .introjs-bullets ul li a{
        background-color: grey;
    }

    .introjs-button, .introjs-button:hover, .introjs-button:focus, .introjs-button:active, .introjs-disabled, .introjs-disabled:focus, .introjs-disabled:hover{
        color: #000;
        border: 1px solid black;
    }
</style>