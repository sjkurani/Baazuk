<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiries extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Apartment Enquiries' => ''));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		$data['enquiry_list']['apartment'] = $this->get_data_model->get_apartment_enquiries($user_id,$user_type);

		foreach ($data['enquiry_list']['apartment'] as $key => $value) {
        $closedstats=($data['enquiry_list']['apartment'][$key]->flag);  
		if($closedstats==3)
		{
			$buyer_id=($data['enquiry_list']['apartment'][$key]->buyer_id);
			$user_email = $this->get_data_model->get_user_enquery_email('buyer_id');	
			$user_name=$data['enquiry_list']['apartment'][$key]->user_name;
			$ad_type=$data['enquiry_list']['apartment'][$key]->ad_type;

		//$is_mail_sent = send_save_grid_mails($user_email,'closed',$ad_type,$user_name);
		}
		
		}
		
		$this->layouts->view('enquiry/apartment_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	
	function events() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Event Enquiries'=>''));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		
		$data['enquiry_list']['events'] = $this->get_data_model->get_event_enquiries($user_id,$user_type);
	
		
		$this->layouts->view('enquiry/event_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	
	function radios() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Radio Enquiries'=>''));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		
		$data['enquiry_list']['radios'] = $this->get_data_model->get_radio_enquiries($user_id,$user_type);
		
		$this->layouts->view('enquiry/radio_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	function malls() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Malls Enquiries'=>''));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		
		$data['enquiry_list']['malls'] = $this->get_data_model->get_mall_enquiries($user_id,$user_type);
		
		$this->layouts->view('enquiry/mall_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	function parks() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Business Park Enquiries'=>''));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		
		$data['enquiry_list']['parks'] = $this->get_data_model->get_park_enquiries($user_id,$user_type);
		
		$this->layouts->view('enquiry/park_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	function hoardings() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner','buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Hoarding Enquiries'=>''));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		$data['enquiry_list']['hoardings'] = $this->get_data_model->get_hoarding_enquiries($user_id,$user_type);
		
		$this->layouts->view('enquiry/hoarding_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	
	
	
	
	function owner() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner'));
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		$data['enquiry_list']['apartment'] = $this->get_data_model->get_apartment_enquiries($user_id,$user_type);
		
		/*$data['enquiry_list']['apartment'] = $this->get_data_model->get_enquiries($user_id,$user_type,'apartment_ads');
		$data['enquiry_list']['apartment'] = $this->get_data_model->get_enquiries($user_id,$user_type,'apartment_ads');
		$data['enquiry_list']['apartment'] = $this->get_data_model->get_enquiries($user_id,$user_type,'apartment_ads');
		$data['enquiry_list']['apartment'] = $this->get_data_model->get_enquiries($user_id,$user_type,'apartment_ads');
		$data['enquiry_list']['apartment'] = $this->get_data_model->get_enquiries($user_id,$user_type,'apartment_ads');*/

		$this->layouts->view('enquiry/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		
	}

	function send($ad_id = 0, $media_type = '', $id) {
		if($ad_id == 0 || $media_type == '') {
		}
		else {
			$data = array();
			$data['posted_data'] = array(
										"media_type" => $media_type,
										"ad_id" => $ad_id,
										"id" => $id);
			$data['db_data'] = $this->get_data_model->get_enquiry_send_data($ad_id,$media_type);
			$this->layouts->set_title('Media Basket');
			$this->layouts->set_description('This is just a test description.');
			$this->layouts->view('enquiry/enquiry_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}

	}
	function save() {
		$is_inserted = $this->save_update_model->save_enquiry($this->input->post());

			$user_type = $this->input->post('ad_type');
			
			$user_id = $this->input->post('buyer_id');
			$user_name = $this->session->userdata('user_name');
			$user_email = $this->get_data_model->get_user_enquery_email('user_id');			
		if($is_inserted) {
					$str =  "saved";
					$is_mail_sent = send_save_grid_mails(ADMIN_EMAIL,'enquiry',$ad_type,$user_name);
					if($is_mail_sent) {					
					log_message('error', print_r($is_mail_sent,TRUE));
					}
					else {
					log_message('error', print_r($is_mail_sent,TRUE));
					}
			$this->session->set_flashdata('msg', "Enquiry Sent successfully.");
			redirect(base_url().'dashboard/'.$session_user_type);
		}
		else {
			$this->session->set_flashdata('errormsg', "Something went wrong please contact admmin.");
			redirect(base_url().'dashboard/'.$session_user_type);
		}
	}
	function review() {
		$data = $this->input->post();		
		$remarks=$data['remarks'];			
		$input_array = array(
						'enquiry_id' => $data['enquiry_id'],
						'remarks' =>trim($data['remarks']),
						'flag' =>  $data['status']);
		
		
			
		$is_updated = $this->save_update_model->save_enquiry_review($input_array);
	

		if($is_updated) {
			$closedstats = $data['status'];
			if($closedstats==3)
			{
				$buyer_id=($data['enquiry_list']['apartment'][$key]->buyer_id);
				$enquiry_and_user_details = $this->get_data_model->get_enqueryid_details($data['enquiry_id'],$buyer_id);
				$ad_type=$enquiry_and_user_details->ad_type;
				$user_name=$enquiry_and_user_details->username;
				$user_email=$enquiry_and_user_details->email;
				$full_name=$enquiry_and_user_details->fullname;
				$mobile_no=$enquiry_and_user_details->mobile;				
				$is_mail_sent = send_enquiry_close_grid_mails($user_email,'closed',$ad_type,$user_name,$mobile_no,$full_name,$remarks);

			}
			$this->session->set_flashdata('msg', "Status updated successfully with your review.");
	

		
		}
		else {
			$this->session->set_flashdata('errormsg', "Something went wrong. Please contact admin.");
		}
		redirect($this->agent->referrer());
	}

	/*
	function send()	{
      $this->_add_set_rules();
      $data = array();
		if ($this->form_validation->run() == FALSE) 
		{
			$this->layouts->view('enquiry/enquiry_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}

        else 
        {
			//Save and redirect..
			$data = $this->input->post();

			$user_id = $this->session->userdata('user_id');
			$user_type = $this->session->userdata('user_type');
			$data['apartment_id'] =  $this->uri->segment(3);
			

			$inputs_array = array(     'ad_id' => $data['apartment_id'], 
				                       'ad_type' => $data['add_type'],
				                      //'buyer_id' =>$data['buyer_id'],
				                       
				                       'buyer_id' =>$user_id,
									   'enquiry_desc' =>$data['enquiry_desc']
									  );
			
			$inserted_enquiry_id = $this->save_update_model->save_enquiry($inputs_array);

         if($inserted_enquiry_id) {
				$this->session->set_flashdata('msg', "Enquiry sent successfully..");
				redirect(base_url().'enquiry/send','refresh');			
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				redirect(base_url().'enquiry/send','refresh');
			}
			
		}


	}*/

	function approve($enquiry_id, $flag) {
		$this->save_update_model->approve_enquiries($enquiry_id,$flag);
		$this->session->set_flashdata('msg', "Approved.");
		redirect(base_url().'enquiries/');
	}


	function _add_set_rules() {
		$this->form_validation->set_rules('add_type', ' Add Type', 'trim|required');
		$this->form_validation->set_rules('enquiry_desc', ' Enquiry Description', 'trim|required');
		
	}




	
}
