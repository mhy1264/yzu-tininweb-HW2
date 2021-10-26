<?php
require_once('./TCPDF/tcpdf_import.php');
/*Generate qr code*/
 include "./phpqrcode/qrlib.php"; // 引用 PHP QR code

QRcode::png('code data text', 'filename.png')
/*---------------- Print PDF Start -----------------*/
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('cid0jp','', 18); 
$pdf->AddPage();

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
$pdf->write1DBarcode('CODE 39', 'C39', '', '', '', 18, 0.4, $style, 'N');
$name = $_POST['name'];
$phone = $_POST['phone'];
$stuid = $_POST['stuid'];
$meal = $_POST['meal'];
$Association = $_POST['Association'];
$class = $_POST['class'];
$mail = $_POST['email'];

$html = <<<EOF
<h2>[After 2021] 測試</h2>
<table border="1">
	<tr>
		<td>姓名</td>
		<td>$name</td>
		<td>電話</td>
		<td>$phone</td>
	</tr>
	
	<tr>
		<td>學號</td>
		<td>$stuid</td>
		<td>食物</td>
		<td>$meal</td>
	</tr>
	
	<tr>
		<td>學系</td>
		<td>$Association</td>
		<td>班級</td>
		<td>$class</td>
	</tr>
	
	<tr>
		<td>email</td>
		<td colspan="3">$mail</td>
	</tr>
</table>
<img src="'.EXAMPLE_TMP_URLRELPATH.'006_L.png" />

    
EOF;

/*---------------- Print PDF End -------------------*/

$pdf->writeHTML($html);
$pdf->lastPage();
$pdf->Output('order.pdf', 'I');

	
?>