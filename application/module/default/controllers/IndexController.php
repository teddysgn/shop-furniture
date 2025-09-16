<?php
    class IndexController extends Controller {
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('default/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        public function loginAction(){
            $userInfo	= Session::get('user');
            // Khi người dùng đã đăng nhập thành công
            if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
                URL::redirect('default', 'user', 'index');
            }

            $this->_view->_title 		= 'Login';

            if($this->_arrayParam['form']['token'] > 0) {
                $validate	    = new Validate($this->_arrayParam['form']);
                $username	    = $this->_arrayParam['form']['username'];
                $password	    = md5($this->_arrayParam['form']['password']);

                $user = $this->_model->infoItem($this->_arrayParam);

                $registerDate = strtotime($user['register_date']);
                $status = $user['status'];

                if($status == 1){
                    $query		= "SELECT `user`.`id`, `group`.`status` FROM `user`, `group` WHERE `username` = '$username' AND `password` = '$password' AND `user`.`group_id` = `group`.`id` AND `group`.`status` = 1";
                    $validate->addRule('username', 'existRecord', array('database' => $this->_model, 'query' => $query));
                    $validate->run();


                    // Validate has error
                    if($validate->isValid()==true){
                        $infoUser		= $this->_model->infoItem($this->_arrayParam);
                        $arraySession	= array(
                            'login'		=> true,
                            'info'		=> $infoUser,
                            'time'		=> time(),
                            'group_acp'	=> $infoUser['group_acp'],
                        );
                        Session::set('user', $arraySession);
                        $this->_model->addNotice($this->_arrayParam, array('task' => 'login'));
                        URL::redirect('default', 'index', 'user', null, 'user');
                    }else{
                        $this->_view->error	= $validate->showErrorsPublic();
                    }
                } elseif(time() - $registerDate < TIME_ACTIVATE && $status == 0 ){
                    $this->_model->updateStatus($user['id']);
                    $query		= "SELECT `user`.`id`, `group`.`status` FROM `user`, `group` WHERE `username` = '$username' AND `password` = '$password' AND `user`.`group_id` = `group`.`id` AND `group`.`status` = 1";
                    $validate->addRule('username', 'existRecord', array('database' => $this->_model, 'query' => $query));
                    $validate->run();

                    // Validate has error
                    if($validate->isValid()==true){
                        $infoUser		= $this->_model->infoItem($this->_arrayParam);
                        $arraySession	= array(
                            'login'		=> true,
                            'info'		=> $infoUser,
                            'time'		=> time(),
                            'group_acp'	=> $infoUser['group_acp'],
                        );
                        Session::set('user', $arraySession);
                        $this->_model->addNotice($this->_arrayParam, array('task' => 'login'));
                        URL::redirect('default', 'index', 'index', null, 'index');
                    }else{
                        $this->_view->error	= $validate->showErrorsPublic();
                    }
                } else{
                    Session::set('idReset', $user['id']);
                    Session::set('emailReset', $user['email']);
                    Session::set('nameReset', $user['fullname']);
                    $linkActive = URL::createLink('default', 'index', 'reset');
                    Session::set('message', array('class' => 'error', 'content' => 'Your Account is not be activate before 48h after registration. Click <a href="'.$linkActive.'">here</a> to receive a new passcode'));
                }
            }
            $this->_view->render('index/user');
        }

        public function logoutAction(){
            Session::delete('user');
            URL::redirect('default', 'index', 'user', null, 'user');
        }

        public function indexAction(){
            $this->_view->_title            = 'Home';
            $this->_view->Special           = $this->_model->listItems($this->_arrayParam, array('task' => 'products-special'));
            $this->_view->Total             = $this->_model->totalItems($this->_arrayParam, array('task' => 'total-product'));
            $this->_view->Order             = $this->_model->totalItems($this->_arrayParam, array('task' => 'total-order'));
            $this->_view->User              = $this->_model->totalItems($this->_arrayParam, array('task' => 'total-user'));
            $this->_view->render('index/index');
        }

        public function noticeAction(){
            $this->_view->_title = 'Error';
            $this->_view->render('index/notice');
        }

        public function renewAction()
        {
            $this->_view->_title = 'Recover Password';
            $this->_view->email = $this->_model->infoItem($this->_arrayParam, array('task' => 'check-mail-exist'));
            if(isset($this->_view->email['email']) && isset($this->_view->email['username'])){
                $this->_view->render('index/sendrenew');
            }
            $this->_view->render('index/renew');
        }

        public function aboutAction(){
            $this->_view->h1            = 'About Us';
            $this->_view->_title        = 'About Us';
            $this->_view->Picture       = $this->_model->listItems($this->_arrayParam, array('task' => 'get-picture'));
            $this->_view->render('index/about');
        }

        public function serviceAction(){
            $this->_view->h1 = 'Our Services';
            $this->_view->_title = 'Our Services';
            $this->_view->render('index/service');
        }

        public function contactAction()
        {
            $this->_view->_title 		= 'Contact';
            $this->_view->h1 = 'Contact Us';
            $this->_view->render('index/contact');
        }

        public function blogAction()
        {
            $this->_view->_title = 'Blogs';
            $this->_view->render('index/blog');
        }

        public function registerAction() {
            $this->_view->h1 = 'Register';
            $this->_view->p = 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.';
            $userInfo	= Session::get('user');
            // Khi người dùng đã đăng nhập thành công
            if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
                URL::redirect('default', 'user', 'index');
            }

            if(isset($this->_arrayParam['form']['submit'])) {
                // Người dùng refresh trang
                URL::checkRefreshPage($this->_arrayParam['form']['token'], 'default', 'index', 'user');

                $queryUserName  = "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '" . $this->_arrayParam['form']['username'] ."'";
                $queryEmail     = "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '" . $this->_arrayParam['form']['email'] ."'";

                $validate = new Validate($this->_arrayParam['form']);
                $validate->addRule("username", 'string-notExistRecord', array('database' => $this->_model, 'query'=> $queryUserName, 'min' => 3, 'max' => 255))
                    ->addRule("email", 'email-notExistRecord', array('database' => $this->_model, 'query'=> $queryEmail));
                $validate->run();

                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrorsPublic();
                } else {
                    // Insert Database
                    $this->_model->saveItem($this->_arrayParam, array('task' => 'user-register'));
                    URL::redirect('default', 'index', 'sendmail');
                    URL::redirect('default', 'index', 'notice', array('type' => 'register-success'));
                }
            }
            $this->_view->render('index/user');
        }

        public function sendmailAction(){
            $this->_view->infoAccount = $this->_model->infoAccount($this->_arrayParam);
            $this->_view->render('index/sendmail');
        }

        public function resetAction(){
            $this->_view->_title = 'Reactivate Account';
            $newPassword = $this->_model->randomString(7);
            Session::set('password', $newPassword);
            $this->_model->updateStatus(Session::get('idReset'), array('task' => 'reset'));
            $this->_view->reset = true;
            $this->_view->render('index/sendmail');
        }
    }
