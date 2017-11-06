<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'owner/apartments/add'; ?>" class='btn btn-success'>Add New Apartment</a></label></legend>
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
	            	if(!empty($apartments['new'])) {
	            		foreach ($apartments['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$apartments['new'][$key]->a_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='apartments/block/".$apartments['new'][$key]->a_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='apartments/edit/".$apartments['new'][$key]->a_id."'>Edit</a></span>
	            				</legend>";
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
	            			echo "<legend><label>".$apartments['active'][$key]->a_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='apartments/delete/".$apartments['active'][$key]->a_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-warning' href='apartments/block/".$apartments['active'][$key]->a_id."'>Hide</a></span>
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
	            			echo "<legend><label>".$apartments['blocked'][$key]->a_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='apartments/delete/".$apartments['blocked'][$key]->a_id."'>Delete</a></span>
	            				</legend>";
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