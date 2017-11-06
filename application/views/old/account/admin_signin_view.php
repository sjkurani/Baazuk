<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
        <div class="row">
            <h3 class="text-center"> ADMIN LOGIN </h3>
        </div>
 <section class="tab-pane fade in active" id="admin">
            <?php echo form_open('admin/signin'); ?>

                <label>Email / Mobile</label><i class="redstar">*</i>
                <input class="form-control" type="text" name="admin_email_mobile" value="<?php echo set_value('admin_email_mobile'); ?>" >

                <label>Password</label><i class="redstar">*</i>
                <input class="form-control" type="password" name="admin_password" value="" >
                <br>
                

                <div class="row text-center">
                    <label><button type="submit" class="submit btn hoverable_btn" name="submit_btn" value="admin" >Sign in</button></label>
                </div>
                </form>

                 <input type="hidden" class="verify" name="verify_both"/>
</section>
</div>