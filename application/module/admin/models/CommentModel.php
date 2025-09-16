<?php
class CommentModel extends Model {
    private $_columns = array('id', 'name', 'content', 'date', 'status', 'product_id', 'user_id', 'modified', 'modified_by');
    private $_userInfo;
    public function __construct(){
        parent::__construct();

        $this->setTable(TBL_COMMENT);
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
            $query[]	= "AND `content` LIKE $keyword";
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
        $query[]    = "SELECT `c`.`id`, `c`.`content`, `c`.`status`, `c`.`date`, `c`.`status`, `p`.`picture1`, `p`.`name`, `u`.`fullname`,  `c`.`modified`,  `c`.`modified_by` ";
        $query[]    = "FROM `$this->table` AS `c`, `".TBL_USER."` AS `u`, `".TBL_PRODUCT."` AS `p` ";
        $query[]	= "WHERE `c`.`id` > 0";
        $query[]	= "AND `c`.`product_id` = `p`.`id` ";
        $query[]	= "AND `c`.`user_id` = `u`.`id` ";


        // FILTER: KEYWORD
        if(!empty($arrParams['filter_search'])) {
            $keyword	= '"%' . $arrParams['filter_search'] . '%"';
            $query[]	= "AND `c`.`content` LIKE $keyword";
        }

        // FILTER: STATUS
        if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
            $query[]	= "AND `c`.`status` = '" . $arrParams['filter_state'] . "'";
        }

        // SORT
        if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
            $comlumn = $arrParams['filter_column']; // name
            $comlumnDir = $arrParams['filter_column_dir']; // asc
            $query[] = "ORDER BY `$comlumn` $comlumnDir"; // ORDER BY `name` ASC
        } else {
            $query[] = "ORDER BY `c`.`id` DESC"; // ORDER BY `name` ASC
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
                'link'		=> URL::createLink('admin', 'comment', 'ajaxStatus', array('id' => $id, 'status' => $status))
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
}
