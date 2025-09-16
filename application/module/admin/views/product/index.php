<?php
    // COLUMN
    $columnPost	    = $this->arrParams['filter_column'];
    $orderPost		= $this->arrParams['filter_column_dir'];
    $lblName        = Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost);
    $lblPicture     = Helper::cmsLinkSort('Picture', 'picture', $columnPost, $orderPost);
    $lblPrice       = Helper::cmsLinkSort('Price', 'price', $columnPost, $orderPost);
    $lblStock       = Helper::cmsLinkSort('Stock', 'stock', $columnPost, $orderPost);
    $lblSold        = Helper::cmsLinkSort('Sold', 'sold', $columnPost, $orderPost);
    $lblSaleOff     = Helper::cmsLinkSort('Sale Off', 'sale_off', $columnPost, $orderPost);
    $lblCategory    = Helper::cmsLinkSort('Category', 'category_id', $columnPost, $orderPost);
    $lblCollection  = Helper::cmsLinkSort('Collection', 'collection_id', $columnPost, $orderPost);
    $lblDesigner    = Helper::cmsLinkSort('Designer', 'designer_id', $columnPost, $orderPost);
    $lblStatus      = Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
    $lblSpecial     = Helper::cmsLinkSort('Special', 'special', $columnPost, $orderPost);
    $lblOrdering    = Helper::cmsLinkSort('Ordering', 'ordering', $columnPost, $orderPost);
    $lblView        = Helper::cmsLinkSort('View', 'view', $columnPost, $orderPost);
    $lblCreated     = Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
    $lblCreatedBy   = Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
    $lblModified    = Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
    $lblModifiedBy  = Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);
    $lblDeleted     = Helper::cmsLinkSort('Deleted', 'deleted', $columnPost, $orderPost);
    $lblDeletedAt   = Helper::cmsLinkSort('Deleted At', 'deleted_at', $columnPost, $orderPost);
    $lblDeletedBy   = Helper::cmsLinkSort('Deleted By', 'deleted_by', $columnPost, $orderPost);
    $lblID          = Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);

    // SELECT STATUS
    $arrStatus              = array('default' => 'Select Status', 0 => 'Unpublish', 1 => 'Publish');
    $selectboxStatus        = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, isset($this->arrParams['filter_state']) ? $this->arrParams['filter_state'] : 'default');

    // SELECT SPECIAL
    $arrSpecial			    = array('default' => 'Select Special', 1 => 'Yes',  0 => 'No');
    $selectboxSpecial	    = Helper::cmsSelectbox('filter_special', 'inputbox', $arrSpecial, isset($this->arrParams['filter_special']) ? $this->arrParams['filter_special'] : 'default');

    // SELECT CATEGORY
    $arrCategory            = $this->slbCategory;
    $selectboxCategory      = Helper::cmsSelectbox('filter_category_id', 'inputbox', $arrCategory, $this->arrParams['filter_category_id']);

    // SELECT COLLECTION
    $arrCollection          = $this->slbCollection;
    $selectboxCollection    = Helper::cmsSelectbox('filter_collection_id', 'inputbox', $arrCollection, $this->arrParams['filter_collection_id']);

    // SELECT DESIGNER
    $arrDesigner            = $this->slbDesigner;
    $selectboxDesigner      = Helper::cmsSelectbox('filter_designer_id', 'inputbox', $arrDesigner, $this->arrParams['filter_designer_id']);
    
    // SELECT DELETED
    $arrTrash			    = array('default' => 'Select Trash', 1 => 'In Trash',  0 => 'In Database');
    $selectboxTrash	    = Helper::cmsSelectbox('filter_trash', 'inputbox', $arrTrash, isset($this->arrParams['filter_trash']) ? $this->arrParams['filter_trash'] : 'default');


    // PAGINATION
    $paginationHTML = $this->pagination->showPaginator(URL::createLink('admin', 'product', 'index'));

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
                <?php
                    if(!empty($this->requestItems)) {
                ?>
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <form action="#" method="post" name="adminForm" id="adminForm" >
                                    <div class="card-header">
                                        <div>
                                           <h3>New Products from Designer</h3>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-borderless">
                                            <thead>
                                                <tr>
                                                    <th width="1%">
                                                        <input type="checkbox" name="checkall"">
                                                    </th>
                                                    <th width="1%" class="nowrap"><?php echo $lblID ?></th>
                                                    <th class="title"><?php echo $lblName ?></th>
                                                    <th width="10%"><?php echo $lblPicture ?></th>
                                                    <th width="8%"><?php echo $lblPrice ?></th>
                                                    <th width="8%"><?php echo $lblStock ?></th>
                                                    <th width="8%"><?php echo $lblSold ?></th>
                                                    <th width="10%"><?php echo $lblSaleOff ?></th>
                                                    <th width="10%"><?php echo $lblCategory ?></th>
                                                    <th width="10%"><?php echo $lblCollection ?></th>
                                                    <th width="10%"><?php echo $lblDesigner ?></th>
                                                    <th width="6%"><?php echo $lblStatus ?></th>
                                                    <th width="6%"><?php echo $lblSpecial ?></th>
                                                    <th width="6%"><?php echo $lblOrdering ?></th>
                                                    <th width="6%"><?php echo $lblView ?></th>
                                                    <th width="8%"><?php echo $lblCreated ?></th>
                                                    <th width="8%"><?php echo $lblCreatedBy ?></th>
                                                    <th width="10%"><?php echo $lblModified ?></th>
                                                    <th width="10%"><?php echo $lblModifiedBY ?></th>
                                                    <th width="10%"><?php echo $lblDeleted ?></th>
                                                    <th width="10%"><?php echo $lblDeletedAt ?></th>
                                                    <th width="10%"><?php echo $lblDeletedBy ?></th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $i = 0;
                                                foreach ($this->requestItems as $key => $value) {
                                                    $id         = $value['id'];
                                                    $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                                    $name       = $value['name'];

                                                    $picturePath= UPLOAD_PATH . 'product/' . $value['name'] . DS . $value['picture1'];
                                                    if(file_exists($picturePath)) {
                                                        $picture	= '<img width="120" height="150" src="'.UPLOAD_URL . 'product/' . $value['name'] . DS . $value['picture1'].'">';
                                                    } else {
                                                        $picture	= '<img src="'.UPLOAD_URL . 'product/' . $value['name'] . DS . '98x150-default.jpg' .'">';
                                                    }

                                                    $price          = $value['price'];
                                                    $stock          = $value['stock'];
                                                    $sold           = $value['sold'];
                                                    $saleoff        = $value['sale_off'];
                                                    $view           = $value['view'] == null ? 0 : $value['view'];
                                                    $categoryName   = $value['category_name'];
                                                    $collectionName = $value['collection_name'];
                                                    $DesignerName   = $value['designer_name'];
                                                    $row            = ($i % 2) == 0 ? 'row0' : 'row1';
                                                    // Change on: action, column in database, fuction + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                                    $status		    = Helper::cmsOther($value['status'], URL::createLink('admin', 'product', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);
                                                    $special	    = Helper::cmsSpecial($value['special'], URL::createLink('admin', 'product', 'ajaxSpecial', array('id' => $id, 'special' => $value['special'])), $id);


                                                    $ordering       = '<input type="number" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="text-center form-control">';
                                                    $created        = Helper::formatDate('d-m-Y', $value['created']);
                                                    $createdBy      = $value['created_by'];
                                                    $modified       = Helper::formatDate('d-m-Y', $value['modified']);
                                                    $modifiedBy     = $value['modified_by'];
                                                    $deleted        = $value['deleted'] == 0 ? 'In Trash' : '';
                                                    $deletedAt      = Helper::formatDate('d-m-Y', $value['deleted_at']);;
                                                    $deletedBy      = $value['deleted_by'];
                                                    $linkEdit       = URL::createLink('admin', 'product', 'form',array('id' => $id));

                                                    echo '<tbody>
                                                            <tr class="'.$row.'">
                                                                <td class="center">'.$ckb.'</td>
                                                                <td class="center">'.$id.'</td>
                                                                <td><a href="'.$linkEdit.'">'.$name.'</a></td>
                                                                <td class="text-center">'.$picture.'</td>
                                                                <td class="text-center">'.number_format($price).'</td>
                                                                <td class="text-center">'.$stock.'</td>
                                                                <td class="text-center">'.$sold.'</td>
                                                                <td class="text-center">'.$saleoff.'</td>
                                                                <td class="text-center">'.$categoryName.'</td>
                                                                <td class="text-center">'.$collectionName.'</td>
                                                                <td class="text-center">'.$DesignerName.'</td>
                                                                <td class="text-center">'.$status.'</td>
                                                                <td class="text-center">'.$special.'</td>
                                                                <td class="text-center">'.$ordering.'</td>
                                                                <td class="text-center">'.$view.'</td>
                                                                <td class="text-center">'.$created.'</td>
                                                                <td class="text-center">'.$createdBy.'</td>
                                                                <td class="text-center">'.$modified.'</td>
                                                                <td class="text-center">'.$modifiedBy.'</td>
                                                                <td class="text-center">'.$deleted.'</td>
                                                                <td class="text-center">'.$deletedAt.'</td>
                                                                <td class="text-center">'.$deletedBy.'</td>
                                                            </tr>
                                                         </tbody>';
                                                                    $i++;
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
                <?php
                    }
                ?>
            </div>

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
                                            echo $selectboxStatus.$selectboxSpecial.$selectboxCollection.$selectboxDesigner.$selectboxCategory.$selectboxDeleted.$selectboxTrash;
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="1%">
                                            <input type="checkbox" name="checkall"">
                                        </th>
                                        <th width="1%" class="nowrap"><?php echo $lblID ?></th>
                                        <th class="title"><?php echo $lblName ?></th>
                                        <th width="10%"><?php echo $lblPicture ?></th>
                                        <th width="8%"><?php echo $lblCost ?></th>
                                        <th width="8%"><?php echo $lblPrice ?></th>
                                        <th width="8%"><?php echo $lblStock ?></th>
                                        <th width="8%"><?php echo $lblSold ?></th>
                                        <th width="10%"><?php echo $lblSaleOff ?></th>
                                        <th width="10%"><?php echo $lblCategory ?></th>
                                        <th width="10%"><?php echo $lblCollection ?></th>
                                        <th width="10%"><?php echo $lblDesigner ?></th>
                                        <th width="6%"><?php echo $lblStatus ?></th>
                                        <th width="6%"><?php echo $lblSpecial ?></th>
                                        <th width="6%"><?php echo $lblOrdering ?></th>
                                        <th width="6%"><?php echo $lblView ?></th>
                                        <th width="8%"><?php echo $lblCreated ?></th>
                                        <th width="8%"><?php echo $lblCreatedBy ?></th>
                                        <th width="10%"><?php echo $lblModified ?></th>
                                        <th width="10%"><?php echo $lblModifiedBY ?></th>
                                        <th width="10%"><?php echo $lblDeleted ?></th>
                                        <th width="10%"><?php echo $lblDeletedAt ?></th>
                                        <th width="10%"><?php echo $lblDeletedBy ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if(!empty($this->Items)) {
                                        $i = 0;
                                        foreach ($this->Items as $key => $value) {
                                            $id         = $value['id'];
                                            $ckb        = '<input type="checkbox" name="cid[]" value="'.$id.'">';
                                            $name       = $value['name'];

                                            $picturePath= UPLOAD_PATH . 'product/' . $value['name'] . DS . $value['picture1'];
                                            if(file_exists($picturePath)) {
                                                $picture	= '<img width="120" height="150" src="'.UPLOAD_URL . 'product/' . $value['name'] . DS . $value['picture1'].'">';
                                            } else {
                                                $picture	= '<img src="'.UPLOAD_URL . 'product/' . $value['name'] . DS . '98x150-default.jpg' .'">';
                                            }

                                            $cost           = $value['cost'];
                                            $price          = $value['price'];
                                            $stock          = $value['stock'];
                                            $sold           = $value['sold'];
                                            $saleoff        = $value['sale_off'];
                                            $view           = $value['view'] == null ? 0 : $value['view'];
                                            $categoryName   = $value['category_name'];
                                            $collectionName = $value['collection_name'];
                                            $DesignerName   = $value['designer_name'];
                                            $row            = ($i % 2) == 0 ? 'row0' : 'row1';
                                            // Change on: action, column in database, fuction + element[id] in javascript.js, fuction Action + element ['task'] in Controller, option['task'] in Model
                                            $status		    = Helper::cmsOther($value['status'], URL::createLink('admin', 'product', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);
                                            $special	    = Helper::cmsSpecial($value['special'], URL::createLink('admin', 'product', 'ajaxSpecial', array('id' => $id, 'special' => $value['special'])), $id);


                                            $ordering       = '<input type="number" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="text-center form-control">';
                                            $created        = Helper::formatDate('d-m-Y', $value['created']);
                                            $createdBy      = $value['created_by'];
                                            $modified       = Helper::formatDate('d-m-Y', $value['modified']);;
                                            $modifiedBy     = $value['modified_by'];
                                            $deleted        = $value['deleted'] == 1 ? 'In Trash' : '';
                                            $deletedAt      = Helper::formatDate('d-m-Y', $value['deleted_at']);;
                                            $deletedBy      = $value['deleted_by'];
                                            $linkEdit       = URL::createLink('admin', 'product', 'form',array('id' => $id));

                                            echo '<tbody>
                                                    <tr class="'.$row.'">
                                                        <td class="center">'.$ckb.'</td>
                                                        <td class="center">'.$id.'</td>
                                                        <td><a href="'.$linkEdit.'">'.$name.'</a></td>
                                                        <td class="text-center">'.$picture.'</td>
                                                        <td class="text-center">'.number_format($cost).'</td>
                                                        <td class="text-center">'.number_format($price).'</td>
                                                        <td class="text-center">'.$stock.'</td>
                                                        <td class="text-center">'.$sold.'</td>
                                                        <td class="text-center">'.$saleoff.'</td>
                                                        <td class="text-center">'.$categoryName.'</td>
                                                        <td class="text-center">'.$collectionName.'</td>
                                                        <td class="text-center">'.$DesignerName.'</td>
                                                        <td class="text-center">'.$status.'</td>
                                                        <td class="text-center">'.$special.'</td>
                                                        <td class="text-center">'.$ordering.'</td>
                                                        <td class="text-center">'.$view.'</td>
                                                        <td class="text-center">'.$created.'</td>
                                                        <td class="text-center">'.$createdBy.'</td>
                                                        <td class="text-center">'.$modified.'</td>
                                                        <td class="text-center">'.$modifiedBy.'</td>
                                                        <td class="text-center">'.$deleted.'</td>
                                                        <td class="text-center">'.$deletedAt.'</td>
                                                        <td class="text-center">'.$deletedBy.'</td>
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
            </div>
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->

    </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->



</div>



