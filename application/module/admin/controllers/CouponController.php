<?php
    class CouponController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        // Action:  List Voucher
        public function indexAction(){
            $this->_view->_title 		= 'Coupon';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $configPagination           = array(
                                                    'totalItemsPerPage' => 5,
                                                    'pageRange'         => 4
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, null);
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);

            $this->_view->render('coupon/index');
        }

        // Action:  Add - Edit Voucher
        public function formAction(){
            $this->_view->_title = 'Coupon - Add';
            $queryCode  = "SELECT `id` FROM `" . TBL_COUPON . "` WHERE `code` = '" . $this->_arrayParam['form']['code'] . "'";

            // Nếu biến POST có phần tử id (Edit)
            if(isset($this->_arrayParam['id'])) {
                $this->_view->_title = 'Coupon - Edit';
                $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
                $queryCode  .= " AND `id` <> " . $this->_arrayParam['form']['id'];
                if(empty($this->_arrayParam['form'])) {
                    URL::redirect('admin', 'coupon', 'index');
                }
            }


            if($this->_arrayParam['form']['token'] > 0) {
                $validate = new Validate($this->_arrayParam['form']);
                $validate->addRule('name', 'string', array('min' => 3, 'max'=> 255))
                    ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                    ->addRule('value', 'int', array('min' => 1, 'max' => 50))
                    ->addRule('status', 'status',array('deny' => array('default')))
                    ->addRule('code', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryCode, 'min' => 3, 'max' => 255));
                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $task = isset($this->_arrayParam['form']['id']) ? 'edit' : 'add';
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                    if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'coupon', 'index');
                    if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'coupon', 'form');
                    if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'coupon', 'form', array('id' => $id));
                }
            }
            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('coupon/form');
        }

        // Action: Ajax Status
        public function ajaxStatusAction(){
            $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
            echo json_encode($result);
        }

        // Action: Status
        public function statusAction(){
            $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
            URL::redirect('admin', 'coupon', 'index');

        }

        // Action: Trash
        public function trashAction(){
            $this->_model->deleteItem($this->_arrayParam);
            URL::redirect('admin', 'coupon', 'index');
        }

        // Action: Ordering
        public function orderingAction(){
            $this->_model->ordering($this->_arrayParam);
            URL::redirect('admin', 'coupon', 'index');
        }

        // Action: Quantity
        public function quantityAction(){
            $this->_model->quantity($this->_arrayParam);
            URL::redirect('admin', 'coupon', 'index');
        }
    }
