<?php

/*
 * This is the model to get all type of data from database.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class get_data_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_terms_and_cond($media_type) {        
            $this->db->select('*');
            $this->db->from('term_and_conditions');
            $this->db->where(array('media_type' => $media_type));
            $query = $this->db->get();
            return $query->row_array();
    }
    function get_all_terms_and_condn() {      
            $this->db->select('*');
            $this->db->from('term_and_conditions');
            $query = $this->db->get();
            return $query->result();

    }

    function recommanded_aprtments() {
            $this->db->select('a_id,a_name,a_area,a_cityname,a_image,rec.*');
            $this->db->from('apartments ap');
            $this->db->join('recommended rec', 'rec.media_id = ap.a_id', 'right');
            $this->db->limit(3,0);
            $this->db->order_by('rec.id','desc');
            $this->db->where(array('rec.media_type' => 'apartment', 'ap.flag' => 1));
            $query = $this->db->get();
            return $query->result();

    }

    function recommanded_events() {
            $this->db->select('event_id,event_name,event_area,event_cityname,event_image,rec.*');
            $this->db->from('events_meta em');
            $this->db->join('recommended rec', 'rec.media_id = em.event_id', 'right');
            $this->db->limit(3,0);
            $this->db->order_by('rec.id','desc');
            $this->db->where(array('media_type' => 'event', 'flag' => 1));
            $query = $this->db->get();
            return $query->result();
    }

    function recommanded_malls() {
            $this->db->select('mall_id,mall_name,mall_area,city_name,img_name,rec.*');
            $this->db->from('malls_meta mm');
            $this->db->join('recommended rec', 'rec.media_id = mm.mall_id', 'right');
            $this->db->limit(3,0);
            $this->db->order_by('rec.id','desc');
            $this->db->where(array('rec.media_type' => 'mall', 'mm.flag' => 1));
            $query = $this->db->get();
            return $query->result();
    }
    function recommanded_radios() {
            $this->db->select('radio_station_id,radio_station_name,radio_station_city,r_image,rec.*');
            $this->db->from('radio r');
            $this->db->join('recommended rec', 'rec.media_id = r.radio_station_id', 'right');
            $this->db->limit(3,0);
            $this->db->order_by('rec.id','desc');
            $this->db->where(array('rec.media_type' => 'radio', 'r.flag' => 1));
            $query = $this->db->get();
            return $query->result();
    }
   
    function recommanded_hoardings() {
            $this->db->select('h_id,h_title,h_area, h_cityname,ref_image,rec.*');
            $this->db->from('hoarding_ads hoard');
            $this->db->join('recommended rec', 'rec.media_id = hoard.h_id', 'right');
            $this->db->limit(3,0);
            $this->db->order_by('rec.id','desc');
            $this->db->where(array('rec.media_type' => 'hoarding', 'hoard.flag' => 1));
            $query = $this->db->get();
            return $query->result();
    }
    function recommanded_parks() {
            $this->db->select('park_id,park_name,park_area,park_cityname,park_image,rec.*');
            $this->db->from('business_park bp');
            $this->db->join('recommended rec', 'rec.media_id = bp.park_id', 'right');
            $this->db->limit(3,0);
            $this->db->order_by('rec.id','desc');
            $this->db->where(array('rec.media_type' => 'park', 'bp.flag' => 1));
            $query = $this->db->get();
            return $query->result();
    }
    function get_saved_apartments($user_id,$a_id) {
        $this->db->select('s_ads.*');
        $this->db->from("saved_ads s_ads");
        $this->db->join('apartment_ads ap_ads', 's_ads.ad_id = ap_ads.ad_id', 'left');
        $this->db->where(array('s_ads.ad_type' => 'apartment','s_ads.media_type_id' => $a_id, 's_ads.user_id' => $user_id));
        $query = $this->db->get();
        return $query->result();
    }
    function get_saved_events($user_id,$event_id) {
        $this->db->select('s_ads.*');
        $this->db->from("saved_ads s_ads");
        $this->db->join('event_ads e_ads', 's_ads.ad_id = e_ads.ad_id', 'left');
        $this->db->where(array('s_ads.ad_type' => 'event','s_ads.media_type_id' => $event_id, 's_ads.user_id' => $user_id));
        $query = $this->db->get();
        return $query->result();
    }
    function get_saved_malls($user_id,$mall_id) {
        $this->db->select('s_ads.*');
        $this->db->from("saved_ads s_ads");
        $this->db->join('mall_ads m_ads', 's_ads.ad_id = m_ads.ad_id', 'left');
        $this->db->where(array('s_ads.ad_type' => 'mall','s_ads.media_type_id' => $mall_id, 's_ads.user_id' => $user_id));
        $query = $this->db->get();
        return $query->result();
    }
    function get_saved_radios($user_id,$radio_id) {
        $this->db->select('s_ads.*');
        $this->db->from("saved_ads s_ads");
        $this->db->join('radio_ads r_ads', 's_ads.ad_id = r_ads.ad_id', 'left');
        $this->db->where(array('s_ads.ad_type' => 'radio','s_ads.media_type_id' => $radio_id, 's_ads.user_id' => $user_id));
        $query = $this->db->get();
        return $query->result();
    }
    function get_saved_parks($user_id,$park_id) {
        $this->db->select('s_ads.*');
        $this->db->from("saved_ads s_ads");
        $this->db->join('business_park_ads bp_ads', 's_ads.ad_id = bp_ads.ad_id', 'left');
        $this->db->where(array('s_ads.ad_type' => 'park','s_ads.media_type_id' => $park_id, 's_ads.user_id' => $user_id));
        $query = $this->db->get();
        return $query->result();
    }
    function get_saved_hoardings($user_id,$hoarding_id) {
        $this->db->select('s_ads.*');
        $this->db->from("saved_ads s_ads");
        $this->db->join('hoarding_ads h_ads', 's_ads.ad_id = h_ads.h_id', 'left');
        $this->db->where(array('s_ads.ad_type' => 'hoarding','s_ads.media_type_id' => $hoarding_id, 's_ads.user_id' => $user_id));
        $query = $this->db->get();
        return $query->result();
    }

    function get_valid_user($email_or_mobile, $user_type) {
        if($user_type == 'owner') {
            $table_name = 'owner_details';
        }
        elseif($user_type == 'buyer') {
            $table_name = 'buyer_details';
        }
        elseif($user_type == 'admin') {
            $table_name = 'owner_details';
        }
        if (filter_var($email_or_mobile, FILTER_VALIDATE_EMAIL)) {
            $this->db->select('*');
            $this->db->from($table_name);
            $this->db->where(array('email' => $email_or_mobile));
            $query = $this->db->get();
            return $query->row_array();
        }
        else {
            $this->db->select('*');
            $this->db->from($table_name);
            $this->db->where(array('mobile' => $email_or_mobile));
            $this->db->where("mobile !=", 0 );
            $query = $this->db->get();
            return $query->row_array();            
        }
    }
    function get_user_password($email, $user_type) {
        if($user_type == 'owner') {
            $table_name = 'owner_details';
        }
        elseif($user_type == 'buyer') {
            $table_name = 'buyer_details';
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->db->select('*');
            $this->db->from($table_name);
            $this->db->where(array('email' => $email));
            $query = $this->db->get();
            return $query->row('nickname');
        }
        else {
            $this->db->select('*');
            $this->db->from($table_name);
            $this->db->where(array('mobile' => $email));
            $this->db->where("mobile !=", 0 );
            $query = $this->db->get();
            return $query->row('nickname');            
        }
    }
    function get_user_email($user_id, $user_type) {
        if($user_type == 'owner') {
            $table_name = 'owner_details';
        }
        elseif($user_type == 'buyer') {
            $table_name = 'buyer_details';
        }
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where(array('user_id' => $user_id));
        $query = $this->db->get();
        return $query->row('email');
    }
    function get_user_enquery_email($user_id){
        $this->db->select('en.buyer_id,buy.email');
        $this->db->from('enquiries en' );
        $this->db->join('buyer_details buy','en.buyer_id=buy.user_id','right');
        $this->db->order_by('email','ASC');
        $query = $this->db->get();
        return $query->row('email');
     }


    function get_enqueryid_details($enquiry_id, $user_id){
        $this->db->select('*');
        $this->db->from('enquiries en' );
        $this->db->join('buyer_details buy','en.buyer_id=buy.user_id','right');
        $this->db->order_by('email','ASC');
        $this->db->where(array('en.enquiry_id' => $enquiry_id));
        $query = $this->db->get();
        return $query->row();
     }


    function get_city_list($flag = 0, $media_type = 0) {
        
            $this->db->select('*');
            $this->db->from('city');           
            $this->db->order_by('city_id','desc');

            if($flag == 0 && $media_type == 0) {
                //list
            }
            else if(($flag == 1) && !(is_integer($media_type))) {
                $this->db->where(array("flag " => $flag, 'media_type' => $media_type));

            }
/*
            if($flag == 0) {
                //$this->db->where(array("flag " => $flag));
            }
            else if($media_type === 0 && $flag === 1) {
                    $this->db->where(array("flag " => $flag));
                }
            else if($media_type != 0 && $flag == 1) {
                $this->db->where(array("flag " => $flag, 'media_type' => $media_type));   
            }*/
            $query = $this->db->get();
            return $query->result();        
    }
 /*   function get_city_list($flag = 0) {
            $this->db->select('*');
            $this->db->from('city');           
            $this->db->order_by('city_name','ASC');
            if($flag == 0) {
                //$this->db->where(array("flag " => $flag));
            }
            else {
                $this->db->where(array("flag " => $flag));
            }
            $query = $this->db->get();
            return $query->result();        
    }*/
   function get_area_list() {
            $this->db->select('*,area.flag area_flag, city.flag city_flag,area.media_type as area_media_type, city.media_type as city_media_type');
            $this->db->from('area');            
            $this->db->join('city', 'city.city_id = area.parent_city', 'left');
            $this->db->order_by('area_id','desc');
            $query = $this->db->get();
            return $query->result();        
    }
    
    
     function get_area1_list($flag=1,$type='apartments') {
    //if($type=='apartments'){
            $this->db->select('*,area.flag area_flag, city.flag city_flag');
            $this->db->from('area');            
            $this->db->join('city', 'city.city_id = area.parent_city', 'left');
            $this->db->where(array('area.media_type' => $type));
            $this->db->order_by('area_name','ASC');
            $query = $this->db->get();
            return $query->result();  
           // }      
    }
    
    function get_areas_list($val,$media_type) {
        $this->db->select('*');
        $this->db->where(array('flag' => 1, 'parent_city' => $val,'media_type' => $media_type));
        $query = $this->db->get('area');
        if($query->num_rows > 0){
         return json_encode($query->result_array()); //format the array into json data
        }
    }
     function get_citys_list($val,$media_type) {
        $this->db->select('*');
        $this->db->where(array('flag' => 1,'city' => $val,'media_type' => $media_type));
        $query = $this->db->get('city');
        if($query->num_rows > 0){
         return json_encode($query->result_array()); //format the array into json data
        }
    }

    function get_user_details($table,$user_id = 0,$user_type,$flag = 0, $limit = 20) {
        if(!$user_id){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->limit($limit,0);
            $this->db->where(array('flag' => $flag,'user_type'=>$user_type));
			$this->db->order_by('user_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($user_id) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where(array('user_id' => $user_id,'user_type'=>$user_type));
            $query = $this->db->get();
            return $query->row();
        }
    }
	function get_user_profile_details($table,$user_id) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where(array('user_id' => $user_id));
			$query = $this->db->get();
            return $query->row();
        }

    function get_user_email_details($user_type,$table,$user_id) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where(array('user_id' => $user_id));
            $query = $this->db->get();
            return $query->row();
        }
    
	
	
    function get_apartment_details($apartment_id = 0,$flag = 0, $limit = 20) {
        if(!$apartment_id){
            $this->db->select('*');
            $this->db->from('apartments ap');
            $this->db->limit($limit,0);
            $this->db->where(array('ap.flag' => $flag));
			$this->db->order_by('ap.a_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($apartment_id) {
            $this->db->select('*');
            $this->db->from('apartments ap');
            $this->db->where(array('ap.a_id' => $apartment_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_event_details($event_id = 0,$flag = 0, $limit = 20) {
        if(!$event_id){
            $this->db->select('*');
            $this->db->from('events_meta em');
            $this->db->limit($limit,0);
            $this->db->where(array('em.flag' => $flag));
			$this->db->order_by('em.event_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($event_id) {
            $this->db->select('*');
            $this->db->from('events_meta em');
            $this->db->where(array('em.event_id' => $event_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_park_details($park_id = 0,$flag = 0, $limit = 20) {
        if(!$park_id){
            $this->db->select('*');
            $this->db->from('business_park bp');
            $this->db->limit($limit,0);
            $this->db->where(array('bp.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($park_id) {
            $this->db->select('*');
            $this->db->from('business_park bp');
            $this->db->where(array('bp.park_id' => $park_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_mall_details($mall_id = 0,$flag = 0, $limit = 20) {
        if(!$mall_id){
            $this->db->select('*');
            $this->db->from('malls_meta mm');
            $this->db->limit($limit,0);
            $this->db->where(array('mm.flag' => $flag));
			$this->db->order_by('mm.mall_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($mall_id) {
            $this->db->select('*');
            $this->db->from('malls_meta mm');
            $this->db->where(array('mm.mall_id' => $mall_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
    function get_hoardings_details($h_id = 0,$flag = 0, $limit = 20) {
        if(!$h_id){
            $this->db->select('*');
            $this->db->from('hoardings h');
            $this->db->limit($limit,0);
            $this->db->where(array('h.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($h_id) {
            $this->db->select('*');
            $this->db->from('hoardings h');
            $this->db->where(array('h.h_id' => $h_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_radio_details($radio_id = 0,$flag = 0, $limit = 20) {
        if(!$radio_id){
            $this->db->select('*');
            $this->db->from('radio r');
            $this->db->limit($limit,0);
            $this->db->where(array('r.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($radio_id) {
            $this->db->select('*');
            $this->db->from('radio r');
            $this->db->where(array('r.radio_station_id' => $radio_id));
            $query = $this->db->get();
            return $query->row();
        }
    }


    function get_apartment_ads_details($ad_id = 0,$flag = 0, $limit = 20) {
        if(!$ad_id){
            $this->db->select('*');
            $this->db->from('apartment_ads ad');
            $this->db->limit($limit,0);
            $this->db->where(array('ad.flag' => $flag));
            $this->db->order_by('ad.ad_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($ad_id) {
            $this->db->select('*');
            $this->db->from('apartment_ads ad');
          //  $this->db->where(array('ad.flag' => $flag, 'ad.ad_id' => $ad_id));
            $this->db->where(array( 'ad.ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
    function get_event_ads_details($ad_id = 0,$flag = 0, $limit = 20) {
        if(!$ad_id){
            $this->db->select('*');
            $this->db->from('event_ads ed');
            $this->db->limit($limit,0);
            $this->db->where(array('ed.flag' => $flag));
            $this->db->order_by('ed.ad_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($ad_id) {
            $this->db->select('*');
            $this->db->from('event_ads ed');
           // $this->db->where(array('ed.flag' => $flag, 'ed.ad_id' => $ad_id));
            $this->db->where(array( 'ed.ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
    function get_mall_ads_details($ad_id = 0,$flag = 0, $limit = 20) {
        if(!$ad_id){
            $this->db->select('*');
            $this->db->from('mall_ads md');
            $this->db->limit($limit,0);
            $this->db->where(array('md.flag' => $flag));
            $this->db->order_by('md.ad_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($ad_id) {
            $this->db->select('*');
            $this->db->from('mall_ads md');
           // $this->db->where(array('md.flag' => $flag, 'md.ad_id' => $ad_id));
            $this->db->where(array( 'md.ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
    function get_radio_ads_details($ad_id = 0,$flag = 0, $limit = 20) {
        if(!$ad_id){
            $this->db->select('*');
            $this->db->from('radio_ads rd');
            $this->db->limit($limit,0);
            $this->db->where(array('rd.flag' => $flag));
            $this->db->order_by('rd.ad_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($ad_id) {
            $this->db->select('*');
            $this->db->from('radio_ads rd');
            //$this->db->where(array('rd.flag' => $flag, 'rd.ad_id' => $ad_id));
            $this->db->where(array( 'rd.ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->row();
        }
    }function get_park_ads_details($ad_id = 0,$flag = 0, $limit = 20) {
        if(!$ad_id){
            $this->db->select('*');
            $this->db->from('business_park_ads pd');
            $this->db->limit($limit,0);
            $this->db->where(array('pd.flag' => $flag));
            $this->db->order_by('pd.ad_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($ad_id) {
            $this->db->select('*');
            $this->db->from('business_park_ads pd');
          //  $this->db->where(array('pd.flag' => $flag, 'pd.ad_id' => $ad_id));
            $this->db->where(array( 'pd.ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
	function get_hoarding_ads_details($h_id = 0,$flag = 0, $limit = 20) {
        if(!$h_id){
            $this->db->select('*');
            $this->db->from('hoarding_ads hd');
            $this->db->limit($limit,0);
            $this->db->where(array('hd.flag' => $flag));
			$this->db->order_by('hd.h_id','desc');
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($h_id) {
            $this->db->select('*');
            $this->db->from('hoarding_ads hd');
            //$this->db->where(array('hd.flag' => $flag, 'hd.h_id' => $h_id));
            $this->db->where(array( 'hd.h_id' => $h_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
	//Getting hoarding detail based on area//
	function get_other_area_hoardings($h_id=0,$area,$flag=0,$limit=20,$offset=0) {
            if(!$h_id){
            $this->db->select('*');
            $this->db->from('hoarding_ads h');
            $this->db->limit($limit,$offset);
            $this->db->like(array('h.h_area'=>$area,'h.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
			}
			else {
				$this->db->select('*');
				$this->db->from('hoarding_ads h');
				$this->db->limit($limit,$offset);
				$this->db->like(array('h.h_area'=>$area,'h.flag' => $flag));
				$this->db->where_not_in('h_id',$h_id);
				$query = $this->db->get();
				return $query->result();
			}
    }
	
	
	
	

    //Getting media type details corresponding to particular owner
    
     function get_owner_hoardings_details($h_id=0,$owner_id,$flag=0, $limit=20, $offset=0) {
            if(!$h_id){
            $this->db->select('*');
            $this->db->from('hoarding_ads h');
            $this->db->limit($limit,$offset);
            $this->db->where(array('h.owner_id'=>$owner_id,'h.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
	 }
	 else {
		    $this->db->select('*');
            $this->db->from('hoarding_ads h');
            $this->db->limit($limit,$offset);
            $this->db->where(array('h.owner_id'=>$owner_id,'h.flag' => $flag));
			$this->db->where_not_in('h_id',$h_id);
            $query = $this->db->get();
            return $query->result();
	 }
		 
    }

    function get_owner_apartment_details($owner_id,$flag=0,$limit=20) {
    
        $this->db->select('*');
        $this->db->from('apartments ap');
        $this->db->limit($limit,0);
        $this->db->where(array('ap.owner_id'=>$owner_id,'ap.flag' => $flag));
        
        $query = $this->db->get();
        return $query->result();
    } 
    
    function get_owner_radio_details($owner_id,$flag=0,$limit=20) {
    
        $this->db->select('*');
        $this->db->from('radio r');
        $this->db->limit($limit,0);
        $this->db->where(array('r.owner_id'=>$owner_id,'r.flag' => $flag));
        
        $query = $this->db->get();
        return $query->result();
    } 
    
    function get_owner_mall_details($owner_id,$flag=0,$limit=20) {
    
        $this->db->select('*');
        $this->db->from('malls_meta m');
        $this->db->limit($limit,0);
        $this->db->where(array('m.owner_id'=>$owner_id,'m.flag' => $flag));
        
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_owner_event_details($owner_id,$flag=0,$limit=20) {
    
        $this->db->select('*');
        $this->db->from('events_meta e');
        $this->db->limit($limit,0);
        $this->db->where(array('e.owner_id'=>$owner_id,'e.flag' => $flag));
        
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_owner_park_details($owner_id,$flag=0,$limit=20) {
        $this->db->select('*');
        $this->db->from('business_park p');
        $this->db->limit($limit,0);
        $this->db->where(array('p.owner_id'=>$owner_id,'p.flag' => $flag));
        
        $query = $this->db->get();
        return $query->result();
    }
	
	
	//getting ads details particular to owner
	function get_owner_mall_ads_details($owner_id,$flag=0, $limit=20) {
            
            $this->db->select('*');
            $this->db->from('mall_ads m');
            $this->db->limit($limit,0);
            $this->db->where(array('m.owner_id'=>$owner_id,'m.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
	 }
	 function get_owner_apartment_ads_details($owner_id,$flag=0, $limit=20) {
            
            $this->db->select('*');
            $this->db->from('apartment_ads a');
            $this->db->limit($limit,0);
            $this->db->where(array('a.owner_id'=>$owner_id,'a.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
	 }
	 function get_owner_event_ads_details($owner_id,$flag=0, $limit=20) {
            
            $this->db->select('*');
            $this->db->from('event_ads e');
            $this->db->limit($limit,0);
            $this->db->where(array('e.owner_id'=>$owner_id,'e.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
	 }
	 function get_owner_park_ads_details($owner_id,$flag=0, $limit=20) {
            
            $this->db->select('*');
            $this->db->from('business_park_ads p');
            $this->db->limit($limit,0);
            $this->db->where(array('p.owner_id'=>$owner_id,'p.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
	 }
	 function get_owner_radio_ads_details($owner_id,$flag=0, $limit=20) {
            
            $this->db->select('*');
            $this->db->from('radio_ads r');
            $this->db->limit($limit,0);
            $this->db->where(array('r.owner_id'=>$owner_id,'r.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
	 }

    function get_media_details($media_type, $id, $flag, $limit = 20, $offset = 0) {
        $response = array();
        switch ($media_type) {
            case 'apartment':
                    $table_name = 'apartments';
                    $ads_table_name = 'apartment_ads';
                    $pid = 'a_id';
                    $fid = 'ap_id';
                break;
            case 'event':
                    $table_name = 'events_meta';
                    $ads_table_name = 'event_ads';
                    $pid = 'event_id';
                    $fid = 'event_id';
                break;
            case 'mall':
                    $table_name = 'malls_meta';
                    $ads_table_name = 'mall_ads';
                    $pid = 'mall_id';
                    $fid = 'mall_id';
                break;
            case 'park':
                    $table_name = 'business_park';
                    $ads_table_name = 'business_park_ads';
                    $pid = 'park_id';
                    $fid = 'park_id';
                break;
            case 'radio':
                    $table_name = 'radio';
                    $ads_table_name = 'radio_ads';
                    $pid = 'radio_station_id';
                    $fid = 'radio_id';
                break;
            case 'hoarding':
                    $table_name = 'events_meta';
                    $ads_table_name = 'event_ads';
                    $pid = 'event_id';
                    $fid = 'event_id';
                break;
            
            default:
                # code...
                break;
        }
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where(array($pid =>$id));
        
        $query = $this->db->get();
        $response['primary'] = $query->result();
        $response['secondary'] = $this->get_ad_details($ads_table_name,$fid,$id,$limit,$offset);
        $response['total'] = count($this->get_ad_details($ads_table_name,$fid,$id));
        return $response;
    }
    //$id,$pid,$fid,$limit,$offset
    function get_ad_details($table_name, $fid, $id, $limit = 20, $offset = 0) {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->limit($limit,$offset);
        //$this->db->order_by('created','DESC');
        $this->db->where(array($fid => $id,'flag' => 1));
        $query = $this->db->get();
        return $query->result();
    }
	function get_total_ad($table_name, $fid, $id) {
        $this->db->select('*');
        $this->db->from($table_name);
        //$this->db->limit($limit,$offset);
        $this->db->where(array($fid => $id,'flag' => 1));
        $query = $this->db->get();
        return $query->result();
    }
	//enquiry data for admin, owner and buyer//
    function get_apartment_enquiries($user_id, $user_type) {
        if($user_type == 'admin') {
            $this->db->select('en.*,ap_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,ap.a_id as apartment_id,ap.a_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('apartment_ads ap_ads', 'en.ad_id = ap_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('apartments ap', 'en.ad_type_id = ap.a_id', 'left');
            $this->db->where(array('en.ad_type' => 'apartment'));
            $query = $this->db->get();
            return $query->result();            
        }
        else if($user_type == 'owner') {
            $this->db->select('en.*,ap_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,ap.a_id as apartment_id,ap.a_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('apartment_ads ap_ads', 'en.ad_id = ap_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('apartments ap', 'en.ad_type_id = ap.a_id', 'left');
            $this->db->where(array('en.ad_type' => 'apartment','user.user_id' => $user_id,'en.flag' => 1));
            $query = $this->db->get();
            return $query->result();            
        }
        else if($user_type == 'buyer') {
            $this->db->select('en.*,ap_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,ap.a_id as apartment_id,ap.a_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('apartment_ads ap_ads', 'en.ad_id = ap_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('apartments ap', 'en.ad_type_id = ap.a_id', 'left');
            $this->db->where(array('en.ad_type' => 'apartment','user.user_id' => $user_id));
            $query = $this->db->get();
            return $query->result();            
        }

    }
    function get_event_enquiries($user_id, $user_type) {
        if($user_type == 'admin') {
            $this->db->select('en.*,ev_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,em.event_id as event_id,em.event_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('event_ads ev_ads', 'en.ad_id = ev_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('events_meta em', 'en.ad_type_id = em.event_id', 'left');
            $this->db->where(array('en.ad_type' => 'events'));
            $query = $this->db->get();
            return $query->result();
        }
        else if($user_type == 'owner') {
            $this->db->select('en.*,ev_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,em.event_id as event_id,em.event_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('event_ads ev_ads', 'en.ad_id = ev_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('events_meta em', 'en.ad_type_id = em.event_id', 'left');
            $this->db->where(array('en.ad_type'  => 'events','user.user_id' => $user_id,'en.flag' => 1));
            $query = $this->db->get();
            return $query->result();            
        }
        else if($user_type == 'buyer') {
            $this->db->select('en.*,ev_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,em.event_id as event_id,em.event_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('event_ads ev_ads', 'en.ad_id = ev_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('events_meta em', 'en.ad_type_id = em.event_id', 'left');
            $this->db->where(array('en.ad_type'  => 'events','user.user_id' => $user_id));
            $query = $this->db->get();
            return $query->result();            
        }

    }
    function get_mall_enquiries($user_id, $user_type) {
        if($user_type == 'admin') {
            $this->db->select('en.*,m_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,mm.mall_id as mall_id,mm.mall_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('mall_ads m_ads', 'en.ad_id = m_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('malls_meta mm', 'en.ad_type_id = mm.mall_id', 'left');
            $this->db->where(array('en.ad_type' => 'malls'));
            $query = $this->db->get();
            return $query->result();
        }
        else if($user_type == 'owner') {
            $this->db->select('en.*,m_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,mm.mall_id as mall_id,mm.mall_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('mall_ads m_ads', 'en.ad_id = m_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('malls_meta mm', 'en.ad_type_id = mm.mall_id', 'left');
            $this->db->where(array('en.ad_type'  => 'malls','user.user_id' => $user_id,'en.flag' => 1));
            $query = $this->db->get();
            return $query->result();            
        }
        else if($user_type == 'buyer') {
            $this->db->select('en.*,m_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,mm.mall_id as mall_id,mm.mall_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('mall_ads m_ads', 'en.ad_id = m_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('malls_meta mm', 'en.ad_type_id = mm.mall_id', 'left');
            $this->db->where(array('en.ad_type'  => 'malls','user.user_id' => $user_id));
            $query = $this->db->get();
            return $query->result();            
        }

    }

    function get_park_enquiries($user_id, $user_type) {
        if($user_type == 'admin') {
            $this->db->select('en.*,b_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,bp.park_id as park_id,bp.park_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('business_park_ads b_ads', 'en.ad_id = b_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('business_park bp', 'en.ad_type_id = bp.park_id', 'left');
            $this->db->where(array('en.ad_type' => 'parks'));
            $query = $this->db->get();
            return $query->result();
        }
        else if($user_type == 'owner') {
            $this->db->select('en.*,b_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,bp.park_id as park_id,bp.park_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('business_park_ads b_ads', 'en.ad_id = b_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('business_park bp', 'en.ad_type_id = bp.park_id', 'left');
            $this->db->where(array('en.ad_type'  => 'parks','user.user_id' => $user_id,'en.flag' => 1));
            $query = $this->db->get();
            return $query->result();            
        }
        else if($user_type == 'buyer') {
            $this->db->select('en.*,b_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,bp.park_id as park_id,bp.park_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('business_park_ads b_ads', 'en.ad_id = b_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('business_park bp', 'en.ad_type_id = bp.park_id', 'left');
            $this->db->where(array('en.ad_type'  => 'parks','user.user_id' => $user_id));
            $query = $this->db->get();
            return $query->result();            
        }

    }

    function get_radio_enquiries($user_id, $user_type) {
        if($user_type == 'admin') {
            $this->db->select('en.*,r_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,r.radio_station_id as radio_station_id,r.radio_station_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('radio_ads r_ads', 'en.ad_id = r_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('radio r', 'en.ad_type_id = r.radio_station_id', 'left');
            $this->db->where(array('en.ad_type' => 'radios'));
            $query = $this->db->get();
            return $query->result();
        }
        else if($user_type == 'owner') {
            $this->db->select('en.*,r_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,r.radio_station_id as radio_station_id,r.radio_station_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('radio_ads r_ads', 'en.ad_id = r_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('radio r', 'en.ad_type_id = r.radio_station_id', 'left');
            $this->db->where(array('en.ad_type'  => 'radios','user.user_id' => $user_id,'en.flag' => 1));
            $query = $this->db->get();
            return $query->result();            
        }
        else if($user_type == 'buyer') {
            $this->db->select('en.*,r_ads.ad_title as ad_title,user.fullname as user_name,user.user_id as user_id,r.radio_station_id as radio_station_id,r.radio_station_name as media_name');
            $this->db->from('enquiries en');
            $this->db->join('radio_ads r_ads', 'en.ad_id = r_ads.ad_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->join('radio r', 'en.ad_type_id = r.radio_station_id', 'left');
            $this->db->where(array('en.ad_type'  => 'radios','user.user_id' => $user_id));
            $query = $this->db->get();
            return $query->result();            
        }
    }

    function get_hoarding_enquiries($user_id, $user_type) {
        if($user_type == 'admin') {
            $this->db->select('en.*,h_ads.h_title as ad_title,user.fullname as user_name,user.user_id as user_id,h_ads.h_id as h_id');
            $this->db->from('enquiries en');
            $this->db->join('hoarding_ads h_ads', 'en.ad_id = h_ads.h_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->where(array('en.ad_type' => 'hoarding'));
            $query = $this->db->get();
            return $query->result();
        }
        else if($user_type == 'owner') {
            $this->db->select('en.*,h_ads.h_title as ad_title,user.fullname as user_name,user.user_id as user_id,h_ads.h_id as h_id');
            $this->db->from('enquiries en');
            $this->db->join('hoarding_ads h_ads', 'en.ad_id = h_ads.h_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->where(array('en.ad_type'  => 'hoarding','user.user_id' => $user_id,'en.flag' => 1));
            $query = $this->db->get();
            return $query->result();            
        }

        else if($user_type == 'buyer') {
            $this->db->select('en.*,h_ads.h_title as ad_title,user.fullname as user_name,user.user_id as user_id,h_ads.h_id as h_id');
            $this->db->from('enquiries en');
            $this->db->join('hoarding_ads h_ads', 'en.ad_id = h_ads.h_id', 'left');
            $this->db->join('buyer_details user', 'en.buyer_id = user.user_id', 'left');
            $this->db->where(array('en.ad_type'  => 'hoarding','user.user_id' => $user_id));
            $query = $this->db->get();
            return $query->result();            
        }

    }
    
    function get_enquiry_send_data($ad_id, $table_name) {
        if($table_name == 'apartment') {
            $this->db->select('*');
            $this->db->from('apartment_ads');
            $this->db->where(array('ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($table_name == 'park') {
            $this->db->select('*');
            $this->db->from('business_park_ads');
            $this->db->where(array('ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($table_name == 'mall') {
            $this->db->select('*');
            $this->db->from('mall_ads');
            $this->db->where(array('ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($table_name == 'hoarding') {
            $this->db->select('*');
            $this->db->from('hoardings');
            $this->db->where(array('h_id' => $ad_id));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($table_name == 'event') {
            $this->db->select('*');
            $this->db->from('event_ads');
            $this->db->where(array('ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($table_name == 'radio') {
            $this->db->select('*');
            $this->db->from('radio_ads');
            $this->db->where(array('ad_id' => $ad_id));
            $query = $this->db->get();
            return $query->result();
        }
    }



  function get_apartment_saved_ads($user_id,$user_type) {
     $this->db->select("s_ads.*, a_ads.ad_title as ad_title");
     $this->db->from('saved_ads s_ads');
     $this->db->join('apartment_ads a_ads','s_ads.ad_id = a_ads.ad_id','left');
     $this->db->where(array('s_ads.ad_type' => 'apartment', 's_ads.user_id' => $user_id ));
     $query = $this->db->get();
     return $query->result();          
    }

    function get_event_saved_ads($user_id,$user_type) {
     $this->db->select("s_ads.*, eve_ads.ad_title as ad_title");
     $this->db->from('saved_ads s_ads');
     $this->db->join('event_ads eve_ads', 's_ads.ad_id=eve_ads.ad_id','left');
     $this->db->where(array('s_ads.ad_type' => 'event', 's_ads.user_id' => $user_id ));
     $query = $this->db->get();
     return $query->result();          
    }

    function get_hoarding_saved_ads($user_id,$user_type) {
     $this->db->select("s_ads.*, h_ads.h_title as ad_title");
     $this->db->from('saved_ads s_ads');
     $this->db->join('hoarding_ads h_ads', 's_ads.ad_id=h_ads.h_id','left');
     $this->db->where(array('s_ads.ad_type' => 'hoarding', 's_ads.user_id' => $user_id ));
     $query = $this->db->get();
     return $query->result();          
    }

    function get_mall_saved_ads($user_id,$user_type) {
     $this->db->select("s_ads.*, m_ads.ad_title as ad_title");
     $this->db->from('saved_ads s_ads');
     $this->db->join('mall_ads m_ads', 's_ads.ad_id=m_ads.ad_id','left');
     $this->db->where(array('s_ads.ad_type' => 'mall', 's_ads.user_id' => $user_id ));
     $query = $this->db->get();
     return $query->result();          
    }

    function get_park_saved_ads($user_id,$user_type) { 
     $this->db->select("s_ads.*, p_ads.ad_title as ad_title");
     $this->db->from('saved_ads s_ads');
     $this->db->join('business_park_ads p_ads', 's_ads.ad_id=p_ads.ad_id','left');
     $this->db->where(array('s_ads.ad_type' => 'park', 's_ads.user_id' => $user_id ));
     $query = $this->db->get();
     return $query->result();            
    }

    function get_radio_saved_ads($user_id,$user_type) {
      $this->db->select("s_ads.*, r_ads.ad_title as ad_title");
      $this->db->from('saved_ads s_ads');
      $this->db->join('radio_ads r_ads', 's_ads.ad_id=r_ads.ad_id','left');
      $this->db->where(array('s_ads.ad_type' => 'radio', 's_ads.user_id' => $user_id ));
      $query = $this->db->get();
      return $query->result();          
    }

    function get_total_no_buyers() {    
      $this->db->from('buyer_details');     
      $this->db->where(array('buyer_details.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }

    function get_total_no_owners() {    
      $this->db->from('owner_details');     
      $this->db->where(array('owner_details.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }

    function get_total_no_enquiries() {    
      $this->db->from('enquiries');     
      $this->db->where(array('enquiries.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }

     function get_total_no_aptads() {    
      $this->db->from('apartment_ads');     
      $this->db->where(array('apartment_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
    
    function get_total_no_parkads() {    
      $this->db->from('business_park_ads');     
      $this->db->where(array('business_park_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
     function get_total_no_evntads() {    
      $this->db->from('event_ads');     
      $this->db->where(array('event_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
   
     function get_total_no_hordingads() {    
      $this->db->from('hoarding_ads');     
      $this->db->where(array('hoarding_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
     function get_total_no_radioads() {    
      $this->db->from('radio_ads');     
      $this->db->where(array('radio_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
    function get_total_no_mallads() {    
      $this->db->from('mall_ads');     
      $this->db->where(array('mall_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }

    function get_total_active_apartments() {    
      $this->db->from('apartments');     
      $this->db->where(array('apartments.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
     function get_total_active_events() {    
      $this->db->from('events_meta');     
      $this->db->where(array('events_meta.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
     function get_total_active_parks() {    
      $this->db->from('business_park');     
      $this->db->where(array('business_park.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
      function get_total_active_mall() {    
      $this->db->from('malls_meta');     
      $this->db->where(array('malls_meta.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
     function get_total_active_hoarding() {    
      $this->db->from('hoarding_ads');     
      $this->db->where(array('hoarding_ads.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
     function get_total_active_radio() {    
      $this->db->from('radio');     
      $this->db->where(array('radio.flag' => 1));    
      $query = $this->db->get();       
      $rowcount = $query->num_rows();
      return $rowcount;       
    }
}
