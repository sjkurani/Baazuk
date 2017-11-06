
<head>
    <meta charset="utf-8" />
    <link href="<?php echo base_url()?>assets/map/css/StyleSheet.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url()?>assets/map/js/JavaScript.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?"></script>
    
	<script>
        var arr = <?php echo json_encode($list['data']);?>;
		var lat_lng_arr = [];
		arr.forEach(function (data, index) {
		lat_lng_arr[index] = data.h_location;
		
		//var loc=data.event_location;
		//alert(loc);
		});
        //var geocoder;
        var map;
        var markers = [];
      
      function initialize() {
            map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat: 12.9715987, lng: 77.59456269999998},
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var bounds = new google.maps.LatLngBounds();
			var temp ;
            lat_lng_arr.forEach(function (data, index, array) {
				
				temp = lat_lng_arr[index];
				temp = temp.split(",");
				console.log(temp);
				var myLatLng = {lat: parseFloat(temp[0]), lng: parseFloat(temp[1])};
				console.log(myLatLng);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(myLatLng),
					//title: "HELLO"+temp[0]+" D"+temp[1],
                    map: map
					
                });
				markers.push(marker);

                bounds.extend(marker.position);
            });
            map.fitBounds(bounds);

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

</head>
	
<!--	<div class="container search_div">
			<?php if(!empty($list['data'])){?>

		<div class="row">
			<div class="col-md-12 well">
				<div class="row">
					<form action="<?php echo base_url()?>search/show" method="get">
							<input type="hidden" value="<?php echo $table;?>" name="media_type">
							<div class="col-md-3"><label>City</label><input class="form-control" type="text" value="<?php echo $city;?>" name="city"></div>
							<div class="col-md-3"><label>Area</label><input class="form-control"  type="text" value="<?php echo $area;?>" name="area"></div>
							<div class="col-md-3"><label>Keyword</label><input class="form-control"  type="text" name="title" value="<?php echo $title;?>" ></div>
							<div class="col-md-3">
							<label>&nbsp</label><input  class="form-control btn btn-purple"  type="submit" value="Modify Search"></div>
					</form>
				</div>
				<div class="row">
					<h1 style="text-align:center">List of Hoardings in City</h1>
					<div class="col-md-6">
							<div id="map-canvas"></div>
					</div>
					<div class="col-md-6 mainscroll">
						<?php $i=0;
						foreach($list['data'] as $key=>$value) { 
						?>
						<div class="row thumbnail" onmouseover="showme(<?php echo $i; ?>)" onmouseout="showme(<?php echo $i; ?>)" id="markers_info" >
							<div class="col-md-3" >
								<div class="">
								<img class="img-thumbnail myimg" src="<?php echo base_url()?>assets/uploads/hoarding_ads/<?php echo $list['data'][$key]->ref_image; ?>">
								</div>
							</div>			
							<div class="col-md-9" >
								<div class="col-md-12">

									<a class="purple_text_anchor" href="<?php echo base_url().'hoarding_ads/show/'.$list['data'][$key]->h_id; ?> "><?php echo ucwords($list['data'][$key]->h_title); ?>
								</div>
								<div class="col-md-12 black-text"><?php echo ucwords($list['data'][$key]->h_cityname); ?>&nbsp-&nbsp;<?php echo ucwords($list['data'][$key]->h_area); ?>
								</div>	
								<div class="col-md-12">
										<?php
										$enquiry_target = "enquiry".$value->h_id;
										$availability_string = ($value->availability_flag == 1) ? "<label class=''>Available</label>" : "<label class='text-danger'>Available From : ".date("d-M-Y", strtotime($value->next_avail_date))."</label>";
										$price_string = (($value->price_setting != 0))  ? "<span class='fa fa-rupee'>".$value->price." &nbsp</span>" : "<span class='text-danger'>Not Disclosable</span>";
																	
										?><br>
										<span class="black-text">Availability : <?php echo $availability_string;?></span><br>
										<span class="black-text">Price : <?php echo $price_string;?></span>
										 <?php
											//echo "<a data-target=#".$enquiry_target." class='btn btn-info center-block' data-toggle='modal' href=#".$enquiry_target."> Enquiry Now</a>";
										?> 
								</div>
								</a>
							</div>			
						</div>
						<?php $i++; }?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class=" text-center">
		<ul class="pagination">
			<li class="page-item">   
				<?php echo $links;?>
			</li>
		</ul>
	</div>
	<div id="<?php echo $enquiry_target; ?>" class="modal fade" role="dialog">
		 <div class="modal-dialog modal-lg">
		     Modal content
		    <div class="modal-content">
		     	<div class="modal-header">
		      		<button type="button" class="close" data-dismiss="modal">&times;</button>
		       		 <h4 class="modal-title"><?php echo $value->ad_title;?></h4>
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
		      				<input type="text" name="ad_id" value="" />
				            <input type="text" name="ad_type" value="hoardings" />
				            <input type="text" name="ad_type_id" value="" />
				            <input type="text" name="buyer_id" value="" />
		      			</section>	      			
				        <div class="col-md-12 col-lg-12 col-sm-12">
				        	<label>Enquiry Description <i class="required"> * </i> </label>
				            <textarea required="" name="enquiry_desc" class="form-control" rows="6" cols="50"> <?php echo set_value('enquiry_desc'); ?></textarea>
				            <center><input type="submit" name="" value="Submit" class="btn btn-success"></center>
				        </div>
		      		</form>
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
	


<?php } 
	else { ?>
			<div class="row well no_result" style="text-align:center">
				<h1 >No Result found</h1>
				<a class="purple-text" href="<?php echo base_url()?>home">Go back to Home Page</a>
			</div>				
		<?php } ?>
          
	</p>
	</div>
	</p>
	</div>-->


