<?php

    // COLUMN
    $columnPost	= $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblName        = Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblGroupACP    = Helper::cmsLinkSort('GroupACP', 'group_acp', $columnPost, $orderPost);
    $lblOrdering    = Helper::cmsLinkSort('Ordering', 'ordering', $columnPost, $orderPost);
    $lblCreated     = Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBY  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // SELECT
    $arrStatus          = array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish');
    $selectboxStatus    = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, $this->arrParams['filter_state']);

    $arrGroupACP        = array('default' => 'Select Group ACP', 1 => 'Yes', 0 => 'No');
    $selectboxGroupACP  = Helper::cmsSelectbox('filter_group_acp', 'inputbox', $arrGroupACP, $this->arrParams['filter_group_acp']);

    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'group', 'index'));

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
                                            <?php
                                            echo $selectboxStatus.$selectboxGroupACP;
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
                                            <input type="checkbox" name="checkall"">
                                        </th>
                                        <th class="title"><?php echo $lblName ?></th>
                                        <th width="10%"><?php echo $lblStatus ?></th>
                                        <th width="10%"><?php echo $lblGroupACP ?></th>
                                        <th width="10%"><?php echo $lblOrdering ?></th>
                                        <th width="10%"><?php echo $lblCreated ?></th>
                                        <th width="10%"><?php echo $lblCreatedBy ?></th>
                                        <th width="10%"><?php echo $lblModified ?></th>
                                        <th width="10%"><?php echo $lblModifiedBY ?></th>
                                        <th width="1%" class="nowrap"><?php echo $lblID ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        $i = 0;
                                        foreach ($this->Items as $key => $value) {
                                            $id         = $value['id'];
                                            $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                            $name       = $value['name'];
                                            $row        = ($i % 2) == 0 ? 'row0' : 'row1';
                                            // Change on: action, column in database, fuction + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                            $status		= Helper::cmsOther($value['status'], URL::createLink('admin', 'group', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);
                                            $groupACP	= Helper::cmsGroupACP($value['group_acp'], URL::createLink('admin', 'group', 'ajaxGroupACP', array('id' => $id, 'group_acp' => $value['group_acp'])), $id);


                                            $ordering   = '<input type="number" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="form-control text-center">';
                                            $created    = Helper::formatDate('d-m-Y', $value['created']);
                                            $createdBy  = $value['created_by'];
                                            $modified   = $value['modified'];
                                            $modifiedBy = $value['modified_by'];
                                            $linkEdit   = URL::createLink('admin', 'group', 'form',array('id' => $id));

                                            echo '<tbody>
                                    <tr class="'.$row.'">
                                        <td class="center">'.$ckb.'</td>
                                        <td><a href="'.$linkEdit.'">'.$name.'</a></td>
                                        <td class="center">'.$status.'</td>
                                        <td class="center">'.$groupACP.'</td>
                                        <td class="order">'.$ordering.'</td>
                                        <td class="center">'.$created.'</td>
                                        <td class="center">'.$createdBy.'</td>
                                        <td class="center">'.$modified.'</td>
                                        <td class="center">'.$modifiedBy.'</td>
                                        <td class="center">'.$id.'</td>
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


