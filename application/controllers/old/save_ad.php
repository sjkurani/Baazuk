<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Save_ad extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() 
	{
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin','owner'));
		$user_type = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
	}
	
	function save($ad_id, $media_type, $media_type_id) {      
		$user_type = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		$data = array();
		$inputs_array =array(
			"ad_type" => $media_type,		
			"ad_id" => $ad_id,
			"media_type_id" => $media_type_id,
			"user_id" => $user_id
		);
		$inserted_id = $this->save_update_model->save_ad($inputs_array);

		if($inserted_id) {
			if ($this->agent->is_referral())
			{
				$this->session->set_flashdata('msg', "Ad Saved successfully..");
			    redirect($this->agent->referrer(),'refresh');
			}
			//redirect(base_url().'dashboard/'.$user_type,'refresh');			
		}
		else {
			$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
			redirect(base_url().'apartments/show','refresh');
		}
	}	
}
