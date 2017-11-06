<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		redirect('account/signin','refresh');
	}

	function buyer() {
		$data = array();
		is_authenticated_user(array('buyer'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type')));
		$this->layouts->view('dashboard/buyer_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
	
	function owner() {

		$data = array();
		is_authenticated_user(array('owner'));
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type')));
		$this->layouts->view('dashboard/owner_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
	}
	
	function admin() {
		$data = array();
		is_authenticated_user(array('admin'));
			$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type')));
			$this->layouts->view('dashboard/admin_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,true);
		
	}
}

