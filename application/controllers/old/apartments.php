<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apartments extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
		$this->load->library('pagination');
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner'));
		$data = array();
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", 'All Apartments' => ''));

        $owner_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
		$data['apartments']['new']= $this->get_data_model->get_owner_apartment_details($owner_id,0);
		$data['apartments']['active']= $this->get_data_model->get_owner_apartment_details($owner_id,1);
		$data['apartments']['blocked']= $this->get_data_model->get_owner_apartment_details($owner_id,2);
		
		if($this->form_validation->run() == FALSE) {
			$this->layouts->view('apartments/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('apartments/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}
	}


	function admin() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$data = array();
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments/".$this->session->userdata('user_type'), 'All Apartments' => ''));
		$data['apartments']['new']= $this->get_data_model->get_apartment_details(0,0);
		$data['apartments']['active']= $this->get_data_model->get_apartment_details(0,1);
		$data['apartments']['blocked']= $this->get_data_model->get_apartment_details(0,2);
		$data['recomanded']['apartment'] = $this->get_data_model->recommanded_aprtments();
		
		if($this->form_validation->run() == FALSE) {
			$this->layouts->view('admin/apartment_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('admin/apartment_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
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
		//print_r($this->input->post());
		$data = array();
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", 'Add Apartments' => ''));
			$this->layouts->view('apartments/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$user_id = $this->session->userdata('user_id');
			$user_type = $this->session->userdata('user_type');
			$user_name = $this->session->userdata('user_name');
			$inputs_array = array('a_name' => $data['apartment_name'], 
									  'a_area' => $data['apartment_area'],
									  'a_category' => $data['apartment_category'],
									  'type_of_aprtment' => $data['type_of_aprtment'],
									  'num_of_flats' => $data['num_of_flats'],
									  'a_desc' => $data['apartment_desc'],
									  'a_location' => $data['map_lat'].", ".$data['map_lang'],
									  'a_location_name' => $data['apartment_loc'],
									  'a_cityname' => $data['city_name'],
									  'a_image' => $this->filedata['file_name'],
									  'created_by' => $user_id,
									  'owner_id' => $user_id
									  );
			
			$inserted_apartment_id = $this->save_update_model->save_apartment($inputs_array);			
			$media_type='apartment';			
			$city_area_update = $this->save_update_model->save_city_area_details($data['city_name'],$data['apartment_area'],$media_type);

			if($inserted_apartment_id) {								
				$this->session->set_flashdata('msg', "New apartment created successfully..");
				$action_type='new';
				send_admin_grid_mails(ADMIN_EMAIL,$type='apartments',$action_type,$user_name,$user_id,$user_type,$inserted_apartment_id);
				//$this->session->set_flashdata('msg', "New mail send successfully..");
				redirect(base_url().'dashboard/'.$user_type,'refresh');			
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				redirect(base_url().'apartments/add','refresh');
			}
			
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function edit($apartment_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($apartment_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {

			$this->_edit_set_rules();
			$data['apartment_id'] = $apartment_id;
			$data['posted_data'] = $this->input->post();
			$data['apartment_details'] = $this->get_data_model->get_apartment_details($apartment_id,0);

			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", 'Edit Apartments' => ''));
				$this->layouts->view('apartments/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				$user_id = $this->session->userdata('user_id');
				$user_type = $this->session->userdata('user_type');
				$inputs_array = array('a_name' => $data['posted_data']['apartment_name'], 
				                      'a_area' => $data['posted_data']['apartment_area'], 
				                      'a_category' => $data['posted_data']['apartment_category'], 
				                      'type_of_aprtment' => $data['posted_data']['type_of_aprtment'], 
				                      'num_of_flats' => $data['posted_data']['num_of_flats'], 
									  'a_desc' => $data['posted_data']['apartment_desc'],
									  'a_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'a_location_name' =>$data['posted_data']['apartment_loc'] ,//Fix
									  'a_cityname' => $data['posted_data']['apartment_loc'], //Fix 	(Need To change this)		
									  'created_by' => $user_id, //Fix 
									  'owner_id' => $user_id,
									  'a_id' => $apartment_id //Fix 
									  );

				if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['a_image'] = $this->filedata['file_name'];
				}

				$is_update_successful = $this->save_update_model->update_apartment($inputs_array);


				if($is_update_successful) {
					

					
					$this->session->set_flashdata('msg', "Apartment Details updated successfully");
					//$action_type='new'
					//send_admin_grid_mails(ADMIN_EMAIL,$type='apartment',$action_type,);
					redirect(base_url().'dashboard/'.$user_type,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}

	function show($apartment_id = 0) { //7 have result.
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($apartment_id != 0 && is_numeric($apartment_id)) {			
			    $data['result2'] = $this->get_data_model->get_media_details('apartment',$apartment_id,1);
				$user_type = $this->session->userdata('user_type');
				if($data['result2']['primary'][0]->flag != 1) {
					if($user_type == 'admin' || $user_type == 'owner') {
						$is_showable = 	1;
					}
					else {
						$is_showable = 0;
					}
				}
				else {
					$is_showable = 	1;
				}
				if($is_showable) {						
				    $data['apartment_id'] = $apartment_id;
				    $total_row=$data['result2']['total'];
				    $config['total_rows'] = $total_row;
					$config['base_url'] = base_url().'apartments/show/'.$apartment_id.'/';
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
				    $data['result'] = $this->get_data_model->get_media_details('apartment',$apartment_id,1,$limit,$offset);
				    if($logged_in && $user_type == 'buyer') {
				    	$buyer_id = $this->session->userdata('user_id');
				    	$data['saved_ads'] = $this->get_data_model->get_saved_apartments($buyer_id,$apartment_id);
				    }

				    $data['result']['terms'] = $this->get_data_model->get_terms_and_cond('apartment');
				    $this->pagination->initialize($config);
					$data["links"] = $this->pagination->create_links();
				
					$this->layouts->set_breadcrumb_array(array('Home' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", 'Show Apartments' => ''));
					$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", 'Show Apartments' => ''));
					$this->layouts->view('apartments/show_apartments_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
				}
				else {
				    if ($this->agent->is_referral())
					{
						$redirect_url = $this->agent->referrer();
					}
					else {
						$redirect_url = base_url();	
					}
            		$this->session->set_flashdata('errormsg', "Not authorised to access page.");
					redirect($redirect_url);
				}
		}
/*
		else
		{
                $this->session->set_flashdata('errormsg', "No apartment ads to show");
				
		}*/
	}

function view($apartment_id = 0) { //7 have result.
		if($apartment_id != 0 && is_numeric($apartment_id)) {
			    $data['result2'] = $this->get_data_model->get_media_details('apartment',$apartment_id,1);
			    $data['apartment_id'] = $apartment_id;
			    $apartment_name = $data['result2']['primary'][0]->a_name;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'apartments/view/'.$apartment_id.'/';
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
			    $data['result'] = $this->get_data_model->get_media_details('apartment',$apartment_id,1,$limit,$offset);
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			$this->layouts->set_breadcrumb_array(array('Home' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", 'Show Apartments' => ''));
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Apartments' => base_url()."apartments", $apartment_name => base_url()."apartments/show/".$apartment_id, 'Options' => ''));
			$this->layouts->view('apartments/apartment_option_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}

		else
		{
                $this->session->set_flashdata('errormsg', "No apartment ads to show");
				
		}

		/*if($apartment_id != 0 && is_numeric($apartment_id)) {
			$result = $this->get_data_model->get_media_details('apartment',$apartment_id,1);
			echo "<pre>";
			print_r($result);
			echo "</pre>";

		}*/
	}




	function change_apartments_status($apartment_id ,$flag,$table_name='apartments') {
        $user_type = $this->session->userdata('user_type');
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_apartment_status($apartment_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				/*$data['apartment_details'] = $this->get_data_model->get_apartment_details($apartment_id,0);
				$details=$data['apartment_details'];
				echo "<pre>";
				print_r($details);
				echo "<pre>";
				exit();*/
				$str =  "Activated";
				$action_type = "aprooved";
				$this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				//send_admin_grid_mails(ADMIN_EMAIL,$type='apartment',$action_type,$user_name,$user_id,$user_type);
				redirect(base_url().'apartments/admin','refresh');

			}

            elseif($is_updated && $flag == 2  ) {
            	
            	if($user_type =='admin'){
            	
            	    $str =  "Blocked";
				    $this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				    redirect(base_url().'apartments/admin','refresh');
			      }

			      elseif($user_type =='owner'){

			      	$str =  "Blocked";
				   $this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				    redirect(base_url().'apartments','refresh');
			      }


            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'apartments/admin','refresh');
		

	}

	
function delete_apartments($apartment_id,$flag,$table_name='apartments') {
        $user_type = $this->session->userdata('user_type');
      
	//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_apartments($apartment_id,$flag,$table_name);			
			if($is_deleted  ) {

               if($user_type=='admin'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				redirect(base_url().'apartments/admin','refresh');
			    }

			    elseif($user_type=='owner')

			    {
			    	$str =  "Deleted";
				    $this->session->set_flashdata('msg', 'Apartment '.$str.' successfully. ');
				    redirect(base_url().'apartments','refresh');
			    }
			}     

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'apartments','refresh');
		

	}

	function _add_set_rules() {
		$this->form_validation->set_rules('apartment_name', 'Apartment Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('apartment_area', 'Apartment Area', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('apartment_category', 'Apartment Category', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('city_name', 'Apartment City', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('type_of_aprtment', 'Type of Apartment  ', 'trim|xss_clean|required');
		$this->form_validation->set_rules('num_of_flats', ' No. of Flats ', 'numeric|xss_clean|required');
		$this->form_validation->set_rules('apartment_loc', 'Apartment Description', 'trim|xss_clean|required');
		$this->form_validation->set_rules('apartment_desc', 'Apartment Description', 'trim|min_length[10]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Apartment Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
/*
		if (!empty($_FILES['apartment_img']['name'])) {
		    $this->form_validation->set_rules('apartment_img', 'Apartment Image', 'required|callback__verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('apartment_name', 'Apartment Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('apartment_area', 'Apartment Area', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('apartment_category', 'Apartment Category', 'trim|min_length[3]|xss_clean|required');

			$this->form_validation->set_rules('type_of_aprtment', 'Type of Apartment  ', 'trim|xss_clean|required');
		$this->form_validation->set_rules('num_of_flats', ' No. of Flats ', 'numeric|xss_clean|required');
		$this->form_validation->set_rules('apartment_desc', 'Apartment Description', 'trim|min_length[10]|xss_clean|required');
	
		if (!empty($_FILES['userfile']['name'])) {
		    $this->form_validation->set_rules('userfile', 'Apartment Image', 'callback__verify_uploading_file_and_upload');
		}
	}

	function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/apartments';
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