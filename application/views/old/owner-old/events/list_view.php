<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'owner/events/add'; ?>" class='btn btn-success'>Add New event</a></label></legend>
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
	            	if(!empty($events['new'])) {
	            		foreach ($events['new'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$events['new'][$key]->event_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='events/block/".$events['new'][$key]->event_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='events/edit/".$events['new'][$key]->event_id."'>Edit</a></span>
	            				</legend>";
	            		echo "<p>".$events['new'][$key]->event_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No New events found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($events['active'])) {
	            		foreach ($events['active'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$events['active'][$key]->event_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='events/delete/".$events['active'][$key]->event_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-warning' href='events/block/".$events['active'][$key]->event_id."'>Hide</a></span>
	            				</legend>";
	            		echo "<p>".$events['active'][$key]->event_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Active events found here.</label>";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($events['blocked'])) {
	            		foreach ($events['blocked'] as $key => $value) {
	            			echo "<div class='row thumbnail list_view'>";
	            			echo "<legend><label>".$events['blocked'][$key]->event_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='events/delete/".$events['blocked'][$key]->event_id."'>Delete</a></span>
	            				</legend>";
	            		echo "<p>".$events['blocked'][$key]->event_desc."</p>";
	            		echo "</div>";
	            		}
	            		
	            	}
	            	else {
	            		echo "<label>No Blocked events found here.</label>";
	            	}
	            	?>
	            </section>
	        </div>
	    </div>
	</div>
</div>