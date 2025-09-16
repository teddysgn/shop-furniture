<?php
class UserModel extends Model {
    private $_columns = array('id', 'name', 'description', 'maxim', 'about', 'comment', 'picture_profile', 'picture_background', 'picture1', 'picture2', 'picture3' ,'picture4', 'modified', 'modified_by');
    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_DESIGNER);
    }

    public function saveItem($arrParam, $option = null){
        if($option['task'] == 'update-profile'){
            $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();
            $arrParam['form']['description']    = mysqli_real_escape_string($links, trim($arrParam['form']['description']));
            $arrParam['form']['about']          = mysqli_real_escape_string($links, trim($arrParam['form']['about']));
            $arrParam['form']['modified']       = date('Y-m-d H:i:s', time());
            $arrParam['form']['modified_by']    = $_SESSION['user']['info']['username'];

            if($_FILES['picture_profile']['name'] != null){
                $uploadObj->removeFile('designer/'.$arrParam['form']['upload_name'], $arrParam['form']['hidden_profile']);
                $arrParam['form']['picture_profile']	= $uploadObj->uploadFile($_FILES['picture_profile'], 'designer/'.$arrParam['form']['upload_name']);
            }
            if($_FILES['picture_background']['name'] != null){
                $uploadObj->removeFile('designer/'.$arrParam['form']['upload_name'], $arrParam['form']['hidden_background']);
                $arrParam['form']['picture_background']	= $uploadObj->uploadFile($_FILES['picture_background'], 'designer/'.$arrParam['form']['upload_name']);
            }
            if($_FILES['picture1']['name'] != null){
                $uploadObj->removeFile('designer/'.$arrParam['form']['upload_name'], $arrParam['form']['hidden_picture1']);
                $arrParam['form']['picture1']	= $uploadObj->uploadFile($_FILES['picture1'], 'designer/'.$arrParam['form']['upload_name']);
            }
            if($_FILES['picture2']['name'] != null){
                $uploadObj->removeFile('designer/'.$arrParam['form']['upload_name'], $arrParam['form']['hidden_picture2']);
                $arrParam['form']['picture2']	= $uploadObj->uploadFile($_FILES['picture2'], 'designer/'.$arrParam['form']['upload_name']);
            }
            if($_FILES['picture3']['name'] != null){
                $uploadObj->removeFile('designer/'.$arrParam['form']['upload_name'], $arrParam['form']['hidden_picture3']);
                $arrParam['form']['picture3']	= $uploadObj->uploadFile($_FILES['picture3'], 'designer/'.$arrParam['form']['upload_name']);
            }
            if($_FILES['picture4']['name'] != null){
                $uploadObj->removeFile('designer/'.$arrParam['form']['upload_name'], $arrParam['form']['hidden_picture4']);
                $arrParam['form']['picture4']	= $uploadObj->uploadFile($_FILES['picture4'], 'designer/'.$arrParam['form']['upload_name']);
            }
            if($arrParam['form'] != $arrParam['form']['upload_name']){
               rename(UPLOAD_PATH . 'designer/'.$arrParam['form']['upload_name'], UPLOAD_PATH . 'designer/'.$arrParam['form']['name']);
            }


            // Designer
            // array_intersect_key(): Lấy những phần tử vừa tồn tại trong array 1, vừa tồn tại trong array 2
            // array_flip(): Đâỏ ngược key vào value trong array
            $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));


            // User
            $this->setTable(TBL_USER);
            $_columns = array('id', 'email', 'phone', 'address', 'password', 'modified', 'modified_by');
            $data = array_intersect_key($arrParam['form'],array_flip($_columns));
            $this->update($data, array(array('id', $arrParam['form']['user_id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Updated Successfully!'));


        }

        if($option['task'] == 'change-password'){
            // User
            $this->setTable(TBL_USER);
            $arrParam['form']['modified']       = date('Y-m-d H:i:s', time());
            $arrParam['form']['modified_by']    = $_SESSION['user']['info']['username'];
            $arrParam['form']['password']       = md5($arrParam['form']['new_password']);
            $_columns = array('password', 'id', 'modified', 'modified_by');

            $data = array_intersect_key($arrParam['form'],array_flip($_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Updated Successfully!'));

        }

        return $arrParam['form']['id'];
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $username	= $arrParam['form']['username'];
            $query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`username`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`, `g`.`name`, `u`.`status`, `g`.`privilege_id`, `designer_id` ";
            $query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
            $query[]	= "WHERE `username` = '$username'";

            $query		= implode(" ", $query);


            $result		= $this->fetchRow($query);

            // Thực hiện phân quyền
            if($result['group_acp'] == 2) {

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

        if($option['task'] == 'info-account'){
            $id     = $arrParam['id'];

            $query[]    = "SELECT `d`.`id`, `d`.`name`, `d`.`description`, `d`.`about`, `d`.`maxim`, `d`.`comment`, `d`.`picture_profile`, `d`.`picture_background`, `d`.`picture1`, `d`.`picture2`, `d`.`picture3`, `d`.`picture4`, `u`.`email`, `u`.`phone`, `u`.`address`, `u`.`id` AS `user_id` ";
            $query[]    = "FROM `".TBL_DESIGNER."` as `d`, `".TBL_USER."` AS `u` ";
            $query[]	= "WHERE `d`.`id` = $id AND `u`.`designer_id` = `d`.`id`";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
        }

        return $result;
    }

    public function infoPassword($arrParam, $option = null){
        if($option == null){
            $userObj     = Session::get('user');
            $userInfo    = $userObj['info'];
            $query[] = "SELECT `id`, `password` ";
            $query[] = "FROM `".TBL_USER."`";
            $query[] = "WHERE `id` = '" . $userInfo['id'] . "'";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
    }

}
