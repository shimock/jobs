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

$id = $_GET["key"];
$sql = "SELECT name, email, phone, bio, profile_picture, skills, experience FROM job_seekers WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $bio = $row["bio"];
    $profile_picture = $row["profile_picture"];
    $skills = $row["skills"];
    $experience = $row["experience"];
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Job Seeker Profile</h2>
        <form action="save_job_seeker.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo isset($name) ? $name : ''; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>" required>
            <input type="text" name="phone" placeholder="Phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
            <textarea name="bio" placeholder="Bio"><?php echo isset($bio) ? $bio : ''; ?></textarea>
            <input type="file" name="profile_picture" accept="image/*">
            <textarea name="skills" placeholder="Skills"><?php echo isset($skills) ? $skills : ''; ?></textarea>
            <textarea name="experience" placeholder="Experience"><?php echo isset($experience) ? $experience : ''; ?></textarea>
            <button type="submit">Save Job Seeker</button>
        </form>
    </div>
</body>
</html>
