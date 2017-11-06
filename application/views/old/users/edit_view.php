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
<div class="body container well">
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
	<div class="col-md-12 " style="text-align:center"><h3>Edit Profile Information</h3></div>
	<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
          
&nbsp;
        </div>
		
		 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
		<div class="panel panel-info">
            <div class="pan-heading" >
              <h3 class="panel-title"><?php echo ucwords($result->fullname); ?></h3>
            </div>
			 <div class="panel-body">
              <div class="row">
			  <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
					<form action="<?php echo base_url().'users/edit/'.$result->user_id;?>" method="post">
                      <tr>
                        <td><label>Username :</label></td>
                        <td><input type="text" name="username" class="form-control" value="<?php echo set_value('username',$result->username); ?>"></td>
                      </tr>
					  <tr>
                        <td><label>Full Name :</label></td>
                        <td><input type="text" name="fullname" class="form-control" value="<?php echo set_value('fullname',$result->fullname); ?>"></td>
                      </tr>
                      <tr>
                        <td><label>Email :</label></td>
                        <td><?php echo $result->email; ?></td>
                      </tr>
                      <tr>
                        <td><label>Mobile No.</td>
                        <td><input type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile',$result->mobile); ?>"></td>
                      </tr>
					
					  <tr>
					    <td></td>
                        <td><input type="submit" class="btn btn-success" name="submit" value="submit"></td>
                      </tr>
                   
                         
					  </tbody>
                  </table>
			  </div>
			  </div>
			  </div>
			  </div>
			  </div>
			  </div>
			  </div>
			<!--<legend><label>Username : </label><?php echo $result->username; ?></legend>
			<div class="row">
				<div class="col-sm-6 col-lg-6 col-md-6">
				<p><label>Email : </label><?php echo $result->email; ?><p>
				</div>
				<div class="col-sm-6 col-lg-6 col-md-6">
				<p><label>Mobile No. : </label><?php echo $result->mobile; ?><p>
				</div>	
				<div class="col-sm-6 col-lg-6 col-md-6">
				<p><label>Service Type : </label><?php echo $result->service_type; ?><p>
				</div>	
				<div class="col-sm-6 col-lg-6 col-md-6">
				<label></label><p><p>
				</div>	
			</div>		 
		</div>-->
	