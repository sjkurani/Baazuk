<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'malls/edit/'.$mall_id;
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
    $mall_location_name= $mall_details->mall_location_name;
    $mall_image= $mall_details->img_name;
}
else if ($posted_data) {
    //set input values from post request.
    $mall_name = $posted_data['mall_name'];
    $mall_desc = $posted_data['mall_desc'];
    $mall_area = $posted_data['mall_area'];
    //$mall_img = $posted_data['mall_img'];
    $mall_city_name=$posted_data['mall_city_name'];

    $mall_loc = $posted_data['mall_loc'];
    $mall_location = explode(",", $mall_loc);
    $mall_lat = $posted_data['map_lat'];
    $mall_lng = $posted_data['map_lang'];
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
         <legend><label class="default_font_color">Update Mall</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            <div class="col-md-4">
                <label>Mall Name <i class="required"> * </i></label>
                <input name="mall_name" class="form-control" type="text" value="<?php echo set_value('mall_name',$mall_name); ?>">
            </div>
           
        <div class="col-md-8">
            <div class="col-md-2">
                 <img src="<?php echo asset_url()."uploads/malls/".$mall_image; ?>" class="img-responsive img-thumbnail" width="100px;"/>
            </div>
            <div class="col-md-8">
            <label> Mall Image <i class="required"> * </i> 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
               <input name="userfile" class="form-control" type="file">
            </div>
        </div>



			<div class="col-md-4">
                <label>Mall Location <i class="required"> * </i></label>
                <input name="mall_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('mall_loc',$mall_location_name); ?>">
            </div>

       <div class="col-md-4">  
            <label>City <i class="required"> * </i></label>
            <input id="locality" name="mall_city_name" class="form-control" value="<?php echo set_value('mall_city_name',$mall_city_name); ?>" >
        </div> 

         <div class="col-md-4">
                <label>Mall Area <i class="required"> * </i></label>
                <input name="mall_area" class="form-control" type="text"  type="text"  value="<?php echo set_value('mall_area',$mall_area); ?>">
            </div>
 
            
        <div class="col-md-6">
            <div id="map" style="height:400px;"></div>
        </div> 
        <div class="col-md-6">
                <label>Mall Description <i class="required"> * </i></label>
                <textarea name="mall_desc" class="form-control" rows="8" cols="50"><?php echo $mall_desc;?></textarea>
            </div>   
        
   <legend></legend>
        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text" value="<?php echo set_value('map_lat',$mall_lat); ?>"> 
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text" value="<?php echo set_value('map_lang',$mall_lng); ?>">
            <input type="submit" name="" value="Submit" class="btn hoverable_btn">
        </div>
        
    </div>
</div>
