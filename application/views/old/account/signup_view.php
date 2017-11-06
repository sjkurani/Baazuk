<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('account/signup','id=account_signup_frm');

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
<div class="signin-wrapper jumbotron" data-login-message="false">
    <div class="jumbotron1 main-content">
        <div class="row">
            <h3 class="text-center">Sign in to Media Basket</h3>
        </div>
            <section class="tab-pane fade in active" id="buyer">
                <form action="<?php echo base_url().'account/signup'; ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                                <label>Name</label>
                                <input name="user_name" placeholder="Your name"  class="form-control" type="text" autofocus value="<?php echo set_value('user_name'); ?>" />

                                <label>Email</label>
                                <input name="user_email" placeholder="Your Email Address"  class="form-control" type="text" value="<?php echo set_value('user_email'); ?>" />

                                <label>Phone Number</label>
                                <input name="user_phone" placeholder="Your Phone Number"  class="form-control" type="text" value="<?php echo set_value('user_phone'); ?>" />

                                <label>Password</label>
                                <input name="user_pass" placeholder="Your password..."   class="form-control" type="password" />

                                <label>User Type</label>
                                <?php
                                if($this->input->post()) {
                                    $user_type = $this->input->post('user_type');
                                }
                                else {
                                    $user_type = 'owner';
                                }
                                ?>
                                <select id="user_type" class="form-control"  name="user_type" />
                                    <option value="owner" <?php echo ($user_type == 'owner')? 'selected': '';?> >Owner</option>
                                    <option value="buyer" <?php echo ($user_type == 'buyer')? 'selected': '';?> >Buyer</option>
                                </select>
                                <br/>

                                <div class="row">     
                                    <div class="col-md-12">
                                        <label class="pull-right">Already have a account ?
                                        <a class="forgot pull-center" id="login-signup-link" href="<?php echo base_url().'account/signin'; ?>">Sign in now »</a>
                                        </label>                
                                    </div>
                                </div>
                            <center>
                                <button class="btn hoverable_btn" name="submit" type="submit" id="contact-submit" color="teal" data-submit="...Sending" value="buyer">Submit</button>
                            </center>
                        </div>
                    </div>
                </form>
            </section>
    </div>
</div>
        </div>
</form>