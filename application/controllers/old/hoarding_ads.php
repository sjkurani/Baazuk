<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hoarding_ads extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
		$this->load->library('pagination');
		
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$data = array();

		is_authenticated_user(array('owner','admin'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoarding Ads' => base_url()."hoarding_ads", 'All Hoarding Ads' => ''));
		$owner_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
		 if($user_type=="admin"){
		$data['hoarding_ads']['new']= $this->get_data_model->get_hoarding_ads_details(0,0);
		$data['hoarding_ads']['active']= $this->get_data_model->get_hoarding_ads_details(0,1);
		$data['hoarding_ads']['blocked']= $this->get_data_model->get_hoarding_ads_details(0,2);
		 }
		 else{
		$data['hoarding_ads']['new']= $this->get_data_model->get_owner_hoardings_details(0,$owner_id,0);
		$data['hoarding_ads']['active']= $this->get_data_model->get_owner_hoardings_details(0,$owner_id,1);
		$data['hoarding_ads']['blocked']= $this->get_data_model->get_owner_hoardings_details(0,$owner_id,2);
		 }
		//print_r($data);
		if($this->form_validation->run() == FALSE) {
			$this->layouts->view('hoarding_ads/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('hoarding_ads/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}
	}

	

	function admin() {
 		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$data = array();
		 
		$data['hoarding_ads']['new']= $this->get_data_model->get_hoarding_ads_details(0,0);
		$data['hoarding_ads']['active']= $this->get_data_model->get_hoarding_ads_details(0,1);
		$data['hoarding_ads']['blocked']= $this->get_data_model->get_hoarding_ads_details(0,2);
		$data['recomanded']['hoarding'] = $this->get_data_model->recommanded_hoardings();
		
		if($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoardings' => base_url()."hoardings", 'All Hoardings' => ''));	
			$this->layouts->view('admin/hoarding_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('admin/hoarding_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}
	}

	function add() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
       
		is_authenticated_user(array('admin','owner'));
        $logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		$owner_id = $this->session->userdata('user_id');
		$this->_add_set_rules();
        
		$data = array();		
		
		$data['hoarding']['list']=$this->get_data_model->get_owner_hoardings_details($owner_id,1);
		//print_r($data[ap_list]);
		if ($this->form_validation->run() == FALSE) {
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoarding Ads' => base_url()."hoarding_ads", 'Add Hoarding Ads' => ''));
			$this->layouts->view('hoarding_ads/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
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
			else{
				$avail_date=date('Y-m-d H:i:s');
			}
			$location = $this->input->post('h_cityname');

			$user_name = $this->session->userdata('user_name');
			$user_type = $this->session->userdata('user_type');
			$user_id = $this->session->userdata('user_id');
			//print_r($data);
			$inputs_array = array('h_title' => $data['h_name'], 
									  'h_desc' => $data['h_desc'],
									  'h_size' => $data['h_size'],
									  'h_light' => $data['h_light'],
									  'h_location_name' => $data['h_location'],
									  'h_location' => $data['map_lat'].", ".$data['map_lang'],
									  'h_cityname' => $data['city_name'],
									  'h_area' => $data['h_area'],
									  'h_landmark'=>$data['h_landmark'],
									  'price' => $data['h_price'], 
									  'price_setting' => $data['price_setting'], 
									  'availability_flag' => $data['availability_flag'],
									  'next_avail_date'=>$avail_date,
									  'ref_image' => $this->filedata['file_name'],
									  'owner_id' => $owner_id 
									  
									  );
			$inserted_h_id = $this->save_update_model->save_hoarding_ads($inputs_array);
			$media_type='hoarding';
			$city_area_update = $this->save_update_model->save_city_area_details($data['city_name'],$data['h_area'],$media_type);
			print_r($city_area_update );
			//exit();
			if($inserted_h_id) {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				$action_type='new';
				send_admin_grid_mails(ADMIN_EMAIL,$type='hoarding_ads',$action_type,$user_name,$user_id,$user_type,$inserted_h_id);
			   redirect(base_url().'hoarding_ads/','refresh');			
			}
			else {
				$this->session->set_flashdata('redirectToCurrent', current_url());
				redirect(base_url().'hoarding_ads/','refresh');
			}
			
		}
	}else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
		}
	}

	function edit($h_id = 0) {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		is_authenticated_user(array('admin','owner'));
		if($h_id == 0) {
			//Check whether he logged in.
			$full_url = redirect_dashboard_url('owner/');
			redirect($full_url,'refresh');
		}
		else {
			$this->_edit_set_rules();
			$data['h_id'] = $h_id;
			$user_id=$this->session->userdata('user_id');
			$data['posted_data'] = $this->input->post();
			$data['ad_details'] = $this->get_data_model->get_hoarding_ads_details($h_id,0);
			$owner_id=$data['ad_details']->owner_id;
			$data['hoarding']['list']=$this->get_data_model->get_owner_hoardings_details($user_id,1);

			if ($this->form_validation->run() == FALSE) {
				$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoarding Ads' => base_url()."hoarding_ads", 'Edit Hoarding Ads' => ''));
				$this->layouts->view('hoarding_ads/edit_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
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
			
			
				 //print_r($data['posted_data']);
				 //Save and redirect..
				 $inputs_array = array('h_title' => $data['posted_data']['h_name'], 
				                      'price' => $data['posted_data']['h_price'],
				                      'h_size' => $data['posted_data']['h_size'],
				                      'h_light' => $data['posted_data']['h_light'],
				                      'h_location_name' => $data['posted_data']['h_location'],
				                      'h_location' => $data['posted_data']['map_lat'].", ".$data['posted_data']['map_lang'],
									  'h_cityname' => $data['posted_data']['city_name'] , 
									  'h_area' => $data['posted_data']['h_area'] , 
									  'h_desc' => $data['posted_data']['h_desc'],
									  'price_setting' => $data['posted_data']['price_setting'], 
									  'availability_flag' => $data['posted_data']['availability_flag'],									  
									  'next_avail_date' => $avail_date, 						  
									  'owner_id' => $owner_id,//Fix
									  'h_id' => $h_id  
									  );

				 if(isset($this->filedata) && is_array($this->filedata)) {
					$inputs_array['ref_image'] = $this->filedata['file_name'];
				}

				$is_update_successful = $this->save_update_model->update_hoarding_ads($inputs_array);
				if($is_update_successful) {
					$this->session->set_flashdata('msg', "Hoarding Updated successfully..");
					$full_url = redirect_dashboard_url('hoarding_ads');
					redirect($full_url,'refresh');
				}
				else {
					echo "False";
				}
			}
		}
	}

	function show($h_id) {
		$logged_in = $this->session->userdata('logged_in');
		$user_type = $this->session->userdata('user_type');
		if($logged_in){
		if($h_id != 0 && is_numeric($h_id)) {	
				$data=array();
                $data['result']['primary']= $this->get_data_model->get_hoarding_ads_details($h_id,1);
                $data['result']['terms'] = $this->get_data_model->get_terms_and_cond('hoarding');
				$owner_id=$data['result']['primary']->owner_id;
				$area=$data['result']['primary']->h_area;
                 //pagination for other owner hoardings//
				$Ownertotal_row=count($this->get_data_model->get_owner_hoardings_details($owner_id,1));
			    $data['h_id'] = $h_id;
			    $config1['total_rows'] = $Ownertotal_row;
				$config1['base_url'] = base_url().'hoarding_ads/show/'.$h_id.'/';
				if (count($_GET) > 0) $config1['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config1['first_url'] = $config1['base_url'].'?'.http_build_query($_GET);
				$config1['uri_segment']=4;
				$config1['per_page'] = 9;
				$config1['num_tag_open'] = '<li>';
				$config1['num_tag_close'] = '</li>';
				$config1['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config1['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config1['next_tag_open'] = "<li>";
				$config1['next_tagl_close'] = "</li>";
				$config1['prev_tag_open'] = "<li>";
				$config1['prev_tagl_close'] = "</li>";
				$config1['first_tag_open'] = "<li>";
				$config1['first_tagl_close'] = "</li>";
				$config1['last_tag_open'] = "<li>";
				$config1['last_tagl_close'] = "</li>";
				
			    $limit=$config1['per_page'];
                $offset=$this->uri->segment(4);
			    $data['result']['owner'] = $this->get_data_model->get_owner_hoardings_details($owner_id,1,$limit,$offset);
				    if($logged_in && $user_type == 'buyer') {
				    	$buyer_id = $this->session->userdata('user_id');
				    	$data['saved_ads'] = $this->get_data_model->get_saved_hoardings($buyer_id,$h_id);
				    }
			    $this->pagination->initialize($config1);
				$data["owner_links"] = $this->pagination->create_links();
				
				//pagination for area hoardings
				/*$Areatotal_row=count($this->get_data_model->get_other_area_hoardings($area,1));
			    $data['h_id'] = $h_id;
			    $config['total_rows'] = $Areatotal_row;
				$config['base_url'] = base_url().'hoarding_ads/show/'.$h_id.'/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=4;
				$config['per_page'] = 1;
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
				
			    $limit2=$config['per_page'];
                $offset2=$this->uri->segment(4);
			    $data['result']['area'] = $this->get_data_model->get_other_area_hoardings($area,1,$limit2,$offset2);
			    $this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();*/
				
			   
			
			    //$data['result']['owner'] = $this->get_data_model->get_owner_hoardings_details($owner_id,1);
			    $data['result']['area'] = $this->get_data_model->get_other_area_hoardings($h_id,$area,1,3);
			   // print_r($data['result']['owner']);
			   $this->layouts->set_breadcrumb_array(array('Home' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoardings' => base_url()."hoarding_ads", 'Show Hoardings' => ''));
			   $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),'Hoardings' => base_url()."hoarding_ads", 'Show Hoardings' => ''));
			  $this->layouts->view('hoarding_ads/show_hoardings_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}
	}
	else{
		$this->session->set_flashdata('errormsg', "Not authorised to access page. Please Login");
				redirect(base_url().'account/signin','refresh');
	}
	}
	

function change_hoardings_status($h_id ,$flag,$table_name='hoarding_ads') {
          $user_type = $this->session->userdata('user_type');
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 1 || $flag == 2) {

			$is_updated = $this->save_update_model->change_hoardings_status($h_id,$flag,$table_name);
			//print_r($this->db->last_query());
			//exit();
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', 'Hoarding Add '.$str.' successfully. ');
				redirect(base_url().'hoarding_ads/admin','refresh');
			}

            elseif($is_updated && $flag == 2  ) {


                if( $user_type =='admin'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Hoarding Add '.$str.' successfully. ');
				redirect(base_url().'hoarding_ads/admin','refresh');
                }

                elseif( $user_type =='owner'){
            	$str =  "Blocked";
				$this->session->set_flashdata('msg', 'Hoarding Add '.$str.' successfully. ');
				redirect(base_url().'hoarding_ads','refresh');
                }

            }

       }

			else{
				$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
			}
			redirect(base_url().'hoarding_ads/admin','refresh');
		

	}

	function delete_hoarding($h_id,$flag,$table_name='hoarding_ads') {
         $user_type = $this->session->userdata('user_type');
      
		
		//flag => 1 - activate, 2 - block, 3 - delete .
		if($flag == 3) {

			$is_deleted = $this->save_update_model->delete_hoardings($h_id,$flag,$table_name);			
			if($is_deleted  ) {

				if($user_type=='admin'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Hoarding '.$str.' successfully. ');
				redirect(base_url().'hoarding_ads/admin','refresh');
			    }
			    elseif($user_type=='owner'){
				$str =  "Deleted";
				$this->session->set_flashdata('msg', 'Hoarding '.$str.' successfully. ');
				redirect(base_url().'hoarding_ads','refresh');
			    }

			}     

       }

			else{
				//$this->session->set_flashdata('msg', 'Something went wrong please contact admin.');
				//redirect(base_url().'hoarding_ads','refresh');
		
			}
			

	}

	function _add_set_rules() {
		$this->form_validation->set_rules('h_name', 'Hoarding Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('h_price', 'Hoarding Price', 'numeric|xss_clean|required');
		$this->form_validation->set_rules('h_desc', 'Hoarding Description', 'trim|min_length[10]|xss_clean|required');
		$this->form_validation->set_rules('h_area', 'Hoarding Area', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('h_size', 'Hoarding Size', 'trim|xss_clean|required');
		$this->form_validation->set_rules('h_location', 'Hoarding Location', 'trim|xss_clean|required');
		$this->form_validation->set_rules('h_price', 'Hoarding Price', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('userfile', 'Hoarding Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
		$this->form_validation->set_rules('city_name', 'Hoarding City Name', 'trim|min_length[3]|xss_clean|required');
/*
		if (!empty($_FILES['apartment_img']['name'])) {
		    $this->form_validation->set_rules('apartment_img', 'Apartment Image', 'required|callback__verify_uploading_file_and_upload');
		}*/
	}

	function _edit_set_rules() {
		$this->form_validation->set_rules('h_name', 'Hoarding Name', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('h_price', 'Hoarding Price', 'numeric|xss_clean|required');
		$this->form_validation->set_rules('h_desc', 'Hoarding Description', 'trim|min_length[10]|xss_clean|required');
		$this->form_validation->set_rules('h_area', 'Hoarding Area', 'trim|min_length[3]|xss_clean|required');
		$this->form_validation->set_rules('h_size', 'Hoarding Size', 'trim|xss_clean|required');
		$this->form_validation->set_rules('h_location', 'Hoarding Location', 'trim|xss_clean|required');

		$this->form_validation->set_rules('h_price', 'Hoarding Price', 'trim|min_length[3]|xss_clean|required');
		if (!empty($_FILES['userfile']['name'])) {
		$this->form_validation->set_rules('userfile', 'Hoarding Image', 'trim|min_length[3]|xss_clean|callback__verify_uploading_file_and_upload');
		}
		$this->form_validation->set_rules('city_name', 'Hoarding City Name', 'trim|min_length[3]|xss_clean|required');

	}

	function _verify_uploading_file_and_upload() {		
		$config['upload_path'] =  'assets/uploads/hoarding_ads';
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