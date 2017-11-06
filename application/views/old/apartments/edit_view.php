<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'apartments/edit/'.$apartment_id;
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
    $type_of_aprtment = $apartment_details->type_of_aprtment;
    $num_of_flats = $apartment_details->num_of_flats;
    $ap_desc = $apartment_details->a_desc;
    $a_image = $apartment_details->a_image;
    $city_name = $apartment_details->a_cityname;
}
else if ($posted_data) {
    //set input values from post request.
    $ap_name = $posted_data['apartment_name'];
    $ap_area = $posted_data['apartment_area'];
    $ap_lat = $posted_data['map_lat'];
    $ap_lng = $posted_data['map_lang'];
    $ap_loc_name = $posted_data['apartment_loc'];
    $city_name = $posted_data['city_name'];
	$ap_category = $posted_data['apartment_category'];
    $type_of_aprtment = $posted_data['type_of_aprtment'];
    $num_of_flats = $posted_data['num_of_flats'];
	$ap_desc = $posted_data['apartment_desc'];

    
}
/*elseif (empty($apartment_details)) {
        $this->session->set_flashdata('errormsg', "You are not authorised to access that page.");
        redirect(base_url().'dashboard/'.$session_user_type);
}*/
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
        <legend><label class="default_font_color">Edit Apartment</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
        <div class="col-md-4">
            <label>Apartment Name <i class="required"> * </i> </label>
            <input name="apartment_name" class="form-control" type="text" value="<?php echo set_value('apartment_name',$ap_name); ?>">
        </div>
		<div class="col-md-8">
            
            <div class="col-md-2">
                <img src="<?php echo asset_url()."uploads/apartments/".$a_image; ?>" class="img-responsive img-thumbnail" width="100px;"/>
            </div>
            <div class="col-md-8">
            <label>Apartment Image <i class="required"> * </i> 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input type="file" class="form-control" name="userfile">
            </div>
        </div>
        <div class="col-md-4">
            <label>Apartment Category <i class="required"> * </i> </label>
            <input name="apartment_category" class="form-control" type="text" value="<?php echo set_value('apartment_category',$ap_category); ?>">
        </div>
        <div class="col-md-4">
            <label>Type of Apartment<i class="required"> * </i> </label>
            <select name="type_of_aprtment" class="form-control">
			<?php if($type_of_aprtment=="Class A"){?>
				<option value="Class A" selected >Class A</option>
				<option value="Class B">Class B</option>
			<?php } else {?>
			    <option value="Class A">Class A</option>
				<option value="Class B" selected>Class B</option>
			<?php }?>
			</select>
			 </div>
        <div class="col-md-4">
            <label>No. Of Flats <i class="required"> * </i> </label>
            <input name="num_of_flats" class="form-control" type="text" value="<?php echo set_value('num_of_flats',$num_of_flats); ?>">
        </div>
         <div class="col-md-4">
            <label>Apartment Location <i class="required"> * </i> </label>
            <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('apartment_loc',$ap_loc_name); ?>">
        </div>

        <div class="col-md-4">
            <label>Apartment City <i class="required"> * </i> </label>
            <input type="text" id="locality" name="city_name" class="form-control" value="<?php echo set_value('city_name',$city_name); ?>">
        </div>
		<div class="col-md-4">
            <label>Apartment Area <i class="required"> * </i> </label>
            <input name="apartment_area" class="form-control" type="text" value="<?php echo set_value('apartment_area',$ap_area); ?>">
        </div>
        <div class="col-md-6"><div id="map" style="height:400px;"></div></div>
        <div class="col-md-6">
            <label>Apartment Description <i class="required"> * </i> </label>
            <textarea name="apartment_desc" class="form-control" rows="8" cols="50"><?php echo $ap_desc;?></textarea>
        </div>
        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text" value="<?php echo set_value('map_lat',$ap_lat); ?>"> 
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text" value="<?php echo set_value('map_lang',$ap_lng); ?>">
            <input type="submit" name="" value="Submit" class="btn hoverable_btn">
        </div>
        </div>
    </div>
</div>