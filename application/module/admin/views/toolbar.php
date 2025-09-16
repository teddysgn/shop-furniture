<?php
    $controller = $this->arrParams['controller'];
//  Link

$linkNew                    = URL::createLink('admin', $controller, 'form');
$linkPublishStatus          = URL::createLink('admin', $controller, 'status', array('type' => 1));
$linkUnPublishStatus        = URL::createLink('admin', $controller, 'status', array('type' => 0));
$linkPublishSpecial         = URL::createLink('admin', $controller, 'special', array('type' => 1));
$linkUnPublishSpecial       = URL::createLink('admin', $controller, 'special', array('type' => 0));
$linkCompleted              = URL::createLink('admin', $controller, 'completed', array('type' => 1));
$linkUnCompleted            = URL::createLink('admin', $controller, 'completed', array('type' => 0));
$linkTrash                  = ($this->arrParams['filter_trash'] == 1) ? URL::createLink('admin', $controller, 'delete') : URL::createLink('admin', $controller, 'trash');
$linkRestore                = ($this->arrParams['filter_trash'] == 1) ? URL::createLink('admin', $controller, 'restore') : '';
$linkOrdering               = URL::createLink('admin', $controller, 'ordering');
$linkQuantity               = URL::createLink('admin', $controller, 'quantity');
$linkReport                 = 'application\module\admin\views\order\download.php';
//  Button
$btnNew                     = Helper::cmsButton('Create', 'toolbar-new', $linkNew, 'zmdi zmdi-plus');
$btnPublishStatus           = Helper::cmsButton('Status', 'toolbar-publish', $linkPublishStatus, 'zmdi zmdi-check', 'submit');
$btnPublishSpecial          = Helper::cmsButton('Special', 'toolbar-publish', $linkPublishSpecial, 'zmdi zmdi-check', 'submit');
$btnUnPublishStatus         = Helper::cmsButton('Status', 'toolbar-unpublish', $linkUnPublishStatus, 'fa-solid fa-xmark', 'submit');
$btnUnPublishSpecial        = Helper::cmsButton('Special', 'toolbar-unpublish', $linkUnPublishSpecial, 'fa-solid fa-xmark', 'submit');
$btnCompleted               = Helper::cmsButton('Completed', 'toolbar-unpublish', $linkCompleted, 'fa-solid fa-check', 'submit');
$btnUnCompleted             = Helper::cmsButton('Completed', 'toolbar-unpublish', $linkUnCompleted, 'fa-solid fa-xmark', 'submit');
$btnTrash                   = ($this->arrParams['filter_trash'] == 1) ? Helper::cmsButton('Delete', 'toolbar-trash', $linkTrash, 'zmdi zmdi-delete', 'submit', true, 'Do you want to delete this?') : Helper::cmsButton('Trash', 'toolbar-trash', $linkTrash, 'zmdi zmdi-delete', 'submit', true, 'Do you want to move this to trash??');
$btnRestore                 = ($this->arrParams['filter_trash'] == 1) ? Helper::cmsButton('Restore', 'toolbar-trash', $linkRestore, 'zmdi zmdi-time-restore-setting', 'submit') : '';
$btnOrdering                = Helper::cmsButton('Order', 'toolbar-checkin', $linkOrdering, 'zmdi zmdi-spinner', 'submit');
$btnQuantity                = Helper::cmsButton('Quantity', 'toolbar-checkin', $linkQuantity, 'zmdi zmdi-edit', 'submit');
$btnDownload                = Helper::cmsButton('Download', 'toolbar-checkin', $linkReport, 'zmdi zmdi-download');;


// ACTION
$linkStatus     = URL::createLink('admin', 'user', 'index');
$linkAddUser	= URL::createLink('admin', 'user', 'form');



?>

<div class="row mt-3">
    <div class="col-lg-12"  style="width: 100%">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                    if($controller != 'order' && $controller != 'group'){
                        echo ' <div class="col-xl-3 icon mb-3" style="width: 50%">
                                    '.$btnNew.'
                                </div>';
                    }
                    ?>
                    <?php
                    if($controller != 'cost'){
                        echo ' <div class="col-xl-3 icon mb-3" style="width: 50%">
                                    '.$btnPublishStatus.'
                                </div>
                                <div class="col-xl-3 icon mb-3" style="width: 50%">
                                    '.$btnUnPublishStatus.'
                                </div>';
                    }
                    ?>
                    <?php
                    if($controller != 'order' && $controller != 'cost' && $controller != 'comment'){
                        echo ' <div class="col-xl-3 icon mb-3" style="width: 50%">
                                    '.$btnOrdering.'
                                </div>';
                    }
                    if($controller == 'product'){
                        echo '<div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                 '.$btnPublishSpecial.'
                              </div>
                              <div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                 '.$btnUnPublishSpecial.'
                              </div>';
                        if($this->arrParams['filter_trash'] == 1)
                        echo '<div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                 '.$btnRestore.'
                              </div>';
                    }
                    if($controller == 'order'){
                        echo '<div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                     '.$btnCompleted.'
                                  </div>
                                  <div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                     '.$btnUnCompleted.'
                                  </div>
                                  <div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                      <form action="'.$linkReport.'">
                                         '.$btnDownload.'
                                         </form>
                                  </div>';
                    }

                    if($controller == 'coupon'){
                        echo '<div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                     '.$btnQuantity.'
                                  </div>';
                    }

                    if($controller != 'group'){
                        echo '<div class="col-xl-3 icon mb-3" style="width: 50%" data-code="f3ec" data-name="spinner">
                                     '.$btnTrash.'
                                  </div>';
                    }
                    ?>
                </div><!--End Row-->
            </div>
        </div>
    </div>
</div>
<script>
        function geek(url, message) {
            let result = confirm(message);
            if (result === true) {
                $('#adminForm').attr('action', url);
                $('#adminForm').submit();
            }
        }
    </script>