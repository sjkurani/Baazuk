<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'hoarding_ads/add'; ?>" class='btn btn-success'>Add New Option</a></label></legend>
	<div class="nav nav-tabs nav-justified">
	    <ul class="nav nav-tabs  main-navs" id="navID">
	            <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
	          Options</a></li>
				<li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">
	           Others</a></li>
	            
	           <!-- <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
	            <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>-->
	    </ul>
	    <div class="panel-body">
	        <div class="tab-content">
	            <section  class="tab-pane fade in active" id="newPanel">
	            	<?php
	            	if(!empty($hoarding_ads['all'])) {
	            		foreach ($hoarding_ads['all'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$hoarding_ads['all'][$key]->ad_title."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoarding_ads/block/".$hoarding_ads['all'][$key]->ad_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='hoarding_ads/edit/".$hoarding_ads['all'][$key]->ad_id."'>Edit</a></span>
	            				</legend>";
	            		echo "<p>".$hoarding_ads['all'][$key]->ad_desc."</p>";
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
				</section>
				
	            <!--<section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($hoarding_ads['active'])) {
	            		foreach ($hoarding_ads['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$hoarding_ads['active'][$key]->a_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoarding_ads/delete/".$hoarding_ads['active'][$key]->ad_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-warning' href='hoarding_ads/block/".$hoarding_ads['active'][$key]->ad_id."'>Hide</a></span>
	            				</legend>";
	            		echo "<p>".$hoarding_ads['active'][$key]->a_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Active Options found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($hoarding_ads['blocked'])) {
	            		foreach ($hoarding_ads['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$hoarding_ads['blocked'][$key]->a_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoarding_ads/delete/".$hoarding_ads['blocked'][$key]->ad_id."'>Delete</a></span>
	            				</legend>";
	            		echo "<p>".$hoarding_ads['blocked'][$key]->a_desc."</p>";
	            		echo "</div>";
	            		}
	            	}
	            	else {
	            		echo "<label>No Blocked Options found here.</label>";
	            	}
	            	?>
	            </section>-->
	        </div>
	    </div>
	</div>
</div>