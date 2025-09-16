<?php
    // COLUMN

    $columnPost	        = $this->arrParams['filter_column'];
    $orderPost		    = $this->arrParams['filter_column_dir'];
    $lblDesignerName    = Helper::cmsLinkSort('Desinger Name'   , 'designer_id'     , $columnPost, $orderPost);
    $lblCollectionName  = Helper::cmsLinkSort('Collection Name' , 'collection_id'   , $columnPost, $orderPost);
    $lblCategoryName    = Helper::cmsLinkSort('Category Name'   , 'category_id'     , $columnPost, $orderPost);
    $lblType            = Helper::cmsLinkSort('Type'            , 'type'            , $columnPost, $orderPost);
    $lblProductName     = Helper::cmsLinkSort('Product Name'    , 'name'            , $columnPost, $orderPost);
    $lblDate            = Helper::cmsLinkSort('Date'            , 'date'            , $columnPost, $orderPost);
    $lblID              = Helper::cmsLinkSort('ID'              , 'id'              , $columnPost, $orderPost);

    // SELECT STATUS
    $arrType          = array('default' => 'Select Type', 0 => 'Add', 1 => 'Edit');
    $selectboxType    = Helper::cmsSelectbox('filter_state', 'inputbox', $arrType, $this->arrParams['filter_state']);

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
                                            <?php echo $selectboxType?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="1%" class="nowrap"><?php echo $lblID ?></th>
                                        <th width="8%"><?php echo $lblDesignerName ?></th>
                                        <th width="10%"><?php echo $lblProductName ?></th>
                                        <th width="10%"><?php echo $lblCollectionName ?></th>
                                        <th width="10%"><?php echo $lblCategoryName ?></th>
                                        <th width="10%"><?php echo $lblType ?></th>
                                        <th width="8%"><?php echo $lblDate ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        foreach ($this->Items as $key => $value) {
                                            $id             = $value['id'];
                                            $productID      = $value['product_id'];
                                            $designerID     = $value['designer_id'];
                                            $type           = ucfirst($value['type']);
                                            $designer       = $value['designer_name'];
                                            $collection     = $value['collection_name'];
                                            $category       = $value['category_name'];
                                            $product        = $value['name'];
                                            $date           = Helper::formatDate('d-m-Y: H:i:s', $value['date']);


                                            $row            = ($i % 2) == 0 ? 'row0' : 'row1';
                                            $linkEdit = URL::createLink('admin', 'request', 'form', array('id' => $id, 'product_id' => $productID, 'designer_id' => $designerID, 'type' => $value['type']));

                                            echo '<tbody>
                                    <tr class="' . $row . '">
                                        <td class="center">' . $id . '</td>
                                        <td><a href="' . $linkEdit . '">' . $designer . '</a></td>
                                        <td class="center">' . $product . '</td>
                                        <td class="center">' . $collection . '</td>
                                        <td class="center">' . $category . '</td>
                                        <td class="center">' . $type . '</td>
                                        <td class="center">' . $date . '</td>
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





