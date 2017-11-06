<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$this->layouts->set_breadcrumb_array(array('Home' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Manage Users' => ''));
		$data = array();
		$data['owner']['new']=$this->get_data_model->get_user_details('owner_details',0,'owner',0);
		$data['owner']['active']=$this->get_data_model->get_user_details('owner_details',0,'owner',1);
		$data['owner']['blocked']= $this->get_data_model->get_user_details('owner_details',0,'owner',2);
		$data['buyer']['new']= $this->get_data_model->get_user_details('buyer_details',0,'buyer',0);
		$data['buyer']['active']=$this->get_data_model->get_user_details('buyer_details',0,'buyer',1);
		$data['buyer']['blocked']= $this->get_data_model->get_user_details('buyer_details',0,'buyer',2);
		//print_r($data);
		if($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Users' => base_url()."users", 'All Users' => ''));
			$this->layouts->view('users/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('users/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}
	}
	function show($user_id,$user_type) { //7 have result.
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('Home' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Manage Users' => ''));
		if($user_id != 0 && is_numeric($user_id)) {
			if($user_type=="buyer"){
			$table="buyer_details";
		}
		 else{
			$table="owner_details";
		 }
			
			$data['result'] = $this->get_data_model->get_user_details($table,$user_id,$user_type);
			//print_r($data['result']['primary'] );
			//$to_email=$data['result']->email;
			//print_r($to_email);
			$this->layouts->view('users/show_users_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		
		}
	}
	
	function change_users_status($user_id ,$flag,$user_type) {
		is_authenticated_user(array('admin','owner','buyer'));
          if($user_type=="buyer"){
			$table="buyer_details";
		}
		 else{
			$table="owner_details";
		 }
		  
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {
			$is_updated = $this->save_update_model->change_users_status($user_id,$flag,$table,$user_type);

			if($is_updated && $flag == 1  ) {
				
				//send_grid_mails($to_email,$text,$sub) ;
				
				$str =  "Activated";
				$user_email = $this->get_data_model->get_user_email($user_id,$user_type);
				$is_mail_sent = send_grid_mails($user_email,'approve',$user_type);
				if($is_mail_sent) {					
					log_message('error', print_r($is_mail_sent,TRUE));
				}
				else {
					log_message('error', print_r($is_mail_sent,TRUE));
				}
				$this->session->set_flashdata('msg', ucfirst($user_type).' '.$str.' successfully. ');
				redirect(base_url().'users','refresh');
			}

            elseif($is_updated && $flag == 2  ) {
            	$str =  "Blocked";
            	$user_email = $this->get_data_model->get_user_email($user_id,$user_type);
				$is_mail_sent = send_grid_mails($user_email,'Blocked',$user_type);
				if($is_mail_sent) {					
					log_message('error', print_r($is_mail_sent,TRUE));
				}
				else {
					log_message('error', print_r($is_mail_sent,TRUE));
				}
				$this->session->set_flashdata('msg', ucfirst($user_type).' '.$str.' successfully. ');
				redirect(base_url().'users','refresh');
            }
       }

		else{
			$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
		}
		redirect(base_url().'users','refresh');
		

	}
	function profile(){
		is_authenticated_user(array('admin','buyer','owner'));
		$user_id = $this->session->userdata('user_id');
		$user_type = $this->session->userdata('user_type');
		if($user_type=="buyer"){
			$table="buyer_details";
		}
		else{
			$table="owner_details";
		}
		$data['result'] = $this->get_data_model->get_user_profile_details($table,$user_id);
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Profile' =>  ''));
		$this->layouts->view('users/show_profile', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}

	function edit($user_id = 0) {
		is_authenticated_user(array('admin','owner','buyer'));
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($user_id == 0) {
			//Check whether he logged in.
			$full_url = redirect(base_url().'dashboard/'.$this->session->userdata('user_type'));
			redirect($full_url,'refresh');
		}
		else {
            $this->_edit_set_rules();
			$data['user_id'] = $user_id;
			$data['posted_data'] = $this->input->post();
			$user_type = $this->session->userdata('user_type');
			if($user_type=="buyer"){
				$table="buyer_details";
			}
			else{
				$table="owner_details";
			}
			$data['result'] = $this->get_data_model->get_user_profile_details($table,$user_id);
            //print_r($data);
			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Profile' => base_url()."users/profile", 'Edit Profile' => ''));
				$this->layouts->view('users/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				
				$inputs_array = array('username'=>$data['posted_data']['username'],
				                      'fullname'=>$data['posted_data']['fullname'],
									  'mobile' => $data['posted_data']['mobile'], 
									  'user_id' =>$data['user_id'] ,
									  );
									  //print_r($inputs_array);
						if($user_type=="buyer"){
							$table="buyer_details";
						}
						else{
							$table="owner_details";
						}			  
				$is_update_successful = $this->save_update_model->update_user($table,$inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', ucfirst($user_type)."Details updated successfully");
					redirect(base_url().'dashboard','refresh');
				}
				else {
					redirect('users/edit');
				}
			}
		}
	}
	
	function change_password($user_id=0){
		is_authenticated_user(array('admin','owner','buyer'));
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($user_id == 0) {
			//Check whether he logged in.
			$full_url = redirect(base_url().'dashboard/'.$this->session->userdata('user_type'));
			redirect($full_url,'refresh');
		}
		else {
            $this->_change_set_rules();
			$data['user_id'] = $user_id;
			$data['posted_data'] = $this->input->post();
			$user_type = $this->session->userdata('user_type');
			if($user_type=="buyer"){
				$table="buyer_details";
			}
			else{
				$table="owner_details";
			}
			//$data['result'] = $this->get_data_model->get_user_profile_details($table,$user_id);
            //print_r($data);
			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Profile' => base_url()."users/profile", 'Change Password' => ''));
				$this->layouts->view('users/change_password_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				
				$inputs_array = array(
									  'user_id' =>$data['user_id'] ,
									  'nickname'=>$this->encrypt->encode($data['posted_data']['password']),
									  );
									  //print_r($inputs_array);
								  
				$is_update_successful = $this->save_update_model->update_user($table,$inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', ucfirst($user_type)."Details updated successfully");
					redirect(base_url().'dashboard','refresh');
				}
				else {
					redirect('users/change_password');
				}
			}
		}
	}
	
	function delete_users($user_id,$flag,$user_type) {
		//flag => 1 - activate, 2 - block, 3 - delete .
		is_authenticated_user(array('admin'));
		if($user_type=="buyer"){
			$table="buyer_details";
		}
		 else{
			$table="owner_details";
		 }
		if($flag == 3) {
			$user_email = $this->get_data_model->get_user_email($user_id,$user_type);
			
			$is_deleted = $this->save_update_model->delete_users($user_id,$flag,$table);
			if($is_deleted  ) {
				$str =  "Deleted";
				$is_mail_sent = send_grid_mails($user_email,'Deleted',$user_type);
				if($is_mail_sent) {					
					log_message('error', print_r($is_mail_sent,TRUE));
				}
				else {
					log_message('error', print_r($is_mail_sent,TRUE));
				}
				$this->session->set_flashdata('msg', ucfirst($user_type).' '.$str.' successfully. ');
				redirect(base_url().'users','refresh');
			}     

       }
			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'users','refresh');
	}
	
	function _edit_set_rules() {
		$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('mobile', 'Mobile number', 'trim|xss_clean|required');
		
		
	
	}
	function _change_set_rules() {
	    $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		}
}