<div class="page-header">
			<div class="container">
				<div class="breadcrumbs">

                  <?php
                     if(isset($breadcrumb_array) && !empty($breadcrumb_array) && is_array($breadcrumb_array)) {
                       echo '<ul class="list-unstyled">';
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
				</div> 
			</div> 
</div> 

<div class="inner_body">
  <?php if(!empty($list['data'])){?>
    <div class="directory-filters">				
     <form action="<?php echo base_url()?>search/show" method="get">
		<input type="hidden" value="<?php echo $table;?>" name="media_type">
			<div class="col-md-3"><label>City</label><input class="form-control" type="text" value="<?php echo $city;?>" name="city"></div>
			 <div class="col-md-3"><label>Area</label><input class="form-control"  type="text" value="<?php echo $area;?>" name="area"></div>
			<div class="col-md-3"><label>Keyword</label><input class="form-control"  type="text" name="title" value="<?php echo $title;?>" ></div>
			 <div class="col-md-3">
			<label>&nbsp</label><input  class="form-control btn btn-purple"  type="submit" value="Modify Search"></div>
	 </form>                            
	</div>


   <div class="fullscreen-section">
			<div class="left">
                 <div id="map-canvas" class="map"></div>
			</div>

            <div class="right search_scrollable">
				<div class="inner" tabindex="0">
			
				<div class="directory-list row">			
								<?php $i=0;	foreach($list['data'] as $key=>$value){ ?>
                     <div onmouseover="showme(<?php echo $i; ?>)" onmouseout="showme(<?php echo $i; ?>)" id="markers_info" >
						<div class="col-sm-6">
						 <div class="directory-item category-box">

                               <img src="<?php echo base_url()?>assets/uploads/hoarding_ads/<?php echo $list['data'][$key]->ref_image; ?>" alt="bg" class="img-responsive">

                               <div class="overlay inner"></div>
                                <div class="content">
                                
									<h3 style="font-weight:bold;"><a href="<?php echo base_url().'hoarding_ads/show/'.$list['data'][$key]->h_id; ?> "><?php echo ucwords($list['data'][$key]->h_title); ?></a></h3>
									
									<p><?php
										$enquiry_target = "enquiry".$value->h_id;
										$availability_string = ($value->availability_flag == 1) ? "<label class=''>Available</label>" : "<label class='text-danger'>Available From : ".date("d-M-Y", strtotime($value->next_avail_date))."</label>";
										$price_string = (($value->price_setting != 0))  ? "<span class='fa fa-rupee'>".$value->price." &nbsp</span>" : "<span class='text-danger'>Not Disclosable</span>";
																	
										?><br>
										<span class="black-text">Availability:<?php echo $availability_string;?></span><br>
										<span class="black-text">Price:<?php echo $price_string;?></span>
										 </p>
									
									<div class="location"><img src="<?php echo base_url()."images/directory-location.png"; ?>" alt="location"><?php echo ucwords($list['data'][$key]->h_cityname); ?>&nbsp-&nbsp;<?php echo ucwords($list['data'][$key]->h_area); ?>
									</div>
								</div> 	
							</div>
							
							</div>
							</div>

							<?php $i++; }?>
						</div>
<div id="<?php echo $enquiry_target; ?>" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
		     	
		     	<div class="modal-header">
		      		<button type="button" class="close" data-dismiss="modal">&times;</button>
		       		 <h4 class="modal-title"><?php echo $value->ad_title;?></h4>
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
		      				<input type="text" name="ad_id" value="" />
				            <input type="text" name="ad_type" value="hoardings" />
				            <input type="text" name="ad_type_id" value="" />
				            <input type="text" name="buyer_id" value="" />
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
						<?php } 
			             else { ?>
				        <div class="row well no_result" style="text-align:center">
					        <h1 >No Result found</h1>
					       <a class="purple-text"  href="<?php echo base_url()?>home">Go back to Home Page</a>
				      </div>					
			     <?php } ?>
				</div>
			
        </div>
		</div>
   
</div>


</body>