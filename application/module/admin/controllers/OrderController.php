<?php
    class OrderController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        // Action:  List Order
        public function indexAction(){
            $this->_view->_title 		= 'Order';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 10,
                                                    'pageRange'         => 5
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, null);
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);

            $this->_view->render('order/index');
        }

        // Action: Add - Edit Order
        public function formAction(){
            $this->_view->Items 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'detail-order'));

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title = 'Order - Detail';
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
                if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'order', 'index');
                }
            }

            // Khi form submit
            if($this->_arrayParam['form']['token'] > 0) {
                // Trường hợp nếu tồn tại ['form']['id'] trong arrayParam, kiểm tra `id` <> 'id' người dùng nhập thì không phải ValidateExistRecord
                // Do chỉ có $task = edit thì mới có phần tử ['form']['id']
                // Nếu muốn vào được trang edit thì URL phải có phần tử id ($this->_arrayParam['id']) => sẽ có $this->_arrayParam['form']['id']
                if(isset($this->_arrayParam['form']['id']) || isset($this->_arrayParam['id'])) {
                    $task            = 'edit';
                }


                $validate = new Validate($this->_arrayParam['form']);
                $validate->addRule('status', 'status',array('deny' => array('default')));
                $validate->addRule('completed', 'status',array('deny' => array('default')));

                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();

                if($this->_arrayParam['form']['status'] == 0 && $this->_arrayParam['form']['completed'] == 1){
                    $this->_view->errorStatus .= $validate->setError('Pending And Completed', ' Pending is "Not yet" And Completed is "Shipped"');
                }

                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                    if($this->_arrayParam['form']['status'] == 1)
                        $this->_model->addNotice($this->_arrayParam['form'], array('task' => 'status', 'status' => $this->_arrayParam['status']));

                    if($this->_arrayParam['form']['completed'] == 1)
                        $this->_model->addNotice($this->_arrayParam['form'], array('task' => 'completed', 'completed' => $this->_arrayParam['completed']));
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'order', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'order', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'order', 'form', array('id' => $id));

                }
            }
            $this->_view->arrayParam = $this->_arrayParam;

            $this->_view->render('order/form');
        }

        // Action: Ajax Status
        public function ajaxStatusAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
            $this->_model->addNotice($this->_arrayParam, array('task' => 'status', 'status' => $this->_arrayParam['status']));
            echo json_encode($result);
        }

        // Action: Ajax Completed
        public function ajaxCompletedAction(){
            $result = $this->_model->changeCompleted($this->_arrayParam, array('task' => 'change-ajax-completed'));
            $this->_model->addNotice($this->_arrayParam, array('task' => 'completed', 'completed' => $this->_arrayParam['completed']));
            echo json_encode($result);
        }
        
        // Action: Ajax Cancel
        public function ajaxCancelAction(){
            $result = $this->_model->changeCancel($this->_arrayParam, array('task' => 'change-ajax-cancel'));
            echo json_encode($result);
        }

        // Action: Status
        public function statusAction(){
            $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
            $this->_model->addNotices($this->_arrayParam, array('task' => 'change-status'));
            URL::redirect('admin', 'order', 'index');
        }

        // Action: Completed
        public function completedAction(){
            $this->_model->changeCompleted($this->_arrayParam, array('task' => 'change-completed'));
            $this->_model->addNotices($this->_arrayParam, array('task' => 'change-completed'));
            URL::redirect('admin', 'order', 'index');
        }

        // Action: Trash
        public function trashAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'order', 'index');
        }

        public function downloadAction(){
            $this->_view->Download 		= $this->_model->listItems($this->_arrayParam, array('task' => 'download'));
            $this->_view->render('order/download');
        }
    }
