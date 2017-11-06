<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}

	function index() {

	}
	function apartments() {
		$data = array();
		$data['apartments_list'] = $this->get_data_model->get_apartment_details(0,1,20);
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);		
	}
	function malls($city,$area) {
		$data = array();
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
	function events($city,$area) {
		$data = array();
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
	function parks($city,$area) {
		$data = array();
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
	function radios($city,$area) {
		$data = array();
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
	function hoardings($city,$area) {
		$data = array();
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
	function ads($city,$area) {
		$data = array();
		$this->layouts->view('search/apartment_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);		
	}
}