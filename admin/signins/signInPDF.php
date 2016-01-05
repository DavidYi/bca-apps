<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/2015
 * Time: 10:38 AM
 */
require("fpdf.php");


class signinPDF extends FPDF
{

    public function Header($title, $host, $mentor)
    {
        //logo
        $image_file = K_PATH_IMAGES . '/images/BCAlogo2.png';
        $this->Image($image_file, 10, 10, 100);
//        // Set font
//        $this->SetXY(50, 10);
//        $this->SetFont('helvetica', 'B', 20);
//        //title
//        $this->Cell(0, 15, $title, 0, false, 'C', 0, '', 0, false, 'M', 'M');
//        $this->Cell();
    }

    function Fancy($header, $data, $isSession)
    {
        // Colors, line width and bold font
        $this->SetFillColor(88,88,88);
        $this->SetTextColor(255);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.4);
        $this->SetFont('','B',15);

        // Header
        $w = array(40, 35, 40, 45);
        for($i = 0; $i < count($header); $i++)
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
