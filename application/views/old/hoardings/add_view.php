<?php
	
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'hoardings/add');

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
        <div class="row">
            <div class="col-md-6">
                <div>
                    <label>Hoarding Title</label>
                    <input name="hoarding_title" class="form-control" type="text" value="<?php echo set_value('hoarding_title'); ?>">
                </div>

                 <div>
                    <label>Hoarding Location Image 
</label><small> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                    <input name="userfile" class="form-control" type="file">
                </div>
       

                <div>
                    <label>Hoarding Description</label>
                     <textarea name="hoarding_desc" class="form-control" rows="4" cols="50"><?php echo set_value('hoarding_desc');?></textarea>
                </div>

                <div>
                    <label>Hoarding Size</label>
                    <input name="hoarding_size" class="form-control" type="text" value="<?php echo set_value('hoarding_size'); ?>">
                </div>
                

                <div>
                    <label>Hoarding City</label>
                     <input name="hoarding_city" class="form-control"  id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('hoarding_city'); ?>">
                </div>
                 <div id="map" style="height:400px;"></div>
               
                <div>
                    <label>map lat</label>
                    <input name="map_lat" class="form-control" type="hidden1" value="<?php echo set_value('map_lat'); ?>">
                </div>
                <div>
                    <label>map lang</label>
                    <input name="map_lang" class="form-control" type="hidden2" value="<?php echo set_value('map_lang'); ?>">
                </div>

                <div>
                    <label>Hoarding Price</label>
                    <input name="hoarding_price" class="form-control" type="text" value="<?php echo set_value('hoarding_price'); ?>">
                </div>

                <div>
                    <label>Hoarding Light</label>
                
                     <select class="form-control" name="hoarding_light" id="hoarding_light">
                        <option value=''>--Select Light Type--</option>
                        <option value="Luminous" <?php echo set_select('hoarding_light', 'Luminous'); ?> >Luminous</option>
                        <option value="Non-Luminous" <?php echo set_select('hoarding_light', 'Non-Luminous');?>> Non-Lumionus </option>
                        
                    </select>
                </div>
          
                 <div>
                    <label>Hoarding Availability</label>
                    <input name="hoarding_available" class="form-control" type="text" value="<?php echo set_value('hoarding_available'); ?>">
                </div>

                <div>
                    <label>Hoarding Terms and Conditions</label>
                    <input name="hoarding_terms_con" class="form-control" type="text" value="<?php echo set_value('hoarding_terms_con'); ?>">
                </div>

            </div>
        </div>

        <div class="row1">
            <div class="col-md-3">
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
