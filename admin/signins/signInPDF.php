<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/2015
 * Time: 10:38 AM
 */
<<<<<<< HEAD
require("fpdf.php");
=======
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
>>>>>>> 07af5d6c41b0c7e5de7fd1b3d78d65df589f9a9e


class signinPDF extends FPDF
{

    public function Header()
    {
        //logo
        $image_file = K_PATH_IMAGES . '/images/BCAlogo2.png';
        $this->Image($image_file, 10, 10, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetXY(50, 10);
        $this->SetFont('helvetica', 'B', 20);
        //title
        $this->Cell(0, 15, 'Sign In Sheet', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(88,88,88);
        $this->SetTextColor(255);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.4);
        $this->SetFont('','B',15);

        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('','',14);
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }

    public function Footer()
    {
        $this->SetY(-15);
    }
}

?>