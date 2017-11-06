<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//	echo "<pre>";
//	print_r($result);
//	echo "</pre>";
	$park_img_name = (!empty($result['primary'])) ? asset_url()."uploads/parks/".$result['primary'][0]->park_image : '';
	//$event_price = (($result['primary'][0]->price_setting != 0))  ? "<span class=' '>".$result['primary'][0]->price_setting->price." Rs.</span>" : "<span class='text-danger'>Not Disclosable</span>";
	//$event_desc = (!empty($result['secondary'])) ? .$result['primary'][0]->event_desc : '';
?>
<div class="body container">
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
	<legend class="text-center"><label>Parks options</label></legend>

	<div class="row ">
		<?php
		if(!empty($result['secondary'] ))
		{
			foreach ($result['secondary']  as $key => $value) 
			{
				$read_target = "readmore".$result['secondary'][$key]->ad_id;
				$enquiry_target = "enquiry".$result['secondary'][$key]->ad_id;
				$img_url = asset_url()."uploads/park_ads/".$value->ref_image;
				$availability_string = ($result['secondary'][$key]->availability_flag != 1) ? "<label class='text-success'>Available</label>" : "<label class='text-danger'>Available From : ".date("d-M-Y", strtotime($value->next_avail_date))."</label>";
				$price_string = (($result['secondary'][$key]->price_setting != 0))  ? "<span class=' '>".$value->price." Rs.</span>" : "<span class='text-danger'>Not Disclosable</span>";
				$desc = $value->ad_desc;
		?>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="owl-item active" id="new-padding"><div class="directory-item">
				<img src="<?php echo $img_url;?>" alt="bg" class="img-responsive">
					<div class="overlay"></div>						
						<div class="content">
							<h3><a data-target="<?php echo '#'.$read_target; ?>" data-toggle="modal" class="MainNavText" id="MainNavHelp" href="#myModal"><?php echo ucwords($result['secondary'][$key]->ad_title);?></a></h3>						
						</div> <!-- end .content -->							
					</div>
					<div class="caption row">					 
						<div class="col-lg-12">
					  		<p><label><?php echo $availability_string;?></p></label>
					   		<p><label><?php echo $price_string;?></p></label>
					</div>
			</div>
			<div class="row">
				<?php				
					
				echo " <div class='col-lg-4'> <span><a  class='btn btn-info' href='".base_url()."park_ads/edit/".$result['secondary'][$key]->ad_id."'>Edit</a></span></div>"; 	               
				echo "<div class='col-lg-4'> <span><a  class='btn btn-danger' href='".base_url()."park_ads/delete_park_ads/".$result['secondary'][$key]->ad_id."/3'>Delete</a></span></div>";  
	             echo "<div class='col-lg-4'><span><a  class='btn btn-warning' href='".base_url()."park_ads/change_park_ads_status/".$result['secondary'][$key]->ad_id."/2'>Block</a></span></div>";

				?>
	                	
	        </div>
		</div>
		</div>
		<!-- <div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
				<a data-target="<?php echo '#'.$read_target; ?>" data-toggle="modal" class="MainNavText" id="MainNavHelp" href="#myModal"><img class="options_img" src="<?php echo $img_url;?>" alt="<?php echo $result['secondary'][$key]->ad_title;?>">
                 <div class="description1">
				   <h4><?php echo ucwords($result['secondary'][$key]->ad_title);?> </h4>
				 </div>

				</a>
				
				<div class="caption row">
					
					<div class="col-lg-12">
					<p><label><?php echo $availability_string;?></p></label>
					<p><label><?php echo $price_string;?></p></label>
					</div>
				</div>
				<div class="row">
				<?php		

					echo " <div class='col-lg-4'> <span><a  class='btn btn-info' href='".base_url()."park_ads/edit/".$result['secondary'][$key]->ad_id."'>Edit</a></span></div>"; 	               
					echo "<div class='col-lg-4'> <span><a  class='btn btn-danger' href='".base_url()."park_ads/delete_park_ads/".$result['secondary'][$key]->ad_id."/3'>Delete</a></span></div>";  
	                echo "<div class='col-lg-4'><span><a  class='btn btn-warning' href='".base_url()."park_ads/change_park_ads_status/".$result['secondary'][$key]->ad_id."/2'>Block</a></span></div>";
				?> </div>
			</div>
		</div>-->
		<div id="<?php echo $read_target; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><?php echo $result['secondary'][$key]->ad_title;?></h4>
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
		        <h4 class="modal-title"><?php echo $result['secondary'][$key]->ad_title;?></h4>
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
				            <input type="text" name="ad_type" value="parks" />
				            <input type="text" name="ad_type_id" value="<?php  echo $result['primary'][0]->park_id; ?>" />
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
	    		echo "<div class='well scrollable_well'><center> <h3>No Options found... </h3></center></div>";
	    	}
	?>
	<div class="col-md-12 text-center"> 
		<ul class="pagination">
			<li><?php print_r($links);?></li>
		</ul>
	</div>
	</div>
</div>
