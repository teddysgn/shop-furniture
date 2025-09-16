<?php
class SkuModel extends Model {
    private $_columns = array('id', 'cost', 'quantity', 'date', 'created', 'created_by', 'barcode', 'product_id');
    private $_userInfo;
    public function __construct(){
        parent::__construct();

        $this->setTable(TBL_SKU);
        $userObj            = Session::get('user');
        $this->_userInfo    = $userObj['info'];
    }

    public function countItems($arrParams, $option = null)
    {
        $query[]    = "SELECT COUNT(`s`.`id`) AS `total`";
        $query[]    = "FROM `$this->table` AS `s`  ";
        $query[]	= "WHERE `s`.`id` > 0 ";

        // FILTER: KEYWORD
        if(!empty($arrParams['filter_search'])) {
            $keyword	= '"%' . $arrParams['filter_search'] . '%"';
            $query[]	= "AND `s`.`barcode` LIKE $keyword ";
        }
        $query   = implode(" ", $query);
        $result  = $this->fetchRow($query);

        return $result['total'];
    }

    public function listItems($arrParams, $option = null)
    {
        if($option == null){
            $query[]    = "SELECT `s`.`id`, `s`.`cost`, `s`.`quantity`, `s`.`barcode`, `s`.`date`, `s`.`product_id`, `s`.`created`, `s`.`created_by`, `p`.`name` ";
            $query[]    = "FROM `$this->table` AS `s`, `".TBL_PRODUCT."` AS `p` ";
            $query[]	= "WHERE `s`.`id` > 0 ";
            $query[]	= "AND `p`.`id` = `s`.`product_id` ";


            // FILTER: KEYWORD
            if(!empty($arrParams['filter_search'])) {
                $keyword	= '"%' . $arrParams['filter_search'] . '%"';
                $query[]	= "AND (`p`.`name` LIKE $keyword OR `s`.`barcode` LIKE $keyword)";
            }

            // SORT
            if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
                $comlumn    = $arrParams['filter_column']; // name
                $comlumnDir = $arrParams['filter_column_dir']; // asc
                $query[]    = "ORDER BY `$comlumn` $comlumnDir"; // ORDER BY `name` ASC
            } else {
                $query[]    = "ORDER BY `s`.`barcode` "; // ORDER BY `name` ASC
            }

            // PAGINATION
            $pagination = $arrParams['pagination'];
            $totalItemsPerPage = $pagination['totalItemsPerPage'];
            if($totalItemsPerPage > 0){
                $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                $query[]    = "LIMIT $position, $totalItemsPerPage";
            }
        }

        if($option['task'] == 'get-name-product'){
            $query[]    = "SELECT `name`, `id`";
            $query[]    = "FROM `".TBL_PRODUCT."`";
            $query[]	= "WHERE `status` = 1 ";
            $query[]    = "ORDER BY `name`";
        }

        $query   = implode(" ", $query);
        $result  = $this->fetchAll($query);

        return $result;
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
            $arrParam['form']['cost']      = (int)str_replace(',', '', $arrParam['form']['cost']);
            if($arrParam['form']['date'] == null)
                $arrParam['form']['date'] = date('Y-m-d', time());
            else
                $arrParam['form']['date'] = $arrParam['form']['date'];



            $arrParam['form']['product_id']	= $arrParam['form']['product'];

            $query[] = "SELECT `c`.`name`, `p`.`id`";
            $query[] = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_CATEGORY."` AS `c`";
            $query[] = "WHERE `p`.`category_id` = `c`.`id` AND `p`.`name` = '" . $arrParam['form']['product'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            $arrParam['form']['product_id'] = $result['id'];

            $queryUpdate[] = "UPDATE `".TBL_PRODUCT."`";
            $queryUpdate[] = "SET `stock` = `stock` + " . $arrParam['form']['quantity'];
            $queryUpdate[] = "WHERE `id` = " . $arrParam['form']['product_id'];

            $queryUpdate   = implode(" ", $queryUpdate);
            $this->query($queryUpdate);

            $category = substr($result['name'], 0, strpos($result['name'], 'oom') + 3);
            $cate = '';
            switch ($category){
                case 'Bedroom':
                    $cate = 'BR';
                    break;
                case 'Living Room':
                    $cate = 'LR';
                    break;
                case 'Dining Room':
                    $cate = 'DN';
                    break;
            }

            if($arrParam['form']['product_id'] < 10)
                $id = '00' . $arrParam['form']['product_id'];
            elseif($arrParam['form']['product_id'] < 100)
                $id = '0' . $arrParam['form']['product_id'];
            else
                $id = $arrParam['form']['product_id'];

            $date = str_replace('-', '', $arrParam['form']['date']);

            $arrParam['form']['barcode']	= 'SF-' . $cate . '-' . $id . '-' . $date;
            $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));

            $this->insert($data);

            Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));
            return $this->lastID();
        }
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $query[] = "SELECT `s`.`id`, `s`.`cost`, `s`.`quantity`, `s`.`barcode`, `s`.`date`, `s`.`product_id`, `p`.`name` ";
            $query[] = "FROM `$this->table` AS `s`, `".TBL_PRODUCT."` AS `p`";
            $query[] = "WHERE `s`.`id` = '" . $arrParam['id'] . "' AND `s`.`product_id` = `p`.`id`";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
    }
}
