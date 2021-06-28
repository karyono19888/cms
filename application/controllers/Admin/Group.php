<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth');
		$this->auth->cek_login();
        $this->load->model('admin/M_group','record');
    }
    
    function index(){
        $data['title'] = 'Data Group';
        $data['data']  = $this->record->index();
        $this->load->view('admin/v_group', $data); 
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
        $a_level_name   = addslashes($_POST['a_level_name']);
        echo $this->record->create($a_level_name);
    }     

    function update(){
        if(!isset($_POST))	
            show_404();
        $a_level_id     = addslashes($_POST['a_level_id']);
        $a_level_name   = addslashes($_POST['a_level_name']);
        echo $this->record->update($a_level_id, $a_level_name);
    }   
    
    function delete(){
        if(!isset($_POST))	
            show_404();
        $a_level_id  = addslashes($_POST['Id']);
        echo $this->record->delete($a_level_id);
    }

    function menu(){
        if(!isset($_POST))	
            show_404();
        $a_level_id  = addslashes($_POST['myid']);
        echo $this->record->menu($a_level_id);
    }

    function akses(){
        if(!isset($_POST))	
            show_404();
        $a_mn_grp_id   = addslashes($_POST['myid']);
        $a_mn_grp_sts  = addslashes($_POST['mysts']);
        $a_mn_grp_lvl  = addslashes($_POST['mylvl']);
        echo $this->record->akses($a_mn_grp_id, $a_mn_grp_sts, $a_mn_grp_lvl);
    }

}