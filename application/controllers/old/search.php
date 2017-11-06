<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	LoadCssAndJs($this->layouts);
		$this->load->model('search_data_model');
		$this->load->library('pagination');
		$this->load->library('session');
		
	}

	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		$data = array();
		if($this->form_validation->run() == FALSE) {
			//$this->layouts->view('search/search_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//$this->layouts->view('search/search_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);
			//Save and redirect..
		}
	}
	
	function show(){
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('This is just a test description.');
		//echo "welcome";
		$data = array();
		$table=$this->input->get('media_type');
		$city=$this->input->get('city');
		$area=$this->input->get('area');
		if($area == '0') $area = '';
		if($this->input->get('title'))
			$title=$this->input->get('title');
	    else
			$title="";
		$data['table']=$table;
		$data['city']=$city;
		$data['title']=$title;
		$data['area']=$area;
		$data['city_val'] = $this->input->get('city_val');
		$data['media_type'] = $this->input->get('media_type');
		if($data['city_val']  == '0' && $data['media_type'] != 'radios') {
			$city = '';
			$data['city']= '';
		}
		$data['list']['data']=array();
		
		if($table=="apartments"){
		
			    //Pagination starts here
			    $config = array();
				$total_row=count($this->search_data_model->get_total_apartments($city,$area,$title));			
				$config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'search/show/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=3;
				$config['per_page'] = 10;
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				
			    $limit=$config['per_page'];
                $offset=$this->uri->segment(3);
				$data['list']['data']=$this->search_data_model->get_search_apartments($city,$area,$title,$limit,$offset);
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			    //print_r($data);
			    $this->layouts->set_breadcrumb_array(array('<span class=""></span>' => base_url(),'Home' => base_url(), 'Show Apartments' => ''));
			    $this->layouts->view('search/show_apartments', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
	
		}
		else if($table=="events"){
		
			    $config = array();
				$total_row=count($this->search_data_model->get_total_events($city,$area,$title));			
				$config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'search/show/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=3;
				$config['per_page'] = 10;
			    $limit=$config['per_page'];
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
                $offset=$this->uri->segment(3);
				$data['list']['data']=$this->search_data_model->get_search_events($city,$area,$title,$limit,$offset);
				/*echo "<pre>";
				print_r($data['list']['data']);
				echo "</pre>";*/
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
				
					
				$this->layouts->set_breadcrumb_array(array('<span class=""></span>' => base_url(),'Home' => base_url(), 'Show Events And Exhibition' => ''));	
            
			    //print_r($data);
			    $this->layouts->view('search/show_events', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		
		else if($table=="malls"){
		
			    $config = array();
				$total_row=count($this->search_data_model->get_total_malls($city,$area,$title));			
				$config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'search/show/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=3;
				$config['per_page'] = 10;
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
			    $limit=$config['per_page'];
                $offset=$this->uri->segment(3);
				$data['list']['data']=$this->search_data_model->get_search_malls($city,$area,$title,$limit,$offset);
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			    //print_r($data);
			    $this->layouts->set_breadcrumb_array(array('<span class=""></span>' => base_url(),'Home' => base_url(), 'Show Malls' => ''));
			    $this->layouts->view('search/show_malls', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		
		else if($table=="radios"){ 
		     
            	$config = array();
				$total_row=count($this->search_data_model->get_total_radios($city,$title));			
				$config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'search/show/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=3;
				$config['per_page'] = 10;
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				$limit=$config['per_page'];
                $offset=$this->uri->segment(3);
				$data['list']['data']=$this->search_data_model->get_search_radios($city,$title,$limit,$offset);
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			    // print_r($data);
			    $this->layouts->set_breadcrumb_array(array('<span class=""></span>' => base_url(),'Home' => base_url(), 'Show Radio Station' => ''));
			    $this->layouts->view('search/show_radios', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	

		}
		
		else if($table=="hoardings"){
		
			    $config = array();
				$total_row=count($this->search_data_model->get_total_hoardings($city,$area,$title));			
				$config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'search/show/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=3;
				$config['per_page'] = 10;
			    $limit=$config['per_page'];
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
                $offset=$this->uri->segment(3);
				$data['list']['data']=$this->search_data_model->get_search_hoardings($city,$area,$title,$limit,$offset);
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			    //print_r($data);
			    $this->layouts->set_breadcrumb_array(array('<span class=""></span>' => base_url(),'Home' => base_url(), 'Show Hoardings' => ''));
			    $this->layouts->view('search/show_hoardings', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		
		else if($table=="parks")
		{
			    $config = array();
				$total_row=count($this->search_data_model->get_total_parks($city,$area,$title));			
				$config['total_rows'] = $total_row;
				$config['base_url'] = base_url().'search/show/';
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				$config['uri_segment']=3;
				$config['per_page'] = 10;
			    $limit=$config['per_page'];
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
                $offset=$this->uri->segment(3);
				$data['list']['data']=$this->search_data_model->get_search_parks($city,$area,$title,$limit,$offset);
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
			    //print_r($data);
			    $this->layouts->set_breadcrumb_array(array('Home' => base_url(), 'Show Business Park' => ''));
			    $this->layouts->view('search/show_business_parks', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}		
		    
	}
	function demo(){
			$this->layouts->set_title('Media Basket');
			$this->layouts->set_description('This is just a test description.');
			$data=array();
			$data=$this->search_data_model->get_total_events($city,$area);
			return json_encode($result);
			$this->layouts->view('search/demo_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		
		
		function use_json(){
			$this->layouts->set_title('Media Basket');
			$this->layouts->set_description('This is just a test description.');
			    $json_data = $this->search_data_model->get_model_events();
			    $data=array();
				$arr = array();
				foreach ($json_data as $results) {
				$arr[] = array(
					   'id' => $results->event_id,
					   'location' => $results->event_location
						);
				}
			 //save data mysql data in json encode format       
			  $data['markers'] = json_encode($arr);
			  $this->layouts->view('search/json_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}	
	}


