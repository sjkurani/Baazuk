<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apartment_ads extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$data = array();
		is_authenticated_user(array('owner','admin'));
		$owner_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        if($user_type=="admin"){
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments Ads' => base_url()."apartment_ads", 'All Apartments Ads' => ''));
		$data['apartment_ads']['new']= $this->get_data_model->get_apartment_ads_details(0,0);
		$data['apartment_ads']['active']= $this->get_data_model->get_apartment_ads_details(0,1);
		$data['apartment_ads']['blocked']= $this->get_data_model->get_apartment_ads_details(0,2);
		}
		else
		{
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments Ads' => base_url()."apartment_ads", 'All Apartments Ads' => ''));
		$data['apartment_ads']['new']= $this->get_data_model->get_owner_apartment_ads_details($owner_id,0);
		$data['apartment_ads']['active']= $this->get_data_model->get_owner_apartment_ads_details($owner_id,1);
		$data['apartment_ads']['blocked']= $this->get_data_model->get_owner_apartment_ads_details($owner_id,2);
		/*$data['apartment_ads']['all']= $this->get_data_model->get_owner_apartment_ads_details(0,2);*/
		}
		if($this->form_validation->run() == FALSE) {
			$this->layouts->view('apartment_ads/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('apartment_ads/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}
	}

	function add($apartment_add_id = 0) {

		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
        $owner_id=$this->session->userdata('user_id');
		$this->_add_set_rules();

		$data = array();
		$data['apartment_add_id'] = $apartment_add_id;
		$data['apartment']['list']=$this->get_data_model->get_owner_apartment_details($owner_id,1);
		//print_r($data['apartment']['list']);
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments Ads' => base_url()."apartment_ads", 'Add Apartments Ads' => ''));
			$this->layouts->view('apartment_ads/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			
		      if($this->input->post('next_avail_date')!="")
			{
				$next_date=	explode("-",$this->input->post('next_avail_date'));
			
				$time = date("H:i:s", strtotime($next_date[1]));
				$next_avail_date = date("Y-m-d", strtotime(str_replace('/', '.', $next_date[0] )));
				$avail_date=$next_avail_date." ".$time;
			}
			else
			{	
			  $avail_date=date('Y-m-d H:i:s');
			}
			//print_r($data);
			$inputs_array = array('ad_title' => $data['ad_name'], 
									  'ad_desc' => $data['ad_desc'],
									  'ap_id' => $data['ap_id'], 
									  'price' => $data['ad_price'], 
									  'price_setting' => $data['price_setting'], 
									  'availability_flag' => $data['availability_flag'],
									  'next_avail_date'=>$avail_date,
									  'ref_image' => $this->filedata['file_name'],
									  'owner_id' => $owner_id//Fix 
									  );
			$inserted_ad_id = $this->save_update_model->save_apartment_ads($inputs_array);
			if($inserted_ad_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
			    redirect(base_url().'apartment_ads/','refresh');			
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'apartment_ads/','refresh');
			}
			
		}
	}

	function edit($ad_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($ad_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$user_id=$this->session->userdata('user_id');
			$data['ad_id'] = $ad_id;
			$data['posted_data'] = $this->input->post();
			$data['ad_details'] = $this->get_data_model->get_apartment_ads_details($ad_id,0);
			$owner_id=$data['ad_details']->owner_id;
            $data['apartment']['list']=$this->get_data_model->get_owner_apartment_details($user_id,1);
			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments Ads' => base_url()."apartment_ads", 'Edit Apartments Ads' => ''));
				$this->layouts->view('apartment_ads/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				 if($data['posted_data']['next_avail_date']!="")
			{
				$next_date=	explode("-",$data['posted_data']['next_avail_date']);
			
			    $time = date("H:i:s", strtotime($next_date[1]));
				$next_avail_date = date("Y-m-d", strtotime(str_replace('/', '.', $next_date[0] )));
			
				$avail_date=$next_avail_date." ".$time;
			}
			else{
				$avail_date=date('Y-m-d H:i:s');
			}
				// print_r($data['posted_data']);
				 //Save and redirect..
				 $inputs_array = array('ad_title' => $data['posted_data']['ad_name'], 
				                      'price' => $data['posted_data']['ad_price'],
									  'ap_id' => $data['posted_data']['ap_id'], 
									  'ad_desc' => $data['posted_data']['ad_desc'],
									  'price_setting' => $data['posted_data']['price_setting'], 
									  'availability_flag' => $data['posted_data']['availability_flag'],					  
									  'next_avail_date' => $avail_date, 								  
									  'owner_id' => $owner_id,
									  'ad_id' => $ad_id //Fix 
									  );

                 if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['ref_image'] = $this->filedata['file_name'];
				}

				$is_update_successful = $this->save_update_model->update_apartment_ads($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Options Details updated successfully");
					$full_url = redirect_dashboard_url('apartment_ads');
					redirect($full_url,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}
		function change_apartment_ads_status($ad_id ,$flag,$table_name='apartment_ads') {

		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_apartment_ads_status($ad_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Apartment Ads '.$str.' successfully. ');
				redirect(base_url().'apartment_ads','refresh');
			}

            elseif($is_updated && $flag == 2  ) {
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Apartment Ads '.$str.' successfully. ');
				redirect(base_url().'apartment_ads','refresh');


            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'apartment_ads','refresh');
		

	}


	function delete_apartment_ads($ad_id,$flag,$table_name='apartment_ads') {
       
      
		
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_apartment_ads($ad_id,$flag,$table_name);


			
			if($is_deleted  ) {
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Apartment Ad'.$str.' successfully. ');
				redirect(base_url().'apartment_ads','refresh');
			}     

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'apartment_ads','refresh');
		

	}




	function _add_set_rules() {
		$this->form_validation->set_rules('ad_name', 'Option Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('ad_price', 'Option Price', 'numeric|xss_clean|required');
		$this->form_validation->set_rules('ad_desc', 'Option Description', 'trim|min_length[10]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Option Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
/*
		if (!empty($_FILES['apartment_img']['name'])) {
		    $this->form_validation->set_rules('apartment_img', 'Apartment Image', 'required|callback__verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('ad_name', 'Option Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('ad_price', 'Option Price', 'numeric|xss_clean|required');
		$this->form_validation->set_rules('ad_desc', 'Option Description', 'trim|min_length[10]|xss_clean|required');
		if (!empty($_FILES['userfile']['name'])) {
		$this->form_validation->set_rules('userfile', 'Option Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
	}

	}

	function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/apartment_ads';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = $this->upload->display_errors();
			$this->form_validation->set_message('_verify_uploading_file_and_upload',$error);
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->filedata = $data['upload_data'];
			return true;
		}
	}
}