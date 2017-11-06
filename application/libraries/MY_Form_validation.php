<?php

class MY_Form_validation extends CI_Form_validation {

    public function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
    }

    public function clear_field_data() {
        $this->_field_data = array();
        return $this;
    }
    public function is_exhibitor_detail_unique($cmpny_id, $field_val, $type) {
    	return $this->CI->get_data_model->is_exhibitor_detail_unique($cmpny_id, $field_val, $type);
    }    
}

?>