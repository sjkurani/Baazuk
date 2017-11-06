<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cityarea extends CI_Controller {
	
	public function __construct()
	{
    	parent::__construct();
    	$this->load->model('get_data_model');
    	LoadCssAndJs($this->layouts);
	}


	function index() {
		$this->layouts->set_title('Media Basket');
		$this->layouts->set_description('Media Basket.');
		$data['list']['city']= $this->get_data_model->get_city_list();
		$data['list']['area']= $this->get_data_model->get_area_list();
		/*echo "<pre>";
		print_r($data['list']['city']);
		echo "</pre>";*/
		//exit();
		is_authenticated_user(array('admin'));
	
		if ($this->form_validation->run() == FALSE) {	
		$this->layouts->set_breadcrumb_array(array('<span class="fa fa-home"></span>' => base_url(),'Dashboard' => base_url()."dashboard/".$this->session->userdata('user_type'), 'City and Area' => ''));		
			$this->layouts->view('cityarea/list_view', array('left_sidebar' => 'sidebar/left_sidebar','right_sidebar' => 'sidebar/right_sidebar'),$data,TRUE);	
		}
		else {
			//Save and redirect..
		}
	}

	function change_status($city_id,$flag,$table_name) {
        
		if($flag == 1 || $flag == 0) {

			$is_updated = $this->save_update_model->change_status($city_id,$flag,$table_name);
			
			if($is_updated && $flag == 1  ) {
				$str =  "Activated";
				$this->session->set_flashdata('msg', ' '.$str.' successfully. ');
				redirect(base_url().'cityarea/','refresh');
			}

            elseif($is_updated && $flag == 0 ) {            	
            	    $str =  "Blocked";
				    $this->session->set_flashdata('msg', ' '.$str.' successfully. ');
				    redirect(base_url().'cityarea/','refresh');		   

			      }
            }

       }

        function save_city(){       	 
        	$media=$this->input->post('media_type');

         	$city_update = $this->save_update_model->save_city_details($this->input->post('city_name'),$media);
         	print_r($city_update);
         
         	if($city_update) {
				$str =  "New city added";
				$this->session->set_flashdata('msg', ' '.$str.' successfully. ');
				redirect(base_url().'cityarea/','refresh');
			}

            else{            	
            	    $str =  "City already existed";
				    $this->session->set_flashdata('msg', ' '.$str.' . ');
				    redirect(base_url().'cityarea/','refresh');		   

			      }
         
         }
          function save_area(){       	 
     // print_r($this->input->post());
      //exit();
         	$city_update = $this->save_update_model->save_area_details($this->input->post('city_id'),$this->input->post('area_name'),$this->input->post('media_type'));
         //	print_r($this->input->post());
       //   print_r($this->db->last_query());
         //	print_r($city_update);
         //	exit();
         	if($city_update) {
				$str =  "New area added";
				$this->session->set_flashdata('msg', ' '.$str.' successfully. ');
				redirect(base_url().'cityarea/','refresh');
			}

            else{            	
            	    $str =  "Area already existed";
				    $this->session->set_flashdata('msg', ' '.$str.' . ');
				    redirect(base_url().'cityarea/','refresh');		   

			      }
         
         }
     function delete_cityarea($city_id,$table_name)
       {
          

                  $is_deleted = $this->save_update_model->delete_cityarea($city_id,$table_name);

                   if($is_deleted){
                   	$str =  "Deleted";
				    $this->session->set_flashdata('msg', ' '.$str.' successfully. ');
				    redirect(base_url().'cityarea/','refresh');


         }

        

  }

}
?>