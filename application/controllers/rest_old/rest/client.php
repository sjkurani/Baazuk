<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends  CI_Controller{

		private $username='admin';		
		private $password='1234';

    function index(){
        echo function_exists('curl_version');
    }

    function mobile_verify() {

        $this->load->library('curl');
         
        $this->curl->create('http://localhost/Public/AIMS/prjct/rest/api/member_register/format/json');
        
	    // Optional, delete this line if your API is open
	    $this->curl->http_login($this->username, $this->password);

        $post_array = array(
            'mobile' => 7899452456
        );

        $this->curl->post($post_array);
         
        $result = $this->curl->execute();//json_decode($this->curl->execute());
        print_r($result);
    }
    function member_register() {
        $this->load->library('curl');
         
        $this->curl->create('http://localhost/Public/AIMS/prjct/rest/api/mobile/format/json');
        
	    // Optional, delete this line if your API is open
	    $this->curl->http_login($this->username, $this->password);

        $post_array = array(
            'fname' => 'abc',
            'sname' => 'xyz',
            'dob' => '30-08-1990',
            'gender' => 'male',
            'inst1' => 'inst1',
            'course1' => 'course1',
            'year1' => 2000,
            'inst2' => 'institution1',
            'course2' => 'crs2',
            'year2' => 1000,
            'inst3' => 'institution3',
            'course3' => 'course3',
            'year3' => 1000,
            'hqualification' => 'hqualification',
            'profession' => 'profession',
            'special' => 'special',
            'cwork' => 'cwork',
            'mobile' => 'mobile',
            'email' => 'email',
            'altnumber' => 'altnumber',

            'cur_address' => 'cur_address',
            'cur_pincode' => 560220,
            'cur_country' => 'india',
            'cur_state' => 'karnataka',
            'cur_district' => 'belguam',
            'cur_city' => 'bangalore',
            'cb2' => 1,
            'per_address' => 'per_address',
            'per_pincode' => 'per_pincode',
            'per_country' => 'per_country',
            'per_state_d' => 'per_state_d',
            'per_district_d' => 'per_district_d',
            'per_city' => 'per_city',
            'seva_dal' => 'seva_dal',
            'bal_vikas' => 'bal_vikas',
            'yuva_vrinda' => 'yuva_vrinda',
            'seva_vrinda' => 'seva_vrinda',
            'local_sai_samithi' => 'local_sai_samithi',
            'staff' => 'staff',
            'student2student' => 'student_student',
            'alumni_activities' => 'alumni_activities',
            'seva_activities' => 'seva_activities'
        );
        
        $this->curl->post($post_array);
         
        $result = $this->curl->execute();//json_decode($this->curl->execute());
        print_r($result);
    }


    function member_update($member_id = 0) {
        $this->load->library('curl');
         
        $this->curl->create('http://localhost/Public/AIMS/prjct/rest/api/update/format/json');
        
	    // Optional, delete this line if your API is open
	    $this->curl->http_login($this->username, $this->password);

        $post_array = array(
        	'member_id' => $member_id,
            'fname' => 'abscs',
            'sname' => 'xyz',
            'dob' => '30-08-1990',
            'gender' => 'male',
            'inst1' => 'inst1',
            'course1' => 'course1',
            'year1' => 2000,
            'inst2' => 'institution1',
            'course2' => 'crs2',
            'year2' => 1000,
            'inst3' => 'institution3',
            'course3' => 'course3',
            'year3' => 1000,
            'hqualification' => 'hqualification',
            'profession' => 'profession',
            'special' => 'special',
            'cwork' => 'cwork',
            'mobile' => 'mobile',
            'email' => 'email',
            'altnumber' => 'altnumber',

            'cur_address' => 'cur_address',
            'cur_pincode' => 560220,
            'cur_country' => 'india',
            'cur_state' => 'karnataka',
            'cur_district' => 'belguam',
            'cur_city' => 'bangalore',
            'cb2' => 1,
            'per_address' => 'per_address',
            'per_pincode' => 'per_pincode',
            'per_country' => 'per_country',
            'per_state_d' => 'per_state_d',
            'per_district_d' => 'per_district_d',
            'per_city' => 'per_city',
            'seva_dal' => 'seva_dal',
            'bal_vikas' => 'bal_vikas',
            'yuva_vrinda' => 'yuva_vrinda',
            'seva_vrinda' => 'seva_vrinda',
            'local_sai_samithi' => 'local_sai_samithi',
            'staff' => 'staff',
            'student2student' => 'student_student',
            'alumni_activities' => 'alumni_activities',
            'seva_activities' => 'seva_activities'
        );
        $this->curl->post($post_array);
         
        $result = $this->curl->execute();//json_decode($this->curl->execute());
        print_r($result);
    }
    function member_quick_search() {	
        $this->load->library('curl');
         
        $this->curl->create('http://localhost/Public/AIMS/prjct/rest/api/quicksearch/format/json');
        
	    // Optional, delete this line if your API is open
	    $this->curl->http_login($this->username, $this->password);

        $post_array = array(
            'limit' => 5,
            'start' => 0,
            'order_column' => '',
            'order_type' => '',
            'quicksearch' => '9008681393'
        );        
        $this->curl->post($post_array);

        $result = $this->curl->execute();//json_decode($this->curl->execute());
        print_r($result);
    }

    function member_search() {
        $this->load->library('curl');
         
        $this->curl->create('http://localhost/Public/AIMS/prjct/rest/api/search/format/json');
        
	    // Optional, delete this line if your API is open
	    $this->curl->http_login($this->username, $this->password);

        $this->curl->post(array(
            'name' => "rahulqq",
            'year_of_passing' => 2016,
            'limit' => 100,
            'start' => 0

        ));
        $result = $this->curl->execute();//json_decode($this->curl->execute());
        print_r($result);
    }

}
