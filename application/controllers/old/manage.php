<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		//dashboard route to dashboard
		echo "string";
	}
	function dashboard() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$this->layouts->view('owner/manage/dashboard_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);

	}
	function ads() {

	}
	function malls() {

	}
	function radio() {

	}
	function events() {

	}
	function apartments() {
		
	}
}