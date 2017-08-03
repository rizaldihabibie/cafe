<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
		
		$this->load->helper(array('form','url', 'text_helper','date','file','printer_helper'));
		$this->load->library(array('Pagination','image_lib','session'));
		$this->load->model('M_meja');
		$this->load->model('M_jenis_makanan');
		$this->load->model('M_menu');
		$this->load->model('M_pesanan');
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
			if($this->input->post("order".$data['menuArray'][$i][0])!=null){
				$daftarOrder[] = $this->input->post("order".$data['menuArray'][$i][0]);
			}
		}
		$dataPemesan['nama_pemesan'] = $namaPemesan;
		$dataPemesan['date_pesanan'] = date("Y/m/d");
		for($i=0;$i<sizeof($daftarOrder);$i++){
			$separate =explode("@",$daftarOrder[$i]);
			$daftarPesanan[$i]=[$separate[0],$separate[1]];
		}
		$dataMakanan = array();
		$dataMinuman = array();
		$indexMakanan = 0;
		$indexMinuman = 0;
		for($i=0;$i<sizeof($daftarPesanan);$i++){
			for($j=0;$j<sizeof($data['menuArray']);$j++){
				if($daftarPesanan[$i][0] == $data['menuArray'][$j][0] && $data['menuArray'][$i][3] == 0){
					$dataMakanan[$indexMakanan]=[$data['menuArray'][$j][1],$daftarPesanan[$i][1]];
					$indexMakanan++;
				}else if($daftarPesanan[$i][0] == $data['menuArray'][$j][0] && $data['menuArray'][$i][3] == 1){
					$dataMinuman[$indexMinuman]=[$data['menuArray'][$j][1],$daftarPesanan[$i][1]];
					$indexMinuman++;
				}
			}
		}

		if($this->M_pesanan->savePesanan($dataPemesan,$daftarPesanan)){
			$this->cetak($dataMakanan,$dataMinuman);
			exit();
		}


	}

	public function cetak($makanan,$minuman)
	{
		 $this->load->library("EscPos.php");

		try {
		    // Enter the share name for your USB printer here
			// $connector = new Escpos\PrintConnectors\FilePrintConnector("/dev/usb/lp0");
		    $connector = new  Escpos\PrintConnectors\WindowsPrintConnector("Printer Receipt");
		    /* Print a "Hello world" receipt" */
		    $printer = new Escpos\Printer($connector);

		    $printer->text("============= Cafe 2 Minggu ==========\n");
		    $printer->text("                KALISARI              \n");
		    $number = 1;
		    for($i=0;$i<sizeof($makanan);$i++){
		    	$printer->text($number.". ".$makanan[$i][0]);	
		    	// $printer->setJustification();
		    	$printer->text("                       ".$makanan[$i][1]."\n");

		    	$number++;
		    }
		    $printer->cut();
		    $printer->pulse();

		    /* Close printer */
		    $printer -> close();
		} catch(Exception $e) {
		    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

		}
	}

}
