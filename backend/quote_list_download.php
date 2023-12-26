<?php
include 'conn.php';



 ?>
<?php
// Your existing code to fetch and display data

// Output CSV header
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="quote_list.csv"');
$output = fopen('php://output', 'w');

// Output CSV column headers
fputcsv($output, array('Ref ID', 'Customer Name', 'Service', 'Review Status', 'Date Time', 'Staff'));

// Fetch and output data
$sql_list = "SELECT * FROM tbl_quote ORDER BY `tbl_quote`.`q_id` DESC";
$rs_list = $conn->query($sql_list);

if ($rs_list->num_rows > 0) {
    while ($row = $rs_list->fetch_assoc()) {
        $cid = $row['c_id'];
        $ser_t = $row['q_service'];
        $st = $row['q_status'];
        $this_id = $row['u_id'];
        $user_name = getDataBack($conn, 'tbl_users', 'u_id', $this_id, 'u_name');

        
        $qid = $row['q_id'];
        $date_time = $row['q_d_time'];
        $year_month = date_create_from_format('Y-m-d H:i:s', $date_time)->format('ym');
        $formatted_qid = sprintf('%03d', $qid);
        $result_id = "PRL{$year_month}{$formatted_qid}";

        // Output data to CSV
        fputcsv($output, array($result_id, getDataBack($conn, 'tbl_customer_info', 'c_id', $cid, 'c_name'), getServiceType($ser_t), getQuoteStatusText($st), $row['q_d_time'], ($st != 0) ? $user_name : ''));
    }
}

// Close the CSV file
fclose($output);

// Exit to prevent further HTML output
exit;
?>

