<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
		$this->load->library('pagination');
	}
	function index() {

	}
	/*function get_city() {
		if($this->input->is_ajax_request()){
		    if (isset($_GET['term'])){
	      		$q = strtolower($_GET['term']);
	      		$returned_array = $this->get_data_model->get_categories($q);
			echo $returned_array;
		    }
 		}
 		else {
 			redirect(base_url(),"refresh");
 		}
	}*/

	function get_areas() {
		if($this->input->is_ajax_request()){
		    if (isset($_GET['term'])){
	      		$q = strtolower($_GET['term']);
	      		$media_type = strtolower($_GET['media_type']);
	      		$returned_array = $this->get_data_model->get_areas_list($q,$media_type);
	      		echo $returned_array;
		    }
 		}
 		else {
 			redirect(base_url(),"refresh");
 		}
	}
	function get_city() {
		if($this->input->is_ajax_request()){
		    if (isset($_GET['term'])){
	      		$q = strtolower($_GET['term']);
	      		$media_type = strtolower($_GET['media_type']);
	      		$returned_array = $this->get_data_model->get_citys_list($q,$media_type);
	      		echo $returned_array;
		    }
		   
 		}
 		else {
 			redirect(base_url(),"refresh");
 		}
	}

}