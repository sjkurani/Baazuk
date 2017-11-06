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
<div class="dashboard_view">
    <legend class="text-center page-header"><label class="">City And Area</label> </legend>
    <section class="col-md-6 gray_background"  style="background: #f1f1f1;"><legend class="text-center"><label>List Of Cities</label></legend>
       <table class="table1 display table-bordered table-responsive">
         <button type="button" class="btn btn-primary btn" data-toggle="modal" data-target="#popupmodalcity">Add City</button>

    	<thead>
        <tr>

    		<th>
    			Cities
    		</th>
             <th>
                Media Type
            </th>
    		<th>
    			Status
    		</th>
            <th>
                Action
            </th>

    	</tr>
        </thead>
      
      <tbody>
      <?php

		if(!empty($list['city'] ))
		{

			foreach ($list['city']  as $key => $value) 
			{
				$cityname = $value->city_name;
                 $media_type= $value->media_type;					
		?>   
    	<tr>
    		<td>
    			<?php echo $cityname;?>
    		</td>
            <td>
                <?php echo $media_type;?>
            </td>
    		<td>
    			<?php
    			if($value->flag == 0) {
    				$status_str = "<a href=".base_url()."cityarea/change_status/".$value->city_id."/1/city >Enable</a>";
    			}
    			elseif ($value->flag == 1) { 
    				$status_str = "<a href=".base_url()."cityarea/change_status/".$value->city_id."/0/city >Disable</a>";				
				}
                
                
              	 echo $status_str;
    			?>
    		</td>
            <td>
                <?php 
                  
                    $action_str = "<a href=".base_url()."cityarea/delete_cityarea/".$value->city_id."/city >Delete</a>";               
                
                  echo $action_str;
                ?>
            </td>



    	</tr>
    	<?php }
    	} ?>
    </tbody>

    </table> 
  

<!-- Modal -->
    <div id="popupmodalcity" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new city.</h4>
                </div>
                <div class="modal-body row">
                 <form action="<?php echo base_url().'cityarea/save_city'?>" method="post">
                   
                    <div class="col-lg-12">    
                     
                        <label class="col-lg-6">media_type:
                            <i class="required"> * </i></label>
                                <select name="media_type">
                                    <option>--Select--</option>
                                    <option value="apartment">apartment</option>
                                    <option value="event">event</option>
                                    <option value="park">park</option>
                                    <option value="mall">mall</option>
                                    <option value="hoarding">hoarding</option>
                                    <option value="radio">radio</option>
                                     
                                </select>                      
                                 
                        <label class="col-lg-6">city : 
                        <i class="required"> * </i></label>
                        <input name="city_name"  id="searchTextField" class="form-control" type="text" autocomplete="on" value="<?php echo set_value('city_name'); ?>">
                        </label>                       
                    </div>
                    <div class="col-lg-12 text-center">
                        <input type="submit" name="" value="Submit" class="btn hoverable_btn">
                    </div>

                 </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">close</button>
                </div>
                        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
                        <script type="text/javascript">
                       function initialize() {
                               var input = document.getElementById('searchTextField');
                               var autocomplete = new google.maps.places.Autocomplete(input);
                       }
                       google.maps.event.addDomListener(window, 'load', initialize);
                        </script>

            </div>

        </div>
    </div>
                     
