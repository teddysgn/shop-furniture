<?php
class UserModel extends Model {

    private $_columns = array('id', 'username', 'email', 'fullname', 'password', 'created' ,'created_by', 'modified', 'modified_by', 'status', 'group_id', 'ordering', 'register_date', 'register_ip', 'time', 'url', 'member_id', 'designer_id', );

    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_USER);
    }

    public function countItems($arrParams, $option = null)
    {
        $query[]    = "SELECT COUNT(`id`) AS `total`";
        $query[]    = "FROM `$this->table`";
        $query[]	= "WHERE `id` > 0";


        // FILTER: KEYWORD
        if(!empty($arrParams['filter_search'])) {
            $keyword	= '"%' . $arrParams['filter_search'] . '%"';
            $query[]	= "AND (`username` LIKE $keyword OR `email` LIKE $keyword)";
        }

        // FILTER: STATUS
        if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
            $query[]	= "AND `status` = '" . $arrParams['filter_state'] . "'";
        }

        // FILTER: GROUP_ID
        if(isset($arrParams['filter_group_id']) && $arrParams['filter_group_id'] != 'default') {
            $query[]	= "AND `group_id` = '" . $arrParams['filter_group_id'] . "'";
        }

        $query   = implode(" ", $query);
        $result  = $this->fetchRow($query);

        return $result['total'];
    }

    public function listItems($arrParams, $option = null)
    {
        // LEFT JOIN: kết 2 bảng với giá trị ON (Do một số user chưa có group_id)
        $query[]    = "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`fullname`, `u`.`status`, `u`.`ordering`, `u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `u`.`time`, `u`.`url`, `g`.`name` AS `group_name` ";
        $query[]    = "FROM `$this->table` AS `u` LEFT JOIN `" . TBL_GROUP . "` AS `g` ON `g`.`id` = `u`.`group_id` ";
        $query[]	= "WHERE `u`.`id` > 0";

        // FILTER: KEYWORD
        if(!empty($arrParams['filter_search'])) {
            $keyword	= '"%' . $arrParams['filter_search'] . '%"';
            $query[]	= "AND (`username` LIKE $keyword OR `email` LIKE $keyword)";
        }

        // FILTER: STATUS
        if(isset($arrParams['filter_state']) && $arrParams['filter_state'] != 'default') {
            $query[]	= "AND `u`.`status` = '" . $arrParams['filter_state'] . "'";
        }

        // FILTER: GROUP_ID
        if(isset($arrParams['filter_group_id']) && $arrParams['filter_group_id'] != 'default') {
            $query[]	= "AND `u`.`group_id` = '" . $arrParams['filter_group_id'] . "'";
        }

        // SORT
        if(!empty($arrParams['filter_column']) && !empty($arrParams['filter_column_dir'])) {
            $comlumn = $arrParams['filter_column']; // name
            $comlumnDir = $arrParams['filter_column_dir']; // asc
            $query[] = "ORDER BY `u`.`$comlumn` $comlumnDir"; // ORDER BY `name` ASC
        } else {
            $query[] = "ORDER BY `u`.`id` ASC"; // ORDER BY `name` ASC
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

    public function itemInSelectbox($arrParams, $option = null)
    {
        if($option == null) {
            $query    = "SELECT `id`, `name` FROM `" . TBL_GROUP . "`";
            $result     = $this->fetchPairs($query);
            $result['default'] = "Select Group";
            ksort($result);
        }
        return $result;
    }

    public function changeStatus($arrParam, $option = null){
        if($option['task'] == 'change-ajax-status'){
            $status = ($arrParam['status'] == 0) ? 1 : 0;
            $id		= $arrParam['id'];
            $query	= "UPDATE `$this->table` SET `status` = $status WHERE `id` = '" . $id . "'";
            $this->query($query);

            $result = array(
                'id'		=> $id,
                'status'	=> $status,
                'link'		=> URL::createLink('admin', 'user', 'ajaxStatus', array('id' => $id, 'status' => $status))
            );
            return $result;
        }

        if($option['task'] == 'change-status'){
            $status 	= $arrParam['type'];
            if(!empty($arrParam['cid'])){
                $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                $query		= "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() .' Elements updated Status Successfullu!'));
            } else {
                Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
            }
        }
    }

    public function deleteItem($arrParam, $option = null){
        if($option['task'] == null){
            if(!empty($arrParam['cid'])){
                $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                $this->query($query);

                foreach ($arrParam['cid'] as $key => $value){
                    $queryNotice = "DELETE FROM `".TBL_NOTICE."` WHERE `user_id` = $value";
                    $this->query($queryNotice);
                }
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows() . ' Elements Deleted Successfully!'));
            } else {
                Session::set('message', array('class' => 'error', 'content' => 'Select at least 1 Row'));
            }
        }
    }

    public function saveItem($arrParam, $option = null){
        $userObj     = Session::get('user');
        $userInfo    = $userObj['info'];
        if($option['task'] == 'add'){
            $arrParam['form']['created'] = date('Y-m-d H:i:s', time());
            $arrParam['form']['created_by'] = $userInfo['username'];
            $arrParam['form']['password'] = md5($arrParam['form']['password']);

            // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
            // array_flip(): Đâỏ ngược key vào value trong array
            $data = array_intersect_key( $arrParam['form'],array_flip($this->_columns));

            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Added Successfully!'));

            return $this->lastID();
        }

        if($option['task'] == 'edit'){
            // Không cho người dùng thay đổi giá trị username
            unset( $arrParam['form']['username']);
            $arrParam['form']['modified'] = date('Y-m-d H:i:s', time());
            $arrParam['form']['modified_by'] = $userInfo['username'];

            // Khi pass != null: Người dùng muốn thay đổi password
            if($arrParam['form']['password'] != null) {
                $arrParam['form']['password'] = md5($arrParam['form']['password']);
            } else {
                // Xóa password khỏi mảng $arrParam
                unset( $arrParam['form']['password']);
            }

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
            $query[] = "SELECT `id`, `username`, `email`, `fullname`, `group_id`, `status`, `ordering`, `address`, `phone` ";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";

            $query   = implode(" ", $query);
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
                Session::set('message', array('class' => 'success', 'content' => ' Update Ordering Successfullu!'));
            }
        }
    }

    public function infoPassword($arrParam, $option = null){
        if($option == null){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];
            $query[] = "SELECT `id`, `password` ";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `id` = '" . $userInfo['id'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
    }

    public function addNotice($arrParam, $option = null){
        $userObj     = Session::get('user');
        $userInfo    = $userObj['info'];

        $name = '';
        $user_id = $userInfo['id'];
        switch ($option['task']){
            case 'edit-profile':
                $name   = 'Updated your profile';
                break;
            case 'order':
                $name = 'Have just placed an order';
                break;
            case 'login':
                $name = 'Logged';
                break;
        }

        $time = date('Y-m-d H:i:s', time());

        $query  = "INSERT INTO `".TBL_NOTICE."` (`name`, `time`, `user_id`) VALUES ('$name', '$time', '$user_id')";

        $this->query($query);

    }

    public function infoNotice($option = null)
    {
        if ($option['task'] == null) {
            $userObj = Session::get('user');
            $userInfo = $userObj['info'];

            $user_id = $userInfo['id'];

            $query[] = "SELECT `name`, `time`, `user_id`  ";
            $query[] = "FROM `" . TBL_NOTICE . "`";
            $query[] = "WHERE `user_id` = " . $user_id . " AND `name` LIKE 'Logged%' OR `name` LIKE 'Updated your profile' ";
            $query[] = "ORDER BY `time` DESC";
            $query[] = "LIMIT 0, 10";

            $query = implode(" ", $query);
            $result = $this->fetchAll($query);

            return $result;
        }

        if ($option['task'] == 'recently') {
            $userObj = Session::get('user');
            $userInfo = $userObj['info'];

            $user_id = $userInfo['id'];

            $query[] = "SELECT `name`, `time`, `user_id`  ";
            $query[] = "FROM `" . TBL_NOTICE . "`";
            $query[] = "WHERE `user_id` = " . $user_id . " AND `name` LIKE '%order%'";
            $query[] = "ORDER BY `time` DESC";
            $query[] = "LIMIT 0, 5";

            $query = implode(" ", $query);
            $result = $this->fetchAll($query);

            return $result;
        }
    }
}
