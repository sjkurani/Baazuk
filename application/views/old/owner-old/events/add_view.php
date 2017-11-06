<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'owner/events/add');

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
                    <label>Event Title</label>
                    <input name="eve_title" class="form-control" type="text">
                </div>
                <div>
                    <label>Start Date</label>
                    <input name="start_date" class="form-control date_fields" type="text">
                </div>
                <div>
                    <label>End Date</label>
                    <input name="end_date" class="form-control date_fields" type="text">
                </div>
				<div>
                    <label>Event Image</label>
                    <input name="userfile"  type="file" size="20" >
                </div>
				<div>
                    <label>Event type</label>
                    <input name="eve_type" class="form-control" type="text">
                </div>
				 <div>
                    <label>Event Description</label>
                    <textarea name="eve_desc" class="form-control" rows="4" cols="50"></textarea>
                </div>
                
				<div>
                    <label>Event Terms and Condition</label>
                    <textarea name="term_condn" class="form-control" rows="4" cols="50"></textarea>
                </div>
				<div>
                    <label>Event Area</label>
                    <input name="eve_area" class="form-control" type="text"  type="text" >
                </div>
                <div>
                    <label>Event Location</label>
                    <input name="eve_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location">
                </div>
                <div id="map" style="height:400px;"></div>
               
                
            <div>
              <label>Latitude</label>  <input id="map_lat" name="map_lat" class="form-control" type="hidden1">
               <label>Longitude</label> <input id="map_lang" name="map_lang" class="form-control" type="hidden1">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>