<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Saved_ads extends CI_Controller {
	
	public function __construct(){
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$user_type = $data['user_type'] = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		is_authenticated_user(array('buyer'));
		$data['saved_ads']['apartment'] = $this->get_data_model->get_apartment_saved_ads($user_id,$user_type);
		$data['saved_ads']['event'] = $this->get_data_model->get_event_saved_ads($user_id,$user_type);
		$data['saved_ads']['hoarding'] = $this->get_data_model->get_hoarding_saved_ads($user_id,$user_type);
		$data['saved_ads']['mall'] = $this->get_data_model->get_mall_saved_ads($user_id,$user_type);
		$data['saved_ads']['park'] = $this->get_data_model->get_park_saved_ads($user_id,$user_type);
        $data['saved_ads']['radio'] = $this->get_data_model->get_radio_saved_ads($user_id,$user_type); 
		$this->layouts->view('saved_ads/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	
	
}
