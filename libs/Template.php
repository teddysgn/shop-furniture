<?php
    class Template{
        

        // File Config (admin/main/template.ini)
        private $_fileConfig;

        // File Template (admin/main/index.php)
        private $_fileTemplate;

        // Folder Template (admin/main/)
        private $_folderTemplate;

        // Controller Object
        private $_controller;
        

        public function __construct($controller){
            $this->_controller = $controller;
        }

        public function load(){
            $fileConfig     = $this->getFileConfig();
            $folderTemplate = $this->getFolderTemplate();
            $fileTemplate   = $this->getFileTemplate();

            $pathFileConfig = TEMPLATE_PATH . $folderTemplate . $fileConfig;

            if(file_exists($pathFileConfig)){
                $arrConfig          = parse_ini_file($pathFileConfig); //file template.ini

                $view               = $this->_controller->getView(); // = $this->_view
                $view->               setTemplatePath(TEMPLATE_PATH . $folderTemplate . $fileTemplate);
                $view->_title 		= $view->createTitle($arrConfig['title']);
                $view->_metaHTTP 	= $view->createMeta($arrConfig['metaHTTP'], 'http-equiv');
                $view->_metaName 	= $view->createMeta($arrConfig['metaName'], 'name');
                $view->_CSSFile 	= $view->createLink($this->_folderTemplate . $arrConfig['dirCSS'], $arrConfig['fileCSS'], 'css');
                $view->_JSFile   	= $view->createLink($this->_folderTemplate . $arrConfig['dirJS'], $arrConfig['fileJS'], 'js');
                $view->_dirImg 		= TEMPLATE_URL . $this->_folderTemplate . $arrConfig['dirImg'];
            }
        }

        public function setFileTemplate($value = 'index.php'){
            $this->_fileTemplate = $value;
        }
        public function getFileTemplate(){
            return $this->_fileTemplate;
        }
        public function setFileConfig($value = 'template.ini'){
            $this->_fileConfig = $value;
        }
        public function getFileConfig(){
            return $this->_fileConfig;
        }
        public function setFolderTemplate($value = 'default/main/'){
            $this->_folderTemplate= $value;
        }
        public function getFolderTemplate(){
            return $this->_folderTemplate;
        }

    }
