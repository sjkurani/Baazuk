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
<legend class="text-right"><label><a href="<?php echo base_url().'apartment_ads/add'; ?>" class='btn hoverable_btn'>Add New Option</a></label></legend>
	<div class="nav nav-tabs nav-justified">
	    <ul class="nav nav-tabs  main-navs" id="navID">
	          <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">New</a></li>
	           <li id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
	            <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
	    </ul>
	    
	    <div class="panel-body">
	        <div class="tab-content">
	            
	        

                <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($apartment_ads['new'])) {
	            		foreach ($apartment_ads['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend> <legend><label>".$apartment_ads['new'][$key]->ad_title."</label>
	            			     

	            				 <span class='pull-right'><a  class='btn btn-info' href='".base_url()."apartment_ads/edit/".$apartment_ads['new'][$key]->ad_id."'>Edit</a></span>    ";

                                  if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."apartment_ads/change_apartment_ads_status/".$apartment_ads['new'][$key]->ad_id."/1'>Activate</a></span>";

                                  }
                            echo "</legend>";



	            		echo "<p>".$apartment_ads['new'][$key]->ad_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label class='no_result'>No New apartment ads found here.</label>";
	            	}
	            	?>
	            </section>




				
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($apartment_ads['active'])) {
	            		foreach ($apartment_ads['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			
	            			echo "<legend><label><a  href='".base_url()."apartments/show/".$apartment_ads['active'][$key]->ap_id."#readmore".$apartment_ads['active'][$key]->ad_id."'>".$apartment_ads['active'][$key]->ad_title."</a></label>
	            			
							
							
	            			    <span class='pull-right'><a class='btn btn-warning' href='".base_url()."apartment_ads/change_apartment_ads_status/".$apartment_ads['active'][$key]->ad_id."/2'>Block</a></span>
	            				
	            				
	            				<span class='pull-right'><a class='btn btn-danger' href='apartment_ads/delete_apartment_ads/".$apartment_ads['active'][$key]->ad_id."/3'>Delete</a></span>

	            				<span class='pull-right'><a class='btn btn-info' href='".base_url()."apartment_ads/edit/".$apartment_ads['active'][$key]->ad_id."'>Edit</a></span> 
	            				
	            				
	            				</legend>";
	            		
	            		echo "<p>".$apartment_ads['active'][$key]->ad_desc."</p>";
	            		echo "</div>";?>
						<div id="<?php echo "#readmore".$apartment_ads['active'][$key]->ad_id;?>" class='modal fade' role='dialog'>
		                <div class="modal-dialog modal-lg">

		               <!-- Modal content-->
		               <div class="modal-content">
					   </div>
					   </div></div>
	            	<?php	}
	            		
	            	}
	            	else {
	            		echo "<label class='no_result'>No Active Options found here.</label>";
	            	}
	            	?>
					
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($apartment_ads['blocked'])) {
	            		foreach ($apartment_ads['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$apartment_ads['blocked'][$key]->ad_title."</label>

	            				<span class='pull-right'><a  class='btn btn-danger' href='apartment_ads/delete_apartment_ads/".$apartment_ads['blocked'][$key]->ad_id."/3'>Delete</a></span>";

                                 if($user_type=='admin')
                               {
                                 
                                 echo "<span class='pull-right'><a  class='btn btn-success' href='".base_url()."apartment_ads/change_apartment_ads_status/".$apartment_ads['blocked'][$key]->ad_id."/1'>Reactivate</a></span>";
                               }

                                echo "</legend>";


	            		echo "<p>".$apartment_ads['blocked'][$key]->ad_desc."</p>";
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

</body>