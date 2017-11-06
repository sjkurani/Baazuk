<?php
/*
	List of global functions.
*/
function LoadCssAndJs($layoutsObj) {
	$layoutsObj->add_includes('assets/js/jquery-1.12.0.min.js')
			  ->add_includes('assets/js/jquery-ui-1.11.4/jquery-ui.min.css')
			  ->add_includes('assets/js/jquery-ui-1.11.4/jquery-ui.min.js')
			  ->add_includes('assets/datepicker/js/bootstrap-datetimepicker.min.js')
			  //->add_includes('assets/css/newstyle.css')
			  //->add_includes('assets/css/view.css')
			  //->add_includes('assets/css/style.css')
			  //->add_includes('assets/css/home.css')			 
			  ->add_includes('assets/bootstrap-3.3.6-dist/css/bootstrap.min.css')
			  ->add_includes('assets/datepicker/css/bootstrap-datetimepicker.min.css')
			  ->add_includes('assets/font-awesome-4.5.0/css/font-awesome.min.css')
			  ->add_includes('assets/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css')
			  ->add_includes('assets/js/my.js')
			  ->add_includes('assets/bootstrap-3.3.6-dist/js/bootstrap.min.js')
			  ->add_includes('assets/css/newstyle1.css')
			  ->add_includes('assets/js/new/bootstrap-select.min.js')
			  ->add_includes('assets/js/new/countdown.js')
			  ->add_includes('assets/js/new/jquery.nicescroll.min.js')
			  ->add_includes('assets/js/new/jquery.nouislider.all.min.js')
			  //->add_includes('assets/js/new/jquery-3.1.0.min.js')
			  ->add_includes('assets/js/new/owl.carousel.min.js')
			  //->add_includes('assets/js/new/richmarker.js')
			 // ->add_includes('assets/js/new/scripts.js')
			  ->add_includes('assets/js/new/sweetalert.min.js')			  
			  ->add_includes('assets/css/owl.carousel.css')
			  ->add_includes('assets/css/owl.theme.default.css')
			  ->add_includes('assets/css/bootstrap-select.min.css') 
			  ->add_includes('assets/css/default.css') 
			  ->add_includes('assets/css/font-awesome.min.css')
			  ->add_includes('assets/css/helper.css')
			  ->add_includes('assets/css/jquery.nouislider.min.css')
			  ->add_includes('assets/css/nivo-lightbox.css')
			  ->add_includes('assets/css/pe-icon-7-stroke.css')
			  ->add_includes('assets/css/pe-icon-social.css')
			  ->add_includes('assets/css/stylesheet.css')
			  ->add_includes('assets/css/sweetalert.css')
			  ->add_includes('assets/css/stylenew.css')
			  ->add_includes('assets/css/helper(1).css')
			  ->add_includes('assets/css/QuotaService.RecordEvent')
			  ->add_includes('assets/css/ViewportInfoService.GetViewportInfo')
			  ->add_includes('assets/css/ViewportInfoService.GetViewportInfo')
			  ->add_includes('assets/css/vt')
			  ->add_includes('assets/js/new/util.js')
			  ->add_includes('assets/js/new/stats.js')
			  ->add_includes('assets/js/new/overlay.js')
			  ->add_includes('assets/js/new/onion.js')
			  ->add_includes('assets/tinymce/js/tinymce/tinymce.min.js')
			  ->add_includes('assets/css/animate.min.css');
}

function asset_url(){
   return base_url().'assets/';
}

function redirect_dashboard_url($uri) {
	if(!empty($uri)) {
		$full_url = base_url().$uri;
		return $full_url;
	}
	else {
		return base_url();
	}
}

function is_authenticated_user($user_types_array) {
	$CI = & get_instance();
	$session_user_type = $CI->session->userdata('user_type');
	if(!in_array($session_user_type, $user_types_array)) {
		$CI->session->set_flashdata('errormsg', "You are not authorised to access that page.");
		redirect(base_url().'dashboard/'.$session_user_type);
	}
}
function check_user_authenticity($user_id) {
	$CI = & get_instance();  //get instance, access the CI superobject
	return (($CI->session->userdata('logged_in') == 1) && ($CI->session->userdata('user_id') == $user_id));
}
function send_password_mail($to_email,$user_type,$password) {
	$CI = & get_instance();
	$CI->load->library('email');
	$type = 'pas_reset';

					log_message('error', print_r("is_mail_sent",TRUE));
	$full_response = get_mail_content($type, $user_type,$password);
	$msg = $full_response['msg'];
	$sub = $full_response['sub'];
	$CI->email->from('info@themediabasket.com', 'MEDIA BASKET');
    $CI->email->subject($sub);
    $CI->email->set_mailtype("html");
	$CI->email->to($to_email);
	$CI->email->cc('isjkurani@gmail.com');
    $CI->email->message($msg);
    if($CI->email->send()){
		//return 'success';
		return ($CI->email->print_debugger());
	}
	else {
		return ($CI->email->print_debugger());
	}

}