</section>
    <section class="col-md-6 gray_background" style="background: #f1f1f1;"><legend class="text-center"><label>List Of Areas</label></legend>
      <table class="table2 display table-bordered">
       <button type="button" class="btn btn-primary btn " data-toggle="modal" data-target="#popupmodalarea">Add Area</button>
       <thead>
    	<tr>
    		<th>
    			Area
    		</th>

    		<th>
    			City
    		</th>
            <th>
                Media Type
            </th>
    		<th>
    			Status
    		</th>
            <th>
                Action
            </th>
    	</tr>
      </thead>
      <tbody>

      <?php
     // echo "<pre>";
     // print_r($list['area']->'area_name');
     // echo "<pre>"; ?>
      <?php
		if(!empty($list['area'] ))
		{
			foreach ($list['area']  as $key => $value) 
			{
				$areaname = $value->area_name;
				$city_name = $value->city_name;
                $media_type= $value->area_media_type;
              // echo "<pre>";
     // print_r($media_type= $value->city_name);
     //// echo "<pre>";
		?>   
    	<tr>
    		<td>
    		<?php echo $areaname;?>
    		</td>
    		<td>
    		<?php echo $city_name;?>
    		</td>
            <td>
            <?php echo $media_type;?>
            </td>
    		<td>
    			<?php
    			if($value->area_flag == 0) {
    				$status_str = "<a href=".base_url()."cityarea/change_status/".$value->area_id."/1/area >Enable</a>";
    			}
    			elseif ($value->area_flag == 1) { 
    				$status_str = "<a href=".base_url()."cityarea/change_status/".$value->area_id."/0/area >Disable</a>";				
				}
    				 echo $status_str;
    			?>
    		</td>
            <td>
                <?php 
                  
                    $action_str = "<a href=".base_url()."cityarea/delete_cityarea/".$value->area_id."/area >Delete</a>";               
                
                  echo $action_str;
                ?>
            </td>



    	</tr>
    	<?php }} ?>
      </tbody>
    </table>
   

<!-- Modal -->
    <div id="popupmodalarea" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content well">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new area</h4>
                </div>
                <div class="modal-body row">
                 <form action="<?php echo base_url().'cityarea/save_area'; ?>" method="post">
                    
                    <div class="col-lg-12">    
                        <label class="col-lg-6">Choose City : 
                            <i class="required"> * </i></label>
                            <select name="city_id">
                                <option>--Select--</option>
                                    <?php
                                    if(!empty($list['city'] ))
                                    {
                                        foreach ($list['city']  as $key => $value) 
                                        {
                                            echo "<option value='".$value->city_id."' >".$value->city_name."</option>";?>
                                     <?php   }
                                    } ?>
                            </select>
                    </div>
                    <div class="col-lg-12">    
                        <label class="col-lg-6">media_type:
                            <i class="required"> * </i></label>
                                <select name="media_type">
                                    <option>--Select--</option>
                                    <option value="apartment">apartment</option>
                                    <option value="event">event</option>
                                    <option value="park">park</option>
                                    <option value="mall">mall</option>
                                    <option value="hoarding">hoarding</option>
                                    <option value="radio">radio</option>
                                     
                                </select>                      
                    </div>          
                    <div class="col-lg-12">    
                        <label class="col-lg-12">Area :                        
                            <input name="area_name"  id="pac-input" class="form-control" type="text" autocomplete="on" value="<?php echo set_value('area_name'); ?>">
                        </label>                                     
                    </div>                    
                    <div class="col-lg-12 text-center">
                        <input type="submit" name="" value="Submit" class="btn hoverable_btn">
                    </div>

                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">close</button>
                </div>
                        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
                        <script type="text/javascript">
                       function initialize() {
                               var input = document.getElementById('searchTextField');
                               var autocomplete = new google.maps.places.Autocomplete(input);
                       }
                       google.maps.event.addDomListener(window, 'load', initialize);
                        </script>

            </div>

        </div>
    </div>
    </section>
  </div>
</div>
</div>
</div>
 
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="
https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.table1').DataTable( {
        dom: 'Blfrtip',
        bFilter: true, //Removes search box.
        "bSort" : false,
        buttons: [
            'copy',  'excel', 'pdf', 'print'
        ],

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    }); 

    $('.table2').DataTable( {
        dom: 'Blfrtip',
        bFilter: true, //Removes search box.
        "bSort" : false,
        buttons: [
            'copy',  'excel', 'pdf', 'print'
        ],

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    }); 
});



</script>
