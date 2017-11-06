<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'hoardings/add'; ?>" class='btn btn-success'>Add New Hoarding</a></label></legend>
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
	            	if(!empty($hoardings['new'])) {
	            		foreach ($hoardings['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$hoardings['new'][$key]->h_title."</label>
	            				
	            				<span class='pull-right'><a  class='btn btn-success' href='hoardings/change_hoardings_status/".$hoardings['new'][$key]->h_id."/1'>Activate</a></span>
	            				

	            				<span class='pull-right'><a  class='btn btn-info' href='hoardings/edit/".$hoardings['new'][$key]->h_id."'>Edit</a></span>
	            				</legend>";
	            		echo "<p>".$hoardings['new'][$key]->h_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No New Hoardings found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($hoardings['active'])) {
	            		foreach ($hoardings['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$hoardings['active'][$key]->h_title."</label>
	            				
                                <span class='pull-right'><a  class='btn btn-warning' href='hoardings/change_hoardings_status/".$hoardings['active'][$key]->h_id."/2'>Block</a></span>

	            				</legend>";
	            		echo "<p>".$hoardings['active'][$key]->h_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Active Hoardings found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($hoardings['blocked'])) {
	            		foreach ($hoardings['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$hoardings['blocked'][$key]->h_title."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='hoardings/delete_hoardings/".$hoardings['blocked'][$key]->h_id."/3'>Delete</a></span>

	            				<span class='pull-right'><a  class='btn btn-success' href='hoardings/change_hoardings_status/".$hoardings['blocked'][$key]->h_id."/1'>Reactivate</a></span>



	            				</legend>";
	            		echo "<p>".$hoardings['blocked'][$key]->h_desc."</p>";
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