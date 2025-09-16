<?php
    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblUserName    = Helper::cmsLinkSort('Customer', 'username', $columnPost, $orderPost);
    $lblNames       = Helper::cmsLinkSort('Book Name', 'names', $columnPost, $orderPost);
    $lblBooks       = Helper::cmsLinkSort('Book ID', 'books', $columnPost, $orderPost);
    $lblPrices      = Helper::cmsLinkSort('Total', 'prices', $columnPost, $orderPost);
    $lblQuantities  = Helper::cmsLinkSort('Quantity', 'quantities', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblCompleted   = Helper::cmsLinkSort('Completed', 'completed', $columnPost, $orderPost);
    $lblCancel      = Helper::cmsLinkSort('Cancelled', 'cancel', $columnPost, $orderPost);
    $lblDate        = Helper::cmsLinkSort('Date', 'date', $columnPost, $orderPost);
    $lblVoucher     = Helper::cmsLinkSort('Voucher', 'coupon_id', $columnPost, $orderPost);
    $lblPayment     = Helper::cmsLinkSort('Payment', 'payment', $columnPost, $orderPost);
    $lblInvoice     = Helper::cmsLinkSort('Invoice', 'invoice', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // ARRAY STATUS
    $arrStatus          = array('default' => 'Select Status', 0 => 'Pending', 1 => 'Aprroved');
    
    // ARRAY CANCEL
    $arrCancel          = array('default' => 'Select Cancel', 0 => 'In Process', 1 => 'Pending' , 2 => 'Cancelled');

    // SELECT STATUS
    $selectboxStatus    = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, isset($this->arrParams['filter_state']) ? $this->arrParams['filter_state'] : 'default');
    
    // SELECT CANCEL
    $selectboxCancel    = Helper::cmsSelectbox('filter_cancel', 'inputbox', $arrCancel, isset($this->arrParams['filter_cancel']) ? $this->arrParams['filter_cancel'] : 'default');

    // SELECT SPECIAL
    $arrCompleted			= array('default' => 'Select Completed', 1 => 'Shipped',  0 => 'Shipping');
    $selectboxCompleted	    = Helper::cmsSelectbox('filter_completed', 'inputbox', $arrCompleted, isset($this->arrParams['filter_completed']) ? $this->arrParams['filter_completed'] : 'default');

    // SELECT METHOD PAYMENT
    $arrMethod          = array('default' => 'Select Method', 1 => 'Cash on Dilivery', 2 => 'Momo Banking', 3  => 'Mobile Banking');
    $selectboxMethod    = Helper::cmsSelectbox('filter_method', 'inputbox', $arrMethod, $this->arrParams['filter_method']);

    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'order', 'index'));

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
                                            echo $selectboxMethod.$selectboxStatus.$selectboxCompleted.$selectboxCancel;
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
                                        <th width="10%"><?php echo $lblUserName ?></th>
                                        <th width="10%" class="text-center"><?php echo $lblQuantities ?></th>
                                        <th width="10%"><?php echo $lblPrices ?></th>
                                        <th width="10%"><?php echo $lblVoucher ?></th>
                                        <th width="10%"><?php echo $lblPayment ?></th>
                                        <th width="10%"><?php echo $lblInvoice ?></th>
                                        <th width="6%"><?php echo $lblStatus ?></th>
                                        <th width="6%"><?php echo $lblCompleted ?></th>
                                        <th width="6%"><?php echo $lblCancel ?></th>
                                        <th width="6%"><?php echo $lblDate ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        $i = 0;
                                        $totalPrice = 0;
                                        foreach ($this->Items as $key => $value) {
                                            $id         = $value['id'];
                                            $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                            $username   = $value['username'];
                                            $prices     = number_format($value['totalPrice']);
                                            $quantities = $value['totalQuantity'];
                                            $coupon     = $value['coupon_name'] == 'default' ? 'NA' : $value['coupon_name'];
                                            $payment    = $value['payment'];
                                            $invoice    = $value['invoice'];
                                            $date       = Helper::formatDate('d-m-Y H:i:s', $value['date']);
                                            $row        = ($i % 2) == 0 ? 'row0' : 'row1';

                                            $status     = $value['status'] == 1 ? '<span class="cancel fa-solid fa-check opacity"></span>' : '<span class="cancel fa-solid fa-xmark opacity"></span>';
                                            $completed  = $value['completed'] == 1 ? '<span class="cancel fa-solid fa-check opacity"></span>' : '<span class="cancel fa-solid fa-xmark opacity"></span>';
                                            $cancel	    = Helper::cmsCancel($value['cancel'], URL::createLink('admin', 'order', 'ajaxCancel', array('id' => $id, 'cancel' => $value['cancel'])), $id);

                                            if($value['cancel'] == 0){
                                                $status		= Helper::cmsStatus($value['status'], URL::createLink('admin', 'order', 'ajaxStatus', array('id' => $id, 'status' => $value['status'], 'user_id' => $value['user_id'], 'completed' => $value['completed'])), $id);
                                                $completed  = Helper::cmsCompleted($value['completed'],URL::createLink('admin', 'order', 'ajaxCompleted', array('id' => $id, 'completed' => $value['completed'], 'user_id' => $value['user_id'], 'status' => $value['status'])), $id);
                                            } 
                                        

                                            $linkEdit = URL::createLink('admin', 'order', 'form', array('id' => $id));

                                            echo '<tbody>
                                                    <tr class="' . $row . '">
                                                        <td class="center">' . $ckb . '</td>
                                                        <td><a href="' . $linkEdit . '">' . $id . '</a></td>
                                                        <td class="center">' . $username . '</td>
                                                        <td class="text-center">' . $quantities . '</td>
                                                        <td class="center">' . $prices . '</td>
                                                        <td class="center">' . $coupon . '</td>
                                                        <td class="center">' . $payment . '</td>
                                                        <td class="center">' . $invoice . '</td>
                                                        <td class="center">' . $status . '</td>
                                                        <td class="center">' . $completed . '</td>
                                                        <td class="center">' . $cancel . '</td>
                                                        <td class="center">' . $date . '</td>
                                                    </tr>
                                                 </tbody>';

                                            $i++;
                                        }
                                    }
                                    ?>
                                </table>
                                <div>
                                    <input type="hidden" name="filter_column" value="id">
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

<style>
.opacity {
opacity: 0.3
</style




