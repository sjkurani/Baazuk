<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

	<div class="row ">
	<div class="col-md-12 " style="text-align:center"><h3>Profile Information</h3></div>
	<div class="col-md-6 toppad pull-right">
	    &nbsp;&nbsp;   <a href="<?php echo base_url().'users/change_password/'.$result->user_id?>">Change Password</a>&nbsp;&nbsp;
           <a href="<?php echo base_url().'users/edit/'.$result->user_id?>">Edit Profile</a>

        </div>
		
		 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
		<div class="panel panel-info">
		
            <div class="pan-heading">
              <h3 class="panel-title"><?php echo ucwords($result->fullname);?></h3>
            </div>
			 <div class="panel-body ">
              <div class="row">
			  <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><label>Username :</label></td>
                        <td><?php echo $result->username; ?></td>
                      </tr>
                      <tr>
                        <td><label>Email :</label></td>
                        <td><?php echo $result->email; ?></td>
                      </tr>
                      <tr>
                        <td><label>Mobile No.</label></td>
                        <td><?php echo $result->mobile; ?></td>
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
	