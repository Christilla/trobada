<?php defined('BASEPATH') OR exit('No direct script access allowed');

Use \Mpdf\Mpdf;

class Mpdflib {

    public $params;
    public $pdf;

    public function __construct($params = '"fr-FR-x","A4","","",10,10,10,10,6,3'){
        $this->params = $params;
        $this->pdf = new mPDF($this->params);
    }

    public function generate_pdf(){
        
    }

}

