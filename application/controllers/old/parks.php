<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Parks extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
		$this->load->library('pagination');
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		$data = array();
		is_authenticated_user(array('admin','owner'));
		$owner_id = $this->session->userdata('user_id');
		$data['parks']['new'] = $this->get_data_model->get_owner_park_details($owner_id,0);
		$data['parks']['active'] = $this->get_data_model->get_owner_park_details($owner_id,1);
		$data['parks']['blocked'] = $this->get_data_model->get_owner_park_details($owner_id,2);
		if ($this->form_validation->run() == FALSE) {	
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Business Parks' => base_url()."parks", 'All Business Parks' => ''));

			$this->layouts->view('parks/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}
    function admin(){

         $this->layouts->set_title('Media Basket');
		 $this->layouts->set_description('This is just a test description.');
		 is_authenticated_user(array('admin'));
		 $data = array();
		 $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Business Parks' => base_url()."parks", 'All Business Parks' => ''));		
		 $data['parks']['new'] = $this->get_data_model->get_park_details(0,0);
		 $data['parks']['active'] = $this->get_data_model->get_park_details(0,1);
		 $data['parks']['blocked'] = $this->get_data_model->get_park_details(0,2);
		$data['recomanded']['park'] = $this->get_data_model->recommanded_parks();
		
		 if($this->form_validation->run() == FALSE) {

			$this->layouts->view('admin/park_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		 }
		 else {
			$this->layouts->view('admin/park_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		  }

    }

	function add() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		$this->_add_set_rules();
		$data = array();
		if ($this->form_validation->run() == FALSE) {	
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Business Parks' => base_url()."parks", 'Add Business Parks' => ''));		
			$this->layouts->view('parks/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
				$user_id = $this->session->userdata('user_id');
					$user_name = $this->session->userdata('user_name');
			$user_type = $this->session->userdata('user_type');
			$data = $this->input->post();
			$user_id = $this->session->userdata('user_id');
			$inputs_array = array('park_name' => $data['park_name'], 
									  'park_desc' => $data['park_desc'],
									  'park_location' => $data['map_lat'].", ".$data['map_lang'],
									  'park_image' => $this->filedata['file_name'],
									  'employee_strenght'=> $data['emp_strenght'], 
									  'park_cityname' => $data['city_name'], //Fix 
									  'park_location_name' => $data['park_loc'], //Fix 
									  'park_area' => $data['park_area'],
									  'key_companies' => $data['key_company'],
									  'created_by' => $user_id, //Fix 
									  'owner_id' => $user_id//Fix 
									  );
			$inserted_park_id = $this->save_update_model->save_park($inputs_array);
			$media_type='park';
			$city_area_update = $this->save_update_model->save_city_area_details($data['city_name'],$data['park_area'],$media_type);
			if($inserted_park_id) {
				$this->session->set_flashdata('msg', "New Business Park created successfully..");
				$action_type='new';
				send_admin_grid_mails(ADMIN_EMAIL,$type='parks',$action_type,$user_name,$user_id,$user_type,$inserted_park_id);
				redirect(base_url().'dashboard/'.$user_type,'refresh');			
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				redirect(base_url().'parks/add','refresh');
			}			
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function edit($park_id = 0) {
		
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		$data = array();
		if($park_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['park_id'] = $park_id;
			$data['posted_data'] = $this->input->post();
			$data['park_details'] = $this->get_data_model->get_park_details($park_id,0);
			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Business Parks' => base_url()."parks", 'Edit Business Parks' => ''));
				$this->layouts->view('parks/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				//Save and redirect..
			$user_id = $this->session->userdata('user_id');
			$user_type = $this->session->userdata('user_type');
				
				$inputs_array = array('park_name' => $data['posted_data']['park_name'], 
									  'park_desc' => $data['posted_data']['park_desc'],
									  'park_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'park_cityname' => $data['posted_data']['city_name'], //Fix 
									  'park_location_name' => $data['posted_data']['park_loc'], //Fix 
									  'park_area'=> $data['posted_data']['park_area'],
									  'key_companies' => $data['posted_data']['key_company'],
									  'created_by' =>$user_id, //Fix 
									  'owner_id' => $user_id,
									  'park_id' => $park_id //Fix 
									  );

				if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['park_image'] = $this->filedata['file_name'];
				}
				$is_update_successful = $this->save_update_model->update_parks($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Business Park Details updated successfully");
					redirect(base_url().'dashboard/'.$user_type,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}


	function show($park_id = 0) { //6 have result.
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		if($park_id != 0 && is_numeric($park_id)) {
			    $data['result2'] = $this->get_data_model->get_media_details('park',$park_id,1);
			    $data['park_id'] = $park_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'parks/show/'.$park_id.'/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=4;
				$config['per_page'] = 9;
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				
			    $limit=$config['per_page'];
                $offset=$this->uri->segment(4);
			    $data['result'] = $this->get_data_model->get_media_details('park',$park_id,1,$limit,$offset);
			    if($logged_in && $user_type == 'buyer') {
			    	$buyer_id = $this->session->userdata('user_id');
			    	$data['saved_ads'] = $this->get_data_model->get_saved_parks($buyer_id,$park_id);
			    }
			    $data['result']['terms'] = $this->get_data_model->get_terms_and_cond('park');

				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			//echo "<pre>";
			//print_r($data);
			//echo "</pre>";
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Business Parks' => base_url()."parks", 'Show Business Parks' => ''));
			$this->layouts->view('parks/show_park_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	

			
		}
	}
	else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function view($park_id = 0) { //6 have result.
		if($park_id != 0 && is_numeric($park_id)) {
			    $data['result2'] = $this->get_data_model->get_media_details('park',$park_id,1);
			    $data['park_id'] = $park_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'parks/view/'.$park_id.'/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=4;
				$config['per_page'] = 8;
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
			    $limit=$config['per_page'];
                $offset=$this->uri->segment(4);
			    $data['result'] = $this->get_data_model->get_media_details('park',$park_id,1,$limit,$offset);
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Business Parks' => base_url()."parks", 'Show Business Parks' => ''));
			$this->layouts->view('parks/park_option_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	

			
		}
	}


	
function change_parks_status($park_id ,$flag,$table_name='business_park') {
	  $user_type = $this->session->userdata('user_type');

		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_parks_status($park_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Park '.$str.' successfully. ');
				redirect(base_url().'parks/admin','refresh');
			 }

            elseif($is_updated && $flag == 2  ) {

            	if($user_type =='admin'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				redirect(base_url().'parks/admin','refresh');
			    }
			    elseif($user_type =='owner'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				redirect(base_url().'parks','refresh');
			    }


              }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'parks/admin','refresh');
		

	}

function delete_parks($park_id ,$flag,$table_name='business_park') {
	    $user_type = $this->session->userdata('user_type');
       
		//flag => 1 - activate, 2 - block, 3 - delete .
		 if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_parks($park_id,$flag,$table_name);

			
			  if($is_deleted  ) {

               if($user_type =='admin'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Park '.$str.' successfully. ');
				redirect(base_url().'parks/admin','refresh');
			  }  
			  elseif($user_type =='owner'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Park '.$str.' successfully. ');
				redirect(base_url().'parks','refresh');
			   }     
   

             }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			 }
			//redirect(base_url().'apartments','refresh');
		

           }
  }

	function _add_set_rules() {
		$this->form_validation->set_rules('park_name', 'Business Park Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('park_desc', 'Business Park Description', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Business Park Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
		$this->form_validation->set_rules('park_loc', 'Business Park Location', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('emp_strenght', 'Employee Strenght', 'trim|xss_clean|required');
		$this->form_validation->set_rules('key_company', 'Key Company', 'trim|xss_clean|required');
		$this->form_validation->set_rules('city_name', 'City Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('park_area', 'Park Area', 'trim|xss_clean|required');
		/*
		$this->form_validation->set_rules('layout_img', 'Apartment Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'Apartment Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('park_name', 'Park Name', 'trim|required|min_length[3]|xss_clean');
		
		if (!empty($_FILES['userfile']['name'])) {
		$this->form_validation->set_rules('userfile', 'Buisness Park Image', 'trim|xss_clean|callback__verify_uploading_file_and_upload');
	     }
        
	}


   function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/parks';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = $this->upload->display_errors();
			$this->form_validation->set_message('_verify_uploading_file_and_upload', $error);
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
