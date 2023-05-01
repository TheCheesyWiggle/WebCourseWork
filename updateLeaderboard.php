<?php
  if (isset($_POST['csvData'])) {
    $csvData = $_POST['csvData'];
    
    // Path to the CSV file to be overwritten
    $csvFile = 'leaderboard.csv';

    // Convert the CSV data to UTF-8 encoding
    $utf8Data = utf8_encode($csvData);
    // Write the new CSV data to the file
    file_put_contents($csvFile, $utf8Data);

    // Send a success response
    echo 'CSV file overwritten successfully!';
  } else {
    // Send an error response if no CSV data is received
    echo 'No CSV data received!';
  }
?>


