<?php
class IndexModel extends Model {
    private $_columns = array('id', 'name', 'description', 'picture1', 'picture2', 'picture3' ,'picture4', 'picture5', 'picture6', 'picture7', 'picture8', 'picture9', 'picture10', 'picture11', 'picture12', 'date', 'type', 'product_id', 'designer_id', 'collection_id', 'category_id');
    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_REQUEST);
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $username	= $arrParam['form']['username'];
            $query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`username`, `u`.`register_date`, `u`.`email`, `u`.`member_id`, `u`.`address`, `u`.`phone`, `u`.`group_id`, `g`.`group_acp`, `g`.`name`, `u`.`status`, `g`.`privilege_id`, `designer_id` ";
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

        if($option['task'] == 'view-product') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $query[]    = "SELECT `id`, `name`, `picture1` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID";
            $query[]    = "ORDER BY `view` DESC "; // ORDER BY `name` ASC
            $query[]    = "LIMIT 0, 1 ";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
        }

        if($option['task'] == 'in-process') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $query[]    = "SELECT `r`.`id`, `p`.`name`, `r`.`type`, `p`.`picture1`";
            $query[]    = "FROM `".TBL_REQUEST."` AS `r`, ".TBL_PRODUCT." AS `p` ";
            $query[]	= "WHERE `r`.`designer_id` = $designerID AND `r`.`picture1` <> '' AND `r`.`product_id` = `p`.`id`";
            $query[]    = "LIMIT 0, 1 ";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
        }

        if($option['task'] == 'info-product'){
            $designerID = $_SESSION['user']['info']['designer_id'];
            $productID     = $arrParam['product_id'];

            $query[]    = "SELECT `p`.`id`, `p`.`name`, `p`.`collection_id`, `p`.`category_id`, `p`.`picture1`, `p`.`picture2`, `p`.`picture3`, `p`.`picture4`, `p`.`picture5`, `p`.`picture6`, `p`.`picture7`, `p`.`picture8`, `p`.`picture9`, `p`.`picture10`, `p`.`picture11`, `p`.`picture12`, `p`.`description`, `p`.`description` ";
            $query[]    = "FROM `".TBL_PRODUCT."` as `p` ";
            $query[]	= "WHERE `p`.`id` = $productID ";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
        }

        if($option['task'] == 'info-request'){
            $designerID = $_SESSION['user']['info']['designer_id'];
            $productID     = $arrParam['product_id'];

            $query[]    = "SELECT `id`, `name`, `product_id`, `type` ";
            $query[]    = "FROM `".TBL_REQUEST."` ";
            $query[]	= "WHERE `designer_id` = $designerID AND `product_id` = $productID ";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
        }

        if($option['task'] == 'get-old-item'){
            $query[] = "SELECT `p`.`id`, `p`.`description`, `p`.`picture1`, `p`.`picture2`, `p`.`picture3`, `p`.`picture4`, `p`.`picture5`, `p`.`picture6`, `p`.`picture7`, `p`.`picture8`, `p`.`picture9`, `p`.`picture10`, `p`.`picture11`, `p`.`picture12`, `p`.`description`, `p`.`name`, `p`.`collection_id`, `p`.`category_id`, `ca`.`name` AS `category_name`, `co`.`name` AS `collection_name` ";
            $query[] = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_CATEGORY."` AS `ca`, `".TBL_COLLECTION."` AS `co`";
            $query[] = "WHERE `p`.`id` = '" . $arrParam['product_id'] . "' AND `p`.`collection_id` = `co`.`id` AND `p`.`category_id` = `ca`.`id`";
            $query[] = "GROUP BY `p`.`name`";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }
        if($option['task'] == 'get-new-item'){
            $query[] = "SELECT `r`.`id`, `r`.`product_id` AS `product_id`, `r`.`name`, `r`.`type`, `r`.`description`, `r`.`picture1`, `r`.`picture2`, `r`.`picture3`, `r`.`picture4`, `r`.`picture5`, `r`.`picture6`, `r`.`picture7`, `r`.`picture8`, `r`.`picture9`, `r`.`picture10`, `r`.`picture11`, `r`.`picture12`, `r`.`description`, `r`.`designer_id`, `r`.`name`, `r`.`collection_id`, `ca`.`name` AS `category_name`, `ca`.`id` AS `category_id`, `co`.`name` AS `collection_name`, `co`.`id` AS `collection_id`";
            $query[] = "FROM `".TBL_REQUEST."` AS `r`, `".TBL_CATEGORY."` AS `ca`, `".TBL_COLLECTION."` AS `co`, `".TBL_PRODUCT."` AS `p` ";
            $query[] = "WHERE `r`.`collection_id` = `co`.`id` AND `r`.`category_id` = `ca`.`id` AND `type` = '".$arrParam['type']."'";

            if(isset($arrParam['product_id']) && $arrParam['type'] != 'add')
                 $query[] = "AND `p`.`id` = '" . $arrParam['product_id'] . "' AND `r`.`product_id` =  `p`.`id` ";

            $query   = implode(" ", $query);
            $result  = $this->fetchRow($query);

            return $result;
        }

        if($option['task'] == 'related-product'){
            $designerID = $_SESSION['user']['info']['designer_id'];
            $productID     = $arrParam['product_id'];

            $query[]    = "SELECT `id`, `name`, `picture1`, `picture2` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `designer_id` = $designerID AND `id` <> $productID  ";
            $query[]	= "GROUP BY `id`";
            $query[]    = "ORDER BY RAND() ";
            $query[]    = "LIMIT 0, 8 ";

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);
        }
        return $result;
    }

    public function submitRequest($arrParam, $option = null){
        $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
        if($option['task'] == 'edit'){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();

            $uploadDir		= UPLOAD_PATH . 'cache/edit' . DS . $arrParam['form']['name'];
            if(!file_exists($uploadDir)){
                mkdir($uploadDir);
            }

            $picture1	                        = $_FILES['picture1'];
            $picture2	                        = $_FILES['picture2'];
            $picture3	                        = $_FILES['picture3'];
            $picture4	                        = $_FILES['picture4'];
            $picture5	                        = $_FILES['picture5'];
            $picture6	                        = $_FILES['picture6'];
            $picture7	                        = $_FILES['picture7'];
            $picture8	                        = $_FILES['picture8'];
            $picture9	                        = $_FILES['picture9'];
            $picture10	                        = $_FILES['picture10'];
            $picture11	                        = $_FILES['picture11'];
            $picture12	                        = $_FILES['picture12'];
            $arrParam['form']['designer_id']	= $_SESSION['user']['info']['designer_id'];
            $arrParam['form']['date']	        = date('Y-m-d H:i:s', time());
            $arrParam['form']['product_id']	    = $arrParam['product_id'];

            $productID      = $arrParam['product_id'];
            $existRequest	= "SELECT `name`, `product_id`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `picture6`, `picture7`, `picture8`, `picture9`, `picture10`, `picture11`, `picture12` FROM `".TBL_REQUEST."` WHERE `product_id` = $productID AND `type` = 'edit'";

            $resultRequest	= $this->fetchRow($existRequest);

            if($resultRequest['product_id'] == null){
                $arrParam['form']['picture1']   = $uploadObj->uploadFile($picture1, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture2']   = $uploadObj->uploadFile($picture2, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture3']   = $uploadObj->uploadFile($picture3, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture4']   = $uploadObj->uploadFile($picture4, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture5']   = $uploadObj->uploadFile($picture5, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture6']   = $uploadObj->uploadFile($picture6, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture7']   = $uploadObj->uploadFile($picture7, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture8']   = $uploadObj->uploadFile($picture8, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture9']   = $uploadObj->uploadFile($picture9, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture10']  = $uploadObj->uploadFile($picture10, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture11']  = $uploadObj->uploadFile($picture11, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['picture12']  = $uploadObj->uploadFile($picture12, 'cache/edit/' . $arrParam['form']['name']);
                $arrParam['form']['type']       = 'edit';
                $arrParam['form']['description']    = mysqli_real_escape_string($links, $arrParam['form']['description']);

                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->insert($data);


            }else {
                if($picture1['name'] == null){
                    unset($arrParam['form']['picture1']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture1']);
                    $arrParam['form']['picture1']	= $uploadObj->uploadFile($picture1, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture2['name'] == null){
                    unset($arrParam['form']['picture2']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture2']);
                    $arrParam['form']['picture2']	= $uploadObj->uploadFile($picture2, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture3['name'] == null){
                    unset($arrParam['form']['picture3']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture3']);
                    $arrParam['form']['picture3']	= $uploadObj->uploadFile($picture3, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture4['name'] == null){
                    unset($arrParam['form']['picture4']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture4']);
                    $arrParam['form']['picture4']	= $uploadObj->uploadFile($picture4, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture5['name'] == null){
                    unset($arrParam['form']['picture5']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture5']);
                    $arrParam['form']['picture5']	= $uploadObj->uploadFile($picture5, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture6['name'] == null){
                    unset($arrParam['form']['picture6']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture6']);
                    $arrParam['form']['picture6']	= $uploadObj->uploadFile($picture6, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture7['name'] == null){
                    unset($arrParam['form']['picture7']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture7']);
                    $arrParam['form']['picture7']	= $uploadObj->uploadFile($picture7, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture8['name'] == null){
                    unset($arrParam['form']['picture8']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture8']);
                    $arrParam['form']['picture8']	= $uploadObj->uploadFile($picture8, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture9['name'] == null){
                    unset($arrParam['form']['picture9']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture9']);
                    $arrParam['form']['picture9']	= $uploadObj->uploadFile($picture9, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture10['name'] == null){
                    unset($arrParam['form']['picture10']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $arrParam['form']['picture10']);
                    $arrParam['form']['picture10']	= $uploadObj->uploadFile($picture10, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture11['name'] == null){
                    unset($arrParam['form']['picture11']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture11']);
                    $arrParam['form']['picture11']	= $uploadObj->uploadFile($picture11, 'cache/edit/' . $arrParam['form']['name']);
                }

                if($picture12['name'] == null){
                    unset($arrParam['form']['picture12']);
                } else {
                    $uploadObj->removeFile('cache/edit/' . $arrParam['form']['name'], $resultRequest['picture12']);
                    $arrParam['form']['picture12']	= $uploadObj->uploadFile($picture12, 'cache/edit/' . $arrParam['form']['name']);
                }


                $arrParam['form']['description']    = mysqli_real_escape_string($links, $arrParam['form']['description']);


                $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));
                $this->update($data, array(array('product_id', $arrParam['form']['product_id'])));
            }
        }

        if($option['task'] == 'add'){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();

            $uploadDir		= UPLOAD_PATH . 'cache/add' . DS . $arrParam['form']['name'];

            if(!file_exists($uploadDir)){
                mkdir($uploadDir);
            }

            $picture1	                        = $_FILES['picture1'];
            $picture2	                        = $_FILES['picture2'];
            $picture3	                        = $_FILES['picture3'];
            $picture4	                        = $_FILES['picture4'];
            $picture5	                        = $_FILES['picture5'];
            $picture6	                        = $_FILES['picture6'];
            $picture7	                        = $_FILES['picture7'];
            $picture8	                        = $_FILES['picture8'];
            $picture9	                        = $_FILES['picture9'];
            $picture10	                        = $_FILES['picture10'];
            $picture11	                        = $_FILES['picture11'];
            $picture12	                        = $_FILES['picture12'];

            $arrParam['form']['picture1']   = $uploadObj->uploadFile($picture1, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture2']   = $uploadObj->uploadFile($picture2, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture3']   = $uploadObj->uploadFile($picture3, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture4']   = $uploadObj->uploadFile($picture4, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture5']   = $uploadObj->uploadFile($picture5, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture6']   = $uploadObj->uploadFile($picture6, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture7']   = $uploadObj->uploadFile($picture7, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture8']   = $uploadObj->uploadFile($picture8, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture9']   = $uploadObj->uploadFile($picture9, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture10']  = $uploadObj->uploadFile($picture10, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture11']  = $uploadObj->uploadFile($picture11, 'cache/add/' . $arrParam['form']['name']);
            $arrParam['form']['picture12']  = $uploadObj->uploadFile($picture12, 'cache/add/' . $arrParam['form']['name']);

            $arrParam['form']['type']           = 'add';
            $arrParam['form']['designer_id']	= $_SESSION['user']['info']['designer_id'];
            $arrParam['form']['date']	        = date('Y-m-d H:i:s', time());
            $arrParam['form']['product_id']	    = $this->randomString(8);
            $arrParam['form']['description']    = mysqli_real_escape_string($links, $arrParam['form']['description']);

            $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));
            $this->insert($data);

        }
    }

    public function saveItem($arrParam, $option = null){
        if($option['task'] == null){
            require_once LIBRARY_EXT_PATH . 'Upload.php';
            $uploadObj = new Upload();
            $links = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

            $uploadDir		= UPLOAD_PATH . 'cache/edit' . DS . $arrParam['form']['name'];

            $picture1	                        = $_FILES['picture1'];
            $picture2	                        = $_FILES['picture2'];
            $picture3	                        = $_FILES['picture3'];
            $picture4	                        = $_FILES['picture4'];
            $picture5	                        = $_FILES['picture5'];
            $picture6	                        = $_FILES['picture6'];
            $picture7	                        = $_FILES['picture7'];
            $picture8	                        = $_FILES['picture8'];
            $picture9	                        = $_FILES['picture9'];
            $picture10	                        = $_FILES['picture10'];
            $picture11	                        = $_FILES['picture11'];
            $picture12	                        = $_FILES['picture12'];
            $arrParam['form']['designer_id']	= $_SESSION['user']['info']['designer_id'];
            $arrParam['form']['date']	        = date('Y-m-d H:i:s', time());
            $arrParam['form']['product_id']	    = $arrParam['product_id'];

            $id             = $arrParam['id'];
            $existRequest	= "SELECT `name`, `type`, `product_id`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `picture6`, `picture7`, `picture8`, `picture9`, `picture10`, `picture11`, `picture12` FROM `".TBL_REQUEST."` WHERE `id` = $id";

            $resultRequest	= $this->fetchRow($existRequest);

            $oldDir = UPLOAD_PATH . 'cache/' . $resultRequest['type'] . DS . $resultRequest['name'];
            $newDir = UPLOAD_PATH . 'cache/' . $resultRequest['type'] . DS . $arrParam['form']['name'];
            rename($oldDir, $newDir);

            if($picture1['name'] == null){
                unset($arrParam['form']['picture1']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture1']);
                $arrParam['form']['picture1']	= $uploadObj->uploadFile($picture1, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture2['name'] == null){
                unset($arrParam['form']['picture2']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture2']);
                $arrParam['form']['picture2']	= $uploadObj->uploadFile($picture2, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture3['name'] == null){
                unset($arrParam['form']['picture3']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture3']);
                $arrParam['form']['picture3']	= $uploadObj->uploadFile($picture3, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture4['name'] == null){
                unset($arrParam['form']['picture4']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture4']);
                $arrParam['form']['picture4']	= $uploadObj->uploadFile($picture4, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture5['name'] == null){
                unset($arrParam['form']['picture5']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture5']);
                $arrParam['form']['picture5']	= $uploadObj->uploadFile($picture5, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture6['name'] == null){
                unset($arrParam['form']['picture6']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture6']);
                $arrParam['form']['picture6']	= $uploadObj->uploadFile($picture6, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture7['name'] == null){
                unset($arrParam['form']['picture7']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture7']);
                $arrParam['form']['picture7']	= $uploadObj->uploadFile($picture7, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture8['name'] == null){
                unset($arrParam['form']['picture8']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture8']);
                $arrParam['form']['picture8']	= $uploadObj->uploadFile($picture8, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture9['name'] == null){
                unset($arrParam['form']['picture9']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture9']);
                $arrParam['form']['picture9']	= $uploadObj->uploadFile($picture9, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture10['name'] == null){
                unset($arrParam['form']['picture10']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $arrParam['form']['picture10']);
                $arrParam['form']['picture10']	= $uploadObj->uploadFile($picture10, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture11['name'] == null){
                unset($arrParam['form']['picture11']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture11']);
                $arrParam['form']['picture11']	= $uploadObj->uploadFile($picture11, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            if($picture12['name'] == null){
                unset($arrParam['form']['picture12']);
            } else {
                $uploadObj->removeFile('cache/' . $arrParam['type'] . DS . $arrParam['form']['name'], $resultRequest['picture12']);
                $arrParam['form']['picture12']	= $uploadObj->uploadFile($picture12, 'cache/' . $arrParam['type'] . DS . $arrParam['form']['name']);
            }

            $arrParam['form']['description']    = mysqli_real_escape_string($links, $arrParam['form']['description']);


            $data = array_intersect_key($arrParam['form'],array_flip($this->_columns));
            $this->update($data, array(array('id', $id)));
        }
    }

    public function countItems($arrParams, $option = null)
    {
        if($option['task'] == 'all-products') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $query[]    = "SELECT COUNT(`id`) AS `total` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID";

            // FILTER: KEYWORD
            if(!empty($arrParams['form']['name'])) {
                $keyword	= '"%' . $arrParams['form']['name'] . '%"';
                $query[]	= "AND (`name` LIKE $keyword)";
            }

            if(isset($arrParams['collection_id']))
                $query[]	= "AND `collection_id` = " . $arrParams['collection_id'];
            if(isset($arrParams['category_id']))
                $query[]	= "AND `category_id` = " . $arrParams['category_id'];
        }

        if($option['task'] == 'products-in-category') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $cateID     = $arrParams['category_id'];

            $arrCategory = explode('-', $cateID);
            $strCategoryID = '';
            foreach($arrCategory as $categoryID)
                $strCategoryID .= "'$categoryID', ";

            $query[]    = "SELECT COUNT(`id`) AS `total` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID AND `category_id` IN ($strCategoryID'0') ";
            if(isset($arrParams['collection_id']))
                $query[]	= "AND `collection_id` = " . $arrParams['collection_id'];
        }


        $query   = implode(" ", $query);
        $result  = $this->fetchRow($query);

        return $result['total'];
    }

    public function listItems($arrParams, $option = null)
    {
        // Category Action
        if($option['task'] == 'get-collection-in-category') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $cateID     = $arrParams['category_id'];

            $arrCategory = explode('-', $cateID);
            $strCategoryID = '';
            foreach($arrCategory as $categoryID)
                $strCategoryID .= "'$categoryID', ";

            $query[]    = "SELECT `c`.`id`, `c`.`name`, COUNT(`p`.`id`) AS `total` ";
            $query[]    = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_COLLECTION."` AS `c` ";
            $query[]	= "WHERE `designer_id` = $designerID AND `p`.`collection_id` = `c`.`id` AND `p`.`category_id` IN ($strCategoryID'0')";
            $query[]    = "GROUP BY `c`.`name` ";
            $query[]    = "ORDER BY `c`.`name` "; // ORDER BY `name` ASC
        }

        if($option['task'] == 'get-category-in-category') {
            $designerID = $_SESSION['user']['info']['designer_id'];

            $query[]    = "SELECT `c`.`id`, `c`.`name`, COUNT(`p`.`id`) AS `total` ";
            $query[]    = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_CATEGORY."` AS `c` ";
            $query[]	= "WHERE `designer_id` = $designerID AND `p`.`category_id` = `c`.`id` ";
            $query[]    = "GROUP BY `c`.`name` ";
            $query[]    = "ORDER BY `c`.`name` "; // ORDER BY `name` ASC
        }

        if($option['task'] == 'products-in-category') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $cateID     = $arrParams['category_id'];

            $arrCategory = explode('-', $cateID);
            $strCategoryID = '';
            foreach($arrCategory as $categoryID)
                $strCategoryID .= "'$categoryID', ";


            $query[]    = "SELECT `p`.`id`, `p`.`name`, `p`.`picture1`, `p`.`picture2`, `c`.`name` AS `category_name` ";
            $query[]    = "FROM `".TBL_PRODUCT."` as `p`, `".TBL_CATEGORY."` AS `c` ";
            $query[]	= "WHERE `p`.`designer_id` = $designerID AND `p`.`category_id` IN ($strCategoryID'0') AND `c`.`id` = `p`.`category_id` ";

            if(isset($arrParams['collection_id']))
                $query[]	= "AND `collection_id` = " . $arrParams['collection_id'];


            $query[]    = "ORDER BY `sold` DESC "; // ORDER BY `name` ASC

            // PAGINATION
            $pagination = $arrParams['pagination'];
            $totalItemsPerPage = $pagination['totalItemsPerPage'];
            if($totalItemsPerPage > 0){
                $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                $query[]    = "LIMIT $position, $totalItemsPerPage";
            }
        }
        // End Category Action

        // Index Action
        if($option['task'] == 'list-products') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $query[]    = "SELECT `id`, `name`, `picture1`, `picture2`, `description`, `price`, `sale_off`, `sold` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID";
            $query[]    = "ORDER BY `sold` DESC "; // ORDER BY `name` ASC
            $query[]    = "LIMIT 0, 3 ";
        }

        if($option['task'] == 'more-products') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $query[]    = "SELECT `id`, `name`, `picture1`, `picture2`, `description`, `price`, `sale_off`, `sold` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID AND `category_id` IN (1,2)";
            $query[]    = "GROUP BY RAND()";
            $query[]    = "LIMIT 0, 7 ";
        }
        // End Index Action

        // Shop Action
        if($option['task'] == 'all-products') {
            $designerID = $_SESSION['user']['info']['designer_id'];
            $query[]    = "SELECT `id`, `name`, `picture1`, `picture2`, `description`, `price`, `sale_off`, `sold` ";
            $query[]    = "FROM `".TBL_PRODUCT."` ";
            $query[]	= "WHERE `status` = 1 AND `designer_id` = $designerID";

            // FILTER: KEYWORD
            if(!empty($arrParams['form']['name'])) {
                $keyword	= '"%' . $arrParams['form']['name'] . '%"';
                $query[]	= "AND (`name` LIKE $keyword)";
            }

            if(isset($arrParams['collection_id']))
                $query[]	= "AND `collection_id` = " . $arrParams['collection_id'];
            if(isset($arrParams['category_id']))
                $query[]	= "AND `category_id` = " . $arrParams['category_id'];

            $query[]    = "ORDER BY `view` DESC "; // ORDER BY `name` ASC

            // PAGINATION
            $pagination = $arrParams['pagination'];
            $totalItemsPerPage = $pagination['totalItemsPerPage'];
            if($totalItemsPerPage > 0){
                $position   = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
                $query[]    = "LIMIT $position, $totalItemsPerPage";
            }

        }

        if($option['task'] == 'get-collection-in-shop') {
            $designerID = $_SESSION['user']['info']['designer_id'];

            $query[]    = "SELECT `c`.`id`, `c`.`name`, COUNT(`p`.`id`) AS `total` ";
            $query[]    = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_COLLECTION."` AS `c` ";
            $query[]	= "WHERE `designer_id` = $designerID AND `p`.`collection_id` = `c`.`id` ";
            $query[]    = "GROUP BY `c`.`name` ";
            $query[]    = "ORDER BY `c`.`name` "; // ORDER BY `name` ASC
        }

        if($option['task'] == 'get-category-in-shop') {
            $designerID = $_SESSION['user']['info']['designer_id'];

            $query[]    = "SELECT `c`.`id`, `c`.`name`, COUNT(`p`.`id`) AS `total` ";
            $query[]    = "FROM `".TBL_PRODUCT."` AS `p`, `".TBL_CATEGORY."` AS `c` ";
            $query[]	= "WHERE `designer_id` = $designerID AND `p`.`category_id` = `c`.`id` ";
            $query[]    = "GROUP BY `c`.`name` ";
            $query[]    = "ORDER BY `c`.`name` "; // ORDER BY `name` ASC
        }
        //End Shop Action

        //Request Action
        if($option['task'] == 'get-request-edit') {
            $designerID = $_SESSION['user']['info']['designer_id'];

            $query[]    = "SELECT `r`.`id`, `r`.`name`, `r`.`date`, `r`.`type`, `p`.`id` AS `product_id`, `p`.`picture1`, `p`.`picture2`, `p`.`name` AS `product_name`, `c`.`name` AS `collection_name`, `ca`.`name` AS `category_name`";
            $query[]    = "FROM `".TBL_REQUEST."` AS `r`, `".TBL_PRODUCT."` AS `p`, `".TBL_COLLECTION."` AS `c`, `".TBL_CATEGORY."` AS `ca` ";
            $query[]	= "WHERE `r`.`designer_id` = $designerID AND `r`.`product_id` = `p`.`id` AND `type` = 'edit'";
            $query[]	= "GROUP BY `r`.`name` ";
            $query[]    = "ORDER BY `r`.`date` ";
        }

        if($option['task'] == 'get-request-add') {
            $designerID = $_SESSION['user']['info']['designer_id'];

            $query[]    = "SELECT `r`.`id`, `r`.`name`, `r`.`picture1`, `r`.`picture2`, `r`.`date`, `r`.`type`, `c`.`name` AS `collection_name`, `ca`.`name` AS `category_name`";
            $query[]    = "FROM `".TBL_REQUEST."` AS `r`, `".TBL_COLLECTION."` AS `c`, `".TBL_CATEGORY."` AS `ca` ";
            $query[]	= "WHERE `r`.`designer_id` = $designerID AND `r`.`type` = 'add'";
            $query[]	= "GROUP BY `r`.`name` ";
            $query[]    = "ORDER BY `r`.`date` ";
        }
        // End Request Action

        $query   = implode(" ", $query);
        $result  = $this->fetchAll($query);

        return $result;
    }

    public function itemInSelectbox($arrParams, $option = null)
    {
        if($option['task'] == 'category') {
            $query              = "SELECT `id`, `name` FROM `" . TBL_CATEGORY . "`";
            $result             = $this->fetchPairs($query);
            $result['default']  = "Select Category";
            ksort($result);
            return $result;
        }

        if($option['task'] == 'collection') {
            $query              = "SELECT `id`, `name` FROM `" . TBL_COLLECTION . "`";
            $result             = $this->fetchPairs($query);
            $result['default']  = "Select Collection";
            ksort($result);
            return $result;
        }
    }

    private function randomString($length = 8){
        $arrCharacter = array_merge(range(1,9), range(0,9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result		= substr($arrCharacter, 0, $length);
        return $result;
    }

}
