<?php
function generate_report($pdfTitle, $pdfFileName, $Orientation, $output, $companyBranchName, $fromDate, $toDate)
{
require_once('report/tcpdf/config/lang/eng.php');
require_once('report/tcpdf/tcpdf.php');

// PDF CREATION
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ATCHIA CERAMICA');
$pdf->SetTitle($pdfTitle);
$pdf->SetSubject($pdfTitle);
$pdf->SetKeywords($pdfTitle);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page - l- landscape 
$pdf->AddPage($Orientation);


// output the HTML content
$pdf->writeHTML($output, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
// Change To Avoid the PDF Error
 ob_end_clean();

 // Check if path exists
 $pdfpath = "";
 $pdfpath = "report/generated_report/".str_replace(' ', '_', $companyBranchName)."/".str_replace(' ', '_', $pdfFileName)."/".date("Y")."/".date("M")."/".date("d")."/";
 
	if(!file_exists($pdfpath))
	{
		mkdir($pdfpath, 0777, true);
		chmod($pdfpath, 0777);
	}
 
// Close and output PDF document
$pdf->Output($pdfpath.str_replace(' ', '_', $pdfFileName)."_".date('d-m-Y', strtotime($fromDate))."_".date('d-m-Y', strtotime($toDate)).".pdf", 'F');
return "PDF successfully generated, pdf filename : ".str_replace(' ', '_', $pdfFileName)."_".date('d-m-Y', strtotime($fromDate))."_".date('d-m-Y', strtotime($toDate)).".pdf";
}
?>
