<?php
// Load the database configuration file
include_once 'includes/dbConfig.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $f_name   = $line[0];
                $l_name  = $line[1];
                $patrol  = sha1($line[2]);
                $date = strftime("%Y-%m-%d %H:%M:%S", time());
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM Scouts WHERE first_name = '".$f_name."' AND last_name = '".$l_name."'";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $db->query("UPDATE Scouts SET  patrol = '".$patrol."' WHERE first_name = '".$f_name."' AND last_name = '".$l_name."'");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO Scouts (first_name, last_name, patrol, date) VALUES ('".$f_name."', '".$l_name."', '".$patrol."',  '".$date."')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: add_scout_csv.php".$qstring);
?>