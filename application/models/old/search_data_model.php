<?php

/*
 * This is the model to get all type of data from database.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class search_data_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
/// getting total count of meta types baseed on search///
    
	function get_media_data($media)
	{      
		if($media=="apartments"){
			
			$this->db->select('a_cityname as city,a_area as area');
            $this->db->from('apartments');  
            $this->db->where('flag',1);		
		}
		else if($media=="events"){
			
			$this->db->select('event_cityname as city,event_area as area');
            $this->db->from('events_meta');  
            $this->db->where('flag',1);	
		}
		else if($media=="malls"){
			
			$this->db->select('mall_cityname as city,mall_area as area');
            $this->db->from('malls_meta');  
            $this->db->where('flag',1);	
		}
		else if($media=="parks"){
			
			$this->db->select('park_cityname as city,park_area as area');
            $this->db->from('business_park');  
            $this->db->where('flag',1);	
		}
		else if($media=="radios"){
			
			$this->db->select('radio_station_city as city');
            $this->db->from('radio');  
            $this->db->where('flag',1);	
		}
		else if($media=="hoardings"){
			
			$this->db->select('h_cityname as city,h_area as area ');
            $this->db->from('hoarding_ads');  
            $this->db->where('flag',1);	
		}
		   	
            $query = $this->db->get();
            return $query->result();
	}
	
	
	
	
 function get_total_apartments($city,$area,$title="") {
            
            $this->db->select('*');
            $this->db->from('apartments ap');  
			//if($title)
			$this->db->like(array('ap.a_cityname' => $city,'ap.a_area' => $area,'ap.a_name'=>$title));	
		    //else
			//$this->db->or_like(array('ap.a_cityname' => $city,'ap.a_area' => $area));	
            $this->db->where('ap.flag',1);			
            $query = $this->db->get();
            return $query->result();
    }
	function get_total_events($city,$area,$title="") {
            
            $this->db->select('*');
            $this->db->from('events_meta e');
			
			//if(!empty($title))
			    $this->db->like(array('e.event_cityname'=>$city,'e.event_area'=>$area,'e.event_name'=>$title));
			//else
				//$this->db->like(array('e.event_cityname'=>$city,'e.event_area'=>$area));
			
			$this->db->where('e.flag',1);
            $query = $this->db->get();
            return $query->result();
    }
	function get_total_malls($city,$area,$title="") {
            
            $this->db->select('*');
           	$this->db->from('malls_meta m');
			$this->db->like(array('m.city_name' =>$city,'m.mall_area'=>$area,'m.mall_name'=>$title));
			$this->db->where('m.flag',1);
            $query = $this->db->get();
            return $query->result();
    }
	function get_total_parks($city,$area,$title="") {
            
            $this->db->select('*');
            $this->db->from('business_park bp');
			$this->db->like(array('bp.park_cityname'=>$city,'bp.park_area'=>$area,'bp.park_name'=>$title));	
            $this->db->where('bp.flag',1);			
            $query = $this->db->get();
            return $query->result();
    }
	function get_total_radios($city,$title="") {
            
            $this->db->select('*');
            $this->db->from('radio r');
			$this->db->like(array('r.radio_station_city'=>$city,'radio_station_name'=>$title));
			$this->db->where('r.flag',1);
			
            $query = $this->db->get();
            return $query->result();
    }
	function get_total_hoardings($city,$area,$title="") {
            
            $this->db->select('*');
            $this->db->from('hoarding_ads h');
			$this->db->like(array('h.h_cityname'=>$city,'h.h_area'=>$area,'h.h_title'=>$title));	
			$this->db->where('h.flag',1);			
            $query = $this->db->get();
            return $query->result();
    }
	
	
	///getting data for meta types based on search//
	
	function get_search_apartments($city,$area,$title="",$limit,$offset=0) {
            
            $this->db->select('*');
            $this->db->from('apartments ap');  
			//if($title)
			$this->db->like(array('ap.a_cityname' => $city,'ap.a_area' => $area,'ap.a_name'=>$title));
		    //else
			//$this->db->or_like('ap.a_name'=>$title));
			$this->db->where('ap.flag',1);
			$this->db->limit($limit,$offset);
			$this->db->order_by('a_id','desc');
            $query = $this->db->get();
            return $query->result();
    }
	function get_search_events($city,$area,$title="",$limit,$offset) {
            
            $this->db->select('*');
            $this->db->from('events_meta e');
			//if(!empty($title))
			$this->db->like(array('e.event_cityname'=>$city,'e.event_area'=>$area,'e.event_name'=>$title));
		   // else
			//$this->db->like(array('e.event_cityname'=>$city,'e.event_area'=>$area));
			//$this->db->or_like('e.event_name',$title);
			$this->db->where('e.flag',1);
			$this->db->limit($limit,$offset);
			$this->db->order_by('event_id','desc');
            $query = $this->db->get();
          return $query->result();
    }
	function get_search_parks($city,$area,$title="",$limit,$offset) {
            
            $this->db->select('*');
            $this->db->from('business_park bp');
			$this->db->like(array('bp.park_cityname'=>$city,'bp.park_area'=>$area,'bp.park_name'=>$title));
			$this->db->where('bp.flag',1);
			$this->db->limit($limit,$offset);
			$this->db->order_by('park_id','desc');
            $query = $this->db->get();
            return $query->result();
    }
	function get_search_malls($city,$area,$title="",$limit,$offset) {
            
            $this->db->select('*');
            $this->db->from('malls_meta m');
			$this->db->like(array('m.city_name' =>$city,'m.mall_area'=>$area,'m.mall_name'=>$title));
			$this->db->where('m.flag',1);
			$this->db->limit($limit,$offset);
			$this->db->order_by('mall_id','desc');
            $query = $this->db->get();
           return $query->result();
    }
	function get_search_radios($city,$title="",$limit,$offset) {
            
            $this->db->select('*');
            $this->db->from('radio r');
			$this->db->like(array('r.radio_station_city'=>$city,'radio_station_name'=>$title));
			$this->db->where('r.flag',1);
			$this->db->limit($limit,$offset);
			$this->db->order_by('radio_station_id','desc');
            $query = $this->db->get();
            return $query->result();
    }
	function get_search_hoardings($city,$area,$title="",$limit,$offset) {
            
            $this->db->select('*');
            $this->db->from('hoarding_ads h');
			$this->db->like(array('h.h_cityname'=>$city,'h.h_area'=>$area,'h.h_title'=>$title));
			$this->db->where('h.flag',1);
			$this->db->limit($limit,$offset);
			$this->db->order_by('h_id','desc');
            $query = $this->db->get();
           return $query->result();
    }
	
	
	//demo functions to test//
	
	/*function get_total_apartments() {
            
            $this->db->select('*');
            $this->db->from('apartments ap');  
            $query = $this->db->get();
            return $query->result();
    }

    function get_total_model_apartments($limit,$offset=0) {
            
            $this->db->select('*',FALSE);
            $this->db->from('apartments ap');  
			//$this->db->like(array('ap.a_cityname' => $city,'ap.a_area' => $area,'ap.flag'=>1));
			$this->db->limit($limit,$offset);
            $query = $this->db->get();
            return $query->result();
    }
	*/
	function get_model_events() {
            
            $this->db->select('*');
            $this->db->from('events_meta e');
			//$this->db->like(array('e.event_cityname'=>$city,'e.event_area'=>$area,'e.flag'=>1));
            $query = $this->db->get();
            return $query->result();
    }
	
}
?>