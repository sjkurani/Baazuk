<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terms extends CI_Controller {

	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$data = array();
		is_authenticated_user(array('admin'));

		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'Terms and Conditions' => ''));

		$owner_id = $this->session->userdata('user_id');

		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|xss_clean');
		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|xss_clean');
		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|xss_clean');
		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|xss_clean');
		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|xss_clean');
		$this->form_validation->set_rules('hoarding_title', 'Hoarding Title', 'trim|xss_clean');

		$data['all_terms_and_condns'] = $this->get_data_model->get_all_terms_and_condn();
		if ($this->form_validation->run() == FALSE) {			
			$this->layouts->view('terms_condin/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$post_array = array(array('id' => 1, 'text' => $this->input->post('apartment'),'media_type' => 'apartment'),
									array('id' => 2, 'text' => $this->input->post('event'),'media_type' => 'event'),
									array('id' => 3, 'text' => $this->input->post('radio'),'media_type' => 'radio'),
									array('id' => 4, 'text' => $this->input->post('park'),'media_type' => 'park'),
									array('id' => 5, 'text' => $this->input->post('mall'),'media_type' => 'mall'),
									array('id' => 6, 'text' => $this->input->post('hoarding'),'media_type' => 'hoarding'));
			$is_terms_saved = $this->save_update_model->save_tc($post_array);
			$this->session->set_flashdata('msg', "Terms and Conditions updated successfully.");
			redirect(base_url(uri_string()));
		}
	
	}
}

?>