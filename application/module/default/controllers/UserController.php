<?php
class UserController extends Controller
{

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_templateOBJ->setFolderTemplate('default/main/');
        $this->_templateOBJ->setFileTemplate('index.php');
        $this->_templateOBJ->setFileConfig('template.ini');
        $this->_templateOBJ->load();
    }

    public function indexAction()
    {
        $this->_view->_title = 'My Account';
        $this->_view->render('user/index');
    }

    public function cartAction()
    {
        $this->_view->_title    = 'Cart';
        $this->_view->member    = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-member'));
        $this->_view->Items     = $this->_model->listItems($this->_arrParam, array('task' => 'products-in-cart'));
        $this->_view->Coupon    = $this->_model->listItems($this->_arrParam, array('task' => 'check-coupon'));

        $this->_view->render('user/cart');
    }

    public function orderAction()
    {
        $cart = Session::get('cart');
        $productID = $this->_arrayParam['product_id'];
        $price = $this->_arrayParam['price'];

        $productName     = $this->_model->infoItem($productID, array('task' => 'get-name-product'));
        $sku 		     = $this->_model->infoItem($productID, array('task' => 'get-sku'));
        $quantity = 0;
        $cost = 0;
        foreach($sku as $keyS => $valueS){ // 20 - 30 - 10
            $value = $cart['quantity'][$productID] + 1;
            $quantity += $valueS['quantity']; // sold = 25
            $item = $quantity - $valueS['sold']; //  30 - 25 = 5
            if($item > 0){
                if($item - $value < 0){ // 5 - 6 = -1
                    $quantityS = 0;
                    $costS = 0;
                    foreach($sku as $keySS => $valueSS){
                        $quantityS += $valueSS['quantity']; // 30 - 25 - 6 = -1 // 50 - 25 - 6 = 19
                        if($quantityS - ($valueSS['sold'] + $value) > 0){
                            $costS = $valueSS['cost'] * ($valueSS['quantity'] - ($quantityS - ($valueSS['sold'] + $value)));
                            $cost = $valueS['cost'] * $item;
                        }else {
                            $cost = $valueS['cost'] * $value;
                        }
                        if($costS > 0)
                            break;
                    }
                }else {
                    $cost = $valueS['cost'] * $value;
                    $costS = 0;
                }
                if($cost > 0)
                    break;
            }
        }


        $name = URL::filterURL($productName['name']);

        if (empty($cart)) {
            $cart['quantity'][$productID] = 1;
            $cart['price'][$productID] = $price;
            $cart['cost'][$productID] = $cost + $costS;
        } else {
            if (key_exists($productID, $cart['quantity'])) {
                $cart['quantity'][$productID] += 1;
                $cart['price'][$productID] = $price * $cart['quantity'][$productID];
                $cart['cost'][$productID] = $cost + $costS;
            } else {
                $cart['quantity'][$productID] = 1;
                $cart['price'][$productID] = $price;
                $cart['cost'][$productID] = $cost + $costS;
            }
        }
        Session::set('cart', $cart);

        URL::redirect('default', 'product', 'detail', array('product_id' => $productID), $name.'-'.$productID);
    }

    public function buyAction()
    {
        $this->_view->_title = 'Detail Order';
        $this->_model->saveItem($this->_arrayParam, array('task' => 'submit-cart'));
        $this->_model->addNotice($this->_arrayParam, array('task' => 'order'));
        $this->_view->infoAccount = $this->_model->infoItem($this->_arrayParam);
        Session::set('method', 'Cash on Dilivery');
        URL::redirect('default', 'user', 'sendmail', null, 'sendmail');

    }

    public function bankingAction()
    {
        $arraySession	= array(
            'fullname'		=> $_POST['form']['fullname'],
            'phone'		    => $_POST['form']['phone'],
            'address'		=> $_POST['form']['address']
        );
        Session::set('info', $arraySession);
        header('location: vnpay_php/index.php');

    }

    public function momoAction()
    {
        Session::set('form', $this->_arrayParam['form']);
        Session::set('method', 'Momo Banking');

        header('Content-type: text/html; charset=utf-8');
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }

        $total = $_SESSION['totalValueOrder'];
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "$total";
        $orderId = time() ."";
        $returnUrl = "http://hoangvupcx.com/shop/index.php?module=default&controller=user&action=sendMomo";
        $notifyurl = "http://hoangvupcx.com/shop/index.php?module=default&controller=user&action=sendMomo";
        $bankCode = "SML";

        $requestId = time()."";
        $requestType = "payWithMoMoATM";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHashArr =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'bankCode' => $bankCode,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType
        );
        // echo $serectkey;die;
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderId."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result,true);  // decode json

        error_log( print_r( $jsonResult, true ) );
        header('Location: '.$jsonResult['payUrl']);
    }

    public function sendMomoAction()
    {
        $this->_view->_title = 'Detail Order';
        $this->_model->saveItem($_SESSION, array('task' => 'submit-cart-momo'));
        URL::redirect('default', 'user', 'sendmail', null, 'sendmail');
    }

    public function sendmailAction(){
        $this->_view->_title = 'Detail Order';
        $this->_view->Items = $this->_model->listItems($this->_arrParam, array('task' => 'products-in-cart'));
        $this->_view->infoAccount = $this->_model->infoItem($this->_arrayParam);
        $this->_view->render('user/sendmail');
    }

    public function deleteAllAction()
    {
        Session::delete('cart');
        URL::redirect('default', 'user', 'cart', null, 'cart');
    }

    public function deleteAction()
    {
        $idDelete = $_GET['id'];
        if (isset($_GET['id']) && ($_GET['id'] >= 0)) {
            unset($_SESSION['cart']['quantity'][$idDelete]);
            unset($_SESSION['cart']['price'][$idDelete]);
            unset($_SESSION['cart']['cost'][$idDelete]);
        }
        URL::redirect('default', 'user', 'cart', null, 'cart');
    }

    public function updateAction()
    {
        if(isset($_POST['quantity'])) {
            foreach ($_POST['quantity'] as $key => $value){
                $result         = $this->_model->infoPrice($key);
                $sku 		    = $this->_model->infoItem($key, array('task' => 'get-sku'));
                $quantity = 0;
                $cost = 0;
                foreach($sku as $keyS => $valueS){
                    $quantity += $valueS['quantity']; // 20
                    $item = $quantity - $valueS['sold']; // 20 - 1 = 19 // 30 - 25 = 5
                    if($item > 0){
                        if($item - $value < 0){ // 19 - 5 = 14 // 5 - 6 = -1
                            $quantityS = 0;
                            $costS = 0;
                            foreach($sku as $keySS => $valueSS){
                                $quantityS += $valueSS['quantity']; // 30 - 25 - 6 = -1 // 50 - 25 - 6 = 19
                                if($quantityS - ($valueSS['sold'] + $value) > 0){
                                    $costS = $valueSS['cost'] * ($valueSS['quantity'] - ($quantityS - ($valueSS['sold'] + $value)));
                                    $cost = $valueS['cost'] * $item;
                                }else {
                                    $cost = $valueS['cost'] * $value;
                                }
                                if($costS > 0)
                                    break;
                            }
                        }else {
                            $cost = $valueS['cost'] * $value;
                            $costS = 0;
                        }
                        if($cost > 0)
                            break;
                    }
                }
                $saleOff    = $result['sale_off'];
                $price      = $result['price'];

                if($saleOff > 0){
                    $price = (100-$saleOff) * $price/100;
                }else{
                    $price	= $price;
                }

                $_SESSION['cart']['quantity'][$key] = $value;
                $_SESSION['cart']['price'][$key] = $price * $_SESSION['cart']['quantity'][$key];
                $_SESSION['cart']['cost'][$key] = $cost + $costS;

            }
        }


        URL::redirect('default', 'user', 'cart', null , 'cart');
    }

    public function historyAction()
    {
        $this->_view->_title = 'History';
        $this->_view->totalItems                 = $this->_model->countItems($this->_arrayParam, null);
        $configPagination           = array(
            'totalItemsPerPage' => 5,
            'pageRange'         => 5
        );
        if($this->_arrayParam['id'] != null){
            $this->_model->cancel($this->_arrayParam['id'], array('task' => 'cancel-order'));
        }
        
        $this->setPagination($configPagination);
        $this->_view->pagination    = new Pagination($this->_view->totalItems, $this->_pagination);
        $this->_view->Items = $this->_model->listItems($this->_arrayParam, array('task' => 'history-cart'));
        
        $this->_view->render('user/history');
    }

    public function trackingAction()
    {
        $this->_view->_title = 'Tracking';
        if(isset($this->_arrayParam['form']['id']))
        {
             if($this->_arrayParam['id'] != null){
                $this->_model->cancel($this->_arrayParam['id'], array('task' => 'cancel-order'));
            }
            $this->_view->Items = $this->_model->listItems($this->_arrayParam['form']['id'], array('task' => 'tracking-order'));
        }

        $this->_view->render('user/tracking');
    }

    public function favoriteAction()
    {
        $this->_view->_title = 'Favorites';
        $totalItems                 = $this->_model->countItems($this->_arrayParam, array('task' => 'count-favorite'));
        $this->_view->allItems      = $this->_model->countItems($this->_arrayParam, array('task' => 'count-favorite'));

        $configPagination           = array(
            'totalItemsPerPage' => 15,
            'pageRange'         => 5
        );
        $this->setPagination($configPagination);
        $this->_view->pagination    = new Pagination($totalItems, $this->_pagination);

        if(isset($_SESSION['user']['info']['id']))
            $this->_view->infoFavorite  = $this->_model->favorite($this->_arrayParam, array('task' => 'info-favorite'));
        $this->_view->Favorite = $this->_model->listItems($this->_arrayParam, array('task' => 'list-favorite'));




        $this->_view->render('user/favorite');
    }

    public function likeAction(){
        if(isset($_SESSION['user']['info']['id']))
            $this->_model->favorite($this->_arrayParam, array('task' => 'add-favorite'));
        else
            $this->_view->render('index/user');
        $this->_view->render('user/favorite');
    }

    public function profileAction()
    {
        // Nếu biến POST có phần tử id (Edit)
        if (isset($this->_arrayParam['id'])) {
            $this->_arrayParam['form'] = $this->_model->infoItem($this->_arrayParam);
            if (empty($this->_arrayParam['form'])) {
                URL::redirect('default', 'user', 'index', null , 'index');
            }
        }

        $this->_view->_title = 'Profile';

        $this->_view->request = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-request'));


        $this->_arrayParam['notice'] = $this->_model->infoNotice();
        $this->_arrayParam['noticeRecently'] = $this->_model->infoNotice(array('task' => 'recently'));



        $this->_view->total = $this->_model->infoItem($this->_arrayParam, array('task' => 'total-cart'));
        $this->_view->member = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-member'));


        // Khi form submit
        if ($this->_arrayParam['form']['token'] > 0) {
            $requiredPass   = true;
//            $queryUserName  = "SELECT `id` FROM `" . TBL_USER . "` WHERE `username` = '" . $this->_arrayParam['form']['username'] . "'";
            $queryEmail     = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrayParam['form']['email'] . "'";
            $password       = $this->_model->infoPassword($this->_arrayParam);

            // Trường hợp nếu tồn tại ['form']['id'] trong arrayParam, kiểm tra `id` <> 'id' người dùng nhập thì không phải ValidateExistRecord
            // Do chỉ có $task = edit thì mới có phần tử ['form']['id']
            // Nếu muốn vào được trang edit thì URL phải có phần tử id ($this->_arrayParam['id']) => sẽ có $this->_arrayParam['form']['id']
            if (isset($this->_arrayParam['form']['id']) || isset($this->_arrayParam['id'])) {
                $task = 'edit';
                $requiredPass    = false;
//                $queryUserName  .= " AND `id` <> '" . $this->_arrayParam['form']['id'] . "'";
                $queryEmail     .= " AND `id` <> '" . $this->_arrayParam['form']['id'] . "'";
            }

            $validate = new Validate($this->_arrayParam['form']);
            $validate
//                ->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 255))
                ->addRule('fullname', 'string', array('min' => 1, 'max' => 100))
                ->addRule('old_password', 'password')
                ->addRule('new_password', 'password', array('action' => $task), $requiredPass)
                ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmail));

            $validate->run();
            $this->_arrayParam['form'] = $validate->getResult();

            if($this->_arrayParam['form']['new_password'] != $this->_arrayParam['form']['confirm_password'])
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
                if ($this->_arrayParam['type'] == 'save') URL::redirect('default', 'user', 'profile', array('id' => $id), 'profile-'.$id);
            }
        }
        $this->_view->arrayParam = $this->_arrayParam;
        $this->_view->render('user/profile');
    }

    public function designerAction(){
        $this->_view->_title        = 'Become Our Designer';
        $this->_view->request       = $this->_model->infoItem($this->_arrayParam, array('task' => 'info-request'));
        $this->_view->designer      = $this->_model->infoItem($this->_arrayParam);
        if ($this->_arrayParam['form']['token'] > 0) {
            if(!empty($_FILES)) {
                $this->_arrayParam['form']['picture']  = $_FILES['picture'];
            }
            $validate = new Validate($this->_arrayParam['form']);
            $validate->addRule('name', 'string', array('min' => 1, 'max' => 100))
                ->addRule('profession', 'status',array('deny' => array('default')))
                ->addRule('design_about', 'status',array('deny' => array('default')))
                ->addRule('website', 'url')
                ->addRule('message', 'null', array('min' => 0, 'max' => 500), false)
                ->addRule('picture', 'file', array('min' => 100, 'max' => 10000000, 'extension' => array('jpg', 'png', 'jpeg')), false);

            $validate->run();
            $this->_arrayParam['form'] = $validate->getResult();


            // Validate has error
            if ($validate->isValid() == false) {
                $this->_view->error = $validate->showErrors();
            }
            else {
                // Insert Database
                $this->_model->saveItem($this->_arrayParam, array('task' => 'become-designer'));
            }
        }
        $this->_view->arrayParams =  $this->_arrayParam['form'];
        $this->_view->render('user/designer');
    }
}
