<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="body container">
<br>
<legend class="text-right"><label><a href="<?php echo base_url().'owner/radio/add'; ?>" class='btn btn-success'>Add New Apartment</a></label></legend>
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
	            	if(!empty($radios['new'])) {
	            		print_r($radios['new']);
	            	}
	            	else {
	            		echo "No New radios found here.";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="actviePanel">
	            	<?php
	            	if(!empty($radios['active'])) {
	            		print_r($radios['active']);
	            	}
	            	else {
	            		echo "No Active radios found here.";
	            	}
	            	?>
	            </section>
	            <section  class="tab-pane fade in" id="blockedPanel">
	            	<?php
	            	if(!empty($radios['blocked'])) {
	            		print_r($radios['blocked']);
	            	}
	            	else {
	            		echo "No Blocked radios found here.";
	            	}
	            	?>
	            </section>
	        </div>
	    </div>
	</div>
</div>