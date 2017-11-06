<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'owner/events/edit/'.$event_id;
    echo form_open_multipart($full_url);

//echo form_open_multipart(base_url().'owner/events/add');

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

if(empty($posted_data) && !empty($event_details)) {
    //Default set values from db.
    $event_name = $event_details->event_name;
    $event_desc = $event_details->event_desc;
    $event_type = $event_details->event_type;
    $start_date = $event_details->start_date;
    $end_date = $event_details->end_date;
    $event_terms = $event_details->terms_condn;
    $event_area =  $event_details->event_area;
    $event_loc =  $event_details->event_location;
    $event_location = explode(",", $event_loc);
    $event_lat = $event_location[0];
    $event_lng = $event_location[1];
}
else if ($posted_data) {
    //set input values from post request.
    $event_name = $posted_data['eve_title'];
    $event_desc = $posted_data['eve_desc'];
    $event_type = $posted_data['eve_type'];
    $start_date = $posted_data['start_date'];
    $end_date = $posted_data['end_date'];
    $event_terms = $posted_data['term_condn'];
    $event_area =  $posted_data['eve_area'];
    $event_loc =  $posted_data['eve_loc'];
    $event_location = explode(",", $event_loc);
    $event_lat = $event_location[0];
    $event_lng = $event_location[1];
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
                <div>
                    <label>Event Title</label>
                    <input name="eve_title" class="form-control" type="text" value="<?php echo set_value('eve_title',$event_name); ?>">
                </div>
                <div>
                    <label>Start Date</label>
                    <input name="start_date" class="form-control date_fields" type="text" value="<?php echo set_value('start_date',$start_date); ?>">
                </div>
                <div>
                    <label>End Date</label>
                    <input name="end_date" class="form-control date_fields" type="text" value="<?php echo set_value('end_date',$end_date); ?>">
                </div>
				<div>
                    <label>Event Image</label>
                    <input name="userfile"  type="file" size="20" value="<?php echo set_value('userfile',$event_name); ?>" >
                </div>
				<div>
                    <label>Event type</label>
                    <input name="eve_type" class="form-control" type="text" value="<?php echo set_value('eve_type',$event_type); ?>">
                </div>
				<div>
                    <label>Event Description</label>
                    <textarea name="eve_desc" class="form-control" rows="4" cols="50"> <?php echo set_value('eve_desc',$event_desc); ?></textarea>
                </div>
				  <div>
                    <label>Event Terms and Condition</label>
                    <textarea name="term_condn" class="form-control" rows="4" cols="50"><?php echo $event_terms;?></textarea>
                </div>
				<div>
                    <label>Event Area</label>
                     <input name="eve_area" class="form-control" type="text" value="<?php echo set_value('eve_area',$event_area); ?>">
                </div>
                <div>
                    <label>Event Location</label>
                    <input name="eve_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('eve_loc',$event_loc); ?>">
                </div>
                <div id="map" style="height:400px;"></div>
                
                
              
            <div>
                <input id="map_lat" name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat',$event_lat); ?>">
                <input id="map_lang" name="map_lang" class="form-control" type="hidden1" value="<?php echo set_value('map_lang',$event_lng); ?>">
            </div>
            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>