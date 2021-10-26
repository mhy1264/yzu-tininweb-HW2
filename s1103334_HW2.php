<?php
require_once('./TCPDF/tcpdf_import.php');

$name = $_POST['name'];
$phone = $_POST['phone'];
$stuid = $_POST['stuid'];
$meal = $_POST['meal'];
$Association = $_POST['Association'];
$class = $_POST['class'];
$mail = $_POST['email'];

/* send qrcode  */
include 'phpqrcode/qrlib.php';
$tempDir = EXAMPLE_TMP_SERVERPATH;

$codeContents = 'your message here...';

$fileName = '$stuid.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;

QRcode::png($codeContents, $pngAbsoluteFilePath); 
/*send mail */

$to =" mhy1264@gmail.com "; //收件者
$subject = "test"; //信件標題
$msg = "smtp發信測試";//信件內容
$headers = "From: admin@your.com"; //寄件者

mail("$to", "$subject", "$msg", "$headers");

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
// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
$pdf->write1DBarcode('AFTER21 0000001', 'C39', '', '', '', 18, 0.4, $style, 'N');


$html = <<<EOF
<h2>[After 2021] 報名表</h2>
<table border="1">
	<tr>
		<td>姓名</td>
		<td>$name</td>
		<td>電話</td>
		<td>$phone</td>
	</tr>
	
	<tr>
		<td>學號</td>
		<td style="font-family : corier" >$stuid</td>
		<td>食物</td>
		<td style="font-family : corier" >$meal</td>
	</tr>
	
	<tr>
		<td>學系</td>
		<td style="font-family : corier" >$Association</td>
		<td>班級</td>
		<td style="font-family : corier" >$class</td>
	</tr>
	
	<tr>
		<td>email</td>
		<td style="font-family : corier" colspan="3">$mail</td>
	</tr>
</table>

EOF;

/*---------------- Print PDF End -------------------*/

$pdf->writeHTML($html);
$pdf->lastPage();
$pdf->Output('order.pdf', 'I');

?>