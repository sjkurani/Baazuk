<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if($apartment_add_id != 0 ) {
    $full_url = base_url().'apartment_ads/add/'.$apartment_add_id;
}
else {
    $full_url = base_url().'apartment_ads/add/';    
}
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
			<?php if($apartment_add_id != 0 ) { ?>
						<legend><label class="default_font_color">Create New Apartment Ads</label>
						<input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
						<div class="col-lg-4">
							<label>Option Name <i class="required"> * </i> </label>
							<input name="ad_name" class="form-control" type="text" value="<?php echo set_value('ad_name'); ?>">
						</div>
						<div class="col-lg-4">
							<label>Option Price <i class="required"> * </i> </label>
							<input type="text" name="ad_price" class="form-control" value="<?php echo set_value('ad_price'); ?>" />
						</div>
						<div class="col-lg-4">
						   <?php echo "<select name='ap_id' class='hidden'><option value=".$apartment_add_id." ></option></select>"; ?>
						</div>
						<div class="col-lg-6">   
							<label>Option Image <i class="required"> * </i> 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
							<input type="file" name="userfile" class="form-control" size="20"value="<?php echo set_value('ad_name'); ?>"/>
						</div>
						 <div class="col-lg-4">
							<label>Price setting <i class="required"> * </i> </label>
							<input type="radio" name="price_setting" value="1" checked />Show Price
							<input type="radio" name="price_setting" value="0" />Hide Price
						</div>
						<div class="col-lg-4">
						</div>
						<div class="col-lg-4">
							<label>Availability <i class="required"> * </i> </label>
							<label><input type="radio" id="noCheck" name="availability_flag"  checked value="1" onclick="javascript:check()"/>Available</label>
							<label><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()"/>Not Available</label>
						</div> 
						<div id="ifYes" style="display:none;" class="col-lg-6">
							 <label>Next Available Date <i class="required"> * </i></label>
							 <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'); ?>" >
						</div>
						<div class="col-lg-12">
							<label>Option Description <i class="required"> * </i> </label>
							<textarea name="ad_desc" class="form-control" rows="4" cols="50" ><?php echo set_value('ad_desc'); ?></textarea>
						</div>
						<div class="col-md-12 text-center">
				            <input type="submit" name="" value="Submit" class="btn hoverable_btn">
				        </div>
			<?php }
			else {
					if(!empty($apartment['list'])) {?>
							<legend><label class="default_font_color">Create New Apartment Ads</label>
							<input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
							<div class="col-lg-4">
								<label>Option Name <i class="required"> * </i> </label>
								<input name="ad_name" class="form-control" type="text" value="<?php echo set_value('ad_name'); ?>">
							</div>
							<div class="col-lg-4">
								<label>Option Price <i class="required"> * </i> </label>
								<input type="text" name="ad_price" class="form-control" value="<?php echo set_value('ad_price'); ?>" />
							</div>
							<div class="col-lg-4">
								<label>Apartment Name <i class="required"> * </i> </label>
								<select name="ap_id" class="form-control">
									<?php foreach($apartment['list']  as $key=>$value) {?>
										<option value="<?php echo $apartment['list'][$key]->a_id;?>"><?php echo $apartment['list'][$key]->a_name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-lg-6">   
								<label>Option Image <i class="required"> * </i> </label>
								<input type="file" name="userfile" class="form-control" size="20"value="<?php echo set_value('ad_name'); ?>"/>
							</div>
							 <div class="col-lg-6">
								<label>Price setting <i class="required"> * </i> </label>
								<input type="radio" name="price_setting" value="1" checked />Show Price
								<input type="radio" name="price_setting" value="0" />Hide Price
							</div> 
							<div class="col-lg-6">
								<label>Availability <i class="required"> * </i> </label>
								<label><input type="radio" id="noCheck" name="availability_flag"  checked value="1" onclick="javascript:check()"/>Available</label>
								<label><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()"/>Not Available</label>
							</div> 
							<div id="ifYes" style="display:none;" class="col-lg-6">
								 <label>Next Available Date <i class="required"> * </i></label>
								 <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'); ?>" >
							</div>
							<div class="col-lg-12">
								<label>Option Description <i class="required"> * </i> </label>
								<textarea name="ad_desc" class="form-control" rows="4"><?php echo set_value('ad_desc'); ?></textarea>
							</div>
							<div class="col-md-12 text-center">
					            <input type="submit" name="" value="Submit" class="btn hoverable_btn">
					        </div>
					<?php }
					else { ?>
						<div class="col-md-12 text-center">
							<h3>No Apartments Found.Please Add Apartments First</h3>
							<a href="<?php echo base_url()?>apartments">Go back to Apartments</a>
						</div>
				<?php }
			}?>
       
    </div>

</div>
</div>
</form>
</body>

