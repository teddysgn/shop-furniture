<?php
    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblPicture     = Helper::cmsLinkSort('Picture', 'picture', $columnPost, $orderPost);
    $lblContent     = Helper::cmsLinkSort('Content', 'content', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblProduct     = Helper::cmsLinkSort('Product', 'product_id', $columnPost, $orderPost);
    $lblUser        = Helper::cmsLinkSort('User', 'user_id', $columnPost, $orderPost);
    $lblDate        = Helper::cmsLinkSort('Date', 'date', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBY  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // SELECT
    $arrStatus          = array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish');
    $selectboxStatus    = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, isset($this->arrParams['filter_state']) ? $this->arrParams['filter_state'] : 'default');

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
                                        <th><?php echo $lblPicture ?></th>
                                        <th><?php echo $lblProduct ?></th>
                                        <th><?php echo $lblContent ?></th>
                                        <th><?php echo $lblStatus ?></th>
                                        <th><?php echo $lblUser ?></th>
                                        <th><?php echo $lblDate ?></th>
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
                                            $content    = $value['content'];
                                            $name       = $value['name'];

                                            $picturePath= UPLOAD_PATH . 'product/' . $value['name'] . DS . $value['picture1'];
                                                    if(file_exists($picturePath)) {
                                                        $picture	= '<img width="120" height="150" src="'.UPLOAD_URL . 'product/' . $value['name'] . DS . $value['picture1'].'">';
                                                    } else {
                                                        $picture	= '<img src="'.UPLOAD_URL . 'product/' . $value['name'] . DS . '98x150-default.jpg' .'">';
                                                    }

                                            $row        = ($i % 2) == 0 ? 'row0' : 'row1';
                                            // Change on: action, column in database, fuction + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                            $status		= Helper::cmsOther($value['status'], URL::createLink('admin', 'comment', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);

                                            $date       = $value['date'];
                                            $user       = $value['fullname'];
                                            $modified   = $value['modified'];
                                            $modifiedBy = $value['modified_by'];

                                            echo '<tbody>
                                                    <tr class="'.$row.'">
                                                        <td class="center">'.$ckb.'</td>
                                                        <td class="center">'.$picture.'</td>
                                                        <td class="center">'.$name.'</td>
                                                        <td>'.$content.'</td>
                                                        <td class="center">'.$status.'</td>
                                                        <td class="center">'.$user.'</td>
                                                        <td class="center">'.$date.'</td>
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
