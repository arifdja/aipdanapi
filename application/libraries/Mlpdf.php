<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
// class Mlpdf {
 
//     function pdf()
//     {
//         $CI = & get_instance();
//         log_message('Debug', 'mPDF class is loaded.');
//     }
 
//     function load($param=NULL)
//     {
//         include_once APPPATH.'/libraries/mpdf/mpdf.php';
// 		/*
//         if ($params == NULL)
//         {
//             $param = '"en-GB-x","A4","","",30,10,10,10,6,3';
//         }
 
//         //return new mPDF($param);
// 		return new mPDF('', 'A4', 0, 'Arial', 12.7, 12.7, 40, 12.7, 5, 5);*/
//     }
// }
include_once APPPATH.'/third_party/mpdf/mpdf.php';
class Mlpdf {

    public $param;
    public $pdf;
    public function __construct($param = "'c', 'A4-L'")
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
}