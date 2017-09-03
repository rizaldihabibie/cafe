<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriMakananController extends CI_Controller {

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
		$this->load->model('M_jenis_makanan');
		$this->load->helper(array('form','url', 'text_helper','date','file'));
		$this->load->library(array('Pagination','image_lib','session'));
		// $this->load->library('Userauth');
		
	}

	public function index()
	{	
		 $data = array();
		 $data['listKategori'] = $this->M_jenis_makanan->selectFoodOnly();
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_add_kategori_makanan.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function saveCategory(){
		$categoryName = $this->input->post('namaKategori');
		$data = array();
		$data["nama_jenis_makanan"] = $categoryName;
		$data["kategori"] = 0;
		if($categoryName == null || $categoryName = ""){
			$this->session->set_flashdata('error', 'Nama Kategori Kosong !');
			$this->index();
			// redirect("KategoriMakananController/index/");
		}else{
			if($this->M_jenis_makanan->saveCategory($data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				// redirect("KategoriMakananController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				// redirect("KategoriMakananController/index/");
			}
		}
	}

		public function deleteKategoriMakanan()
	{
			$id = $this->input->post('idDeleteKategoriMakanan');
			$dataKategoriMakan = array();
			$dataKategoriMakan['status'] = "NON AKTIF";
			if($this->M_jenis_makanan->deleteCategoryFood($id,$dataKategoriMakan)){
				$this->index();
			}
	}


	public function editKategori($idKategori)
	{
		 $data = array();
		 $kategori =  $this->M_jenis_makanan->findById($idKategori);
		 $data['kategori'] = $kategori;
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_edit_kategori_makanan.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);
	}
	public function saveUpdate(){
		$categoryName = $this->input->post('namaKategori');
		$Status = $this->input->post('status');
		$id = $this->input->post('idData');
		$data = array();
		$data["nama_jenis_makanan"] = $categoryName;
		$data["status"] = $Status;
		$data["kategori"] = 0;
		if($categoryName == null || $categoryName = ""){
			$this->session->set_flashdata('error', 'Nama Kategori Kosong !');
			$this->index();
			// redirect("KategoriMakananController/index/");
		}else{
			if($this->M_jenis_makanan->updateCategory($id,$data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				// redirect("KategoriMakananController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				// redirect("KategoriMakananController/index/");
			}
		}
	}
}
