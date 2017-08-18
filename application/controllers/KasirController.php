<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> price.' '.$this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? 'Rp. ' : '');
        // $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left\n";
    }
}

class nota
{
    private $name;
    private $price;
    private $dollarSign;
    private $jumlah;

    public function __construct($name = '',$jumlah, $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
        $this -> jumlah = $jumlah;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> jumlah.' '.$this -> name, $leftCols) ;

        // $sign = ($this -> dollarSign ? 'Rp. ' : '');
        $right = str_pad('Rp. ' . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

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
		$this->load->model('M_user');
		$this->load->model('M_nota');
	    $this->load->model('M_admin');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{	
	
		 $data = array();
		 $data['listSales'] = $this->M_admin->salesHarian();
		 $data['listDiskon'] = $this->M_admin->hitung_diskon();
		 $this->load->view('Kasir/v_header.php',$data);
		 $this->load->view('Kasir/v_sidebar.php',$data);
		 $this->load->view('Kasir/v_mainpage.php',$data); //mainpage
		 $this->load->view('Kasir/v_footer.php',$data);
	}

	public function TambahOrderBaru()
	{	
		 // $data = array();
		 // $data['listMeja'] = $this->M_meja->selectAll();
		 // $this->load->view('Kasir/v_header.php',$data);
		 // $this->load->view('Kasir/v_sidebar.php',$data);
		 // $this->load->view('Kasir/v_choose_table.php',$data);
		 // $this->load->view('Kasir/v_footer.php',$data);

		$data = array();
		$data['listMeja1'] = $this->M_meja->mejaLantai1();	
		$data['listMeja2'] = $this->M_meja->mejaLantai2();
		$this->load->view('Kasir/v_header.php',$data);
		$this->load->view('Kasir/v_sidebar.php',$data);
		$this->load->view('Kasir/v_find_table.php',$data);
		$this->load->view('Kasir/v_footer.php',$data);
	}

	public function saveTable(){

		$input = array();
		$dataTable = $this->M_meja->selectAll();
		$index = 0;
		foreach ($dataTable as $row) {
			$x = $this->input->post($row->id_meja);
			if($x != ""){
				$input[$index][0] = $row->id_meja;
				$input[$index][1] = $row->no_meja;
				$index++;
			}
				
		}
		$noMeja = null;
		for($i=0;$i<sizeof($input);$i++){
			$noMeja = $noMeja.$input[$i][1];
			if($i != sizeof($input)-1){
				$noMeja = $noMeja."-";
			}
		}


		if(sizeof($input)==0){
			$this->TambahOrderBaru();
			// redirect("KasirController/TambahOrderBaru/");
		}else{
			// $this->session->set_flashdata('dataTable', $input);
			$data = array();
			$data["noMeja"] = $noMeja;
			$data['listWaitress'] = $this->M_user->selectWaitress();
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
		$noMeja = $this->input->post('noMeja');
		// echo $noMeja;
		if(strpos($noMeja, '-')!==false){
			$noMeja = explode("-",$noMeja);
			// echo "here";
		}else{
			$noMeja = array();
			$noMeja[0] = $this->input->post('noMeja');
		}

		// exit();

		$data['menuArray'] = $this->M_menu->selectArray();
		$namaPemesan = $this->input->post('namaPemesan');
		for($i=0;$i<sizeof($data['menuArray']);$i++){
			if($this->input->post("order".$data['menuArray'][$i][0])!=null){
				$daftarOrder[] = $this->input->post("order".$data['menuArray'][$i][0]);
			}
		}

		$dataPemesan['id_user'] = $this->input->post('waitress');
		$dataPemesan['nama_pemesan'] = $namaPemesan;
		$dataPemesan['date_pesanan'] = date("Y/m/d");

		for($i=0;$i<sizeof($daftarOrder);$i++){
			$separate =explode("@",$daftarOrder[$i]);
			$daftarPesanan[$i]=array($separate[0],$separate[1],$separate[2]);
		}
		$dataMakanan = array();
		$dataMinuman = array();
		$indexMakanan = 0;
		$indexMinuman = 0;
		for($i=0;$i<sizeof($daftarPesanan);$i++){
			for($j=0;$j<sizeof($data['menuArray']);$j++){
				if($daftarPesanan[$i][0] == $data['menuArray'][$j][0] && $data['menuArray'][$j][3] == 0){

					$dataMakanan[$indexMakanan]=array($data['menuArray'][$j][1],$daftarPesanan[$i][1],$daftarPesanan[$i][2]);
					$indexMakanan++;
			
				}else if($daftarPesanan[$i][0] == $data['menuArray'][$j][0] && $data['menuArray'][$j][3] == 1){
					$dataMinuman[$indexMinuman]=array($data['menuArray'][$j][1],$daftarPesanan[$i][1],$daftarPesanan[$i][2]);
					$indexMinuman++;
				}
			}
		}

		if($this->M_pesanan->savePesanan($dataPemesan,$daftarPesanan, $noMeja)){
			$this->cetak($dataMakanan,$dataMinuman,$this->input->post('noMeja'));
			$this->TambahOrderBaru();
		}


	}



	public function dataPesanan()
	{	
		 $data = array();
		 $data['listOrder'] = $this->M_pesanan->selectAll();
		 $this->load->view('Kasir/v_header.php',$data);
		 $this->load->view('Kasir/v_sidebar.php',$data);
		 $this->load->view('Kasir/v_daftar_pemesan.php',$data);
		 $this->load->view('Kasir/v_footer.php',$data);

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function detailPesanan($param)
	{	
		$data = array();
		$data['pemesan'] = $this->M_pesanan->findById($param);
		$detailMeja = $this->M_meja->findByIdPesanan($param);
		$data['waitress'] = $this->M_user->findById($data['pemesan']->id_user);
		$noMeja = "";
		$index = 0;
		foreach($detailMeja as $row){
			$noMeja =$noMeja.$row->no_meja;
			if($index != sizeof($detailMeja)-1){
				$noMeja = $noMeja."-";
			}
			$index++;
		}
		$data["noMeja"] = $noMeja;
		$data['listDetailMenu'] = $this->M_pesanan->selectDetailPesanan($param);
		$this->load->view('Kasir/v_header.php',$data);
		$this->load->view('Kasir/v_sidebar.php',$data);
		$this->load->view('Kasir/v_detail_pesanan.php',$data);
		$this->load->view('Kasir/v_footer.php',$data);
		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function addOrderPage()
	{	
		 $id = $this->input->post('idPesanan');

		 $data = array();
		 $data['pemesan'] = $this->M_pesanan->findById($id);
		 $data['listKategoriMakanan'] = $this->M_jenis_makanan->selectFoodOnly();
		 $data['listKategoriMinuman'] = $this->M_jenis_makanan->selectDrinkOnly();
		 $data['listMenu'] = $this->M_menu->selectAll();
		 $data['menuArray'] = $this->M_menu->selectArray();
		 $this->load->view('Kasir/v_header.php',$data);
		 $this->load->view('Kasir/v_sidebar.php',$data);
		 $this->load->view('Kasir/v_add_order.php',$data);
		 $this->load->view('Kasir/v_footer.php',$data);

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function cancelOrder(){
		$input = array();
		$id = $this->input->post('idPesanan');
		$dataPesanan = $this->M_pesanan->selectDetailPesanan($id);
		$input = array();
		foreach ($dataPesanan as $row) {
			$x = $this->input->post($row->id_detail_pesanan);
			if($x != ""){
				$input[] = $row->id_detail_pesanan;
			}
				
		}

		if($this->M_pesanan->cancelOrder($input)){
			redirect("KasirController/detailPesanan/".$id);
		}
	}

	public function saveAddOrder(){
		$id = $this->input->post('idPesanan');
		$data['menuArray'] = $this->M_menu->selectArray();
		$detailMeja = $this->M_meja->findByIdPesanan($id);
		$noMeja = "";
		$index = 0;
		foreach($detailMeja as $row){
			$noMeja =$noMeja.$row->no_meja;
			if($index != sizeof($detailMeja)-1){
				$noMeja = $noMeja."-";
			}
			$index++;
		}
		for($i=0;$i<sizeof($data['menuArray']);$i++){
			if($this->input->post("order".$data['menuArray'][$i][0])!=null){
				$daftarOrder[] = $this->input->post("order".$data['menuArray'][$i][0]);
			}
		}
		for($i=0;$i<sizeof($daftarOrder);$i++){
			$separate =explode("@",$daftarOrder[$i]);
			$daftarPesanan[$i]=array($separate[0],$separate[1],$separate[2],$id);
		}

		$dataMakanan = array();
		$dataMinuman = array();
		$indexMakanan = 0;
		$indexMinuman = 0;
		for($i=0;$i<sizeof($daftarPesanan);$i++){
			for($j=0;$j<sizeof($data['menuArray']);$j++){
				if($daftarPesanan[$i][0] == $data['menuArray'][$j][0] && $data['menuArray'][$j][3] == 0){
					$dataMakanan[$indexMakanan]=array($data['menuArray'][$j][1],$daftarPesanan[$i][1],$daftarPesanan[$i][2]);
					$indexMakanan++;
				}else if($daftarPesanan[$i][0] == $data['menuArray'][$j][0] && $data['menuArray'][$j][3] == 1){
					$dataMinuman[$indexMinuman]=array($data['menuArray'][$j][1],$daftarPesanan[$i][1],$daftarPesanan[$i][2]);
					$indexMinuman++;
				}
			}
		}

		if($this->M_pesanan->saveDetailPesanan($daftarPesanan)){
			$this->cetak($dataMakanan,$dataMinuman,$noMeja);
			$this->detailPesanan($id);
			
		}
	}

	public function paymentPage($param)
	{	
		$data = array();
		$data['pemesan'] = $this->M_pesanan->findById($param);
		$data['listDetailMenu'] = $this->M_pesanan->selectDetailPesanan($param);
		$data['waitress'] = $this->M_user->findById($data['pemesan']->id_user);
		$detailMeja = $this->M_meja->findByIdPesanan($param);
		$noMeja = "";
		$index = 0;
		foreach($detailMeja as $row){
			$noMeja =$noMeja.$row->no_meja;
			if($index != sizeof($detailMeja)-1){
				$noMeja = $noMeja."-";
			}
			$index++;
		}
		$data["noMeja"] = $noMeja;
		$this->load->view('Kasir/v_header.php',$data);
		$this->load->view('Kasir/v_sidebar.php',$data);
		$this->load->view('Kasir/v_payment.php',$data);
		$this->load->view('Kasir/v_footer.php',$data);
		//$this->load->view('MainPage/v_mainpage.php');
	}
	public function bayar(){
		$id = $this->input->post('idPesanan');
		$nomorMeja = $this->input->post('nomorMeja');
		$data = array();
		$data[0] = $this->input->post('grandTotal');
		$data[1] = $this->input->post('tunai');
		$data[2] = $this->input->post('kembalian');
		$data[3]= $this->input->post('diskon'); 

		if($data[2]<0){
			$this->session->set_flashdata('error', 'Jumlah tunai tidak sesuai');
			$this->paymentPage($id);
		}
		if($this->input->post('diskon')==null || $this->input->post('diskon')<=0 || $this->input->post('diskon')==''){
			$data[3] = 0;
		}
		
		$dataNota['total'] = $this->input->post('grandTotal');
		if(strpos($this->input->post('diskon'), '%')!==false){
			$dataNota['diskon'] = str_replace("%", "", $this->input->post('diskon'));
			
		}else{
			$dataNota['diskon'] = $this->input->post('diskon');
		}

		if(strpos($this->input->post('grandTotal'), '.')!==false){
			$dataNota['total'] = str_replace(".", "", $this->input->post('grandTotal'));
			
		}else{
			$dataNota['total'] = $this->input->post('grandTotal');
		}
		 
		$dataNota['tgl_nota']= $this->input->post('tanggalPesanan'); 
		$dataNota['id_pesanan']= $id; 
		$dataMakanan = array();
		$dataMinuman = array();
		$indexMakanan = 0;
		$indexMinuman = 0;
		$detailPesanan = $this->M_pesanan->selectDetailPesanan($id);

		foreach($detailPesanan as $row){
			if($row->kategori == 0){
				$totalHarga = $row->jumlah * $row->harga_jual;
				$dataMakanan[$indexMakanan]=array($row->nama_menu,$row->jumlah, $totalHarga);
				$indexMakanan++;
			}else if($row->kategori == 1){
				$totalHarga = $row->jumlah * $row->harga_jual;
				$dataMinuman[$indexMinuman]=array($row->nama_menu,$row->jumlah, $totalHarga);
				$indexMinuman++;
			}
			
		}
		// echo $data[0];
		// exit();
		$this->M_nota->saveNota($dataNota);
		$this->M_pesanan->updatePesanan($id);
		$this->nota($dataMakanan,$dataMinuman,$nomorMeja,$data);

		if(strpos($nomorMeja, '-')!==false){
			$nomorMeja = explode("-",$nomorMeja);
			
		}else{
			$nomorMeja = array();
			$nomorMeja[0] = $this->input->post('nomorMeja');
		}


		$this->M_meja->openTable($nomorMeja);
		$this->dataPesanan();
	}

	public function cetak($makanan,$minuman,$noMeja)
	{
		 $this->load->library("EscPos.php");

		try {
	   	    // Enter the share name for your USB printer here
	    	 $tmpdir = sys_get_temp_dir();
             $file =  tempnam($tmpdir, 'ctk');

      /* Do some printing */
            $connector = new FilePrintConnector($file);
			$printer = new Printer($connector);
			$items = array();
			if(sizeof($makanan)>0){
				$number = 1;
				for($i=0;$i<sizeof($makanan)+1;$i++){
				if($i==0){
					$items[$i] = new item("=== MAKANAN ===","");
				}else{
					$items[$i] = new item($makanan[$i-1][0]." ".$makanan[$i-1][2],$makanan[$i-1][1]);
				}
				$number++;
				}

			}else{
				$number = 0;
			}
			

			if(sizeof($minuman)>0){
				$items[$number] = new item("=== MINUMAN ===","");
				$number++;
				for($i=0;$i<sizeof($minuman);$i++){
					$items[$number] = new item($minuman[$i][0]." ".$minuman[$i][2],$minuman[$i][1]);
					$number++;
				}
			}
			
			// $items = array(
			//     new item("Example item #1", "4.00"),
			//     new item("Another thing", "3.50"),
			//     new item("Something else", "1.00"),
			//     new item("A final item", "4.45"),
			// );
			// $subtotal = new item('Subtotal', '12.95');
			// $tax = new item('A local tax', '1.30');
			// $total = new item('Total', '14.25', true);
			/* Date is kept the same for testing */
			// $date = date('l jS \of F Y h:i:s A');
			// $date = "Monday 6th of April 2015 02:56:25 PM";

			/* Start the printer */
			//$logo = EscposImage::load("../resources/escpos-php-small.png", false);
			$printer = new Printer($connector);

			/* Print top logo */
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			//$printer -> graphics($logo);

			/* Name of shop */
			$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			$printer -> text("WAROENG ROPAN\n");
			$printer -> selectPrintMode();
			$printer -> feed();

			$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			$printer -> text("No. Meja : ".$noMeja."\n");
			$printer -> selectPrintMode();
			$printer -> feed();

			/* Title of receipt */
			$printer -> setEmphasis(true);
			$printer -> text("Daftar Pesanan\n");
			$printer -> setEmphasis(false);
			foreach ($items as $item) {
				$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			    $printer -> text($item);
			    $printer -> selectPrintMode();
			}

			date_default_timezone_set('Asia/Jakarta'); 
	     	$dates =date('l jS \of F Y h:i:s A');

			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> feed(2);
			$printer -> setEmphasis(true);
			$printer -> text($dates . "\n");


			// $printer -> setEmphasis(true);
			// $printer -> text($subtotal);
			// $printer -> setEmphasis(false);
			// $printer -> feed();

			/* Tax and total */
			// $printer -> text($tax);
			// $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			// $printer -> text($total);
			// $printer -> selectPrintMode();


			/* Cut the receipt and open the cash drawer */
			$printer -> cut();
			//$printer -> pulse();

			$printer -> close();
			copy($file, "//localhost/Printer Receipt");  # Lakukan cetak
            unlink($file);

		} catch(Exception $e) {
		    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

		}
	}

public function nota($makanan,$minuman,$nomorMeja,$data)
	{
		 $this->load->library("EscPos.php");

		try {
	   	    // Enter the share name for your USB printer here
	    	 $tmpdir = sys_get_temp_dir();
             $file =  tempnam($tmpdir, 'ctk');

      /* Do some printing */
            $connector = new FilePrintConnector($file);
			$printer = new Printer($connector);


			$jumlahHarga = 0;
			$items = array();
			if(sizeof($makanan)>0){
				$number = 1;
				for($i=0;$i<sizeof($makanan);$i++){
					
						$jumlahHarga = $jumlahHarga + $makanan[$i][2];
						$items[$i] = new nota($makanan[$i][0],$makanan[$i][1],$makanan[$i][2]);
					$number++;
				}

			}else{
				$number = 0;
			}
			

			if(sizeof($minuman)>0){
				for($i=0;$i<sizeof($minuman);$i++){
					$jumlahHarga = $jumlahHarga + $minuman[$i][2];
					$items[$number] = new nota($minuman[$i][0],$minuman[$i][1],$minuman[$i][2]);
					$number++;
				}
			}

			$subtotal = new nota('Subtotal', '',$jumlahHarga, true);
			// $ppn = $jumlahHarga * 0.1;
			$diskon = new nota('Diskon', '',$data[3]);
			// $totalHarga = $jumlahHarga + $ppn;
			$total = new nota('Grand Total','', $data[0], true);
			$tunai = new nota('Tunai','', $data[1], true);
			$kembali = new nota('Kembali','', $data[2], true);

			/* Date is kept the same for testing */
			// $date = date('l jS \of F Y h:i:s A');
			date_default_timezone_set('Asia/Jakarta'); 
		   $dates =date('l jS \of F Y h:i:s A');

			/* Start the printer */
			//$logo = EscposImage::load("../resources/escpos-php-small.png", false);
			$printer = new Printer($connector);

			/* Print top logo */
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			//$printer -> graphics($logo);

			/* Name of shop */
			$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			$printer -> text("WAROENG ROPAN\n");
			$printer -> selectPrintMode();
			$printer -> text("Jl. Dr. Sutomo No. 11 Ruko C\n");
			$printer -> feed();

			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> setEmphasis(true);
			$printer -> text("Nomor Meja : ".$nomorMeja."\n");
			$printer -> setEmphasis(false);
			$printer -> feed();

			foreach ($items as $item) {
			    $printer -> text($item);
			}
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> setEmphasis(true);
			$printer -> text("===================\n");
			$printer -> setEmphasis(false);
			$printer -> feed();

			$printer -> setEmphasis(true);
			$printer -> text($subtotal);
			$printer -> setEmphasis(false);
			$printer -> feed();

			if($data[3]>0){
				$printer -> setEmphasis(true);
				$printer -> text($diskon);
				$printer -> setEmphasis(false);
				$printer -> feed();
			}
			

			/* Tax and total */
			$printer -> setEmphasis(true);
			$printer -> text($total);
			$printer -> setEmphasis(false);
			$printer -> selectPrintMode();
			$printer -> feed();

			$printer -> setEmphasis(true);
			$printer -> text($tunai);
			$printer -> setEmphasis(false);
			$printer -> feed();

			$printer -> setEmphasis(true);
			$printer -> text($kembali);
			$printer -> setEmphasis(false);
			$printer -> feed();

			/* Footer */
			$printer -> feed(2);
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text("Terima Kasih Atas Kunjungan Anda\n");
			$printer -> feed(2);
			$printer -> text($dates . "\n");

			/* Cut the receipt and open the cash drawer */
			$printer -> cut();
			$printer -> pulse();

			$printer -> close();

			copy($file, "//localhost/Printer Receipt");  # Lakukan cetak
            unlink($file);

		} catch(Exception $e) {
		    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

		}
	}

}
