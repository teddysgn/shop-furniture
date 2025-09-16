<?php
// Save
$linkSave                   = URL::createLink('default', 'user', 'profile', array('type' => 'save'));
$linkBecomeDesigner         = URL::createLink('default', 'user', 'designer');
$linkDesigner               = URL::createLink('designer', 'index', 'index');


$userObj    = Session::get('user');

// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);

$notice     = '';
$recently   = '';
$time       = date('Y-m-d H:i:s', time());

foreach ($this->arrayParam['notice'] as $key => $value){
    $date1 = new DateTime($time);
    $date2 = $date1->diff(new DateTime($value['time']));

    $timeStamp = '';

    if($date2->days >= 30 && $date2->y < 1)
        $timeStamp = $date2->m . ' month ago';
    elseif($date2->days >= 1 && $date2->m < 12)
        $timeStamp = $date2->days . ' days ago';
    elseif($date2->h >= 1 && $date2->h < 24)
        $timeStamp = $date2->h . ' hours ago';
    elseif($date2->i >= 1 && $date2->i < 60)
        $timeStamp = $date2->i . ' mins ago';
    elseif($date2->s >= 0 && $date2->s < 60)
        $timeStamp = $date2->s . ' seconds ago';
    $notice .= '<tr>
                    <td title="'.$value['time'].'">
                        <div class="col-md-8">
                            <p style="width: 100%; text-align: left" class="float-right font-weight-bold">'.$value['name'].'</p> 
                        </div>
                        <div class="col-md-4">
                            <p  style="width: 50%; text-align: right" class="float-right font-weight-bold">'. $timeStamp.'</p> 
                        </div>
                    </td>
                </tr>';
}
foreach ($this->arrayParam['noticeRecently'] as $key => $value){
    $date1 = new DateTime($time);
    $date2 = $date1->diff(new DateTime($value['time']));

    $timeStamp = '';

    if($date2->days >= 30 && $date2->y < 1)
        $timeStamp = $date2->m . ' month ago';
    elseif($date2->days >= 1 && $date2->m < 12)
        $timeStamp = $date2->days . ' days ago';
    elseif($date2->h >= 1 && $date2->h < 24)
        $timeStamp = $date2->h . ' hours ago';
    elseif($date2->i >= 1 && $date2->i < 60)
        $timeStamp = $date2->i . ' mins ago';
    elseif($date2->s >= 0 && $date2->s < 60)
        $timeStamp = $date2->s . ' seconds ago';
    $recently .= '<tr>
                    <td class="row" title="'.$value['time'].'">
                        <div class="col-md-8">
                            <p style="width: 100%; text-align: left" class="float-right font-weight-bold">'.$value['name'].'</p> 
                        </div>
                        <div class="col-md-4">
                            <p  style="width: 50%; text-align: right" class="float-right font-weight-bold">'. $timeStamp.'</p> 
                        </div>
                    </td>
                </tr>';
}
?>


<div id="fh5co-user">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="system-message-container"></br><?php echo $strMessage . $this->error . $this->errorPassword;?></div>
                <div class="fh5co-tabs animate-box">
                    <ul class="fh5co-tab-nav">
                        <li style="width: 33.33%" class="active"><a href="#" data-tab="1"><span style="margin: 0"><i class="fa-solid fa-circle-info"></i>&nbsp; PROFILE</span></a></li>
                        <li style="width: 33.33%"><a href="#" data-tab="2"><span style="margin: 0"><i class="fa-solid fa-envelope"></i>&nbsp; NOTICE</span></a></li>
                        <li style="width: 33.33%"><a href="#" data-tab="3"><span style="margin: 0"><i class="fa-solid fa-pen-to-square"></i>&nbsp; EDIT</span></a></li>
                    </ul>
                    <!-- Tabs -->
                    <div class="fh5co-tab-content-wrap">
                        <div class="fh5co-tab-content tab-content active container" data-tab-content="1">
                            <h1 class="mb-3">User Profile</h1>
                            <div class="row container">
                                <div class="col-md-12 row container">
                                    <div class="col-md-4">
                                        <h6>Name</h6>
                                        <p style="font-weight: bold">
                                            <?php echo $this->arrayParam['form']['fullname']?>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                    <h6>Email</h6>
                                    <p style="font-weight: bold">
                                        <?php echo $this->arrayParam['form']['email']?>
                                    </p>
                                    </div>
                                        <div class="col-md-4">
                                    <h6>Username</h6>
                                    <p style="font-weight: bold">
                                        <?php echo $this->arrayParam['form']['username']?>
                                    </p>

                                        </div>
                                    <div class="col-md-4">
                                        <h6>Total Value Order</h6>
                                        <p style="font-weight: bold">
                                            <?php echo number_format($this->total['total'])?>
                                        </p>

                                    </div>
                                    <div class="col-md-4">
                                        <h6>Member Rank</h6>
                                        <p style="font-weight: bold">
                                            <?php echo $this->member['name']?>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Discount Member</h6>
                                        <p style="font-weight: bold">
                                            <?php echo $this->member['discount']?>%
                                        </p>
                                    </div>
                                    <?php
                                    if($this->arrayParam['form']['group_id'] == 2){
                                        if($this->request['name'] == null || $this->request == null){
                                            echo '   <div class="col-md-12">
                                           <a href="'.$linkBecomeDesigner.'">
                                                <input style="width: 100%; padding: 15px"  name="form[submit]" class="btn btn-primary" value="BECOME OUR DESIGNER">
                                            </a>
                                        </div>';
                                        } else{
                                            echo '  <div class="col-md-4">
                                                        <h6>Request Designer</h6>
                                                        <p style="font-weight: bold">
                                                            Pending
                                                        </p>
                                                    </div>';
                                        }
                                    } else if($this->arrayParam['form']['group_id'] == 11){
                                        echo '<div class="col-md-4">
                                                    <h6>You are our Designer</h6>
                                                    <p style="font-weight: bold">
                                                        <a href="'.$linkDesigner.'">View your Theme</a>
                                                    </p>
                                                </div>';
                                    }
                                    ?>
                                </div>
                                <div class="col-md-12 container" style="margin-top: 5rem">
                                    <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Order Notifications</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                            <?php echo $recently;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fh5co-tab-content tab-content container" data-tab-content="2">
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>

                                <div class="alert-message">
                                    <span><strong>Info!</strong> You have some Notifications</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        <?php echo $notice; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="fh5co-tab-content tab-content container" data-tab-content="3">
                            <form action="<?php echo $linkSave?>" method="post" name="adminForm" id="adminForm" class="container">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" readonly name="form[username]" type="text" value="<?php echo $this->arrayParam['form']['username']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" required name="form[fullname]" type="text" value="<?php echo $this->arrayParam['form']['fullname']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" required name="form[email]" type="email" value="<?php echo $this->arrayParam['form']['email']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="form[address]" type="text" placeholder="Address" value="<?php echo $this->arrayParam['form']['address']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="form[phone]" type="text" placeholder="Phone" value="0<?php echo $this->arrayParam['form']['phone']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Old Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" required name="form[old_password]" type="password" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="form[new_password]" type="password" value="<?php echo $this->arrayParam['form']['new_password']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="form[confirm_password]" type="password" value="<?php echo $this->arrayParam['form']['confirm_password']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="hidden" name="form[token]" value="<?php echo time();?>">
                                        <input type="hidden" name="form[id]" value="<?php echo $userObj['info']['id'];?>">
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
</div>

