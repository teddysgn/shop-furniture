<?php
    class ProductModel extends Model {
        private $_columns = array('id', 'name', 'special', 'description', 'stock', 'sold', 'price', 'sale_off', 'picture1', 'picture2' , 'picture3', 'picture4', 'picture5', 'picture6', 'picture7', 'picture8', 'picture9', 'picture10', 'picture11', 'picture12','created', 'created_by', 'modified', 'modified_by', 'status', 'ordering', 'category_id');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_PRODUCT);
            $userObj            = Session::get('user');
            $this->_userInfo    = $userObj['info'];
        }

        public function countItems($arrParams, $option = null)
        {
            if($option['task'] == null) {
                $cateID     = $arrParams['category_id'];

                $arrCategory = explode('-', $cateID);
                $strCategoryID = '';
                foreach($arrCategory as $categoryID)
                    $strCategoryID .= "'$categoryID', ";


                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `$this->table`";


                // FILTER: CHECKBOX
                if(!empty($arrParams['check'])) {
                    $cate = '';
                    foreach ($arrParams['check'] as $key => $value) {
                        $cate .= $value . ', ';
                    }
                    $query[]	= "WHERE `status` = 1 AND `category_id` IN ($cate'0')";
                } else {
                    $query[]	= "WHERE `status` = 1 AND `category_id` IN ($strCategoryID'0')";
                }

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND `name` LIKE $keyword";
                }

                // FILTET: PRICE
                if(!empty($arrParams['filter_price'])) {
                    $startPrice = intval(explode('-', $arrParams['filter_price'])[0]) * 1000000;
                    $endPrice   = intval(explode('-', $arrParams['filter_price'])[1]) * 1000000;
                    $query[]	= "AND `price` BETWEEN $startPrice AND $endPrice";
                }
                
                $query[]	= "AND `deleted` = 0";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);
            }

            if($option['task'] == 'products-in-collection') {
                $collectionID     = $arrParams['collection_id'];

                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `$this->table`";
                $query[]	= "WHERE `status` = 1 AND `collection_id` = $collectionID AND `deleted` = 0";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);
            }

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            if($option['task'] == 'product-in-category') {
                $cateID     = $arrParams['category_id'];

                $arrCategory = explode('-', $cateID);
                $strCategoryID = '';
                foreach($arrCategory as $categoryID)
                    $strCategoryID .= "'$categoryID', ";


                $query[]    = "SELECT `id`, `name`, `picture1`, `stock`, `sold`, `price`, `sale_off` ";
                $query[]    = "FROM `$this->table`";


                // FILTER: CHECKBOX
                if(!empty($arrParams['check'])) {
                    $cate = '';
                    foreach ($arrParams['check'] as $key => $value) {
                        $cate .= $value . ', ';
                    }
                    $query[]	= "WHERE `status` = 1 AND `category_id` IN ($cate'0')";
                } else {
                    $query[]	= "WHERE `status` = 1 AND `category_id` IN ($strCategoryID'0')";
                }

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND `name` LIKE $keyword";
                }


                // FILTET: PRICE
                if(!empty($arrParams['filter_price'])) {
                    $startPrice = intval(explode('-', $arrParams['filter_price'])[0]) * 1000000;
                    $endPrice   = intval(explode('-', $arrParams['filter_price'])[1]) * 1000000;
                    $query[]	= "AND `price` BETWEEN $startPrice AND $endPrice";
                }
                
                $query[]	= "AND `deleted` = 0";

                // PAGINATION
                $pagination = $arrParams['pagination'];
                $totalItemsPerPage = $pagination['totalItemsPerPage'];
                if($totalItemsPerPage > 0){
                    $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                    $query[]    = "LIMIT $position, $totalItemsPerPage";
                }
            }

            if($option['task'] == 'product-in-collection') {
                $collectionID     = $arrParams['collection_id'];

                $query[]    = "SELECT `p`.`id`, `p`.`name`, `p`.`picture1`, `p`.`description`, `p`.`stock`, `p`.`sold`, `p`.`price`, `p`.`sale_off`, `p`.`category_id`, `c`.`name` AS `category_name` ";
                $query[]    = "FROM `$this->table` AS `p`, `".TBL_CATEGORY."` AS `c`";
                $query[]	= "WHERE `p`.`status` = 1 AND `p`.`collection_id` = $collectionID AND `p`.`category_id` = `c`.`id` AND `p`.`deleted` = 0";
                $query[]	= "GROUP BY `p`.`id`";

                // PAGINATION
                $pagination = $arrParams['pagination'];
                $totalItemsPerPage = $pagination['totalItemsPerPage'];
                if($totalItemsPerPage > 0){
                    $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                    $query[]    = "LIMIT $position, $totalItemsPerPage";
                }
            }

            if($option['task'] == 'product-related'){
                $productID  = $arrParams['product_id'];
                $queryCate	= "SELECT `category_id` FROM `".TBL_PRODUCT."` WHERE id = '$productID'";
                $resultCate	= $this->fetchRow($queryCate);
                $catID		= $resultCate['category_id'];

                $query[]	= "SELECT `id`, `name`, `picture1`";
                $query[]	= "FROM `$this->table`";
                $query[]	= "WHERE `status`  = 1 AND `category_id` = '$catID' AND `id` <> '$productID' AND `deleted` = 0";
                $query[]	= "ORDER BY RAND()";
                $query[]	= "LIMIT 0, 6";
            }

            if($option['task'] == 'product-collection'){
                $productID      = $arrParams['product_id'];
                $queryCate	    = "SELECT `collection_id` FROM `".TBL_PRODUCT."` WHERE id = '$productID'";
                $resultCate	    = $this->fetchRow($queryCate);
                $collectionID	= $resultCate['collection_id'];

                $query[]	= "SELECT `id`, `name`, `picture1`";
                $query[]	= "FROM `$this->table`";
                $query[]	= "WHERE `status`  = 1 AND `collection_id` = '$collectionID' AND `id` <> '$productID' AND `deleted` = 0";
                $query[]	= "ORDER BY RAND()";
                $query[]	= "LIMIT 0, 6";
            }

            if($option['task'] == 'get-name-product'){
                $cateID     = $arrParams['category_id'];

                $arrCategory = explode('-', $cateID);
                $strCategoryID = '';
                foreach($arrCategory as $categoryID)
                    $strCategoryID .= "'$categoryID', ";


                $query[]    = "SELECT `name`";
                $query[]    = "FROM `$this->table`";
                $query[]	= "WHERE `status` = 1 AND `category_id` IN ($strCategoryID'0') AND `deleted` = 0";
                $query[]    = "ORDER BY `view`";
                $query[]    = "LIMIT 0, 10";
            }

            if($option['task'] == 'get-name-product-collection'){
                $collectionID     = $arrParams['collection_id'];

                $query[]    = "SELECT `name`";
                $query[]    = "FROM `$this->table`";
                $query[]	= "WHERE `status` = 1 AND `collection_id` = $collectionID AND `deleted` = 0";
                $query[]    = "ORDER BY `view`";
            }

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);
            return $result;
        }

        public function infoItems($arrParam, $option = null){
            if($option['task'] == 'get-category-name'){
                $cateID     = $arrParam['category_id'];

                $arrCategory = explode('-', $cateID);
                $strCategoryID = '';
                foreach($arrCategory as $categoryID)
                    $strCategoryID .= "'$categoryID', ";

                $query[] = "SELECT `id`, `name` ";
                $query[] = "FROM `".TBL_CATEGORY."`";
                $query[] = "WHERE `id` IN ($strCategoryID'0')";

                $query   = implode(" ", $query);
                $result  = $this->fetchPairs($query);

                return $result;
            }

            if($option['task'] == 'get-collection-name'){
                $collectionID     = $arrParam['collection_id'];

                $query[] = "SELECT `id`, `name`, `description` ";
                $query[] = "FROM `".TBL_COLLECTION."`";
                $query[] = "WHERE `id` = $collectionID";

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);

                return $result;
            }

            if($option['task'] == 'product-info'){
                $query	 = "SELECT `p`.`id`, `p`.`name`, `p`.`price`, `p`.`sale_off`, `p`.`picture1`, `p`.`picture2`, `p`.`picture3`, `p`.`picture4`, `p`.`picture5`, `p`.`picture6`, `p`.`picture7`, `p`.`picture8`, `p`.`picture9`, `p`.`picture10`, `p`.`picture11`, `p`.`picture12`, `p`.`description`, `p`.`stock`, `p`.`sold`, `p`.`view`, `p`.`collection_id`, `p`.`designer_id`, `d`.`name` AS `designer_name`,  `d`.`picture_profile`, `d`.`comment`, `c`.`name` AS `collection_name`, `c`.`description` AS `collection_description`";
                $query	.= "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_DESIGNER."` AS `d`, `".TBL_COLLECTION."` AS `c` ";
                $query	.= "WHERE `p`.`id` = '" . $arrParam['product_id'] . "'";
                $query	.= "AND `p`.`designer_id` = `d`.`id`";
                $query	.= "AND `p`.`collection_id` = `c`.`id`";
                $query	.= "AND `p`.`deleted` = 0";
                $result	= $this->fetchRow($query);
                return $result;
            }


        }

        public function updateView($arrParam, $option = null){
            if($option['task'] == null){
                $product_id =  $arrParam['product_id'];

                $view = "SELECT `view` FROM `$this->table` WHERE `id` = $product_id";
                $result = $this->fetchRow($view);

                $item = $result['view'];

                $query   = "UPDATE `$this->table` SET `view` = $item + 1 WHERE `id` = $product_id";
                $this->query($query);
            }
        }

        public function favorite($arrParam, $option = null){
            if($option['task'] == 'add-favorite'){
                $product_id         =  $arrParam['product_id'];
                $user_id            =  $arrParam['user_id'];
                $category_name      =  $arrParam['category_name'];
                $favorite_id        =  $arrParam['favorite_id'];

                if($arrParam['favorite'] == 1)
                    $favorite = "INSERT INTO `".TBL_FAVORITE."` (`product_id`, `user_id`) VALUES(".$product_id.", ".$user_id.")";
                else
                    $favorite = "DELETE FROM `".TBL_FAVORITE."` WHERE `id` = $favorite_id";

                $this->query($favorite);
                header('location: '.$category_name);
            }
            
            if($option['task'] == 'info-favorite'){
                $user_id            =  $_SESSION['user']['info']['id'];

                $info = "SELECT `id`, `product_id` FROM `".TBL_FAVORITE."` WHERE `user_id` = ".$user_id."";

                $result = $this->fetchAll($info);

                return $result;
            }
        }
        
        public function comment($arrParam, $option = null){
            if($option['task'] == 'add-comment'){
                $this->_columns = array('name', 'product_id', 'user_id', 'content', 'date', 'status');
                $this->setTable(TBL_COMMENT);
                $arrParam['form']['product_id']         =  $arrParam['form']['id'];
                $arrParam['form']['user_id']            =  $_SESSION['user']['info']['id'];
                $arrParam['form']['content']            =  $arrParam['form']['comment'];
                $arrParam['form']['status']             =  1;
                $arrParam['form']['date']	            = date('Y-m-d H:i:s', time());
                $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->insert($data);

                Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));
                
                return $arrParam['form']['product_id'];
            }
            
            if($option['task'] == 'check-in-order'){
                $this->_columns = array('name', 'product_id', 'user_id', 'content', 'date', 'status');
                $this->setTable(TBL_ORDER);
          
                $id = $arrParam['product_id'];
                
                $query[] = "SELECT `id`, `products` ";
                $query[] = "FROM `".$this->table."` ";
                $query[] = "WHERE `products` LIKE '%\"".$id."\"%'";
                $query[] = "AND `user_id` = " . $_SESSION['user']['info']['id'];
                
                $query		= implode(" ", $query);
                $result		= $this->fetchAll($query);
                
                return $result;
            }
            
            if($option['task'] == 'get-comment'){
                $query[]    = "SELECT `c`.`id`, `c`.`content`, `c`.`date`, `c`.`product_id`, `c`.`user_id`, `u`.`fullname` ";
                $query[]    = "FROM `".TBL_COMMENT."` AS `c`, `".TBL_USER."` AS `u`";
                $query[]    = "WHERE `u`.`id` = `c`.`user_id` AND `c`.`product_id` = " . $arrParam['product_id'] . " AND `c`.`status` = 1";
                $query[]    = "ORDER BY `date`";
                $query[]    = "LIMIT 0, 5";
                
                $query		= implode(" ", $query);
                $result		= $this->fetchAll($query);

                return $result;
            }
        }
    }
