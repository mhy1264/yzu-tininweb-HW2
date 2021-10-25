<?php
require_once('./TCPDF/tcpdf_import.php');

/*---------------- Print PDF Start -----------------*/
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('cid0jp','', 18); 
$pdf->AddPage();

<<<<<<< HEAD
=======
//$pdf->SetFont('helvetica', '', 10);
>>>>>>> 6ed8ff443030b9419d1906c5a23889dbd0fdfce5

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
// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
$pdf->write1DBarcode('AFTER21 0000001', 'C39', '', '', '', 18, 0.4, $style, 'N');
// PRINT VARIOUS 1D BARCODES

<<<<<<< HEAD


$name = $_POST['name'];
$phone = $_POST['phone'];
$stuid = $_POST['stuid'];
$meal = $_POST['food'];
$Association = $_POST['Association'];
$class = $_POST['class'];
$mail = $_POST['email'];

$html = <<<EOF


<h2>[After 2021] 報名單</h2>
<table border="1">
	<tr>
		<td>姓名</td>
		<td style="font-family : corier">$name</td>
		<td>電話</td>
		<td style="font-family : corier" >$phone</td>
=======
// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
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
>>>>>>> 6ed8ff443030b9419d1906c5a23889dbd0fdfce5
	</tr>
	
	<tr>
		<td>學號</td>
<<<<<<< HEAD
		<td style="font-family : corier" >$stuid</td>
		<td>食物</td>
		<td style="font-family : corier" >$meal</td>
=======
		<td>$stuid</td>
		<td>食物</td>
		<td>$meal</td>
>>>>>>> 6ed8ff443030b9419d1906c5a23889dbd0fdfce5
	</tr>
	
	<tr>
		<td>學系</td>
<<<<<<< HEAD
		<td style="font-family : corier" >$Association</td>
		<td>班級</td>
		<td style="font-family : corier" >$class</td>
=======
		<td>$Association</td>
		<td>班級</td>
		<td>$class</td>
>>>>>>> 6ed8ff443030b9419d1906c5a23889dbd0fdfce5
	</tr>
	
	<tr>
		<td>email</td>
<<<<<<< HEAD
		<td style="font-family : corier" colspan="3">$mail</td>
=======
		<td colspan="3">$mail</td>
>>>>>>> 6ed8ff443030b9419d1906c5a23889dbd0fdfce5
	</tr>
</table>

EOF;

/*---------------- Print PDF End -------------------*/

$pdf->writeHTML($html);
$pdf->lastPage();
$pdf->Output('order.pdf', 'I');

?>