<?php
    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblName        = Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost);
    $lblValue       = Helper::cmsLinkSort('Value', 'value', $columnPost, $orderPost);
    $lblCode        = Helper::cmsLinkSort('Code', 'code', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblOrdering    = Helper::cmsLinkSort('Ordering', 'ordering', $columnPost, $orderPost);
    $lblQuantity    = Helper::cmsLinkSort('Quantity', 'quantity', $columnPost, $orderPost);
    $lblUsed        = Helper::cmsLinkSort('Used', 'used', $columnPost, $orderPost);
    $lblCreated     = Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBY  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // SELECT STATUS
    $arrStatus          = array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish');
    $selectboxStatus    = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, $this->arrParams['filter_state']);

    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'coupon', 'index'));

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
                                            <input type="checkbox" name="checkall"">
                                        </th>
                                        <th width="1%" class="nowrap"><?php echo $lblID ?></th>
                                        <th width="8%"><?php echo $lblCode ?></th>
                                        <th width="10%"><?php echo $lblName ?></th>
                                        <th width="8%"><?php echo $lblValue ?></th>
                                        <th width="6%"><?php echo $lblStatus ?></th>
                                        <th width="6%"><?php echo $lblOrdering ?></th>
                                        <th width="6%"><?php echo $lblQuantity ?></th>
                                        <th width="6%"><?php echo $lblUsed ?></th>
                                        <th width="10%"><?php echo $lblCreated ?></th>
                                        <th width="10%"><?php echo $lblCreatedBy ?></th>
                                        <th width="10%"><?php echo $lblModified ?></th>
                                        <th width="10%"><?php echo $lblModifiedBY ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        $i = 0;
                                        $totalPrice = 0;
                                        foreach ($this->Items as $key => $value) {
                                            $id             = $value['id'];
                                            $ckb            = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                            $name           = $value['name'];
                                            $code           = $value['code'];
                                            $valueVoucher   = $value['value'];
                                            $ordering       = '<input type="text" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="text-area-order text-center form-control">';
                                            $quantity       = '<input type="text" name="quantity['.$id.']" size="5" value="'.$value['quantity'].'" class="text-area-order text-center form-control">';
                                            $used           = $value['used'];
                                            $created        = Helper::formatDate('d-m-Y', $value['created']);
                                            $createdBy      = $value['created_by'];
                                            $modified       = $value['modified'];
                                            $modifiedBy     = $value['modified_by'];

                                            $row            = ($i % 2) == 0 ? 'row0' : 'row1';
                                            // Change on: action, column in database, fuction + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                            $status     = Helper::cmsOther($value['status'], URL::createLink('admin', 'coupon', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);

                                            $linkEdit = URL::createLink('admin', 'coupon', 'form', array('id' => $id));

                                            echo '<tbody>
                                    <tr class="' . $row . '">
                                        <td class="center">' . $ckb . '</td>
                                        <td class="center">' . $id . '</td>
                                        <td><a href="' . $linkEdit . '">' . $code . '</a></td>
                                        <td class="center">' . $name . '</td>
                                        <td class="center">' . $valueVoucher . '</td>
                                        <td class="center">' . $status . '</td>
                                        <td class="center">' . $ordering . '</td>
                                        <td class="center">' . $quantity . '</td>
                                        <td class="center">' . $used . '</td>
                                        <td class="center">' . $created . '</td>
                                        <td class="center">' . $createdBy . '</td>
                                        <td class="center">' . $modified . '</td>
                                        <td class="center">' . $modifiedBy . '</td>
                                    </tr>
                                 </tbody>';

                                            $i++;
                                        }
                                    }
                                    ?>

                                </table>
                                <div>
                                    <input type="hidden" name="filter_column" value="code">
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





