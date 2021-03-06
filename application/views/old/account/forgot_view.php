<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('account/forgot','id=account_frgot_frm');

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


<div class="signup-wrapper">
<h1><legend>Reset Password</legend></h1>
    <label>User Type</label><i class="redstar">*</i>
    <select class="form-control" name="user_type">
        <option value="owner">Owner</option>
        <option value="buyer">Buyer</option>
    </select>
    <label>Enter your email id</label><i class="redstar">*</i>
    <input class="form-control" type="text" name="forgot_email" value="<?php echo set_value('forgot_email'); ?>" >

<div class="clearfix">
  <button type="submit" class="submit btn btn-purple">Send link to reset password</button>
</div>
</div>
</form>