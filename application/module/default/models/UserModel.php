<?php
class UserModel extends Model {
    private $_userInfo;
    private $_columns = array('id', 'username', 'email', 'fullname', 'password', 'created' ,'created_by', 'modified', 'modified_by', 'status', 'group_id', 'ordering', 'coupon_id', 'payment', 'invoice', 'address', 'customer', 'phone', 'memberDiscount');

    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_USER);

        $userObj            = Session::get('user');
        $this->_userInfo    = $userObj['info'];
    }

    public function countItems($arrParams, $option = null){
        if($option['task'] == null) {
            $username = $this->_userInfo['username'];

            $query[] = "SELECT COUNT(`id`) AS `total`";
            $query[] = "FROM `" . TBL_ORDER . "`";
            $query[] = "WHERE `username` = '$username' ";
            $query[] = "ORDER BY `date` DESC";

            $query = implode(" ", $query);
            $result = $this->fetchRow($query);
        }

        if($option['task'] == 'count-favorite') {
            $user_id = $this->_userInfo['id'];

            $query[] = "SELECT COUNT(`id`) AS `total`";
            $query[] = "FROM `" . TBL_FAVORITE . "`";
            $query[] = "WHERE `user_id` = $user_id ";

            $query = implode(" ", $query);
            $result = $this->fetchRow($query);
        }

        return $result['total'];
    }

    public function listItems($arrParams, $option = null)
    {
        if($option['task'] == 'products-in-cart'){
            $cart	= Session::get('cart');
            $result	= array();
            if(!empty($cart)){
                $ids	= "(";
                foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
                $ids	.= " '0')" ;

                $query[]	= "SELECT `id`, `name`, `picture1`, `stock` ";
                $query[]	= "FROM `".TBL_PRODUCT."`";
                $query[]	= "WHERE `status`  = 1 AND `id` IN $ids";
                $query[]	= "ORDER BY `ordering` ASC";

                $query		= implode(" ", $query);
                $result		= $this->fetchAll($query);

                foreach($result as $key => $value){
                    $result[$key]['quantity']	= $cart['quantity'][$value['id']];
                    $result[$key]['totalprice']	= $cart['price'][$value['id']];
                    $result[$key]['price']		= $result[$key]['totalprice'] / $result[$key]['quantity'];
                }
            }
        }

        if($option['task'] == 'history-cart'){
            $username	= $this->_userInfo['username'];

            $query[]	= "SELECT `c`.`id`, `c`.`username`, `c`.`payment`, `c`.`memberDiscount`, `c`.`products`, `c`.`completed`, `c`.`cancel`, `c`.`prices`, `c`.`quantities`, `c`.`names`, `c`.`pictures`, `c`.`status`, `c`.`date`, `c`.`coupon_id`, `v`.`id` AS `coupon_id`, `v`.`value`, `v`.`name` ";
            $query[]	= "FROM `".TBL_ORDER."` AS `c` LEFT JOIN `".TBL_COUPON."` AS `v` ON `v`.id = `c`.`coupon_id`";
            $query[]	= "WHERE `c`.`username` = '$username' ";
            $query[]	= "ORDER BY `date` DESC";

            // PAGINATION
            $pagination = $arrParams['pagination'];
            $totalItemsPerPage = $pagination['totalItemsPerPage'];
            if($totalItemsPerPage > 0){
                $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                $query[]    = "LIMIT $position, $totalItemsPerPage";
            }

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);
        }

        if($option['task'] == 'check-coupon'){
            $code = $_POST['form']['code'];
            $query[] = "SELECT `id`, `name`, `code`, `value`, `status` ";
            $query[] = "FROM `".TBL_COUPON."`";
            $query[] = "WHERE `code` = '" . $code . "' AND `status` = 1 and `quantity` > 0";

            $query   = implode(" ", $query);

            $result  = $this->fetchRow($query);
        }

        if($option['task'] == 'tracking-order'){
            $username	= $this->_userInfo['username'];

            $query[]	= "SELECT `c`.`id`, `c`.`username`, `c`.`payment`, `c`.`memberDiscount`,  `c`.`products`, `c`.`completed`, `c`.`cancel`, `c`.`prices`, `c`.`quantities`, `c`.`names`, `c`.`pictures`, `c`.`status`, `c`.`date`, `c`.`coupon_id`, `v`.`id` AS `coupon_id`, `v`.`value`, `v`.`name` ";
            $query[]	= "FROM `".TBL_ORDER."` AS `c` LEFT JOIN `".TBL_COUPON."` AS `v` ON `v`.id = `c`.`coupon_id`";
            $query[]	= "WHERE `c`.`username` = '$username' AND `c`.`id` = '$arrParams'";
            $query[]	= "ORDER BY `date` DESC";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
        }

        if($option['task'] == 'list-favorite'){
            $user_id	= $this->_userInfo['id'];

            $query[]	= "SELECT `f`.`product_id`, `p`.`name` AS `product_name`, `p`.`id`, `p`.`price`, `p`.`stock`, `p`.`sold`, `p`.`sale_off`, `p`.`picture1`, `c`.`name` AS `category_name` ";
            $query[]	= "FROM `".TBL_FAVORITE."` AS `f`,`".TBL_PRODUCT."` AS `p`, `".TBL_USER."` AS `u`, `".TBL_CATEGORY."` AS `c` ";
            $query[]	= "WHERE `f`.`user_id` = '$user_id' AND `f`.`product_id` = `p`.`id` AND `c`.`id` = `p`.`category_id`";
            $query[]	= "GROUP BY `p`.`name`";
            $query[]	= "ORDER BY `f`.`id` DESC";

            // PAGINATION
            $pagination = $arrParams['pagination'];
            $totalItemsPerPage = $pagination['totalItemsPerPage'];
            if($totalItemsPerPage > 0){
                $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                $query[]    = "LIMIT $position, $totalItemsPerPage";
            }

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);
        }
        return $result;
    }

    public function saveItem($arrParam, $option = null){
        if($option['task'] == 'submit-cart'){
            $id			    = $this->randomString(7);
            Session::set('idCart', $id);
            $username	    = $this->_userInfo['username'];
            $user_id	    = $this->_userInfo['id'];
            $products		= json_encode($arrParam['form']['product_id']);
            $prices		    = json_encode(($arrParam['form']['price']));
            $quantities	    = json_encode($arrParam['form']['quantity']);
            $names		    = json_encode($arrParam['form']['name']);
            $pictures	    = json_encode($arrParam['form']['picture1']);
            $date		    = date('Y-m-d H:i:s', time());
            $invoice        = $_SESSION['ID'];
            $customer       = $arrParam['form']['fullname'];
            $address        = $arrParam['form']['address'];
            $phone          = $arrParam['form']['phone'];
            $totalPrice     = array_sum($_SESSION['cart']['price']) + $_SESSION['totalPrice'] + $_SESSION['memberDiscount'];
            $profit         = array_sum($_SESSION['cart']['price']) - array_sum($_SESSION['cart']['cost']) + $_SESSION['memberDiscount'] + $_SESSION['totalPrice'] ;
            $totalQuantity  = array_sum($_SESSION['cart']['quantity']);
            $memberDiscount = $_SESSION['memberDiscount'];
            $payment        = 'Cash on Dilivery';

            $cart	= Session::get('cart');

            // Lấy id của Voucher
            $code = $_POST['form']['code'];
            $valueCode = 0;

            if(isset($code)) {
                $queryVoucher[] = "SELECT `id`, `name`, `code`, `value`, `status`, `quantity`, `used` ";
                $queryVoucher[] = "FROM `".TBL_COUPON."`";
                $queryVoucher[] = "WHERE `code` = '" . $code . "' AND `status` = 1 AND `quantity` > 0";
                $queryVoucher   = implode(" ", $queryVoucher);
                $resultVoucher  = $this->fetchRow($queryVoucher);

                $valueCode = $resultVoucher['id'];
            }

            if(!empty($cart)){
                $ids	= "(";
                foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
                $ids	.= " '0')" ;

                $query[]	= "SELECT `id`, `name`, `picture1`, `stock`, `sold` ";
                $query[]	= "FROM `".TBL_PRODUCT."`";
                $query[]	= "WHERE `status`  = 1 AND `id` IN $ids";
                $query[]	= "ORDER BY `ordering` ASC";

                $query		= implode(" ", $query);
                $result		= $this->fetchAll($query);

                foreach($result as $key => $value){
                    $stock      = $result[$key]['stock'] - $cart['quantity'][$value['id']];
                    $idStock    = $result[$key]['id'];
                    $sold       = $result[$key]['sold'] + $cart['quantity'][$value['id']];
                    $update     = "UPDATE `".TBL_PRODUCT."` SET `stock` = $stock, `sold` = $sold WHERE `id` = $idStock";
                    $this->query($update);
                }

                // Create Order
                $query	= "INSERT INTO `".TBL_ORDER."`(`id`, `user_id`, `username`, `products`, `prices`, `totalPrice`, `profit`, `totalQuantity`, `quantities`, `names`, `pictures`, `status`, `completed`, `date`, `coupon_id`, `payment`, `invoice`, `customer`, `address`, `phone`, `memberDiscount`)
					VALUES ('$id', '$user_id', '$username', '$products', '$prices', '$totalPrice', '$profit', '$totalQuantity', '$quantities', '$names', '$pictures', '0', '0', '$date', '$valueCode', '$payment', '$invoice', '$customer', '$address', '$phone', $memberDiscount)";
                $this->query($query);


                // Update Coupon
                $quantityCoupon = $resultVoucher['quantity'];
                $usedCoupon     = $resultVoucher['used'];
                $queryUpdate = "UPDATE `coupon` SET `quantity` = $quantityCoupon - 1, `used` = $usedCoupon + 1 WHERE `code` = '$code'";
                $this->query($queryUpdate);

                // Update Member
                $member = "SELECT `member_id` FROM `user` WHERE `id` = ".$user_id;
                $resultMemberID  = $this->fetchRow($member);

                $totalValueOrder = $this->infoItem($this->_userInfo, array('task' => 'total-cart'));
                $queryMember  = "SELECT `id`, `discount`, `value` ";
                $queryMember .= "FROM `member` WHERE `id` = ".$user_id."";
                $resultMember  = $this->fetchRow($queryMember);

                $queryMax  = "SELECT MAX(`id`) AS `max` ";
                $queryMax .= "FROM `member`";
                $resultMax  = $this->fetchRow($queryMax);
                if($totalValueOrder['total'] > $resultMember['value'] && $totalValueOrder['total'] < $resultMax['max']){
                    $updateMember = "UPDATE `user` SET `member_id` = " . $resultMemberID['member_id'] + 1 . " WHERE `id` = ".$user_id."";
                    $this->query($updateMember);
                }
            }
        }

        if($option['task'] == 'edit'){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];
            // Không cho người dùng thay đổi giá trị username
            unset($arrParam['form']['username']);
            $arrParam['form']['modified'] = date('Y-m-d', time());
            $arrParam['form']['modified_by'] = $userInfo['username'];

            // Khi pass != null: Người dùng muốn thay đổi password
            if($arrParam['form']['new_password'] != null) {
                $arrParam['form']['password'] = md5($arrParam['form']['new_password']);
            } else {
                // Xóa password khỏi mảng $arrParam
                unset($arrParam['form']['new_password']);
            }

            // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
            // array_flip(): Đâỏ ngược key vào value trong array
            $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));

            $this->update($data, array(array('id', $arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Updated Successfully!'));

            return $arrParam['form']['id'];
        }

        if($option['task'] == 'submit-cart-momo'){
            $id			    = $this->randomString(7);
            Session::set('idCart', $id);
            $username	    = $this->_userInfo['username'];
            $user_id	    = $this->_userInfo['id'];
            $products		= json_encode($arrParam['form']['product_id']);
            $prices		    = json_encode(($arrParam['form']['price']));
            $quantities	    = json_encode($arrParam['form']['quantity']);
            $names		    = json_encode($arrParam['form']['name']);
            $pictures	    = json_encode($arrParam['form']['picture1']);
            $date		    = date('Y-m-d H:i:s', time());
            $invoice        = $_GET['orderId'];
            $customer       = $arrParam['form']['fullname'];
            $address        = $arrParam['form']['address'];
            $phone          = $arrParam['form']['phone'];
            $totalPrice     = array_sum($_SESSION['cart']['price']) + $_SESSION['totalPrice'] + $_SESSION['memberDiscount'];
            $profit         = array_sum($_SESSION['cart']['price']) - array_sum($_SESSION['cart']['cost']) + $_SESSION['memberDiscount'] + $_SESSION['totalPrice'] ;
            $totalQuantity  = array_sum($_SESSION['cart']['quantity']);
            $memberDiscount = $_SESSION['memberDiscount'];
            $payment        = 'Momo Banking';

            $cart	= Session::get('cart');

            // Lấy id của Voucher
            $code = Session::get('couponCode');
            $valueCode = 0;

            if(isset($code)) {
                $queryVoucher[] = "SELECT `id`, `name`, `code`, `value`, `status`, `quantity`, `used` ";
                $queryVoucher[] = "FROM `".TBL_COUPON."`";
                $queryVoucher[] = "WHERE `code` = '" . $code . "' AND `status` = 1 AND `quantity` > 0";
                $queryVoucher   = implode(" ", $queryVoucher);
                $resultVoucher  = $this->fetchRow($queryVoucher);

                $valueCode = $resultVoucher['id'];
            }

            if(!empty($cart)){
                $ids	= "(";
                foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
                $ids	.= " '0')" ;

                $query[]	= "SELECT `id`, `name`, `picture1`, `stock`, `sold` ";
                $query[]	= "FROM `".TBL_PRODUCT."`";
                $query[]	= "WHERE `status`  = 1 AND `id` IN $ids";
                $query[]	= "ORDER BY `ordering` ASC";

                $query		= implode(" ", $query);
                $result		= $this->fetchAll($query);

                foreach($result as $key => $value){
                    $stock      = $result[$key]['stock'] - $cart['quantity'][$value['id']];
                    $idStock    = $result[$key]['id'];
                    $sold       = $result[$key]['sold'] + $cart['quantity'][$value['id']];
                    $update     = "UPDATE `".TBL_PRODUCT."` SET `stock` = $stock, `sold` = $sold WHERE `id` = $idStock";
                    $this->query($update);
                }
                // Create Order
                $query	= "INSERT INTO `".TBL_ORDER."`(`id`, `user_id`, `username`, `products`, `prices`, `totalPrice`, `profit`, `memberDiscount`, `totalQuantity`, `quantities`, `names`, `pictures`, `status`, `completed`, `date`, `coupon_id`, `payment`, `invoice`, `customer`, `address`, `phone`)
					VALUES ('$id', '$user_id', '$username', '$products', '$prices', '$totalPrice', '$profit', '$memberDiscount', '$totalQuantity', '$quantities', '$names', '$pictures', '0', '0', '$date', '$valueCode', '$payment', '$invoice', '$customer', '$address', '$phone')";
                $this->query($query);

                // Update Coupon
                $quantityCoupon = $resultVoucher['quantity'];
                $usedCoupon     = $resultVoucher['used'];
                $queryUpdate = "UPDATE `coupon` SET `quantity` = $quantityCoupon - 1, `used` = $usedCoupon + 1 WHERE `code` = '$code'";
                $this->query($queryUpdate);

                // Update Member
                $member = "SELECT `member_id` FROM `user` WHERE `id` = ".$user_id;
                $resultMemberID  = $this->fetchRow($member);

                $totalValueOrder = $this->infoItem($this->_userInfo, array('task' => 'total-cart'));
                $queryMember  = "SELECT `id`, `discount`, `value` ";
                $queryMember .= "FROM `member` WHERE `id` = ".$user_id."";
                $resultMember  = $this->fetchRow($queryMember);

                $queryMax  = "SELECT MAX(`id`) AS `max` ";
                $queryMax .= "FROM `member`";
                $resultMax  = $this->fetchRow($queryMax);
                if($totalValueOrder['total'] > $resultMember['value'] && $totalValueOrder['total'] < $resultMax['max']){
                    $updateMember = "UPDATE `user` SET `member_id` = " . $resultMemberID['member_id'] + 1 . " WHERE `id` = ".$user_id."";
                    $this->query($updateMember);
                }
            }
        }

        if($option['task'] == 'become-designer'){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();
            $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

            $uploadDir		= UPLOAD_PATH . 'cache' . DS . 'designer' . DS . $arrParam['form']['name'];
            if(!file_exists($uploadDir)){
                mkdir($uploadDir);
            }
            $arrParam['form']['picture']	= $uploadObj->uploadFile($arrParam['form']['picture'], 'cache/designer/' . $arrParam['form']['name']);

            $_columns = array('id', 'name', 'picture', 'website', 'design_about', 'profession', 'message' ,'date', 'user_id');
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];

            $arrParam['form']['date'] = date('Y-m-d H:i:s', time());
            $arrParam['form']['user_id'] = $userInfo['id'];
            $arrParam['form']['status'] = 1;


            // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
            // array_flip(): Đâỏ ngược key vào value trong array
            $data = array_intersect_key($arrParam['form'],array_flip($_columns));


            $this->setTable(TBL_BECOME);
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Request was Submitted!'));

            URL::redirect('default', 'user', 'designer');
        }
    }

    public function infoItem($arrParam, $option = null){
        $userObj     = Session::get('user');
        if($option['task'] == null){
            $userInfo    = $userObj['info'];
            $query[] = "SELECT `id`, `username`, `email`, `fullname`, `address`,  `phone`, `member_id`, `designer_id`, `group_id` ";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `username` = '" . $userInfo['username'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }

        if($option['task'] == 'get-name-product'){
            $query[] = "SELECT `id`, `name` ";
            $query[] = "FROM `".TBL_PRODUCT."`";
            $query[] = "WHERE `id` = '" . $arrParam . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }

        if($option['task'] == 'total-cart'){
            $query[] = "SELECT SUM(`totalPrice`) as `total` ";
            $query[] = "FROM `".TBL_ORDER."`";
            $query[] = "WHERE `user_id` = '" . $arrParam['id'] . "' AND `cancel` = 0";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }

        if($option['task'] == 'info-member'){
            $query[] = "SELECT `name`, `discount` ";
            $query[] = "FROM `".TBL_MEMBER."`";
            $query[] = "WHERE `id` = '" . $userObj['info']['member_id'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }

        if($option['task'] == 'info-request'){
            $query[] = "SELECT `name` ";
            $query[] = "FROM `".TBL_BECOME."`";
            $query[] = "WHERE `user_id` = " . $userObj['info']['id'] . "";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }

        if($option['task'] == 'get-sku'){
            $query[]    = "SELECT `s`.`quantity`, `s`.`cost`, `s`.`date`, `p`.`sold`, `p`.`stock`";
            $query[]    = "FROM `sku` AS `s`, `product` AS `p` ";
            $query[]    = "WHERE `s`.`product_id` = `p`.`id` AND `s`.`product_id` = '" . $arrParam . "'";
            $query[]	= "ORDER BY `s`.`date`";

            $query   = implode(" ", $query);
            $result  = $this->fetchAll($query);

            return $result;
        }
    }
    
    public function cancel($arrParam, $option = null){
        $userObj     = Session::get('user');
        if($option['task'] == 'cancel-order'){
            $userInfo    = $userObj['info'];
            $modified = date('Y-m-d', time());
            $modified_by = $userInfo['username'];
            
            // CANCEL ORDER
            $queryOrder[] = "UPDATE `".TBL_ORDER."` ";
            $queryOrder[] = "SET `cancel` = 1, `modified` = '$modified', `modified_by` = '$modified_by'";
            $queryOrder[] = "WHERE `id` = '" . $arrParam . "' AND `user_id` = '".$userInfo['id']."' AND `cancel` <> 2";

            $queryOrder   = implode(" ", $queryOrder);
            $resultOrder  = $this->query($queryOrder);
          
            if($this->affectedRows() > 0){
                // GET ORDER TO UPDATE STOCK
                $queryStock[] = "SELECT `products`, `quantities`, `totalPrice` ";
                $queryStock[] = "FROM `".TBL_ORDER."` ";
                $queryStock[] = "WHERE `id` = '" . $arrParam . "' ";
                
                $queryStock   = implode(" ", $queryStock);
                $resultStock  = $this->fetchRow($queryStock);
                
                $stock = json_decode($result['quantities']);
                $id = json_decode($result['products']);
                
                
                // UPDATE STOCK
                foreach($stock as $keyA => $valueA){
                    foreach($id as $keyB => $valueB){
                        if($keyA == $keyB){
                            $queryUpdate = "UPDATE `".TBL_PRODUCT."` ";
                            $queryUpdate .= "SET `stock` = `stock` + $valueA, `sold` = `sold` - $valueA ";
                            $queryUpdate .= "WHERE `id` = '" . $valueB . "' ";
    
                            $resultUpdate  = $this->query($queryUpdate);
                        }
                    }
                }
            
            Session::set('message', array('class' => 'success', 'content' => 'Cancelled Order `' . $arrParam . '` Successfully!'));
            //$this->addNotice($arrParam, array('task' => 'cancel-order'));

            } else {
                Session::set('message', array('class' => 'error', 'content' => 'Cancelled Order `' . $arrParam . '` Failled!'));
            }
            
            
            
            return $resultOrder;
        }
    }

    private function randomString($length = 5){

        $arrCharacter = array_merge(range('a','z'), range(0,9), range('A','Z'));
        $arrCharacter = implode("", $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result		  = substr($arrCharacter, 0, $length);
        return $result;
    }

    public function infoPrice($arrParam, $option = null){
        if($option == null){
            $query[] = "SELECT `price`, `sale_off` ";
            $query[] = "FROM `product`";
            $query[] = "WHERE `id` = " . $arrParam . "";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
    }

    public function infoPassword($arrParam, $option = null){
        if($option == null){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];
            $query[] = "SELECT `id`, `password` ";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `id` = '" . $userInfo['id'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
    }

    public function addNotice($arrParam, $option = null){
        $userObj     = Session::get('user');
        $userInfo    = $userObj['info'];

        $name = '';
        $user_id = $userInfo['id'];
        switch ($option['task']){
            case 'edit-profile':
                $name   = 'Updated your profile';
                break;
            case 'order':
                $name = 'Have just placed an order `' . Session::get('idCart') . '`';
                break;
            case 'login':
                $name = 'Logged';
                break;
            case 'cancel-order':
                $name = 'You have cancelled an order `' . $arrParam . '`';
                break;
        }

        $time = date('Y-m-d H:i:s', time());

        $query  = "INSERT INTO `".TBL_NOTICE."` (`name`, `time`, `user_id`) VALUES ('$name', '$time', '$user_id')";

        $this->query($query);

    }

    public function infoNotice($option = null){
        if($option['task'] == null){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];

            $user_id = $userInfo['id'];

            $query[] = "SELECT `name`, `time`, `user_id`  ";
            $query[] = "FROM `".TBL_NOTICE."`";
            $query[] = "WHERE `user_id` = " . $user_id . " ";
            $query[] = "ORDER BY `time` DESC";
            $query[] = "LIMIT 0, 10";

            $query   = implode(" ", $query);
            $result  = $this->fetchAll($query);

            return $result;
        }


        if($option['task'] == 'recently'){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];

            $user_id = $userInfo['id'];

            $query[] = "SELECT `name`, `time`, `user_id`  ";
            $query[] = "FROM `".TBL_NOTICE."`";
            $query[] = "WHERE `user_id` = " . $user_id . " AND `name` LIKE '%order%'";
            $query[] = "ORDER BY `time` DESC";
            $query[] = "LIMIT 0, 5";

            $query   = implode(" ", $query);
            $result  = $this->fetchAll($query);

            return $result;
        }
    }

    public function favorite($arrParam, $option = null){

        if($option['task'] == 'add-favorite'){
            $product_id         =  $arrParam['product_id'];
            $user_id            =  $arrParam['user_id'];
            $favorite_id        =  $arrParam['favorite_id'];

            if($arrParam['favorite'] == 1)
                $favorite = "INSERT INTO `".TBL_FAVORITE."` (`product_id`, `user_id`) VALUES(".$product_id.", ".$user_id.")";
            else
                $favorite = "DELETE FROM `".TBL_FAVORITE."` WHERE `id` = $favorite_id";

            $this->query($favorite);
            header('location: favorite');
        }
        if($option['task'] == 'info-favorite'){
            $user_id            =  $_SESSION['user']['info']['id'];

            $info = "SELECT `id`, `product_id` FROM `".TBL_FAVORITE."` WHERE `user_id` = '".$user_id."'";

            $result = $this->fetchAll($info);

            return $result;
        }
    }
}
