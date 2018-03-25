<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_report {

    public function __construct() {
        $this->CI = & get_instance();
        require_once 'mpdf/mpdf.php';
    }

    public function gen_pdf($html, $paper = 'A4', $layout, $pagesl = NULL) {

        $mpdf = new mPDF('utf-8', $paper);
        $mpdf->AddPage($layout, // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                12, // margin bottom
                18, // margin header
                5); // margin footer
        //$mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->mirrorMargins = 1;
        $mpdf->SetWatermarkText('ATI Limited');
        $mpdf->SetWatermarkImage('resources/images/HEQEPLogoPng.png');
        $mpdf->showWatermarkImage = false;
        //$mpdf->showWatermarkText = true;
        $mpdf->WriteHTML('<watermarkimage src="resources/images/HEQEPLogoPng.png" alpha="0.08" size="50,60" />');
        $footer = "<div style='border-top:1px solid #333; padding-top:10px;'></div>";
        //$mpdf->SetHTMLFooter($footer);
        if ($pagesl == 1) {
            $mpdf->setFooter('{PAGENO}');
        }
        $mpdf->WriteHTML($html);
        $fileName = date('Y_m_d_H_i_s');
        $mpdf->Output('PMIS_' . $fileName . '.pdf', 'I');
    }

}