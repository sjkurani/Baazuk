<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'apartments/add');

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
        <legend><label class="default_font_color">Create New Apartment</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
        <div class="col-md-6">
            <label>Apartment Name <i class="required"> * </i> </label>
            <input name="apartment_name" class="form-control" type="text" value="<?php echo set_value('apartment_name'); ?>">
        </div>
        <div class="col-md-6">
            <label>Apartment Image <i class="required"> * </i>
</label><small class="col-md-12"> (Image max size:2MB & Image type: gif, jpg, png.)</small> </label>
            <input type="file" name="userfile" size="20" class="form-control" />
        </div>
        <div class="col-md-6">
            <label>Apartment Category <i class="required"> * </i> </label>
            <input type="text" name="apartment_category" class="form-control" value="<?php echo set_value('apartment_category'); ?>" />
        </div>
        <div class="col-md-6">
			<label>Type Of Apartment<i class="required"> * </i> </label>
			<select name="type_of_aprtment" class="form-control">
			<option value="Class A">Class A</option>
			<option value="Class B">Class B</option>
			</select>
        </div>                
        <div class="col-md-6">
			<label>No. Of Flats <i class="required"> * </i> </label>
			<input type="text" name="num_of_flats" class="form-control" value="<?php echo set_value('num_of_flats'); ?>" />
			</div>
        <div class="col-md-6">
            <label>Apartment Location <i class="required"> * </i> </label>
            <input name="apartment_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('apartment_loc'); ?>">
        </div>
        <div class="col-md-6">
            <label>Apartment City <i class="required"> * </i> </label>
            <input type="text" id="locality" name="city_name" class="form-control" value="<?php echo set_value('city_name'); ?>"/>
        </div>
        <div class="col-md-6">
            <label>Apartment Area <i class="required"> * </i> </label>
            <input type="text" name="apartment_area" id="pac-input1"  class="form-control" value="<?php echo set_value('apartment_area'); ?>"/>
        </div>
        <div class="col-md-6"><div id="map" style="height:400px;"></div></div>
        <div class="col-md-6">
            <label>Apartment Description <i class="required"> * </i> </label>
            <textarea name="apartment_desc" class="form-control" rows="16" cols="50" > <?php echo set_value('apartment_desc'); ?></textarea>
        </div>
        <legend></legend>
        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text">
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>
    </div>
</div>