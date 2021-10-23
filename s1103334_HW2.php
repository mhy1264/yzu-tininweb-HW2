<?php
require_once('./TCPDF/tcpdf_import.php');

/*---------------- Print PDF Start -----------------*/
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('cid0jp','', 18); 
$pdf->AddPage();

$name = $_POST['name'];
$phone = $_POST['phone'];
$stuid = $_POST['stuid'];
$meal = $_POST['meal'];
$Association = $_POST['Association'];
$class = $_POST['class'];
$mail = $_POST['email'];

$html = <<<EOF
<h2>[After 2021] 測試</h2>
<table>
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

EOF;

/*---------------- Print PDF End -------------------*/

$pdf->writeHTML($html);
$pdf->lastPage();
$pdf->Output('order.pdf', 'I');

?>