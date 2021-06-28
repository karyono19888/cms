<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Login extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
	}
 
	public function index()
	{
		$this->load->view('v_login');
	}
 
	public function proses()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($this->auth->login_user($username,$password))
		{
			$this->session->set_flashdata('success','Login Success...');
			redirect('main');
		}
		else
		{
			$this->session->set_flashdata('error','Username & Password Invalid!');
			redirect('login');
		}
	}
 
}