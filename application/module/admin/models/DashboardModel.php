<?php
    class DashboardModel extends Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->setTable(TBL_DASHBOARD);
        }

        public function countItems($arrParams, $option = null)
        {
            //Total
            if($option['task'] == 'count-product'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `product`";
                $query[]	= "WHERE `id` > 0";
                $query[]	= "AND `status` = 1";
            }

            if($option['task'] == 'count-order'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> ''";
            }

            if($option['task'] == 'count-shipping'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `completed` = 0 OR `status` = 1 AND `completed` != 1";
            }

            if($option['task'] == 'count-shipped'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `completed` = 1";
            }

            if($option['task'] == 'sum-profit'){
                $query[]    = "SELECT SUM(`profit`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `cancel` = 0";
            }

            if($option['task'] == 'sum-revenue'){
                $query[]    = "SELECT SUM(`totalPrice`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `cancel` = 0";
            }

            // Month Selected
            if(isset($arrParams['week']) || isset($arrParams['month']) || isset($arrParams['year'])){
                if(isset($arrParams['week'])){
                    $interval = new DateInterval('P7D'); // Cộng thêm 2 ngày
                }
                if(isset($arrParams['month'])){
                    $interval = new DateInterval('P30D'); // Cộng thêm 2 ngày
                }
                if(isset($arrParams['year'])){
                    $interval = new DateInterval('P365D'); // Cộng thêm 2 ngày
                }

                $now = date('Y-m-d', time());
                $date = new DateTime($now);

                $fromDate = date_format(date_sub($date, $interval), 'Y-m-d');
                $toDate = date('Y-m-d H:i:s', time());

            } else {
                $fromDate = $arrParams['fromDate'];
                $toDate = $arrParams['toDate'];
            }

            if($option['task'] == 'month-product'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `product`";
                $query[]	= "WHERE `id` > 0 AND `created` BETWEEN '".$fromDate. ' 00:00:00'."' AND '".$toDate. ' 23:59:59'."'";
            }

            if($option['task'] == 'month-order'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '".$fromDate. ' 00:00:00'."' AND '".$toDate. ' 23:59:59'."'";
            }

            if($option['task'] == 'month-shipping'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '".$fromDate. ' 00:00:00'."' AND '".$toDate. ' 23:59:59'."' ";
                $query[]	= "AND `completed` = 0 OR `status` = 1 AND `completed` != 1";
            }

            if($option['task'] == 'month-shipped'){
                $query[]    = "SELECT COUNT(`id`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '".$fromDate. ' 00:00:00'."' AND '".$toDate. ' 23:59:59'."' ";
                $query[]	= "AND `completed` = 1 AND `cancel` = 0";
            }

            if($option['task'] == 'month-revenue'){
                $query[]    = "SELECT SUM(`totalPrice`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '".$fromDate. ' 00:00:00'."' AND '".$toDate. ' 23:59:59'."' AND `cancel` = 0";
            }

            if($option['task'] == 'month-profit'){
                $query[]    = "SELECT SUM(`profit`) AS `total`";
                $query[]    = "FROM `order`";
                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '".$fromDate. ' 00:00:00'."' AND '".$toDate. ' 23:59:59'."' AND `cancel` = 0";
            }



            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result['total'];
        }

        public function listItems($arrParams, $option = null)
        {
            $fromDate = date('Y-m-d', time()). ' 00:00:00';
            $toDate = date('Y-m-d', time()) . ' 23:59:59';

            if(isset($arrParams['week']) || isset($arrParams['month']) || isset($arrParams['year'])){
                if(isset($arrParams['week'])){
                    $interval = new DateInterval('P7D'); // Cộng thêm 2 ngày
                }
                if(isset($arrParams['month'])){
                    $interval = new DateInterval('P30D'); // Cộng thêm 2 ngày
                }
                if(isset($arrParams['year'])){
                    $interval = new DateInterval('P365D'); // Cộng thêm 2 ngày
                }

                $now = date('Y-m-d', time());
                $date = new DateTime($now);

                $fromDate = date_format(date_sub($date, $interval), 'Y-m-d');
                $toDate = date('Y-m-d H:i:s', time());

            } elseif(isset($arrParams['fromDate']) || isset($arrParams['toDate'])) {
                $fromDate = $arrParams['fromDate']. ' 00:00:00';
                $toDate = $arrParams['toDate']. ' 23:59:59';
            }

            if($option['task'] == 'get-cost-month'){
                $query[]    = "SELECT SUM(`value`) AS `value`, `date` ";
                $query[]    = "FROM `cost` ";
                $query[]	= "WHERE `date` BETWEEN DATE_FORMAT('$fromDate', '%Y-%m') AND DATE_FORMAT('$toDate', '%Y-%m')";
                $query[]	= "GROUP BY `date`";
                $query   = implode(" ", $query);
                $result  = $this->fetchCost($query);
            }

            if($option['task'] == 'get-cost-quarter'){
                $query[]    = "SELECT SUM(`value`) AS `value`, CONCAT(QUARTER(CONCAT(`date`, '-01')), '-', YEAR(CURDATE())) AS `date` ";
                $query[]    = "FROM `cost` ";
                $query[]	= "WHERE `id` <> '' AND QUARTER(CONCAT(`date`, '-01')) BETWEEN QUARTER(CONCAT(YEAR(CURDATE()), '-01-01 00:00:00')) AND QUARTER(CURDATE())";
                $query[]	= "GROUP BY QUARTER(CONCAT(`date`, '-01'))";
                $query   = implode(" ", $query);
                $result  = $this->fetchCost($query);
            }

            // Day
            if($option['task'] == 'day-revenue'){
                $query[]    = "SELECT DATE(`date`) AS `date`, SUM(`totalPrice`) AS `totalPrice`";
                $query[]    = "FROM `order` ";
                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '$fromDate' AND '$toDate' AND `cancel` = 0 GROUP BY DATE(`date`)";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Month
            if($option['task'] == 'month-revenue'){
                $query[]    = "SELECT DATE_FORMAT(`o`.`date`, '%Y-%m') AS `month`, SUM(`o`.`profit`)  AS `profit`, SUM(`o`.`totalPrice`) AS `totalPrice`";
                $query[]    = "FROM `order` AS `o`";
//                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '$fromDate' AND '$toDate' GROUP BY DATE_FORMAT(`date`, '%Y-%m')";
                $query[]	= "WHERE `o`.`id` <> '' ";
                $query[]	= " AND DATE_FORMAT(`o`.`date`, '%Y-%m') BETWEEN DATE_FORMAT('$fromDate', '%Y-%m') AND DATE_FORMAT('$toDate', '%Y-%m') AND `cancel` = 0";
                $query[]	= " GROUP BY DATE_FORMAT(`o`.`date`, '%Y-%m')";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Quarter
            if($option['task'] == 'quarter-revenue'){
                $query[]    = "SELECT QUARTER(CURDATE()) AS `current`, CONCAT(QUARTER(`date`), '-' , YEAR(`date`)) AS `quarter`, SUM(`profit`) AS `profit`, SUM(`totalPrice`) AS `totalPrice`";
                $query[]    = "FROM `order` ";
//                $query[]	= "WHERE `id` <> '' AND `date` BETWEEN '$fromDate' AND '$toDate' GROUP BY QUARTER(`date`)";
                $query[]	= "WHERE `id` <> '' AND QUARTER(`date`) BETWEEN QUARTER(CONCAT(YEAR(CURDATE()), '-01-01 00:00:00')) AND QUARTER(CURDATE()) GROUP BY QUARTER(`date`) AND `cancel` = 0";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Stock & Sold
            if($option['task'] == 'stock-sold'){
                $query[]    = "SELECT `id`, `stock`, `name`, `sold`  ";
                $query[]    = "FROM `product` ";
                $query[]    = "WHERE `sold` > 0 ";
                $query[]	= "ORDER BY `id`";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Category
            if($option['task'] == 'category-revenue'){
                $query[]    = "SELECT `c`.`name`, SUM(`p`.`sold`) AS `sold`, SUM(`p`.`sold` * `p`.`price`) AS `revenue` ";
                $query[]    = "FROM `category` AS `c`, `product` AS `p`  ";
                $query[]	= "WHERE `c`.`id` = `p`.`category_id` ";
                $query[]	= "GROUP BY `c`.`name` ";
                $query[]	= "ORDER BY `c`.`name` ";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Collection
            if($option['task'] == 'collection-revenue'){
                $query[]    = "SELECT `c`.`name`, SUM(`p`.`sold`) AS `sold`, SUM(`p`.`sold` * `p`.`price`) AS `revenue` ";
                $query[]    = "FROM `collection` AS `c`, `product` AS `p`  ";
                $query[]	= "WHERE `c`.`id` = `p`.`collection_id` AND `p`.`sold` * `p`.`price` > 0";
                $query[]	= "GROUP BY `c`.`name` ";
                $query[]	= "ORDER BY `c`.`name` ";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Customer
            if($option['task'] == 'get-customer'){
                $id = $arrParams['idProduct'];
                $query[]    = "SELECT `o`.`user_id`, SUM(`totalPrice`) AS `total`, `u`.`fullname`   ";
                $query[]    = "FROM `order` AS `o`, `user` AS `u` ";
                $query[]	= "WHERE `o`.`user_id` = `u`.`id`";
                $query[]	= "GROUP BY `o`.`user_id`";
                $query[]	= "ORDER BY `total` DESC";
                $query[]	= "LIMIT 0, 10";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }

            // Find Product by ID
            if($option['task'] == 'get-name'){
                $id = $arrParams['idProduct'];
                $query[]    = "SELECT `p`.`id`, `p`.`name`, `p`.`sold`, `p`.`stock`, `p`.`picture1`, `c`.`name` AS `collectionName`, `d`.`name` AS `designerName`   ";
                $query[]    = "FROM `product` AS `p`, `designer` AS `d`, `collection` AS `c`  ";
                $query[]	= "WHERE `p`.`id` = $id AND `p`.`collection_id` = `c`.`id` AND `d`.`id` = `p`.`designer_id`";
                $query   = implode(" ", $query);
                $result  = $this->fetchAll($query);
            }
            return $result;
        }
    }
