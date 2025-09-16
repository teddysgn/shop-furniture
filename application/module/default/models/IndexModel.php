<?php
class IndexModel extends Model {
    private $_columns = array('id', 'username', 'email', 'fullname', 'password', 'created' ,'created_by', 'modified', 'modified_by', 'status', 'group_id', 'ordering', 'register_date', 'register_ip');
    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_USER);
    }

    public function saveItem($arrParam, $option = null){
        if($option['task'] == 'user-register'){
            $arrParam['form']['register_date']  = date('Y-m-d H:m:s', time());
            $arrParam['form']['created']        = date('Y-m-d H:m:s', time());
            Session::set('password', $this->randomString(8)) ;
            $arrParam['form']['password']       = md5(Session::get('password'));
            $arrParam['form']['group_id']       = 2;
            $arrParam['form']['status']         = 0;
            $arrParam['form']['register_ip']    = $_SERVER['REMOTE_ADDR'];

            $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));



            $this->insert($data);
            return $this->lastID();
        }
            return $arrParam['form']['id'];
    }

    public function updateStatus($arrParam, $option = null){
        if($option['task'] == null){
            $query   = "UPDATE `$this->table` SET `status` = 1 WHERE `id` = $arrParam";
            $this->query($query);
        }

        if($option['task'] == 'reset'){
            $registerDate = date('Y-m-d H:m:s', time());
            $password = md5($_SESSION['password']);
            $query   = "UPDATE `$this->table` SET `status` = 0, `register_date` = '$registerDate', `password` = '$password' WHERE `id` = $arrParam";
            $this->query($query);
        }
    }

    public function totalItems($arrParam, $option = null){
        if($option['task'] == 'total-product'){
            $query   = "SELECT COUNT(`id`) AS `total`, COUNT(`view`) AS `view` FROM `product`";
            $this->query($query);
        }

        if($option['task'] == 'total-order'){
            $query   = "SELECT COUNT(`id`) AS `total` FROM `order`";
            $this->query($query);
        }

        if($option['task'] == 'total-user'){
            $query   = "SELECT COUNT(`id`) AS `total` FROM `user`";
            $this->query($query);
        }


        $result		= $this->fetchRow($query);
        return $result;
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $username	= $arrParam['form']['username'];
            $query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`username`, `u`.`register_date`, `u`.`email`, `u`.`member_id`, `u`.`address`, `u`.`phone`, `u`.`group_id`, `u`.`designer_id`,`g`.`group_acp`, `g`.`name`, `u`.`status`, `g`.`privilege_id`";
            $query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
            $query[]	= "WHERE `username` = '$username'";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);

            // Thực hiện phân quyền
            if($result['group_acp'] != 0) {
                // privilege_id = 1,2,3,4,5,6,7,8,9,10
                $arrPrivilge = explode(',', $result['privilege_id']);
                $strPrivilegeID = '';
                foreach($arrPrivilge as $privilegeID)
                    $strPrivilegeID .= "'$privilegeID', ";

                $queryP  = "SELECT `id`, CONCAT(`module`,'-',  `controller`, '-', `action`) AS `name` ";
                $queryP .= "FROM `" .TBL_PRIVELEGE."` AS `p` ";
                $queryP .= "WHERE `id` IN ($strPrivilegeID'0')";

                $result['privilege']		= $this->fetchPairs($queryP);
            }
        }

        if($option['task'] == 'check-mail-exist'){
            $email  	= $arrParam['form']['email'];
            $username  	= $arrParam['form']['username'];
            $query[]	= "SELECT `email`, `fullname`, `username` ";
            $query[]	= "FROM `user` ";
            $query[]	= "WHERE `email` = '$email' AND `username` = '$username'";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);

            }

        return $result;
    }

    public function listItems($arrParams, $option = null)
    {
        if($option['task'] == 'products-special') {
            $query[]    = "SELECT `id`, `name`, `picture1`, `description`, `price` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `special` = 1 AND `deleted` = 0";
            $query[]    = "ORDER BY `ordering` ASC "; // ORDER BY `name` ASC
            $query[]    = "LIMIT 0, 6 ";
        }

        if($option['task'] == 'get-picture'){
            $query[]	= "SELECT `picture1`, `name`";
            $query[]	= "FROM `".TBL_PRODUCT."`";
            $query[]	= "WHERE `status`  = 1 ";
            $query[]	= "ORDER BY RAND()";
            $query[]	= "LIMIT 0, 7";
        }

        $query   = implode(" ", $query);
        $result  = $this->fetchAll($query);

        return $result;
    }

    public function infoAccount($arrParam, $option = null){
        if($option == null){
            $email	= $arrParam['form']['email'];
            $password	= md5($arrParam['form']['password']);
            $query[]	= "SELECT `id`, `password`, `username`, `email`, `fullname` ";
            $query[]	= "FROM `user` ";
            $query[]	= "ORDER BY `id` DESC LIMIT 0, 1";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);

            return $result;
        }
    }

    public function randomString($length = 5){
        $arrCharacter = array_merge(range('a','z'), range(0,9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result		= substr($arrCharacter, 0, $length);
        return $result;
    }

    public function addNotice($arrParam, $option = null){
        $userObj     = Session::get('user');
        $userInfo    = $userObj['info'];

        $name = '';
        $user_id = $userInfo['id'];
        switch ($option['task']){
            case 'register':
                $name = 'Created an account';
                break;
            case 'login':
                $name = 'Logged';
                break;
        }

        $time = date('Y-m-d H:i:s', time());

        $query  = "INSERT INTO `".TBL_NOTICE."` (`name`, `time`, `user_id`) VALUES ('$name', '$time', '$user_id')";

        $this->query($query);

    }

}
