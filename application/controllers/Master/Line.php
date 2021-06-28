<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Line extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/M_line','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $data['title'] = 'Data Line';
        $data['data']  = $this->record->index();
        $this->load->view('master/v_line', $data); 
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
        $m_line_name       = addslashes($_POST['m_line_name']);
        $m_line_leader     = addslashes($_POST['m_line_leader']);
        $m_line_keterangan = addslashes($_POST['m_line_keterangan']);
        echo $this->record->create($m_line_name, $m_line_leader, $m_line_keterangan);
    }     

    function update(){
        if(!isset($_POST))	
            show_404();
        $m_line_id     = addslashes($_POST['m_line_id']);
        $m_line_name   = addslashes($_POST['m_line_name']);
        $m_line_leader     = addslashes($_POST['m_line_leader']);
        $m_line_keterangan = addslashes($_POST['m_line_keterangan']);
        echo $this->record->update($m_line_id, $m_line_name, $m_line_leader, $m_line_keterangan);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();
        $m_line_id  = addslashes($_POST['Id']);
        echo $this->record->delete($m_line_id);
    }

}