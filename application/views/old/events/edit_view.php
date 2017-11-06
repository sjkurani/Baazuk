<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'events/edit/'.$event_id;
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
    $event_cityname =  $event_details->event_cityname;
    $event_loc =  $event_details->event_location_name;
    $event_location = explode(",", $event_loc);
    $event_lat = $event_location[0];
    $event_lng = $event_location[1];
    $event_image= $event_details->event_image;
}
else if ($posted_data) {
    //set input values from post request.
    $event_name = $posted_data['eve_title'];
    $event_desc = $posted_data['eve_desc'];
    $event_type = $posted_data['event_type'];
    $start_date = $posted_data['start_date'];
    $end_date = $posted_data['end_date'];
    $event_terms = $posted_data['term_condn'];
    $event_area =  $posted_data['eve_area'];
    $event_location_name =  $posted_data['event_location_name'];
    $event_cityname =  $posted_data['city_name'];
    $event_loc =  $posted_data['eve_loc'];
    $event_location = explode(",", $event_loc);
    $event_lat = $posted_data['map_lat'];
    $event_lng = $posted_data['map_lang'];
}
?>
<div class="container">
<?php
if(isset($breadcrumb_array) && !empty($breadcrumb_array) && is_array($breadcrumb_array)) {
echo '<ul class="breadcrumb row custom-breadcrumb">';
 $count = count($breadcrumb_array);
 foreach ($breadcrumb_array as $key => $value) {
   if (--$count <= 0) {
     echo "<li class='active'>".$key."</li>";
       break;
   }
   echo '<li><a href='.$value.'>'.$key.'</a></li>';
 }
echo "</ul>";
}
?>

    <div class="row well">
        <legend><label class="default_font_color">Update Events and Exhibition</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>        
                <div class="col-md-4">
                    <label>Events and Exhibition Title <i class="required"> * </i></label>
                    <input name="eve_title" class="form-control" type="text" value="<?php echo set_value('eve_title',$event_name); ?>">
                </div>
                

         <div class="col-md-8">
            <div class="col-md-2">
               <img src="<?php echo asset_url()."uploads/events/".$event_image; ?>" class="img-responsive img-thumbnail" width="100px;"/> 
            </div>
            <div class="col-md-8">
            <label> Events and Exhibition Image <i class="required"> * </i> 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input name="userfile"  type="file" size="20" class="form-control" value="<?php echo set_value('userfile',$event_name); ?>" >
            </div>
        </div>



                <div class="col-md-4">
                    <label>Start Date <i class="required"> * </i></label>
                    <input name="start_date" class="form-control date_fields" type="text" value="<?php echo set_value('start_date',$start_date); ?>">
                </div>
                <div class="col-md-4">
                    <label>End Date <i class="required"> * </i></label>
                    <input name="end_date" class="form-control date_fields" type="text" value="<?php echo set_value('end_date',$end_date); ?>">
                </div>
				

                <div class="col-md-4">
                    <label>Events and Exhibition type  <i class="required"> * </i></label>
                
                    <select class="form-control" name="event_type" id="event_type">
                        <option value=''>--Select Events and Exhibition Type--</option>
                        
                        <?php if($event_type=="Exhibition"){?>
                        <option value="Exhibition" selected >Exhibition</option>
                        <option value="College/School Fest"> College/School Fest </option>

                        <option value="Conference" > Conference \</option>

                        <option value="Concert"> Concert/Entertainment  </option>

                        <option value="Corporate Internal Event"> Corporate Internal Event </option>
                        <?php }?>

                        <?php  if($event_type=="College/School Fest"){?>
                        
                        <option value="Exhibition">Exhibition</option>
                        <option value="College/School Fest" selected> College/School Fest </option>

                        <option value="Conference" > Conference </option>

                        <option value="Concert"> Concert/ Entertainment  </option>

                        <option value="Corporate Internal Event"> Corporate Internal Event </option>
                        <?php }?>

                        <?php  if($event_type=="Conference"){?>
                        <option value="Exhibition">Exhibition</option>
                        <option value="College/School Fest"> College/School Fest </option>

                        <option value="Conference" selected > Conference </option>

                        <option value="Concert"> Concert/Entertainment  </option>

                        <option value="Corporate Internal Event"> Corporate Internal Event </option>
                        <?php }?>

                      <?php  if($event_type=="Concert"){?>
                        <option value="Exhibition">Exhibition</option>
                        <option value="College/School Fest"> College/School Fest </option>

                        <option value="Conference"  > Conference </option>

                        <option value="Concert" selected> Concert/Entertainment  </option>

                        <option value="Corporate Internal Event"> Corporate Internal Event </option>
                        <?php }?>

                    <?php if($event_type=="Corporate Internal Event"){?>
                        <option value="Exhibition">Exhibition</option>
                        <option value="College/School Fest"> College/School Fest </option>

                        <option value="Conference"  > Conference </option>

                        <option value="Concert" > Concert/Entertainment  </option>

                        <option value="Corporate Internal Event" selected> Corporate Internal Event </option>
                        <?php }?>

                        
                    </select>
                </div>

                
                 <div class="col-md-4">
                    <label>Events and Exhibition Location <i class="required"> * </i></label>
                    <input name="eve_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('eve_loc',$event_loc); ?>">
                </div>
                <div class="col-md-4"> 
                <label>City <i class="required"> * </i></label><input  id="locality" name="city_name" class="form-control" value="<?php echo set_value('city_name',$event_cityname); ?>">
              </div>
              <div class="col-md-4">
                    <label>Events and Exhibition Area <i class="required"> * </i></label>
                     <input name="eve_area" class="form-control" type="text" value="<?php echo set_value('eve_area',$event_area); ?>">
                </div>
            <div class="col-md-6">
                <div id="map" style="height:400px;"></div>
            </div>

				<div class="col-md-6">
                    <label>Events and Exhibition Description <i class="required"> * </i></label>
                    <textarea name="eve_desc" class="form-control" rows="16" cols="50"> <?php echo set_value('eve_desc',$event_desc); ?></textarea>
                </div>
				
              
             
             <legend></legend>   
              
            <div class="col-md-12 text-center">
                <input id="map_lat" name="map_lat" class="form-control hidden"  value="<?php echo set_value('map_lat',$event_lat); ?>">
                <input id="map_lang" name="map_lang" class="form-control hidden"  value="<?php echo set_value('map_lang',$event_lng); ?>">
                <input type="submit" name="" value="Submit" class="btn hoverable_btn">
            </div>


    </div>
</div>