<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if($this->session->userdata('user_type')!="")
         {
             $user_type = $this->session->userdata('user_type'); 
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
<legend class="text-right"><label><a href="<?php echo base_url().'radio_ads/add'; ?>" class='btn hoverable_btn'>Add New Option</a></label></legend>
	<div class="nav nav-tabs nav-justified">
	    <ul class="nav nav-tabs  main-navs" id="navID">
	           

	             <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
	            New</a></li>
	            <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
	            <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
	    </ul>
	    <div class="panel-body">
	        <div class="tab-content">
	          	
                <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($radio_ads['new'])) {

                           foreach ($radio_ads['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend> <label>".$radio_ads['new'][$key]->ad_title."</label>
	

	            				<span class='pull-right'><a  class='btn btn-info' href='radio_ads/edit/".$radio_ads['new'][$key]->ad_id."'>Edit</a></span>";


                              if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='radio_ads/change_radio_ads_status/".$radio_ads['new'][$key]->ad_id."/1'>Activate</a></span>";

                                  }
                        echo"</legend>";

	            		echo "<p>".$radio_ads['new'][$key]->ad_desc."</p>";
	            		echo "</div>";


	            		
	            	}
	            }
	            	else {
	            		echo "<label class='no_result'>No New radios found here.</label>";
	            	}
	            	?>
	            </section>




	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($radio_ads['active'])) {
	            		foreach ($radio_ads['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			//echo "<legend><label>".$radio_ads['active'][$key]->ad_title."</label>
	            		    echo "<legend><label><a  href='".base_url()."radio/show/".$radio_ads['active'][$key]->radio_id."#readmore".$radio_ads['active'][$key]->ad_id."'>".$radio_ads['active'][$key]->ad_title."</a></label>
               
	            				<span class='pull-right'><a  class='btn btn-danger' href='radio_ads/delete_radio_ads/".$radio_ads['active'][$key]->ad_id."/3'>Delete</a></span>
	            				
	            				<span class='pull-right'><a  class='btn btn-warning' href='radio_ads/change_radio_ads_status/".$radio_ads['active'][$key]->ad_id."/2'>Block</a></span>

	            				<span class='pull-right'><a  class='btn btn-info' href='radio_ads/edit/".$radio_ads['active'][$key]->ad_id."'>Edit</a></span>

	            				</legend>";
	            		
	            		echo "<p>".$radio_ads['active'][$key]->ad_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label class='no_result'>No Active Options found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($radio_ads['blocked'])) {
	            		foreach ($radio_ads['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$radio_ads['blocked'][$key]->ad_title."</label>
	            				

	            				<span class='pull-right'><a  class='btn btn-danger' href='radio_ads/delete_radio_ads/".$radio_ads['blocked'][$key]->ad_id."/3'>Delete</a></span>";

	            					 if($user_type =='admin') 

                                  {
                                    echo "<span class='pull-right'><a  class='btn btn-success' href='radio_ads/change_radio_ads_status/".$radio_ads['blocked'][$key]->ad_id."/1'>Reactivate</a></span>";

                                  }

                        echo "</legend>";
	            		

	            		echo "<p>".$radio_ads['blocked'][$key]->ad_desc."</p>";
	            		echo "</div>";
	            		}
	            	}
	            	else {
	            		echo "<label class='no_result'>No Blocked Options found here.</label>";
	            	}
	            	?>
	            </section>
	        </div>
	    </div>
	</div>
</div>