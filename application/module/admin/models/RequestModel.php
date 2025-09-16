<?php
    class RequestModel extends Model {
        private $_columns = array('id', 'name', 'description', 'picture1', 'picture2', 'picture3', 'picture4', 'picture5', 'picture6', 'picture7', 'picture8', 'picture9', 'picture10', 'picture11', 'picture12', 'date', 'type', 'product_id', 'designer_id', 'collection_id', 'category_id');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_REQUEST);
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
                $query[]	= "AND `name` LIKE $keyword";
            }

            // FILTER: STATUS
            if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                $arrParams['filter_state'] = $arrParams['filter_state'] == 1 ? 'edit' : 'add';
                $query[]	= "AND `type` = '" . $arrParams['filter_state'] . "'";
            }


            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            if ($option == null) {
                // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số product chưa có category_id)
                $query[]	= "SELECT `r`.`id`, `r`.`name`, `r`.`description`, `r`.`date`, `r`.`type`, `r`.`product_id`, `r`.`designer_id`, `p`.`name` AS `product_name`, `d`.`name` AS `designer_name`, `ca`.`name` AS `category_name`, `co`.`name` AS `collection_name`";
                $query[]	= "FROM `$this->table` AS `r`, `".TBL_DESIGNER."` AS `d`, `".TBL_PRODUCT."` AS `p`, `".TBL_COLLECTION."` AS `co`, `".TBL_CATEGORY."` AS `ca` ";
                $query[]	= "WHERE `r`.`id` > 0 AND `r`.`designer_id` = `d`.`id` AND `r`.`collection_id` = `co`.`id` AND `r`.`category_id` = `ca`.`id`";


                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND (`p`.`name` LIKE $keyword)";
                    $query[]	= "OR (`d`.`name` LIKE $keyword)";
                }

                // FILTER: TYPE
                if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
                    $arrParams['filter_state'] = $arrParams['filter_state'] == 1 ? 'edit' : 'add';
                    $query[]	= "AND `r`.`type` = '" . $arrParams['filter_state'] . "'";
                }
                $query[]    = "GROUP BY `r`.`date`"; // ORDER BY `name` ASC

                // SORT
                if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
                    $comlumn = $arrParams['filter_column']; // name
                    $comlumnDir = $arrParams['filter_column_dir']; // asc
                    $query[] = "ORDER BY `r`.`$comlumn` $comlumnDir"; // ORDER BY `name` ASC
                } else {
                    $query[] = "ORDER BY `r`.`name` ASC"; // ORDER BY `name` ASC
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

        public function saveItem($arrParam, $option = null){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];
            if($option['task'] == 'edit'){
               
                $arrParam['id'] = $arrParam['form']['id'];
                $this->setTable(TBL_PRODUCT);

                $sql = "SELECT `name` FROM `".TBL_PRODUCT."` WHERE `id` = " . $arrParam['id'];

                $result  = $this->fetchRow($sql);

                require_once LIBRARY_EXT_PATH . 'Upload.php';
                $uploadObj = new Upload();

                $oldDir		= UPLOAD_PATH . 'product' . DS . $result['name'];
                $newDir		= UPLOAD_PATH . 'product' . DS . $arrParam['form']['name'];
                if(!file_exists($newDir)){
                    mkdir($newDir);
                }
                $cacheDir = UPLOAD_PATH . 'cache/edit' . DS . $arrParam['form']['name'];

                if(file_exists($oldDir . DS . $arrParam['form']['picture1'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture1'], $newDir . DS . $arrParam['form']['picture1']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture1'], $newDir . DS . $arrParam['form']['picture1']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture2'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture2'], $newDir . DS . $arrParam['form']['picture2']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture2'], $newDir . DS . $arrParam['form']['picture2']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture3'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture3'], $newDir . DS . $arrParam['form']['picture3']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture3'], $newDir . DS . $arrParam['form']['picture3']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture4'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture4'], $newDir . DS . $arrParam['form']['picture4']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture4'], $newDir . DS . $arrParam['form']['picture4']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture5'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture5'], $newDir . DS . $arrParam['form']['picture5']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture5'], $newDir . DS . $arrParam['form']['picture5']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture6'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture6'], $newDir . DS . $arrParam['form']['picture6']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture6'], $newDir . DS . $arrParam['form']['picture6']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture7'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture7'], $newDir . DS . $arrParam['form']['picture7']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture7'], $newDir . DS . $arrParam['form']['picture7']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture8'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture8'], $newDir . DS . $arrParam['form']['picture8']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture8'], $newDir . DS . $arrParam['form']['picture8']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture9'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture9'], $newDir . DS . $arrParam['form']['picture9']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture9'], $newDir . DS . $arrParam['form']['picture9']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture10'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture10'], $newDir . DS . $arrParam['form']['picture10']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture10'], $newDir . DS . $arrParam['form']['picture10']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture11'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture11'], $newDir . DS . $arrParam['form']['picture11']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture11'], $newDir . DS . $arrParam['form']['picture11']);
                }
                if(file_exists($oldDir . DS . $arrParam['form']['picture12'])){
                    $uploadObj->uploadNon($oldDir . DS . $arrParam['form']['picture12'], $newDir . DS . $arrParam['form']['picture12']);
                } else{
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture12'], $newDir . DS . $arrParam['form']['picture12']);
                }

                if($newDir != $oldDir)
                    $this->deleteFolder($oldDir);
                $this->deleteFolder($cacheDir);
               
                $arrParam['form']['modified']        = date('Y-m-d H:m:s', time());
                $arrParam['form']['modified_by']     = $_SESSION['user']['info']['username'];

                $this->_columns[] = 'modified';
                $this->_columns[] = 'modified_by';
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

                $this->update($data, array(array('id', $arrParam['form']['id'])));
                
                $names = "SELECT `id`, `names` FROM `".TBL_ORDER."` WHERE `names` LIKE '%".$result['name']."%'  ";
                $resultName = $this->fetchAll($names);
                 
                if($resultName != null){
                    foreach($resultName as $key => $value){
                        $updateName = str_replace($result['name'], $arrParam['form']['name'], $value['names']);
                        $update = "UPDATE `".TBL_ORDER."` SET `names` =  '".$updateName."' WHERE `id` = '".$value['id']."'";
                        $this->query($update);
                    }
                }

                $delete		= "DELETE FROM `".TBL_REQUEST."` WHERE `product_id` = " . $arrParam['id'];
                $this->query($delete);
                
                Session::set('message', array('class' => 'success', 'content' => 'Aprroved Successfully!'));

                return $arrParam['form']['id'];
            }

            if($option['task'] == 'add'){
                $arrParam['id'] = $arrParam['form']['id'];
                $this->setTable(TBL_PRODUCT);
                $_columns = array('id', 'name', 'description', 'picture1', 'picture2', 'picture3', 'picture4', 'picture5', 'picture6', 'picture7', 'picture8', 'picture9', 'picture10', 'picture11', 'picture12', 'status', 'created', 'created_by', 'designer_id', 'collection_id', 'category_id');


                require_once LIBRARY_EXT_PATH . 'Upload.php';
                $uploadObj = new Upload();


                $newDir		= UPLOAD_PATH . 'product' . DS . $arrParam['form']['name'];
                if(!file_exists($newDir)){
                    mkdir($newDir);
                }
                $cacheDir = UPLOAD_PATH . 'cache/add' . DS . $arrParam['form']['name'];

                if(file_exists($cacheDir . DS . $arrParam['form']['picture1'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture1'], $newDir . DS . $arrParam['form']['picture1']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture2'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture2'], $newDir . DS . $arrParam['form']['picture2']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture3'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture3'], $newDir . DS . $arrParam['form']['picture3']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture4'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture4'], $newDir . DS . $arrParam['form']['picture4']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture5'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture5'], $newDir . DS . $arrParam['form']['picture5']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture6'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture6'], $newDir . DS . $arrParam['form']['picture6']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture7'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture7'], $newDir . DS . $arrParam['form']['picture7']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture8'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture8'], $newDir . DS . $arrParam['form']['picture8']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture9'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture9'], $newDir . DS . $arrParam['form']['picture9']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture10'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture10'], $newDir . DS . $arrParam['form']['picture10']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture11'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture11'], $newDir . DS . $arrParam['form']['picture11']);
                }
                if(file_exists($cacheDir . DS . $arrParam['form']['picture12'])){
                    $uploadObj->uploadNon($cacheDir . DS . $arrParam['form']['picture12'], $newDir . DS . $arrParam['form']['picture12']);
                }
                $cacheDir;

                $this->deleteFolder($cacheDir);
                $arrParam['form']['status']         = 1;
                $arrParam['form']['sale_off']       = 0;
                $arrParam['form']['created']        = date('Y-m-d H:m:s', time());
                $arrParam['form']['created_by']     = $_SESSION['user']['info']['username'];
                $data = array_intersect_key($arrParam['form'], array_flip($_columns));

                $this->insert($data);

                $delete		= "DELETE FROM `".TBL_REQUEST."` WHERE `product_id` = " . $arrParam['product_id'];
                $this->query($delete);
                Session::set('message', array('class' => 'success', 'content' => 'Aprroved Successfully!'));

                return $arrParam['form']['id'];
            }

            if($option['task'] == 'deny'){
                $arrParam['id'] = $arrParam['form']['request'];

                $query = "SELECT `type` FROM " . $this->table . " WHERE `id` = " . $arrParam['id'];
                $type = $this->fetchRow($query);
                $cacheDir = UPLOAD_PATH . 'cache/' . $type['type'] . DS . $arrParam['form']['name'];

                $this->deleteFolder($cacheDir);


                $delete		= "DELETE FROM `".TBL_REQUEST."` WHERE `product_id` = " . $arrParam['product_id'];
                $this->query($delete);
                Session::set('message', array('class' => 'success', 'content' => 'Denied Successfully!'));

                return $arrParam['form']['id'];
            }
        }

        public function infoItem($arrParam, $option = null){
            if($option['task'] == 'old-item'){
                $query[] = "SELECT `p`.`id`, `p`.`description`, `p`.`picture1`, `p`.`picture2`, `p`.`picture3`, `p`.`picture4`, `p`.`picture5`, `p`.`picture6`, `p`.`picture7`, `p`.`picture8`, `p`.`picture9`, `p`.`picture10`, `p`.`picture11`, `p`.`picture12`, `p`.`description`, `p`.`name`, `p`.`collection_id`, `p`.`category_id`, `ca`.`name` AS `category_name`, `co`.`name` AS `collection_name` ";
                $query[] = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_CATEGORY."` AS `ca`, `".TBL_COLLECTION."` AS `co`";
                $query[] = "WHERE `p`.`id` = '" . $arrParam['product_id'] . "'";
                $query[] = "GROUP BY `name`";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }
            if($option['task'] == 'new-item'){
                $query[] = "SELECT `r`.`id`, `r`.`description`, `r`.`picture1`, `r`.`picture2`, `r`.`picture3`, `r`.`picture4`, `r`.`picture5`, `r`.`picture6`, `r`.`picture7`, `r`.`picture8`, `r`.`picture9`, `r`.`picture10`, `r`.`picture11`, `r`.`picture12`, `r`.`description`, `r`.`designer_id`, `r`.`name`, `r`.`collection_id`, `ca`.`name` AS `category_name`, `ca`.`id` AS `category_id`, `co`.`name` AS `collection_name`, `co`.`id` AS `collection_id`";
                $query[] = "FROM `".TBL_REQUEST."` AS `r`, `".TBL_CATEGORY."` AS `ca`, `".TBL_COLLECTION."` AS `co` ";
                $query[] = "WHERE `product_id` = '" . $arrParam['product_id'] . "' AND `r`.`collection_id` = `co`.`id` AND `r`.`category_id` = `ca`.`id`";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }

            if($option['task'] == 'info-user'){
                $query[] = "SELECT `email`, `fullname`";
                $query[] = "FROM `".TBL_USER."`  ";
                $query[] = "WHERE `designer_id` = '" . $arrParam['designer_id'] . "'";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }
        }

        private function deleteFolder($dir = null){
            if (is_dir($dir)) {
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
                        else unlink($dir."/".$object);
                    }
                }
                reset($objects);
                rmdir($dir);
            }
        }
    }
