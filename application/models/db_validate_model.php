<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/****
	* Check already exist or if any validation needs to be done 
	* through database, this model helps to do so.
	*
****/
class Db_validate_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function mail_exists($key) {
	    $this->db->where('user_email',$key);
	    $query = $this->db->get('user_account_details');
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

    function device_exists($key) {
	    $this->db->where('shop_device_id',$key);
	    $query = $this->db->get('shop_details');
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}
}