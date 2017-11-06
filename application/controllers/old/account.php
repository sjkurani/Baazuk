<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
	    $this->load->model('save_update_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		redirect('account/signin','refresh');
	}

	function signup() {
		
		$data = array();
		$posted_data = $this->input->post();
		if((!empty($posted_data)) && ($posted_data['user_type'] == 'buyer')) {
			$this->_buyer_signup_rules();
		}
		if((!empty($posted_data)) && ($posted_data['user_type'] == 'owner')) {
			$this->_owner_signup_rules();
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->view('account/signup_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
		}
		else {
			//save and redirect..
			$data = $this->input->post();
			if($data['user_type'] == 'buyer') {
				$user_array = array('username' => $data['user_name'],
									'fullname' =>  $data['user_name'],
									'email' => $data['user_email'],
									'mobile' => $data['user_phone'],
									'service_type' => '',
									'user_type' => 'buyer',
									'service_type' => '',
									'nickname' => $this->encrypt->encode($data['user_pass']));
				$id = $this->save_update_model->save_user_details($user_array,'buyer'); 
				if($id) {
					$is_mail_sent = send_grid_mails(ADMIN_EMAIL,'registration','buyer',$data['user_email']) ;
					$this->session->set_flashdata('msg', 'Buyer registered successfully Please wait for admin aproval.');
					redirect('account/signin','refresh');
				}
				else {
					$this->session->set_flashdata('errormsg', 'User registration failed please try after sometime.');
					redirect('account/signin','refresh');
				}
			}
			else if($data['user_type'] == 'owner') {
				$user_array = array('username' => $data['user_name'],
									'fullname' =>  $data['user_name'],
									'email' => $data['user_email'],
									'mobile' => $data['user_phone'],
									'flag' => 0,
									'service_type' => '',//$data['service'],
									'user_type' => 'owner',
									'nickname' => $this->encrypt->encode($data['user_pass']));

				$id = $this->save_update_model->save_user_details($user_array,'owner',$data['user_email']); 
				if($id) {
					$is_mail_sent = send_grid_mails($data['user_email'],'registration','owner') ;
					//print_r($is_mail_sent);
					log_message('error', print_r($is_mail_sent,TRUE));
					$this->session->set_flashdata('msg', 'Owner registered successfully Please wait for admin aproval.');
					redirect('account/signin','refresh');
				}
				else {
					$this->session->set_flashdata('errormsg', 'User registration failed please try after sometime.');
					redirect('account/signin','refresh');
				}		
			}
		}
	}

	function _owner_signup_rules(){
		$this->form_validation->set_rules('user_name', 'Owner Name ', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('user_email', 'Owner Email', 'trim|required|xss_clean|valid_email|is_unique[owner_details.email]');
		$this->form_validation->set_rules('user_phone', 'Owner Phone', 'trim|required|integer|exact_length[10]|xss_clean');
		$this->form_validation->set_rules('user_pass', 'Owner  Password', 'trim|required|min_length[6]|xss_clean');	
	}

	function _buyer_signup_rules() {
		$this->form_validation->set_rules('user_name', 'Buyer Name ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_email', 'Buyer Email', 'trim|required|xss_clean|valid_email|is_unique[buyer_details.email]');
		$this->form_validation->set_rules('user_phone', 'Buyer Phone ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_pass', 'Buyer  Password', 'trim|required|min_length[6]|xss_clean');
	}

	/*
	* if account activated and password matches then set session variables.
	*/
	function signin() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('-.');
		$data = array();

		$is_logged_in = $this->session->userdata('logged_in');
		if($is_logged_in == 1) {
			redirect(base_url().'dashboard/'.$this->session->userdata('user_type'));			
		}
		else {
			$user_type = $this->input->post('submit_btn');
			if($user_type == 'owner') {
				$this->_owner_signin_rules();
			}
			else if($user_type == 'buyer') {
				$this->_buyer_signin_rules();
			}

			if ($this->form_validation->run() == FALSE)
			{
				$this->layouts->view('account/signin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
			else
			{
				$signin_username = ($user_type == 'owner') ? $this->input->post('owner_email_mobile') : $this->input->post('buyer_email_mobile') ;
				$signin_password = ($user_type == 'owner') ? $this->input->post('owner_password') : $this->input->post('buyer_password') ;
				$valid_fields = $this->get_data_model->get_valid_user($signin_username, $user_type);
				
				$sessiondata = array(
					'user_id' => (int)$valid_fields['user_id'],
					'user_email' =>  $valid_fields['email'],
					'user_mobile' =>  $valid_fields['mobile'],
					'user_name' =>  $valid_fields['username'],
					'user_type' => $valid_fields['user_type'],
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessiondata);
				$this->session->set_flashdata('msg', 'Login successful. You logged in as '.$valid_fields['user_type']);
				redirect(base_url().'dashboard/'.$user_type);
			}
		}
	}

	function _owner_signin_rules(){
		$this->form_validation->set_rules('owner_email_mobile', ' Email / Mobile', 'trim|required|xss_clean');
		$this->form_validation->set_rules('owner_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('verify_both', 'Verify Login', 'trim|callback__verify_owner_login');
	}
	
    function _verify_owner_login() {
		$signin_username = $this->input->post('owner_email_mobile');
		$signin_password = $this->input->post('owner_password');
		$valid_fields = $this->get_data_model->get_valid_user($signin_username,'owner');
		if(is_array($valid_fields) && !empty($valid_fields)) {
			if($valid_fields['flag'] == 1) {
				$password = $this->encrypt->decode($valid_fields['nickname']);
				if($password == $signin_password) {
					return true;
				}
				else {
					$this->form_validation->set_message('_verify_owner_login', "The entered email and password doesnot match");
					return false;
				}
			}
			else if($valid_fields['flag'] == 0) {
				$this->form_validation->set_message('_verify_owner_login', "Admin have not aproved yet. You account is waiting for admin aproval.");
				return false;
			}
			else if($valid_fields['flag'] == 2) {
				$this->form_validation->set_message('_verify_owner_login', "Admin Have blocked your account. please contact admin.");
				return false;				
			}
		}
		else {	
			$this->form_validation->set_message('_verify_owner_login', "The entered email / mobile not registed with us. please signup if you are new customer.");
			return false;
		}
	}

	function _buyer_signin_rules(){
		$this->form_validation->set_rules('buyer_email_mobile', ' Email / Mobile', 'trim|required|xss_clean');
		$this->form_validation->set_rules('buyer_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('verify_both', 'Verify Login', 'trim|callback__verify_buyer_login');
	}

    function _verify_buyer_login() {
		$signin_username = $this->input->post('buyer_email_mobile');
		$signin_password = $this->input->post('buyer_password');
		$valid_fields = $this->get_data_model->get_valid_user($signin_username,'buyer');
		//print_r($valid_fields);
		if(is_array($valid_fields) && !empty($valid_fields)) {
			if($valid_fields['flag'] == 1) {
				$password = $this->encrypt->decode($valid_fields['nickname']);
				if($password == $signin_password) {
					return true;
				}
				else {
					$this->form_validation->set_message('_verify_buyer_login', "The entered email and password doesnot match");
					return false;
				}
			}
			else if($valid_fields['flag'] == 0) {
				$this->form_validation->set_message('_verify_buyer_login', "Admin have not aproved yet. You account is waiting for admin aproval.");
				return false;
			}
			else if($valid_fields['flag'] == 2) {
				$this->form_validation->set_message('_verify_buyer_login', "Admin Have blocked your account. please contact admin.");
				return false;				
			}
		}
		else {	
			$this->form_validation->set_message('_verify_buyer_login', " buyer The entered email / mobile not registed with us. please signup if you are new customer.");
			return false;
		}
	}

	/*
	*
	* Send password to registered email and allow user to login with that password.
	*
	*/
	function forgot() {
		$this->layouts->set_title('Orgbitor Account');
		$this->layouts->set_description('Reset Password');
		$data =array();
		$this->form_validation->set_rules('forgot_email', 'Signin Email / Mobile', 'trim|required|xss_clean|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->layouts->view('account/forgot_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
		}
		else
		{

			$signin_username = $this->input->post('forgot_email');
			$user_type = $this->input->post('user_type');
			$valid_fields = $this->get_data_model->get_valid_user($signin_username,$user_type);
			if(!empty($valid_fields) && is_array($valid_fields)) {
				$password = $this->get_data_model->get_user_password($signin_username, $user_type);
				$password = $this->encrypt->decode($password);
				$is_mail_sent = send_password_mail($signin_username,$user_type,$password) ;

		        		log_message('error', print_r($is_mail_sent,TRUE));
				$this->session->set_flashdata('msg', 'We have sent password to provided email id, Login and reset  password.');
				redirect(base_url().'account/signin','refresh');
			
			}
			else {
				$data['err_msg'] = "Email id not registered with us";
				$this->layouts->view('account/forgot_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
		}
	}

	/*
	* Logout and redirect to home.
	*/
  	function logout() {  		
		$sessiondata = array(
						'user_id' => '',
						'user_email' =>  '',
						'user_mobile' =>  '',
						'user_name' =>  '',
						'user_type' => '',
						'logged_in' => FALSE
				        );
		
	    $this->session->unset_userdata($sessiondata);
	  	redirect('/', 'refresh');	  	
	}

	function _verify_old_pass() {
		$entered_old_pass = $this->input->post('old_pass');
		$user_email = $this->session->userdata('user_email');
		$valid_fields = $this->get_data_model->get_valid_user($user_email);
		if(is_array($valid_fields)) {
			if(isset($valid_fields['nickname'])) {
				$password = $this->encrypt->decode($valid_fields['nickname']);
				if ($password == $entered_old_pass) {
					return true;
				}
				else {
				$this->form_validation->set_message('_verify_old_pass', "Entered Old password is wrong");
				return false;
				}
			}
		}
		else {
			$this->form_validation->set_message('_verify_old_pass', "Entered Old password is wrong");
			return false;		
		}
	}
	function token($token_id = 0) {
		if (isset($_GET['email']) && isset($_GET['token_id']) && isset($_GET['type']) == 'subscribe') {
			$subscribe_token_array = $this->get_data_model->get_subscribe_token_values($_GET['email'], $_GET['token_id']);
			if(!empty($subscribe_token_array) && is_array($subscribe_token_array) && ($subscribe_token_array['flag'] != 1)) {
				$is_flag_updated = $this->save_update_model->update_flag('subscriptions', 1);
				if($is_flag_updated) {
					$this->session->set_flashdata('msg', 'Thanks for confirming your subscription!. To get more notification or alerts you can signup below');
					redirect(base_url().'account/signup','refresh');					
				}
			}
			else {
				$this->session->set_flashdata('errormsg', 'Could not able to subscribe. already you may subscribed or token got expired. To get notification or alerts you can signup below.');
				redirect(base_url().'account/signup','refresh');
			}
		}
		elseif(isset($_GET['email']) && isset($_GET['token_id'])) { //active link after signup
			$token_user_array = $this->get_data_model->get_token_values($_GET['email'], $_GET['token_id']);
			if(is_array($token_user_array)) {
				if($token_user_array['flag'] == 1) {
					$this->session->set_flashdata('msg', 'Your account already activated. you can login with the credentials');
					redirect(base_url().'account/signin','refresh');
				}
				else {
					//update the flag and 
					$token_array = array('email' => $_GET['email'], 'token' => $_GET['token_id']);
					$is_flag_updated = $this->save_update_model->update_activation_log($token_array);
					if($is_flag_updated) {
						$user_array_log = json_encode(array($_GET['email'], $_GET['token_id']));
		        		log_message('error',  "INFO: Account activated".$user_array_log);
						$this->session->set_flashdata('msg', 'Your account activated. you can login with the credentials');
						//fix me auto fill email.
						redirect(base_url().'account/signin','refresh');
					}
					else {						
						$this->session->set_flashdata('errormsg', 'Couldnot able to activate your account please try again');
						redirect(base_url().'account/signin','refresh');
					}
				}
			}
			else {
				$this->session->set_flashdata('errormsg', 'Email and token values are not matching');
				redirect(base_url().'account/signin','refresh');
			}
		}
		else 
		{
			$this->session->set_flashdata('errormsg', 'The url is broken');
			redirect(base_url(),'refresh');
		}
	}

	function _verify_login() {
		$signin_username = $this->input->post('email_mobile');
		$signin_password = $this->input->post('password');
		$valid_fields = $this->get_data_model->get_valid_user($signin_username);
		if(is_array($valid_fields) && !empty($valid_fields)) {
			if($valid_fields['flag'] == 1) {
				$password = $this->encrypt->decode($valid_fields['nickname']);
				if($password == $signin_password) {
					return true;
				}
				else {
					$this->form_validation->set_message('_verify_login', "The entered email and password doesnot match");
					return false;
				}
			}
			else if($valid_fields['flag'] == 0) {
				$this->form_validation->set_message('_verify_login', "Admin have not aproved yet. You account is waiting for admin aproval.");
				return false;
			}
			else if($valid_fields['flag'] == 2) {
				$this->form_validation->set_message('_verify_login', "Admin Have blocked your account. please contact admin.");
				return false;				
			}
		}
		else if(!empty($signin_username) && !empty($signin_password)) {	
			$this->form_validation->set_message('_verify_login', "The entered email / mobile not registed with us. please signup if you are new customer.");
			return false;
		}
	}

	function reset($token_id = 0)  {
		$data = array();
		if(isset($_GET['email_id']) && isset($_GET['token_id'])) {

			$token_user_array = $this->get_data_model->get_reset_token_values($_GET['email_id'], $_GET['token_id']);
			if(is_array($token_user_array) && !empty($token_user_array)) {

				$data['email_id'] = (isset($_GET['email_id']) && !empty($_GET['email_id'])) ? $_GET['email_id'] : '' ;
				$data['token_id'] = (isset($_GET['token_id']) && !empty($_GET['token_id'])) ? $_GET['token_id'] : '';

				$this->form_validation->set_rules('reset_new_pwd', 'New Password', 'trim|required|min_length[6]|xss_clean');
				$this->form_validation->set_rules('match_reset_new_pwd', 'Confirm password', 'trim|required|matches[reset_new_pwd]|xss_clean');

				if ($this->form_validation->run() == FALSE)
				{
					$this->layouts->view('account/password_reset_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
				}
				else
				{
					$password = $this->encrypt->encode($this->input->post('reset_new_pwd'));
					$reset_array  = array('email' => $token_user_array['user_email'],'nickname' => $password);
					$is_updated = $this->save_update_model->update_password($reset_array);
					if ($is_updated) {
						$reset_array_log = json_encode(array($_GET['email_id'], $_GET['token_id']));
        				log_message('error',  "INFO: Password reset done".$reset_array_log);
						$this->session->set_flashdata('msg', 'Password reset done successfully. login with the proper credentials');
						redirect('account/signin','refresh');
					}
					else {
						$this->session->set_flashdata('errormsg', 'Something went wrong Couldnot able to reset password');
						redirect(base_url().'account/signin','refresh');
					}
				}
			}
			else {
				$this->session->set_flashdata('errormsg', 'Not valid token please try again');
				redirect(base_url().'account/forgot','refresh');
			}
		}
		else 
		{
			redirect(base_url(),'refresh');

		}		
	}

	function _custom_email_unique() {
		//checking whether mobile number and only exist in this users mobile field.
		$entered_email = $this->input->post('email');
		$is_email_id_exist_but_not_active = $this->get_data_model->check_is_email_unique($entered_email);

		if($is_email_id_exist_but_not_active) {
			$this->form_validation->set_message('_custom_email_unique', "User already exist Please try different email.");
			return false;
		}
		else {
			//$this->form_validation->set_message('_custom_email_unique', $this->input->post('email'));
			return true;
		}
	}
}