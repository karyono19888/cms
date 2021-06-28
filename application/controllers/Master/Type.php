<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/M_type','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $data['title'] = 'Data Type';
        $data['data']  = $this->record->index();
        $this->load->view('master/v_type', $data); 
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
        $m_type_name   = addslashes($_POST['m_type_name']);
        echo $this->record->create($m_type_name);
    }     

    function update(){
        if(!isset($_POST))	
            show_404();
        $m_type_id     = addslashes($_POST['m_type_id']);
        $m_type_name   = addslashes($_POST['m_type_name']);
        echo $this->record->update($m_type_id, $m_type_name);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();
        $m_type_id  = addslashes($_POST['Id']);
        echo $this->record->delete($m_type_id);
    }

}