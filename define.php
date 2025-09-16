<?php
    // ====================== PATHS ===========================
    define ('DS'				, '/');
    define ('ROOT_PATH'			, dirname(__FILE__));					    // Định nghĩa đường dẫn đến thư mục gốc
    define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện libs
    define ('LIBRARY_EXT_PATH'	, LIBRARY_PATH . 'extends' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện extends
    define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'public' . DS);			// Định nghĩa đường dẫn đến thư mục public
    define ('UPLOAD_PATH'		, PUBLIC_PATH  . 'files' . DS);				// Định nghĩa đường dẫn đến thư mục files
    define ('SCRIPT_PATH'		, PUBLIC_PATH  . 'scripts' . DS);			// Định nghĩa đường dẫn đến thư mục upload
    define ('APPLICATION_PATH'	, ROOT_PATH . DS . 'application' . DS);		// Định nghĩa đường dẫn đến thư mục application
    define ('MODULE_PATH'		, APPLICATION_PATH . 'module' . DS);		// Định nghĩa đường dẫn đến thư mục module
    define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);			// Định nghĩa đường dẫn đến thư mục template


    define	('ROOT_URL'			, DS . 'shop' . DS);
    define	('PUBLIC_URL'		, ROOT_URL . 'public' . DS);
    define	('UPLOAD_URL'		, PUBLIC_URL . 'files' . DS);
    define	('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);
    define	('APPLICATION_URL'	, ROOT_URL . 'application' . DS);

    define	('DEFAULT_MODULE'	    , 'default');
    define	('DEFAULT_CONTROLLER'	, 'index');
    define	('DEFAULT_ACTION'	    , 'index');

    // ====================== DATABASE ===========================
    define ('DB_HOST'			, '');
    define ('DB_USER'			, '');
    define ('DB_PASS'			, '');
    define ('DB_NAME'			, '');
    define ('DB_TABLE'			, 'group');

    // ====================== DATABASE TABLE ===========================
    define ('TBL_GROUP'			, 'group');
    define ('TBL_USER'			, 'user');
    define ('TBL_PRIVELEGE'		, 'privilege');
    define ('TBL_CATEGORY'		, 'category');
    define ('TBL_PRODUCT'		, 'product');
    define ('TBL_ORDER'		    , 'order');
    define ('TBL_COUPON'		, 'coupon');
    define ('TBL_DASHBOARD'		, 'dashboard');
    define ('TBL_NOTICE'		, 'notice');
    define ('TBL_MEMBER'		, 'member');
    define ('TBL_FAVORITE'		, 'favorite');
    define ('TBL_COLLECTION'	, 'collection');
    define ('TBL_DESIGNER'	    , 'designer');
    define ('TBL_REQUEST'	    , 'request');
    define ('TBL_BECOME'	    , 'become');
    define ('TBL_COST'	        , 'cost');
    define ('TBL_SKU'	        , 'sku');
    define ('TBL_COMMENT'	    , 'comment');

    // ====================== CONFIG ===========================
    define ('TIME_LOGIN'		, 3600 * 24);
    define ('TIME_ACTIVATE'		, 3600 * 48);
