<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'events/add');

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
    
               
 <legend><label class="default_font_color">Create New Event and Exhibition</label> 
                <input type="submit" name="" value="Submit" class="btn hoverable_btn pull-right">
 </legend>
                <div class="col-md-6">
                    <label>Events and Exhibition Title <i class="required"> * </i></label>
                    <input name="eve_title" class="form-control" type="text" value="<?php echo set_value('eve_title'); ?>">
                </div>
                <div class="col-md-6">
                    <label>Events and Exhibition Image <i class="required"> * </i>
</label><small class="col-md-12"> (Image max size:2MB & Image type: gif, jpg, png.)</small>
                    <input name="userfile"  type="file" size="20" class="form-control" >
                </div>
                <div class="col-md-4">
                    <label>Start Date <i class="required"> * </i></label>
                    <input name="start_date" class="form-control date_fields" type="text" value="<?php echo set_value('start_date'); ?>" >
                </div>
                <div class="col-md-4">
                    <label>End Date <i class="required"> * </i></label>
                    <input name="end_date" class="form-control date_fields" type="text" value="<?php echo set_value('end_date'); ?>">
                </div>
				
                 <div class="col-md-4">
                    <label>Events and Exhibition type  <i class="required"> * </i></label>
                
                     <select class="form-control" name="event_type" id="event_type">
                        <option value=''>--Select Events and Exhibition Type--</option>
                        <option value="Exhibition" <?php echo set_select('event_type', 'Exhibition'); ?> >Exhibition</option>
                        <option value="College/School Fest" <?php echo set_select('event_type', 'College/School Fest');?>> College/School Fest </option>

                        <option value="Conference" <?php echo set_select('event_type', 'Conference');?>> Conference </option>

                        <option value="Concert" <?php echo set_select('event_type', 'Concert');?>> Concert/Entertainment  </option>

                        <option value="Corporate Internal Event" <?php echo set_select('event_type', 'Corporate Internal Event');?>> Corporate Internal Event </option>
                        
                    </select>
                </div>

                
                
                <div class="col-md-4">
                    <label>Events and Exhibition Location <i class="required"> * </i></label>
                    <input name="eve_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location" value="<?php echo set_value('eve_loc'); ?>">
                </div>
                <div class="col-md-4"> 
                   <label>City <i class="required"> * </i></label><input  id="locality" name="city_name" class="form-control" value ="<?php echo set_value('eve_loc'); ?>">
                </div>
                <div class="col-md-4">
                    <label>Events and Exhibition Area <i class="required"> * </i></label>
                    <input id="pac-input1"  name="eve_area" class="form-control" type="text"  type="text" value="<?php echo set_value('eve_area'); ?>">
                </div>

                 <div class="col-md-6">
                   <div id="map" style="height:400px;"></div>
               </div>
                
				 <div class="col-md-6">
                    <label>Events and Exhibition Description <i class="required"> * </i></label>
                    <textarea name="eve_desc" class="form-control" rows="16" cols="50" > <?php echo set_value('eve_desc'); ?></textarea>
                </div>


                
				<!-- <div class="col-md-12">
                    <label>Event Terms and Condition <i class="required"> * </i></label>
                    <textarea name="term_condn" class="form-control" rows="16" cols="50"> <?php echo set_value('term_condn'); ?></textarea>
                </div> -->
				
               
                
           
              <legend></legend>
        <div class="col-md-12 text-center">
            <input id="map_lat" name="map_lat" class="form-control hidden" type="text">
            <input id="map_lang" name="map_lang" class="form-control hidden" type="text">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>

            
        </div>
    </div>
</div>