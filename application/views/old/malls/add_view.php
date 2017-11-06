<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'malls/add');

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
       <legend><label class="default_font_color">Create New Mall</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
       
            <div class="col-md-6">
                <label>Mall Name <i class="required"> * </i></label>
                <input name="mall_name" class="form-control" type="text" value="<?php echo set_value('mall_name'); ?>">
            </div>
            <div class="col-md-6">
                <label>Mall Image <i class="required"> * </i>
</label><small class="col-md-12"> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input name="userfile" class="form-control" type="file" >
            </div>
            
            
			     <div class="col-md-4">
                <label>Mall Location <i class="required"> * </i></label>
                <input name="mall_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('mall_loc'); ?>">
            </div>
         <div class="col-md-4">  
            <label>City <i class="required"> * </i></label>
            <input id="locality" name="mall_city_name" class="form-control" value="<?php echo set_value('mall_city_name'); ?>" >
          </div> 

          <div class="col-md-4">
                <label>Mall Area <i class="required"> * </i></label>
                <input name="mall_area" class="form-control" id="pac-input1" type="text" type="text" value="<?php echo set_value('mall_area'); ?>">
            </div>

            <div class="col-md-6">
            <div id="map" style="height:400px;"></div>
       </div>

          <div class="col-md-6">
                <label>Mall Description <i class="required"> * </i></label>
                <textarea name="mall_desc" class="form-control" rows="16" cols="50" > <?php echo set_value('mall_desc'); ?></textarea>
            </div>  
      
 

        <legend></legend>
        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text">
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>


			
           <!-- <table id="address" style="width: 100%;">
      <tr>
        <td class="label hidden">Street address</td>
        <td class="slimField  hidden"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField hidden" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td>City</td>
        <!-- Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        -->
       <!-- <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true" class="form-control"></input></td>
      </tr>
      <tr>
        <td>State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label hidden">Zip code</td>
        <td class="wideField hidden"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td>Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
    </table>-->

            
       
    </div>
</div>
