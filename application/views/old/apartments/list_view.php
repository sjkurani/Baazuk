<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if($this->session->userdata('user_type')!="") {
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
	<legend class="text-right"><label><a href="<?php echo base_url().'apartments/add'; ?>" class='btn hoverable_btn'>Add New Apartment</a></label></legend>
	<div class="nav nav-tabs nav-justified">
	    <ul class="nav nav-tabs  main-navs" id="navID">
	            <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
	            New</a></li>
	            <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
	            <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
	    </ul>
		</div>
	    <div class="panel-body">
	        <div class="tab-content">
	           <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($apartments['new'])) {
	            		foreach ($apartments['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>
	            			     <label><a href=".base_url()."apartments/show/".$apartments['new'][$key]->a_id.">".$apartments['new'][$key]->a_name."</a></label>	

	            				 <span class='pull-right'><a  class='btn btn-info' href='".base_url()."apartments/edit/".$apartments['new'][$key]->a_id."'>Edit</a></span>    ";

                                  if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."apartments/change_apartments_status/".$apartments['new'][$key]->a_id."/1'>Activate</a></span>";

                                  }
                            echo "</legend>";



	            		echo "<p>".$apartments['new'][$key]->a_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No New apartments found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($apartments['active'])) {
	            		foreach ($apartments['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>
	            			<label><a href=".base_url()."apartments/show/".$apartments['active'][$key]->a_id.">".$apartments['active'][$key]->a_name."</a></label>
	            				

	            				<span class='pull-right'><a  class='btn btn-warning' href='".base_url()."apartments/change_apartments_status/".$apartments['active'][$key]->a_id."/2'>Block</a></span>
	            				
	            				
	            				<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."apartments/delete_apartments/".$apartments['active'][$key]->a_id."/3'>Delete</a></span>

	            				<span class='pull-right'><a  class='btn btn-success' href='".base_url()."recommend/save_rec_media/apartment/".$apartments['active'][$key]->a_id."'>Recommended</a></span>
	            				
	            				<span class='pull-right'><a  class='btn btn-success' href='".base_url()."apartments/view/".$apartments['active'][$key]->a_id."'>View options</a></span>
                               
	            				<span class='pull-right'><a  class='btn btn-success' href='".base_url()."apartment_ads/add/".$apartments['active'][$key]->a_id."'>Add options</a></span>
	            				
	            				<span class='pull-right'><a  class='btn btn-info' href='".base_url()."apartments/edit/".$apartments['active'][$key]->a_id."'>Edit</a></span>

	            				</legend>";
	            		
	            		echo "<p>".$apartments['active'][$key]->a_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Active apartments found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($apartments['blocked'])) {
	            		foreach ($apartments['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend>
	            			<label><a href=".base_url()."apartments/show/".$apartments['blocked'][$key]->a_id.">".$apartments['blocked'][$key]->a_name."</a></label>
	            				
	            				<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."apartments/delete_apartments/".$apartments['blocked'][$key]->a_id."/3'>Delete</a></span>
								";


                               if($user_type=='admin')
                               {
                                 
                                 echo "<span class='pull-right'><a  class='btn btn-success' href='".base_url()."apartments/change_apartments_status/".$apartments['blocked'][$key]->a_id."/1'>Reactivate</a></span>";
                               }
                            echo "</legend>";


	            		echo "<p>".$apartments['blocked'][$key]->a_desc."</p>";
	            		echo "</div>";
	            		}
	            	}
	            	else {
	            		echo "<label>No Blocked apartments found here.</label>";
	            	}
	            	?>
	            </section>

	        </div>
	    </div>
	</div>

</div>
</div>
</body>