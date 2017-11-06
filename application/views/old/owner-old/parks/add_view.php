<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open(base_url().'owner/parks/add');

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
                <label>Business Park Name</label>
                <input name="park_name" class="form-control" type="text">
            </div>
            <div>
                <label>Business Park Image</label>
                <input type="file" class="form-control" name="park_img" />
            </div>
            <div>
                <label>Business Park Description</label>
                <textarea name="park_desc" class="form-control" rows="4" cols="50"></textarea>
            </div>
            <div>
                <label>Business Park Location</label>
                <input name="park_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location">
            </div>
            <div id="map" style="height:400px;"></div>
            <div>
                <input id="map_lat" name="map_lat" class="form-control" type="hidden1">
                <input id="map_lang" name="map_lang" class="form-control" type="hidden1">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>