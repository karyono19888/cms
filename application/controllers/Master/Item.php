<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth');
		$this->auth->cek_login();
        $this->load->model('master/M_item','record');    
    }
    
    function index(){
        $data['title'] = 'Data Item';
        $data['data']  = $this->record->index();
        $data['category'] = $this->record->getCategory();
        $data['uom'] = $this->record->getUom();
        $data['type'] = $this->record->getType();
        $this->load->view('master/v_item', $data); 
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
        $m_item_name          = addslashes($_POST['m_item_name']); 
        $m_item_model         = addslashes($_POST['m_item_model']);
        $m_item_spesifikasi   = addslashes($_POST['m_item_spesifikasi']);
        $m_item_bq            = addslashes($_POST['m_item_bq']);
        $m_item_kg_sheet      = addslashes($_POST['m_item_kg_sheet']);  
        $m_item_part_no_glc   = addslashes($_POST['m_item_part_no_glc']); 
        $m_item_job_no        = addslashes($_POST['m_item_job_no']);  
        $m_item_part_dlv      = addslashes($_POST['m_item_part_dlv']);
        $m_item_category      = addslashes($_POST['m_item_category']);   
        $m_item_uom           = addslashes($_POST['m_item_uom']);
        $m_item_type          = addslashes($_POST['m_item_type']);
        echo $this->record->create($m_item_name,$m_item_model,$m_item_spesifikasi,$m_item_bq,$m_item_kg_sheet,$m_item_part_no_glc,$m_item_job_no,$m_item_part_dlv,$m_item_category,$m_item_uom,$m_item_type);
        
    }     
    
    function update(){
        if(!isset($_POST))	
            show_404();
        $m_item_id          = addslashes($_POST['m_item_id']);
        $m_item_name          = addslashes($_POST['m_item_name']); 
        $m_item_model         = addslashes($_POST['m_item_model']);
        $m_item_spesifikasi   = addslashes($_POST['m_item_spesifikasi']);
        $m_item_bq            = addslashes($_POST['m_item_bq']);
        $m_item_kg_sheet      = addslashes($_POST['m_item_kg_sheet']);  
        $m_item_part_no_glc   = addslashes($_POST['m_item_part_no_glc']); 
        $m_item_job_no        = addslashes($_POST['m_item_job_no']);  
        $m_item_part_dlv      = addslashes($_POST['m_item_part_dlv']); 
        $m_item_category      = addslashes($_POST['m_item_category']);   
        $m_item_uom           = addslashes($_POST['m_item_uom']);
        $m_item_type          = addslashes($_POST['m_item_type']);
        echo $this->record->update($m_item_id,$m_item_name,$m_item_model,$m_item_spesifikasi,$m_item_bq,$m_item_kg_sheet,$m_item_part_no_glc,$m_item_job_no,$m_item_part_dlv,$m_item_category,$m_item_uom,$m_item_type);
        
    }
        
    function delete(){
        if(!isset($_POST))	
            show_404();
        $m_item_id          = addslashes($_POST['Id']);
        echo $this->record->delete($m_item_id);
        
    }

}

/* End of file Item.php */
/* Location: ./application/controllers/master/Item.php */