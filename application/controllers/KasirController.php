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
		
		$this->load->helper(array('form','url', 'text_helper','date','file'));
		$this->load->library(array('Pagination','image_lib','session'));
		$this->load->model('M_meja');
		$this->load->model('M_jenis_makanan');
		$this->load->model('M_menu');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{	
	
		 $this->load->view('Kasir/v_header.php');
		 $this->load->view('Kasir/v_sidebar.php');
		 $this->load->view('Kasir/v_mainpage.php');
		 $this->load->view('Kasir/v_footer.php');
	}

	public function TambahOrderBaru()
	{	
		 $data = array();
		 $data['listMeja'] = $this->M_meja->selectAll();
		 $this->load->view('Kasir/v_header.php',$data);
		 $this->load->view('Kasir/v_sidebar.php',$data);
		 $this->load->view('Kasir/v_choose_table.php',$data);
		 $this->load->view('Kasir/v_footer.php',$data);

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function saveTable(){

		$input = array();
		$dataTable = $this->M_meja->selectAll();
		foreach ($dataTable as $row) {
			$x = $this->input->post($row->id_meja);
			if($x != ""){
				$input[] = $row->id_meja;
			}
				
		}
		if(sizeof($input)==0){
			redirect("KasirController/TambahOrderBaru/");
		}else{
			$this->session->set_flashdata('dataTable', $input);
			$data = array();
		 	$data['listKategoriMakanan'] = $this->M_jenis_makanan->selectFoodOnly();
		 	$data['listKategoriMinuman'] = $this->M_jenis_makanan->selectDrinkOnly();
		 	$data['listMenu'] = $this->M_menu->selectAll();
		 	$data['menuArray'] = $this->M_menu->selectArray();
		 	// $data['listWaitress'] = $this->M_user->selectWaitress();
			$this->load->view('Kasir/v_header.php',$data);
			$this->load->view('Kasir/v_sidebar.php',$data);
			$this->load->view('Kasir/v_input_order.php',$data);
			$this->load->view('Kasir/v_footer.php',$data);
		}
	}

	public function savePesanan(){
		$data['menuArray'] = $this->M_menu->selectArray();
		$namaPemesan = $this->input->post('namaPemesan');
		for($i=0;$i<sizeof($data['menuArray']);$i++){
			// echo "order".$data['menuArray'][$i][0];
			if($this->input->post("order".$data['menuArray'][$i][0])!=null){
				echo $this->input->post("order".$data['menuArray'][$i][0]);
				$daftarOrder[] = $this->input->post("order".$data['menuArray'][$i][0]);
			}
				echo "<br>";
		}

		$dataPesanan = new Array();
		$dataPesanan['nama_pemesan'] = $namaPemesan;
		$dataPesanan['date_pesanan'] = date("Y/m/d");

		for($i=0;$i<sizeof($daftarOrder);$i++){
			$separate =explode("@",$daftarOrder[$i]);
			$data["id_menu"]=$separate[0];
			$data["jumlah"]=$separate[1];
			echo "Id Menu : ".$data["id_menu"];
			echo "<br>";
			echo "jumlah pesanan : ".$data["jumlah"];
		}

	}

}
