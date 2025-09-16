<?php
    class GroupController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        // Action:  List Group
        public function indexAction(){
            $this->_view->_title 		= 'Group';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 5,
                                                    'pageRange'         => 3
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            echo ($this->_arrayParam['group_acp'] == 0) ? 0 : ($this->_arrayParam['group_acp'] == 1 ? 1 : 2);
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);

            $this->_view->render('group/index');
        }

        // Action:  Add - Edit Group
        public function formAction(){
            $this->_view->_title = 'Group - Add';

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title = 'Group - Edit';
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
                if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'group', 'index');
                }
            }
            if($this->_arrayParam['form']['token'] > 0) {
                $validate = new Validate($this->_arrayParam['form']);
                $validate->addRule('name', 'string', array('min' => 3, 'max'=> 255))
                        ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                        ->addRule('status', 'status',array('deny' => array('default')))
                        ->addRule('group_acp', 'status',array('deny' => array('default')));
                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $task = isset($this->_arrayParam['form']['id']) ? 'edit' : 'add';
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'group', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'group', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'group', 'form', array('id' => $id));
                }
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('group/form');
        }

        // Action: Ajax Status
        public function ajaxStatusAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
            echo json_encode($result);

        }

        // Action: Ajax Group ACP
        public function ajaxGroupACPAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-group-acp'));
            echo json_encode($result);

        }

        // Action: Status
        public function statusAction(){
            $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
            URL::redirect('admin', 'group', 'index');

        }

        // Action: Trash
        public function trashAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'group', 'index');
        }

        // Action: Ordering
        public function orderingAction(){
            $this->_model->ordering($this->_arrayParam);
            URL::redirect('admin', 'group', 'index');
        }
    }
