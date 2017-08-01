<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();

		// if ($this->session->userdata('SESS_AKUN_IS_LOGIN') && $this->session->userdata('SESS_AKUN_USER_PRIV') === 1) {
		// 	redirect(base_url('akun/dashboard'));
		// }
		
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('m_login');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{
		 $this->load->view('FrontPage/header.php');
		 $this->load->view('FrontPage/v_login.php');
		 $this->load->view('FrontPage/footer.php');

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array();
		$data['username'] = $username;
		$data['password'] = $password;
		$user = $this->m_login->login($data);
		if(sizeof($user)>0){
			if($user->privilege=="super"){
				redirect('AdminController');
			}else if($user->privilege=="kasir"){
				redirect('KasirController');
			}	
		}else{
			echo "not registered";
		}
	}
	function logout()
	{
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
	}
}
