<?php
require_once '../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$mpdf = new \Mpdf\Mpdf();

ob_start();
include '../calculated_quote.php';
$html = ob_get_clean();


$mpdf->WriteHTML($html);

// Output PDF to browser or save to a file


$qid  = $_REQUEST['qid'];

$sql_quote = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
$rs_quote = $conn->query($sql_quote);

if($rs_quote->num_rows > 0){
	$row_q = $rs_quote->fetch_assoc();
}
else {
	header('location:index.php');
	exit();
}

$sql_update = "UPDATE tbl_quote SET q_status='2' WHERE q_id='$qid'";
$rs_update = $conn->query($sql_update);

$q_cus = $row_q['c_id'];

$sql_customer="SELECT * FROM tbl_customer_info WHERE c_id='$q_cus'";
$rs_customer = $conn->query($sql_customer);

if($rs_customer->num_rows >0){
	$rowC = $rs_customer->fetch_assoc();
			$cName = $rowC['c_name'];
    $cEmail = $rowC['c_email'];

}

$mpdf->Output('calculated_quotes/output_'.$qid.'.pdf', 'F');


$to = $cEmail;
$subject = "Your Customized Quote for Air Shipping";
$message = "
Dear $cName, <br>
We hope this email finds you well. We appreciate the opportunity to serve you and provide a customized quote for your specific needs.
<br>
After careful consideration of your requirements, we have tailored a quote that aligns with your preferences and budget. Please find attached the detailed quote document outlining the costs and terms associated with the proposed solution.
<br> <br> <br>
			<a href='https://skillheist.com/prime/accepted_quote.php?qid=$qid' style='color:#fff;background:#000;border-radius:10px;padding:10px 10px 10px 10px;text-decoration:none;'> Accept The Quote </a> <br><br>
 <hr> <br>";

$file_path = 'calculated_quotes/output_'.$qid.'.pdf'; // Path to the PDF file you want to attach

// Open the file for reading
$file_data = file_get_contents($file_path);
$file_data = chunk_split(base64_encode($file_data));

// Generate a boundary string
$boundary = md5(time());

// Headers
$headers = "From: info@mancode.lk\r\n";
$headers .= "Reply-To: info@mancode.lk\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

// Message body
$email_body = "--$boundary\r\n";
$email_body .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
$email_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$email_body .= "$message\r\n\r\n";

// Attachment
$email_body .= "--$boundary\r\n";
$email_body .= "Content-Type: application/pdf; name=\"" . basename($file_path) . "\"\r\n";
$email_body .= "Content-Transfer-Encoding: base64\r\n";
$email_body .= "Content-Disposition: attachment\r\n\r\n";
$email_body .= $file_data . "\r\n";
$email_body .= "--$boundary--";

// Send the email
mail($to, $subject, $email_body, $headers);

header('location:../quote_breakdown_air.php?q_id=' . $qid);
$_SESSION['sent'] = true;
exit();
