<?php
    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblName        = Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost);
    $lblValue       = Helper::cmsLinkSort('Value', 'value', $columnPost, $orderPost);
    $lblDate        = Helper::cmsLinkSort('Date', 'date', $columnPost, $orderPost);
    $lblCategory    = Helper::cmsLinkSort('Category', 'category', $columnPost, $orderPost);
    $lblCreated     = Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBY  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'collection', 'index'));

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
                               <div>
                                    <input type="text" class="btn btn-light btn-round text-left mb-1" name="filter_search" id="filter_search" value="<?php echo $this->arrParams['filter_search']; ?>">
                                    <button type="submit" name="submit-keyword" class="btn btn-light btn-round mb-1">Search</button>
                                    <button type="button" name="clear-keyword" class="btn btn-light btn-round mb-1">Clear</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="1%">
                                            <input type="checkbox" name="checkall"">
                                        </th>
                                        <th><?php echo $lblName ?></th>
                                        <th><?php echo $lblValue ?></th>
                                        <th><?php echo $lblDate ?></th>
                                        <th><?php echo $lblCreated ?></th>
                                        <th><?php echo $lblCreatedBy ?></th>
                                        <th><?php echo $lblModified ?></th>
                                        <th><?php echo $lblModifiedBY ?></th>
                                        <th class="nowrap"><?php echo $lblID ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        $i = 0;
                                        foreach ($this->Items as $key => $value) {
                                            $id         = $value['id'];
                                            $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                            $name       = $value['name'];
                                            $valueCost  = number_format($value['value']);


                                            $row        = ($i % 2) == 0 ? 'row0' : 'row1';
                                            $date       = Helper::formatDate('m-Y', $value['date']);
                                            $created    = Helper::formatDate('d-m-Y', $value['created']);
                                            $createdBy  = $value['created_by'];
                                            $modified   = $value['modified'];
                                            $modifiedBy = $value['modified_by'];
                                            $linkEdit   = URL::createLink('admin', 'cost', 'form',array('id' => $id));

                                            echo '<tbody>
                                                    <tr class="'.$row.'">
                                                        <td class="center">'.$ckb.'</td>
                                                        <td><a href="'.$linkEdit.'">'.$name.'</a></td>
                                                        <td class="center">'.$valueCost.'</td>
                                                        <td class="center">'.$date.'</td>
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
