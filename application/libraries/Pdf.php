<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    // protected $CI;
    // protected $dompdf;

    // public function __construct() {
    //     $this->CI =& get_instance();
        
    //     // Set options for DOMPDF
    //     $options = new Options();
    //     $options->set('isRemoteEnabled', true);
    //     $this->dompdf = new Dompdf($options);
    // }

	public function generate($html, $filename = '',  $paper = '', $orientation = '', $stream = true)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
            exit();
        } else {
            return $dompdf->output();
        }
    }
}
