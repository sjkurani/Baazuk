<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'owner/malls/edit/'.$mall_id;
    echo form_open_multipart($full_url);

//echo form_open(base_url().'owner/events/add');

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
/*echo "<pre>";
print_r($posted_data);
print_r($mall_details);
echo "</pre>";*/
if(empty($posted_data) && !empty($mall_details)) {
    //Default set values from db.
    $mall_name = $mall_details->mall_name;
    $mall_desc = $mall_details->mall_desc;
    $mall_area = $mall_details->mall_area;
    $mall_loc =  $mall_details->mall_location;
    $mall_location = explode(",", $mall_loc);
    $mall_lat = $mall_location[0];
    $mall_lng = $mall_location[1];
    $mall_city_name = $mall_details->city_name;
}
else if ($posted_data) {
    //set input values from post request.
    $mall_name = $posted_data['mall_name'];
    $mall_desc = $posted_data['mall_desc'];
    $mall_area = $posted_data['mall_area'];
    //$mall_img = $posted_data['mall_img'];

    $mall_loc =  $posted_data['mall_loc'];
    $mall_location = explode(",", $mall_loc);
    $mall_lat = $posted_data['map_lat'];
    $mall_lng = $posted_data['map_lang'];
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Mall Name</label>
                <input name="mall_name" class="form-control" type="text" value="<?php echo set_value('mall_name',$mall_name); ?>">
            </div>
            <div>
                <label>Mall Image</label>
                <input name="userfile" class="form-control" type="file">
            </div>
            <div>
                <label>Mall Description</label>
                <textarea name="mall_desc" class="form-control" rows="4" cols="50"><?php echo $mall_desc;?></textarea>
            </div>
            <div>
                <label>Mall Area</label>
                <input name="mall_area" class="form-control" type="text"  type="text"  value="<?php echo set_value('mall_area',$mall_area); ?>">
            </div>
			<div>
                <label>Mall Location</label>
                <input name="mall_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('mall_loc',$mall_city_name); ?>">
            </div>
            <div id="map" style="height:400px;"></div>
            <div>
                <input id="map_lat" name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat',$mall_lat); ?>">
                <input id="map_lang" name="map_lang" class="form-control" type="hidden1" value="<?php echo set_value('map_lang',$mall_lng); ?>">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>
