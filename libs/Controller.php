<?php
    class Controller{
        // View Object
        protected $_view;

        // Model Object
        protected $_model;

        // Template Object
        protected $_templateOBJ;

        // Param (GET - POST)
        public $_arrayParam;

        // Pagination (GET - POST)
        public $_pagination = array(
                                        'totalItemsPerPage' => 4,
                                        'pageRange'         => 3
                                     );

        public function __construct($arrParams)
        {
            $this->setModel($arrParams['module'], $arrParams['controller']);
            $this->setTemplate($this);
            $this->setView($arrParams['module']);


            $this->_pagination['currentPage']   = (isset($arrParams['filter_page'])) ? $arrParams['filter_page'] : 1;
            $arrParams['pagination']            = $this->_pagination;

            $this->setParams($arrParams);

            // arrParams bao gồm các thông số: module, controller, action, pagination
            $this->_view->arrParams = $arrParams;
        }

        // SET MODEL
        public function setModel($moduleName, $modelName){
            $modelName = $this->convertNameURLToClassName($modelName) . 'Model';

            $path = MODULE_PATH . $moduleName . DS . 'models' . DS . $modelName . '.php';
            if(file_exists($path)){
                require_once $path;
                $this->_model	= new $modelName();
            }
        }

        // GET MODEL
        public function getModel(){
            return $this->_model;
        }

        // SET VIEW
        public function setView($moduleName){
            $this->_view = new View($moduleName);
        }

        // GET VIEW
        public function getView(){
            return $this->_view;
        }

        // SET TEMPLATE
        public function setTemplate($moduleName){
            $this->_templateOBJ = new Template($this);
        }

        // GET TEMPLATE
        public function getTemplate(){
            return $this->_templateOBJ;
        }

        // SET PARAM
        public function setParams($arrayParam){
            $this->_arrayParam = $arrayParam;
        }

        // SET PAGINATION
        public function setPagination($config){
            $this->_pagination['totalItemsPerPage'] = $config['totalItemsPerPage'];
            $this->_pagination['pageRange']			= $config['pageRange'];
            $this->_arrayParam['pagination']		= $this->_pagination;
            $this->_view->_arrayParam			    = $this->_arrayParam;
        }

        private function convertNameURLToClassName($nameURL){
            return str_replace("-", "", ucwords(strtolower($nameURL), "-"));
        }

    }