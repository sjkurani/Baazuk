<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if($this->session->flashdata('msg')){ 
        echo ' <div class="alert alert-success row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('msg');
    echo '</b></div>';
}
if($this->session->flashdata('errormsg')){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('errormsg'); 
    echo '</b></div>';

}

if(isset($err_msg)){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $err_msg; 
    echo '</b></div>';

}
if (isset($msg)) {
        echo ' <div class="alert alert-success row"><b>
        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $msg;
    echo '</b></div>';
}

 if (validation_errors()){
    echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo validation_errors();
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
	<div class="nav nav-tabs nav-justified well no_result">
	<div class="tab-content">
		 <ul class="nav nav-tabs nav-justified main-navs" id="navID">
			 <li class="active" id="owner"><a href="#OwnerPanel" data-toggle="tab" aria-expanded="true">Owner</a></li>
			  <li class="" id="buyer"><a href="#BuyerPanel" data-toggle="tab" aria-expanded="false">Buyer</a></li>
		</ul>
		<div class="panel-body threepanel ">
			<div class="tab-content">
				<section  class="tab-pane fade  in active" id="OwnerPanel">
					<div class="row ">
						<div class="tab-content">
						   <ul class="nav nav-pills underlined">
								<li class="active" id="new"><a href="#OwnernewPanel" data-toggle="tab" aria-expanded="true">New</a></li>
								<li class="" id="active"><a href="#OwneractviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
								<li class=""  id="blocked"><a href="#OwnerblockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
							</ul>
				        <div class="panel-body">
							<div class="tab-content row">
								<section  class="tab-pane fade in active" id="OwnernewPanel">
								<?php
									if(!empty($owner['new'])) {
										foreach ($owner['new'] as $key => $value) {
											echo "<div class='row thumbnail list_view'>";
											echo "<legend>
												  <label><a href=".base_url()."users/show/".$owner['new'][$key]->user_id."/".$owner['new'][$key]->user_type.">".$owner['new'][$key]->username."-".$owner['new'][$key]->user_id."</a></label>				
												  <span class='pull-right'><a  class='btn btn-success' href='".base_url()."users/change_users_status/".$owner['new'][$key]->user_id."/1/owner'>Activate</a></span>
												  </legend>";
											
											echo "</div>";
										}
										
									}
									else {
										echo "<label class='no_result'>No New owner found here.</label>";
									}
									?>
								</section>
								<section  class="tab-pane fade in" id="OwneractviePanel">
									<?php
									if(!empty($owner['active'])) {
										foreach ($owner['active'] as $key => $value) {
											echo "<div class='row thumbnail list_view'>";
											echo "
												<label><a href=".base_url()."users/show/".$owner['active'][$key]->user_id."/".$owner['active'][$key]->user_type.">".$owner['active'][$key]->username."-".$owner['active'][$key]->user_id."</a></label>
												
												<span class='pull-right'><a  class='btn btn-warning' href='".base_url()."users/change_users_status/".$owner['active'][$key]->user_id."/2/".$owner['active'][$key]->user_type."'>Block</a></span>
												
												
												<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."users/delete_users/".$owner['active'][$key]->user_id."/3/".$owner['active'][$key]->user_type."'>Delete</a></span>
												
												";
										
										
											echo "</div>";
										}
										
									}
									else {
										echo "<label class='no_result'>No Active owner found here.</label>";
									}
									?>
								</section>
							
								<section  class="tab-pane fade in" id="OwnerblockedPanel">
									<?php
										if(!empty($owner['blocked'])) {
											foreach ($owner['blocked'] as $key => $value) {
												echo "<div class='row thumbnail list_view'>";
												echo "
												<label><a href=".base_url()."users/show/".$owner['blocked'][$key]->user_id."/".$owner['blocked'][$key]->user_type.">".$owner['blocked'][$key]->username."-".$owner['blocked'][$key]->user_id."</a></label>
													
													<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."users/delete_users/".$owner['blocked'][$key]->user_id."/3/".$owner['blocked'][$key]->user_type."'>Delete</a></span>
													 <span class='pull-right'><a  class='btn btn-success' href='".base_url()."users/change_users_status/".$owner['blocked'][$key]->user_id."/1/".$owner['blocked'][$key]->user_type."'>Reactivate</a></span>;
													";
												
												echo "</div>";
											}
										}
										else {
												echo "<label class='no_result'>No Blocked users found here.</label>";
										}
									?>
								</section>
							</div>
                        </div>
                   </div>
			    </div>
		    </section>
				
				
		<section  class="tab-pane fade in" id="BuyerPanel">
		    <div class="row">
				<div class="">
					<ul class="nav nav-pills" id="navID">
						<li class="active" id="new"><a href="#BuyernewPanel" data-toggle="tab" aria-expanded="true">
						New</a></li>
						<li class="" id="active"><a href="#BuyeractviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
						<li class=""  id="blocked"><a href="#BuyerblockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
					</ul>
			<div class="panel-body">
				<div class="tab-content">
				   <section  class="tab-pane fade in active" id="BuyernewPanel">
						<?php
						if(!empty($buyer['new'])) {
							foreach ($buyer['new'] as $key => $value) {
								echo "<div class='row thumbnail list_view'>";
								echo "
									  <label><a href=".base_url()."users/show/".$buyer['new'][$key]->user_id."/".$buyer['new'][$key]->user_type.">".$buyer['new'][$key]->username."-".$buyer['new'][$key]->user_id."</a></label>				
									  <span class='pull-right'><a  class='btn btn-success' href='".base_url()."users/change_users_status/".$buyer['new'][$key]->user_id."/1/".$buyer['new'][$key]->user_type."'>Activate</a></span>
									";
							
							echo "</div>";
							}
							
						}
						else {
							echo "<label class='no_result'>No New buyer found here.</label>";
						}
						?>
					</section>
					<section  class="tab-pane fade in" id="BuyeractviePanel">
						<?php
						if(!empty($buyer['active'])) {
							foreach ($buyer['active'] as $key => $value) {
								echo "<div class='row thumbnail list_view'>";
								echo "
									<label><a href=".base_url()."users/show/".$buyer['active'][$key]->user_id."/".$buyer['active'][$key]->user_type.">".$buyer['active'][$key]->username."-".$buyer['active'][$key]->user_id."</a></label>
									
									<span class='pull-right'><a  class='btn btn-warning' href='".base_url()."users/change_users_status/".$buyer['active'][$key]->user_id."/2/".$buyer['active'][$key]->user_type."'>Block</a></span>
									
									
									<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."users/delete_users/".$buyer['active'][$key]->user_id."/3/".$buyer['active'][$key]->user_type."'>Delete</a></span>
									
									";
							
							echo "<p>".$buyer['active'][$key]->service_type."</p>";
							echo "</div>";
							}
							
						}
						else {
							echo "<label class='no_result'>No Active buyer found here.</label>";
						}
						?>
					</section>
					<section  class="tab-pane fade in" id="BuyerblockedPanel">
						<?php
						if(!empty($buyer['blocked'])) {
							foreach ($buyer['blocked'] as $key => $value) {
								echo "<div class='row thumbnail list_view'>";
								echo "
								<label><a href=".base_url()."users/show/".$buyer['blocked'][$key]->user_id."/".$buyer['blocked'][$key]->user_type.">".$buyer['blocked'][$key]->username."-".$buyer['blocked'][$key]->user_id."</a></label>
									
									<span class='pull-right'><a  class='btn btn-danger' href='".base_url()."users/delete_users/".$buyer['blocked'][$key]->user_id."/3/".$buyer['blocked'][$key]->user_type."'>Delete</a></span>
									 <span class='pull-right'><a  class='btn btn-success' href='".base_url()."users/change_users_status/".$buyer['blocked'][$key]->user_id."/1/".$buyer['blocked'][$key]->user_type."'>Reactivate</a></span>;
									";
							
							echo "</div>";
							}
						}
						else {
							echo "<label class='no_result'>No Blocked buyer found here.</label>";
						}
						?>
					</section>
	        </div>
			</div>
			</div>
	    </div>
		</section>
	</div>
	</div>
</div>
</div>
</div>
</div>
</body>