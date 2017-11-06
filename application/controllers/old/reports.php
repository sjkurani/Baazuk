<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
	}

    function index() {
        
    }
	function apartments() {
		$data = array();
        
     is_authenticated_user(array('admin'));
     
         $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),' Apartments Reports' => ''));

		$this->layouts->view('reports/apartments_report_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
        
	}
	function apartment_ajax_list() {		
		$this->load->model('apartment_report_model');
        $list = $this->apartment_report_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $apartments) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $apartments->a_id;
            $row[] = $apartments->a_name;
            $row[] = $apartments->a_cityname;
            $row[] = $apartments->a_area;
            $row[] = $apartments->a_category;
            $row[] = $apartments->type_of_aprtment;
            $row[] = $apartments->num_of_flats;
            
            

        	if($apartments->flag == 1) $status = 'Active';
        	else if($apartments->flag == 2) $status = 'Blocked';
        	else if($apartments->flag == 0) $status = 'Pending';
        	
            $row[] = $status;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->apartment_report_model->count_all(),
                        "recordsFiltered" => $this->apartment_report_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

function events() {
        $data = array();

   is_authenticated_user(array('admin'));
         $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),' Events Reports' => ''));
        $this->layouts->view('reports/events_report_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
          
    }
    function event_ajax_list() {        
        $this->load->model('event_report_model');
        $list = $this->event_report_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $events) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $events->event_id;
            $row[] = $events->event_name;
            $row[] = $events->event_area;
            $row[] = $events->event_type;
    
            if($events->flag == 1) $status = 'Active';
            else if($events->flag == 2) $status = 'Blocked';
            else if($events->flag == 0) $status = 'Pending';
            
            $row[] = $status;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->event_report_model->count_all(),
                        "recordsFiltered" => $this->event_report_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


	function hoardings() {
        $data = array();

    
        is_authenticated_user(array('admin'));
         $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),' Hoardings Reports' => ''));
        $this->layouts->view('reports/hoarding_report_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
   
    }
    function hoarding_ajax_list() {        
        $this->load->model('hoarding_report_model');
        $list = $this->hoarding_report_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hoardings) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $hoardings->h_id;
            $row[] = $hoardings->h_title;
            $row[] = $hoardings->h_cityname;
            $row[] = $hoardings->h_size;
            $row[] = $hoardings->price;
    
    
            if($hoardings->flag == 1) $status = 'Active';
            else if($hoardings->flag == 2) $status = 'Blocked';
            else if($hoardings->flag == 0) $status = 'Pending';
            
            $row[] = $status;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->hoarding_report_model->count_all(),
                        "recordsFiltered" => $this->hoarding_report_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	
	
	
	
function malls() {
        $data = array();

        is_authenticated_user(array('admin'));
         $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),' Malls Reports' => ''));
        $this->layouts->view('reports/malls_report_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
      
    }
    function mall_ajax_list() {        
        $this->load->model('mall_report_model');
        $list = $this->mall_report_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $malls) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $malls->mall_id;
            $row[] = $malls->mall_name;
            $row[] = $malls->mall_location_name;
            
    
            if($malls->flag == 1) $status = 'Active';
            else if($malls->flag == 2) $status = 'Blocked';
            else if($malls->flag == 0) $status = 'Pending';
            
            $row[] = $status;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mall_report_model->count_all(),
                        "recordsFiltered" => $this->mall_report_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

function parks() {
        $data = array();
         is_authenticated_user(array('admin'));
        
        $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),' Business parks Reports' => ''));

        $this->layouts->view('reports/parks_report_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
         
    }
    function park_ajax_list() {        
        $this->load->model('park_report_model');
        $list = $this->park_report_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $parks) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $parks->park_id;
            $row[] = $parks->park_name;
            $row[] = $parks->park_cityname;
            $row[] = $parks->employee_strenght;
            
    
            if($parks->flag == 1) $status = 'Active';
            else if($parks->flag == 2) $status = 'Blocked';
            else if($parks->flag == 0) $status = 'Pending';
            
            $row[] = $status;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->park_report_model->count_all(),
                        "recordsFiltered" => $this->park_report_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

function radios() {
        $data = array();

         is_authenticated_user(array('admin'));
          $this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'),' Radios Reports' => ''));
        $this->layouts->view('reports/radios_report_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
      
    }
    function radio_ajax_list() {        
        $this->load->model('radio_report_model');
        $list = $this->radio_report_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $radios) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $radios->radio_station_id;
            $row[] = $radios->radio_station_name;
            $row[] = $radios->radio_station_city;
           
            
    
            if($radios->flag == 1) $status = 'Active';
            else if($radios->flag == 2) $status = 'Blocked';
            else if($radios->flag == 0) $status = 'Pending';
            
            $row[] = $status;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->radio_report_model->count_all(),
                        "recordsFiltered" => $this->radio_report_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}