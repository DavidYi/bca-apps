<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/2015
 * Time: 10:38 AM
 */
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

class signinPDF extends TCPDF
{

    public function Header()
    {
        //logo
        $image_file = K_PATH_IMAGES . '/images/BCAlogo2.png';
        $this->Image($image_file, 10, 10, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        //title
        $this->Cell(0, 15, 'Sign In Sheet', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer()
    {
        $this->SetY(-15);
    }
}

?>