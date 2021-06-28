<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->auth->cek_login();
	}
 
	public function index()
	{
		$this->load->view('v_main');
    }
    
    public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}