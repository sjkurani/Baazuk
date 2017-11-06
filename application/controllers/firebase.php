<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Firebase extends CI_Controller {

	function index() {
		//$this->load->library('curl');
		//$this->load->library('firebase');
	//	$this->firebase->setBaseURI(base_url());
		echo "<pre>";
		print_r($this);
		//print_r($this->curl->is_enabled());
		echo "string";
		//echo $this->firebase->test();
	}
}