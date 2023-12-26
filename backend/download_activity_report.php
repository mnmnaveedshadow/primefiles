<?php
include 'conn.php';



 ?>
<?php
// Your existing code to fetch and display data

// Output CSV header
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="user_activity_report.csv"');
$output = fopen('php://output', 'w');

// Output CSV column headers
fputcsv($output, array('User Name', 'User Level', 'Data Field', 'Activity Datetime'));

// Fetch and output data
$sql_users = "SELECT * FROM tbl_user_activity_report ORDER BY `tbl_user_activity_report`.`ar_id` DESC";
$rs_users = $conn->query($sql_users);

if ($rs_users->num_rows > 0) {
    while ($rowUsers = $rs_users->fetch_assoc()) {
        $uid = $rowUsers['u_id'];
        $u_level_id = getDataBack($conn, 'tbl_users', 'u_id', $uid, 'u_level');
        $user_name = getDataBack($conn, 'tbl_users', 'u_id', $uid, 'u_name');
        $user_level = $u_level_id;

        $userText = '';
        switch ($user_level) {
            case '1':
                $userText = 'Super Admin';
                break;
            case '2':
                $userText = 'Data Handler';
                break;
            case '3':
                $userText = 'Staff';
                break;
            default:
                $userText = 'Something Went Wrong';
                break;
        }

        // Output data to CSV
        fputcsv($output, array($user_name, $userText, $rowUsers['data_feild'], $rowUsers['activity_datetime']));
    }
}

// Close the CSV file
fclose($output);

// Exit to prevent further HTML output
exit;
?>
