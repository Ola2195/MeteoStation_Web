<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meteostation";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the latest temperature measurement
$sql_latest_temperature = "SELECT temperature, timestamp FROM measurements ORDER BY timestamp DESC LIMIT 1";
$result_latest_temperature = $conn->query($sql_latest_temperature);

// Initialize variables for the latest temperature and timestamp
$latest_temperature = 'N/A';
$latest_timestamp = 'N/A';

// If there are results, fetch the latest temperature and timestamp
if ($result_latest_temperature->num_rows > 0) {
    $row = $result_latest_temperature->fetch_assoc();
    $latest_temperature = $row['temperature'];
    $latest_timestamp = $row["timestamp"];
}

// SQL query to get the last 30 temperature measurements
$sql_history = "SELECT temperature, timestamp FROM measurements ORDER BY timestamp DESC LIMIT 30";
$result_history = $conn->query($sql_history);

// Array to store the measurement history
$history = [];

// If there are results, process each row
if ($result_history->num_rows > 0) {
    while ($row = $result_history->fetch_assoc()) {
        $temperature = $row["temperature"];
        $timestamp = $row["timestamp"];
        
        // Format the history row for display
        $history[] = [
            'temperature' => $temperature,
            'progress' => 0,
            'progress_color' => "",
            'progress_color_gradient' => "",
            'timestamp' => $timestamp
        ];
    }
}

// Close the database connection
$conn->close();
?>
