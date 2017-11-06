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
<legend class="text-right"><label><a href="<?php echo base_url().'malls/add'; ?>" class='btn btn-success'>Add New Mall</a></label></legend>
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
	            	if(!empty($malls['new'])) {
	            		foreach ($malls['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			
	            			echo "<legend>
	            			 <a href=".base_url()."malls/show/".$malls['new'][$key]->mall_id.">".$malls['new'][$key]->mall_name." -M".$malls['new'][$key]->mall_id."</a></label>
	            		
	            				<span class='pull-right'><a  class='btn btn-info' href='".base_url()."malls/edit/".$malls['new'][$key]->mall_id."'>Edit</a></span>";


                               if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='malls/change_malls_status/".$malls['new'][$key]->mall_id."/1'>Activate</a></span>";

                                  }

                        echo"</legend>";
	            		
	            		echo "<p>".$malls['new'][$key]->mall_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No New Malls found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($malls['active'])) {
	            		foreach ($malls['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>
	            			<label><a href=".base_url()."malls/show/".$malls['active'][$key]->mall_id.">".$malls['active'][$key]->mall_name." -M".$malls['active'][$key]->mall_id."</a></label>
	            				
                              <span class='pull-right'><a  class='btn btn-warning' href='malls/change_malls_status/".$malls['active'][$key]->mall_id."/2'>Block</a></span>

                              <span class='pull-right'><a  class='btn btn-danger' href='".base_url()."malls/delete_malls/".$malls['active'][$key]->mall_id."/3'>Delete</a></span>

                              <span class='pull-right'><a  class='btn btn-success' href='".base_url()."recommend/save_rec_media/mall/".$malls['active'][$key]->mall_id."'>Recommended</a></span>

                              <span class='pull-right'><a class='btn btn-success' href='".base_url()."malls/view/".$malls['active'][$key]->mall_id."'>View options</a></span>
	            				
	            				<span class='pull-right'><a class='btn btn-success' href='".base_url()."mall_ads/add/".$malls['active'][$key]->mall_id."'>Add options</a></span>
	            				
	            				<span class='pull-right'><a  class='btn btn-info' href='".base_url()."malls/edit/".$malls['active'][$key]->mall_id."'>Edit</a></span>


	            				</legend>";
	            		echo "<p>".$malls['active'][$key]->mall_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Active Malls found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($malls['blocked'])) {
	            		foreach ($malls['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>

	            			<a href=".base_url()."malls/show/".$malls['blocked'][$key]->mall_id.">".$malls['blocked'][$key]->mall_name." -M".$malls['blocked'][$key]->mall_id."</a></label>
	            				
                                <span class='pull-right'><a  class='btn btn-danger' href='malls/delete_malls/".$malls['blocked'][$key]->mall_id."/3'>Delete</a></span>";

	            				 if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='malls/change_malls_status/".$malls['blocked'][$key]->mall_id."/1'>Reactivate</a></span>";

                                  }

                                  echo"</legend>";

	            		echo "<p>".$malls['blocked'][$key]->mall_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Blocked Malls found here.</label>";
	            	}
	            	?>
	            </section>
	        </div>
	    </div>
	</div>
</div>