function send_grid_mails($to_email,$type,$user_type) {
	$CI = & get_instance();
	$CI->load->library('email');
	$full_response = get_mail_content($type, $user_type);
	$msg = $full_response['msg'];
	$sub = $full_response['sub'];
	$CI->email->from('info@themediabasket.com', 'MEDIA BASKET');
    $CI->email->subject($sub);
    $CI->email->set_mailtype("html");
	$CI->email->to($to_email); 
	$CI->email->cc('isjkurani@gmail.com');
    $CI->email->message($msg);
    if($CI->email->send()){
		return 'success';
	}
	else {
		return ($CI->email->print_debugger());
	}


}
function get_mail_content($type,$user_type,$password = 0) {
	$mail_footer = '
		    <div id="footeqr">
		    <legend>Follow us:</legend>
		    <ul style="display: flex;width:100%;list-style: none;">
		        <li style="width:25%;"><a href="#">Facebook</a></li>
		        <li style="width:25%;"><a href="#">Google Plus</a></li>
		        <li style="width:25%;"><a href="#">Twitter</a></li>
		        <li style="width:25%;"><a href="#">Instagram</a></li>
		    </ul>
		    </div>';
	if($type == 'registration') {
		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		       New <a href='.base_url().'account/signin >'.$user_type.'</a> account has been created successfully.

		        <br>
		        Thanks & Regards, <br>
		        Media Basket Team 

		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Registration.');
	}

	elseif($type == 'approve') {

		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		        Admin Approved Your Request. You Can Login With Your entered credentials <a href='.base_url().'account/signin >Here</a>..

		        <br>
		        Thanks & Regards, 
		        Media Basket Team
		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Admin Approval.');
	}

	elseif($type == 'Blocked') {

		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		        Admin bloked Your Active Request. You Can Login With Your entered credentials <a href='.base_url().'account/signin >Here</a>..

		        <br>
		        Thanks & Regards, 
		        Media Basket Team
		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Admin Approval.');
	}

	elseif($type == 'Deleted') {

		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		        Admin Deleted Your Request.

		        <br>
		        Thanks & Regards, 
		        Media Basket Team
		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Admin Approval.');
	}

	elseif($type == 'pas_reset') {

		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		        Your password to login for Mediabasket Account is <b> '.$password.' </b>.Please login and update your password.

		        <br>
		        Thanks & Regards, 
		         Media Basket Team  
		</div>';
		return array('msg' => $mail_string, 'sub' => 'Forgot Password for Media Basket.');
	}
}
/*admin mail for all activity details*/
function send_admin_grid_mails($to_email,$type,$action,$user_name,$user_id,$user_type,$inserted_apartment_id) {
	$CI = & get_instance();
	$CI->load->library('email');
	$full_response = get_admin_mail_content($type,$action,$user_name,$user_id,$user_type,$inserted_apartment_id);
	$msg = $full_response['msg'];
	$sub = $full_response['sub'];
	$CI->email->from('info@themediabasket.com', 'MEDIA BASKET');
    $CI->email->subject($sub);
    $CI->email->set_mailtype("html");
	$CI->email->to($to_email); 
	$CI->email->cc('isjkurani@gmail.com');
    $CI->email->message($msg);
    if($CI->email->send()){
		//return 'success';
		log_message('error',$type."Mail Sent successfully");
	}
	else {
		log_message('error',print_r($CI->email->print_debugger(), TRUE));
		//return ($CI->email->print_debugger());

	}


}
function get_admin_mail_content($type,$action,$user_name,$user_id,$user_type,$inserted_apartment_id) {
	$mail_footer = '
		    <div id="footeqr">
		    <legend>Follow us:</legend>
		    <ul style="display: flex;width:100%;list-style: none;">
		        <li style="width:25%;"><a href="#">Facebook</a></li>
		        <li style="width:25%;"><a href="#">Google Plus</a></li>
		        <li style="width:25%;"><a href="#">Twitter</a></li>
		        <li style="width:25%;"><a href="#">Instagram</a></li>
		    </ul>
		    </div>';
	if($action == 'new') {
		$img_name = asset_url()."imgs/purple-logo.png";
		$full_url = base_url().'/'.$type.'/show/'.$inserted_apartment_id;
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi, 
		    <a href='.base_url().'users/show/'.$user_id.'/'.$user_type.'>'.$user_name.'</a> <br>

		    created '.$action.'   Option of type <a href='.$full_url.'>'.$type.'</a> successfully. Please approve a request.
		   <br>
		        Thanks & Regards, <br>
		        Media Basket Team 

		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Registration.');
	}
}



