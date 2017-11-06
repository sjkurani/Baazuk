<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    function v1_get() {
		$response = array('api_version' => '1.0', 'docs' => base_url().'docs');
		$this->response($response,200);
    }

	function index() {
		echo "string";
	}

	function shop_register1_get() {
		$arr = $this->get();
		$response = array('msg' => $arr);
		$this->response($response,200);
	}

	function shop_register1_post() {
		//email,mobile,password,shop_device_id,lat_lng
			$post_array = $_REQUEST;//$this->request();
			$response = array('msg' => $post_array);
			$this->response($response,200);
			exit();
	}

	function shop_register_put() {
		//email,mobile,password,shop_device_id,lat_lng
			$post_array = $_REQUEST;//$this->request();
			$response = array('msg' => $params);
			$this->response($response,200);
			exit();
	}

	function shop_register_post() {
		//email,mobile,password,shop_device_id,lat_lng

       $params = $_POST;//json_decode($this, TRUE);
		//$post_array = $this->post();
			$response = array('msg' => $params);
			$this->response($response,200);
			exit();
    	$this->load->model('save_update_model');
		$post_array = $this->post();
		//$post_array['user_password'] = $this->encrypt->encode($post_array['user_password']);
		if(isset($post_array['user_email']) && isset($post_array['user_password']) && isset($post_array['user_mobile'])) {
			$this->save_update_model->save_user($post_array['user_email'],$post_array['user_mobile'],$post_array['user_password']);
			$response = array('msg' => "User Created successfully");
			$this->response($response,200);
		}
		else {
			$ar = $this->post('user_mobile');
			$response = array('msg' => $ar);
			$this->response($response,200);
		}
/*		if($this->post('user_email')) {

		}
		if($this->post(''))
		$response = array('msg' => "success2");
		$this->response($response,200);*/
	}

	//Check whether user mobile already avilable or not.
	function member_register_post() {
		$this->load->model('student_aproval_model');		
		$get_result1 = $this->student_aproval_model->check_mobile_availablity($this->post('mobile'));
		$get_result2 = $this->student_aproval_model->check_mobile_availablity1($this->post('mobile'));
		$posted_mobile_number = $this->post('mobile');
		if(!empty($posted_mobile_number)) {
			if(!$get_result1 || !$get_result2) {
				//Mobile Number already registered, please contact admin.
				$response = array('action' => 'mobile_verify','mobile' => $this->post('mobile'),'status' => 'error', 'msg' => 'Hi, this number already registered, please contact info@childrenofsathyasai.org.');
			}
			else {				
				//Mobile Number not exist please register.
				$response = array('action' => 'mobile_verify','mobile' => $this->post('mobile'),'status' => 'success', 'msg' => 'Welcome! Please continue with the registration...');
			}
		}
		else {
			$response = array('action' => 'mobile_verify','mobile' => "",'status' => 'error', 'msg' => 'Mobile Number Required');
		}
        $this->response($response, 200); // Sending response with HTTP response code 200 - OK.
    }

    //User register with valid new mobile number.
    function mobile_post() {
		$this->load->model('student_aproval_model');
		$person_array = array();
		$person_array['firstname'] = $this->post('fname');
		$person_array['surname'] = $this->post('sname');
		$person_array['dob'] = $this->post('dob');
		$person_array['gender'] = $this->post('gender');

		$person_array['institution1'] = $this->post('inst1');
		$person_array['course1'] = $this->post('course1');
		$person_array['year_of_passing1'] = $this->post('year1');
		$person_array['institution2'] = $this->post('inst2');
		$person_array['course2'] = $this->post('course2');
		$person_array['year_of_passing2'] = $this->post('year2');
		$person_array['institution3'] = $this->post('inst3');
		$person_array['course3'] = $this->post('course3');
		$person_array['year_of_passing3'] = $this->post('year3');

		$person_array['highest_qualification'] = $this->post('hqualification');
		$person_array['profession'] = $this->post('profession');
		$person_array['specialization'] = $this->post('special');
		$person_array['currently_working'] = $this->post('cwork');
		$person_array['mobile'] = $this->post('mobile');
		$person_array['email'] = $this->post('email');
		$person_array['alternate_num'] = $this->post('altnumber');

		$person_array['cur_address'] = $this->post('cur_address');
		$person_array['cur_pincode'] = $this->post('cur_pincode');
		$person_array['cur_country'] = $this->post('cur_country');
		$person_array['cur_state'] = $this->post('cur_state');
		$person_array['cur_district'] = $this->post('cur_district');
		$person_array['cur_city'] = $this->post('cur_city');
		$person_array['same_address'] = $this->post('cb2');

		$person_array['per_address'] = $this->post('per_address');
		$person_array['per_pincode'] = $this->post('per_pincode');
		$person_array['per_country'] = $this->post('per_country');
		$person_array['per_state'] = $this->post('per_state_d');
		$person_array['per_district'] = $this->post('per_district_d');
		$person_array['per_city'] = $this->post('per_city');
		$person_array['seva_dal'] = $this->post('seva_dal');
		$person_array['bal_vikas'] = $this->post('bal_vikas');
		$person_array['yuva_vrinda'] = $this->post('yuva_vrinda');
		$person_array['seva_vrinda'] = $this->post('seva_vrinda');
		$person_array['local_sai_samithi'] = $this->post('local_sai_samithi');
		$person_array['staff'] = $this->post('staff');
		$person_array['student_student'] = $this->post('student2student');
		$person_array['alumni_activities'] = $this->post('alumni_activities');
		$person_array['seva_activities'] = $this->post('seva_activities');

		// call insert query.
		$returned_flag = $this->student_aproval_model->save($person_array);
		if($returned_flag) {
			$response = array('action' => "member_register",'status' => 'success', 'msg' => 'Registration is successfull...', 'inserted_id' =>$returned_flag);
		}
		else {
			$response = array('action' => "member_register",'status' => 'error', 'msg' => 'Something wrong happened. Could not able to register new account');

		}
		$this->response($response, 200); // Sending response with HTTP response code 200 - OK.
    }

    //update member data.
    function update_post() {
    	if($this->post('member_id') != 0 ) {
			$this->load->model('student_details_model');
			$person_array = array();
			$person_array['firstname'] = $this->post('fname');
			$person_array['surname'] = $this->post('sname');
			$person_array['dob'] = $this->post('dob');
			$person_array['gender'] = $this->post('gender');

			$person_array['institution1'] = $this->post('inst1');
			$person_array['course1'] = $this->post('course1');
			$person_array['year_of_passing1'] = $this->post('year1');
			$person_array['institution2'] = $this->post('inst2');
			$person_array['course2'] = $this->post('course2');
			$person_array['year_of_passing2'] = $this->post('year2');
			$person_array['institution3'] = $this->post('inst3');
			$person_array['course3'] = $this->post('course3');
			$person_array['year_of_passing3'] = $this->post('year3');

			$person_array['highest_qualification'] = $this->post('hqualification');
			$person_array['profession'] = $this->post('profession');
			$person_array['specialization'] = $this->post('special');
			$person_array['currently_working'] = $this->post('cwork');
			$person_array['mobile'] = $this->post('mobile');
			$person_array['email'] = $this->post('email');
			$person_array['alternate_num'] = $this->post('altnumber');

			$person_array['cur_address'] = $this->post('cur_address');
			$person_array['cur_pincode'] = $this->post('cur_pincode');
			$person_array['cur_country'] = $this->post('cur_country');
			$person_array['cur_state'] = $this->post('cur_state');
			$person_array['cur_district'] = $this->post('cur_district');
			$person_array['cur_city'] = $this->post('cur_city');
			$person_array['same_address'] = $this->post('cb2');

			$person_array['per_address'] = $this->post('per_address');
			$person_array['per_pincode'] = $this->post('per_pincode');
			$person_array['per_country'] = $this->post('per_country');
			$person_array['per_state'] = $this->post('per_state_d');
			$person_array['per_district'] = $this->post('per_district_d');
			$person_array['per_city'] = $this->post('per_city');
			$person_array['seva_dal'] = $this->post('seva_dal');
			$person_array['bal_vikas'] = $this->post('bal_vikas');
			$person_array['yuva_vrinda'] = $this->post('yuva_vrinda');
			$person_array['seva_vrinda'] = $this->post('seva_vrinda');
			$person_array['local_sai_samithi'] = $this->post('local_sai_samithi');
			$person_array['staff'] = $this->post('staff');
			$person_array['student_student'] = $this->post('student2student');
			$person_array['alumni_activities'] = $this->post('alumni_activities');
			$person_array['seva_activities'] = $this->post('seva_activities');

			// call insert query.
			$returned_flag = $this->student_details_model->update($this->post('member_id'),$person_array);
			
			if($returned_flag) {
				$response = array('action' => "member_update",'status' => 'success', 'msg' => 'Updation done successfully...', 'updated_id' =>$this->post('member_id'));
			}
			else {
				$response = array('action' => "member_update",'status' => 'error', 'msg' => 'Nothing to update');
			}
    	}
    	else {
			$response = array('action' => "member_update",'status' => 'error', 'msg' => 'Please provide member ID.');
    	}
    	$this->response($response, 200); // Sending response with HTTP response code 200 - OK.
    }

    //Student quick Search
    function quicksearch_post() {
		$this->load->model('student_search_model');
		$limit = $this->post('limit');
		$page = $this->post('start');
		$order_column = $this->post('order_column');
		$order_type = $this->post('order_type');
		$quicksearch = $this->post('quicksearch');
		if(!empty($quicksearch)) {
			$result = $this->student_search_model->quick_search($limit, $page, $order_column, $order_type,$quicksearch);
			if($result != 0 ) {
				$response = $result;
				$response = array('action' => "quicksearch",'status' => 'success', 'data' => $result);
			}
			else {
				$response = array('action' => "quicksearch",'status' => 'error', 'msg' => 'No record found');			
			}
		}
		else {
			$response = array('action' => "quicksearch",'status' => 'error', 'msg' => 'Mobile Number or email Required');			
		}
		$this->response($response, 200); // Sending response with HTTP response code 200 - OK.
    }

    //Student filter with all the parameters.
    function search_post() {
		$this->load->model('student_search_model');
		$name = $this->post('name');
		$name = empty($name) ? '#': $name;
		$state = $this->post('state');
		$state = empty($state) ? '#': $state;
		$district = $this->post('district');
		$district = empty($district) ? '#': $district;
		$year_of_passing = $this->post('year_of_passing');
		$year_of_passing = empty($year_of_passing) ? '#': $year_of_passing;
		$course_studied = $this->post('course_studied');
		$course_studied = empty($course_studied) ? '#': $course_studied;
		$institution = $this->post('institution');
		$institution = empty($institution) ? '#': $institution;
		$profession = $this->post('profession');
		$profession = empty($profession) ? '#': $profession;
		$limit = $this->post('limit');
		$start = $this->post('start');
		if(!empty($name) || !empty($state) || !empty($district) || !empty($year_of_passing) || !empty($course_studied) || !empty($institution) || !empty($profession)) {

			$result = $this->student_search_model->search($name,$state,$district,$year_of_passing,$course_studied,$institution,$profession,$limit,$start);
			if($result != 0 ) {
				$response = array('action' => "search",'status' => 'success', 'data' => $result);
			}
			else {
				$response = array('action' => "search",'status' => 'error', 'msg' => 'No record found');		
			}			
		}
		else {
			$response = array('action' => "search",'status' => 'error', 'msg' => 'No input provided');			
		}
		$this->response($response, 200); // Sending response with HTTP response code 200 - OK.
    }
}