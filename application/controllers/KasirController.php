<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KasirController extends CI_Controller {

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
		$this->load->model('M_meja');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{	
	
		 $this->load->view('Kasir/v_header.php');
		 $this->load->view('Kasir/v_sidebar.php');
		 $this->load->view('Kasir/v_mainpage.php');
		 $this->load->view('Kasir/v_footer.php');

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function TambahOrderBaru()
	{	
		 $data = array();
		 $data['listMeja'] = $this->M_meja->selectAll();
		 $this->load->view('Kasir/v_header.php',$data);
		 $this->load->view('Kasir/v_sidebar.php',$data);
		 $this->load->view('Kasir/v_add_new_order.php',$data);
		 $this->load->view('Kasir/v_footer.php',$data);

		//$this->load->view('MainPage/v_mainpage.php');
	}

}
