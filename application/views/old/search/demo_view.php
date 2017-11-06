
<head>
    <meta charset="utf-8" />
    <link href="<?php echo base_url()?>assets/map/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/map/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url()?>assets/map/bootstrap/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url()?>assets/map/css/StyleSheet.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url()?>assets/map/js/JavaScript.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?"></script>
   
	<script>
	
	
		var arr = <?php echo json_encode($list['data']);?>;
		var lat_lng_arr = [];
		arr.forEach(function (data, index) {
			
		console.log(data.event_location);
		lat_lng_arr[index] = data.event_location;
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
				var myLatLng = {lat: parseInt(temp[0]), lng: parseInt(temp[1])};
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

<div class="row">
        <div class="col-md-12">
		<h1 style="text-align:center">List of Events in City</h1>
		
			<div class="col-md-6">
			<?php foreach($list['data'] as $key=>$value){ ?>
				<div class="col-md-8">
				<img src="<?php echo base_url().'assets/uploads/events/a.jpg'?>" height="200px" width="200px" border="1px #fff">
				</div>
			
				<div class="col-md-4">
					<div class="col-md-12" style="text-align:center;"><p><?php echo $list['data'][$key]->event_name?></p></div>
					<div class="col-md-6" style="text-align:center;"><?php echo $list['data'][$key]->event_cityname?></div>
					<div class="col-md-6" style="text-align:center;"><?php echo $list['data'][$key]->event_area?></div>
				</div>
			<?php }?>
			
			</div>
			
			<div class="col-md-6">
					<div class="col-md-4">
						<div id="marker_info" class="col-md-6">
							<?php 
							$i=0;	
							foreach($list['data'] as $key=>$value){
                            						?>
							<div id="" class="well" onmouseover="showme(<?php echo $i?>)" onmouseout="showme(<?php echo $i?>)"><?php echo $list['data'][$key]->event_cityname?></div>
						<?php  $i++;
						}?>
						   <!-- <div class="well" onmouseover="showme(0)" onmouseout="showme(0)">Banashankari</div>
							<div class="well" onmouseover="showme(1)"  onmouseout="showme(1)">J.P Nagar</div>
							<div class="well" onmouseover="showme(2)"  onmouseout="showme(2)">Vijayanagar</div>-->
							
						</div>
					</div>
					
					<div class="col-md-8">
							<div id="map-canvas" style="border: 2px solid #fff;"></div>
					</div>
			</div>
			<div>
		<ul class="pagination">
		 <li class="page-item">   
		<?php 
          echo $links;?>
		  </li>
        </ul></div>
      </div>
</div>
</div>
</body>