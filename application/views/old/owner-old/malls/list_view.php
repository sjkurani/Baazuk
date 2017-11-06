<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'owner/malls/add'; ?>" class='btn btn-success'>Add New Mall</a></label></legend>
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
	            			echo "<legend><label>".$malls['new'][$key]->mall_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='malls/block/".$malls['new'][$key]->mall_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='malls/edit/".$malls['new'][$key]->mall_id."'>Edit</a></span>
	            				</legend>";
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
	            			echo "<legend><label>".$malls['active'][$key]->mall_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='malls/block/".$malls['active'][$key]->mall_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='malls/edit/".$malls['active'][$key]->mall_id."'>Edit</a></span>
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
	            			echo "<legend><label>".$malls['blocked'][$key]->mall_name."</label>
	            				<span class='pull-right'><a  class='btn btn-danger' href='malls/block/".$malls['blocked'][$key]->mall_id."'>Delete</a></span>
	            				<span class='pull-right'><a  class='btn btn-info' href='malls/edit/".$malls['blocked'][$key]->mall_id."'>Edit</a></span>
	            				</legend>";
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