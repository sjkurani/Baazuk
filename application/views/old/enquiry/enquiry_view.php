<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'enquiries/save/');

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
    <div class="row well">
        <legend><label class="default_font_color">Send Enquiry</label></legend>
        
        <div class="col-md-4">
            <label>Media Type : </label>
            <?php echo "<b>".strtoupper($posted_data['media_type'])."</b>"; ?>
        </div>
        <div class="col-md-4">
            <label>Ad Title : </label>
            <?php echo "<b>".strtoupper($db_data[0]->ad_title)."</b>"; ?>
        </div>
        <div class="col-md-4">
            <label>Price : </label>
            <?php echo "<b>".strtoupper($db_data[0]->price)."</b>"; ?>
        </div>
        <?php
        //print_r($posted_data);
        ?>
        <div class="col-md-6">
            <input type="text" name="ad_id" class="form-control hidden" value="<?php  echo $posted_data['ad_id']; ?>" />
            <input type="text" name="ad_type" class="form-control hidden" value="<?php  echo $posted_data['media_type']; ?>" />
            <input type="text" name="ad_type_id" class="form-control hidden" value="<?php  echo $posted_data['id']; ?>" />
            <input type="text" name="buyer_id" class="form-control hidden" value="<?php  echo $this->session->userdata('user_id'); ?>" />
        </div>

        <div class="col-md-12">
            <label>Enquiry Description <i class="required"> * </i> </label>
            <textarea name="enquiry_desc" class="form-control" rows="4" cols="50"> <?php echo set_value('enquiry_desc'); ?></textarea>
        </div>
        <legend></legend>
        <div class="col-md-12 text-center">
            <label class=""><input type="submit" name="" value="Submit" class="btn hoverable_btn"></label>
        </div>
    </div>
</div>