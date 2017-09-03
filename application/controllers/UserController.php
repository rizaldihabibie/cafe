<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

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
		$this->load->helper(array('form','url', 'text_helper','date','file'));
		$this->load->library(array('Pagination','image_lib','session'));
		$this->load->model('M_user');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{
		 $data = array();
		 $data['listUser'] = $this->M_user->selectAll();
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_add_user.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);
	}

	public function saveUser(){
		$Username = $this->input->post('username');
		$Password = $this->input->post('password');
		$NamaLengkap = $this->input->post('namalengkap');
		$Alamat = $this->input->post('alamat');
		$NoTelepon = $this->input->post('notelepon');
		$Noktp = $this->input->post('noktp');
		$Jabatan = $this->input->post('jabatan');
		$Status = $this->input->post('status');
        $Passs=md5($Password);

		$data = array();
		$data["username"] = $Username;
		$data["password"] = $Passs;
		$data["namalengkap"] = $NamaLengkap;
		$data["alamat"] = $Alamat;		
		$data["notelepon"] = $NoTelepon;
		$data["noktp"] = $Noktp;
		$data["jabatan"] = $Jabatan;
		$data["status"] = $Status;
		if($Username == "" || $Password == "" || $NamaLengkap = "" || $NoTelepon = "" || $Noktp = "" || $Alamat = ""){
			$this->session->set_flashdata('error', 'Isi Semua Data !');
			redirect("UserController/index/");
		}else{
			if($this->M_user->saveUser($data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				//redirect("UserController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				//redirect("UserController/index/");
			}
		}
	}
	public function editUser($idCreden)
	{
		 $data = array();
		 $user =  $this->M_user->findById($idCreden);
		 $data['user'] = $user;
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_edit_user.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);
	}
   
   	public function gantiPass($idCreden)
	{
		 $data = array();
		 $user =  $this->M_user->findById($idCreden);
		 $data['user'] = $user;
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_ganti_pass.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);
	}

     	public function deleteUser()
	{
			$id = $this->input->post('idDeleteUser');
			$dataUser = array();
			$dataUser['status'] = "PASIF";
			if($this->M_user->deleteUser($id,$dataUser)){
				$this->index();
			}
	}

	public function saveUpdate(){
	    $Username = $this->input->post('username');
		$NamaLengkap = $this->input->post('namalengkap');
		$Alamat = $this->input->post('alamat');
		$NoTelepon = $this->input->post('notelepon');
		$Noktp = $this->input->post('noktp');
		$Jabatan = $this->input->post('jabatan');
		$Status = $this->input->post('status');
		$id = $this->input->post("idData");

		$data = array();
		$data["username"] = $Username;
		$data["namalengkap"] = $NamaLengkap;
		$data["alamat"] = $Alamat;		
		$data["notelepon"] = $NoTelepon;
		$data["noktp"] = $Noktp;
		$data["jabatan"] = $Jabatan;
		$data["status"] = $Status;
		$data["id"] = $id;


		if( $NamaLengkap = "" || $NoTelepon = "" || $Noktp = "" || $Alamat = ""){
			$this->session->set_flashdata('error', 'Isi Semua Data !');
			$this->index();
			//redirect("UserController/index/");
		}else{
			if($this->M_user->updateUser($id,$data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				//redirect("UserController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				//redirect("UserController/index/");
			}
		}
	}

	
	public function savePass(){
	
		$PasswordBaru = $this->input->post('password_baru');
		$PasswordUlang = $this->input->post('password_ulang');
		$id = $this->input->post("idData");
		
        $Passs=md5($PasswordBaru);
		$Passs2=md5($PasswordUlang);
	

		$data = array();
		
		$data["password_baru"] = $Passs;
		$data["password_ulang"] = $Passs2;
		$data["id"] = $id;
		
		if($PasswordUlang == "" || $PasswordBaru == "" ){
			$this->session->set_flashdata('error', 'Isi Semua Data !');
			$this->index();
			//redirect("UserController/index/");
		}else if($PasswordUlang != $PasswordBaru  ){
			$this->session->set_flashdata('error', 'Password Baru dan Ulang Password tidak sama !');
			$this->index();
			//redirect("UserController/index/");	
		}else{
			if($this->M_user->updatePasswordBaru($id,$data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				//redirect("UserController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				//redirect("UserController/index/");
			}
		}
	}
}

