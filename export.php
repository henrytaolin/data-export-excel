<?php
    // Load the database config file
    include_once 'dbConfig.php';

    // Custom function to filter the excel data
    function filterData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"','""',$str) . '"';
    }

    // Excel file name for download
    $filename = "members-data_" . date('Y-m-d') . ".xls";

    // Column names
    $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'GENDER', 'COUNTRY', 'CREATED', 'STATUS');

    // Display column names as first row
    $excelData = implode("\t", array_values($fields)) . "\n";

    // Fetch records from database
    $query = $db->query("SELECT * FROM members ORDER BY id ASC");
    if($query->num_rows > 0) {
        // Output each row of the data
        while($row = $query->fetch_assoc()) {
            $status = ($row['status'] == 1) ? 'Active' : 'Inactive';
            $lineData = array($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['gender'], $row['country'], $row['created'], $status);
            array_walk($lineData, 'filterData');
            $excelData .= implode("\t", array_values($lineData)) . "\n";
        }
    } else {
        $excelData .= 'No Records found...'. "\n";
    }

    // Header for download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Render excel data
    echo $excelData;