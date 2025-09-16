<?php
$imageURL       = $this->_dirImg;
?>

<?php
include_once 'html/header.php';
?>
<?php
require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
?>
<?php
include_once 'html/footer.php';
?>