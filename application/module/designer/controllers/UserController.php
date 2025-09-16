<?php
    class UserController extends Controller {
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('designer/user/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        public function indexAction(){
            $this->_view->_title            = 'Designer';
            $this->_view->render('user/index');
        }

        public function detailAction(){
            $this->_view->_title            = 'Account Detail';
            if($this->_arrayParam['id'] == $_SESSION['user']['info']['designer_id'])
                $this->_view->info              = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-account'));
            else
                URL::redirect('designer', 'user', 'index');



            if($this->_arrayParam['form']['token'] > 0){
                $password       = $this->_model->infoPassword($this->_arrayParam);
                $validate       = new Validate($this->_arrayParam['form']);
                if(md5($this->_arrayParam['form']['current_password']) != $password['password']){
                    $this->_view->errorPassword = '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li><b>Current Password:</b> Does not match </li></ul></dd></dl>';
                }elseif($this->_arrayParam['form']['change_email'] != $this->_arrayParam['form']['email']){
                    $queryEmail     = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrayParam['form']['email'] . "'";
                    $validate->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmail));

                    $validate->run();
                    $this->_arrayParam['form'] = $validate->getResult();

                    // Validate has error
                    if ($validate->isValid() == false) {
                        $this->_view->error = $validate->showErrors();
                    } else {
                        $id = $this->_model->saveItem($this->_arrayParam, array('task' => 'update-profile'));
                        URL::redirect('designer', 'user', 'detail', array('id' => $id));
                    }
                } else {
                    $id = $this->_model->saveItem($this->_arrayParam, array('task' => 'update-profile'));
                    URL::redirect('designer', 'user', 'detail', array('id' => $id));
                }


            }
            $this->_view->render('user/detail');
        }

        public function passwordAction(){
            $this->_view->_title            = 'Change Password';

            if($this->_arrayParam['form']['token'] > 0){
                $password       = $this->_model->infoPassword($this->_arrayParam);
                $flag = true;

                $validate       = new Validate($this->_arrayParam['form']);
                $validate->addRule('new_password', 'password', array('action' => 'edit'));


                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();

                // Validate has error
                if ($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    if(md5($this->_arrayParam['form']['current_password']) != $password['password']){
                        $flag = false;
                        $this->_view->errorPassword .= '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li><b>Current Password:</b> Does not match </li></ul></dd></dl>';
                    }

                    if($this->_arrayParam['form']['new_password'] != $this->_arrayParam['form']['confirm_password']){
                        $flag = false;
                        $this->_view->errorPassword .= '<ul><li><b>Confirm Password:</b> Does not match </li></ul>';
                    }
                    if($flag == true) {
                        $id = $this->_model->saveItem($this->_arrayParam, array('task' => 'change-password'));
                        URL::redirect('designer', 'user', 'password', array('id' => $id));
                    }
                }


            }
            $this->_view->render('user/password');
        }

    }
