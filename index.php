<?php

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    spl_autoload_register(function ($className) {
        $fileName = LIBRARY_PATH . "{$className}.php";
        if(file_exists($fileName))
            require_once $fileName;
    });

    // error_reporting(0);
    require_once 'define.php';

    Session::init();
    //Session::destroy();
    $bootstrap = new Bootstrap();
    $bootstrap->init();



