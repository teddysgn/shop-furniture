<?php
class Bootstrap{
    private $_params;
    private $_controllerObject;

    public function init(){
        $this->setParams();
        
        $controllerName = $this->convertNameURLToClassName($this->_params['controller']) . 'Controller';
        
        $filePath       = MODULE_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';
        if(file_exists($filePath)){
            $this->loadExistController($filePath, $controllerName);
            $this->callMethod();
        } else {
            URL::redirect('default', 'index', 'notice', array('type' => 'not-url'));
        }
    }

    public function setParams(){
        $this->_params                  = array_merge($_GET, $_POST);
        $this->_params['module']        = isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
        $this->_params['controller']    = isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
        $this->_params['action']        = isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
    }

    // CALL METHOD
    private function callMethod(){
        $actionName         = $this->_params['action'] . 'Action';
        if(method_exists($this->_controllerObject, $actionName) == true){
            $module         = $this->_params['module'];
            $controller     = $this->_params['controller'];
            $action         = $this->_params['action'];
            $requestURL     = "$module-$controller-$action";


            // Session 'user' đã được tạo ở admin/IndexController
            $userInfo       = Session::get('user');

            $logged         = ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time());


            // MODULE ADMIN
            if($module == 'admin') {
                if($logged == true) { // đăng nhập thành công
                    if($userInfo['group_acp'] == 1) {
                        if(in_array($requestURL, $userInfo['info']['privilege']) == true ) {
                            // Nếu đã đăng nhập thành công rồi nhưng vẫn cô tình truy cập vào page login
                            $this->_controllerObject->$actionName(); // Cho phếp truy cập vào URL đó
                        } else {
                            URL::redirect('default', 'index', 'notice', array('type' => 'not-permission'));
                        }
                    } else {
                        URL::redirect('default', 'index', 'notice', array('type' => 'not-permission'));
                    }
                } else { // Chưa đăng nhập thành công
                    $this->callLoginAction($module);
                }
                // MODULE DEFAULT
            } else if($module == 'default') { // Khi chưa đăng nhập thì không được truy cập vào các chưa năng của User
                if($userInfo['group_acp'] == 2) {
                    URL::redirect('designer', 'index', 'index', null, 'builder');
                }
                if($controller == 'user') {
                    if($logged == true) {
                        $this->_controllerObject->$actionName();
                    } else {
                        $this->callLoginAction($module);
                    }
                } else {
                    $this->_controllerObject->$actionName();
                }
            }else if($module = 'designer'){
                if($logged == true) { // đăng nhập thành công
                    if($userInfo['group_acp'] == 2) {
                        if(in_array($requestURL, $userInfo['info']['privilege']) == true ) {
                            // Nếu đã đăng nhập thành công rồi nhưng vẫn cô tình truy cập vào page login
                            $this->_controllerObject->$actionName(); // Cho phếp truy cập vào URL đó
                        } else {
                            URL::redirect('default', 'index', 'notice', array('type' => 'not-permission'));
                        }
                    } else {
                        URL::redirect('default', 'index', 'notice', array('type' => 'not-permission'));
                    }
                } else { // Chưa đăng nhập thành công
                    $this->callLoginAction($module);
                }
            }
        }else{
            URL::redirect('default', 'index', 'notice', array('type' => 'not-url'));
        }
    }

    // CALL ACTION LOGIN
    private function callLoginAction($module = 'default'){
        Session::delete('user');
        // Chuyển hướng về trang login
        require_once (MODULE_PATH . $module . DS . 'controllers' . DS . 'IndexController.php');
        $indexController = new IndexController($this->_params);
        $indexController->loginAction();
    }

    // LOAD EXIST CONTROLLER
    private function loadExistController($filePath, $controllerName){
        require_once $filePath;
        $this->_controllerObject   = new $controllerName($this->_params);
    }

    public function _error(){
        require_once MODULE_PATH. 'default' . DS . 'controllers' . DS . 'ErrorController.php';
        $this->_controllerObject = new ErrorController();
        $this->_controllerObject->setView('default');
        $this->_controllerObject->indexAction();
    }

    private function convertNameURLToClassName($nameURL){
       return str_replace("-", "", ucwords(strtolower($nameURL), "-"));
    }
}
