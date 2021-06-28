<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_inquiry','record');
        //$this->auth->restrict();
    }

    function oee(){
        echo $this->record->oee();   
    }

    //////////////////////

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */