<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = $_POST['company_id'];
    $job_title = $_POST['job_title'];
    $job_desc = $_POST['job_desc'];
    $job_type = $_POST['job_type'];
    
    $sql = "INSERT INTO jobs (company_id, job_title, job_desc, job_type) VALUES ('$company_id', '$job_title', '$job_desc', '$job_type')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Job added successfully!" . "<a href='dashboard.php'>Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
