<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Social extends CI_Controller {
    public function __construct()
    {
    parent::__construct();
    //libraries and helpers are loaded in autoload.php
    $this->load->model('get_data_model');
    $this->load->model('save_update_model');

    }

    public function session($provider) {
        $data['session_data'] = $this->session->all_userdata();
        if(isset($data['session_data']['logged_in']) && !empty($data['session_data']['logged_in'])) {
            redirect(base_url().'account/signin','refresh');
        }

    //   $this->load->helper('url_helper');
         //facebook
         if($provider == 'facebook') {
                $app_id = '991323904297315'; // $this->config->item('1717169931861075');
        $app_secret = '7a325de1829f5f67204b1f5332161474'; //  $this->config->item('5ff5d3a4ecec6b843e48ffa11eaef1f3');      
        $provider   = $this->oauth2->provider($provider, array(
            'id' => $app_id,
            'secret' => $app_secret,
            ));         
        }
    //google
        else if($provider == 'google'){

            $app_id         = '713903935498-hjr0mckmpc172d2696pgbdhr7aqk3gat.apps.googleusercontent.com'; //$this->config->item('googleplus_appid');
            $app_secret     = 'F4GB9HXDj1ExZUsIqPog5pDB'; //$this->config->item('googleplus_appsecret');
            $provider       = $this->oauth2->provider($provider, array(
                'id' => $app_id,
                'secret' => $app_secret,
            ));             
        }

    //foursquare
        else if($provider == 'foursquare'){

            $app_id     = $this->config->item('foursquare_appid');
            $app_secret = $this->config->item('foursquare_appsecret');
            $provider   = $this->oauth2->provider($provider, array(
                'id' => $app_id,
                'secret' => $app_secret,
            ));             
        }

    if ( ! $this->input->get('code'))
        {  
            // By sending no options it'll come back here
            $provider->authorize();
            redirect('social/error');
        }
        else
        {
            // Howzit?
            try
            {
                $token = $provider->access($_GET['code']);
                $user = $provider->get_user_info($token);
                if($this->uri->segment(3) == 'google'){
                     //Your code stuff here 
                }

                elseif($this->uri->segment(3) == 'facebook'){
                    //your facebook stuff here         
                    

                }elseif($this->uri->segment(3) == 'foursquare'){
                    // your code stuff here
                }

            $this->session->set_flashdata('user_info',$user);
                $this->session->set_flashdata('provider',$this->uri->segment(3));
                redirect('social/success');
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }
    
    function success() {
      /*  $user_array = array('uid' => 77425545633087, 'email' => 'sjkurani@gmail.com', 'nickname' => '', 'gender' => 'male', 'name' => 'Shridhar Kurani','image' => 'a.png', 'urls' => array('Facebook' => 'sjkurani'));
        $provider = 'provider_name';//$this->session->flashdata('provider');
        */
        $user_array = $this->session->flashdata('user_info');
        $provider = $this->session->flashdata('provider');
        if(!empty($user_array)) {
            $user_social_id = (!empty($user_array['uid']) ? $user_array['uid'] : 0 );
            $returned_val = 0;
            $returned_email = $this->get_data_model->get_user_email_based_on_social_id($user_social_id,$provider);

            if(!empty($returned_email)) {
                $valid_fields = $this->get_data_model->get_valid_user($returned_email);
                $sessiondata = array(
                'user_id' => (int)$valid_fields['user_id'],
                'user_email' =>  $valid_fields['email'],
                'user_mobile' =>  $valid_fields['mobile'],
                'user_full_name' =>  $valid_fields['fullname'],
                'visitor_profile_id' => (int)$valid_fields['visitor_id'],
                'exhibitor_short_name' => $valid_fields['exhibitor_cmpny_short_name'],
                'exhibitor_profile_id' => (int)$valid_fields['exhibitor_id'],
                'organizer_short_name' => $valid_fields['oc_short_name'],
                'organizer_profile_id' => (int)$valid_fields['oc_id'],
                'logged_in' => TRUE
                );

                $this->session->set_userdata($sessiondata);
            }
            else {
                //signup , set session and signin.
                $signup_array = $social_array = $visitor_array = array();
                $signup_array['fullname'] = $user_array['name'];
                $user_email_array = explode('@', $user_array['email']);
                $signup_array['username'] = $user_email_array[0];
                $signup_array['email'] = $user_array['email'];
                $signup_array['flag'] = 1;
                //$signup_array['nickname'] = $this->encrypt->encode($this->input->post('password'));

                $returned_val = $this->save_update_model->save_signup_details($signup_array);
                log_message('error',  "INFO: Signup by social with ID: ". json_encode($returned_val)." and name: ".json_encode($signup_array));
                
                $social_array['user_id'] = $returned_val;
                $social_array['provider'] = $provider;
                $social_array['user_social_id'] = $user_array['uid'];
                $this->save_update_model->save_user_social_details($social_array);
                log_message('error',  "INFO: User social details with ID: ". json_encode($returned_val)." and name: ".json_encode($social_array));
                if(isset($user_array['location']) && !empty($user_array['location'])) {
                    $visitor_array['visitor_city'] = $user_array['location'];
                }

                if(isset($user_array['gender'])) {
                    $visitor_array['gender'] = $user_array['gender'];   
                }
                //$visitor_array['profile_pic'] = isset($user_array['image']) ? $user_array['image'] : '';
                $visitor_array['visitor_id'] = $visitor_array['user_id'] = $returned_val;
                $visitor_array['user_fb_link'] = (isset($user_array['urls']['Facebook']) && !empty($user_array['urls']['Facebook'])) ? $user_array['urls']['Facebook']: '' ;
                $visitor_array['user_other_link'] = (isset($user_array['urls'][0]) && !empty($user_array['urls']['urls'][0])) ? $user_array['urls'][0]: '' ; //Google plus link
                $this->save_update_model->visitor_profile_details($visitor_array, $returned_val);
                log_message('error',  "INFO: User by social with ID: ". json_encode($returned_val)." and details: ".json_encode($visitor_array));

                $valid_fields = $this->get_data_model->get_valid_user($user_array['email']);
                $sessiondata = array(
                    'user_id' => (int)$valid_fields['user_id'],
                    'user_email' =>  $valid_fields['email'],
                    'user_mobile' =>  $valid_fields['mobile'],
                    'user_full_name' =>  $valid_fields['fullname'],
                    'visitor_profile_id' => (int)$valid_fields['visitor_id'],
                    'exhibitor_short_name' => $valid_fields['exhibitor_cmpny_short_name'],
                    'exhibitor_profile_id' => (int)$valid_fields['exhibitor_id'],
                    'organizer_short_name' => $valid_fields['oc_short_name'],
                    'organizer_profile_id' => (int)$valid_fields['oc_id'],
                    'logged_in' => TRUE
                    );
                $this->session->set_userdata($sessiondata);
            }
            //$this->session->set_flashdata('msg',"Succesfully logged in using social login buttons");
            redirect(base_url().'myprofile/edit','refresh');
            }
        else {
            $this->session->set_flashdata('errormsg',"Something went wrong could not able to login through social login button. Please try again");
            redirect(base_url().'account/signin','refresh');
        }
    }
}