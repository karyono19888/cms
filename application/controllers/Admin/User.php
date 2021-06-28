<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth');
		$this->auth->cek_login();
        $this->load->model('admin/m_user','record');
    }
    
    function index(){
        $data['title'] = 'Data User';
        $data['user'] = $this->record->index();
        $data['level'] = $this->record->getLevel();
        $this->load->view('admin/v_user', $data); 
    } 

    function create(){
        if(!isset($_POST))	
            show_404();

        $a_user_name        = addslashes($_POST['a_user_name']);
        $a_user_username    = addslashes($_POST['a_user_username']);
        $a_user_password    = addslashes($_POST['a_user_password']);
        $a_user_level       = addslashes($_POST['a_user_level']);
        
        echo $this->record->create($a_user_name, $a_user_username, $a_user_password, $a_user_level);
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
        
        $a_user_id          = addslashes($_POST['a_user_id']);
        $a_user_name        = addslashes($_POST['a_user_name']);
        $a_user_username    = addslashes($_POST['a_user_username']);
        $a_user_password    = addslashes($_POST['a_user_password']);
        $a_user_level       = addslashes($_POST['a_user_level']);
        
        echo $this->record->update($a_user_id, $a_user_name, $a_user_username, $a_user_password, $a_user_level);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();

        $a_user_id  = addslashes($_POST['a_user_id']);
        echo $this->record->delete($a_user_id);
    }

}