<?php
    class DesignerModel extends Model {
        private $_columns = array('id', 'name', 'description', 'about', 'maxim', 'picture_profile', 'picture_background', 'picture1', 'picture2', 'picture3', 'picture4', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');
        private $_userInfo;
        public function __construct(){
            parent::__construct();

            $this->setTable(TBL_DESIGNER);
            $userObj            = Session::get('user');
            $this->_userInfo    = $userObj['info'];
        }

        public function countItems($arrParams, $option = null)
        {
            if($option['task'] == null) {
                $designerID     = $arrParams['designer_id'];

                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `".TBL_PRODUCT."`";
                $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID";

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

                $query   = implode(" ", $query);
                $result  = $this->fetchRow($query);
            }

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            if($option['task'] == null) {
                $query[]    = "SELECT `id`, `name`, `comment`, `picture_profile` ";
                $query[]    = "FROM `$this->table` ";
                $query[]    = "WHERE `status` = 1 ";
            }

            if($option['task'] == 'get-name-product'){
                $designerID     = $arrParams['designer_id'];

                $query[]    = "SELECT `name`";
                $query[]    = "FROM `".TBL_PRODUCT."` ";
                $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID ";
                $query[]    = "ORDER BY `view`";
            }

            if($option['task'] == 'product-in-designer') {
                $designerID     = $arrParams['designer_id'];
                $query[]        = "SELECT `p`.`id`, `p`.`name`, `p`.`picture1`, `p`.`description`, `p`.`stock`, `p`.`sold`, `p`.`price`, `p`.`sale_off`, `c`.`name` AS `category_name` ";
                $query[]        = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_CATEGORY."` AS `c` ";
                $query[]	    = "WHERE `p`.`status` = 1 AND `p`.`designer_id` = $designerID";
                $query[]	    = "AND `p`.`category_id` = `c`.`id`";

                // FILTER: KEYWORD
                if(!empty($arrParams['filter_search'])) {
                    $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                    $query[]	= "AND `p`.`name` LIKE $keyword";
                }

                // FILTET: PRICE
                if(!empty($arrParams['filter_price'])) {
                    $startPrice = intval(explode('-', $arrParams['filter_price'])[0]) * 1000000;
                    $endPrice   = intval(explode('-', $arrParams['filter_price'])[1]) * 1000000;
                    $query[]	= "AND `p`.`price` BETWEEN $startPrice AND $endPrice";
                }

                // PAGINATION
                $pagination = $arrParams['pagination'];
                $totalItemsPerPage = $pagination['totalItemsPerPage'];
                if($totalItemsPerPage > 0){
                    $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                    $query[]    = "LIMIT $position, $totalItemsPerPage";
                }
            }

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);

            return $result;
        }

        public function infoItems($arrParam, $option = null){
            if($option['task'] == 'get-designer-name'){
                $designerID     = $arrParam['designer_id'];

                $query[] = "SELECT `id`, `name` ";
                $query[] = "FROM `".TBL_DESIGNER."`";
                $query[] = "WHERE `id` = $designerID";

                $query   = implode(" ", $query);
                $result  = $this->fetchPairs($query);

                return $result;
            }

            if($option['task'] == 'designer-info'){
                $query	= "SELECT `id`, `name`, `picture_profile`, `picture_background`, `picture1`, `picture2`, `picture3`, `picture4`, `description`, `about`, `maxim` FROM `".TBL_DESIGNER."` WHERE `id` = '" . $arrParam['designer_id'] . "'";
                $result	= $this->fetchRow($query);
                return $result;
            }
        }
    }
