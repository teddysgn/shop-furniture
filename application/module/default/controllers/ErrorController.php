<?php
    class ErrorController extends Controller {
        public function __construct(){

        }

        public function indexAction(){
            $this->_view->data = 'This is an error!';
            $this->_view->_title = 'Error';

            $this->_view->render('error/index');
        }
    }
