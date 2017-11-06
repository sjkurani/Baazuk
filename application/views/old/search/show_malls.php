
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
			
		console.log(data.event_location);
		lat_lng_arr[index] = data.mall_location;
		//var loc=data.event_location;
		//alert(loc);
		});
        //var geocoder;
        var map;
        var markers = [];
      
      function initialize() {
            map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat: 12.9715987, lng: 77.59456269999998},
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
			
			list = [
                 
                [12.9172115, 77.5717022],
                [12.8897795, 77.5430398],
                [12.9706513, 77.5152328]
            ];
		
			
            var bounds = new google.maps.LatLngBounds();
			var temp ;
            lat_lng_arr.forEach(function (data, index, array) {
				
				//console.log(list[index]);
				console.log(lat_lng_arr[index]);
				temp = lat_lng_arr[index];
				temp = temp.split(",");
				console.log(temp);
				var myLatLng = {lat: parseFloat(temp[0]), lng: parseFloat(temp[1])};
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(myLatLng),
					title: "HELLO"+temp[0]+" D"+temp[1],
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
	 <!--<div class="container search_div">
			<?php if(!empty($list['data'])){?>
					<div class="row">
						<div class="col-md-12 well">
						<div class=" row">
							<form action="<?php echo base_url()?>search/show" method="get">
							<input type="hidden" value="<?php echo $table;?>" name="media_type">
							<div class="col-md-3"><label>City</label><input class="form-control" type="text" value="<?php echo $city;?>" name="city"></div>
							<div class="col-md-3"><label>Area</label><input class="form-control"  type="text" value="<?php echo $area;?>" name="area"></div>
							<div class="col-md-3">
								<label>Keyword</label><input class="form-control"  type="text" name="title" value="<?php echo $title;?>" ></div>
							<div class="col-md-3">
								<label>&nbsp</label><input  class="form-control btn btn-purple"  type="submit" value="Modify Search"></div>
							</form>
						</div>
							<h1 style="text-align:center">List of Malls in City</h1>
							<div class="col-md-6">
									<div id="map-canvas" style="border: 2px solid #fff;"></div>
								</div>
							<div class="col-md-6 mainscroll">
								<?php $i=0; 
								foreach($list['data'] as $key=>$value){ ?>
									<div class="row thumbnail" onmouseover="showme(<?php echo $i; ?>)" onmouseout="showme(<?php echo $i; ?>)" id="markers_info" >
										<div class="col-md-4" >
											<div class="">
												<img class="img-thumbnail myimg" src="<?php echo base_url()?>assets/uploads/malls/<?php echo $list['data'][$key]->img_name; ?>" >
											</div>
										</div>
										<div class="col-md-8 nopadding">
											<a href="<?php echo base_url().'malls/show/'.$list['data'][$key]->mall_id; ?> ">
												<div class="col-md-12 purple-text"><?php echo ucwords($list['data'][$key]->mall_name); ?></div>
												<div class="col-md-12"><?php echo $list['data'][$key]->city_name; ?>&nbsp;-&nbsp;<?php echo $list['data'][$key]->mall_area; ?></div>
												<div class="col-md-12">
													<p>
														<?php if(strlen($list['data'][$key]->mall_desc) > 100)
																	echo substr($list['data'][$key]->mall_desc,0,100).'<a href='.base_url().'malls/show/'.$list['data'][$key]->mall_id.'> ...Read More</a>';
															  else
																	echo $list['data'][$key]->mall_desc; ?>
													</p>
												</div>
											</a>
										</div>
									</div>
								<?php $i++; }?>
							</div>
						</div>
						<div>
							<ul class="pagination">
								 <li class="page-item">   
									<?php echo $links;?>
								  </li>
							</ul>
						</div>
					</div>
				<?php } 
				else { ?>
					<div class="row well no_result" style="text-align:center">
								<h1 >No Result found</h1>
								<a class="purple-text" href="<?php echo base_url()?>home">Go back to Home Page</a>
				    </div>				
				<?php } ?>
			</div>
		</div>
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
			<div class="col-md-3">
			 <label>Keyword</label><input class="form-control"  type="text" name="title" value="<?php echo $title;?>" ></div>
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

                               <img src="<?php echo base_url()?>assets/uploads/malls/<?php echo $list['data'][$key]->img_name; ?>" alt="bg" class="img-responsive">

                               <div class="overlay inner"></div>
                                <div class="content">
                                
									<h3 style="font-weight:bold;"><a href="<?php echo base_url().'malls/show/'.$list['data'][$key]->mall_id; ?>"><?php echo ucwords($list['data'][$key]->mall_name); ?></a></h3>
									
									
									<div class="location"><img src="<?php echo base_url()."images/directory-location.png"; ?>" alt="location"><?php echo $list['data'][$key]->city_name; ?>&nbsp;-&nbsp;<?php echo $list['data'][$key]->mall_area; ?>
									</div>
								</div> 	
							</div>
							
							</div>
							</div>

							<?php $i++; }?>
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