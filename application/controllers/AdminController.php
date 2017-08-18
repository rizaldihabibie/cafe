<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

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
		$this->load->model('M_admin');
		//$this->load->model('M_meja');

		// $this->load->library('Userauth');
		
	}

	public function index()
	{
         $data = array();
		 $data['listSales'] = $this->M_admin->salesHarian();
		 $data['listDiskon'] = $this->M_admin->hitung_diskon();
		 $this->load->view('superadmin/v_header.php',$data);
		 $this->load->view('superadmin/v_sidebar.php',$data);
		 $this->load->view('superadmin/v_mainpage.php',$data); //mainpage
		 $this->load->view('superadmin/v_footer.php',$data);

		//$this->load->view('MainPage/v_mainpage.php');
	}

	public function generateReport(){
		$this->load->library('Excel');
		 $objPHPExcel = new PHPExcel();
	 
	            $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

				// set default font size
				$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);

				// create the writer
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

				// writer already created the first sheet for us, let's get it
				$objSheet = $objPHPExcel->getActiveSheet();

				// rename the sheet
				$objSheet->setTitle('report');
				// let's bold and size the header font and write the header
				// as you can see, we can specify a range of cells, like here: cells from A1 to A4
				// write header
				$objSheet->getStyle('A5:K5')->getFont()->setBold(true)->setSize(14);
				$objSheet->getStyle('A5:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$rowTitle = array();
				$rowTitle[0] = 'No';
				$rowTitle[1] = 'TANGGAL';
				$rowTitle[2] = 'WAKTU';
				$rowTitle[3] = 'MEJA';
				$rowTitle[4] = 'NAMA PEMBELI';
				$rowTitle[5] = 'WAITRESS';
				$rowTitle[6] = 'PESANAN';
				$rowTitle[7] = 'JML PESANAN';
				$rowTitle[8] = 'HARGA JUAL';
				$rowTitle[9] = 'TOTAL';
				$rowTitle[10] = '';

				$columnIndex = array();
				$columnIndex[0] = 'A';
				$columnIndex[1] = 'B';
				$columnIndex[2] = 'C';
				$columnIndex[3] = 'D';
				$columnIndex[4] = 'E';
				$columnIndex[5] = 'F';
				$columnIndex[6] = 'G';
				$columnIndex[7] = 'H';
				$columnIndex[8] = 'I';
				$columnIndex[9] = 'J';
				$columnIndex[10] = 'K';

				$rowIndex = 5;
				for($i=0; $i<sizeof($rowTitle);$i++){
					$objSheet->getCell($columnIndex[$i].'5')->setValue($rowTitle[$i]);
					
				}

				for($i=0; $i<sizeof($columnIndex); $i++){
					$objSheet->getColumnDimension($columnIndex[$i])->setAutoSize(true);
					$objSheet->getStyle($columnIndex[$i].'5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objSheet->getStyle($columnIndex[$i].'5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objSheet->getStyle($columnIndex[$i].'5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objSheet->getStyle($columnIndex[$i].'5')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				}

				$filename = "Generate Report Cafe";
		        // We'll be outputting an excel file
				header('Content-type: application/vnd.ms-excel');

				// It will be called file.xls
				header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

				// Write file to the browser
				$objWriter->save('php://output');
		        // $objWriter->save("D://Test/".$filename.".xlsx");

	}
}
