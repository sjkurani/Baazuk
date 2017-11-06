<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_data_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function get_max_shop_id() {
    	$SQL = "SHOW TABLE STATUS LIKE 'shop_details'";
    	$query = $this->db->query($SQL);
	    return $query->row()->Auto_increment;
    }

    function get_shops($shop_id = 0) {
    	if($shop_id != 0){
	    	$query = $this->db->get_where('shop_details', array('shop_device_id' => $shop_id,'flag' => 1));
	    	return $query->result();
	    }
	    else {
	    	$query = $this->db->get_where('shop_details', array('flag' => 1));
	    	return $query->result();	    	
	    }
    }
    function get_shop() {

    }
}