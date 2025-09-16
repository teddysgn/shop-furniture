<?php
class CostModel extends Model {
    private $_columns = array('id', 'name', 'value', 'date', 'created', 'created_by', 'modified', 'modified_by');
    private $_userInfo;
    public function __construct(){
        parent::__construct();

        $this->setTable(TBL_COST);
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
        $query[]    = "SELECT `id`, `name`, `value`, `date`, `created`, `created_by`, `modified`, `modified_by` ";
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
            $arrParam['form']['value'] = (int)str_replace(',', '', $arrParam['form']['value']);

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
            $arrParam['form']['value'] = (int)str_replace(',', '', $arrParam['form']['value']);

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
            $query[] = "SELECT `id`, `name`, `value`, `date` ";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
    }
}
