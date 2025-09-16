<?php
    class ProductModel extends Model {
        private $_columns = array('id', 'name', 'special', 'description', 'price', 'stock', 'sold', 'sale_off', 'picture1', 'picture2', 'picture3', 'picture4', 'picture5', 'picture6', 'picture7', 'picture8', 'picture9', 'picture10', 'picture11', 'picture12', 'gif', 'created', 'created_by', 'modified', 'modified_by', 'deleted', 'deleted_at', 'deleted_by', 'status', 'ordering', 'category_id', 'collection_id', 'designer_id');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_PRODUCT);
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

            // FILTER : SPECIAL
            if(isset($arrParams['filter_special']) && $arrParams['filter_special'] != 'default'){
                $query[]	= "AND `special` = '" . $arrParams['filter_special'] . "'";
            }

            // FILTER : CATEGORY ID
            if(isset($arrParams['filter_category_id']) && $arrParams['filter_category_id'] != 'default'){
                $query[]	= "AND `category_id` = '" . $arrParams['filter_category_id'] . "'";
            }

            // FILTER: COLLECTION_ID
            if(isset($arrParams['filter_collection_id']) && $arrParams['filter_collection_id'] != 'default') {
                $query[]	= "AND `collection_id` = '" . $arrParams['filter_collection_id'] . "'";
            }

            // FILTER: DESIGNER_ID
            if(isset($arrParams['filter_designer_id']) && $arrParams['filter_designer_id'] != 'default') {
                $query[]	= "AND `designer_id` = '" . $arrParams['filter_designer_id'] . "'";
            }
            
            // FILTER: DELETED
            if(isset($arrParams['filter_trash']) && $arrParams['filter_trash'] != 'default') {
                $query[]	= "AND `deleted` = '" . $arrParams['filter_trash'] . "'";
            }

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            if($option['task'] == null){
                // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số product chưa có category_id)
                $query[]	= "SELECT `b`.`id`, `b`.`special`, `b`.`name`, `b`.`picture1`, `b`.`price`, `b`.`stock`, `b`.`sold`, `b`.`sale_off`, `b`.`status`, `b`.`ordering`, `b`.`view`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`, `b`.`deleted`, `b`.`deleted_at`, `b`.`deleted_by`, `c`.`name` AS `category_name`, `co`.`name` AS `collection_name`, `d`.`name` AS `designer_name`";
                $query[]	= "FROM `$this->table` AS `b` LEFT JOIN `". TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id` LEFT JOIN `". TBL_COLLECTION . "` AS `co` ON `co`.`id` = `b`.`collection_id` LEFT JOIN `". TBL_DESIGNER . "` AS `d` ON `d`.`id` = `b`.`designer_id`";
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

                // FILTER: SPECIAL
                if(isset($arrParams['filter_special']) && $arrParams['filter_special'] != 'default') {
                    $query[]	= "AND `b`.`special` = '" . $arrParams['filter_special'] . "'";
                }

                // FILTER: CATEGORY_ID
                if(isset($arrParams['filter_category_id']) && $arrParams['filter_category_id'] != 'default') {
                    $query[]	= "AND `b`.`category_id` = '" . $arrParams['filter_category_id'] . "'";
                }

                // FILTER: COLLECTION_ID
                if(isset($arrParams['filter_collection_id']) && $arrParams['filter_collection_id'] != 'default') {
                    $query[]	= "AND `b`.`collection_id` = '" . $arrParams['filter_collection_id'] . "'";
                }

                // FILTER: DESIGNER_ID
                if(isset($arrParams['filter_designer_id']) && $arrParams['filter_designer_id'] != 'default') {
                    $query[]	= "AND `b`.`designer_id` = '" . $arrParams['filter_designer_id'] . "'";
                }
                
                // FILTER: DELETED
                if(isset($arrParams['filter_trash']) && $arrParams['filter_trash'] != 'default') {
                    $query[]	= "AND `b`.`deleted` = '" . $arrParams['filter_trash'] . "'";
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

            if($option['task'] == 'new-item'){
                // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số product chưa có category_id)
                $query[]	= "SELECT `b`.`id`, `b`.`special`, `b`.`name`, `b`.`picture1`, `b`.`price`, `b`.`stock`, `b`.`sold`, `b`.`sale_off`, `b`.`status`, `b`.`ordering`, `b`.`view`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`, `b`.`deleted`, `b`.`deleted_at`, `b`.`deleted_by`, `c`.`name` AS `category_name`, `co`.`name` AS `collection_name`, `d`.`name` AS `designer_name`";
                $query[]	= "FROM `$this->table` AS `b` LEFT JOIN `". TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id` LEFT JOIN `". TBL_COLLECTION . "` AS `co` ON `co`.`id` = `b`.`collection_id` LEFT JOIN `". TBL_DESIGNER . "` AS `d` ON `d`.`id` = `b`.`designer_id`";
                $query[]	= "WHERE `b`.`id` > 0 AND `price` = 0";

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND (`b`.`name` LIKE $keyword)";
                }

                // FILTER: STATUS
                if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                    $query[]	= "AND `b`.`status` = '" . $arrParams['filter_state'] . "'";
                }

                // FILTER: SPECIAL
                if(isset($arrParams['filter_special']) && $arrParams['filter_special'] != 'default') {
                    $query[]	= "AND `b`.`special` = '" . $arrParams['filter_special'] . "'";
                }

                // FILTER: CATEGORY_ID
                if(isset($arrParams['filter_category_id']) && $arrParams['filter_category_id'] != 'default') {
                    $query[]	= "AND `b`.`category_id` = '" . $arrParams['filter_category_id'] . "'";
                }

                // FILTER: COLLECTION_ID
                if(isset($arrParams['filter_collection_id']) && $arrParams['filter_collection_id'] != 'default') {
                    $query[]	= "AND `b`.`collection_id` = '" . $arrParams['filter_collection_id'] . "'";
                }

                // FILTER: DESIGNER_ID
                if(isset($arrParams['filter_designer_id']) && $arrParams['filter_designer_id'] != 'default') {
                    $query[]	= "AND `b`.`deleted` = '" . $arrParams['filter_designer_id'] . "'";
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

            if($option['task'] == 'designer') {
                $query              = "SELECT `id`, `name` FROM `" . TBL_DESIGNER . "`";
                $result             = $this->fetchPairs($query);
                $result['default']  = "Select Designer";
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
                    'link'		=> URL::createLink('admin', 'product', 'ajaxStatus', array('id' => $id, 'status' => $status))
                );
                return $result;
            }

            if($option['task'] == 'change-ajax-special'){
                $special = ($arrParam['special'] == 0) ? 1 : 0;
                $modified = date('Y-m-d H:i:s', time());
                $modified_by = $this->_userInfo['username'];
                $id		= $arrParam['id'];
                $query	= "UPDATE `$this->table` SET `special` = $special, `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = '" . $id . "'";
                $this->query($query);

                $result = array(
                    'id'		=> $id,
                    'special'	=> $special,
                    'link'		=> URL::createLink('admin', 'product', 'ajaxSpecial', array('id' => $id, 'special' => $special))
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

            if($option['task'] == 'change-special'){
                $special 	= $arrParam['type'];
                $modified = date('Y-m-d H:i:s', time());
                $modified_by = $this->_userInfo['username'];
                if(!empty($arrParam['cid'])){
                    $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                    $query		= "UPDATE `$this->table` SET `special` = $special, `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` IN ($ids)";
                    $this->query($query);
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function deleteFolder($folder, $ids){
        $query[] = "SELECT `id`, `name` ";
        $query[] = "FROM `$this->table`";
        $query[] = "WHERE `id` IN ($ids)";

        $query   = implode(" ", $query);
        $result  = $this->fetchAll($query);

        foreach($result as $key => $value){
            $files = glob($folder . $value['name'] . '/*');
            foreach($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($folder . $value['name']);
        }
    }

        public function deleteItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                     foreach($arrParam['cid'] as $key => $value){
                        $id[] = $value;
                    }
                    
                    foreach($id as $key => $value){
                        $query = 'SELECT `id` ';
                        $query .= 'FROM `'.TBL_ORDER.'`';
                        $query .= 'WHERE `products` LIKE \'%"' . $value . '"%\'';
         
                        $result  = $this->fetchAll($query);
                    }     
                    if($result == null){
                        $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
        
                        $this->deleteFolder(UPLOAD_PATH . 'product' . DS . $arrParam['form']['name'], $ids);
        
                        $delete		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                        $this->query($delete);
        
                        Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . ' Elements Deleted Successfully!'));
                    }
                    else {
                        Session::set('message', array('class' => 'error', 'content' => 'These Products are exist in another Order. Can not Delete them!'));
                    }
                   
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }
        
        public function trashItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                     foreach($arrParam['cid'] as $key => $value){
                        $id[] = $value;
                    }
                    
                    foreach($id as $key => $value){
                        $query = 'SELECT `id` ';
                        $query .= 'FROM `'.TBL_ORDER.'` ';
                        $query .= 'WHERE `products` LIKE \'%"' . $value . '"%\'';
         
                        $result  = $this->fetchAll($query);
                    }     
                    if($result == null){
                        $deletedAt = date('Y-m-d H:i:s', time());
                        $deletedBy = $this->_userInfo['username'];
                        
                        foreach($id as $key => $value){
                            $query = "UPDATE `$this->table` ";
                            $query .= "SET `deleted` = 1, `deleted_at` = '$deletedAt', `deleted_by` = '$deletedBy'";
                            $query .= "WHERE `id` = $value";
                            
                            $this->query($query);
                        } 
        
                        Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . ' Elements Moved to Trash Successfully!'));
                    }
                    else {
                        Session::set('message', array('class' => 'error', 'content' => 'These Products are exist in another Order. Can not Move them!'));
                    }
                    
                    
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }
        
        public function restoreItem($arrParam, $option = null){
            if($option['task'] == null){
                if(!empty($arrParam['cid'])){
                     foreach($arrParam['cid'] as $key => $value){
                        $id[] = $value;
                    }
                    
                    $modified   = date('Y-m-d H:i:s', time());
                    $modifiedBy = $this->_userInfo['username'];
                    
                    foreach($id as $key => $value){
                        $query = "UPDATE `$this->table` ";
                        $query .= "SET `deleted` = 0, `deleted_at` = '', `deleted_by` = ''";
                        $query .= "WHERE `id` = $value";
                        
                        $this->query($query);
                    } 
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . ' Elements Restored Successfully!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
                }
            }
        }

        public function saveItem($arrParam, $option = null){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();
            $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

            $uploadDir		= UPLOAD_PATH . 'product' . DS . $arrParam['form']['name'];

            if(!file_exists($uploadDir)){
                mkdir($uploadDir);
            }


            if($option['task'] == 'add'){
                $arrParam['form']['picture1']	= $uploadObj->uploadFile($arrParam['form']['picture1'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture2']	= $uploadObj->uploadFile($arrParam['form']['picture2'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture3']	= $uploadObj->uploadFile($arrParam['form']['picture3'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture4']	= $uploadObj->uploadFile($arrParam['form']['picture4'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture5']	= $uploadObj->uploadFile($arrParam['form']['picture5'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture6']	= $uploadObj->uploadFile($arrParam['form']['picture6'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture7']	= $uploadObj->uploadFile($arrParam['form']['picture7'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture8']	= $uploadObj->uploadFile($arrParam['form']['picture8'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture9']	= $uploadObj->uploadFile($arrParam['form']['picture9'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture10']	= $uploadObj->uploadFile($arrParam['form']['picture10'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture11']	= $uploadObj->uploadFile($arrParam['form']['picture11'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['picture12']	= $uploadObj->uploadFile($arrParam['form']['picture12'], 'product/' . $arrParam['form']['name']);
                $arrParam['form']['created']	= date('Y-m-d H:i:s', time());
                $arrParam['form']['created_by']	= $this->_userInfo['username'];
                $arrParam['form']['description']= mysqli_real_escape_string($links, $arrParam['form']['description']);
                $arrParam['form']['name']		= mysqli_real_escape_string($links, $arrParam['form']['name']);
                $arrParam['form']['price']      = (int)str_replace(',', '', $arrParam['form']['price']);


                // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
                // array_flip(): Đâỏ ngược key vào value trong array
                $data = array_intersect_key( $arrParam['form'],array_flip($this->_columns));

                $this->insert($data);
                Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));

                return $this->lastID();
            }

            if($option['task'] == 'edit'){
                
               ini_set('max_file_uploads', '100');
                $uploads_dir = $_FILES['gif'];
               
                foreach ($uploads_dir["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $uploadDir360		= $uploadDir . DS . '360';
                        if(!file_exists($uploadDir360)){
                            mkdir($uploadDir360);
                        }
                        $tmp_name = $uploads_dir["tmp_name"][$key];
                        $name = basename($uploads_dir["name"][$key]);
                        move_uploaded_file($tmp_name, $uploadDir360 . DS . $name);
                    }
                }
                
                
                // Không cho người dùng thay đổi giá trị username
                $arrParam['form']['modified'] = date('Y-m-d H:i:s', time());
                $arrParam['form']['modified_by'] = $this->_userInfo['username'];
                $arrParam['form']['description']= mysqli_real_escape_string($links, $arrParam['form']['description']);
                $arrParam['form']['name']		= mysqli_real_escape_string($links, $arrParam['form']['name']);

                if($arrParam['form']['picture1']['name'] == null){
                    unset($arrParam['form']['picture1']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture1_hidden']);
                    $arrParam['form']['picture1']	= $uploadObj->uploadFile($arrParam['form']['picture1'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture2']['name'] == null){
                    unset($arrParam['form']['picture2']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture2_hidden']);
                    $arrParam['form']['picture2']	= $uploadObj->uploadFile($arrParam['form']['picture2'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture3']['name'] == null){
                    unset($arrParam['form']['picture3']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture3_hidden']);
                    $arrParam['form']['picture3']	= $uploadObj->uploadFile($arrParam['form']['picture3'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture4']['name'] == null){
                    unset($arrParam['form']['picture4']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture4_hidden']);
                    $arrParam['form']['picture4']	= $uploadObj->uploadFile($arrParam['form']['picture4'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture5']['name'] == null){
                    unset($arrParam['form']['picture5']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture5_hidden']);
                    $arrParam['form']['picture5']	= $uploadObj->uploadFile($arrParam['form']['picture5'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture6']['name'] == null){
                    unset($arrParam['form']['picture6']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture6_hidden']);
                    $arrParam['form']['picture6']	= $uploadObj->uploadFile($arrParam['form']['picture6'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture7']['name'] == null){
                    unset($arrParam['form']['picture7']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture7_hidden']);
                    $arrParam['form']['picture7']	= $uploadObj->uploadFile($arrParam['form']['picture7'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture8']['name'] == null){
                    unset($arrParam['form']['picture8']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture8_hidden']);
                    $arrParam['form']['picture8']	= $uploadObj->uploadFile($arrParam['form']['picture8'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture9']['name'] == null){
                    unset($arrParam['form']['picture9']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture9_hidden']);
                    $arrParam['form']['picture9']	= $uploadObj->uploadFile($arrParam['form']['picture9'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture10']['name'] == null){
                    unset($arrParam['form']['picture10']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture10_hidden']);
                    $arrParam['form']['picture10']	= $uploadObj->uploadFile($arrParam['form']['picture10'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture11']['name'] == null){
                    unset($arrParam['form']['picture11']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture11_hidden']);
                    $arrParam['form']['picture11']	= $uploadObj->uploadFile($arrParam['form']['picture11'], 'product/' . $arrParam['form']['name']);
                }

                if($arrParam['form']['picture12']['name'] == null){
                    unset($arrParam['form']['picture12']);
                } else {
                    $uploadObj->removeFile('product/' . $arrParam['form']['name'], $arrParam['form']['picture12_hidden']);
                    $arrParam['form']['picture12']	= $uploadObj->uploadFile($arrParam['form']['picture12'], 'product/' . $arrParam['form']['name']);
                }

                $arrParam['form']['price'] = (int)str_replace(',', '', $arrParam['form']['price']);

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
                $query[] = "SELECT `id`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `picture6`, `picture7`, `picture8`, `picture9`, `picture10`, `picture11`, `picture12`, `special`, `description`, `name`, `price`, `stock`, `sold`, `sale_off`, `category_id`, `status`, `ordering`, `collection_id`, `designer_id` ";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }
            
            if($option['task'] == 'check-product-in-cart'){
                foreach($arrParam as $key => $value){
                    $query = 'SELECT `id` ';
                    $query .= 'FROM `'.TBL_ORDER.'`';
                    $query .= 'WHERE `products` LIKE \'%"' . $value . '"%\'';
     
                    $result[$value]  = $this->fetchAll($query);
                    
                    
                }
                
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
    }
