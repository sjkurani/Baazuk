<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'owner/apartments/edit/'.$apartment_id;
    echo form_open_multipart($full_url);

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

if(empty($posted_data) && !empty($apartment_details)) {
    //Default set values from db.
    $ap_name = $apartment_details->a_name;
    $ap_area = $apartment_details->a_area;
    $ap_loc = explode(",", $apartment_details->a_location);
    $ap_lat = $ap_loc[0];
    $ap_lng = $ap_loc[1];
    $ap_loc_name = $apartment_details->a_location_name;
	$ap_category = $apartment_details->a_category;
    $ap_flats = $apartment_details->a_flats;
    $ap_desc = $apartment_details->a_desc;
   //$ap_city_name = $apartment_details->a_cityname;
}
else if ($posted_data) {
    //set input values from post request.
    $ap_name = $posted_data['apartment_name'];
    $ap_area = $posted_data['apartment_area'];
    $ap_lat = $posted_data['map_lat'];
    $ap_lng = $posted_data['map_lang'];
    $ap_loc_name = $posted_data['apartment_loc'];
 // $ap_city_name = $posted_data['apartment_loc'];
	$ap_category = $posted_data['apartment_category'];
    $ap_flats = $posted_data['apartment_flats'];
	$ap_desc = $posted_data['apartment_desc'];

}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Apartment Name</label>
                <input name="apartment_name" class="form-control" type="text" value="<?php echo set_value('apartment_name',$ap_name); ?>">
            </div>
			<div>
                <label>Apartment Image</label>
                <input type="file" class="form-control" name="userfile" value="<?php echo set_value('userfile',$ap_name); ?>">
            </div>
			<div>
                <label>Apartment Area</label>
                <input name="apartment_area" class="form-control" type="text" value="<?php echo set_value('apartment_area',$ap_area); ?>">
            </div>
			 <div>
                <label>Apartment Location</label>
                <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('apartment_loc',$ap_loc_name); ?>">
            </div>
			<div>
                <label>Apartment Category</label>
                <input name="apartment_category" class="form-control" type="text" value="<?php echo set_value('apartment_category',$ap_category); ?>">
            </div>
			<div>
                <label>No. Of Flats</label>
                <input name="apartment_flats" class="form-control" type="text" value="<?php echo set_value('apartment_flats',$ap_flats); ?>">
            </div>
            
            <div>
                <label>Apartment Description</label>
                <textarea name="apartment_desc" class="form-control" rows="4" cols="50"><?php echo $ap_desc;?></textarea>
            </div>
           
            <div id="map"></div>
            <div>
               <label>Latitude</label>  <input id="map_lat" name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat',$ap_lat); ?>">
                <label>Longitude</label><input id="map_lang" name="map_lang" class="form-control" type="hidden1" value="<?php echo set_value('map_lang',$ap_lng); ?>">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>