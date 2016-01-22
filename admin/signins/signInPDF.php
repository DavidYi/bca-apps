<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/2015
 * Time: 10:38 AM
 */
require("../../fpdf/fpdf.php");


class signinPDF extends FPDF
{

    function FancyStudent($header, $data)
    {
        $headHeight = 10;
        $height = 9;
        $fontSize = 11;
        // Colors, line width and bold font
        $this->SetFillColor(88, 88, 88);
        $this->SetTextColor(255);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.4);
        $this->SetFont('', 'B', 12);

        // Header
        $w = array(15, 30, 60, 75);

        $this->Ln();

        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], $headHeight, $header[$i], 1, 0, 'C', true);

        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '', $fontSize);
//todo: add host teacher, mentor name, rm number
        // Data
        $fill = false;
        foreach ($data as $row) {
            $fontSizeTemp = $fontSize;

            if (($this->GetY() >= 250) && ($this->GetY() <= 256)) {
                $this->SetFillColor(88, 88, 88);
                $this->SetTextColor(255);
                $this->SetDrawColor(0);
                $this->SetLineWidth(.4);
                $this->SetFont('', 'B', 12);

                for ($i = 0; $i < count($header); $i++)
                    $this->Cell($w[$i], $headHeight, $header[$i], 1, 0, 'C', true);

                $this->SetFillColor(224, 235, 255);
                $this->SetTextColor(0);
                $this->SetFont('', '', $fontSize);
            }

            $studentName = $row[0] . ', ' . $row[1];

            //Year
            $this->AdjustFontSize($fontSizeTemp, $row[2], $w[0]);
            $this->Cell($w[0], $height, $row[2], 'LR', 0, 'L', $fill);

            //Academy
            $this->AdjustFontSize($fontSizeTemp, $row[3], $w[1]);
            $this->Cell($w[1], $height, $row[3], 'LR', 0, 'L', $fill);

            //Name
            $this->AdjustFontSize($fontSizeTemp, $studentName, $w[2]);
            $this->Cell($w[2], $height, $studentName, 'LR', 0, 'L', $fill);

            //Signature
            $this->Cell($w[3], $height, ' ', 'LR', 0, 'L', $fill);

            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function FancyTeacher($header, $data)
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
        $w = array(12, 50, 85, 33, 12);

        $this->Ln();

        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], $headHeight, $header[$i], 1, 0, 'C', true);

        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '', $fontSize);
//todo: add host teacher, mentor name, rm number
        // Data
        $fill = false;
        foreach ($data as $row) {
            $fontSizeTemp = $fontSize;
//
//            $y = $this->GetY();
//            $this->Cell(100, 9, $y);
            if (($this->GetY() >= 250) && ($this->GetY() <= 256)) {
                $this->SetFillColor(88, 88, 88);
                $this->SetTextColor(255);
                $this->SetDrawColor(0);
                $this->SetLineWidth(.4);
                $this->SetFont('', 'B', 12);

                for ($i = 0; $i < count($header); $i++)
                    $this->Cell($w[$i], $headHeight, $header[$i], 1, 0, 'C', true);

                $this->SetFillColor(224, 235, 255);
                $this->SetTextColor(0);
                $this->SetFont('', '', $fontSize);

            }

            $mentorName = $row[2] . ', ' . $row[3];

            //check box
            $this->Cell($w[0], $height, ' ', 'LR', 0, 'L', $fill);

            //Name
            $this->AdjustFontSize($fontSizeTemp, $mentorName, $w[1]);
            $this->Cell($w[1], $height, $mentorName, 'LR', 0, 'L', $fill);

            //Company
            $this->AdjustFontSize($fontSizeTemp, $row[4], $w[2]);
            $this->Cell($w[2], $height, $row[4], 'LR', 0, 'L', $fill);

            //Host Teacher
            $this->AdjustFontSize($fontSizeTemp, $row[1], $w[3]);
            $this->Cell($w[3], $height, $row[1], 'LR', 0, 'L', $fill);

            //Rm #
            $this->AdjustFontSize($fontSizeTemp, $row[0], $w[4]);
            $this->Cell($w[4], $height, $row[0], 'LR', 0, 'L', $fill);


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


//    function getW()
//    {
//        return $w;
//    }
//
//    function getH()
//    {
//        return $h;
//    }
}

?>
