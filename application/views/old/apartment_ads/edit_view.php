<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'apartment_ads/edit/'.$ad_id;
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
    $ap_id = $ad_details->ap_id;
	$ad_price = $ad_details->price;
    $price_setting = $ad_details->price_setting;
    $availability_flag = $ad_details->availability_flag;
	$ad_desc = $ad_details->ad_desc;
    $avail_date = $ad_details->next_avail_date;
    $ref_image=$ad_details->ref_image;
   //$ap_city_name = $apartment_details->a_cityname;
}
else if ($posted_data) {
    //set input values from post request.
    $ad_name = $posted_data['ad_name'];
    $ap_id=$posted_data['ap_id'];
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
      <legend><label class="default_font_color">Update Apartment Add</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
       
            <div class="col-lg-4">
                <label>Option Name <i class="required"> * </i> </label>
                <input name="ad_name" class="form-control" type="text" value="<?php echo set_value('ad_name',$ad_name); ?>">
            </div>
			<div class="col-lg-4">
                <label>Apartment Name <i class="required"> * </i> </label>
				<select name="ap_id" class="form-control">
				
				<?php if(!empty($apartment['list'])) {
				foreach($apartment['list']  as $key=>$value)
				{?>
				<option value="<?php echo $apartment['list'][$key]->a_id;?>"><?php echo $apartment['list'][$key]->a_name; ?></option>
				<?php }
				}
				else{?>
					<option>No Apartments To Show</option>
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
		 
             
        <div class="col-md-7">
            <div class="col-md-4">
                <img src="<?php echo asset_url()."uploads/apartment_ads/".$ref_image; ?>" class="img-responsive img-thumbnail" width="100px;"/>
            </div>
            <div class="col-md-8">
            
<label>Option Image</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input type="file" class="form-control" name="userfile">
            </div>
        </div>

            <div class="col-lg-5">
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
                <textarea name="ad_desc" class="form-control" rows="4" cols="50"><?php echo $ad_desc;?></textarea>
            </div>
           
            <div class="col-md-12 text-center">
                <input type="submit" name="" value="Submit" class="btn hoverable_btn">
            </div>
        </div>
</div>   
</div>