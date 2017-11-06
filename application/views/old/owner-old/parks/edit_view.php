<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'owner/parks/edit/'.$park_id;
    echo form_open($full_url);

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


if(empty($posted_data) && !empty($park_details)) {

    echo "<pre>";
    print_r($park_details);
    echo "</pre>";
    //Default set values from db.
    $park_name = $park_details->park_name;
    $park_img = $park_details->park_name;
    $park_desc = $park_details->park_desc;
    $park_loc =  $park_details->park_location;
    $park_location = explode(",", $park_loc);
    $park_lat = $park_location[0];
    $park_lng = $park_location[1];
    $park_cityname = $park_details->park_cityname;

}
else if ($posted_data) {


    echo "<pre>";
    print_r($posted_data);
    echo "</pre>";
    $park_name = $posted_data['park_name'];
    $park_img = $posted_data['park_name'];
    $park_desc = $posted_data['park_desc'];
    $park_loc =  $posted_data['eve_title'];
    $park_lat = $posted_data['map_lat'];
    $park_lng = $posted_data['map_lang'];
    $park_cityname = $posted_data['park_loc'];
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Business Park Name</label>
                <input name="park_name" class="form-control" type="text" value="<?php echo set_value('eve_title',$park_name); ?>">
            </div>
            <div>
                <label>Business Park Image</label>
                <input type="file" class="form-control" name="park_img"  value="<?php echo set_value('eve_title',$park_img); ?>">
            </div>
            <div>
                <label>Business Park Description</label>
                <textarea name="park_desc" class="form-control" rows="4" cols="50"><?php echo $park_desc;?></textarea>
            </div>
            <div>
                <label>Business Park Location</label>
                <input name="park_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('park_loc',$park_cityname); ?>">
            </div>
            <div id="map" style="height:400px;"></div>
            <div>
                <input id="map_lat" name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat',$park_lat); ?>">
                <input id="map_lang" name="map_lang" class="form-control" type="hidden1" value="<?php echo set_value('map_lang',$park_lng); ?>">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>