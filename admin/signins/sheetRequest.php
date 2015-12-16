<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

class signinPDF extends TCPDF{

    public function Header()
    {

        $this->setJPEGQuality(90);

        $this->Image('logo.png', 62, 36, 72, 0, 'PNG', 'http://php.refulz.com');

    }

    public function Footer()
    {

        $this->SetY(-15);

        $this->SetFont(PDF_FONT_NAME_MAIN, 'I', 8);

        $this->Cell(0, 10, 'php.refulz.com – Web Developer’s Blog', 0, false, 'C');

    }
}
?>