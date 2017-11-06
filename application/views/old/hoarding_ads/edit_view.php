<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'hoarding_ads/edit/'.$h_id;
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

if(empty($posted_data) && !empty($ad_details)) {
    //Default set values from db.
    $h_name = $ad_details->h_title;
    $h_size = $ad_details->h_size;
    $h_light = $ad_details->h_light;
    $city_name = $ad_details->h_cityname;
    $h_location = $ad_details->h_location_name;
    $h_loc = explode(",", $ad_details->h_location);
    $map_lat = @$h_loc[0];
    $map_lang = @$h_loc[1];
    $h_area = $ad_details->h_area;
    $h_terms_cond = $ad_details->h_terms_cond;
    $h_name = $ad_details->h_title;
	$h_price = $ad_details->price;
    $price_setting = $ad_details->price_setting;
    $availability_flag = $ad_details->availability_flag;
    $h_desc = $ad_details->h_desc;
    $avail_date = $ad_details->next_avail_date;
    $ref_image=  $ad_details->ref_image;
   //$ap_city_name = $apartment_details->a_cityname;
}
else if ($posted_data) {
    //set input values from post request.
    $h_name = $posted_data['h_name'];
    $h_size = $posted_data['h_size'];
    $h_area = $posted_data['h_area'];
    $h_terms_cond = $posted_data['h_terms_cond'];
    $h_light = $posted_data['h_light'];
    $h_location = $posted_data['h_location'];
    $city_name = $posted_data['city_name'];
	$map_lat = $posted_data['map_lat'];
    $map_lang = $posted_data['map_lang'];
    $h_price = $posted_data['h_price'];
    $price_setting = $posted_data['price_setting'];
    $availability_flag = $posted_data['availability_flag'];
    $avail_date = $posted_data['next_avail_date'];
	$h_desc = $posted_data['h_desc'];

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
	          <legend><label class="default_font_color">Edit Hoarding</label>
                <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            <div class="col-md-3">
				<label>Hoarding Name<i class="required"> * </i></label>
					<input name="h_name" class="form-control" type="text" value="<?php echo set_value('h_name',$h_name); ?>">
		   </div>


             <div class="col-md-3">
					<label>Hoarding Size<i class="required"> * </i></label>
					<input name="h_size" class="form-control" type="text" value="<?php echo set_value('h_size',$h_size); ?>">
		   </div>

		 <div class="col-md-6">
            <div class="col-md-3">
                <img src="<?php echo asset_url()."uploads/hoarding_ads/".$ref_image; ?>" class="img-responsive img-thumbnail" width="100px;"/>
            </div>
            <div class="col-md-8">
            <label>Option Image
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input type="file" class="form-control" name="userfile">
            </div>
        </div>
				
				
				
				<div class="col-md-6">
					<label>Hoarding light<i class="required"> * </i></label>
				  
					<select name="h_light" class="form-control" value="<?php echo set_value('h_light'); ?>">
					  <?php if($h_light=="luminous"){?>
					<option value="luminous" selected>Luminous</option>
					<option value="non_luminous">Non Luminous</option>
					  <?php } 
					  else {
					  ?><option value="luminous">Luminous</option>
					<option value="non_luminous" selected >Non Luminous</option>
					  <?php }?>
					</select>
				</div>
				
				
                <div class="col-md-6">
					<label>Hoarding Price<i class="required"> * </i></label>
					<input name="h_price" class="form-control" type="text" value="<?php echo set_value('h_price',$h_price); ?>">
				</div>

               <div class="col-md-4">
					 <div><label class="">Price setting<i class="required"> * </i></label></div>
					 <div>
					 <?php if($price_setting==1){?>
					<label class="radio-inline"><input type="radio" name="price_setting" value="1" checked />Show Price</label>
				   <label class="radio-inline"><input type="radio" name="price_setting" value="0" />Hide Price</label>
					 <?php } 
					 else { ?>
					<label class="radio-inline" ><input type="radio" name="price_setting" value="1"  />Show Price</label>
					<label class="radio-inline"><input type="radio" name="price_setting" value="0" checked />Hide Price</label>
					 <?php } ?>
					 </div>
				</div>
                
				<div class="col-md-4">
					<div><label class="">Availability<i class="required"> * </i></label></div>
					<div> <?php if($availability_flag==1)
					 {?>
						<label class="radio-inline"><input type="radio" id="noCheck" name="availability_flag"  checked value="1" onclick="javascript:check()"/>Available</label>
						<label class="radio-inline"><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()"/>Not Available</label>
					<?php } 
					 else { ?>
						 <label class="radio-inline"><input type="radio" id="noCheck" name="availability_flag"  value="1" onclick="javascript:check()"/>Available</label>
						<label class="radio-inline"><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()" checked />Not Available</label>
					<?php } ?>
					</div>
				</div> 
				 <?php if($availability_flag==1)
				 {?>
						<div id="ifYes" style="display:none;" class="col-md-4" >
							 <label>Next Available Date</label>
							 <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'); ?>" >
						</div>
				<?php } 
					 else { ?>
							 <div id="ifYes" class="col-md-4">
								 <label>Next Available Date</label>
								 <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'),$avail_date; ?>" >
							 </div>
					<?php  }?>
				
				 <div class="clearfix"></div>
				

				<div class="col-md-4">
					<label>Hoarding Location<i class="required"> * </i></label>
					<input name="h_location" class="form-control" id="pac-input" type="text" type="text" placeholder="Enter a location" value="<?php echo set_value('h_location',$h_location); ?>">
				</div>
				<div class="col-md-4">
                <label>Hoarding City<i class="required"> * </i></label>
                 <input type="text" id="locality" name="city_name" class="form-control" value="<?php echo set_value('city_name',$city_name);?>"/>
                </div>
                <div class="col-md-4">
					<label>Hoarding Area<i class="required"> * </i></label>
					<input name="h_area" class="form-control" type="text" value="<?php echo set_value('h_area',$h_area); ?>">
				</div>
			    
				
				<div class="clearfix"></div>		
				
		
         <div class="col-md-6" >
				<div id="map"></div>
		</div>
		
		<div class="col-md-6">
					<label>Hoarding Description<i class="required"> * </i></label>
					<textarea name="h_desc" class="form-control" rows="8" cols="50"><?php echo $h_desc;?></textarea>
		</div>
		<legend></legend>
        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text" value="<?php echo set_value('map_lat',$map_lat); ?>">
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text" value="<?php echo set_value('map_lang',$map_lang); ?>">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>	
				
				 
		 </div>
           
       
    </div>
</div>