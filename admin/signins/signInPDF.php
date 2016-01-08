<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/2015
 * Time: 10:38 AM
 */
require("/fpdf/fpdf.php");


class signinPDF extends FPDF
{

//    public function Header($title, $host, $mentor) {
//        //logo
//        $image_file = K_PATH_IMAGES . '/images/BCAlogo2.png';
//        $this->Image($image_file, 10, 10, 100);
////        // Set font
////        $this->SetXY(50, 10);
////        $this->SetFont('helvetica', 'B', 20);
////        //title
////        $this->Cell(0, 15, $title, 0, false, 'C', 0, '', 0, false, 'M', 'M');
////        $this->Cell();
//    }

    function Fancy($header, $data, $isSession)
    {
        $headHeight = 10;
        $height = 9;
        $fontSize = 10;
        // Colors, line width and bold font
        $this->SetFillColor(88, 88, 88);
        $this->SetTextColor(255);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.4);
        $this->SetFont('', 'B', 12);

        // Header
        if ($isSession == false)
            $w = array(12, 33, 50, 85, 12);
        else
            $w = array(20, 70, 100);
        $this->Ln();

        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], $headHeight, $header[$i], 1, 0, 'C', true);

        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '', $fontSize);


        // Data
        $fill = false;
        foreach ($data as $row) {
            $fontSizeTemp = $fontSize;

            if ($isSession == true) {
                $studentName = $row[0] . ', ' . $row[1];

                $this->AdjustFontSize($fontSizeTemp, $row[2], $w[0]);
                $this->Cell($w[0], $height, $row[2], 'LR', 0, 'L', $fill);

                $this->AdjustFontSize($fontSizeTemp, $studentName, $w[1]);
                $this->Cell($w[1], $height, $studentName, 'LR', 0, 'L', $fill);

                $this->Cell($w[2], $height, ' ', 'LR', 0, 'L', $fill);
            } else {
                $mentorName = $row[2] . ', ' . $row[3];

                $this->AdjustFontSize($fontSizeTemp, $row[0], $w[0]);
                $this->Cell($w[0], $height, $row[0], 'LR', 0, 'L', $fill);

                $this->AdjustFontSize($fontSizeTemp, $row[1], $w[1]);
                $this->Cell($w[1], $height, $row[1], 'LR', 0, 'L', $fill);

                $this->AdjustFontSize($fontSizeTemp, $mentorName, $w[2]);
                $this->Cell($w[2], $height, $mentorName, 'LR', 0, 'L', $fill);

                $this->AdjustFontSize($fontSizeTemp, $row[4], $w[3]);
                $this->Cell($w[3], $height, $row[4], 'LR', 0, 'L', $fill);

                $this->Cell($w[4], $height, ' ', 'LR', 0, 'L', $fill);
            }

            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function AdjustFontSize($fontSize, $text, $maxWidth)
    {
        $decrement_step = 0.1;

        $this->SetFont('', '', $fontSize);
        while ($this->GetStringWidth($text) > $maxWidth - 2) {
            $this->SetFontSize($fontSize -= $decrement_step);
        }

    }
}
//    public function Footer()
//    {
//        $this->SetY(-15);
//    }
//}

?>
