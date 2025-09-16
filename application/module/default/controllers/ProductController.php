<?php
    class ProductController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('default/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        // Action:  List Product
        public function shopAction(){
            $this->_view->h1 = 'Product';
            $this->_view->_title 		= 'Product';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, null);
            $this->_view->allItems      = $this->_model->countItems($this->_arrayParam, null);
            $this->_view->nameProduct   = $this->_model->listItems($this->_arrayParam, array('task' => 'get-name-product'));
            if(isset($_SESSION['user']['info']['id']))
                $this->_view->infoFavorite  = $this->_model->favorite($this->_arrayParam, array('task' => 'info-favorite'));

            $configPagination           = array(
                                                    'totalItemsPerPage' => 15,
                                                    'pageRange'         => 5
                                                );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->categoryName  = $this->_model->infoItems($this->_arrayParam, array('task' => 'get-category-name'));
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, array('task' => 'product-in-category'));

            // Nếu không tồn tại cate_name trong CSDL, redirect về Home
            if(!isset($this->_view->categoryName)) {
                URL::redirect('default', 'index', 'index');
            }
            $this->_view->render('product/shop');
        }

        // Action:  List Collection
        public function collectionAction(){
            $this->_view->_title 		= 'Collection';
            $totalItems                 = $this->_model->countItems($this->_arrayParam, array('task' => 'products-in-collection'));
            $this->_view->allItems      = $this->_model->countItems($this->_arrayParam, array('task' => 'products-in-collection'));


            $configPagination           = array(
                'totalItemsPerPage' => 15,
                'pageRange'         => 5
            );
            $this->setPagination($configPagination);
            $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);
            $this->_view->categoryName  = $this->_model->infoItems($this->_arrayParam, array('task' => 'get-collection-name'));
            $this->_view->Items 		= $this->_model->listItems($this->_arrayParam, array('task' => 'product-in-collection'));

            // Nếu không tồn tại cate_name trong CSDL, redirect về Home
            if(!isset($this->_view->categoryName)) {
                URL::redirect('default', 'index', 'index');
            }
            $this->_view->render('product/collection');
        }

        // Action: Detail Product
        public function detailAction(){
            $this->_view->_title 		        = 'Detail';
            $this->_view->productInfo           = $this->_model->infoItems($this->_arrayParam, array('task' => 'product-info'));
            $this->_view->productRelated 	    = $this->_model->listItems($this->_arrayParam, array('task' => 'product-related'));
            $this->_view->productCollection 	= $this->_model->listItems($this->_arrayParam, array('task' => 'product-collection'));
            
            $this->_model->updateView($this->_arrayParam);
            
            // Nếu không tồn tại id trong CSDL, redirect về Home
            if(isset($this->_arrayParam['form']['token'])) {
                    $this->_model->comment($this->_arrayParam, array('task' => 'add-comment'));
            }
            
            if(!isset($this->_view->productInfo['id'])) {
                    URL::redirect('default', 'index', 'index');
            }
            $this->_view->comment 	            = $this->_model->comment($this->_arrayParam, array('task' => 'get-comment'));
            $this->_view->show 	                = $this->_model->comment($this->_arrayParam, array('task' => 'check-in-order'));
            
            $this->_view->render('product/detail');
        }

        public function likeAction(){
            if(isset($_SESSION['user']['info']['id']))
                $this->_model->favorite($this->_arrayParam, array('task' => 'add-favorite'));
            else
                $this->_view->render('index/user');
            $this->_view->render('product/shop');
        }

    }
