 <?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'hoarding_ads/add');

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
<script>
function check() {
if (document.getElementById('yesCheck').checked) {
    document.getElementById('ifYes').style.display = 'block';
} else {
    document.getElementById('ifYes').style.display = 'none';
}
}
</script>
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
			<legend>
					<label class="default_font_color">Create Hoardings</label>
					<input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" >
			</legend>
			   
            <div class="col-md-6">
                <label>Hoarding Name<i class="required"> * </i></label>
                <input name="h_name" class="form-control" type="text" value="<?php echo set_value('h_name'); ?>">
            </div>
			<div class="col-md-6">   
				<label >Hoarding Image<i class="required"> * </i>
</label><small><br/> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input type="file" name="userfile" class="form-control" value="<?php echo set_value('h_name'); ?>" style="width:100%"/>
            </div>
			
			<div class="col-md-6" >
                <label>Hoarding Size<i class="required"> * </i></label>
                <input name="h_size" class="form-control" type="text" value="<?php echo set_value('h_size'); ?>">
            </div>
			<div class="col-md-6">
                <label>Hoarding Light<i class="required"> * </i></label>
                
				<select name="h_light" class="form-control select" value="<?php echo set_value('h_light'); ?>">
				<option value="luminous" >Luminous</option>
				<option value="non_luminous">Non Luminous</option>
				</select>
            </div>
			
			
            <div class="col-md-6">
                <label>Hoarding Price<i class="required"> * </i></label>
                <input type="text" name="h_price" class="form-control" value="<?php echo set_value('h_price'); ?>" />
            </div>
            <div class="col-md-6">
                <div><label class="">Price setting<i class="required"> * </i></label></div>
                <div><label class="radio-inline"><input type="radio" name="price_setting" value="1" checked />Show Price</label>
                 <label class="radio-inline"><input type="radio" name="price_setting" value="0" />Hide Price</label></div>
            </div>
            
            <div class="col-md-6">
                <div><label class="">Availability<i class="required"> * </i></label></div>
                
                <label class="radio-inline"><input type="radio" id="noCheck" name="availability_flag"  checked value="1" onclick="javascript:check()"/>Available</label>
                <label class="radio-inline"><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()"/>Not Available</label>
           </div> 
            
            <div id="ifYes" style="display:none;" class="col-md-4" >
                 <label>Next Available Date</label>
                 <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'); ?>" >
            </div>

			<div class="col-md-4">
                <label>Hoarding Location<i class="required"> * </i></label>
                <input name="h_location" class="form-control " type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('h_location'); ?>">
            </div>
           
			<div class="col-md-4">
                <label>Hoarding City<i class="required"> * </i></label>
                 <input type="text" id="locality" name="city_name" class="form-control" value="<?php echo set_value('city_name');?>"/>
            </div>
            <div class="col-md-4">
                <label>Hoarding Area<i class="required"> * </i></label>
                <input name="h_area" class="form-control" id="pac-input1" type="text" value="<?php echo set_value('h_area'); ?>">
            </div>
             <div class="col-md-4">
                <label>Hoarding Landmark<i class="required"> * </i></label>
               <input type="text" id="" name="h_landmark" class="form-control" value="<?php echo set_value('h_landmark');?>"/>
            </div>
			
			<div class="clearfix"></div>
			<div  class="col-md-6">
				<div id="map" style="height:400px;"></div>
			</div>

			<div class="col-md-6 hidden">
                <label>Hoarding Terms and Condition<i class="required"> * </i></label>
                 <textarea  name="h_terms_cond" class="form-control" rows="8" cols="50"><?php echo set_value('h_terms_cond');?></textarea>
            </div>

			<div class="col-md-6">
                <label>Hoarding Description<i class="required"> * </i></label>
                <textarea name="h_desc" class="form-control" rows="8" cols="50" ><?php echo set_value('h_desc'); ?></textarea>
            </div>
			<legend></legend>
         <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text">
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>
		
		
		   
    </div>
	</div>
