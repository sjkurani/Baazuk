<head>
    <meta charset="utf-8" />
    <link href="<?php echo base_url()?>assets/map/css/StyleSheet.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url()?>assets/map/js/JavaScript.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?"></script> 
</head>
           <!-- <div class="container search_div">
				<?php if(!empty($list['data'])){?>
					<div class="row">
							<div class="col-md-12">
							        <div class="well row">
										<form action="<?php echo base_url()?>search/show" method="get">
											<input type="hidden" value="<?php echo $table;?>" name="media_type">
											<div class="col-md-3"><label>City</label><input class="form-control" type="text" value="<?php echo $city;?>" name="city"></div><div class="col-md-3"><label>Keyword</label><input class="form-control"  type="text" name="title"></div>
										<div class="col-md-3">
											<label>&nbsp</label><input  class="form-control btn btn-purple"  type="submit" value="Modify Search"></div>
										</form>
						            </div>
									<h1 style="text-align:center">List of Radios in City</h1>
									
									
									<div class="col-md-12">
										<?php foreach($list['data'] as $key=>$value){ ?>
										<div class="row space">
											<div class="col-md-3">
												<center>
												<img class="img-thumbnail myimg" src="<?php echo base_url()?>assets/uploads/radios/<?php echo $list['data'][$key]->r_image; ?>">
												</center>
											</div>
											<div class="col-md-9 nopadding">
												<a class=" purple-text" href="<?php echo base_url().'radio/show/'.$list['data'][$key]->radio_station_id; ?> ">
												
												<div class="col-md-12"><?php echo ucwords($list['data'][$key]->radio_station_name); ?></div>
												<div class="col-md-12 desc"><?php echo ucwords($list['data'][$key]->radio_station_city); ?></div>
												<div class="col-md-12 desc">
														<?php if(strlen($list['data'][$key]->radio_station_desc) > 100)
																	echo substr($list['data'][$key]->radio_station_desc,0,100).'<a href='.base_url().'radio/show/'.$list['data'][$key]->radio_station_id.'> ...Read More</a>';
															  else
																	echo $list['data'][$key]->radio_station_desc; ?>
												</div>
											</div>
										</div>
										<?php }?>
									</div>
									
							</div>
							<div style="text-align:center;">
								<ul class="pagination">
									 <li class="page-item">   
										<?php print_r($links);?>
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
   <?php 
//echo"<pre>";
//print_r($list['data']);
//echo"</pre>";
?>
	  <form action="<?php echo base_url()?>search/show" method="get">
		  <input type="hidden" value="<?php echo $table;?>" name="media_type">
			 <div class="col-md-3"><label>City</label><input class="form-control" type="text" value="<?php echo $city;?>" name="city"></div>

			 <div class="col-md-3"><label>Keyword</label><input class="form-control"  type="text" name="title"></div>
			 <div class="col-md-3">
				<label>&nbsp</label><input  class="form-control btn btn-purple"  type="submit" value="Modify Search"></div>
	 </form>
</div>



<div class="fullscreen-section">
			
		<!--	<div class="left">
                 <div id="map-canvas" class="map"></div>
			</div>-->

            <div class="right search_scrollable">
				<div class="inner"  tabindex="0">	
			
				  <div class="directory-list row">			
								<?php $i=0;	foreach($list['data'] as $key=>$value){ ?>
                     <div onmouseover="showme(<?php echo $i; ?>)" onmouseout="showme(<?php echo $i; ?>)" id="markers_info" >
						<div class="col-sm-3">
						 <div class="directory-item category-box">

                               <img src="<?php echo base_url()?>assets/uploads/radios/<?php echo $list['data'][$key]->r_image; ?>" alt="bg" class="img-responsive">

                               <div class="overlay inner"></div>
                                <div class="content">
                                
									<h3 style="font-weight:bold;"><a href="<?php echo base_url().'radio/show/'.$list['data'][$key]->radio_station_id; ?>"><?php echo ucwords($list['data'][$key]->radio_station_name); ?></a></h3>
									
									
									<div class="location"><img src="<?php echo base_url()."images/directory-location.png"; ?>" alt="location"><?php echo ucwords($list['data'][$key]->radio_station_city); ?>
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
	
