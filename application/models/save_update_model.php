<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class save_update_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
	 * Register Shop
	 *
	 * This function returns the response code with a msg.
	 * @param input_array (email,mobile,password,shop_device_id,lat_lng)
	 * @access	public
	 * @return	response 1 on success else 0.
	 */
    function register_shop($input_array){
        $has_device = (isset($input_array['has_device']) && $input_array['has_device'] == 0) ? 0 : 1;
    	$user_reg_id = $this->save_user($input_array['user_email'], $input_array['user_mobile'], $input_array['user_password']);
    	$shop_reg_id = $this->save_shop_basic($input_array['shop_device_id'], $input_array['lat_lng'], $has_device);
    	$is_shop_created = 0;
    	if($user_reg_id && $shop_reg_id) {
    	   	$user_shops = $this->save_user_shops($user_reg_id,$shop_reg_id);
    	   	if($user_shops){
    	   		$is_shop_created = array('status' => TRUE, 'shopDeviceId' => $shop_reg_id, 'userId' => $user_reg_id);
    	   	}
    	}
    	return $is_shop_created;
    }
    function save_user($email, $mobile, $password) {
          $this->db->insert('user_account_details', array('user_email' => $email, 'user_mobile' => $mobile,'user_nickname'=>$password, 'user_created' => date('Y-m-d h:i:s')));
          return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_shop_basic($shop_device_id,$lat_lng,$has_device) {
		$this->db->insert('shop_details', array('shop_device_id' => $shop_device_id, 'shop_lat_lng' => $lat_lng, 'has_device' => $has_device, 'shop_created' => date('Y-m-d h:i:s')));
		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

    }
    function save_user_shops($user_reg_id,$shop_reg_id) {
		$this->db->insert('user_shops', array('user_id' => $user_reg_id, 'shop_id' => $shop_reg_id));
		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
}