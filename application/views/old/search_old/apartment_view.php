<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('account/forgot','id=account_frgot_frm');

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
	<div class="container">
		<div class="filter_bar">
				<input type="text" name="city" />
				<input type="text" name="area" />				
				<input type="submit" name="search_form" class="btn btn-default" />				
		</div>
		<div class="search_results">
			<?php
			foreach ($apartments_list as $key => $value) {
				echo "<pre>";
				if(file_exists(asset_url().'uploads/aprtments/'.$value->a_image)) {
					echo "<img src=".asset_url().'uploads/aprtments/'.$value->a_image."/>";
				}
				else {
					echo "<img src=".asset_url()."imgs/default.jpg />";
				}
				print_r($value->a_name);
				echo $value->a_cityname;
				echo "</pre>";
				//echo "<div class='thumbnail row>";
				/*if(file_exists(asset_url().'uploads/aprtments/'.$value->a_image)) {
					echo "<img src=".asset_url().'uploads/aprtments/'.$value->a_image."/>";
				}
				else {
					echo "<img src=".asset_url()."imgs/default.jpg />";
				}*/
				/*echo "<label>".$value->a_name."</label>";
				echo "</div>";*/
			}
			?>
		</div>
	</div>
</form>