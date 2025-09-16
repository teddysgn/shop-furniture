<?php
    class ProductController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        // Action:  List Product
        public function indexAction(){
            $this->_view->_title 		= 'Product Manager :: List';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 10,
                                                    'pageRange'         => 4
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'category'));
            $this->_view->slbCollection = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'collection'));
            $this->_view->slbDesigner   = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'designer'));
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);
            
;           $this->_view->requestItems 	= $this->_model->listItems($this->_arrayParam, array('task' => 'new-item'));
            $this->_view->render('product/index');
        }

        // Action: Add - Edit Product
        public function formAction(){

            $this->_view->_title            = 'Product: Add';
            $this->_view->slbCategory       = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'category'));
            $this->_view->slbCollection     = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'collection'));
            $this->_view->slbDesigner       = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'designer'));

            if(!empty($_FILES)) {
                $this->_arrayParam['form']['picture1']  = $_FILES['picture1'];
                $this->_arrayParam['form']['picture2']  = $_FILES['picture2'];
                $this->_arrayParam['form']['picture3']  = $_FILES['picture3'];
                $this->_arrayParam['form']['picture4']  = $_FILES['picture4'];
                $this->_arrayParam['form']['picture5']  = $_FILES['picture5'];
                $this->_arrayParam['form']['picture6']  = $_FILES['picture6'];
                $this->_arrayParam['form']['picture7']  = $_FILES['picture7'];
                $this->_arrayParam['form']['picture8']  = $_FILES['picture8'];
                $this->_arrayParam['form']['picture9']  = $_FILES['picture9'];
                $this->_arrayParam['form']['picture10']  = $_FILES['picture10'];
                $this->_arrayParam['form']['picture11']  = $_FILES['picture11'];
                $this->_arrayParam['form']['picture12']  = $_FILES['picture12'];
            }

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title = 'Product: Edit';
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
                    if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'product', 'index');
                }
            }

            // Khi form submit
            if($this->_arrayParam['form']['token'] > 0) {
                $task           = 'add';

                // Trường hợp nếu tồn tại ['form']['id'] trong arrayParam, kiểm tra `id` <> 'id' người dùng nhập thì không phải ValidateExistRecord
                // Do chỉ có $task = edit thì mới có phần tử ['form']['id']
                // Nếu muốn vào được trang edit thì URL phải có phần tử id ($this->_arrayParam['id']) => sẽ có $this->_arrayParam['form']['id']

                $queryName  = "SELECT `id` FROM `" . TBL_PRODUCT . "` WHERE `name` = '" . $this->_arrayParam['form']['name'] . "'";

                $validate = new Validate($this->_arrayParam['form']);
                if(isset($this->_arrayParam['form']['id']) || isset($this->_arrayParam['id'])) {
                    $task            = 'edit';
                }else {
                    $validate->addRule('name', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryName, 'min' => 3, 'max' => 255));
                }
                $this->_arrayParam['form']['price'] = (int)str_replace(',', '', $this->_arrayParam['form']['price']);
                $validate->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                        ->addRule('price', 'string', array('min' => 4, 'max' => 10))
                        ->addRule('status', 'status',array('deny' => array('default')))
                        ->addRule('special', 'status',array('deny' => array('default')))
                        ->addRule('category_id', 'status',array('deny' => array('default')))
                        ->addRule('collection_id', 'status',array('deny' => array('default')))
                        ->addRule('designer_id', 'status',array('deny' => array('default')))
                        ->addRule('picture1', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture2', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture3', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture4', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture5', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture6', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture7', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture8', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture9', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture10', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture11', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture12', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false);

                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'product', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'product', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'product', 'form', array('id' => $id));
                }
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('product/form');
        }

        // Action: Ajax Status
        public function ajaxStatusAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
            echo json_encode($result);
        }

        // ACTION: AJAX Special
        public function ajaxSpecialAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-special'));
            echo json_encode($result);
        }

        // Action: Status
        public function statusAction(){
            $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
            URL::redirect('admin', 'product', 'index');

        }

        // Action: Status
        public function specialAction(){
            $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-special'));
            URL::redirect('admin', 'product', 'index');

        }

        // Action: Trash
        public function trashAction(){
            $this->_model->trashItem($this->_arrayParam);
            URL::redirect('admin', 'product', 'index');
        }
        
        // Action: Delete
        public function deleteAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'product', 'index');
        }
        
        // Action: Restore
        public function restoreAction(){
            $this->_model->restoreItem($this->_arrayParam);
            URL::redirect('admin', 'product', 'index');
        }

        // Action: Ordering
        public function orderingAction(){
            $this->_model->ordering($this->_arrayParam);
            URL::redirect('admin', 'product', 'index');
        }
    }
