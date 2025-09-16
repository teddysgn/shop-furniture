<?php
    class SkuController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        public function indexAction(){
            $this->_view->_title 		= 'SKU';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 50,
                                                    'pageRange'         => 4
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam);

            $this->_view->render('sku/index');
        }

        public function formAction(){
            $this->_view->_title = 'SKU - Add';
            $this->_view->nameProduct       = $this->_model->listItems($this->_arrayParam, array('task' => 'get-name-product'));

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title        = 'SKU - Edit';
                $this->_arrayParam['form']  = $this->_model->infoItem($this->_arrayParam);
                if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'sku', 'index');
                }
            }
            if($this->_arrayParam['form']['token'] > 0) {
                $this->_arrayParam['form']['cost'] = (int)str_replace(',', '', $this->_arrayParam['form']['cost']);
                $name = $this->_arrayParam['form']['product'];
                $query		= "SELECT `id` FROM `".TBL_PRODUCT."` WHERE `name` = '$name'";
                $validate = new Validate($this->_arrayParam['form']);
                $validate
                        ->addRule('product', 'existRecord', array('database' => $this->_model, 'query' => $query))
                        ->addRule('quantity', 'int', array('min' => 0, 'max' => 10000))
                        ->addRule('cost', 'int', array('min' => 0, 'max' => 10000000000));
                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    if(!isset($this->_arrayParam['form']['id'])){
                        $this->_model->saveItem($this->_arrayParam, array('task' => 'add'));
                    }
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'sku', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'sku', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'sku', 'index');
                }
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('sku/form');
        }

        public function trashAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'cost', 'index');
        }
    }
