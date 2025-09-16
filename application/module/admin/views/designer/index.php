<?php
    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblName        = Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost);
    $lblPicture     = Helper::cmsLinkSort('Picture', 'picture_profile', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblOrdering    = Helper::cmsLinkSort('Ordering', 'ordering', $columnPost, $orderPost);
    $lblCreated     = Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBY  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // SELECT STATUS
    $arrStatus              = array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish');
    $selectboxStatus        = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, $this->arrParams['filter_state']);

    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'designer', 'index'));

    // MESSAGE
	$message	= Session::get('message');
	Session::delete('message');
	$strMessage = Helper::cmsMessage($message);
	?>



<div id="wrapper">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
            <?php include_once (MODULE_PATH . 'admin/views/toolbar.php');?>
            <?php
            if(!empty($this->Become)) {
                ?>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="1%" class="nowrap">Name Account</th>
                                        <th width="6%" class="text-center">Picture</th>
                                        <th width="6%" class="text-center">Website</th>
                                        <th width="6%" class="text-center">Design About</th>
                                        <th width="6%" class="text-center">Profession</th>
                                        <th width="6%" class="text-center">Fullname</th>
                                        <th width="6%" class="text-center">Date</th>
                                    </tr>
                                    </thead>
                                    <?php
                                        $i = 0;
                                        foreach ($this->Become as $key => $value) {
                                            $id             = $value['id'];
                                            $name           = $value['name'];
                                            $nameAccount    = $value['user_name'];
                                            $website        = $value['website'];
                                            $profession     = $value['profession'];
                                            $designAbout    = $value['design_about'];
                                            $date           = $value['date'];

                                            $picturePath= UPLOAD_PATH . 'cache/designer/' . $value['name'] . DS . $value['picture'];
                                            if(file_exists($picturePath)) {
                                                $picture	= '<img width=270" height="210" src="'.UPLOAD_URL . 'cache/designer/' . $value['name'] . DS . $value['picture'].'">';
                                            } else {
                                                $picture	= '<img src="'.UPLOAD_URL . 'cache/designer/' . $value['name'] . DS . '98x150-default.jpg' .'">';
                                            }


                                            $row            = ($i % 2) == 0 ? 'row0' : 'row1';
                                            $linkEdit       = URL::createLink('admin', 'designer', 'become',array('id' => $id));

                                            echo '<tbody>
                                                    <tr class="'.$row.'">
                                                        <td><a href="'.$linkEdit.'">'.$nameAccount.'</a></td>
                                                        <td class="text-center">'.$picture.'</td>
                                                        <td class="text-center">'.$website.'</td>
                                                        <td class="text-center">'.$designAbout.'</td>
                                                        <td class="text-center">'.$profession.'</td>
                                                        <td class="text-center">'.$name.'</td>
                                                        <td class="text-center">'.$date.'</td>
                                                    </tr>
                                                 </tbody>';
                                            $i++;
                                        }
                                    ?>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <form action="#" method="post" name="adminForm" id="adminForm" >
                            <div class="card-header">
                                <div class="row justify-content-between">
                                    <div>
                                        <input type="text" class="btn btn-light btn-round text-left mb-1" name="filter_search" id="filter_search" value="<?php echo $this->arrParams['filter_search']; ?>">
                                        <button type="submit" name="submit-keyword" class="btn btn-light btn-round mb-1">Search</button>
                                        <button type="button" name="clear-keyword" class="btn btn-light btn-round mb-1">Clear</button>
                                    </div>
                                    <div class="card-action">
                                        <div class="dropdown">
                                            <?php
                                            echo $selectboxStatus;
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="1%">
                                            <input type="checkbox" name="checkall">
                                        </th>
                                        <th width="1%" class="nowrap"><?php echo $lblID ?></th>
                                        <th class="title"><?php echo $lblName ?></th>
                                        <th width="10%"><?php echo $lblPicture ?></th>
                                        <th width="6%"><?php echo $lblStatus ?></th>
                                        <th width="6%"><?php echo $lblOrdering ?></th>
                                        <th width="8%"><?php echo $lblCreated ?></th>
                                        <th width="8%"><?php echo $lblCreatedBy ?></th>
                                        <th width="10%"><?php echo $lblModified ?></th>
                                        <th width="10%"><?php echo $lblModifiedBY ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        $i = 0;
                                        foreach ($this->Items as $key => $value) {
                                            $id         = $value['id'];
                                            $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                            $name       = $value['name'];
                                            $picturePath= UPLOAD_PATH . 'designer/' . $value['name'] . DS . $value['picture_profile'];
                                            if(file_exists($picturePath)) {
                                                $picture	= '<img width="270" height="180" src="'.UPLOAD_URL . 'designer/' . $value['name'] . DS . $value['picture_profile'].'">';
                                            } else {
                                                $picture	= '<img src="'.UPLOAD_URL . 'designer/' . $value['name'] . DS . '98x150-default.jpg' .'">';
                                            }

                                            $row            = ($i % 2) == 0 ? 'row0' : 'row1';
                                            // Change on: action, column in database, fuction + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                            $status		    = Helper::cmsOther($value['status'], URL::createLink('admin', 'designer', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);


                                            $ordering       = '<input type="number" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="text-center form-control">';
                                            $created        = Helper::formatDate('d-m-Y', $value['created']);
                                            $createdBy      = $value['created_by'];
                                            $modified       = Helper::formatDate('d-m-Y', $value['modified']);;
                                            $modifiedBy     = $value['modified_by'];
                                            $linkEdit       = URL::createLink('admin', 'designer', 'form',array('id' => $id));

                                            echo '<tbody>
                                                    <tr class="'.$row.'">
                                                        <td class="center">'.$ckb.'</td>
                                                        <td class="center">'.$id.'</td>
                                                        <td><a href="'.$linkEdit.'">'.$name.'</a></td>
                                                        <td class="text-center">'.$picture.'</td>
                                                        <td class="text-center">'.$status.'</td>
                                                        <td class="text-center">'.$ordering.'</td>
                                                        <td class="text-center">'.$created.'</td>
                                                        <td class="text-center">'.$createdBy.'</td>
                                                        <td class="text-center">'.$modified.'</td>
                                                        <td class="text-center">'.$modifiedBy.'</td>
                                                    </tr>
                                                 </tbody>';
                                            $i++;
                                        }
                                    }
                                    ?>
                                </table>
                                <div>
                                    <input type="hidden" name="filter_column" value="name">
                                    <input type="hidden" name="filter_column_dir" value="asc">
                                    <input type="hidden" name="filter_page" value="1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container">
                    <?php
                    if($this->pagination->totalPage > 1)
                        echo $paginationHTML;
                    ?>
                </div>
            </div><!--End Row-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->

    </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->



</div><!--End wrapper-->