function send_save_grid_mails($to_email,$type,$ad_type,$user_name) {
	$CI = & get_instance();
	$CI->load->library('email');
	$full_response = get_save_mail_content($type,$ad_type,$user_name);
	$msg = $full_response['msg'];
	$sub = $full_response['sub'];
	$CI->email->from('info@themediabasket.com', 'MEDIA BASKET');
    $CI->email->subject($sub);
    $CI->email->set_mailtype("html");
	$CI->email->to($to_email); 
	$CI->email->cc('isjkurani@gmail.com');
    $CI->email->message($msg);
    if($CI->email->send()){
		return 'success';
	}
	else {
		return ($CI->email->print_debugger());
	}

}

function get_save_mail_content($type,$ad_type,$user_name) {
	$mail_footer = '
		    <div id="footeqr">
		    <legend>Follow us:</legend>
		    <ul style="display: flex;width:100%;list-style: none;">
		        <li style="width:25%;"><a href="#">Facebook</a></li>
		        <li style="width:25%;"><a href="#">Google Plus</a></li>
		        <li style="width:25%;"><a href="#">Twitter</a></li>
		        <li style="width:25%;"><a href="#">Instagram</a></li>
		    </ul>
		    </div>';
	if($type == 'enquiry') {
		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		   		'.$user_name.'  is successfully submited '.$type.' form.
		   <br>
		        Thanks & Regards, <br>
		        Media Basket Team 

		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Registration.');
	}
	if($type == 'closed') {
		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,<br>
		   		'.$user_name.'  admin is  '.$type.' your '.$ad_type.' .
		   <br>
		        Thanks & Regards, <br>
		        Media Basket Team 

		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Registration.');
	}
}

function send_enquiry_close_grid_mails($to_email,$type,$ad_type,$user_name,$mobile_no,$full_name,$remarks) {
	$CI = & get_instance();
	$CI->load->library('email');
	$full_response = get_enquiry_close_mail_content($to_email,$type,$ad_type,$user_name,$mobile_no,$full_name,$remarks);
	$msg = $full_response['msg'];
	$sub = $full_response['sub'];
	$CI->email->from('info@themediabasket.com', 'MEDIA BASKET');
    $CI->email->subject($sub);
    $CI->email->set_mailtype("html");
	$CI->email->to($to_email); 
	$CI->email->cc('isjkurani@gmail.com');
    $CI->email->message($msg);
    if($CI->email->send()){
		return 'success';
	}
	else {
		return ($CI->email->print_debugger());
	}

}
function get_enquiry_close_mail_content($to_email,$type,$ad_type,$user_name,$mobile_no,$full_name,$remarks) {
	$mail_footer = '
		    <div id="footeqr">
		    <legend>Follow us:</legend>
		    <ul style="display: flex;width:100%;list-style: none;">
		        <li style="width:25%;"><a href="#">Facebook</a></li>
		        <li style="width:25%;"><a href="#">Google Plus</a></li>
		        <li style="width:25%;"><a href="#">Twitter</a></li>
		        <li style="width:25%;"><a href="#">Instagram</a></li>
		    </ul>
		    </div>';
	if($type == 'closed') {
		$img_name = asset_url()."imgs/purple-logo.png";
		$mail_string = '<div 
				style = "
				color:#333;
				padding:2%;
				margin:2%;
				background: #f1f1f1;
				border-radius: 10px;
				"
				>
		    <center><img src='.$img_name.' ?></center>
		    <div>
		        <h1>MEDIABASKET</h1>
		        <h3>MEDIA SIMPLIFIED</h3>
		    </div>
		    Hi,
		   		'.$user_name.' <br> admin is  '.$type.' your enquiry on '.$ad_type.' with remarks 
		   		'.$remarks.'
		   <br>
		   User details are <br>
		   Name :'.$full_name.' <br>
		   email :'.$to_email.' <br>
		   Mobile :'.$mobile_no.'<br>
		   <br>
		        Thanks & Regards, <br>
		        Media Basket Team 

		</div>';
		return array('msg' => $mail_string, 'sub' => 'Mediabasket Registration.');
	}
}

?>