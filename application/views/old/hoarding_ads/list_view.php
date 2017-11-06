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
<legend class="text-right"><label><a href="<?php echo base_url().'hoarding_ads/add'; ?>" class='btn hoverable_btn'>Add New Option</a></label></legend>
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
	            	if(!empty($hoarding_ads['new'])) {
	            		foreach ($hoarding_ads['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo"<legend><label><a href='".base_url()."hoarding_ads/show/".$hoarding_ads['new'][$key]->h_id."'>".$hoarding_ads['new'][$key]->h_title." -H".$hoarding_ads['new'][$key]->h_id."</label></a>
	            				 <span class='pull-right'><a  class='btn btn-info' href='".base_url()."hoarding_ads/edit/".$hoarding_ads['new'][$key]->h_id."'>Edit</a></span>";

                                  

                                   if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."hoarding_ads/change_hoardings_status/".$hoarding_ads['new'][$key]->h_id."/1'>Activate</a></span>";

                                  }
                            echo "</legend>";



	            		echo "<p>".$hoarding_ads['new'][$key]->h_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label class='no_result'>No New options found here.</label>";
	            	}
	            	?>
	            </section>





	         <!--    <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($hoarding_ads['all'])) {
	            		foreach ($hoarding_ads['all'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label><a href='".base_url()."hoarding_ads/show/".$hoarding_ads['all'][$key]->h_id."'>".$hoarding_ads['all'][$key]->h_title."</label></a>
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoarding_ads/block/".$hoarding_ads['all'][$key]->h_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='hoarding_ads/edit/".$hoarding_ads['all'][$key]->h_id."'>Edit</a></span>
	            				</legend>";
	            		echo "<p>".$hoarding_ads['all'][$key]->h_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Options found here.</label>";
	            	}
	            	?>
	            </section>
				<section  class="tab-pane fade in" id="actviePanel">
				<?php echo "<label>No options found here.</label>"; ?>
				</section>-->
				
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($hoarding_ads['active'])) {
	            		foreach ($hoarding_ads['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
							echo "<legend><label><a href='".base_url()."hoarding_ads/show/".$hoarding_ads['active'][$key]->h_id."'>".$hoarding_ads['active'][$key]->h_title." -H".$hoarding_ads['active'][$key]->h_id."</label></a>
	            			     **
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoarding_ads/delete_hoarding/".$hoarding_ads['active'][$key]->h_id."/3'>Delete</a></span>
								<span class='pull-right'><a  class='btn btn-warning' href='".base_url()."hoarding_ads/change_hoardings_status/".$hoarding_ads['active'][$key]->h_id."/2'>Block</a></span>
                                 
                                 <span class='pull-right'><a  class='btn btn-info' href='".base_url()."hoarding_ads/edit/".$hoarding_ads['active'][$key]->h_id."'>Edit</a></span>
                                 <span class='pull-right'><a  class='btn btn-success' href='".base_url()."recommend/save_rec_media/hoarding/".$hoarding_ads['active'][$key]->h_id."'>Recommended</a></span>

	            				
	            				</legend>";
	            		echo "<p>".$hoarding_ads['active'][$key]->h_desc."</p>";
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
	            	if(!empty($hoarding_ads['blocked'])) {
	            		foreach ($hoarding_ads['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label><a href='".base_url()."hoarding_ads/show/".$hoarding_ads['blocked'][$key]->h_id."'>".$hoarding_ads['blocked'][$key]->h_title." -H".$hoarding_ads['active'][$key]->h_id."</a></label>
	            				
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoarding_ads/delete_hoarding/".$hoarding_ads['blocked'][$key]->h_id."/3'>Delete</a></span>";
                                
                                   if($user_type=='admin')
                               {
	            				 echo"<span class='pull-right'><a  class='btn btn-success' href='".base_url()."hoarding_ads/change_hoardings_status/".$hoarding_ads['blocked'][$key]->h_id."/1'>Reactivate</a></span>";
	            		        }
							echo"</legend>";

	            		echo "<p>".$hoarding_ads['blocked'][$key]->h_desc."</p>";
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