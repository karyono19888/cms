<?php
class M_main extends CI_Model{

    static $table1  = 'a_mn';
	static $table2  = 'a_mn_grp';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    
}
