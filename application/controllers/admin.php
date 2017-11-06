<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    function index()
    {
        $this->load->library('f/FirebaseLib');
        echo "string";
        //print_r($this->pro->initCurlHandler());
    }
}