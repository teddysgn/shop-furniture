<?php
    class DesignerController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        // Action:  List Designer
        public function indexAction(){
            $this->_view->_title 		= 'Designer Manager :: List';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 10,
                                                    'pageRange'         => 4
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'category'));
            $this->_view->slbCollection = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'collection'));
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);
            $this->_view->Become 		= $this->_model->listItems($this->_arrayParam, array('task' => 'become'));
            $this->_view->render('designer/index');
        }

        // Action: Add - Edit Designer
        public function formAction(){

            $this->_view->_title            = 'Designer: Add';

            if(!empty($_FILES)) {
                $this->_arrayParam['form']['picture_profile']  = $_FILES['picture_profile'];
                $this->_arrayParam['form']['picture_background']  = $_FILES['picture_background'];
                $this->_arrayParam['form']['picture1']  = $_FILES['picture1'];
                $this->_arrayParam['form']['picture2']  = $_FILES['picture2'];
                $this->_arrayParam['form']['picture3']  = $_FILES['picture3'];
                $this->_arrayParam['form']['picture4']  = $_FILES['picture4'];
            }

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title = 'Designer: Edit';
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
                    if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'designer', 'index');
                }
            }

            // Khi form submit
            if($this->_arrayParam['form']['token'] > 0) {
                $task           = 'add';

                // Trường hợp nếu tồn tại ['form']['id'] trong arrayParam, kiểm tra `id` <> 'id' người dùng nhập thì không phải ValidateExistRecord
                // Do chỉ có $task = edit thì mới có phần tử ['form']['id']
                // Nếu muốn vào được trang edit thì URL phải có phần tử id ($this->_arrayParam['id']) => sẽ có $this->_arrayParam['form']['id']
                if(isset($this->_arrayParam['form']['id']) || isset($this->_arrayParam['id'])) {
                    $task            = 'edit';
                }


                $validate = new Validate($this->_arrayParam['form']);
                $validate
                        ->addRule('picture_profile'     , 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture_background'  , 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture1'            , 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture2'            , 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture3'            , 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false)
                        ->addRule('picture4'            , 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false);


                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'designer', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'designer', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'designer', 'form', array('id' => $id));
                }
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('designer/form');
        }

        public function becomeAction(){
            $this->_view->_title            = 'Designer: Approve Request';
            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-become'));
                if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'designer', 'index');
                }
            }
          
            // Khi form submit
            if(isset($this->_arrayParam['type'])) {
                if($this->_arrayParam['type'] == 'save'){
                    $this->_model->approveRequest($this->_arrayParam, array('task' => 'save'));
                } elseif($this->_arrayParam['type'] == 'deny'){
                    $this->_model->approveRequest($this->_arrayParam, array('task' => 'deny'));
                }
            }
            $this->_arrayParam['token'] = time();
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('designer/become');
        }

        // Action: Ajax Status
        public function ajaxStatusAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
            echo json_encode($result);
        }

        // Action: Status
        public function statusAction(){
            $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
            URL::redirect('admin', 'designer', 'index');

        }

        // Action: Trash
        public function trashAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'designer', 'index');
        }

        // Action: Ordering
        public function orderingAction(){
            $this->_model->ordering($this->_arrayParam);
            URL::redirect('admin', 'designer', 'index');
        }
    }
