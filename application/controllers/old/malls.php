<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Malls extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	$this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
		$this->load->library('pagination');
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		is_authenticated_user(array('admin','owner'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Malls' => base_url()."malls", 'All Malls' => ''));
        $owner_id = $this->session->userdata('user_id');

		$data['malls']['new'] = $this->get_data_model->get_owner_mall_details($owner_id,0);
		$data['malls']['active'] = $this->get_data_model->get_owner_mall_details($owner_id,1);
		$data['malls']['blocked'] = $this->get_data_model->get_owner_mall_details($owner_id,2);
		
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('malls/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {

		}
	}

	function admin(){
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$data = array();
		$data['malls']['new'] = $this->get_data_model->get_mall_details(0,0);
		$data['malls']['active'] = $this->get_data_model->get_mall_details(0,1);
		$data['malls']['blocked'] = $this->get_data_model->get_mall_details(0,2);
		$data['recomanded']['mall'] = $this->get_data_model->recommanded_malls();
		
		if($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Malls' => base_url()."malls", 'All Malls' => ''));
			$this->layouts->view('admin/mall_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('admin/mall_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
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
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Malls' => base_url()."malls", 'Add Malls' => ''));		
			$this->layouts->view('malls/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
			$data = $this->input->post();
			$user_name = $this->session->userdata('user_name');
			$user_type = $this->session->userdata('user_type');
			$user_id = $this->session->userdata('user_id');
			$inputs_array = array('mall_name' => $data['mall_name'], 
								  'mall_desc' => $data['mall_desc'],
								  'mall_location' => $data['map_lat'].", ".$data['map_lang'],
								  'img_name' => $this->filedata['file_name'],
								  'mall_area' => $data['mall_area'],
								  'city_name' => $data['mall_city_name'], //Fix 
								  'mall_location_name' => $data['mall_loc'],
								  'created_by' => $user_id,  
								  'owner_id' => $user_id 
								  );
			$inserted_mall_id = $this->save_update_model->save_malls($inputs_array);
			$media_type='mall';
			$city_area_update = $this->save_update_model->save_city_area_details($data['mall_city_name'],$data['mall_area'],$media_type);
			if($inserted_mall_id) {
				$this->session->set_flashdata('msg', "New mall created successfully..");
				$action_type='new';
				send_admin_grid_mails(ADMIN_EMAIL,$type='malls',$action_type,$user_name,$user_id,$user_type,$inserted_mall_id);
				redirect(base_url().'dashboard/'.$user_type,'refresh');	
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				redirect(base_url().'malls/add','refresh');
			}
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function edit($mall_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		if($mall_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/dashboard');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['mall_id'] = $mall_id;
			$data['posted_data'] = $this->input->post();
			$data['mall_details'] = $this->get_data_model->get_mall_details($mall_id,0);

			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Malls' => base_url()."malls", 'Edit Malls' => ''));
				$this->layouts->view('malls/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
			}
			else {
				//Save and redirect..
				$user_id = $this->session->userdata('user_id');
			    $user_type = $this->session->userdata('user_type');
				$inputs_array = array('mall_name' => $data['posted_data']['mall_name'], 
									  'mall_desc' => $data['posted_data']['mall_desc'],
									  'mall_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'mall_location_name' =>$data['posted_data']['mall_loc'],
						
									  'mall_area' => $data['posted_data']['mall_area'], //Fix 
									  'city_name' => $data['posted_data']['mall_city_name'], //Fix 
									  'created_by' => $user_id, //Fix 
									  'owner_id' => $user_id,//Fix 
									  'mall_id' => $mall_id 
									  );


                 if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['img_name'] = $this->filedata['file_name'];
				}
				$is_update_successful = $this->save_update_model->update_mall($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Mall Details updated successfully");
					redirect(base_url().'dashboard/'.$user_type,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}

	function show($mall_id = 0) { 
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		if($mall_id != 0 && is_numeric($mall_id)) {
			    $data['result2'] = $this->get_data_model->get_media_details('mall',$mall_id,1);
			    $data['mall_id'] = $mall_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'malls/show/'.$mall_id.'/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=4;
				$config['per_page'] =9;
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
			    $data['result'] = $this->get_data_model->get_media_details('mall',$mall_id,1,$limit,$offset);
				    if($logged_in && $user_type == 'buyer') {
				    	$buyer_id = $this->session->userdata('user_id');
				    	$data['saved_ads'] = $this->get_data_model->get_saved_apartments($buyer_id,$mall_id);
				    }
			    $data['result']['terms'] = $this->get_data_model->get_terms_and_cond('mall');
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			//echo "<pre>";
			//print_r($data);
			//echo "</pre>";
				if($data){
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Malls' => base_url()."malls", 'Show Malls' => ''));
			$this->layouts->view('malls/show_mall_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		}
	}
	else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}

	function view($mall_id = 0) { //1 have result.
		if($mall_id != 0 && is_numeric($mall_id)) {
			
			$data['result2'] = $this->get_data_model->get_media_details('mall',$mall_id,1);
			    $data['mall_id'] = $mall_id;
			    $total_row=$data['result2']['total'];
			    $config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'malls/view/'.$mall_id.'/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=4;
				$config['per_page'] =8;
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
			    $data['result'] = $this->get_data_model->get_media_details('mall',$mall_id,1,$limit,$offset);
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
				if($data){
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Malls' => base_url()."malls", 'Show Malls' => ''));
			$this->layouts->view('malls/mall_option_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		}
	}

	
function change_malls_status($mall_id ,$flag,$table_name='malls_meta') {
	 $user_type = $this->session->userdata('user_type');

		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_malls_status($mall_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Mall '.$str.' successfully. ');
				redirect(base_url().'malls/admin','refresh');
			}

            elseif($is_updated && $flag == 2  ) {

            	if($user_type=='admin'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Mall '.$str.' successfully. ');
				redirect(base_url().'malls/admin','refresh');
			   }
			   elseif($user_type=='owner'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Mall '.$str.' successfully. ');
				redirect(base_url().'malls','refresh');
			   }


            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'malls/admin','refresh');
		

	}

function delete_malls($mall_id ,$flag,$table_name='malls_meta') {
	$user_type = $this->session->userdata('user_type');
       
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_malls($mall_id,$flag,$table_name);

			
			if($is_deleted  ) {
				if($user_type=='admin'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Mall '.$str.' successfully. ');
				redirect(base_url().'malls/admin','refresh');
			    }

			    elseif($user_type=='owner'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Mall '.$str.' successfully. ');
				redirect(base_url().'malls','refresh');
			    }
			}     

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			//redirect(base_url().'apartments','refresh');
		

	}





	
	function _edit_set_rules() {
		$this->form_validation->set_rules('mall_name', 'Mall Name', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('mall_desc', 'Mall Description', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('mall_area', 'Mall Area', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('mall_city_name', 'Mall City', 'required');
		$this->form_validation->set_rules('mall_loc', 'Mall Location', 'required');
		if (!empty($_FILES['userfile']['name'])) {
		$this->form_validation->set_rules('userfile', 'Mall Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
	}
	}

	function _add_set_rules() {
		$this->form_validation->set_rules('mall_name', 'Mall Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('mall_desc', 'Mall Description', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('mall_area', 'Mall Area', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('mall_city_name', 'Mall City', 'required');
		$this->form_validation->set_rules('mall_loc', 'Mall Location', 'required');
		
   
		$this->form_validation->set_rules('userfile', 'Mall Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');

		/*
		$this->form_validation->set_rules('layout_img', 'mall Image', 'required|trim|min_length[3]|xss_clean|_verify_uploading_file_and_upload');*/

		/*if (!empty($_FILES['layout_img']['name'])) {
		    $this->form_validation->set_rules('userfile', 'mall Image', 'required|_verify_uploading_file_and_upload');
		}*/
	}
	function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/malls';
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