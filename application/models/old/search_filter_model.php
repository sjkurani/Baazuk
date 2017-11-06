<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_filter_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //fetch books
    function search_exhibititions($limit, $start, $st = NULL)
    {
        if ($st == "NIL") $st = "";
        $sql = "select * from exhibition_details where ex_name like '%$st%' limit " . $start . ", " . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function get_books_count($st = NULL)
    {
        if ($st == "NIL") $st = "";
        $sql = "select * from exhibition_details where ex_name like '%$st%'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}
