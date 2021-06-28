<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth');
		$this->auth->cek_login();
        $this->load->model('master/M_category','record');
    }
    
    function index(){
        $data['title'] = 'Data Category';
        $data['data']  = $this->record->index();
        $this->load->view('master/v_category', $data); 
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
        $m_category_name   = addslashes($_POST['m_category_name']);
        echo $this->record->create($m_category_name);
    }     

    function update(){
        if(!isset($_POST))	
            show_404();
        $m_category_id     = addslashes($_POST['m_category_id']);
        $m_category_name   = addslashes($_POST['m_category_name']);
        echo $this->record->update($m_category_id, $m_category_name);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();
        $m_category_id  = addslashes($_POST['Id']);
        echo $this->record->delete($m_category_id);
    }

}