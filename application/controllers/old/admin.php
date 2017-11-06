<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {


	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
    	
	}

	function index() {
		redirect('admin/signin','refresh');
	}
	
	
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
			if($user_type == 'admin') {
				$this->_admin_signin_rules();
			}
			

			if ($this->form_validation->run() == FALSE)
			{
				$this->layouts->view('account/admin_signin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}
			else
			
			{
                    if($user_type == 'admin')

                    {
                       $signin_username = $this->input->post('admin_email_mobile');
                       $signin_password = $this->input->post('admin_password');
                    }
				
			
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

	function _admin_signin_rules(){
		$this->form_validation->set_rules('admin_email_mobile', ' Email / Mobile', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('verify_both', 'Verify Login', 'trim|callback__verify_admin_login');
	}

   function _verify_admin_login() {
		$signin_username = $this->input->post('admin_email_mobile');
		$signin_password = $this->input->post('admin_password');
		$valid_fields = $this->get_data_model->get_valid_user($signin_username,'admin');
		
		if(is_array($valid_fields) && !empty($valid_fields)) {
			
				$password =  $valid_fields['nickname'];
				if($password == $signin_password) {
					return true;
				}
				else {
					$this->form_validation->set_message('_verify_admin_login', "The entered email and password doesnot match");
					return false;
				}
			
			
		}
		else {	
			$this->form_validation->set_message('_verify_admin_login', "The entered email / mobile not registed with us. please signup if you are new customer.");
			return false;
		}
	}


}




/* $signin_username = $this->input->post('admin_email_mobile');
     $signin_password = $this->input->post('admin_password');


$this->form_validation->set_rules('admin_email_mobile', ' Email / Mobile', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('verify_both', 'Verify Login', 'trim|callback__verify_admin_login');


if ($this->form_validation->run() == FALSE)
			{
				$this->layouts->view('account/admin_signin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
			}

  else
			
			{
                  
			
			  $valid_fields = $this->get_data_model->get_valid_admin_user($email_or_mobile);
				
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

*/
