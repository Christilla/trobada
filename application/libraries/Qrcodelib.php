<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcodelib {

    public function __construct(){
        include(BASEPATH . '../application/libraries/phpqrcode/qrlib.php');
    }

    public function store_qrcode_png(String $dir, String $name, String $content, String $size = null){
        $qrdir = "assets/img/$dir/";
        $qrname = $name.md5($content).".png";
        $completedir = $qrdir.$qrname;

        if(!file_exists($completedir)){
            if($size){
                switch($size){
                    case "L":
                        QRcode::png($content, $completedir, QR_ECLEVEL_L);
                        break;

                    case "M":
                        QRcode::png($content, $completedir, QR_ECLEVEL_M);
                        break;

                    case "Q":
                        QRcode::png($content, $completedir, QR_ECLEVEL_Q, 3);
                        break;

                    case "H":
                        QRcode::png($content, $completedir, QR_ECLEVEL_H, 4);
                        break;
                }
            } else {
                QRcode::png($content, $completedir);
            }
            return $completedir;
        } else {
            return $completedir;
        }
    }
    
    public function create_qrcode_dir(String $name){
        if(!file_exists("assets/img/productQR/$name/") && !is_dir("assets/img/productQR/$name/")){
            mkdir("assets/img/productQR/$name", 0777);
        }
    }
}