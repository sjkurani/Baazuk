<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

	function index() {
		$max = $this->get_data_model->get_max_shop_id();
		print_r($max);
	}
	function fb() {
		$this->load->view('fb_view');
	}
	function map($latlng) {
		$geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=12.9268702,77.6079059&sensor=false');

        $output= json_decode($geocode);

    		for($j=0;$j<count($output->results[0]->address_components);$j++){
                echo '<b>'.$output->results[0]->address_components[$j]->types[0].': </b>  '.$output->results[0]->address_components[$j]->long_name.'<br/>';
            }
	}
}