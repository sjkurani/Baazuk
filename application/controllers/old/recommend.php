<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recommend extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$data = array();
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		is_authenticated_user(array('admin'));
		$user_type = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');

	}

	
	function save_rec_media($media_type = '', $id=0) {
      
       $user_type = $this->session->userdata('user_type');
       $user_id = $this->session->userdata('user_id');
		
		if($id == 0 ||  $media_type == '' ) {

		}

        else {
        $data = array();
			$inputs_array =array(
							"media_id" => $id,
							"media_type" => $media_type		
							);
               $inserted_id = $this->save_update_model->save_recommended_media($inputs_array);
               if($inserted_id) {
				$this->session->set_flashdata('msg', "Added to Recommeneded list successfully..");
				redirect(base_url().'dashboard/'.$user_type,'refresh');			
			}
			else {
				//$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				//redirect(base_url().'apartments/show','refresh');
			}

             }

		  }

      
		

	
	
}
