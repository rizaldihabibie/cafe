
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
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
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
        
	    $this->load->helper(array('form','url', 'text_helper','date','file','printer_helper'));
		$this->load->library(array('Pagination','image_lib','session'));
		$this->load->model('m_login');
		// $this->load->library('Userauth');
		
	}
	
	public function cetak()
	{
		 $this->load->library("EscPos.php");

		try {
	   	    // Enter the share name for your USB printer here
	    	 $tmpdir = sys_get_temp_dir();
             $file =  tempnam($tmpdir, 'ctk');

      /* Do some printing */
            $connector = new FilePrintConnector($file);
			$printer = new Printer($connector);
			$items = array(
			    new item("Example item #1", "4.00"),
			    new item("Another thing", "3.50"),
			    new item("Something else", "1.00"),
			    new item("A final item", "4.45"),
			);
			$subtotal = new item('Subtotal', '12.95');
			$tax = new item('A local tax', '1.30');
			$total = new item('Total', '14.25', true);
			/* Date is kept the same for testing */
			// $date = date('l jS \of F Y h:i:s A');
			$date = "Monday 6th of April 2015 02:56:25 PM";

			/* Start the printer */
			//$logo = EscposImage::load("../resources/escpos-php-small.png", false);
			$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
//$printer -> graphics($logo);

/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("ExampleMart Ltd.\n");
$printer -> selectPrintMode();
$printer -> text("Shop No. 42.\n");
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> text("SALES INVOICE\n");
$printer -> setEmphasis(false);

/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text(new item('', '$'));
$printer -> setEmphasis(false);
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> setEmphasis(true);
$printer -> text($subtotal);
$printer -> setEmphasis(false);
$printer -> feed();

/* Tax and total */
$printer -> text($tax);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text($total);
$printer -> selectPrintMode();

/* Footer */
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Thank you for shopping at ExampleMart\n");
$printer -> text("For trading hours, please visit example.com\n");
$printer -> feed(2);
$printer -> text($date . "\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();
		    /* Close printer */
		    $printer -> close();
			copy($file, "//localhost/testing");  # Lakukan cetak
            unlink($file);

		} catch(Exception $e) {
		    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

		}
	}
}

