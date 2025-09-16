<?php
    $controller = $this->arrParams['controller'];

    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblUserName    = Helper::cmsLinkSort('User Name', 'username', $columnPost, $orderPost);
    $lblEmail       = Helper::cmsLinkSort('Email', 'email', $columnPost, $orderPost);
    $lblFullName    = Helper::cmsLinkSort('Full Name', 'fullname', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblGroup       = Helper::cmsLinkSort('Group', 'group_id', $columnPost, $orderPost);
    $lblOrdering    = Helper::cmsLinkSort('Ordering', 'ordering', $columnPost, $orderPost);
    $lblCreated     = Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBY  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblActive      = Helper::cmsLinkSort('Last Active', 'time', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // SELECT
    $arrStatus          = array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish');
    $selectboxStatus    = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, $this->arrParams['filter_state']);

    $arrGroup           = $this->slbGroup;
    $selectboxGroup     = Helper::cmsSelectbox('filter_group_id', 'inputbox', $arrGroup, $this->arrParams['filter_group_id']);


    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'user', 'index'));

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
                                            <?php echo $selectboxStatus.$selectboxGroup?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="1%">
                                            <input type="checkbox" name="checkall"">
                                        </th>
                                        <th><?php echo $lblUserName ?></th>
                                        <th><?php echo $lblEmail ?></th>
                                        <th><?php echo $lblFullName ?></th>
                                        <th><?php echo $lblGroup ?></th>
                                        <th><?php echo $lblStatus ?></th>
                                        <th><?php echo $lblOrdering ?></th>
                                        <th><?php echo $lblCreated ?></th>
                                        <th><?php echo $lblCreatedBy ?></th>
                                        <th><?php echo $lblModified ?></th>
                                        <th><?php echo $lblModifiedBY ?></th>
                                        <th><?php echo $lblActive ?></th>
                                        <th><?php echo $lblID ?></th>
                                    </tr>
                                    </thead>
                                        <?php
                                        if(!empty($this->Items)) {
                                            $i = 0;
                                            foreach ($this->Items as $key => $value) {
                                                $id         = $value['id'];
                                                $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                                $username   = $value['username'];
                                                $email      = $value['email'];
                                                $fullname   = $value['fullname'];
                                                $groupName   = $value['group_name'];
                                                $row        = ($i % 2) == 0 ? 'row0' : 'row1';
                                                // Change on: action, column in database, function + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                                $status		= Helper::cmsOther($value['status'], URL::createLink('admin', 'user', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);


                                                $ordering   = '<input type="number" name="order['.$id.']" value="'.$value['ordering'].'" class="text-center form-control" style="width: 100%">';
                                                $created    = Helper::formatDate('d-m-Y', $value['created']);
                                                $createdBy  = $value['created_by'];
                                                $modified   = $value['modified'];
                                                $modifiedBy = $value['modified_by'];
                                                $time = $value['time'];
                                                if($time + 5*60 > time())
                                                    $block = '<span class="badge badge-success p-2">Online</span>';
                                                else
                                                    $block = '<span class="badge badge-danger p-2" title="'.date('d-m-Y H:i:s', $time).'">Offline</span>';
                                                $linkEdit   = URL::createLink('admin', 'user', 'form',array('id' => $id));

                                                echo '<tbody>
                                                    <tr class="'.$row.'">
                                                        <td>'.$ckb.'</td>
                                                        <td><a href="'.$linkEdit.'">'.$username.'</a></td>
                                                        <td>'.$email.'</td>
                                                        <td>'.$fullname.'</td>
                                                        <td>'.$groupName.'</td>
                                                        <td class="text-center">'.$status.'</td>
                                                        <td>'.$ordering.'</td>
                                                        <td>'.$created.'</td>
                                                        <td >'.$createdBy.'</td>
                                                        <td>'.$modified.'</td>
                                                        <td>'.$modifiedBy.'</td>
                                                        <td>'.$block.'</td>
                                                        <td>'.$id.'</td>
                                                    </tr>
                                                 </tbody>';
                                                $i++;
                                            }
                                        }
                                        ?>
                                </table>
                                <div>
                                    <input type="hidden" name="filter_column" value="username">
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



