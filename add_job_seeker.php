<?php

session_start();

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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $bio = $_POST["bio"];
    $skills = $_POST["skills"];
    $experience = $_POST["experience"];
    
    // Handle file upload
    $profile_picture = "";
    //echo "Files".$_FILES["profile_picture"];
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $profile_picture = "uploads/" . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    }
    
    $id = $_SESSION['id'];

    $sql = "INSERT INTO job_seekers (name, email, phone, bio, profile_picture, skills, experience, user) VALUES ('$name', '$email', '$phone', '$bio', '$profile_picture', '$skills', '$experience', $id)";
    //echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully" . "<a href='user_profile.php'>User Profile</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }/**/
}

$conn->close();
?>
