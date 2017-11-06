<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$frm_url = 'account/reset?email_id='.$email_id.'&token_id='.$token_id;
echo form_open($frm_url,'id=account_frgot_frm');

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
    <label>New password</label><i class="redstar">*</i>
    <input class="form-control" type="password" placeholder="Must be atleast 6 characters" name="reset_new_pwd">
    <label>Confirm new password</label><i class="redstar">*</i>
    <input class="form-control" type="password" placeholder="Must match the new password" name="match_reset_new_pwd">


<div class="clearfix">
  <button type="submit" class="reset_pwd_submit btn btn-info">Save</button>
</div>
</div>
</form>