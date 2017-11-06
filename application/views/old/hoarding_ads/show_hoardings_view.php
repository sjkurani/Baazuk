	<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$hoard_img_name = (!empty($result['primary'])) ? asset_url()."uploads/hoarding_ads/".$result['primary']->ref_image : '';
?>

<?php  if($this->session->flashdata('errormsg')){ 
    echo ' <div class="alert alert-danger row error_msgs"><b>

    <a href="#" class="close" data-dismiss="alert">&times;</a>';
echo $this->session->flashdata('errormsg'); 
echo '</b></div>';

 } ?>

<?php
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

<?php 
    $is_authorised = 0;
 	$user_type = $this->session->userdata('user_type');
	$is_logged_in = $this->session->userdata('logged_in');
 	$owner_enquiry_target = '';
 	$enquiry_target = '';
 	$main_enquiry= '';
 	if($is_logged_in && $user_type == 'buyer') {
		$is_authorised = 1;
 	}
	else if($is_logged_in && $user_type != 'buyer'){
		$enquiry_text = 'onlybuyer';
	}
	else if(!$is_logged_in ) {
		$enquiry_text = 'login';
	}

	if(!empty($saved_ads)) {
		//print_r($saved_ads);
		foreach ($saved_ads as $key => $value) {
			$saved_array[] = $value->media_type_id;
		}
	}
	else {
		$saved_array = array();
	}
?>
	
<div class="inner_body">
<div class="body container">

	<div class="section light directory-single">
       <h3 class="show_text main_title">
       <?php $str = $result['primary']->h_title." - H".$result['primary']->h_id;
       echo ucwords ($str); ?>
        </h3>
			<div class="col-md-2 col-lg-2 col-sm-2 pull-right">
				<?php $main_enquiry="main_enquiry"; 
				if($is_authorised) {
					echo "<a data-target=#".$main_enquiry." class='btn btn-info center-block' data-toggle='modal' href=#".$main_enquiry."> Enquiry Now</a>"; 
				} else { 
						echo "<a data-target=#".$enquiry_text." class='btn btn-info center-block' data-toggle='modal' href=#".$enquiry_text."> Enquiry Now</a>"; 
				}?>

			</div>
			<div class="col-md-2 col-lg-2 col-sm-2 pull-right">
				<?php
				if($is_authorised) {
				if(in_array($result['primary']->h_id, $saved_array)) {
						echo "<a class='btn btn-success center-block'  href='#'> Saved </a>";
					}
					else {
						$url_str = base_url()."save_ad/save/".$result['primary']->h_id."/hoarding/".$result['primary']->h_id;
						echo "<a class='btn btn-warning center-block'  href=".$url_str."> Save </a>";
					}
				}
				else {
					echo "<a data-target=#".$enquiry_text." class='btn btn-warning center-block' data-toggle='modal' href=#".$enquiry_text."> Save</a>";
				}
				?>
			</div></h1> 
   		    <h5> <span><?php echo  ucwords($result['primary']->h_cityname)." - ".ucwords($result['primary']->h_area); ?></span> </h5>

		<div class="row col-md-6 col-lg-6 col-sm-6 ">
			<div class="mainfunctionimg">			
			<img src="<?php echo $hoard_img_name;?>" />
			</div>
		</div>
         <div class="col-md-offset-6 col-sm-offset-6">
            <div id="map-canvas1" class="img-responsive well "></div>
        </div>
        <div class="col-md-12 col-sm-12">
			<section style="margin-top:2em;">
                      <h3 class="show_text main_title"> About Hoarding</h3>
                       <ul class="tags row">
                       <li class="tag">Landmark : <?php echo  $result['primary']->h_landmark; ?></li>
                           <li class="tag">Price : <?php @$price_string = ((@$result['primary']->price_setting != 0))  ? "<span  class=''> Rs.".$result['primary']->price."</span>" : "<span class='text-success'>Not Disclosable</span>";
					 echo @$price_string; ?> </li>
                           <li class="tag">Aviliability : <?php if(@$result['primary']->availability_flag==1){ 
						echo "<span class='text-success'>Available</span>";
						}
						else{
						echo "<span class='text-success'>Available From :" .@$result['primary']->next_avail_date."</span>";
						} ?></li>
                           <li class="tag">Type Of Hoarding : <?php echo  $result['primary']->h_light; ?></li>
                            <li class="tag"> Size of Hoarding : <?php echo $result['primary']->h_size; ?></li>
                            <li class="tag"> Registered : <?php echo date("d-M-Y", strtotime($result['primary']->created)); ?></li>
                        </ul>
                      <h4 class="show_text row">Description</h4>
                  			<p class="row"><?php echo $result['primary']->h_desc; ?></p> 
            </section>    
		</div>
        <div class="col-md-12 col-sm-12">
			<section style="margin-top:2em;">
				<h3 class="show_text row"> Terms And Conditions</h3>
                  			<p class="row"><?php echo $result['terms']['text']; ?></p>				
			</section>
		</div>
	<div class="col-md-12 text-center"> 
		<ul class="pagination">
			<li><?php print_r($owner_links);?></li>
		</ul>
	</div>
	</div>
	
	</div>
<div id="<?php echo $main_enquiry; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><center><?php echo ucwords($result['primary']->h_title);?></center></h4>
		      </div>
		      <div class="modal-body row">
		      	<div class="col-md-6 col-lg-6 col-sm-6">
		      		<div class="thumbnail">
						<img class="options_img" src="<?php echo $hoard_img_name;?>" alt="<?php echo $result['primary']->h_title;?>">
					</div>
		      	</div>
		      	<div class="col-md-6 col-lg-6 col-sm-6">
		      		<form action="<?php echo base_url().'enquiries/save' ?>" method="post">
		      			<section class="hidden">
		      				<input type="text" name="ad_type_id" value="0" />
		      				<input type="text" name="ad_id" value="<?php  echo $result['primary']->h_id; ?>" />
				            <input type="text" name="ad_type" value="hoarding" />				          
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
					<p class="pull-left"><label>
					<?php if(@$result['primary']->availability_flag==1){ 
						echo "<span class='text-success'>Available</span>";
						}
						else{
						echo "<span class='text-success'>Available From :" .@$result['primary']->next_avail_date."</span>";
						} ?></p></label>			      	
		      	</div>
		      	<div class="col-md-6 col-lg-6 col-sm-6">
					<p class="pull-right"><label>
					<?php @$price_string = ((@$result['primary']->price_setting != 0))  ? "<span  class='fa fa-rupee'> ".$result['primary']->price."</span>" : "<span class='text-success'>Not Disclosable</span>";
					 echo @$price_string; ?></p></label>
		      	</div>
		      </div>
		    </div>

		  </div>
		</div>

<div id="login" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Log in as buyer for enquiries</h4>
					
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
					<p>Only Buyer allowed to request enquiries.</p>
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
		var lat_lng=arr.h_location;
        var map;
        var temp ;
		temp = lat_lng;
		temp = temp.split(",");

      function initialize() {
            map = new google.maps.Map(document.getElementById('map-canvas1'), {
                center: {lat: parseFloat(temp[0]), lng: parseFloat(temp[1])},
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
				var myLatLng = {lat: parseFloat(temp[0]), lng: parseFloat(temp[1])};
				console.log(myLatLng);
                var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Hello World!'
                 });
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