<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('account/signin','id=account_sigin_frm');

if($this->session->flashdata('msg')){ 
        echo ' <div class="alert alert-success row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('msg');
    echo '</b></div>';
}
if($this->session->flashdata('errormsg')){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('errormsg'); 
    echo '</b></div>';

}

if(isset($err_msg)){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $err_msg; 
    echo '</b></div>';

}
if (isset($msg)) {
        echo ' <div class="alert alert-success row"><b>
        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $msg;
    echo '</b></div>';
}

 if (validation_errors()){
    echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo validation_errors();
    echo '</b></div>';                                 
}
?>

    <div class="page-canvas">
        <div class="signin-wrapper jumbotron" data-login-message="false">
        <div class="row">
            <h3 class="text-center">Sign in to Media Basket</h3>
        </div>
        <ul class="nav nav-tabs nav-justified main-navs" id="navID">
                <li class="active"><a href="#owner" data-toggle="tab" aria-expanded="false">Owner</a></li>
                <li class="" ><a href="#buyer" data-toggle="tab" aria-expanded="true">Buyer</a></li>
        </ul>

        <div class="tab-content">
            <section class="tab-pane fade in active" id="owner">
            <?php echo form_open('account/signin','id=account_sigin_frm'); ?>

                <label>Email / Mobile</label><i class="redstar">*</i>
                <input class="form-control" type="text" name="owner_email_mobile" value="<?php echo set_value('owner_email_mobile'); ?>" >

                <label>Password</label><i class="redstar">*</i>
                <input class="form-control" type="password" name="owner_password" value="" >
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label><a class="pull-left" href="<?php echo base_url().'account/forgot'; ?>">Forgot  password?</a></label>                
                    </div>            
                    <div class="col-md-6">
                        <label class="text-right">Don't have a account yet?
                        <a class="forgot pull-center" id="login-signup-link" href="<?php echo base_url().'account/signup'; ?>">Signup now »</a>
                        </label>                
                    </div>
                </div>

                <div class="row text-center">
                    <label><button type="submit" class="submit btn hoverable_btn" name="submit_btn" value="owner">Sign in</button></label>
                </div>
                </form>
            </section>

            <section class="tab-pane fade in" id="buyer">
                <?php echo form_open('account/signin','id=account_sigin_frm'); ?>
                <label>Email / Mobile</label><i class="redstar">*</i>
                <input class="form-control" type="text" name="buyer_email_mobile" value="<?php echo set_value('buyer_email_mobile'); ?>" >

                <label>Password</label><i class="redstar">*</i>
                <input class="form-control" type="password" name="buyer_password" value="" >
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label><a class="pull-left" href="<?php echo base_url().'account/forgot'; ?>">Forgot  password?</a></label>                
                    </div>            
                    <div class="col-md-6">
                        <label class="text-right">Don't have a account yet?
                        <a class="forgot pull-center" id="login-signup-link" href="<?php echo base_url().'account/signup'; ?>">Signup now »</a>
                        </label>                
                    </div>
                </div>

                <div class="row text-center">
                    <label><button type="submit" class="submit btn hoverable_btn" name="submit_btn" value="buyer">Sign in</button></label>
                </div>
                </form>
            </section>
        </div>
        <input type="hidden" class="verify" name="verify_both"/>

        </div>
        </div>
    </div>
</form>