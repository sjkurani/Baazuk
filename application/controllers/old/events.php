<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
		$this->load->library('pagination');
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		is_authenticated_user(array('admin','owner'));
			

        $owner_id = $this->session->userdata('user_id');
        $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Events and Exhibition' => base_url()."events", 'All Events and Exhibition' => ''));

		$data['events']['new'] = $this->get_data_model->get_owner_event_details($owner_id,0);
		$data['events']['active'] = $this->get_data_model->get_owner_event_details($owner_id,1);
		$data['events']['blocked'] = $this->get_data_model->get_owner_event_details($owner_id,2);
		
		if ($this->form_validation->run() == FALSE) {	
		
			$this->layouts->view('events/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}
	function admin() {
 		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$data = array();
		$data['events']['new'] = $this->get_data_model->get_event_details(0,0);
		$data['events']['active'] = $this->get_data_model->get_event_details(0,1);
		$data['events']['blocked'] = $this->get_data_model->get_event_details(	0,2);
		$data['recomanded']['event'] = $this->get_data_model->recommanded_events();
		
		if($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Events and Exhibition' => base_url()."events", 'All Events and Exhibition' => ''));		
			$this->layouts->view('admin/event_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('admin/event_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
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
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Events and Exhibition' => base_url()."events", 'Add Events and Exhibition' => ''));			
			$this->layouts->view('events/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			$user_id = $this->session->userdata('user_id');
			$user_type = $this->session->userdata('user_type');
			$data = $this->input->post();
			
			$event_start_date_time = explode("-",$this->input->post('start_date'));
			$event_end_date_time = explode("-",$this->input->post('end_date'));
			
			$start_time = date("H:i:s", strtotime($event_start_date_time[1]));
			$end_time = date("H:i:s", strtotime($event_end_date_time[1]));

			$start_date = date("Y-m-d", strtotime(str_replace('/', '.', $event_start_date_time[0])));
			$end_date = date("Y-m-d", strtotime(str_replace('/', '.', $event_end_date_time[0])));

			$full_start = $start_date." ".$start_time;
			$full_end = $end_date." ".$end_time;
			$user_name = $this->session->userdata('user_name');
			$user_type = $this->session->userdata('user_type');
			$user_id = $this->session->userdata('user_id');
			$inputs_array = array('event_name' => $data['eve_title'], 
								  'event_desc' => $data['eve_desc'],
								  'event_area' => $data['eve_area'],
								  'event_location' =>$data['map_lat'].", ".$data['map_lang'],
								  'event_cityname' =>$data['city_name'],	
								  'event_location_name' =>$data['eve_loc'],	
								  'start_date' => $full_start,
								  'end_date' => $full_end,
								  //'terms_condn' => $data['term_condn'],								  
								  'event_image' => $this->filedata['file_name'],
								  'event_type' => $data['event_type'],
								  'created_by' =>  $user_id, 
								  'owner_id' =>  $user_id
								  );
			$inserted_event_id = $this->save_update_model->save_event($inputs_array);
			$media_type='event';
			$city_area_update = $this->save_update_model->save_city_area_details($data['city_name'],$data['eve_area'],$media_type);
			if($inserted_event_id) {
				$this->session->set_flashdata('msg', "New event created successfully..");
				$action_type='new';
				send_admin_grid_mails(ADMIN_EMAIL,$type='events',$action_type,$user_name,$user_id,$user_type,$inserted_event_id);
				redirect(base_url().'dashboard/'.$user_type,'refresh');				
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				redirect(base_url().'events/add','refresh');
			}
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}


	function edit($event_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($event_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['event_id'] = $event_id;
			
			$data['posted_data'] = $this->input->post();
			$data['event_details'] = $this->get_data_model->get_event_details($event_id,0);

			if ($this->form_validation->run() == FALSE) {
					$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Events and Exhibition' => base_url()."events", 'Edit Events and Exhibition' => ''));
				$this->layouts->view('events/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
					//Save and redirect..
				$user_id = $this->session->userdata('user_id');
				$user_type = $this->session->userdata('user_type');


				$event_start_date_time = explode("-",$data['posted_data']['start_date']);
				$event_end_date_time = explode("-",$data['posted_data']['end_date']);

				$start_time = date("H:i:s", strtotime($event_start_date_time[1]));
				$end_time = date("H:i:s", strtotime($event_end_date_time[1]));

				$start_date = date("Y-m-d", strtotime(str_replace('/', '.', $event_start_date_time[0])));
				$end_date = date("Y-m-d", strtotime(str_replace('/', '.', $event_end_date_time[0])));

				$full_start = $start_date." ".$start_time;
				$full_end = $end_date." ".$end_time;
				$user_id = $this->session->userdata('user_id');
				$inputs_array = array('event_name' => $data['posted_data']['eve_title'], 
							  'event_desc' => $data['posted_data']['eve_desc'],
							  'event_area' => $data['posted_data']['eve_area'],
							  'event_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
							  'event_location_name' => $data['posted_data']['eve_loc'],
							  'event_cityname' => $data['posted_data']['city_name'],
							  //'park_image' => $data['park_img'],
							  'start_date' => $full_start,
							  'end_date' => $full_end,
							  //'terms_condn' => $data['posted_data']['term_condn'],
							  'event_type' => $data['posted_data']['event_type'], //Fix 
							  'created_by' => $user_id, //Fix 
							  'owner_id' => $user_id,//Fix 
							  'event_id' => $event_id
							  );

				if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['event_image'] = $this->filedata['file_name'];
				}

				$is_update_successful = $this->save_update_model->update_events($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Event Details updated successfully");
					redirect(base_url().'dashboard/'.$user_type,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}

	function show($event_id = 0) { 
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		if($event_id != 0 && is_numeric($event_id)) {
		    $data['result2'] = $this->get_data_model->get_media_details('event',$event_id,1);
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
			    $data['event_id'] = $event_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'events/show/'.$event_id.'/';
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
			    $data['result'] = $this->get_data_model->get_media_details('event',$event_id,1,$limit,$offset);
			    if($logged_in && $user_type == 'buyer') {
			    	$buyer_id = $this->session->userdata('user_id');
			    	$data['saved_ads'] = $this->get_data_model->get_saved_events($buyer_id,$event_id);
			    }
			    $data['result']['terms'] = $this->get_data_model->get_terms_and_cond('event');
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Events and Exhibition' => base_url()."events", 'Show Events and Exhibition' => ''));
				$this->layouts->view('events/show_event_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
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
		}
		else{
			$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
			redirect(base_url().'account/signin','refresh');
				
		}
	}

	function view($event_id = 0) { 
		if($event_id != 0 && is_numeric($event_id)) {
			    $data['result2'] = $this->get_data_model->get_media_details('event',$event_id,1);
			    $event_name = $data['result2']['primary'][0]->event_name;
			    $data['event_id'] = $event_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'events/view/'.$event_id.'/';
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
			    $data['result'] = $this->get_data_model->get_media_details('event',$event_id,1,$limit,$offset);
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			
			if($data){
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Events and Exhibition' => base_url()."events", $event_name => base_url()."events/show/".$event_id, 'Show Events and Exhibition' => ''));
			$this->layouts->view('events/event_option_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else
			{
				echo "No data found ";
			}
		}
	}
	

function change_events_status($event_id ,$flag,$table_name='events_meta') {
       $user_type = $this->session->userdata('user_type');

	
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {
			$is_updated = $this->save_update_model->change_events_status($event_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Event '.$str.' successfully. ');
				redirect(base_url().'events/admin','refresh');
			}

            elseif($is_updated && $flag == 2  ) {


            	if($user_type =='admin'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Event '.$str.' successfully. ');
				redirect(base_url().'events/admin','refresh');
                }

                elseif($user_type =='owner')
                {
                    $str =  "Blocked";
				    $this->session->set_flashdata('msg', 'Event '.$str.' successfully. ');
				    redirect(base_url().'events','refresh');

                }
            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'events/admin','refresh');
		

	}

function delete_events($event_id ,$flag,$table_name='events_meta') {
       $user_type = $this->session->userdata('user_type');
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_events($event_id,$flag,$table_name);

			
			if($is_deleted  ) {

				if($user_type =='admin'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Event '.$str.' successfully. ');
				redirect(base_url().'events/admin','refresh');
				}

                elseif($user_type =='owner'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Event '.$str.' successfully. ');
				redirect(base_url().'events','refresh');
				}

			}     

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			//redirect(base_url().'apartments','refresh');
		

	}

	function _add_set_rules() {
		$this->form_validation->set_rules('eve_title', 'Event Title', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date',   'End Date', 'required');
		$this->form_validation->set_rules('eve_area', 'Event Area', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('event_type', 'Event Type', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('eve_desc', 'Event Description', 'trim|min_length[10]|xss_clean|required');
		
		$this->form_validation->set_rules('eve_loc', 'Event Location', 'required');
		$this->form_validation->set_rules('city_name', 'Event City', 'required');
		/*
		$this->form_validation->set_rules('layout_img', 'Apartment Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

	/*	if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'Apartment Image', 'required|_verify_uploading_file_and_upload');
		}*/
		$this->form_validation->set_rules('userfile', 'Event Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('eve_title', 'Event Title', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date',   'End Date', 'required');
		$this->form_validation->set_rules('eve_area', 'Event Area', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('event_type', 'Event Type', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('eve_desc', 'Event Description', 'trim|min_length[10]|xss_clean|required');
		$this->form_validation->set_rules('map_lat', 'Map Latitude', 'required');
		$this->form_validation->set_rules('map_lang', 'Map Longitude', 'required');
		
		if (!empty($_FILES['userfile']['name'])) {
		$this->form_validation->set_rules('userfile', 'Event Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
	   }
	}
	
	function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/events';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error =  $this->upload->display_errors();
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