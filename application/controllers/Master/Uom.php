<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uom extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/M_uom','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $data['title'] = 'Data Uom';
        $data['data']  = $this->record->index();
        $this->load->view('master/v_uom', $data); 
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
        $m_uom_name   = addslashes($_POST['m_uom_name']);
        echo $this->record->create($m_uom_name);
    }     

    function update(){
        if(!isset($_POST))	
            show_404();
        $m_uom_id     = addslashes($_POST['m_uom_id']);
        $m_uom_name   = addslashes($_POST['m_uom_name']);
        echo $this->record->update($m_uom_id, $m_uom_name);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();
        $m_uom_id  = addslashes($_POST['Id']);
        echo $this->record->delete($m_uom_id);
    }

}