<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BalanceMaterial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inquiry/M_balance_material','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $data['title']      = 'Balance Material';
        $data['data']       = $this->record->index();
        $this->load->view('inquiry/v_balance_material', $data); 
    } 

}