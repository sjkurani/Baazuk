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
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Apartment Name</label>
                <input name="apartment_name" class="form-control" type="text">
            </div>
            <div>
                <label>Apartment Image</label>
                <input type="file" name="userfile" size="20" />
            </div><div>
                <label>Apartment Area</label>
                <input type="text" name="apartment_area" class="form-control" />
            </div>
			<div>
                <label>Apartment Location</label>
                <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location">
            </div>
			<div>
                <label>Apartment Category</label>
                <input type="text" name="apartment_category" class="form-control" />
            </div>
			<div>
                <label>No. Of Flats</label>
                <input type="text" name="apartment_flats" class="form-control" />
            </div>
            <div>
                <label>Apartment Description</label>
                <textarea name="apartment_desc" class="form-control" rows="4" cols="50"></textarea>
            </div>
            
            <div id="map" style="height:400px;"></div>
            <div>
               <label>Latitude</label>  <input id="map_lat" name="map_lat" class="form-control" type="hidden1">
                 <label>Longitude</label><input id="map_lang" name="map_lang" class="form-control" type="hidden1">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>