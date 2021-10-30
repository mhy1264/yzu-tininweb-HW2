<?php
require_once('./TCPDF/tcpdf_import.php');

$name = $_POST['name'];
$phone = $_POST['phone'];
$stuid = $_POST['stuid'];
$meal = $_POST['meal'];
$Association = $_POST['Association'];
$class = $_POST['class'];
$mail = $_POST['email'];
/*---------------Gerenate qr code -----------------*/

/*---------------Add to SQL-----------------------*/
//ref: CREATE TABLE info( Name text ,phone text ,stuid text)
$host = '140.138.77.70';
$dbuser ='CS380B';
$dbpassword = 'CS380B';
$dbname = 'CS380B';

// Create connection
$conn = new mysqli($host, $dbuser, $dbpassword , $dbname);
// Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

$sql = "SET NAMES UTF8";
$sql = "INSERT INTO s1103334  (name, phone, stuid,meal,Association,class,mail)
VALUES ('$name', '$phone', '$stuid','$meal','$Association','$class','$mail')";

$conn->query($sql);
$conn->close();
/*---------------- Sent Mail Start -----------------

$from = "s1103334@mail.yzu.edu.tw";
$subject = "[After 2021] 報名確認信";
$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
$attach_filename = date("Y-m-d") . ".html";

$emailBody =  "
hi~ $name ~~~
email: $mail
phone: $phone
報名成功!!!
";

# 然後我們要作為附件的HTML檔案 
$attachment =  "<html>
<head>
<title>The attached file</title>
</head>
<body>
<h2>This is the attached HTML file</h2>
</body>
</html>";

$boundary = uniqid("");

$headers =  "From: $from
To: $to
Content-type: multipart/mixed; boundary=\"$boundary\"";

$emailBody =  "--$boundary
Content-type: text/plain; charset=utf-8
Content-transfer-encoding: 8bit

$emailBody

--$boundary
Content-type: text/html; name=$attach_filename
Content-disposition: inline; filename=$attach_filename
Content-transfer-encoding: 8bit

$attachment

--$boundary--";

mail($mail, $subject, $emailBody, $headers);*/
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