<?php
    class CategoryModel extends Model {
        private $_columns = array('id', 'name', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_CATEGORY);
            $userObj            = Session::get('user');
            $this->_userInfo    = $userObj['info'];
        }

        public function countItems($arrParams, $option = null)
        {
            $query[]    = "SELECT COUNT(`id`) AS `total`";
            $query[]    = "FROM `$this->table`";
            $query[]	= "WHERE `id` > 0";


            // FILTER: KEYWORD
            if(!empty($arrParams['filter_search'])) {
                $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                $query[]	= "AND `name` LIKE $keyword";
            }

            // FILTER: STATUS
            if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                $query[]	= "AND `status` = '" . $arrParams['filter_state'] . "'";
            }


            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            $query[]    = "SELECT `id`, `name`, `status`, `ordering`, `created`, `created_by`, `modified`, `modified_by` ";
            $query[]    = "FROM `$this->table`";
            $query[]	= "WHERE `id` > 0";


            // FILTER: KEYWORD
            if(!empty($arrParams['filter_search'])) {
                $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                $query[]	= "AND `name` LIKE $keyword";
            }

            // FILTER: STATUS
            if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                $query[]	= "AND `status` = '" . $arrParams['filter_state'] . "'";
            }

            // SORT
            if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
                $comlumn = $arrParams['filter_column']; // name
                $comlumnDir = $arrParams['filter_column_dir']; // asc
                $query[] = "ORDER BY `$comlumn` $comlumnDir"; // ORDER BY `name` ASC
            } else {
                $query[] = "ORDER BY `id` DESC"; // ORDER BY `name` ASC
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

            return $result;
        }

        public function changeStatus($arrParam, $option = null){
            if($option['task'] == 'change-ajax-status'){
                $status = ($arrParam['status'] == 0) ? 1 : 0;
                $modified = date('Y-m-d H:i:s', time());
                $modified_by = $this->_userInfo['username'];
                $id		= $arrParam['id'];
                $query	= "UPDATE `$this->table` SET `status` = $status, `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = '" . $id . "'";
                $this->query($query);

                $result = array(
                    'id'		=> $id,
                    'status'	=> $status,
                    'link'		=> URL::createLink('admin', 'category', 'ajaxStatus', array('id' => $id, 'status' => $status))
                );
                return $result;
            }

            if($option['task'] == 'change-status'){
                $status 	= $arrParam['type'];
                $modified = date('Y-m-d H:i:s', time());
                $modified_by = $this->_userInfo['username'];
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                    $query		= "UPDATE `$this->table` SET `status` = $status, `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` IN ($ids)";
                    $this->query($query);
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfuy!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function deleteItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);

                    // Delete from Database
                    $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                    $this->query($query);

                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . 'Elements Deleted Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function saveItem($arrParam, $option = null){
            if($option['task'] == 'add'){
                $arrParam['form']['created']	= date('Y-m-d H:i:s', time());
                $arrParam['form']['created_by']	= $this->_userInfo['username'];

                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->insert($data);

                Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));
                return $this->lastID();
            }

            if($option['task'] == 'edit'){
                $arrParam['form']['modified'] = date('Y-m-d H:i:s', time());
                $arrParam['form']['modified_by'] = $this->_userInfo['username'];

                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));


                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success', 'content' => 'Edited Successfully!'));

                return $arrParam['form']['id'];
            }
        }

        public function infoItem($arrParam, $option = null){
            if($option == null){
                $query[] = "SELECT `id`, `name`, `status`, `ordering` ";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }
        }

        public function ordering($arrParam, $option = null){
            if($option == null){
                $modified = date('Y-m-d H:i:s', time());
                $modified_by = $this->_userInfo['username'];
                if(!empty($arrParam['order'])){
                    $i = 0;
                    foreach($arrParam['order'] as $id => $ordering){
                        $i++;
                        $query	= "UPDATE `$this->table` SET `ordering` = $ordering, `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = '" . $id . "'";
                        $this->query($query);
                    }
                    Session::set('message', array('class' => 'success', 'content' => ' Update Ordering Successfully!'));
                }
            }
        }
    }
