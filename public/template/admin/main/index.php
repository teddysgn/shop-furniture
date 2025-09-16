<?php
    $imageURL	= $this->_dirImg;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - <?php echo $this->_title; ?></title>
    <?php echo $this->_CSSFile; ?>
    <?php echo $this->_JSFile; ?>
    <link rel="shortcut icon" href="<?php echo $imageURL?>/logo/icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/intro.js/introjs.css" />
    <link rel="stylesheet" href="https://unpkg.com/intro.js/themes/introjs-modern.css" />
</head>
<body class="bg-theme bg-theme1">
    <?php
    include_once 'html/header.php';
    $controller = $this->arrParams['controller'];
    ?>
    <div id="content-box">
        <!--  LOAD CONTENT -->
        <?php
            require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
        ?>
    </div>

    <?php
    include_once 'html/footer.php';
    ?>

</body>
</html>

