<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __construct()
	{
	    parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

	function index() {
		$this->layouts->set_title('Book4us');
		$this->layouts->set_description('Book4us');
		$data = array();

		$data['recomanded']['apartment'] = $this->get_data_model->recommanded_aprtments();
		$data['recomanded']['event'] = $this->get_data_model->recommanded_events();
		$data['recomanded']['mall'] = $this->get_data_model->recommanded_malls();
		$data['recomanded']['radio'] = $this->get_data_model->recommanded_radios();
		$data['recomanded']['hoarding'] = $this->get_data_model->recommanded_hoardings();
		$data['recomanded']['park'] = $this->get_data_model->recommanded_parks();
		
		$data['new']['buyer_details'] = $this->get_data_model->get_total_no_buyers();
		$data['new']['owner_details'] = $this->get_data_model->get_total_no_owners();
		$data['new']['enquiries'] = $this->get_data_model->get_total_no_enquiries();
		$data['options']['apartment_ads'] = $this->get_data_model->get_total_no_aptads();
		$data['options']['business_park_ads'] = $this->get_data_model->get_total_no_parkads();
		$data['options']['event_ads'] = $this->get_data_model->get_total_no_evntads();
		$data['options']['hoarding_ads'] = $this->get_data_model->get_total_no_hordingads();
		$data['options']['radio_ads'] = $this->get_data_model->get_total_no_radioads();
		$data['options']['mall_ads'] = $this->get_data_model->get_total_no_mallads();
		
		$data['options']['active_apartments'] = $this->get_data_model->get_total_active_apartments();
		$data['options']['active_events'] = $this->get_data_model->get_total_active_events();
		$data['options']['active_parks'] = $this->get_data_model->get_total_active_parks();
		$data['options']['active_mall'] = $this->get_data_model->get_total_active_mall();
		$data['options']['active_hoarding'] = $this->get_data_model->get_total_active_hoarding();
		$data['options']['active_radio'] = $this->get_data_model->get_total_active_radio();
			//print_r($data['options']['active_apartments']);
			//exit();
		if ($this->form_validation->run() == FALSE) {
			$data['hoardings_city_list'] = $this->get_data_model->get_city_list(1,'hoarding');
			/*echo "<pre>";
			print_r($data['hoardings_city_list']);
			echo "</pre>";
			exit();*/
			$data['apartments_city_list'] = $this->get_data_model->get_city_list(1,'hoarding');
			$data['events_city_list'] = $this->get_data_model->get_city_list(1,'event');
			$data['malls_city_list'] = $this->get_data_model->get_city_list(1,'mall');
			$data['parks_city_list'] = $this->get_data_model->get_city_list(1,'park');
			$data['radios_city_list'] = $this->get_data_model->get_city_list(1,'radio');
			$type='';
			$data['apartments_area_list'] = $this->get_data_model->get_area1_list(1,'apartments');
			//print_r($data['apartments_area_list']);
			//exit();
		//	$data['events_area_list'] = $this->get_data_model->get_city_list(1,'events');
		//	$data['malls_area_list'] = $this->get_data_model->get_city_list(1,'malls');
		//	$data['parks_area_list'] = $this->get_data_model->get_city_list(1,'parks');
		//	$data['hoardings_area_list'] = $this->get_data_model->get_city_list(1,'hoardings');
		//	$data['radios_area_list'] = $this->get_data_model->get_area1_list(1,'radios');
			
			$this->layouts->view('home/home_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			$this->layouts->view('home/home_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
		}
	}
	function search($form_name = 0) {
		$this->layouts->set_title('Book4us');
		$this->layouts->set_description('Book4us');
		$data = array();
		$data['posted_data'] = $this->input->post();
			$data['posted_data']['local_full_pickup_loc'] = "";
			$data['lat'] = 12.91;
			$data['lng'] = 77.60;

			$this->layouts->view('search/search_local_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}

	function malls($mall_id) {
		if($mall_id == 1) {
			$data['data']['mall_name'] = 'Orion mall';
			$data['data']['mall_id'] = 1;
			$data['data']['desc'] = "This is mall description about orion mall";

		}
		else if ($mall_id == 2) {
			$data['data']['mall_name'] = 'Mantri squre';
			$data['data']['mall_id'] = 2;
			$data['data']['desc'] = "This is mall description about Mantri squre mall";


		}
		else if ($mall_id == 3) {
			$data['data']['mall_name'] = 'Forum mall';
			$data['data']['mall_id'] = 3;
			$data['data']['desc'] = "This is mall description about Forum mall";


		}
		else if ($mall_id == 4) {
			$data['data']['mall_name'] = 'Central mall';
			$data['data']['mall_id'] = 4;
			$data['data']['desc'] = "This is mall description about Central mall";


		}
		$this->layouts->view('malls/malls_details_view.php', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
	}
} 