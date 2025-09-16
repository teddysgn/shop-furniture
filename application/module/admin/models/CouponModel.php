<?php
    class CouponModel extends Model {
        private $_columns = array('id', 'name', 'code', 'value', 'status', 'quantity', 'used', 'ordering', 'created', 'created_by', 'modified', 'modified_by');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_COUPON);
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
                $query[]	= "AND (`code` LIKE $keyword)";
            }

            // FILTER: STATUS
            if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                $query[]	= "AND `status` = '" . $arrParams['filter_state'] . "'";
            }

            // FILTER: COMPLETED
            if(isset($arrParams['filter_completed']) && $arrParams['filter_completed'] != 'default') {
                $query[]	= "AND `completed` = '" . $arrParams['filter_completed'] . "'";
            }


            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            if ($option == null) {
                // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số product chưa có category_id)
                $query[]	= "SELECT `v`.`id`, `v`.`name`, `v`.`code`, `v`.`value`, `v`.`quantity`, `v`.`used`,  `v`.`created`, `v`.`created_by`, `v`.`status`, `v`.`modified`, `v`.`modified_by`, `v`.`ordering`";
                $query[]	= "FROM `$this->table` AS `v` ";
                $query[]	= "WHERE `v`.`id` > 0";

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND (`v`.`id` LIKE $keyword)";
                    $query[]	= "OR (`v`.`code` LIKE $keyword)";
                }

                // FILTER: STATUS
                if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                    $query[]	= "AND `v`.`status` = '" . $arrParams['filter_state'] . "'";
                }

                // SORT
                if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
                    $comlumn = $arrParams['filter_column']; // name
                    $comlumnDir = $arrParams['filter_column_dir']; // asc
                    $query[] = "ORDER BY `v`.`$comlumn` $comlumnDir"; // ORDER BY `name` ASC
                } else {
                    $query[] = "ORDER BY `v`.`name` ASC"; // ORDER BY `name` ASC
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
                $query    = "SELECT `id`, `name` FROM `" . TBL_CATEGORY . "`";
                $result     = $this->fetchPairs($query);
                $result['default'] = "Select Category";
                ksort($result);
            }
            return $result;
        }

        public function changeStatus($arrParam, $option = null){
            if($option['task'] == 'change-ajax-status'){
                $status = ($arrParam['status'] == 0) ? 1 : 0;
                $id		= $arrParam['id'];
                $query	= "UPDATE `$this->table` SET `status` = $status WHERE `id` = '" . $id . "'";
                $this->query($query);

                $result = array(
                    'id'		=> $id,
                    'status'	=> $status,
                    'link'		=> URL::createLink('admin', 'coupon', 'ajaxStatus', array('id' => $id, 'status' => $status))
                );
                return $result;
            }

            if($option['task'] == 'change-status'){
                $status 	= $arrParam['type'];
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                    $query		= "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                    $this->query($query);
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function deleteItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                    $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                    $this->query($query);
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . 'Elements Deleted Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function saveItem($arrParam, $option = null){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];
            if($option['task'] == 'add'){
                $arrParam['form']['created'] = date('Y-m-d H:i:s', time());
                $arrParam['form']['created_by'] = $userInfo['username'];

                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data = array_intersect_key( $arrParam['form'],array_flip($this->_columns));

                $this->insert($data);
                Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));

                return $this->lastID();
            }

            if($option['task'] == 'edit'){
                $arrParam['id'] = $arrParam['form']['id'];
                $arrParam['form']['modified'] = date('Y-m-d H:i:s', time());
                $arrParam['form']['modified_by'] = $userInfo['username'];

                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));


                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success', 'content' => 'Edit Successfully!'));

                return $arrParam['form']['id'];
            }
        }

        public function infoItem($arrParam, $option = null){
            if($option == null){
                $query[]= "SELECT `id`, `name`, `value`, `quantity`, `used`, `code`, `created`, `created_by`, `status`, `ordering`, `modified`, `modified_by` ";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }
        }

        public function ordering($arrParam, $option = null){
            if($option == null){
                if(!empty($arrParam['order'])){
                    $i = 0;
                    foreach($arrParam['order'] as $id => $ordering){
                        $i++;
                        $query	= "UPDATE `$this->table` SET `ordering` = $ordering WHERE `id` = '" . $id . "'";
                        $this->query($query);
                    }
                    Session::set('message', array('class' => 'success', 'content' => ' Update Ordering Successflly!'));
                }
            }
        }

        public function quantity($arrParam, $option = null){
            if($option == null){
                if(!empty($arrParam['quantity'])){
                    $i = 0;
                    foreach($arrParam['quantity'] as $id => $ordering){
                        $i++;
                        $query	= "UPDATE `$this->table` SET `quantity` = $ordering WHERE `id` = '" . $id . "'";
                        $this->query($query);
                    }
                    Session::set('message', array('class' => 'success', 'content' => ' Update Quantity Successflly!'));
                }
            }
        }
    }
