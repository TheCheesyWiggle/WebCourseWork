<?php
  if (isset($_POST['csvData'])) {
    $csvData = $_POST['csvData'];
    
    // Path to the CSV file to be overwritten
    $csvFile = 'leaderboard.csv';

    // Write the new CSV data to the file
    file_put_contents($csvFile, $csvData);

    // Send a success response
    echo 'CSV file overwritten successfully!';
  } else {
    // Send an error response if no CSV data is received
    echo 'No CSV data received!';
  }
?>


