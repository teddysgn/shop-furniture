<?php
    $userObj = Session::get('user');
    $message	= Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);
    $linkSave       = URL::createLink('default', 'user', 'designer');
    $linkProfile    = URL::createLink('default'     , 'user'    , 'profile' , array('id' => $userObj['info']['id']) , 'profile-'.$userObj['info']['id']);

?>
<div id="fh5co-user">
    <div class="container">
        <?php
            if ($this->request['name'] == null && $this->designer['designer_id'] == null){
        ?>
        <div class="text-center">
            <h1>LET’S START A CONVERSATION</h1>
            <p>Fill in the form to start a conversation about how we can help you in your contract project.</p>
        </div>
        </br>
        <div class="row">
            <div id="system-message-container"></br><?php echo $strMessage . $this->error;?></div>

            <form action="#" method="post" name="designerForm" id="designerForm" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="form[name]" type="text" value="<?php echo $_POST['form']['name']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Website</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="form[website]" type="text" value="<?php echo $_POST['form']['website']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Designer About</label>
                    <div class="col-lg-9">
                        <select class="form-control" name="form[design_about]">
                            <option selected value="default"></option>
                            <option value="Dining Room">Dining Room</option>
                            <option value="Bedroom">Bedroom</option>
                            <option value="Living Room">Living Room</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Profession</label>
                    <div class="col-lg-9">
                        <select class="form-control" name="form[profession]">
                            <option selected value="default"></option>
                            <option value="Interior Design">Interior Design</option>
                            <option value="Graphic Designer">Graphic Designer</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Picture Profile</label>
                    <div class="col-lg-9">
                        <input type="file" class="form-control" name="picture" type="text" value="<?php echo $_POST['form']['picture']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Message</label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="form[message]" type="text" value="<?php echo $this->arrayParam['form']['fullname']?>"></textarea>
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
            <?php
        } elseif($this->designer['designer_id'] != null){
            echo ' <div class="text-center">
                                <h1>YOU WERE OUR DESIGNER</h1>
                                <p>This page is unvailable for you</p>
                            </div>
                            </br>';
        } else {
                echo ' <div class="text-center">
                                <h1>YOUR REQUEST HAS BEEN SUBMITTED</h1>
                                <p>Please wait Administrator to Approve your Request</p>
                                <p>Click <a href="'.$linkProfile.'">here</a> to back your Profile</p>
                            </div>
                            </br>';
            }
        ?>
    </div>
</div>