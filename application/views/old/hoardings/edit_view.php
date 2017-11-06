<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $full_url = base_url().'hoardings/edit/'.$h_id;
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


if(empty($posted_data) && !empty($hoarding_details)) {

   
    //Default set values from db.
    $hoarding_title = $hoarding_details->h_title;
    $hoarding_img =   $hoarding_details->h_image;
    $hoarding_desc =  $hoarding_details->h_desc;
    $hoarding_size=   $hoarding_details->h_size;
    $hoarding_loc=  $hoarding_details->h_location;
    $h_location = explode(",", $hoarding_loc);
    $hoarding_lat = $h_location[0];
    $hoarding_lng = $h_location[1];
    $hoarding_city = $hoarding_details->h_city;
    $hoarding_price = $hoarding_details->h_price;
    $hoarding_light = $hoarding_details->h_light;
    $hoarding_available= $hoarding_details->h_available;
    $hoarding_terms_con= $hoarding_details->h_terms_cond;


}
else if ($posted_data) {

    $hoarding_title = $posted_data['hoarding_title'];
    $hoarding_img = $posted_data['userfile'];
    $hoarding_desc = $posted_data['hoarding_desc'];
    $hoarding_size= $posted_data['hoarding_size'];
    $hoarding_city  =  $posted_data['hoarding_city'];
    $hoarding_lat = $posted_data['map_lat'];
    $hoarding_lng = $posted_data['map_lang'];
    $hoarding_price= $posted_data['hoarding_price'];
    $hoarding_light = $posted_data['hoarding_light'];
    $hoarding_available=$posted_data['hoarding_available'];
    $hoarding_terms_con=$posted_data['hoarding_terms_con'];
}
?>

<div class="container">
        <div class="row">
            <div class="col-md-3">
                <div>
                    <label>Hoarding Title</label>
                    <input name="hoarding_title" class="form-control" type="text" value="<?php echo set_value('hoarding_title', $hoarding_title); ?>">
                </div>

                 <div>
                    <label>Hoarding Location Image 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>

                     <?php
                      if(!empty($hoarding_img)) {
                     echo "<img src=".asset_url()."uploads/hoardings/".$hoarding_img." alt=".$hoarding_title."/>";
                      }
                   ?>

                    <input name="userfile" class="form-control" type="file">
                </div>
       

                <div>
                    <label>Hoarding Description</label>
                     <textarea name="hoarding_desc" class="form-control" rows="4" cols="50"><?php echo set_value('hoarding_desc', $hoarding_desc);?></textarea>
                </div>

                <div>
                    <label>Hoarding Size</label>
                    <input name="hoarding_size" class="form-control" type="text" value="<?php echo set_value('hoarding_size',$hoarding_size); ?>">
                </div>
                

                <div>
                    <label>Hoarding City</label>
                     <input name="hoarding_city" class="form-control"  id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('hoarding_city', $hoarding_city); ?>">
                </div>
                 <div id="map" style="height:400px;"></div>
               
                <div>
                    <label>map lat</label>
                    <input name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat',$hoarding_lat); ?>">
                </div>
                <div>
                    <label>map lang</label>
                    <input name="map_lang" class="form-control" type="hidden1" value="<?php echo set_value('map_lang', $hoarding_lng); ?>">
                </div>

                <div>
                    <label>Hoarding Price</label>
                    <input name="hoarding_price" class="form-control" type="text" value="<?php echo set_value('hoarding_price',$hoarding_price); ?>">
                </div>

                 <div>
                    <label>Hoarding Light</label>
                
                     <select class="form-control" name="hoarding_light" id="hoarding_light">
                        <option value=''>--Select Light Type--</option>
                        <option value="Luminous" <?php echo set_select('hoarding_light', 'Luminous',$hoarding_light); ?> >Luminous</option>
                        <option value="Non-Luminous" <?php echo set_select('hoarding_light', 'Non-Luminous',$hoarding_light);?>> Non-Lumionus </option>
                        
                    </select>
                </div>
          
                 <div>
                    <label>Hoarding Availability</label>
                    <input name="hoarding_available" class="form-control" type="text" value="<?php echo set_value('hoarding_available', $hoarding_available); ?>">
                </div>

                <div>
                    <label>Hoarding Terms and Conditions</label>
                    <input name="hoarding_terms_con" class="form-control" type="text" value="<?php echo set_value('hoarding_terms_con',$hoarding_terms_con); ?>">
                </div>

            </div>
        </div>

        <div class="row1">
            <div class="col-md-3">
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
