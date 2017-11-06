<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Radio extends CI_Controller {
	
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
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Radios' => base_url()."radio", 'All Radios' => ''));
		$owner_id = $this->session->userdata('user_id');
		$data['radios']['new'] = $this->get_data_model->get_owner_radio_details($owner_id,0);
		$data['radios']['active'] = $this->get_data_model->get_owner_radio_details($owner_id,1);
		$data['radios']['blocked'] = $this->get_data_model->get_owner_radio_details($owner_id,2);
		
		if ($this->form_validation->run() == FALSE) {		
			$this->layouts->view('radios/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}
	else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function admin() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$data = array();
		$data['radios']['new'] = $this->get_data_model->get_radio_details(0,0);
		$data['radios']['active'] = $this->get_data_model->get_radio_details(0,1);
		$data['radios']['blocked'] = $this->get_data_model->get_radio_details(	0,2);
		$data['recomanded']['radio'] = $this->get_data_model->recommanded_radios();
		
		if($this->form_validation->run() == FALSE) {

			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Radios' => base_url()."radio", 'Admin' => ''));	
			$this->layouts->view('admin/radio_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('admin/radio_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}



}

	function add() {
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$this->_add_set_rules();
		
		$data = array();

		if ($this->form_validation->run() == FALSE) {
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Radios' => base_url()."radio", 'Add Radios' => ''));			
			$this->layouts->view('radios/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
				$user_id = $this->session->userdata('user_id');
			$user_type = $this->session->userdata('user_type');
			$user_name = $this->session->userdata('user_name');
			$data = $this->input->post();

			$user_id = $this->session->userdata('user_id');
			$inputs_array = array('radio_station_name' => $data['radio_name'], 
								  'radio_station_desc' => $data['radio_desc'],
								  'radio_station_city' => $data['city_name'], //Fix 
								  'r_image' => $this->filedata['file_name'],
								  'created_by' => $user_id, //Fix 
								  'owner_id' => $user_id//Fix 
								  );
			$inserted_radio_id = $this->save_update_model->save_radio($inputs_array);
			$media_type='radio';
			$city_area_update = $this->save_update_model->save_city_area_details($data['city_name'],$data['city_name'],$media_type);
			if($inserted_radio_id) {
				$this->session->set_flashdata('msg', "New Radio Station created successfully..");
				$action_type='new';
				send_admin_grid_mails(ADMIN_EMAIL,$type='radio',$action_type,$user_name,$user_id,$user_type,$inserted_radio_id);
				redirect(base_url().'dashboard/'.$user_type,'refresh');			
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				redirect(base_url().'radio/add','refresh');
			}
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function edit($radio_id = 0) {
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();

		if($radio_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}


		else {
			$this->_edit_set_rules();

            $data['radio_id'] = $radio_id;
			$data['posted_data'] = $this->input->post();
			$data['radio_details'] = $this->get_data_model->get_radio_details($radio_id,0);



		if ($this->form_validation->run() == FALSE) {
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Radios' => base_url()."radio", 'Edit Radios' => ''));	
			$this->layouts->view('radios/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			
				$user_id = $this->session->userdata('user_id');
				$user_type = $this->session->userdata('user_type');
	            $inputs_array = array('radio_station_name' => $data['posted_data']['radio_name'], 
									  'radio_station_city' => $data['posted_data']['city_name'],
									
									  'radio_station_desc' => $data['posted_data']['radio_desc'], //Fix 
									  'created_by' => $user_id, //Fix 
									  'owner_id' => $user_id,
									  'radio_station_id' => $radio_id //Fix 
									  );
                    if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['r_image'] = $this->filedata['file_name'];
				}

				$is_update_successful = $this->save_update_model->update_radio($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Radio Station Details updated successfully");
					redirect(base_url().'dashboard/'.$user_type,'refresh');
				}
				else {
					echo "False";
				}
            }

		}
	}
	else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}
	

	function show($radio_id = 0) { //1 have result.
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		if($radio_id != 0 && is_numeric($radio_id)) {
				$data['result2'] = $this->get_data_model->get_media_details('radio',$radio_id,1);
			    $data['radio_id'] = $radio_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'radio/show/'.$radio_id.'/';
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
			    $data['result'] = $this->get_data_model->get_media_details('radio',$radio_id,1,$limit,$offset);
			    if($logged_in && $user_type == 'buyer') {
			    	$buyer_id = $this->session->userdata('user_id');
			    	$data['saved_ads'] = $this->get_data_model->get_saved_radios($buyer_id,$radio_id);
			    }
			    $data['result']['terms'] = $this->get_data_model->get_terms_and_cond('radio');

			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			
		//	echo "<pre>";
		//	print_r($result);
		//	echo "</pre>";
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Radios' => base_url()."radio", 'Show Radios' => ''));
			$this->layouts->view('radios/show_radio_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
	}
	else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function view($radio_id = 0) { //1 have result.
		if($radio_id != 0 && is_numeric($radio_id)) {
			
			    $data['result2'] = $this->get_data_model->get_media_details('radio',$radio_id,1);
			    $data['radio_id'] = $radio_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'radio/view/'.$radio_id.'/';
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
			    $data['result'] = $this->get_data_model->get_media_details('radio',$radio_id,1,$limit,$offset);
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			
		//	echo "<pre>";
		//	print_r($result);
		//	echo "</pre>";
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Radios' => base_url()."radio", 'Show Radios' => ''));
			$this->layouts->view('radios/radio_option_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
	}

	function change_radios_status($radio_id ,$flag,$table_name='radio') {
        $user_type = $this->session->userdata('user_type');
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_radios_status($radio_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Radio '.$str.' successfully. ');
				redirect(base_url().'radio/admin','refresh');
			}

            elseif($is_updated && $flag == 2  ) {

            	if($user_type =='admin'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				redirect(base_url().'radio/admin','refresh');
			    }

                elseif($user_type =='owner'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				redirect(base_url().'radio','refresh');
			    }


            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'radio/admin','refresh');
		

	}

function delete_radio($radio_id ,$flag,$table_name='radio') {
       $user_type = $this->session->userdata('user_type');
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_radio($radio_id,$flag,$table_name);

			
			if($is_deleted  ) {

				if($user_type =='admin'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Radio '.$str.' successfully. ');
				redirect(base_url().'radio/admin','refresh');
			    }
			    elseif($user_type =='owner'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Radio '.$str.' successfully. ');
				redirect(base_url().'radio','refresh');
			    }
			}     

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			//redirect(base_url().'apartments','refresh');
		

	}


	function _add_set_rules() {
		$this->form_validation->set_rules('radio_name', 'Radio Channel Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('city_name', 'Radio_City_Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Radio Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
		$this->form_validation->set_rules('radio_desc', 'Radio Channel Description', 'trim|min_length[3]|xss_clean|required');

		/*
		$this->form_validation->set_rules('layout_img', 'radio Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'radio Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}


	function _edit_set_rules() {
		$this->form_validation->set_rules('radio_name', 'Radio Channel Name', 'trim|min_length[3]|xss_clean');
		$this->form_validation->set_rules('city_name', 'Radio_City_Name', 'trim|min_length[3]|xss_clean');
		$this->form_validation->set_rules('radio_desc', 'Radio Channel Description', 'trim|min_length[3]|xss_clean');
		
      if (!empty($_FILES['userfile']['name'])) {
		$this->form_validation->set_rules('userfile', 'Radio Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
	}
		
	}


    function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/radios';
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

