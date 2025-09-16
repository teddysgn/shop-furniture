<?php
    class DesignerModel extends Model {
        private $_columns = array('id', 'name', 'description', 'about', 'maxim', 'comment', 'picture_profile', 'picture_background', 'picture1', 'picture2', 'picture3', 'picture4', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_DESIGNER);
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
                $query[]	= "AND (`name` LIKE $keyword)";
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
            if($option['task'] == null){
                // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số designer chưa có category_id)
                $query[]	= "SELECT `b`.`id`, `b`.`name`, `b`.`picture_profile`, `b`.`status`, `b`.`ordering`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`";
                $query[]	= "FROM `$this->table` AS `b` ";
                $query[]	= "WHERE `b`.`id` > 0";

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND (`b`.`name` LIKE $keyword)";
                }

                // FILTER: STATUS
                if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                    $query[]	= "AND `b`.`status` = '" . $arrParams['filter_state'] . "'";
                }

                // SORT
                if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
                    $comlumn = $arrParams['filter_column']; // name
                    $comlumnDir = $arrParams['filter_column_dir']; // asc
                    $query[] = "ORDER BY `b`.`$comlumn` $comlumnDir"; // ORDER BY `name` ASC
                } else {
                    $query[] = "ORDER BY `b`.`id` ASC"; // ORDER BY `name` ASC
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

            if($option['task'] == 'become'){
                $query[]	= "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`website`, `b`.`design_about`, `b`.`profession`, `b`.`message`, `b`.`user_id`, `b`.`date`, `u`.`fullname` AS `user_name`";
                $query[]	= "FROM `".TBL_BECOME."` AS `b`,  `".TBL_USER."` AS `u`";
                $query[]	= "WHERE `b`.`user_id` = `u`.`id`";

                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            return $result;
        }

        public function itemInSelectbox($arrParams, $option = null)
        {
            if($option['task'] == 'category') {
                $query              = "SELECT `id`, `name` FROM `" . TBL_CATEGORY . "`";
                $result             = $this->fetchPairs($query);
                $result['default']  = "Select Category";
                ksort($result);
                return $result;
            }

            if($option['task'] == 'collection') {
                $query              = "SELECT `id`, `name` FROM `" . TBL_COLLECTION . "`";
                $result             = $this->fetchPairs($query);
                $result['default']  = "Select Collection";
                ksort($result);
                return $result;
            }
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
                    'link'		=> URL::createLink('admin', 'designer', 'ajaxStatus', array('id' => $id, 'status' => $status))
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
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function saveItem($arrParam, $option = null){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();
            $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

            $uploadDir		= UPLOAD_PATH . 'designer' . DS . $arrParam['form']['name'];

            if(!file_exists($uploadDir)){
                mkdir($uploadDir);
            }

            if($option['task'] == 'add'){
                $arrParam['form']['picture_profile']	= $uploadObj->uploadFile($arrParam['form']['picture_profile']   , 'designer/' . $arrParam['form']['name']);
                $arrParam['form']['picture_background']	= $uploadObj->uploadFile($arrParam['form']['picture_background'], 'designer/' . $arrParam['form']['name']);
                $arrParam['form']['picture1']	        = $uploadObj->uploadFile($arrParam['form']['picture1']          , 'designer/' . $arrParam['form']['name']);
                $arrParam['form']['picture2']	        = $uploadObj->uploadFile($arrParam['form']['picture2']          , 'designer/' . $arrParam['form']['name']);
                $arrParam['form']['picture3']	        = $uploadObj->uploadFile($arrParam['form']['picture3']          , 'designer/' . $arrParam['form']['name']);
                $arrParam['form']['picture4']	        = $uploadObj->uploadFile($arrParam['form']['picture4']          , 'designer/' . $arrParam['form']['name']);
                $arrParam['form']['created']	        = date('Y-m-d H:i:s', time());
                $arrParam['form']['created_by']	        = $this->_userInfo['username'];
                $arrParam['form']['description']        = mysqli_real_escape_string($links, $arrParam['form']['description']);
                $arrParam['form']['about']              = mysqli_real_escape_string($links, $arrParam['form']['about']);
                $arrParam['form']['maxim']              = mysqli_real_escape_string($links, $arrParam['form']['maxim']);
                $arrParam['form']['comment']            = mysqli_real_escape_string($links, $arrParam['form']['comment']);
                $arrParam['form']['name']		        = mysqli_real_escape_string($links, $arrParam['form']['name']);

                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data = array_intersect_key( $arrParam['form'],array_flip($this->_columns));

                $this->insert($data);
                Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));

                return $this->lastID();
            }

            if($option['task'] == 'edit'){
                // Không cho người dùng thay đổi giá trị username
                $arrParam['form']['modified'] = date('Y-m-d H:i:s', time());
                $arrParam['form']['modified_by'] = $this->_userInfo['username'];
                $arrParam['form']['description']= mysqli_real_escape_string($links, $arrParam['form']['description']);
                $arrParam['form']['name']		= mysqli_real_escape_string($links, $arrParam['form']['name']);

                if($arrParam['form']['picture_profile']['name'] == null){
                    unset($arrParam['form']['picture_profile']);
                } else {
                    $uploadObj->removeFile('designer/' . $arrParam['form']['name'], $arrParam['form']['picture_profile_hidden']);
                    $arrParam['form']['picture_profile']	= $uploadObj->uploadFile($arrParam['form']['picture_profile'], 'designer/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture_background']['name'] == null){
                    unset($arrParam['form']['picture_background']);
                } else {
                    $uploadObj->removeFile('designer/' . $arrParam['form']['name'], $arrParam['form']['picture_background_hidden']);
                    $arrParam['form']['picture_background']	= $uploadObj->uploadFile($arrParam['form']['picture_background'], 'designer/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture1']['name'] == null){
                    unset($arrParam['form']['picture1']);
                } else {
                    $uploadObj->removeFile('designer/' . $arrParam['form']['name'], $arrParam['form']['picture1_hidden']);
                    $arrParam['form']['picture1']	= $uploadObj->uploadFile($arrParam['form']['picture1'], 'designer/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture2']['name'] == null){
                    unset($arrParam['form']['picture2']);
                } else {
                    $uploadObj->removeFile('designer/' . $arrParam['form']['name'], $arrParam['form']['picture2_hidden']);
                    $arrParam['form']['picture2']	= $uploadObj->uploadFile($arrParam['form']['picture2'], 'designer/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture3']['name'] == null){
                    unset($arrParam['form']['picture3']);
                } else {
                    $uploadObj->removeFile('designer/' . $arrParam['form']['name'], $arrParam['form']['picture3_hidden']);
                    $arrParam['form']['picture3']	= $uploadObj->uploadFile($arrParam['form']['picture3'], 'designer/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture4']['name'] == null){
                    unset($arrParam['form']['picture4']);
                } else {
                    $uploadObj->removeFile('designer/' . $arrParam['form']['name'], $arrParam['form']['picture4_hidden']);
                    $arrParam['form']['picture4']	= $uploadObj->uploadFile($arrParam['form']['picture4'], 'designer/' . $arrParam['form']['name']);
                }
                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));

                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success', 'content' => 'Updated Successfully!'));

                return $arrParam['form']['id'];
            }

            if($option['task'] == 'insert-designer'){
                $_columns = array('name', 'status', 'created', 'created_by', 'picture_profile');
                $arrParam['form']['created'] = date('Y-m-d H:i:s', time());
                $arrParam['form']['created_by'] = $this->_userInfo['username'];
                $arrParam['form']['status'] = 1;
                $arrParam['form']['picture_profile'] = $arrParam['form']['picture'];

                $data = array_intersect_key( $arrParam['form'],array_flip($_columns));

                $this->insert($data);
                return $this->lastID();

            }
        }

        public function approveRequest($arrParam, $option = null){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();
            $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

            if($option['task'] = 'save'){
                $uploadDir		= UPLOAD_PATH . 'designer' . DS . $arrParam['form']['name'];

                if(!file_exists($uploadDir)){
                    mkdir($uploadDir);
                }
                copy(UPLOAD_PATH . 'cache/designer' . DS . $arrParam['form']['name']  . DS . $arrParam['form']['picture'] , UPLOAD_PATH . 'designer/' . $arrParam['form']['name'] . DS . $arrParam['form']['picture']);

                $_columns = array('designer_id', 'group_id');

                $id = $this->saveItem($arrParam, array('task' => 'insert-designer'));
                $this->setTable(TBL_USER);

                $arrParam['form']['designer_id'] = $id;
                $arrParam['form']['group_id'] = 11;

                $data = array_intersect_key($arrParam['form'],array_flip($_columns));
                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success', 'content' => 'Approved Successfully!'));

                $delete		= "DELETE FROM `".TBL_BECOME."` WHERE `id` = " . $arrParam['form']['id'];
                $this->query($delete);

                $folder = UPLOAD_PATH . 'cache/designer' . DS . $arrParam['form']['name'];
                $files = glob($folder . '/*');
                foreach($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                rmdir($folder);

                return $arrParam['form']['id'];
            }

            if($option['task'] = 'deny'){
                Session::set('message', array('class' => 'success', 'content' => 'Denied Successfully!'));

                $delete		= "DELETE FROM `".TBL_BECOME."` WHERE `id` = " . $arrParam['form']['id'];
                $this->query($delete);

                return $arrParam['form']['id'];
            }


        }

        public function infoItem($arrParam, $option = null){
            if($option == null){
                $query[] = "SELECT `id`, `picture1`, `picture2`, `picture3`, `picture4`, `picture_profile`, `picture_background`, `description`, `name`, `about`, `maxim`, `comment`, `status`, `ordering` ";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }

            if($option['task'] == 'info-become'){
                $query[] = "SELECT `b`.`id`, `b`.`user_id`, `b`.`name`, `b`.`picture`, `b`.`website`, `b`.`design_about`, `b`.`profession`,  `b`.`message`, `b`.`date`, `u`.`fullname` AS `user_name`, `u`.`email` AS `user_email`";
                $query[] = "FROM `".TBL_BECOME."` AS `b`, `".TBL_USER."` AS `u`";
                $query[] = "WHERE `b`.`id` = '" . $arrParam['id'] . "'";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }

            if($option['task'] == 'info-user'){
                echo 'hi';
                $query[] = "SELECT `name`, `email`, `id`";
                $query[] = "FROM `".TBL_USER."` ";
                $query[] = "WHERE `id` = '" . $arrParam['form']['user_id'] . "'";

                echo $query   = implode(" ", $query);
                die();
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
                    Session::set('message', array('class' => 'success', 'content' => ' Update Ordering Successfully!'));
                }
            }
        }

        public function deleteItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                    $delete		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";

                    $this->query($delete);

                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . ' Elements Deleted Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }
    }
