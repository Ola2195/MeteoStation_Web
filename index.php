<?php
// Include database connection file
include 'db_connect.php';

// Function to calculate the progress percentage based on the value and maximum possible value
function calculateProgress($value, $max) {
    if ($value === 'N/A') return 0;
    return min(100, ($value / $max) * 100);
}

// Function to get the color based on the progress percentage
function getColorForProgress($progress) {
    if ($progress <= 25) {
        return '#387db5'; // Blue color for low progress
    } elseif ($progress <= 75) {
        return '#4caf50'; // Green color for medium progress
    } else {
        return '#f44336'; // Red color for high progress
    }
}

// Function to get the gradient color based on the progress percentage
function getColorGradientForProgress($progress) {
    if ($progress <= 25) {
        return '#2196f3'; // Blue gradient for low progress
    } elseif ($progress <= 75) {
        return '#a2eca5'; // Green gradient for medium progress
    } else {
        return '#db847e'; // Red gradient for high progress
    }
}

// Calculate progress and colors for the latest temperature
$progress = calculateProgress($latest_temperature, 40);
$progress_color = getColorForProgress($progress);
$progress_color_gradient = getColorGradientForProgress($progress);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Measurements</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta http-equiv="refresh" content="120"> <!-- Refresh the page every 120 seconds (2 minutes) -->
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="plant">
                🌿
            </div>

            <div class="sensor-data">
                <div class="sensor">
                    <p>🌡️ Temperature: <?php echo $latest_temperature; ?> °C</p>
                    <div class="progress-bar">
                        <div class="progress"
                            style="--progress-width: <?php echo $progress; ?>%;
                                    --progress-color-start: <?php echo $progress_color;?>;
                                    --progress-color-end: <?php echo $progress_color_gradient;?>;"></div>
                    </div>
                </div>
                <div class="sensor">
                    <p>💧 Humidity: <?php  ?> %</p>
                    <div class="progress-bar">
                        <div class="progress" style="--progress-width: <?php  ?>%;"></div>
                    </div>
                </div>
                <div class="sensor">
                    <p>🔆 Light Intensity: <?php  ?> lx</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: <?php ?>%;"></div>
                    </div>
                </div>
                <p>⏱️ Timestamp: <?php echo $latest_timestamp; ?></p>
            </div>
        </div>
    </div>

    <div class="history-container">
        <h2>Measurement History</h2>
        <?php foreach ($history as $record): 
            $record['progress'] = calculateProgress($record['temperature'], 40);
            $record['progress_color'] = getColorForProgress($record['progress']);
            $record['progress_color_gradient'] = getColorGradientForProgress($record['progress']); 
        ?>
        <div class="history-sensor">
            <p>🌡️ Temperature:</p>
            <p><?php echo $record['temperature']; ?> °C</p>
            <div class="history-progress-bar">
                <div class="progress"
                    style="--progress-width: <?php echo $record['progress']; ?>%;
                            --progress-color-start: <?php echo $record['progress_color'];?>;
                            --progress-color-end: <?php echo $record['progress_color_gradient'];?>;"></div>
            </div>
            <p>💧 Humidity: <?php  ?> %</p>
            <div class="history-progress-bar">
                <div class="progress" style="--progress-width: <?php  ?>%;"></div>
            </div>
            <p>🔆 Light Intensity: <?php  ?> lx</p>
            <div class="history-progress-bar">
                <div class="progress" style="width: <?php ?>%;"></div>
            </div>
            <p>⏱️ Timestamp: <?php echo $record['timestamp']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="diagram-container">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <!-- JavaScript to initialize the chart -->
    <script>
        // Get the data from PHP into JavaScript
        const historyData = <?php echo json_encode($history); ?>;

        // Prepare the data for the chart
        const temperatures = historyData.map(item => item.temperature);
        const timestamps = historyData.map(item => item.timestamp);

        // Initialize the chart using Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: timestamps.reverse(), // Reverse the order of labels for correct chronology
                datasets: [{
                    label: 'Temperature',
                    data: temperatures.reverse(), // Reverse the order of data for correct chronology
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Background color of the area under the chart
                    borderColor: 'rgba(255, 99, 132, 1)', // Line color of the chart
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        min: -10,    // Minimum value on the Y axis
                        max: 40,     // Maximum value on the Y axis
                        ticks: {
                            stepSize: 1 // Step size for values on the Y axis
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
