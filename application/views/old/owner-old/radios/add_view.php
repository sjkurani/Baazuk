<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open(base_url().'owner/radio/add');

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
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Radio Channel Name</label>
                <input name="radio_name" class="form-control" type="text">
            </div>
            <div>
                <label>City Name</label>
                <input name="city_name" class="form-control" type="text">
            </div>
            <div>
                <label>Channel Description Name</label>
                <textarea name="radio_desc" class="form-control" ></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
                <input type="submit" name="" value="Submit" class="btn btn-success">
        </div>
    </div>
</div>
