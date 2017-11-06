<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'parks/add');

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
     <legend><label class="default_font_color">Create New Business Park</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            <div class="col-md-6">
                <label>Business Park Name <i class="required"> * </i></label>
                <input name="park_name" class="form-control" type="text" placeholder="Enter a Park Name" value="<?php echo set_value('park_name'); ?>">
            </div>
            <div class="col-md-6">
                <label>Business Park Image <i class="required"> * </i>
</label><small class="col-md-12"> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input type="file" class="form-control" name="userfile" />
            </div>
            
             <div class="col-md-6">
                <label>Employee Strenght <i class="required"> * </i> </label>
                <input name="emp_strenght" class="form-control" type="text"  placeholder="Enter a Employee Strength" value="<?php echo set_value('emp_strenght'); ?>">
            </div>

            <div class="col-md-6">
                <label>Key Companies <i class="required"> * </i> </label>
                <input name="key_company" class="form-control" type="text"  placeholder="Enter a Key Companies" value="<?php echo set_value('key_company'); ?>">
            </div>

            <div class="col-md-4">
                <label>Business Park Location <i class="required"> * </i></label>
                <input name="park_loc" class="form-control" type="text" id="pac-input"  placeholder="Enter a location" value="<?php echo set_value('park_loc'); ?>">
            </div>
        <div class="col-md-4">
            <label>Business Park City Name <i class="required"> * </i> </label>
            <input type="text" id="locality" name="city_name" class="form-control" placeholder="Enter City" value="<?php echo set_value('city_name'); ?>"/>
        </div>
        <div class="col-md-4">
                <label>Business Park Area <i class="required"> * </i></label>
                <input name="park_area" class="form-control" id="pac-input1" type="text" placeholder="Enter a Park Area" value="<?php echo set_value('park_area'); ?>">
        </div>


          <div class="col-md-6">
             <div id="map" style="height:400px;"></div>
            </div>

         <div class="col-md-6">
                <label>Business Park Description <i class="required"> * </i></label>
                <textarea name="park_desc" class="form-control" rows="16" cols="50"> <?php echo set_value('park_desc'); ?></textarea>
            </div>

          

        <legend></legend>

        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text">
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>
        
    </div>
</div>