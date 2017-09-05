<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuMinumanController extends CI_Controller {

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
		$this->load->model('M_jenis_makanan');
		$this->load->model('M_menu');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{
		 $data = array();
		 $data['listKategori'] = $this->M_jenis_makanan->selectDrinkOnly();
		 $data['listMinuman'] = $this->M_menu->selectDrinkOnly();
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_add_minuman.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);
	}

	public function saveMenu(){
		$categoryName = $this->input->post('namaKategori');
		$namaMakanan = $this->input->post('namaMakanan');
		$hargaPokokMakanan = $this->input->post('hargaPokokMakanan');
		$hargaJualMakanan = $this->input->post('hargaJualMakanan');

		$data = array();
		$data["id_jenis_makanan"] = $categoryName;
		$data["harga_pokok"] = $hargaPokokMakanan;
		$data["nama_menu"] = $namaMakanan;
		$data["harga_jual"] = $hargaJualMakanan;
		$data["kategori"] = 1;
		if($categoryName == "0-0" || $hargaPokokMakanan == "" || $hargaJualMakanan = ""){
			$this->session->set_flashdata('error', 'Isi Semua Data !');
			$this->index();
			// redirect("MenuMinumanController/index/");
		}else{
			if($this->M_menu->saveMenu($data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				// redirect("MenuMinumanController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				// redirect("MenuMinumanController/index/");
			}
		}
	}
	public function editMinuman($idMenu)
	{
		 $data = array();
		 $menu =  $this->M_menu->findById($idMenu);
		 $data['listKategori'] = $this->M_jenis_makanan->findByCategory($menu->kategori);
		 $data['menu'] = $menu;
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_edit_menu_minuman.php',$data);
		 $this->load->view('superadmin/v_footer.php',$data);
	}

		public function deleteMenuMinuman()
	{
			$id = $this->input->post('idDeleteMenuMinuman');
			$dataMenuMinum = array();
			$dataMenuMinum['status'] = "NON AKTIF";
			if($this->M_menu->updateMenu($id,$dataMenuMinum)){
				$this->index();
			}
	}


	public function saveUpdate(){
		$categoryName = $this->input->post('namaKategori');
		$namaMakanan = $this->input->post('namaMinuman');
		$hargaPokokMakanan = $this->input->post('hargaPokokMinuman');
		$hargaJualMakanan = $this->input->post('hargaJualMinuman');
		$Status = $this->input->post('status');
		$id = $this->input->post("idData");

		$data = array();
		$data["id_jenis_makanan"] = $categoryName;
		$data["harga_pokok"] = $hargaPokokMakanan;
		$data["nama_menu"] = $namaMakanan;
		$data["harga_jual"] = $hargaJualMakanan;
		$data["kategori"] = 1;
		$data["status"] = "AKTIF";
		if($categoryName == "0-0" || $hargaPokokMakanan == "" || $hargaJualMakanan = ""){
			$this->session->set_flashdata('error', 'Isi Semua Data !');
			$this->index();
			// redirect("MenuMinumanController/index/");
		}else{
			if($this->M_menu->updateMenu($id,$data)){
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan !');
				$this->index();
				// redirect("MenuMinumanController/index/");
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Disimpan !');
				$this->index();
				// redirect("MenuMinumanController/index/");
			}
		}
	}
}
