<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class V1 extends REST_Controller
{
	private $response_code = 201;
    function __construct()
    {
    	// = 200;
        parent::__construct();
    }
    function index_get() {
		$response = array('api_version' => '1.0', 'documentation' => base_url().'docs');
		$this->response($response,$this->response_code);
    }

	function shops_get() {
		$get_array = $this->get();
		$shop_device_id = isset($get_array['shop_device_id']) ? $get_array['shop_device_id']: 0 ;
		$arr = $this->get_data_model->get_shops($shop_device_id);
		$response = array('shops' => $arr);
		$this->response($response,$this->response_code);
	}

	function shops_post() {
		$post_array = json_decode(file_get_contents('php://input'), TRUE);
		log_message('error',print_r($post_array,TRUE));
		if(isset($post_array['user_email']) && isset($post_array['user_password']) && isset($post_array['user_mobile']) && isset($post_array['shop_device_id'])) {
			$post_array['user_password'] = $this->encrypt->encode($post_array['user_password']);
			$mail_exists = $this->db_validate_model->mail_exists($post_array['user_email']);
			if($post_array['shop_device_id'] == 0) {
				$post_array['has_device'] = 0;
				$device_exists = 0;
			}
			else {
				$device_exists = $this->db_validate_model->device_exists($post_array['shop_device_id']);
			}
			if($mail_exists) {
				$this->response_code = 200;
				$response =  array('success' => false, 'Msg' => 'Provided User Email Already Exist.');
			}
			else if($device_exists) {
				$this->response_code = 200;
				$response =  array('success' => false, 'Msg' => 'Device ID Already Exist.');
			}
			else {
				if($post_array['shop_device_id'] == 0) {
					$post_array['shop_device_id'] = $this->get_data_model->get_max_shop_id();
				}
				$shop_registered = $this->save_update_model->register_shop($post_array);
				if(is_array($shop_registered) && !empty($shop_registered)) {
					$this->response_code = 200;
					$response =  array('success' => true, 'Msg' => 'Registered.','DeviceId' =>$shop_registered['shopDeviceId'], 'UserId' =>$shop_registered['userId']);

					log_message('error',"Registraring Done Successfully.");
				}
				else {
					log_message('error',"Registraring Failed.");
					$this->response_code = 200;
					$response =  array('success' => false, 'Msg' => 'Failed to register New Shop.');
				}
			}
		}
		else {
			log_message('error',"Invalid Inputs.");
			$response =  array('success' => false, 'Msg' => 'Invalid Input.');
		}
		$this->response($response,$this->response_code);
	}
	function shops_put() {
		$post_array = json_decode(file_get_contents('php://input'), TRUE);
		
	}
}