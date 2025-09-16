<?php
class IndexController extends Controller {
    public function __construct($arrParams){
        parent::__construct($arrParams);
    }

    public function loginAction(){
        $userInfo	= Session::get('user');

        // Khi người dùng đã đăng nhập thành công
        if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
            URL::redirect('admin', 'index', 'index');
        }

        $this->_templateOBJ->setFolderTemplate('admin/main/');
        $this->_templateOBJ->setFileTemplate('login.php');
        $this->_templateOBJ->setFileConfig('template.ini');
        $this->_templateOBJ->load();

        $this->_view->_title 		= 'Login';

        if($this->_arrayParam['form']['token'] > 0) {

            $validate	= new Validate($this->_arrayParam['form']);
            $username	= $this->_arrayParam['form']['username'];
            $password	= md5($this->_arrayParam['form']['password']);
            $query		= "SELECT `user`.`id`, `group`.`status` FROM `user`, `group` WHERE `username` = '$username' AND `password` = '$password' AND `user`.`status` = 1 AND `user`.`group_id` = `group`.`id` AND `group`.`status` = 1 AND `group`.`group_acp` = 1";
            $validate->addRule('username', 'existRecord', array('database' => $this->_model, 'query' => $query));
            $validate->run();



            if($validate->isValid()==true){
                $infoUser		= $this->_model->infoItem($this->_arrayParam);
                $arraySession	= array(
                    'login'		=> true,
                    'info'		=> $infoUser,
                    'time'		=> time(),
                    'group_acp'	=> $infoUser['group_acp']
                );
                Session::set('user', $arraySession);
                $this->_model->addNotice($this->_arrayParam, array('task' => 'login'));
                URL::redirect('admin', 'index', 'index');
            }
            // Validate has error
            else{
                $this->_view->error	= $validate->showErrors();
            }
        }

        $this->_view->render('index/login');
    }

    public function indexAction(){
        $this->_templateOBJ->setFolderTemplate('admin/main/');
        $this->_templateOBJ->setFileTemplate('index.php');
        $this->_templateOBJ->setFileConfig('template.ini');
        $this->_templateOBJ->load();


        $this->_view->_title 		= 'Index';

        $userObj = Session::get('user');
        $this->_view->arrayParam['form'] = $userObj['info'];


        $this->_view->_title 		    = 'Dashboard';

        require_once APPLICATION_PATH . 'module/admin/models/DashboardModel.php';
        $dashboard = new DashboardModel();

        // Total
        $this->_view->products 		    = $dashboard->countItems($this->_arrayParam, array('task' => 'count-product'));
        $this->_view->orders 		    = $dashboard->countItems($this->_arrayParam, array('task' => 'count-order'));
        $this->_view->shipping 		    = $dashboard->countItems($this->_arrayParam, array('task' => 'count-shipping'));
        $this->_view->shipped 		    = $dashboard->countItems($this->_arrayParam, array('task' => 'count-shipped'));
        $this->_view->profit 		    = $dashboard->countItems($this->_arrayParam, array('task' => 'sum-profit'));
        $this->_view->revenue 		    = $dashboard->countItems($this->_arrayParam, array('task' => 'sum-revenue'));

        // List Items - Data
        $this->_view->dataCategoryRevenue 	    = $dashboard->listItems($this->_arrayParam, array('task' => 'category-revenue'));
        $this->_view->dataCollectionRevenue 	= $dashboard->listItems($this->_arrayParam, array('task' => 'collection-revenue'));
        $this->_view->dataCustomer       	    = $dashboard->listItems($this->_arrayParam, array('task' => 'get-customer'));
        $this->_view->stock_sold 	            = $dashboard->listItems($this->_arrayParam, array('task' => 'stock-sold'));

        $this->_view->arrayParam = $this->_arrayParam;


        $this->_view->render('dashboard/index');
    }

    public function logoutAction(){
        Session::delete('user');
        URL::redirect('admin', 'index', 'login');
    }
}
