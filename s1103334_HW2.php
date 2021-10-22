<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$stuid = $_POST['stuid'];
$meal = $_POST['meal'];
$Association = $_POST['Association'];
$class = $_POST['Association'];
$mail = $_POST['mail'];
require_once('../TCPDF/tcpdf_import.php');

/*---------------- Sent Mail Start -----------------*/
mb_internal_encoding("utf-8");
$to="$mail";
$subject=mb_encode_mimeheader("[嚮往資後] 報名確認信件","utf-8");
$message="Hi!報名成功了喔";
$headers="MIME-Version: 1.0\r\n";
$headers.="Content-type: text/html; charset=utf-8\r\n";
$headers.="From:".mb_encode_mimeheader("PJCHENder","utf-8")."<mhy1264@gmail.com>\r\n";
mail($to,$subject,$message,$headers);


/*---------------- Sent Mail End -------------------*/



/*---------------- Print PDF Start -----------------*/
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('cid0jp','', 18); 
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);


$html = <<<EOF
// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
$pdf->write1DBarcode('CODE 39', 'C39', '', '', '', 18, 0.4, $style, 'N');
$pdf->Ln();

<table>
<tr>
	<td>name</td>
	<td>$name</td>
	<td>phone</td>
	<td>$phone</td>
</tr>
<tr>
	<td>stuid</td>
	<td>$stuid</td>
	<td>phone</td>
	<td>$phone</td>
</tr>
<tr>
	<td>系所</td>
	<td>$Association</td>
	<td>班級</td>
	<td>$class</td>
</tr>
<tr>
	<td> mail</td>
	<td colspan="3">$mail</td>
</tr>
</table>
EOF;
/*---------------- Print PDF End -------------------*/

$pdf->writeHTML($html);
$pdf->lastPage();
$pdf->Output('order.pdf', 'I');
?>