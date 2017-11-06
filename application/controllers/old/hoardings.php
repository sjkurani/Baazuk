<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hoardings extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	$this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
        is_authenticated_user(array('admin','owner'));

		$data['hoardings']['new'] = $this->get_data_model->get_hoardings_details(0,0);
		$data['hoardings']['active'] = $this->get_data_model->get_hoardings_details(0,1);
		$data['hoardings']['blocked'] = $this->get_data_model->get_hoardings_details(0,2);
		
		if ($this->form_validation->run() == FALSE) {
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoardings' => base_url()."hoardings", 'All Hoardings' => ''));					
			$this->layouts->view('hoardings/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function add() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$this->_add_set_rules();
		$data = array();

		if ($this->form_validation->run() == FALSE) {
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoardings' => base_url()."hoardings", 'All Hoardings' => ''));				
			$this->layouts->view('hoardings/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
            $data = $this->input->post();
            $user_id = $this->session->userdata('user_id');
			$inputs_array = array(    'h_title' => $data['hoarding_title'], 
									  'h_image' => $this->filedata['file_name'],
									  'h_desc' => $data['hoarding_desc'],
									  'h_size' => $data['hoarding_size'],
                                      'h_city' => $data['hoarding_city'],
									  'h_location' => $data['map_lat'].", ".$data['map_lang'],
									  'h_price'  => $data['hoarding_price'],
									  'h_light' => $data['hoarding_light'],
									  'h_available' => $data['hoarding_available'],
									  'h_terms_cond' => $data['hoarding_terms_con'],
									  'created_by' => $user_id, //Fix 
									  'owner_id' => $user_id//Fix 
									  );
			$inserted_id = $this->save_update_model->save_hoarding($inputs_array);
			if($inserted_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'hoardings/add','refresh');			
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'hoardings/add','refresh');
			}			
 

		}
	}

	


	function edit($h_id = 0) {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		
		if($h_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}

       else {

            $this->_edit_set_rules();
			$data['h_id'] = $h_id;
			$data['posted_data'] = $this->input->post();
			$data['hoarding_details'] = $this->get_data_model->get_hoardings_details($h_id,0);

		if ($this->form_validation->run() == FALSE) {	
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoardings' => base_url()."hoardings", 'All Hoardings' => ''));			
			$this->layouts->view('hoardings/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
				$user_id = $this->session->userdata('user_id');
			$inputs_array = array(    'h_title' => $data['posted_data']['hoarding_title'], 
									  'h_image' => $this->filedata['file_name'],
                                      'h_size' =>  $data['posted_data']['hoarding_size'],
									  'h_desc' =>  $data['posted_data']['hoarding_desc'],
                                      'h_location' =>  $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'h_city'  =>  $data['posted_data']['hoarding_city'],
                                      'h_price' =>  $data['posted_data']['hoarding_price'],
                                      'h_light' =>  $data['posted_data']['hoarding_light'],
                                      'h_available' =>  $data['posted_data']['hoarding_available'],
                                      'h_terms_cond' =>  $data['posted_data']['hoarding_terms_con'],
									  'created_by' => $user_id, //Fix 
									  'owner_id' => $user_id,
									  'h_id' => $h_id //Fix 
									  );
				$is_update_successful = $this->save_update_model->update_hoardings($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Hoarding Details updated successfully");
					$full_url = redirect_dashboard_url('owner');
					redirect($full_url,'refresh');
				}
				else {
					echo "False";
				}
		}
	
    }
}

function show($hoarding_id = 0) { //1 have result.
	if($hoarding_id != 0 && is_numeric($hoarding_id)) {
		$result = $this->get_data_model->get_media_details('radio',$hoarding_id,1);
		echo "<pre>";
		print_r($result);
		echo "</pre>";

	}
}


function change_hoardings_status($h_id ,$flag,$table_name='hoardings') {

		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_hoardings_status($h_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Hoarding '.$str.' successfully. ');
				redirect(base_url().'hoardings','refresh');
			}

            elseif($is_updated && $flag == 2  ) {
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Hoarding '.$str.' successfully. ');
				redirect(base_url().'hoardings','refresh');


            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'hoardings','refresh');
		

	}


function delete_hoardings($h_id ,$flag,$table_name='hoardings') {
       
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_hoardings($h_id,$flag,$table_name);

			
			if($is_deleted  ) {
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Hoarding '.$str.' successfully. ');
				redirect(base_url().'hoardings','refresh');
			}     

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			//redirect(base_url().'apartments','refresh');
		

	}



function _edit_set_rules() {
		
		$this->form_validation->set_rules('userfile', ' Hoarding Image', 'trim|xss_clean|callback__verify_uploading_file_and_upload');
        
	}




function _add_set_rules() {
		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|min_length[3]|xss_clean|required');

        $this->form_validation->set_rules('userfile', 'Hoarding Location Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
		$this->form_validation->set_rules('hoarding_desc', 'Hoarding Description', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('hoarding_size', 'Hoarding Size', 'trim|xss_clean|required');
		$this->form_validation->set_rules('hoarding_city', 'Hoarding City', 'trim|xss_clean|required');
		$this->form_validation->set_rules('hoarding_price', 'Hoarding Price', 'trim|xss_clean|required');
		$this->form_validation->set_rules('hoarding_light', 'Hoarding Light', 'trim|xss_clean|required');
		$this->form_validation->set_rules('hoarding_available', 'Hoarding Available', 'trim|xss_clean|required');
        $this->form_validation->set_rules('hoarding_terms_con', 'Hoarding Terms Condition', 'trim|xss_clean|required');

		/*
		$this->form_validation->set_rules('layout_img', 'Apartment Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'Apartment Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}




 function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/hoardings';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->form_validation->set_message('_verify_uploading_file_and_upload', print_r($error,TRUE));
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



