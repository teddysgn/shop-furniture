<?php
class IndexModel extends Model {
    private $_columns = array('id', 'username', 'email', 'fullname', 'password', 'created' ,'created_by', 'modified', 'modified_by', 'status', 'group_id', 'ordering');

    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_USER);
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $username	= $arrParam['form']['username'];
            $password	= md5($arrParam['form']['password']);
            $query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`username`, `u`.`member_id`, `u`.`email`, `u`.`group_id`, `u`.`address`, `u`.`phone`, `g`.`group_acp`, `g`.`name`, `g`.`privilege_id`";
            $query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
            $query[]	= "WHERE `username` = '$username' AND `password` = '$password'";

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
            case 'register':
                $name = 'Created an account';
                break;
            case 'login':
                $name = 'Logged in Admin';
                break;
        }

        $time = date('Y-m-d H:i:s', time());

        $query  = "INSERT INTO `".TBL_NOTICE."` (`name`, `time`, `user_id`) VALUES ('$name', '$time', '$user_id')";

        $this->query($query);

    }
}
