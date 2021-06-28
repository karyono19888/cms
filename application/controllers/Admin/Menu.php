<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth');
		$this->auth->cek_login();
        $this->load->model('admin/M_menu','record');
    }
    
    function index(){
        $data['title'] = 'Data Menu';
        $data['data'] = $this->record->index();
        $data['menu'] = $this->record->getMenu();
        $this->load->view('admin/v_menu', $data); 
    } 

    function create(){
        if(!isset($_POST))	
            show_404();
        
        $a_mn_parentId      = addslashes($_POST['a_mn_parentId']);
        $a_mn_name          = addslashes($_POST['a_mn_name']);
        $a_mn_link          = addslashes($_POST['a_mn_link']);
        $a_mn_icon          = addslashes($_POST['a_mn_icon']);
        
        echo $this->record->create($a_mn_parentId, $a_mn_name, $a_mn_link, $a_mn_icon);
    }       

    function view(){
        if(!isset($_POST))	
            show_404();

        $myid        = addslashes($_POST['myid']);
        echo $this->record->view($myid);
    }

    function update(){
        if(!isset($_POST))	
            show_404();
        
        $a_mn_id            = addslashes($_POST['a_mn_id']);
        $a_mn_parentId      = addslashes($_POST['a_mn_parentId']);
        $a_mn_name          = addslashes($_POST['a_mn_name']);
        $a_mn_link          = addslashes($_POST['a_mn_link']);
        $a_mn_icon          = addslashes($_POST['a_mn_icon']);
        
        echo $this->record->update($a_mn_id, $a_mn_parentId, $a_mn_name, $a_mn_link, $a_mn_icon);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();

        $a_mn_id  = addslashes($_POST['a_mn_id']);
        echo $this->record->delete($a_mn_id);
    }

}