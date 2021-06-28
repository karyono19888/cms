<?php 
class Auth extends CI_Model 
{
	
	public function __construct()
	{
        parent::__construct();
	}
 
	function register($username,$password,$nama)
	{
		$data_user = array(
			'username'=>$username,
			'password'=>password_hash($password,PASSWORD_DEFAULT),
			'nama'=>$nama
		);
		$this->db->insert('tb_user',$data_user);
	}

    function login_user($username,$password)
	{
        $query = $this->db->get_where('a_user',array('a_user_username'=>$username));
        if($query->num_rows() > 0)
        {
            $data_user = $query->row();
            if (password_verify($password, $data_user->a_user_password)) {
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('id', $data_user->a_user_id);
                $this->session->set_userdata('nama', $data_user->a_user_name);
                $this->session->set_userdata('level', $data_user->a_user_level);
				$this->session->set_userdata('is_login', TRUE);
                return TRUE;
            } else {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
	}
	
    function cek_login()
    {
        if(empty($this->session->userdata('is_login')))
        {
			redirect('login');
		}
    }

}
?>