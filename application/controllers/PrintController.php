
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class PrintController extends CI_Controller {

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
	
	public function cetak()
	{
		 $this->load->library("EscPos.php");

		try {
		    // Enter the share name for your USB printer here
			// $connector = new Escpos\PrintConnectors\FilePrintConnector("/dev/usb/lp0");
		    $connector = new  Escpos\PrintConnectors\WindowsPrintConnector("Printer Receipt");
		    /* Print a "Hello world" receipt" */
		    $printer = new Escpos\Printer($connector);
		    $printer->text("Hello World!\n");
		    $printer->cut();

		    /* Close printer */
		    $printer -> close();
		} catch(Exception $e) {
		    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

		}
	}
}

