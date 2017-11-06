<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {

		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$this->layouts->view('enquiry/enquiry_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		
	}


	function send()

	{
      $this->_add_set_rules();
      $data = array();
	  
		if ($this->form_validation->run() == FALSE) 
		{
			$this->layouts->view('enquiry/enquiry_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}

        else 
        {
			//Save and redirect..
			$data = $this->input->post();
            print_r($data);
			$user_id = $this->session->userdata('user_id');
			$user_type = $this->session->userdata('user_type');
			$data['apartment_id'] =  $this->uri->segment(3);
			

			$inputs_array = array(     'ad_id' => $data['apartment_id'], 
				                       'ad_type' => $data['add_type'],
				                      //'buyer_id' =>$data['buyer_id'],
				                       
				                       'buyer_id' =>$user_id,
									   'enquiry_desc' =>$data['enquiry_desc']
									  );
			
			$inserted_enquiry_id = $this->save_update_model->save_enquiry($inputs_array);

         if($inserted_enquiry_id) {
				$this->session->set_flashdata('msg', "Enquiry sent successfully..");
				//redirect(base_url().'enquiry/send','refresh');			
			}
			else {
				$this->session->set_flashdata('errormsg', "Something went wrong please contact admin.");
				//redirect(base_url().'enquiry/send','refresh');
			}
			
		}


	}


	function _add_set_rules() {
		$this->form_validation->set_rules('add_type', ' Add Type', 'trim|required');
		$this->form_validation->set_rules('enquiry_desc', ' Enquiry Description', 'trim|required');
		
	}




	
}
