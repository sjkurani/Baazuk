<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'hoarding_ads/edit/'.$ad_id;
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
    $ad_name = $ad_details->ad_title;
    $hoard_id = $ad_details->hd_id;
	$ad_price = $ad_details->price;
    $price_setting = $ad_details->price_setting;
    $availability_flag = $ad_details->availability_flag;
    $ad_desc = $ad_details->ad_desc;
    $avail_date = $ad_details->next_avail_date;
   //$ap_city_name = $apartment_details->a_cityname;
}
else if ($posted_data) {
    //set input values from post request.
    $ad_name = $posted_data['ad_name'];
	$hoard_id=$posted_data['hoard_id'];
    $ad_price = $posted_data['ad_price'];
    $price_setting = $posted_data['price_setting'];
    $availability_flag = $posted_data['availability_flag'];
    $avail_date = $posted_data['next_avail_date'];
	$ad_desc = $posted_data['ad_desc'];

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
    <div class="row well">
       <legend><label class="default_font_color">Update Hoarding Add</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            <div class="col-lg-4">
                <label>Option Name <i class="required"> * </i> </label>
                <input name="ad_name" class="form-control" type="text" value="<?php echo set_value('ad_name',$ad_name); ?>">
            </div>
			<div class="col-lg-4">
			<?php// print_r($ap_list);?>
                <label>Hoarding Name <i class="required"> * </i> </label>
				<select name="hoard_id" class="form-control">
				
				<?php if(!empty($hoarding['list'])) {
				foreach($hoarding['list']  as $key=>$value)
				{?>
				<option value="<?php echo $hoarding['list'][$key]->hoard_id;?>"><?php echo $hoarding['list'][$key]->hoard_id; ?></option>
				<?php }
				}
				else{?>
					<option>No Hoardings To Show</option>
				<?php }	?>
				</select>
            </div>
			<div class="col-lg-4">
                <label>Option Price <i class="required"> * </i> </label>
                <input name="ad_price" class="form-control" type="text" value="<?php echo set_value('ad_price',$ad_price); ?>">
            </div>
			 <div class="col-lg-6">
                <label>Price setting <i class="required"> * </i> </label>
				 <?php if($price_setting==1){?>
                <label><input type="radio" name="price_setting" value="1" checked />Show Price</label>
               <label><input type="radio" name="price_setting" value="0" />Hide Price</label>
				 <?php } 
				 else { ?>
				<label><input type="radio" name="price_setting" value="1"  />Show Price</label>
                <label><input type="radio" name="price_setting" value="0" checked />Hide Price</label>
				 <?php } ?>
            </div> 
			<div class="col-lg-6">
                <label>Availability <i class="required"> * </i> </label>
				 <?php if($availability_flag==1)
				 {?>
					<label><input type="radio" id="noCheck" name="availability_flag"  checked value="1" onclick="javascript:check()"/>Available</label>
					<label><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()"/>Not Available</label>
				<?php } 
				 else { ?>
					 <label><input type="radio" id="noCheck" name="availability_flag"  value="1" onclick="javascript:check()"/>Available</label>
					<label><input type="radio" id="yesCheck" name="availability_flag" value="0"  onclick="javascript:check()" checked />Not Available</label>
				<?php } ?>
            </div> 
			
			
            <div class="col-lg-6">
                <label>Option Image <i class="required"> * </i>
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small> </label>
                <input type="file" class="form-control" name="userfile" value="<?php echo set_value('userfile',$ad_name); ?>">
            </div>

            <div class="col-lg-6">
             <?php if($availability_flag==1)
             {?>
                <div id="ifYes" style="display:none;" >
                     <label>Next Available Date <i class="required"> * </i></label>
                     <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'); ?>" >
                </div>
            <?php } 
                 else { ?>
                     <div id="ifYes">
                         <label>Next Available Date <i class="required"> * </i></label>
                         <input name="next_avail_date" class="form-control date_fields" type="text" value="<?php echo set_value('next_avail_date'),$avail_date; ?>" >
                     </div>
                <?php  }?>

            </div>
            <div class="col-lg-12">
                <label>Option Description <i class="required"> * </i> </label>
                <textarea name="ad_desc" class="form-control" rows="16" cols="50"><?php echo $ad_desc;?></textarea>
            </div>
          
            <div class="col-md-12 text-center">
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
       
    </div>
</div>
</div>