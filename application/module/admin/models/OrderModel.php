<?php
    class OrderModel extends Model {
        private $_columns = array('id', 'username', 'completed', 'cancel', 'prices', 'date', 'status', 'quantities', 'names', 'coupon_id', 'payment', 'invoice', 'customer', 'address', 'phone');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_ORDER);
            $userObj            = Session::get('user');
            $this->_userInfo    = $userObj['info'];
        }

        public function countItems($arrParams, $option = null)
        {
            $query[]    = "SELECT COUNT(`id`) AS `total`";
            $query[]    = "FROM `$this->table`";
            $query[]	= "WHERE `id` <> ' '";


            // FILTER: KEYWORD
            if(!empty($arrParams['filter_search'])) {
                $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                $query[]	= "AND (`names` LIKE $keyword)";
            }

            // FILTER: STATUS
            if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                $query[]	= "AND `status` = '" . $arrParams['filter_state'] . "'";
            }

            // FILTER: COMPLETED
            if(isset($arrParams['filter_completed']) && $arrParams['filter_completed'] != 'default') {
                $query[]	= "AND `completed` = '" . $arrParams['filter_completed'] . "'";
            }

            // FILTER: METHOD
            if(isset($arrParams['filter_method']) && $arrParams['filter_method'] != 'default') {
                $arrParams['filter_method'] = ($arrParams['filter_method'] == 1) ? 'Cash on Dilivery' : (($arrParams['filter_method'] == 2) ? 'Momo Banking' : 'Mobile Banking');
                $query[]	= "AND `payment` = '" . $arrParams['filter_method'] . "'";
            }

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            if($option['task'] == 'detail-order'){
                $query[]	= "SELECT `c`.`id`, `c`.`products`, `c`.`completed`, `c`.`cancel`, `c`.`prices`, `c`.`quantities`, `c`.`names`, `c`.`user_id` , `c`.`memberDiscount`, `c`.`pictures`, `c`.`status`, `c`.`date`, `c`.`coupon_id`, `c`.`payment`, `c`.`invoice`, `c`.`customer`, `c`.`address`, `c`.`phone`, `v`.`code`, `v`.`value` ";
                $query[]	= "FROM `".TBL_ORDER."` AS `c` LEFT JOIN `".TBL_COUPON."` AS `v` ON `c`.`coupon_id` = `v`.id";
                if(isset($arrParams['id']))
                    $id = $arrParams['id'];
                else
                    $id = $arrParams['form']['id'];
                $query[]	= "WHERE `c`.`id` = '".$id."'";
                $query[]	= "ORDER BY `c`.`date` ASC";

                $query		= implode(" ", $query);

                $result		= $this->fetchAll($query);
            }

            if($option['task'] == 'download'){
                $query	= "SELECT `order`.*, `coupon`.`name` FROM `order` JOIN `coupon` ON `order`.`coupon_id` = `coupon`.`id` ";

                $result		= $this->fetchAll($query);
            }

            if ($option == null) {
                // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số product chưa có category_id)
                $query[]	= "SELECT `c`.`id`, `c`.`username`, `c`.`completed`, `c`.`cancel`, `c`.`names`, `c`.`totalPrice`, `c`.`totalQuantity`, `c`.`user_id`, `c`.`status`, `c`.`date`, `c`.`coupon_id`, `c`.`payment`, `c`.`invoice`, `c`.`products`, `u`.`username` AS `username`, `v`.`id` AS `couponID`, `v`.`code` AS `coupon_name`";
                $query[]	= "FROM `".TBL_COUPON."` AS `v` RIGHT JOIN `$this->table` AS `c` ON `v`.`id` = `c`.`coupon_id` LEFT JOIN `". TBL_USER ."` AS `u` ON `c`.`username` = `u`.`username`";
                $query[]	= "WHERE `c`.`id` <> ''";

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND (`c`.`id` LIKE $keyword)";
                    $query[]	= "OR (`c`.`username` LIKE $keyword)";
                }

                // FILTER: STATUS
                if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                    $query[]	= "AND `c`.`status` = '" . $arrParams['filter_state'] . "'";
                }

                // FILTER: METHOD
                if(isset($arrParams['filter_method']) && $arrParams['filter_method'] != 'default') {
                    $arrParams['filter_method'] = ($arrParams['filter_method'] == 1) ? 'Cash on Dilivery' : (($arrParams['filter_method'] == 2) ? 'Momo Banking' : 'Mobile Banking');
                    $query[]	= "AND `payment` = '" . $arrParams['filter_method'] . "'";
                }

                // FILTER: COMPLETED
                if(isset($arrParams['filter_completed']) && $arrParams['filter_completed'] != 'default') {
                    $query[]	= "AND `completed` = '" . $arrParams['filter_completed'] . "'";
                }
                
                // FILTER: CANCEL
                if(isset($arrParams['filter_cancel']) && $arrParams['filter_cancel'] != 'default') {
                    $query[]	= "AND `c`.`cancel` = '" . $arrParams['filter_cancel'] . "'";
                }


                // SORT
                if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
                    $comlumn = $arrParams['filter_column']; // name
                    $comlumnDir = $arrParams['filter_column_dir']; // asc
                    $query[] = "ORDER BY `c`.`$comlumn` $comlumnDir"; // ORDER BY `name` ASC
                } else {
                    $query[] = "ORDER BY `c`.`username` ASC"; // ORDER BY `name` ASC
                }

                // PAGINATION
                $pagination = $arrParams['pagination'];
                $totalItemsPerPage = $pagination['totalItemsPerPage'];
                if($totalItemsPerPage > 0){
                    $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                    $query[]    = "LIMIT $position, $totalItemsPerPage";
                }

                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);

            }

            return $result;
        }

        public function itemInSelectbox($arrParams, $option = null)
        {
            if($option == null) {
                $query    = "SELECT `id`, `code` FROM `" . TBL_COUPON . "`";
                $result     = $this->fetchPairs($query);
                $result['default'] = "Select Coupon";
                ksort($result);
            }
            return $result;
        }

        public function changeStatus($arrParam, $option = null){
            if($option['task'] == 'change-ajax-status'){
                $status = $arrParam['status'];
                $completed = $arrParam['completed'];
                $id		= $arrParam['id'];
                $user_id		= $arrParam['user_id'];
                if ($status == 1 && $completed == 0){
                    $query	= "UPDATE `$this->table` SET `status` = 0 WHERE `id` = '" . $id . "'";
                    $this->query($query);

                    $result = array(
                        'id'		=> $id,
                        'status'	=> 1,
                        'completed'	=> 0,
                        'user_id'   => $user_id,
                        'link'		=> URL::createLink('admin', 'order', 'ajaxStatus', array('id' => $id))
                    );
                    return $result;
                }

                if ($status == 1 && $completed == 1){
                    $query	= "UPDATE `$this->table` SET `status` = 0, `completed` = 0 WHERE `id` = '" . $id . "'";
                    $this->query($query);

                    $result = array(
                        'id'		=> $id,
                        'status'	=> 1,
                        'completed'	=> 0,
                        'user_id'   => $user_id,
                        'link'		=> URL::createLink('admin', 'order', 'ajaxStatus', array('id' => $id))
                    );
                    return $result;
                }

                if ($status == 0 && $completed == 0){
                    $query	= "UPDATE `$this->table` SET `status` = 1 WHERE `id` = '" . $id . "'";
                    $this->query($query);

                    $result = array(
                        'id'		=> $id,
                        'status'	=> 0,
                        'completed'	=> 0,
                        'user_id'   => $user_id,
                        'link'		=> URL::createLink('admin', 'order', 'ajaxStatus', array('id' => $id))
                    );
                    return $result;
                }
            }

            if($option['task'] == 'change-status'){
                $status 	= $arrParam['type'];
                if(!empty($arrParam['cid'])){
                    if($status == 0) {
                        $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                        $query		= "UPDATE `".TBL_ORDER."` SET `status` = $status, `completed` = $status WHERE `id` IN ($ids)";

                        $this->query($query);
                    } else {
                        $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                        $query		= "UPDATE `".TBL_ORDER."` SET `status` = $status WHERE `id` IN ($ids)";

                        $this->query($query);
                    }
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function changeCompleted($arrParam, $option = null){
            if($option['task'] == 'change-ajax-completed'){
                $status = $arrParam['status'];
                $completed = $arrParam['completed'];
                $id		= $arrParam['id'];
                $user_id		= $arrParam['user_id'];
                //  1 - 0 -> 1 - 1
                // Done
                if ($status == 1 && $completed == 0){
                    $query	= "UPDATE `$this->table` SET `completed` = 1, `status` = 1 WHERE `id` = '" . $id . "'";
                    $this->query($query);

                    $result = array(
                        'id'		=> $id,
                        'status'	=> 1,
                        'completed'	=> 0,
                        'user_id'   => $user_id,
                        'link'		=> URL::createLink('admin', 'order', 'ajaxCompleted', array('id' => $id, 'completed' => 1, 'status' => 1))
                    );
                    return $result;
                }

                if($status == 0 && $completed == 0) {
                    $query	= "UPDATE `$this->table` SET `completed` = 1, `status` = 1 WHERE `id` = '" . $id . "'";
                    $this->query($query);

                    $result = array(
                        'id'		=> $id,
                        'status'	=> 1,
                        'completed'	=> 0,
                        'user_id'   => $user_id,
                        'link'		=> URL::createLink('admin', 'order', 'ajaxCompleted', array('id' => $id, 'completed' => 1, 'status' => 1))
                    );
                    return $result;
                }

                if($status == 1 && $completed == 1){
                    $query	= "UPDATE `$this->table` SET `completed` = 0 WHERE `id` = '" . $id . "'";
                    $this->query($query);

                    $result = array(
                        'id'		=> $id,
                        'status'	=> 0,
                        'completed'	=> 0,
                        'user_id'   => $user_id,
                        'link'		=> URL::createLink('admin', 'order', 'ajaxCompleted', array('id' => $id, 'completed' => 0, 'status' => 1))
                    );
                    return $result;
                }

            }

            if($option['task'] == 'change-completed'){
                $completed 	= $arrParam['type'];
                if(!empty($arrParam['cid'])){
                    if($completed == 0){
                        $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                        $query		= "UPDATE `".TBL_ORDER."` SET `completed` = $completed WHERE `id` IN ($ids)";
                        $this->query($query);
                    } else {
                        $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                        $query		= "UPDATE `".TBL_ORDER."` SET `completed` = $completed, `status` = $completed WHERE `id` IN ($ids)";
                        $this->query($query);
                    }

                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
            
           
        }
        
        public function changeCancel($arrParam, $option = null){
             if($option['task'] == 'change-ajax-cancel'){
                $modified = date('Y-m-d H:i:s', time());
                $modified_by = $this->_userInfo['username'];
                $id		= $arrParam['id'];
                $query	= "UPDATE `$this->table` SET `cancel` = 2, `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = '" . $id . "'";
                $this->query($query);
    
                $result = array(
                    'id'		=> $id,
                    'cancel'	=> 2,
                    'link'		=> URL::createLink('admin', 'order', 'ajaxCancel', array('id' => $id, 'cancel' => 2))
                );
                return $result;
            }
        }

        public function deleteItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                    $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                    $this->query($query);

                    foreach ($arrParam['cid'] as $key => $value){
                        $queryNotice = "DELETE FROM `".TBL_NOTICE."` WHERE `name` LIKE '%".$value."%'";
                        $this->query($queryNotice);
                    }
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . ' Elements Deleted Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function saveItem($arrParam, $option = null){
            if($option['task'] == 'edit'){
                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array

                $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));

                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success', 'content' => 'Updated Successfully!'));

                return $arrParam['form']['id'];
            }
        }

        public function infoItem($arrParam, $option = null){
            if($option == null){
                $query[]	= "SELECT `c`.`id`, `c`.`username`, `c`.`completed`, `c`.`cancel`, `c`.`names`, `c`.`prices`, `c`.`quantities`, `c`.`status`, `c`.`date`, `c`.`user_id` , `c`.`memberDiscount`, `c`.`products`, `c`.`coupon_id`, `c`.`payment`, `c`.`invoice`, `c`.`products`, `c`.`customer`, `c`.`address`, `c`.`phone`, `u`.`username` AS `username`, `v`.`id` AS `couponID`, `v`.`code` AS `coupon_name`, `v`.`value` ";
                $query[]	= "FROM `".TBL_COUPON."` AS `v` RIGHT JOIN `$this->table` AS `c` ON `v`.`id` = `c`.`coupon_id` LEFT JOIN `". TBL_USER ."` AS `u` ON `c`.`username` = `u`.`username`";
                $query[]    = "WHERE `c`.`id` = '" . $arrParam['id'] . "'";

                $query      = implode(" ", $query);
                $result     = $this->fetchRow($query);

                return $result;
            }
        }

        public function addNotice($arrParam, $option = null){
            $name       = '';
            $user_id    = $arrParam['user_id'];
            $id         = $arrParam['id'];
            $time = date('Y-m-d H:i:s', time());

           if($option['task'] == 'status'){
               if($option['status'] == 0){
                   $name = 'Your order `'.$id.'` has been approved';
               }
           }

            if($option['task'] == 'completed'){
                if($option['completed'] == 0){
                    $name = 'Your order `'.$id.'` is being shipped';
                }
            }
            
            if($name != ''){
                $check = "SELECT `id`, `name`, `user_id` FROM `".TBL_NOTICE."` WHERE `name` = '$name'";
                $resultCheck = $this->query($check);
                if($resultCheck->num_rows == 0){
                    $query  = "INSERT INTO `".TBL_NOTICE."` (`name`, `time`, `user_id`) VALUES ('$name', '$time', '$user_id')";
                    $this->query($query);
                }
            }
        }

        public function addNotices($arrParam, $option = null){
            $status 	= $arrParam['type'];
            $name       = '';
            $time = date('Y-m-d H:i:s', time());

            if(!empty($arrParam['cid'])){
                foreach ($arrParam['cid'] as $key => $value){
                    $userID = "SELECT `user_id`, `id` FROM `".$this->table."` WHERE `id` = '" . $value . "'";
                    $result = $this->fetchRow($userID);

                    $user_id = $result['user_id'];
                    if($option['task'] == 'change-status' || $option['task'] == 'change-ajax-status'){
                        if($status == 1){
                            $name = 'Your order `'.$result['id'].'` has been approved';
                        }
                    }

                    if($option['task'] == 'change-completed' || $option['task'] == 'change-ajax-completed'){
                        if($status == 1){
                            $name = 'Your order `'.$result['id'].'` is being shipped';
                        }
                    }

                    if($name != ''){
                        $check = "SELECT `id`, `name`, `user_id` FROM `".TBL_NOTICE."` WHERE `name` = '$name'";
                        $resultCheck = $this->query($check);
                        if($resultCheck->num_rows == 0){
                            echo $query  = "INSERT INTO `".TBL_NOTICE."` (`name`, `time`, `user_id`) VALUES ('$name', '$time', '$user_id')";
                            $this->query($query);
                        }
                    }
                }
            }
        }
    }
