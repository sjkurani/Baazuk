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

<legend class="text-right"><label><a href="<?php echo base_url().'mall_ads/add'; ?>" class='btn hoverable_btn'>Add New Option</a></label></legend>
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
	            	if(!empty($mall_ads['new'])) {
	            		foreach ($mall_ads['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			
	            			echo "<legend> <label>".$mall_ads['new'][$key]->ad_title."</label>
	            			
	            		
	            				<span class='pull-right'><a  class='btn btn-info' href='".base_url()."mall_ads/edit/".$mall_ads['new'][$key]->ad_id."'>Edit</a></span>";


                               if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."mall_ads/change_mall_ads_status/".$mall_ads['new'][$key]->ad_id."/1'>Activate</a></span>";

                                  }

                        echo"</legend>";
	            		
	            		echo "<p>".$mall_ads['new'][$key]->ad_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label class='no_result'>No New Malls found here.</label>";
	            	}
	            	?>
	            </section>
				
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($mall_ads['active'])) {
	            		foreach ($mall_ads['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			//echo "<legend><label>".$mall_ads['active'][$key]->ad_title."</label>
                            echo "<legend><label><a  href='".base_url()."malls/show/".$mall_ads['active'][$key]->mall_id."#readmore".$mall_ads['active'][$key]->ad_id."'>".$mall_ads['active'][$key]->ad_title."</a></label>
                                 <span class='pull-right'><a  class='btn btn-warning' href='".base_url()."mall_ads/change_mall_ads_status/".$mall_ads['active'][$key]->ad_id."/2'>Block</a></span>


	            				<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."mall_ads/delete_mall_ads/".$mall_ads['active'][$key]->ad_id."/3'>Delete</a></span>

	            				<span class='pull-right'><a  class='btn btn-info' href='".base_url()."mall_ads/edit/".$mall_ads['active'][$key]->ad_id."'>Edit</a></span>
	            				</legend>";
	            		
	            		echo "<p>".$mall_ads['active'][$key]->ad_desc."</p>";
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
	            	if(!empty($mall_ads['blocked'])) {
	            		foreach ($mall_ads['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$mall_ads['blocked'][$key]->ad_title."</label>
	            				
	            				<span class='pull-right'><a  class='btn btn-danger' href='mall_ads/delete_mall_ads/".$mall_ads['blocked'][$key]->ad_id."/3'>Delete</a></span>";


                             if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."mall_ads/change_mall_ads_status/".$mall_ads['blocked'][$key]->ad_id."/1'>Reactivate</a></span>";

                                  }

                                  echo"</legend>";


	            		echo "<p>".$mall_ads['blocked'][$key]->ad_desc."</p>";
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