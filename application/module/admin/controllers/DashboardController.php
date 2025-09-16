<?php
    class DashboardController extends Controller {

        public function __construct($arrParams)
        {
            parent::__construct($arrParams);
            $this->_templateOBJ->setFolderTemplate('admin/main/');
            $this->_templateOBJ->setFileTemplate('index.php');
            $this->_templateOBJ->setFileConfig('template.ini');
            $this->_templateOBJ->load();
        }

        public function indexAction(){
            $this->_view->_title 		    = 'Dashboard';

            // Total
            $this->_view->products 		    = $this->_model->countItems($this->_arrayParam, array('task' => 'count-product'));
            $this->_view->orders 		    = $this->_model->countItems($this->_arrayParam, array('task' => 'count-order'));
            $this->_view->shipping 		    = $this->_model->countItems($this->_arrayParam, array('task' => 'count-shipping'));
            $this->_view->shipped 		    = $this->_model->countItems($this->_arrayParam, array('task' => 'count-shipped'));
            $this->_view->profit 		    = $this->_model->countItems($this->_arrayParam, array('task' => 'sum-profit'));
            $this->_view->revenue 		    = $this->_model->countItems($this->_arrayParam, array('task' => 'sum-revenue'));

            // Month Selected
            $this->_view->monthProduct 		= $this->_model->countItems($this->_arrayParam, array('task' => 'month-product'));
            $this->_view->monthOrder 		= $this->_model->countItems($this->_arrayParam, array('task' => 'month-order'));
            $this->_view->monthShipping 	= $this->_model->countItems($this->_arrayParam, array('task' => 'month-shipping'));
            $this->_view->monthShipped 		= $this->_model->countItems($this->_arrayParam, array('task' => 'month-shipped'));
            $this->_view->monthRevenue 		= $this->_model->countItems($this->_arrayParam, array('task' => 'month-revenue'));
            $this->_view->monthProfit 		= $this->_model->countItems($this->_arrayParam, array('task' => 'month-profit'));


            $select = isset($this->_arrayParam['form']['select']) ? $this->_arrayParam['form']['select'] : 'slb_day';
            switch ($select){
                case 'slb_day':
                    $this->_view->data 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'day-revenue'));
                    break;
                case 'slb_month':
                    $this->_view->data 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'month-revenue'));
                    $this->_view->cost 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'get-cost-month'));
                    break;
                case 'slb_quarter':
                    $this->_view->data 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'quarter-revenue'));
                    $this->_view->cost 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'get-cost-quarter'));
                    break;
            }
            // List Items - Data
            $this->_view->dataCategoryRevenue 	    = $this->_model->listItems($this->_arrayParam, array('task' => 'category-revenue'));
            $this->_view->dataCollectionRevenue 	= $this->_model->listItems($this->_arrayParam, array('task' => 'collection-revenue'));
            $this->_view->dataCustomer       	    = $this->_model->listItems($this->_arrayParam, array('task' => 'get-customer'));
            $this->_view->stock_sold 	            = $this->_model->listItems($this->_arrayParam, array('task' => 'stock-sold'));
            if(($this->_arrayParam['idProduct']) != null)
                $this->_view->nameProduct 	        = $this->_model->listItems($this->_arrayParam, array('task' => 'get-name'));

            $this->_view->arrayParam = $this->_arrayParam;
            $this->_view->render('dashboard/index');
        }
    }
