<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth');
		$this->auth->cek_login();
        $this->load->model('master/M_bp','record');        
    }
    
    function index(){
        $data['title'] = 'Business Partner';
        $data['data']  = $this->record->index();
        $this->load->view('master/v_bp', $data); 
    } 

    function view(){
        if(!isset($_POST))	
            show_404();
        $myid           = addslashes($_POST['myid']);
        echo $this->record->view($myid);
    }
    
    function create(){
        if(!isset($_POST))	
            show_404();
        $m_bp_code        = addslashes($_POST['m_bp_code']);
        $m_bp_name        = addslashes($_POST['m_bp_name']); 
        $m_bp_ctc         = addslashes($_POST['m_bp_ctc']);
        $m_bp_alt         = addslashes($_POST['m_bp_alt']);
        $m_bp_tlp         = addslashes($_POST['m_bp_tlp']);
        $m_bp_fax         = addslashes($_POST['m_bp_fax']);  
        $m_bp_active      = addslashes($_POST['m_bp_active']); 
        $m_bp_jns         = addslashes($_POST['m_bp_jns']);     
        echo $this->record->create($m_bp_code,$m_bp_name,$m_bp_ctc,$m_bp_alt,$m_bp_tlp,$m_bp_fax,$m_bp_active,$m_bp_jns);
        
    }     
    
    function update(){
        if(!isset($_POST))	
            show_404();
        $m_bp_id          = addslashes($_POST['m_bp_id']);
        $m_bp_code        = addslashes($_POST['m_bp_code']);
        $m_bp_name        = addslashes($_POST['m_bp_name']); 
        $m_bp_ctc         = addslashes($_POST['m_bp_ctc']);
        $m_bp_alt         = addslashes($_POST['m_bp_alt']);
        $m_bp_tlp         = addslashes($_POST['m_bp_tlp']);
        $m_bp_fax         = addslashes($_POST['m_bp_fax']); 
        $m_bp_active      = addslashes($_POST['m_bp_active']);
        $m_bp_jns         = addslashes($_POST['m_bp_jns']);   
        echo $this->record->update($m_bp_id,$m_bp_code,$m_bp_name,$m_bp_ctc,$m_bp_alt,$m_bp_tlp,$m_bp_fax,$m_bp_active,$m_bp_jns);
        
    }
        
    function delete(){
        if(!isset($_POST))	
            show_404();
        $m_bp_id          = addslashes($_POST['Id']);
        echo $this->record->delete($m_bp_id);
        
    }

}

/* End of file customer.php */
/* Location: ./application/controllers/master/customer.php */