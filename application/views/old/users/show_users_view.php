<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

	<div class="row">
		<div class="col-sm-12 col-lg-12 col-md-12 well">
			<div class="row">
				<legend><h2><?php echo ucwords ($result->fullname); ?></h2></legend>
				<div class="col-sm-12 col-lg-12 col-md-12">
				<p>Email : <?php echo $result->email; ?><p>
				</div>
				<div class="col-sm-12 col-lg-12 col-md-12">
				<p>Mobile : <?php echo $result->mobile; ?><p>
				</div>
				<div class="col-sm-12 col-lg-12 col-md-12">
				<p>User type : <?php echo $result->user_type; ?><p>
				</div>	
			</div>		 
		</div>
	</div>
</div>