<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$apartment_img_name = (!empty($result['primary'])) ? asset_url()."uploads/apartments/".$result['primary'][0]->a_image : '';
?>

<?php  if($this->session->flashdata('errormsg')){ 
    echo ' <div class="alert alert-danger row error_msgs"><b>

    <a href="#" class="close" data-dismiss="alert">&times;</a>';
echo $this->session->flashdata('errormsg'); 
echo '</b></div>';

 } ?>

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
	<legend class="text-center"><label>Apartment options</label></legend>
	<div class="row ">
		<?php
		if(!empty($result['secondary'] ))
		{
			foreach ($result['secondary']  as $key => $value) 
			{

				$read_target = "readmore".$result['secondary'][$key]->ad_id;
				$enquiry_target = "enquiry".$result['secondary'][$key]->ad_id;
				$img_url = asset_url()."uploads/apartment_ads/".$result['secondary'][$key]->ref_image;
				
				$availability_string = ($result['secondary'][$key]->availability_flag == 1) ? "<span class='text-success'>Available</span>" : "<span class='text-danger'>Available From : ".date("d-M-Y", strtotime($result['secondary'][$key]->next_avail_date))."</span>";
				$price_string = (($result['secondary'][$key]->price_setting != 0))  ? "<span  class='fa fa-rupee'> ".$result['secondary'][$key]->price."</span>" : "<span class='text-danger'>Not Disclosable</span>";
				$desc = $result['secondary'][$key]->ad_desc;
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
				<div class= "col-lg-4" >
					<?php					  
					echo " <span ><a  class='btn btn-info' href='".base_url()."apartment_ads/edit/".$result['secondary'][$key]->ad_id."'>Edit</a></span>";   
					 ?>
				</div>
				<div  class="col-lg-4">
					<?php					  
					echo " <span ><a  class='btn btn-danger' href='".base_url()."apartment_ads/delete_apartment_ads/".$result['secondary'][$key]->ad_id."/3'>Delete</a></span>";   
					 ?>
				</div>
				<div class="col-lg-4">
					<?php
					     echo "<span><a  class='btn btn-warning' href='".base_url()."apartment_ads/change_apartment_ads_status/".$result['secondary'][$key]->ad_id."/2'>Block</a></span>";

					?>
				</div>
	                	
	        </div>
		</div>
	</div>

		<!--<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
			<div class="overlay"></div>
				<a data-target="<?php echo '#'.$read_target; ?>" data-toggle="modal" class="MainNavText" id="MainNavHelp" href="#myModal"><img class="options_img" src="<?php echo $img_url;?>" alt="<?php echo $result['secondary'][$key]->ad_title;?>">

                 <div class="description1">
					 <h4>  <?php echo ucwords($result['secondary'][$key]->ad_title);?></h4>
			     </div>

				</a>
				<div class="caption row">
					 
					<div class="col-lg-12">
					  <p><label><?php echo $availability_string;?></p></label>
					   <p><label><?php echo $price_string;?></p></label>
					</div>
				</div>
				<div class="row">
					<div class= "col-lg-4" >
					<?php
					  
					echo " <span ><a  class='btn btn-info' href='".base_url()."apartment_ads/edit/".$result['secondary'][$key]->ad_id."'>Edit</a></span>";   
					 ?>
					</div>

					<div  class="col-lg-4">
					<?php
					  
					echo " <span ><a  class='btn btn-danger' href='".base_url()."apartment_ads/delete_apartment_ads/".$result['secondary'][$key]->ad_id."/3'>Delete</a></span>";   
					 ?>
					</div>

					<div class="col-lg-4">
					<?php
					     echo "<span><a  class='btn btn-warning' href='".base_url()."apartment_ads/change_apartment_ads_status/".$result['secondary'][$key]->ad_id."/2'>Block</a></span>";

					?>
					</div>
	                	
	            </div>
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