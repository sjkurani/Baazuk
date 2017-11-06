<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'owner/apartments/add');

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
    <div class="row"><br>
    <legend><label>Add New Advertisment.</label></legend>
        <div class="col-md-6">
            <div>
                <label>Ad Title</label>
                <input name="apartment_name" class="form-control" type="text">
            </div>
            <div>
                <label>Ad Size</label>
                <input name="apartment_name" class="form-control" type="text">
            </div>
            <div>
                <label>Ad Location image</label>
                <input type="file" name="userfile" size="20" />
            </div>
            <div>
                <label>Ad Location</label>
                <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location">
            </div>

            <div id="map" style="height:400px;"></div>
            <div>
                <label>Ad Description</label>
                <textarea name="apartment_desc" class="form-control" rows="4" cols="50"></textarea>
            </div>
            <div>
                <label>Ad Specifications</label>
                <textarea name="apartment_desc" class="form-control" rows="4" cols="50"></textarea>
            </div>
            
            <div>
                <label>Price</label>                
                <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location">
            </div>
            <div>
                <label>Price Types</label>
                <select class="form-control">
                	<option>Per day</option>
                	<option>Per week</option>
                	<option>Per month</option>
                </select>
            </div>
            <div>
                <input id="map_lat" name="map_lat" class="form-control" type="hidden">
                <input id="map_lang" name="map_lang" class="form-control" type="hidden">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>