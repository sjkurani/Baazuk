<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart (base_url().'terms');

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

<legend class="col-md-12 text-center"><br/><label><h3>Terms and condition</h3></label></legend>

  <?php
    $event_terms =  '';
    $apartment_terms = '';
    $hoarding_terms = '';
    $mall_terms = '';
    $radio_terms = ''; 
    $park_terms = '';
    foreach ($all_terms_and_condns as $key => $value) {
        switch ($value->media_type) {
            case 'event':
                $event_terms = $value->text;
                break;
            case 'mall':
                $mall_terms = $value->text;
                break;
            case 'hoarding':
                $hoarding_terms = $value->text;
                break;
            case 'apartment':
                $apartment_terms = $value->text;
                break;
            case 'radio':
                $radio_terms = $value->text;
                break;
            case 'park':
                $park_terms = $value->text;
                break;
            
            default:
                # code...
                break;
        }
    }
    ?>
  <div class=''>
    <div class="row well">
      <div class="col-md-6">
          <label class="col-md-12">Apartment <i class="required"> * </i>
          </label>
           <div class="thumbnail">
          <textarea class="col-md-10 form-control" name="apartment" class="form-control" rows="4" cols="50"><?php echo $apartment_terms; ?>            
          </textarea>
          </div>
       </div>
      <div class="col-md-6">
          <label class="col-md-12">Event <i class="required"> * </i>
          </label>
           <div class="thumbnail">
          <textarea class="col-md-10 form-control" name="event" class="form-control" rows="4" cols="50"><?php echo $event_terms; ?>            
          </textarea>
          </div>
       </div>
      <div class="col-md-6">
          <label class="col-md-12">Radio <i class="required"> * </i>
          </label>
           <div class="thumbnail">
          <textarea class="col-md-10 form-control" name="radio" class="form-control" rows="4" cols="50"><?php echo $radio_terms; ?>            
          </textarea>
          </div>
       </div>
      <div class="col-md-6">
          <label class="col-md-12">Business Park<i class="required"> * </i>
          </label>
           <div class="thumbnail">
          <textarea class="col-md-10 form-control" name="park" class="form-control" rows="4" cols="50"><?php echo $park_terms; ?>            
          </textarea>
          </div>
       </div>
      <div class="col-md-6">
          <label class="col-md-12">Malls <i class="required"> * </i>
          </label>
           <div class="thumbnail">
          <textarea class="col-md-10 form-control" name="mall" class="form-control" rows="4" cols="50"><?php echo $mall_terms; ?>            
          </textarea>
          </div>
       </div>
      <div class="col-md-6">
          <label class="col-md-12">Hoardings <i class="required"> * </i>
          </label>
          <div class="thumbnail">
          <textarea class="col-md-10 form-control" name="hoarding" class="form-control" rows="4" cols="50"><?php echo $hoarding_terms; ?>            
          </textarea>
          </div>
       </div>
         
      </div>
  </div>

<div class="row">
  <div class="col-md-12 text-center"> 
  <label class=""><input type="submit" name="" value="Submit" class="btn btn-lg hoverable_btn"></label>
</div>
</div>
</div>