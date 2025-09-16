<?php
    class CostController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        public function indexAction(){
            $this->_view->_title 		= 'Cost';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 10,
                                                    'pageRange'         => 4
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);

            $this->_view->render('cost/index');
        }

        public function formAction(){
            $this->_view->_title = 'Cost - Add';

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title = 'Cost - Edit';
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
                if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'cost', 'index');
                }
            }
            if($this->_arrayParam['form']['token'] > 0) {
                $validate = new Validate($this->_arrayParam['form']);
                $this->_arrayParam['form']['value'] = (int)str_replace(',', '', $this->_arrayParam['form']['value']);
                $validate->addRule('name', 'string', array('min' => 3, 'max'=> 255))
                        ->addRule('value', 'string', array('min' => 4, 'max' => 10));
                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $task = isset($this->_arrayParam['form']['id']) ? 'edit' : 'add';
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'cost', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'cost', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'cost', 'form', array('id' => $id));
                }
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('cost/form');
        }

        public function trashAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'cost', 'index');
        }
    }
