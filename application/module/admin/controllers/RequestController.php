<?php
    class RequestController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        public function indexAction(){
            $this->_view->_title 		= 'Request';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 5,
                                                    'pageRange'         => 4
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);

            $this->_view->render('request/index');
        }

        public function formAction(){
            $this->_view->_title 		= 'Approve Request';

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam, array('task' => 'old-item'));
                $this->_view->Request 		= $this->_model->infoItem($this->_arrayParam, array('task' => 'new-item'));
                if(empty($this->_view->Request)) {
                    URL::redirect('admin', 'request', 'index');
                }
            }
            if($this->_arrayParam['form']['token'] > 0) {
                if($this->_arrayParam['type'] == 'edit'){
                    $this->_model->saveItem($this->_arrayParam, array('task' => 'edit'));
                } elseif($this->_arrayParam['type'] == 'add'){
                    $this->_model->saveItem($this->_arrayParam, array('task' => 'add'));
                } elseif($this->_arrayParam['type'] == 'deny'){
                    $this->_model->saveItem($this->_arrayParam, array('task' => 'deny'));
                }
                URL::redirect('admin', 'request', 'sendmail', array('designer_id' => $this->_arrayParam['form']['designer_id'], 'type' => $this->_arrayParam['type'], 'product_name' => $this->_arrayParam['form']['name'], 'form[token]' =>$this->_arrayParam['form']['token']));
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('request/form');
        }

        public function sendmailAction(){
            $this->_view->_title 		= 'Send Mail';
            $this->_view->infoUser = $this->_model->infoItem($this->_arrayParam,array('task' => 'info-user'));
            $this->_view->arrParam = $this->_arrayParam;
            $this->_view->render('request/sendmail');
        }
    }
