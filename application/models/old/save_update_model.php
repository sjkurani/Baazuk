<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class save_update_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

   
     function save_city_area_details($city, $area,$media_type) {
      $result = $this->db->from('city')->where(array('city_name' => $city,'media_type' => $media_type))->get();
      
      if($result->num_rows() >= 1) {
        $city_id = $result->row('city_id');
        $area_result = $this->db->from('area')->where(array('parent_city' => $city_id, 'area_name' => $area,'media_type'=>$media_type))->get();
        if($area_result->num_rows() == 1 ) {
          return false;
        }
        else{
          $this->db->insert('area', array('parent_city' => $city_id, 'area_name' => $area,'media_type'=>$media_type));
          return $this->db->insert_id();
        }
      }
      else {
        $this->db->insert('city', array('city_name' => $city,'media_type'=>$media_type));
        $city_id = $this->db->insert_id();
        $this->db->insert('area', array('parent_city' => $city_id, 'area_name' => $area,'media_type'=>$media_type));
        return $this->db->insert_id();
      }
    }

     function save_city_details($city,$media_type) {
      $result = $this->db->from('city')->where('city_name', $city)->get();
      if($result->num_rows() == 1) {
        $city_id = $result->row('city_id');
       return false;
        
      }
      else {
          $this->db->insert('city', array('city_name' => $city,'media_type'=>$media_type));          
          return $this->db->insert_id();
      }
    }
     function save_area_details($city, $area = 0,$media_type) {
      $result = $this->db->from('city')->where('city_id', $city)->get();
      if($result->num_rows() == 1) {
        $city_id = $result->row('city_id');
        if($area == 0) {
          $area_result = $this->db->from('area')->where(array('parent_city' => $city_id, 'area_name' => $area))->get();
          if($area_result->num_rows() == 1) {
            return false; // Area already exist.
          }
          else {          
            $this->db->insert('area', array('parent_city' => $city_id, 'area_name' => $area,'media_type'=>$media_type));
            return $this->db->insert_id();
          }

        } // City already exist.
      }
      /*
      else {
          $this->db->insert('city', array('city_name' => $city));
          $inserted_id = $this->db->insert_id();
          $this->db->insert('area', array('parent_city' => $inserted_id, 'area_name' => $area));
          return $this->db->insert_id();
             
      }*/
    }

    /* for area search on  mediatype
     function save_city_area_details($city, $area,$media_type) {

      $result = $this->db->from('city')->where('city_name', $city)->get();
      if($result->num_rows() == 1) {
        $city_id = $result->row('city_id');
        $area_result = $this->db->from('area')->where(array('parent_city' => $city_id, 'area_name' => $area,'media_type'=>$media_type))->get();
        if($area_result->num_rows() == 1) {
          return false;
        }
        else {          
          $this->db->insert('area', array('parent_city' => $city_id, 'area_name' => $area,'media_type'=>$media_type));
          return $this->db->insert_id();
        }
      }
      else {
          $this->db->insert('city', array('city_name' => $city));
          $inserted_id = $this->db->insert_id();
          $this->db->insert('area', array('parent_city' => $inserted_id, 'area_name' => $area));
          return $this->db->insert_id();
             
      }
    }
    */

    function save_user_details($user_array, $user_type) {
      if($user_type == 'owner') {
          $this->db->insert('owner_details', $user_array);
          return $this->db->insert_id();
      }
      else if($user_type == 'buyer') {
          $this->db->insert('buyer_details', $user_array);
          return $this->db->insert_id();
      }
    }
    function save_enquiry_review($input_array) {
        $this->db->where('enquiry_id',$input_array['enquiry_id']);
        $query = $this->db->update('enquiries', $input_array);
        return ($query) ? true : false ;      
    }
    /* *****************************
    ***       Save functions     ***
    */
    function save_apartment($input_array) {
    	$this->db->insert('apartments', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    function save_park($input_array) {
        $this->db->insert('business_park', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_event($input_array) {
        $this->db->insert('events_meta', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_malls($input_array) {
        $this->db->insert('malls_meta', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_radio($input_array) {
        $this->db->insert('radio', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_ads_category_details($input_array) {
        $this->db->insert('ads_category', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

    }
    function save_hoarding($input_array) {
        $this->db->insert('hoardings', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

  function save_apartment_ads($input_array) {
      $this->db->insert('apartment_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
  function save_event_ads($input_array) {
      $this->db->insert('event_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
  function save_mall_ads($input_array) {
      $this->db->insert('mall_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
  function save_radio_ads($input_array) {
      $this->db->insert('radio_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
  function save_park_ads($input_array) {
      $this->db->insert('business_park_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
  function save_hoarding_ads($input_array) {
      $this->db->insert('hoarding_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    function save_tc($input_array) {
      $this->db->where('id !=', 0);
        $this->db->delete('term_and_conditions');
        $this->db->insert_batch('term_and_conditions',$input_array);
        //return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    /* *****************************
    ***Save functions Ends here  ***
    */

    /* *****************************
    ***       Update functions   ***
    */
	
	function update_user($table,$input_array) {
        $this->db->where('user_id',$input_array['user_id']);
        $query = $this->db->update($table, $input_array);
        return ($query) ? true : false ;
        // or return updated_id instead of true.
    }
    function update_apartment($input_array) {
      $this->db->where('a_id',$input_array['a_id']);
      $query = $this->db->update('apartments', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_events($input_array) {
      $this->db->where('event_id',$input_array['event_id']);
      $query = $this->db->update('events_meta', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_parks($input_array) {
      $this->db->where('park_id',$input_array['park_id']);
      $query = $this->db->update('business_park', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_mall($input_array) {
      $this->db->where('mall_id',$input_array['mall_id']);
      $query = $this->db->update('malls_meta', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_hoardings($input_array) {
      $this->db->where('h_id',$input_array['h_id']);
      $query = $this->db->update('hoardings', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_radio($input_array) {
      $this->db->where('radio_station_id',$input_array['radio_station_id']);
      $query = $this->db->update('radio', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }

   function update_apartment_ads($input_array) {
      $this->db->where('ad_id',$input_array['ad_id']);
      $query = $this->db->update('apartment_ads', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }

    function update_event_ads($input_array) {
        $this->db->where('ad_id',$input_array['ad_id']);
        $query = $this->db->update('event_ads', $input_array);
        return ($query) ? true : false ;
        // or return updated_id instead of true.
    }

    function update_mall_ads($input_array) {
        $this->db->where('ad_id',$input_array['ad_id']);
        $query = $this->db->update('mall_ads', $input_array);
        return ($query) ? true : false ;
        // or return updated_id instead of true.
    }

    function update_radio_ads($input_array) {
        $this->db->where('ad_id',$input_array['ad_id']);
        $query = $this->db->update('radio_ads', $input_array);
        return ($query) ? true : false ;
        // or return updated_id instead of true.
    }

    function update_park_ads($input_array) {
        $this->db->where('ad_id',$input_array['ad_id']);
        $query = $this->db->update('business_park_ads', $input_array);
        return ($query) ? true : false ;
        // or return updated_id instead of true.
    }

    function update_hoarding_ads($input_array) {
        $this->db->where('h_id',$input_array['h_id']);
        $query = $this->db->update('hoarding_ads', $input_array);
        return ($query) ? true : false ;
        // or return updated_id instead of true.
    }


    /* *****************************
    ***Update functions Ends here  ***
    */

     /* *****************************
    ***Update status functions start here  ***
    */
	function change_users_status($user_id,$flag,$table_name) {
        $this->db->where('user_id',$user_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
    }
    function change_apartment_status($apartment_id,$flag,$table_name) {
        $this->db->where('a_id',$apartment_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
    }
     function change_events_status($event_id,$flag,$table_name) {
        $this->db->where('event_id',$event_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
    }
    function change_hoardings_status($h_id,$flag,$table_name){
    $this->db->where('h_id',$h_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }
    function change_malls_status($mall_id,$flag,$table_name){
    $this->db->where('mall_id',$mall_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }
    function change_parks_status($park_id,$flag,$table_name){
    $this->db->where('park_id',$park_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }
    function change_radios_status($radio_id,$flag,$table_name){
    $this->db->where('radio_station_id',$radio_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }


    function change_apartment_ads_status($ad_id,$flag,$table_name) {
        $this->db->where('ad_id',$ad_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
    }

     function change_event_ads_status($ad_id,$flag,$table_name) {
        $this->db->where('ad_id',$ad_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
    }


   function change_mall_ads_status($ad_id,$flag,$table_name){
    $this->db->where('ad_id',$ad_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }
     function change_park_ads_status($ad_id,$flag,$table_name){
    $this->db->where('ad_id',$ad_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }

    function change_radio_ads_status($ad_id,$flag,$table_name){
    $this->db->where('ad_id',$ad_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;

    }
 function change_status($city_id,$flag,$table_name) {
  if($table_name == 'area') {
        $this->db->where('area_id',$city_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
  }
  elseif ($table_name == 'city') {
        $this->db->where('city_id',$city_id);
        $query = $this->db->update($table_name, array('flag' => $flag));
        return ($query) ? true : false ;
  }
    }


function delete_cityarea($city_id,$table_name) {
  if($table_name == 'area') {
        $this->db->where('area_id',$city_id);
        $query = $this->db->delete($table_name);
        return ($query) ? true : false ;
  }
  elseif ($table_name == 'city') {
        $this->db->where('city_id',$city_id);
        $query = $this->db->delete($table_name);
        $this->db->where('parent_city',$city_id);
        $query = $this->db->delete("area");
        return ($query) ? true : false ;
  }
    }



      /* *****************************
    ***Update status functions end here  ***
    */
    
    /* *****************************
    ***delete  functions start here  ***
    */

	function delete_users($user_id,$flag,$table_name) {
        $query =  $this->db->get_where($table_name,array('user_id' => $user_id));
		if( $query->num_rows() > 0 )
		{
			$row = $query->row();
			$this->db->delete($table_name, array('user_id' => $user_id));
			return true;
		}
		return false;   
    }
     function delete_apartments($apartment_id,$flag,$table_name){
     
    $query =  $this->db->get_where($table_name,array('a_id' => $apartment_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->a_image;
        unlink(realpath('assets/uploads/apartments/'.$picture));
        $this->db->delete($table_name, array('a_id' => $apartment_id));
        return true;
    }
    return false;   

    }

      function delete_events($event_id,$flag,$table_name) {
      $query =  $this->db->get_where($table_name,array('event_id' => $event_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->event_image;
        unlink(realpath('assets/uploads/events/'.$picture));
        $this->db->delete($table_name, array('event_id' => $event_id));
        return true;
    }
    return false;   


    }
     function delete_hoardings($h_id,$flag,$table_name) {
      
           $query =  $this->db->get_where($table_name,array('h_id' => $h_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->ref_image;
        unlink(realpath('assets/uploads/hoarding_ads/'.$picture));
        $this->db->delete($table_name, array('h_id' => $h_id));
        return true;
    }
    return false;   


    }
function delete_malls($mall_id,$flag,$table_name) {
      
         $query =  $this->db->get_where($table_name,array('mall_id' => $mall_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->img_name;
        unlink(realpath('assets/uploads/malls/'.$picture));
        $this->db->delete($table_name, array('mall_id' => $mall_id));
        return true;
    }
    return false;   

    }
function delete_parks($park_id,$flag,$table_name){
    $query =  $this->db->get_where($table_name,array('park_id' => $park_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->park_image;
        unlink(realpath('assets/uploads/parks/'.$picture));
        $this->db->delete($table_name, array('park_id' => $park_id));
        return true;
    }
    return false;   

    }
    function delete_radio($radio_id,$flag,$table_name){
     $query =  $this->db->get_where($table_name,array('radio_station_id' => $radio_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->r_image;
        unlink(realpath('assets/uploads/radios/'.$picture));
        $this->db->delete($table_name, array('radio_station_id' => $radio_id));
        return true;
    }
    return false; 
    }

    
   
    function delete_apartment_ads($ad_id,$flag,$table_name){
     
    $query =  $this->db->get_where($table_name,array('ad_id' => $ad_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->ref_image;
        unlink(realpath('assets/uploads/apartment_ads/'.$picture));
        $this->db->delete($table_name, array('ad_id' => $ad_id));
        return true;
    }
    return false;   

    }

     function delete_event_ads($ad_id,$flag,$table_name) {
      $query =  $this->db->get_where($table_name,array('ad_id' => $ad_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->ref_image;
        unlink(realpath('assets/uploads/event_ads/'.$picture));
        $this->db->delete($table_name, array('ad_id' => $ad_id));
        return true;
    }
    return false;   


    }

    function delete_mall_ads($ad_id,$flag,$table_name) {
      
         $query =  $this->db->get_where($table_name,array('ad_id' => $ad_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->ref_image;
        unlink(realpath('assets/uploads/mall_ads/'.$picture));
        $this->db->delete($table_name, array('ad_id' => $ad_id));
        return true;
    }
    return false;   

    }

function delete_park_ads($ad_id,$flag,$table_name){
    $query =  $this->db->get_where($table_name,array('ad_id' => $ad_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->ref_image;
        unlink(realpath('assets/uploads/park_ads/'.$picture));
        $this->db->delete($table_name, array('ad_id' => $ad_id));
        return true;
    }
    return false;   

    }

     function delete_radio_ads($ad_id,$flag,$table_name){
     $query =  $this->db->get_where($table_name,array('ad_id' => $ad_id));
    if( $query->num_rows() > 0 )
    {
        $row = $query->row();
        $picture = $row->ref_image;
        unlink(realpath('assets/uploads/radio_ads/'.$picture));
        $this->db->delete($table_name, array('ad_id' => $ad_id));
        return true;
    }
    return false; 
    }






 /* *****************************
    ***delete  functions end here  ***
    */


  function save_enquiry($input_array)
  {

   $this->db->insert('enquiries', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

  }
  function approve_enquiries($enquiry_id, $flag) {
    $this->db->where('enquiry_id',$enquiry_id);
        $query = $this->db->update('enquiries', array('flag' => $flag));
        return ($query) ? true : false ;    
  }

 function save_ad($input_array)
  {
   $this->db->insert('saved_ads', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

  }



function save_recommended_media($input_array)
  {

   $this->db->insert('recommended', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

  }



}
