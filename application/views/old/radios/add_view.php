<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart (base_url().'radio/add');

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
         <legend><label class="default_font_color">Create New Radio Station</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            <div class="col-md-4">
                <label>Radio Channel Name <i class="required"> * </i></label>
                <input name="radio_name" class="form-control" type="text" value="<?php echo set_value('radio_name'); ?>">
            </div>
            <div class="col-md-4">
                <label>Radio City Name <i class="required"> * </i></label>
                <input name="city_name"  id="searchTextField" class="form-control" type="text" autocomplete="on" value="<?php echo set_value('city_name'); ?>">

            </div>

            <div class="col-md-4">
                <label>Radio Image <i class="required"> * </i>
</label><small > (Image max size:2MB & Image type: gif, jpg, png.)</small>
                <input type="file" name="userfile" size="20" class="form-control" />
            </div>

            <div class="col-md-12">
                <label>Radio Channel Description <i class="required"> * </i></label>
                <textarea name="radio_desc" class="form-control" rows="4" cols="50" > <?php echo set_value('radio_desc'); ?>    </textarea>
            </div>

        <div class="col-md-12 text-center">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>
       
    </div>

   
</div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
        <script type="text/javascript">
               function initialize() {
                       var input = document.getElementById('searchTextField');
                       var autocomplete = new google.maps.places.Autocomplete(input);
               }
               google.maps.event.addDomListener(window, 'load', initialize);
       </script>