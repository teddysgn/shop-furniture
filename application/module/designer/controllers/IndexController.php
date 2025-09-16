<?php
    class IndexController extends Controller {
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();

        }

        public function indexAction(){
            $this->_view->_title            = 'Designer';

            $this->_view->product           = $this->_model->listItems($this->_arrayParam, array('task' => 'list-products'));
            $this->_view->viewProduct       = $this->_model->infoItem($this->_arrayParam, array('task' => 'view-product'));
            $this->_view->process           = $this->_model->infoItem($this->_arrayParam, array('task' => 'in-process'));
            $this->_view->more              = $this->_model->listItems($this->_arrayParam, array('task' => 'more-products'));


            $this->_view->render('index/index');
        }

        public function loginAction(){
            $userInfo	= Session::get('user');

            // Khi người dùng đã đăng nhập thành công
            if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
                URL::redirect('designer', 'index', 'index');
            }

            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('login.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();

            $this->_view->_title 		= 'Login';

            if($this->_arrayParam['form']['token'] > 0) {

                $validate	= new Validate($this->_arrayParam['form']);
                $username	= $this->_arrayParam['form']['username'];
                $password	= md5($this->_arrayParam['form']['password']);
                $query		= "SELECT `user`.`id`, `group`.`status` FROM `user`, `group` WHERE `username` = '$username' AND `password` = '$password' AND `user`.`status` = 1 AND `user`.`group_id` = `group`.`id` AND `group`.`status` = 1 AND `group`.`group_acp` = 2";
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
                    URL::redirect('designer', 'index', 'index');
                }
                // Validate has error
                else{
                    $this->_view->error	= $validate->showErrors();
                }
            }
            $this->_view->render('index/login');
        }

        public function logoutAction(){
            Session::delete('user');
            URL::redirect('designer', 'index', 'login');
        }

        public function productAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('product.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'Product';
            $this->_view->productInfo       = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-product'));
            $this->_view->requestInfo       = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-request'));
            $this->_view->productRelated    = $this->_model->infoItem($this->_arrayParam, array('task' => 'related-product'));

            $this->_view->render('index/product');
        }

        public function categoryAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('shop.php');
            $this->_templateOBJ->load();

            $this->_view->_title            = 'Category';

            $totalItems                 = $this->_model->countItems($this->_arrayParam, array('task' => 'products-in-category'));
            $configPagination           = array(
                'totalItemsPerPage' => 6,
                'pageRange'         => 5
            );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);

            $this->_view->collection        = $this->_model->listItems($this->_arrayParam, array('task' => 'get-collection-in-category'));
            $this->_view->category          = $this->_model->listItems($this->_arrayParam, array('task' => 'get-category-in-category'));
            $this->_view->product           = $this->_model->listItems($this->_arrayParam, array('task' => 'products-in-category'));

            $this->_view->render('index/category');
        }

        public function shopAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('shop.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'All Product';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, array('task' => 'all-products'));
            $configPagination           = array(
                'totalItemsPerPage' => 15,
                'pageRange'         => 5
            );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);

            $this->_view->collection        = $this->_model->listItems($this->_arrayParam, array('task' => 'get-collection-in-shop'));
            $this->_view->category          = $this->_model->listItems($this->_arrayParam, array('task' => 'get-category-in-shop'));
            $this->_view->product           = $this->_model->listItems($this->_arrayParam, array('task' => 'all-products'));
            $this->_view->render('index/shop');
        }

        public function formAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('form.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'Edit';
            $this->_view->productInfo       = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-product'));
            $this->_view->requestInfo       = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-request'));

            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'category'));
            $this->_view->slbCollection = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'collection'));

            if($this->_arrayParam['form']['token'] > 0){
                $queryProductName          = "SELECT `name` FROM `".TBL_PRODUCT."` WHERE `name` = '" . $this->_arrayParam['form']['name'] ."'";

                $validate = new Validate($this->_arrayParam['form']);
                if($this->_arrayParam['form']['name'] != $this->_arrayParam['form']['product_name'])
                    $validate->addRule("name", 'string-notExistRecord', array('database' => $this->_model, 'query'=> $queryProductName, 'min' => 3, 'max' => 255));

                $validate->addRule('category_id', 'status',array('deny' => array('default')))
                         ->addRule('collection_id', 'status',array('deny' => array('default')));


                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $this->_model->submitRequest($this->_arrayParam, array('task' => 'edit'));
                    URL::redirect('designer', 'index', 'sendmail', array("form[token]" => $this->_arrayParam['form']['token']));
                }
            }

            $this->_view->render('index/form');
        }

        public function addAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('form.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'Add';

            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'category'));
            $this->_view->slbCollection = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'collection'));

            $this->_view->_arrayParam['form'] = $this->_arrayParam;
            if($this->_arrayParam['form']['token'] > 0){
                $queryProductName          = "SELECT `name` FROM `".TBL_PRODUCT."` WHERE `name` = '" . $this->_arrayParam['form']['name'] ."'";

                $validate = new Validate($this->_arrayParam['form']);

                $validate->addRule('category_id', 'status',array('deny' => array('default')))
                         ->addRule('collection_id', 'status',array('deny' => array('default')))
                         ->addRule('name', 'string-notExistRecord', array('database' => $this->_model, 'query'=> $queryProductName, 'min' => 3, 'max' => 255));

                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $this->_model->submitRequest($this->_arrayParam, array('task' => 'add'));
                    URL::redirect('designer', 'index', 'sendmail', array("form[token]" => $this->_arrayParam['form']['token']));
                }
            }

            $this->_view->render('index/add');
        }

        public function requestAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('form.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'Add';

            $this->_view->requestEdit       = $this->_model->listItems($this->_arrayParam, array('task' => 'get-request-edit'));
            $this->_view->requestAdd        = $this->_model->listItems($this->_arrayParam, array('task' => 'get-request-add'));

            $this->_view->render('index/request');
        }

        public function sendmailAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('form.php');
            $this->_templateOBJ->load();
            $this->_view->render('index/sendmail');
        }

        public function detailAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('form.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'Detail Request';

            $this->_view->newItem       = $this->_model->infoItem($this->_arrayParam, array('task' => 'get-new-item'));
            $this->_view->oldItem       = $this->_model->infoItem($this->_arrayParam, array('task' => 'get-old-item'));

            $this->_view->render('index/detail');
        }

        public function editAction(){
            $this->_templateOBJ->setFolderTemplate('designer/main/');
            $this->_templateOBJ->setFileTemplate('form.php');
            $this->_templateOBJ->load();
            $this->_view->_title            = 'Edit Request';

            $this->_view->oldItem       = $this->_model->infoItem($this->_arrayParam, array('task' => 'get-old-item'));
            $this->_view->infoItem       = $this->_model->infoItem($this->_arrayParam, array('task' => 'get-new-item'));
            $this->_view->slbCategory   = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'category'));
            $this->_view->slbCollection = $this->_model->itemInSelectbox($this->_arrayParam, array('task' => 'collection'));

            if($this->_arrayParam['form']['token'] > 0){
                $queryProductName          = "SELECT `name` FROM `".TBL_PRODUCT."` WHERE `name` = '" . $this->_arrayParam['form']['name'] ."'";

                $validate = new Validate($this->_arrayParam['form']);
                if($this->_arrayParam['form']['name'] != $this->_arrayParam['form']['product_name'])
                    $validate->addRule("name", 'string-notExistRecord', array('database' => $this->_model, 'query'=> $queryProductName, 'min' => 3, 'max' => 255));

                $validate->addRule('category_id', 'status',array('deny' => array('default')))
                    ->addRule('collection_id', 'status',array('deny' => array('default')));


                $validate->run();
                $this->_arrayParam['form'] = $validate->getResult();
                // Validate has error
                if($validate->isValid() == false) {
                    $this->_view->error = $validate->showErrors();
                } else {
                    // Insert Database
                    $this->_model->saveItem($this->_arrayParam);
                    URL::redirect('designer', 'index', 'sendmail', array("form[token]" => $this->_arrayParam['form']['token']));
                }
            }

            $this->_view->render('index/edit');
        }
    }

