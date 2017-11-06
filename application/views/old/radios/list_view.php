<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
  if($this->session->userdata('user_type')!="")
         {
             $user_type = $this->session->userdata('user_type'); 
         } 
         if($this->session->flashdata('msg')){ 
        echo ' <div class="alert alert-success row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('msg');
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
<legend class="text-right"><label><a href="<?php echo base_url().'radio/add'; ?>" class='btn btn-success'>Add New Radio Station</a></label></legend>
	<div class="nav nav-tabs nav-justified">
	    <ul class="nav nav-tabs  main-navs" id="navID">
	            <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
	            New</a></li>
	            <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
	            <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
	    </ul>
	    <div class="panel-body threepanel">
	        <div class="tab-content">
	            <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($radios['new'])) {

                           foreach ($radios['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>

	            			<label><a href=".base_url()."radio/show/".$radios['new'][$key]->radio_station_id.">".$radios['new'][$key]->radio_station_name." -R".$radios['new'][$key]->radio_station_id."</a></label>
	            				

	            				<span class='pull-right'><a  class='btn btn-info' href='radio/edit/".$radios['new'][$key]->radio_station_id."'>Edit</a></span>";


                              if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='radio/change_radios_status/".$radios['new'][$key]->radio_station_id."/1'>Activate</a></span>";

                                  }
                        echo"</legend>";

	            		echo "<p>".$radios['new'][$key]->radio_station_desc."</p>";
	            		echo "</div>";


	            		
	            	}
	            }
	            	else {
	            		echo "No New radios found here.";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($radios['active'])) {

                         foreach ($radios['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>


	            			 <label><a href=".base_url()."radio/show/".$radios['active'][$key]->radio_station_id.">".$radios['active'][$key]->radio_station_name." -R".$radios['active'][$key]->radio_station_id."</a></label>
	            				
	            				<span class='pull-right'><a  class='btn btn-warning' href='radio/change_radios_status/".$radios['active'][$key]->radio_station_id."/2'>Block</a></span>

	            				<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."radio/delete_radio/".$radios['active'][$key]->radio_station_id."/3'>Delete</a></span>

	            				<span class='pull-right'><a  class='btn btn-success' href='".base_url()."recommend/save_rec_media/radio/".$radios['active'][$key]->radio_station_id."'>Recommended</a></span>

	            				<span class='pull-right'><a  class='btn btn-success' href='".base_url()."radio/view/".$radios['active'][$key]->radio_station_id."'>View options</a></span>
	            				
	            				<span class='pull-right'><a  class='btn btn-success' href='".base_url()."radio_ads/add/".$radios['active'][$key]->radio_station_id."'>Add options</a></span>
	            				
	            				<span class='pull-right'><a  class='btn btn-info' href='".base_url()."radio/edit/".$radios['active'][$key]->radio_station_id."'>Edit</a></span>

	            				</legend>";
	            		echo "<p>".$radios['active'][$key]->radio_station_desc."</p>";
	            		echo "</div>";

	            		
	            	}
	            }
	            	else {
	            		echo "No Active radios found here.";
	            	}
	            	?>
	            </section>
	            
	             <section  class="tab-pane fade in" id="blockedPanel">
                    <?php
                    if(!empty($radios['blocked'])) {


                        foreach ($radios['blocked'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend>


                        <label><a href=".base_url()."radio/show/".$radios['blocked'][$key]->radio_station_id.">".$radios['blocked'][$key]->radio_station_name." -R".$radios['blocked'][$key]->radio_station_id."</a></label>

                                <span class='pull-right'><a  class='btn btn-danger' href='".base_url()."radio/delete_radio/".$radios['blocked'][$key]->radio_station_id."/3'>Delete</a></span>";

                              if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."radio/change_radios_status/".$radios['blocked'][$key]->radio_station_id."/1'>Reactivate</a></span>";

                                  }

                        echo "</legend>";

                        echo "<p>".$radios['blocked'][$key]->radio_station_desc."</p>";
                        echo "</div>";
                    }
                }
                    else {
                        echo "No Blocked parks found here.";
                    }
                    ?>
                </section>

	        </div>
	    </div>
	</div>
</div>