<?php
    $imageURL       = $this->_dirImg;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo $imageURL?>/logo/icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $this->_metaHTTP;?>
    <?php echo $this->_metaName;?>
    <title><?php echo $this->_title;?> | Shop.Furniture</title>
    <?php echo $this->_CSSFile;?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icomoon@1.0.0/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/intro.js/introjs.css" />

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="Shop.Furniture"
  agent-id="05e221ff-8ade-4b1c-a753-894c64dbb18e"
  language-code="en"
>
</df-messenger>
</head>
<body>
<div id="page">
    <?php
    include_once 'html/header.php';
    ?>

        <?php
        require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
        ?>
    <?php
    include_once 'html/footer.php';
    ?>
</div>


</body>
</html>