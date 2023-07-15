<?php 
// Include the database config file 
require_once '../files/include.php'; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Emp_export_data-" . date('Ymd') . ".csv"; 
 
// Column names 
$fields = array('No.','Clocking Date', 'Description / Image', 'Employee ID', 'Employee Name', 'Clock In Time', 'Clock Out Time', 'Total Time Worked', 'Clock Out Status'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Get records from the database 
$query = $conn->query("SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID ORDER BY clockin.clockDay DESC"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    $i=0; 
    while($row = $query->fetch_assoc()){ $i++; 
        $rowData = array($i, $row['clockDay'], $row['clockindes'], $row['empID'], $row['surname'], $row['clockTime'], $row['clockoutTime'],foo($row['workedTime']),$row['clockoutdes']); 
        array_walk($rowData, 'filterData'); 
        $excelData .= implode("\t", array_values($rowData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
     
} 
 
// Headers for download 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 
 
// Render excel data 
echo $excelData; 
 
exit;