<?php
    $user = $this->Items;
    $linkSave       = URL::createLink('admin', 'user', 'profile', array('type' => 'save'));

// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);


$notice = '';
$time = date('Y-m-d H:i:s', time());


foreach ($this->arrayParam['notice'] as $key => $value) {
    $date1 = new DateTime($time);
    $date2 = $date1->diff(new DateTime($value['time']));

    $timeStamp = '';

    if ($date2->days >= 30 && $date2->y < 1)
        $timeStamp = $date2->m . ' month ago';
    elseif ($date2->days >= 1 && $date2->m < 12)
        $timeStamp = $date2->days . ' days ago';
    elseif ($date2->h >= 1 && $date2->h < 24)
        $timeStamp = $date2->h . ' hours ago';
    elseif ($date2->i >= 1 && $date2->i < 60)
        $timeStamp = $date2->i . ' mins ago';
    elseif ($date2->s >= 0 && $date2->s < 60)
        $timeStamp = $date2->s . ' seconds ago';
    $notice .= '<tr>
                    <td class="row" title="' . $value['time'] . '" style="justify-content: space-between">
                        <div class="col-md-9">
                            <p style="width: 100%; text-align: left" class="float-right font-weight-bold"></p> ' . $value['name'] . '
                        </div>
                        <div class="col-md-3">
                            <p  style="width: 50%; text-align: right" class="float-right font-weight-bold"></p> ' . $timeStamp . '
                        </div>
                    </td>
                </tr>';
}
foreach ($this->arrayParam['noticeRecently'] as $key => $value) {
    $date1 = new DateTime($time);
    $date2 = $date1->diff(new DateTime($value['time']));

    $timeStamp = '';

    if ($date2->days >= 30 && $date2->y < 1)
        $timeStamp = $date2->m . ' month ago';
    elseif ($date2->days >= 1 && $date2->m < 12)
        $timeStamp = $date2->days . ' days ago';
    elseif ($date2->h >= 1 && $date2->h < 24)
        $timeStamp = $date2->h . ' hours ago';
    elseif ($date2->i >= 1 && $date2->i < 60)
        $timeStamp = $date2->i . ' mins ago';
    elseif ($date2->s >= 0 && $date2->s < 60)
        $timeStamp = $date2->s . ' seconds ago';
    $recently .= '<tr>
                    <td class="row" title="' . $value['time'] . '" style="justify-content: space-between">
                        <div class="col-md-9">
                            <p style="width: 100%; text-align: left" class="float-right font-weight-bold"></p> ' . $value['name'] . '
                        </div>
                        <div class="col-md-3">
                            <p  style="width: 50%; text-align: right" class="float-right font-weight-bold"></p> ' . $timeStamp . '
                        </div>
                    </td>
                </tr>';
}
?>
<div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
      <div class="row mt-3">
        <div class="col-12">
           <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="fa-solid fa-user"></i> <span class="hidden-xs">Profile</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="fa-solid fa-envelope"></i> <span class="hidden-xs">Messages</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-edit"></i> <span class="hidden-xs">Edit</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">User Profile</h5>
                    <div class="row">
                        <div class="col-12 row">
                            <div class="col-md-4">
                                <h6>Name</h6>
                                <p style="font-weight: bold">
                                    <?php echo $this->arrayParam['form']['fullname']?>
                                </p>
                            </div>
                            <div class="col-4">
                                <h6>Email</h6>
                                <p style="font-weight: bold">
                                    <?php echo $this->arrayParam['form']['email']?>
                                </p>
                            </div>
                            <div class="col-4">
                                <h6>Username</h6>
                                <p style="font-weight: bold">
                                    <?php echo $this->arrayParam['form']['username']?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Order Notifications</h5>

                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php echo $recently;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
                    <div class="alert alert-info alert-dismissible" role="alert">
				   <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <div class="alert-message">
                            <span><strong>Info!</strong> You have some Notifications</span>
                        </div>
                  </div>
                  <div>
                    <table class="table table-hover table-striped">
                        <tbody>
                        <?php echo $notice; ?>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane" id="edit">
                    <form action="<?php echo $linkSave?>" method="post" name="adminForm" id="adminForm">
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" readonly name="form[username]" type="text" value="<?php echo $this->arrayParam['form']['username']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Name</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" required name="form[fullname]" type="text" value="<?php echo $this->arrayParam['form']['fullname']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" required name="form[email]" type="email" value="<?php echo $this->arrayParam['form']['email']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Address</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" name="form[address]" type="text" placeholder="Address" value="<?php echo $this->arrayParam['form']['address']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Phone</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" name="form[phone]" type="text" placeholder="Phone" value="<?php echo $this->arrayParam['form']['phone']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Old Password</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" required name="form[old_password]" type="password" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">New Password</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" name="form[password]" type="password" value="<?php echo $this->arrayParam['form']['new_password']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label">Confirm password</label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input class="form-control" name="form[confirm_password]" type="password" value="<?php echo $this->arrayParam['form']['confirm_password']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-sm-12 col-12 col-form-label form-control-label"></label>
                            <div class="col-lg-9 col-sm-12 col-12">
                                <input type="hidden" name="form[token]" value="<?php echo time();?>">
                                <input type="hidden" name="form[id]" value="<?php echo $_SESSION['user']['info']['id'];?>">
                                <input type="reset" name="form[reset]" class="btn btn-secondary" value="Cancel">
                                <input type="submit" name="form[submit]" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      </div>
        
    </div>

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
	
    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->

	<!--End footer-->
	
	<!--start color switcher-->