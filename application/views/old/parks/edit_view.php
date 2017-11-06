<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'parks/edit/'.$park_id;
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


if(empty($posted_data) && !empty($park_details)) {

   
    //Default set values from db.
    $park_name = $park_details->park_name;
    $park_img = $park_details->park_image;
    $park_desc = $park_details->park_desc;
    $park_emp_str=$park_details->employee_strenght;
    $park_location_name =  $park_details->park_location_name;
    $park_loc =  $park_details->park_location;
    $park_location = explode(",", $park_loc);
    $park_lat = $park_location[0];
    $park_lng = $park_location[1];
    $park_cityname = $park_details->park_cityname;
    $park_area= $park_details->park_area;
    $key_companies= $park_details->key_companies;

}
else if ($posted_data) {

    $park_name = $posted_data['park_name'];
    $park_image = $posted_data['userfile'];
    $park_desc = $posted_data['park_desc'];
    $park_loc =  $posted_data['park_loc'];
    $park_location_name =  $posted_data['park_location_name'];
    $park_lat = $posted_data['map_lat'];
    $park_lng = $posted_data['map_lang'];
    $park_cityname = $posted_data['city_name'];
    $park_emp_str= $posted_data['emp_strenght'];
    $park_area= $posted_data['key_company'];
    $key_companies=  $posted_data['key_company'];
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
         <legend><label class="default_font_color">Update Business Park</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            <div class="col-md-4">
                <label>Business Park Name <i class="required"> * </i></label>
                <input name="park_name" class="form-control" type="text" value="<?php echo set_value('park_name',$park_name); ?>">
            </div>

            <div class="col-md-8">
                <div class="col-md-2">
                      <img src="<?php echo asset_url()."uploads/parks/".$park_img; ?>" class="img-responsive img-thumbnail" width="100px;"/>
                </div>
                <div class="col-md-8">
                <label> Business Park Image <i class="required"> * </i>
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small> </label>
                   <input name="userfile" class="form-control" type="file">
                </div>
            </div>
           
           <div class="col-md-6">
                <label>Employee Strenght <i class="required"> * </i> </label>
                <input name="emp_strenght" class="form-control" type="text"  placeholder="Enter a Employee Strength" value="<?php echo set_value('emp_strenght', $park_emp_str); ?>">
            </div>
             <div class="col-md-6">
                <label>Key Companies <i class="required"> * </i> </label>
                <input name="key_company" class="form-control" type="text"  placeholder="Enter a Key Companies" value="<?php echo set_value('key_company',$key_companies); ?>">
            </div>

            <div class="col-md-4">
                <label>Business Park Location <i class="required"> * </i></label>
                <input name="park_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('park_loc',$park_location_name); ?>">
            </div>
        <div class="col-md-4">
            <label>Business Park City Name <i class="required"> * </i> </label>
            <input type="text" id="locality" name="city_name" class="form-control" value="<?php echo set_value('city_name', $park_cityname); ?>"/>
        </div>
         <div class="col-md-4">
                <label>Business Park Area <i class="required"> * </i></label>
                <input name="park_area" class="form-control" type="text" placeholder="Enter a Park Area" value="<?php echo set_value('park_area',$park_area); ?>">
        </div>

         <div class="col-md-6">
            <div id="map" style="height:400px;"></div>
         </div> 

         <div class="col-md-6">
                <label>Business Park Description <i class="required"> * </i></label>
                <textarea name="park_desc" class="form-control" rows="8" cols="50"><?php echo set_value('park_desc', $park_desc);?></textarea>
            </div>

        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text" value="<?php echo set_value('map_lat',$park_lat); ?>"> 
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text" value="<?php echo set_value('map_lang',$park_lng); ?>">
            <input type="submit" name="" value="Submit" class="btn hoverable_btn">
        </div>

       
    </div>
</div>