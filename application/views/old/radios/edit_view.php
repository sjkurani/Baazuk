<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'radio/edit/'.$radio_id;
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

if(empty($posted_data) && !empty($radio_details)) {
    //Default set values from db.
    $r_name = $radio_details->radio_station_name;
    $r_city = $radio_details->radio_station_city;
    $r_desc = $radio_details->radio_station_desc;
    $r_image= $radio_details->r_image;
}
else if ($posted_data) {
    //set input values from post request.
    $r_name = $posted_data['radio_name'];
    $r_city = $posted_data['city_name'];
    $r_desc = $posted_data['radio_desc'];
    $r_image= $posted_data['userfile'];
    

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
         <legend><label class="default_font_color">Update Radio Station</label>
            <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right" /></legend>
            
            <div class="col-md-6">
                <label>Radio Channel Name <i class="required"> * </i></label>
                <input name="radio_name" class="form-control" type="text" value="<?php echo set_value('radio_name', $r_name); ?>">
            </div>
            <div class="col-md-6">
                <label>Radio City Name <i class="required"> * </i></label>
                <input name="city_name" class="form-control" type="text" value="<?php echo set_value('city_name', $r_city); ?>">
            </div>

        <div class="col-md-12">
            <div class="col-md-2">
                  <img src="<?php echo asset_url()."uploads/radios/".$r_image; ?>" class="img-responsive img-thumbnail" width="100px;"/>
            </div>
            <div class="col-md-8">
            <label> Radio Image <i class="required"> * </i> 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
               <input name="userfile" class="form-control" type="file">
            </div>
        </div>



             <div class="col-md-12">
                <label>Radio Channel Description  <i class="required"> * </i></label>
                <textarea name="radio_desc" class="form-control" rows="8" cols="50" ><?php echo set_value('radio_desc',$r_desc); ?> </textarea>
            </div>

        <div class="col-md-12 text-center">
            <input type="submit" name="" value="Submit" class="btn hoverable_btn">
        </div>

        
    </div>

   
</div>