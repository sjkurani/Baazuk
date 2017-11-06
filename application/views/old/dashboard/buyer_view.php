<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('user/account/signup','id=account_signup_frm');

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
<!--<div class="row">
<br>
    <legend class="text-center"><label>Buyer Dashboard</label> </legend>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">My Ads</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Manage Analytics</label></a>
    </section>
    <section class="col-md-4" style="padding: 1%;">
        <a href="#"><label class="jumbotron">Browse upcoming Events</label></a>
    </section>
</div>

</div>-->


<div class="row dashboard_view well">
    <legend class="text-center page-header"><label class="">Buyer Dashboard</label> </legend>
    
    <section class="col-lg-12"><legend class="text-center"></legend>
        <ul>
            <li class="text-center col-lg-6">
                <a href="<?php echo base_url().'saved_ads'; ?>">
                    <i class="fa fa-building fa-2" aria-hidden="true"></i>
                    <div>Saved Ads</div>
                </a>
            </li>
            <li class="text-center col-lg-6">
                <a href="<?php echo base_url().'enquiries'; ?>">
                    <i class="fa fa-calendar fa-2" aria-hidden="true"></i>
                    <div> My Enquires</div>
                </a>
            </li>
        </ul>
    </section>

    
    
</div>

</div>