<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ads extends CI_Controller {
	
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
		is_authenticated_user(array('owner'));
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/ads/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function saved() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data = array();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('owner/ads/add_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}
}