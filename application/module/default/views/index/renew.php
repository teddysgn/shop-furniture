<!-- LIST BOOKS -->
<div id="fh5co-start">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="fh5co-tabs animate-box">
                    <!-- Tabs -->
                    <div class="fh5co-tab-content tab-content fh5co-tab-nav" style="background-color: transparent;">
                        <div class="text-center">
                            <h2>Recover Your Password</h2>
                        </div>
                        <form action="#" method="post" name="adminForm" id="adminForm">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="form[username]" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="form[email]" type="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="form[token]" value="<?php echo time();?>">
                                    <input type="submit" name="form[submit]" class="btn btn-primary" value="Send Instructions">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-12 text-center fh5co-heading">
                <?php
                if(!isset($this->email['email']) && isset($_POST['form']['token'])){
                    echo '<h2>Notification</h2><span>Your `Email` And `Username` have not registered in Shop. yet!</span>';
                }
                ?>
                <span><?php echo $result;?></span>
            </div>
        </div>
    </div>




