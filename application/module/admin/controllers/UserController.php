<?php
class UserController extends Controller {

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_templateOBJ->setFolderTemplate('admin/main/');
        $this->_templateOBJ->setFileTemplate('index.php');
        $this->_templateOBJ->setFileConfig('template.ini');
        $this->_templateOBJ->load();
    }

    public function indexAction(){
        $this->_view->_title 		= 'User';
        $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
        $configPagination           = array(
            'totalItemsPerPage' => 10,
            'pageRange'         => 4
        );
        $this->setPagination($configPagination);
        $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
        $this->_view->slbGroup      = $this->_model->itemInSelectbox($this->_arrayParam, null);
        $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, null);
        $this->_view->render('user/index');
    }

    public function profileAction(){
        $this->_view->_title = 'Profile';

//        $this->_view->_notice = $this->_model->infoNotice();
        $this->_arrayParam['notice'] = $this->_model->infoNotice();
        $this->_arrayParam['noticeRecently'] = $this->_model->infoNotice(array('task' => 'recently'));

        // Nếu biến POST có phần tử id (Edit)
        if (isset($this->_arrayParam['id'])) {
            $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
            if (empty($this->_arrayParam['form'])) {
                URL::redirect('default', 'user', 'index');
            }
        }

        // Khi form submit
        if ($this->_arrayParam['form']['token'] > 0) {
            $task = 'add';
            $requiredPass   = true;
            $queryUserName  = "SELECT `id` FROM `" . TBL_USER . "` WHERE `username` = '" . $this->_arrayParam['form']['username'] . "'";
            $queryEmail     = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrayParam['form']['email'] . "'";
            $password       = $this->_model->infoPassword($this->_arrayParam);

            // Trường hợp nếu tồn tại ['form']['id'] trong arrayParam, kiểm tra `id` <> 'id' người dùng nhập thì không phải ValidateExistRecord
            // Do chỉ có $task = edit thì mới có phần tử ['form']['id']
            // Nếu muốn vào được trang edit thì URL phải có phần tử id ($this->_arrayParam['id']) => sẽ có $this->_arrayParam['form']['id']
            if (isset($this->_arrayParam['form']['id']) || isset($this->_arrayParam['id'])) {
                $task = 'edit';
                $requiredPass    = false;
                $queryUserName  .= " AND `id` <> '" . $this->_arrayParam['form']['id'] . "'";
                $queryEmail     .= " AND `id` <> '" . $this->_arrayParam['form']['id'] . "'";
            }

            $validate = new Validate($this->_arrayParam['form']);
            $validate->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 255))
                ->addRule('fullname', 'string', array('min' => 1, 'max' => 100))
                ->addRule('old_password', 'password')
                ->addRule('password', 'password', array('action' => $task), $requiredPass)
                ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmail));

            $validate->run();
            $this->_arrayParam['form'] = $validate->getResult();

            if($this->_arrayParam['form']['password'] != $this->_arrayParam['form']['confirm_password'])
                $this->_view->errorPassword .= $validate->setError('Confirm Password', ' does not macth');
            if(md5($this->_arrayParam['form']['old_password']) != $password['password'])
                $this->_view->errorPassword .= $validate->setError('Old Password', ' does not macth');

            // Validate has error
            if ($validate->isValid() == false) {
                $this->_view->error = $validate->showErrors();
            } else {
                // Insert Database
                $id = $this->_model->saveItem($this->_arrayParam, array('task' => 'edit'));
                $this->_model->addNotice($this->_arrayParam, array('task' => 'edit-profile'));
                if ($this->_arrayParam['type'] == 'save') URL::redirect('admin', 'user', 'profile', array('id' => $id));
            }


        }
        $this->_view->arrayParam = $this->_arrayParam;
        $this->_view->render('user/profile');
    }

    public function formAction(){
        $this->_view->_title = 'User - Add';
        $this->_view->slbGroup      = $this->_model->itemInSelectbox($this->_arrayParam, null);

        // Nếu biến POST có phần tử id (Edit)
        if(isset($this->_arrayParam['id'])) {
            $this->_view->_title = 'User - Edit';
            $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
            if(empty($this->_arrayParam['form'])) {
                URL::redirect('admin', 'user', 'index');
            }
        }

        // Khi form submit
        if($this->_arrayParam['form']['token'] > 0) {
            $task                   = 'add';
            $requiredPass           = true;
            $queryUserName          = "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '" . $this->_arrayParam['form']['username'] ."'";
            $queryEmail             = "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '" . $this->_arrayParam['form']['email'] ."'";

            // Trường hợp nếu tồn tại ['form']['id'] trong arrayParam, kiểm tra `id` <> 'id' người dùng nhập thì không phải ValidateExistRecord
            // Do chỉ có $task = edit thì mới có phần tử ['form']['id']
            // Nếu muốn vào được trang edit thì URL phải có phần tử id ($this->_arrayParam['id']) => sẽ có $this->_arrayParam['form']['id']
            if(isset($this->_arrayParam['form']['id']) || isset($this->_arrayParam['id'])) {
                $task            = 'edit';
                $requiredPass    = false;
                $queryUserName  .= " AND `id` <> '" . $this->_arrayParam['form']['id'] . "'";
                $queryEmail     .= " AND `id` <> '" . $this->_arrayParam['form']['id'] . "'";
            }


            $validate = new Validate($this->_arrayParam['form']);
            $validate->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query'=> $queryUserName, 'min' => 3, 'max' => 255))
                ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                ->addRule('password', 'password', array('action' => $task), $requiredPass)
                ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query'=> $queryEmail))
                ->addRule('status', 'status',array('deny' => array('default')))
                ->addRule('group_id', 'status',array('deny' => array('default')));
            $validate->run();
            $this->_arrayParam['form'] = $validate->getResult();
            // Validate has error
            if($validate->isValid() == false) {
                $this->_view->error = $validate->showErrors();
            } else {
                // Insert Database
                $id = $this->_model->saveItem($this->_arrayParam, array('task' => $task));
                if($this->_arrayParam['type'] == 'save-close') 	    URL::redirect('admin', 'user', 'index');
                if($this->_arrayParam['type'] == 'save-new') 		URL::redirect('admin', 'user', 'form');
                if($this->_arrayParam['type'] == 'save')     		URL::redirect('admin', 'user', 'form', array('id' => $id));
            }
        }
        $this->_view->arrayParam = $this->_arrayParam;
        $this->_view->render('user/form');
    }

    public function ajaxStatusAction(){
        $result = $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-ajax-status'));
        echo json_encode($result);

    }

    public function statusAction(){
        $this->_model->changeStatus($this->_arrayParam, array('task' => 'change-status'));
        URL::redirect('admin', 'user', 'index');

    }

    public function trashAction(){
        $this->_model->deleteItem($this->_arrayParam);
        URL::redirect('admin', 'user', 'index');
    }

    public function orderingAction(){
        $this->_model->ordering($this->_arrayParam);
        URL::redirect('admin', 'user', 'index');
    }
}
