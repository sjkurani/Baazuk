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
	$apartment_img_name = (!empty($result['primary'])) ? asset_url()."uploads/apartments/".$result['primary'][0]->a_image : '';
	if($this->session->userdata('user_type')!="") {
	 $user_type = $this->session->userdata('user_type'); 
	}
?>

<?php  if($this->session->flashdata('errormsg')){ 
    echo ' <div class="alert alert-danger row error_msgs"><b>

    <a href="#" class="close" data-dismiss="alert">&times;</a>';
echo $this->session->flashdata('errormsg'); 
echo '</b></div>';

 }
if(isset($breadcrumb_array) && !empty($breadcrumb_array) && is_array($breadcrumb_array)) {
echo '<div class="page-header"><div class="breadcrumbs"><ul class="list-unstyled">';
 $count = count($breadcrumb_array);
 foreach ($breadcrumb_array as $key => $value) {
   if (--$count <= 0) {
     echo "<li class='active'>".$key."</li>";
       break;
   }
   echo '<li><a href='.$value.'>'.$key.'</a></li>';
 }
echo "</div></div></ul>";
}
?>
<div class="inner_body">
<div class="body container">
	<div class="section light directory-single">
		   <h3 class="show_text main_title"><?php echo ucwords ($result['primary'][0]->a_name); ?></h3>
		   <h5><span><?php echo $result['primary'][0]->a_location_name; ?></span></h5>
			<div <div class="row col-md-6 col-lg-6 col-sm-6">
				<div class="mainfunctionimg1">
				<img src="<?php echo $apartment_img_name;?>" />
				</div>
			</div>
		     <div class="col-md-offset-6 col-sm-offset-6">
		        <div id="map-canvas1" class="img-responsive well "></div>
		    </div>
			<div class="col-md-12 col-sm-12">
				<section style="margin-top:2em;">
		                  <h3 class="show_text row"> About Apartment</h3>
		                   <ul class="tags row">
		                       <li class="tag" >Type Of Apartment : <?php echo  $result['primary'][0]->type_of_aprtment; ?></li>
		                       <li class="tag" >Category : <?php echo  $result['primary'][0]->a_category; ?></li>
		                        <li class="tag" > Number of Flats : <?php echo $result['primary'][0]->num_of_flats; ?></li>
		                        <li class="tag" > Registered : <?php echo date("d-M-Y", strtotime($result['primary'][0]->created)); ?></li>
		                    </ul>
		                  <h4 class="show_text row">Description</h4>
		              			<p class="row"><?php echo $result['primary'][0]->a_desc; ?></p>  
		                   

		        
		    
		        </section>    

			
				</div>
	</div>
	
	<h3 class="show_text row"> Apartment options</h3>
	<div class="row">
		<?php
		$is_autorised = 0;
	 	$user_type = $this->session->userdata('user_type');
		$is_logged_in = $this->session->userdata('logged_in');
	 	$enquiry_target = '';
	 	if($is_logged_in && $user_type == 'buyer') {
			$is_autorised = 1;
	 	}
		else if($is_logged_in && $user_type != 'buyer'){
			$enquiry_text = 'onlybuyer';
		}
		else if(!$is_logged_in ) {
			$enquiry_text = 'login';
		}

		if(!empty($saved_ads)) {
			foreach ($saved_ads as $key => $value) {
				$saved_array[] = $value->ad_id;
			}
		}
		else {
			$saved_array = array();
		}
		if(!empty($result['secondary'] ))
		{
			foreach ($result['secondary']  as $key => $value) 
			{
				$read_target = "readmore".$result['secondary'][$key]->ad_id;
				$enquiry_target = "enquiry".$result['secondary'][$key]->ad_id;				
				$img_url = asset_url()."uploads/apartment_ads/".$result['secondary'][$key]->ref_image;
				
				$availability_string = ($result['secondary'][$key]->availability_flag == 1) ? "<span class='text-success'>Available</span>" : "<span class='text-danger'>Available From : ".date("d-M-Y", strtotime($result['secondary'][$key]->next_avail_date))."</span>";
				//print_r($result['secondary'][$key]->price);
				$price_string = (($result['secondary'][$key]->price_setting != 0))  ? "<span  class=''> Rs.".$result['secondary'][$key]->price."  </span>" : "<span class='text-danger'>Not Disclosable</span>";
				$desc = $result['secondary'][$key]->ad_desc;
		?>
		<div class="row col-sm-4 col-lg-4 col-md-4" style="margin-bottom:3em;">
			<div class="thumbnail row">
				<a data-target="<?php echo '#'.$read_target; ?>" data-toggle="modal" class="MainNavText" id="MainNavHelp" href="#myModal"><img class="options_img" src="<?php echo $img_url;?>" alt="<?php echo $result['secondary'][$key]->ad_title;?>">
                 <div class="desc col-md-12"><br>
					<h4><?php echo ucwords($result['secondary'][$key]->ad_title);?></h4>
				 </div>
				</a>	
				<div class="caption row">
					<div class="col-lg-12">
					<p><label><?php echo $availability_string;?></p></label>
					<p><label><?php echo $price_string;?></p></label>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
					<?php
					if($is_autorised) {
						echo "<a data-target=#".$enquiry_target." class='btn btn-info center-block' data-toggle='modal' href=#".$enquiry_target."> Enquiry Now</a>";
					}
					else {
						echo "<a data-target=#".$enquiry_text." class='btn btn-info center-block' data-toggle='modal' href=#".$enquiry_text."> Enquiry Now</a>";
					}
					?>
					</div>
					<div class="col-lg-6">
					<?php
					if($is_autorised) {
						if(in_array($result['secondary'][$key]->ad_id, $saved_array)) {
							echo "<a class='btn btn-success center-block'  href='#'> Saved </a>";
						}
						else {
							$url_str = base_url()."save_ad/save/".$result['secondary'][$key]->ad_id."/apartment/".$result['primary'][0]->a_id;
							echo "<a class='btn btn-warning center-block'  href=".$url_str."> Save </a>";
						}
					}
					else {
						echo "<a data-target=#".$enquiry_text." class='btn btn-warning center-block' data-toggle='modal' href=#".$enquiry_text."> Save</a>";
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<div id="<?php echo $read_target; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><center><?php echo ucwords($result['secondary'][$key]->ad_title);?></center></h4>
		      </div>
		      <div class="modal-body row">
		      	<div class="col-md-6 col-lg-6 col-sm-6">
		      		<div class="thumbnail">
						<img class="options_img" src="<?php echo $img_url;?>" alt="<?php echo $result['secondary'][$key]->ad_title;?>">
					</div>
		      	</div>
		      	<div class="col-md-6 col-lg-6 col-sm-6">
					<p><?php echo $desc;?></p>
		      	</div>
		      </div>
		      <div class="modal-footer">

		      	<div class="col-md-6 col-lg-6 col-sm-6">
					<p class="pull-left"><label><?php echo $availability_string;?></p></label>			      	
		      	</div>
		      	<div class="col-md-6 col-lg-6 col-sm-6">
					<p class="pull-right"><label><?php echo $price_string;?></p></label>
		      	</div>
		      </div>
		    </div>

		  </div>
		</div>

		<div id="<?php echo $enquiry_target; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><center><?php echo ucwords($result['secondary'][$key]->ad_title);?></center></h4>
		      </div>
		      <div class="modal-body row">
		      	<div class="col-md-6 col-lg-6 col-sm-6">
		      		<div class="thumbnail">
						<img class="options_img" src="<?php echo $img_url;?>" alt="<?php echo $result['secondary'][$key]->ad_title;?>">
					</div>
		      	</div>
		      	<div class="col-md-6 col-lg-6 col-sm-6">
		      		<form action="<?php echo base_url().'enquiries/save' ?>" method="post">
		      			<section class="hidden">
		      				<input type="text" name="ad_id" value="<?php  echo $result['secondary'][$key]->ad_id; ?>" />
				            <input type="text" name="ad_type" value="apartment" />
				            <input type="text" name="ad_type_id" value="<?php  echo $result['primary'][0]->a_id; ?>" />
				            <input type="text" name="buyer_id" value="<?php  echo $this->session->userdata('user_id'); ?>" />
		      			</section>	      			
				        <div class="col-md-12 col-lg-12 col-sm-12">
				        	<label>Enquiry Description <i class="required"> * </i> </label>
				            <textarea required="" name="enquiry_desc" class="form-control" rows="6" cols="50"> <?php echo set_value('enquiry_desc'); ?></textarea>
				            <center><input type="submit" name="" value="Submit" class="btn btn-success"></center>
				        </div>

		      		</form>
		      	</div>
		      </div>
		      <div class="modal-footer">

		      	<div class="col-md-6 col-lg-6 col-sm-6">
					<p class="pull-left"><label><?php echo $availability_string;?></p></label>			      	
		      	</div>
		      	<div class="col-md-6 col-lg-6 col-sm-6">
					<p class="pull-right"><label><?php echo $price_string;?></p></label>
		      	</div>
		      </div>
		    </div>

		  </div>
		</div>

	    <?php
	    	}
	    }

	    	else {
	    		echo "<div class='col-sm-12 col-md-12 col-lg-12'> <h5>No Options found... </h5></div>";
	    	}
		?>
	</div>
	<div class="col-md-12 text-center"> 
		<ul class="pagination">
			<li><?php print_r($links);?></li>
		</ul>
	</div>
	</p>
      
    <div class="row col-sm-12 col-md-12 col-lg-12 media_desc">
        <section>	
                <h3 class="show_text row">Terms And Conditions</h3>
                  <p class="row"><?php echo $result['terms']['text']; ?></p>

       </section>
    </div>
	
	</div>
	<div id="login" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><center>Log in as buyer to proceed further.</center> </h4>
					
				</div>
				<div class="modal-body row">
					<div class="page-canvas">
				        <div class="signin-wrapper jumbotron" data-login-message="false">
				        <div class="row">
				            <h3 class="text-center">Sign in to Media Basket</h3>
				        </div>
				        <ul class="nav nav-tabs nav-justified main-navs" id="navID">
				                <li class="active"><a href="#owner" data-toggle="tab" aria-expanded="false">Owner</a></li>
				                <li class="" ><a href="#buyer" data-toggle="tab" aria-expanded="true">Buyer</a></li>
				        </ul>

				        <div class="tab-content">
				            <section class="tab-pane fade in active" id="owner">
				            <?php echo form_open('account/signin','id=account_sigin_frm'); ?>

				                <label>Email / Mobile</label><i class="redstar">*</i>
				                <input class="form-control" type="text" name="owner_email_mobile" value="<?php echo set_value('owner_email_mobile'); ?>" >

				                <label>Password</label><i class="redstar">*</i>
				                <input class="form-control" type="password" name="owner_password" value="" >
				                <br>
				                <div class="row">
				                    <div class="col-md-6">
				                        <label><a class="pull-left" href="<?php echo base_url().'account/forgot'; ?>">Forgot  password?</a></label>                
				                    </div>            
				                    <div class="col-md-6">
				                        <label class="text-right">Don't have a account yet?
				                        <a class="forgot pull-center" id="login-signup-link" href="<?php echo base_url().'account/signup'; ?>">Signup now »</a>
				                        </label>                
				                    </div>
				                </div>

				                <div class="row text-center">
				                    <label><button type="submit" class="submit btn hoverable_btn" name="submit_btn" value="owner">Sign in</button></label>
				                </div>
				                </form>
				            </section>

				            <section class="tab-pane fade in" id="buyer">
				                <?php echo form_open('account/signin','id=account_sigin_frm'); ?>
				                <label>Email / Mobile</label><i class="redstar">*</i>
				                <input class="form-control" type="text" name="buyer_email_mobile" value="<?php echo set_value('buyer_email_mobile'); ?>" >

				                <label>Password</label><i class="redstar">*</i>
				                <input class="form-control" type="password" name="buyer_password" value="" >
				                <br>
				                <div class="row">
				                    <div class="col-md-6">
				                        <label><a class="pull-left" href="<?php echo base_url().'account/forgot'; ?>">Forgot  password?</a></label>                
				                    </div>            
				                    <div class="col-md-6">
				                        <label class="text-right">Don't have a account yet?
				                        <a class="forgot pull-center" id="login-signup-link" href="<?php echo base_url().'account/signup'; ?>">Signup now »</a>
				                        </label>                
				                    </div>
				                </div>

				                <div class="row text-center">
				                    <label><button type="submit" class="submit btn hoverable_btn" name="submit_btn" value="buyer">Sign in</button></label>
				                </div>
				                </form>
				            </section>
				        </div>
				        <input type="hidden" class="verify" name="verify_both"/>

				        </div>
				        </div>
				    </div>
				</form>
				</div>
				<div class="modal-footer">
				<button type="button" class="close" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<div id="onlybuyer" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Not authorised</h4>
				</div>
				<div class="modal-body row">
					<p>Only Buyer allowed to perform this operation.</p>
				</div>
				<div class="modal-footer">
				<button type="button" class="close" data-dismiss="modal">Close</button>
				</div>
			</div>
			</div>
		</div>
	</div>
    <link href="<?php echo base_url()?>assets/map/css/StyleSheet.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url()?>assets/map/js/JavaScript.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?"></script>
  
	<script>
        var arr = <?php echo json_encode($result['primary']);?>;
		var lat_lng=arr[0].a_location;
		console.log(lat_lng);
        var map;
      function initialize() {
            map = new google.maps.Map(document.getElementById('map-canvas1'), {
                center: {lat: 12.9715987, lng: 77.59456269999998},
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });				   
			var temp ;
				temp = lat_lng;
				temp = temp.split(",");
				console.log(temp);
				var myLatLng = {lat: parseFloat(temp[0]), lng: parseFloat(temp[1])};
				console.log(myLatLng);
                var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: arr[0].a_name
                 });
				console.log(marker.position.lat());
				console.log(marker.position.lng());
        }
        google.maps.event.addDomListener(window, "load", initialize);

        showme = function (index) {
			console.log(index);
            if (markers[index].getAnimation() != google.maps.Animation.BOUNCE) {
                markers[index].setAnimation(google.maps.Animation.BOUNCE);
            } else {
                markers[index].setAnimation(null);
            }
        }
    </script>
