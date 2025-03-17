<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password
    
    // Location details
    $province = $_POST['province'];
    $district = $_POST['district'];
    $sector = $_POST['sector'];
    $cell = $_POST['cell'];
    $village = $_POST['village'];

    // File uploads
    $target_dir = "uploads/";
    
    // House Photo
    $house_photo = $target_dir . basename($_FILES["house_photo"]["name"]);
    move_uploaded_file($_FILES["house_photo"]["tmp_name"], $house_photo);

    // Applicant Signature
    $application_signature = $target_dir . basename($_FILES["application_signature"]["name"]);
    move_uploaded_file($_FILES["application_signature"]["tmp_name"], $application_signature);

    // Supervisor Signature
    $supervisor_signature = $target_dir . basename($_FILES["supervisor_signature"]["name"]);
    move_uploaded_file($_FILES["supervisor_signature"]["tmp_name"], $supervisor_signature);

    // Insert into database
    $sql = "INSERT INTO users (email, username, password, house_photo, province, district, sector, cell, village, name_of_application_and_signature, name_of_supervisor_and_signature) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $email, $username, $password, $house_photo, $province, $district, $sector, $cell, $village, $application_signature, $supervisor_signature);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">User Registration</h2>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <h4>Location Details</h4>
            <div class="mb-3">
                <label>Province</label>
                <input type="text" name="province" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>District</label>
                <input type="text" name="district" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Sector</label>
                <input type="text" name="sector" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Cell</label>
                <input type="text" name="cell" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Village</label>
                <input type="text" name="village" class="form-control" required>
            </div>

            <h4>Uploads</h4>
            <div class="mb-3">
                <label>Upload House Photo</label>
                <input type="file" name="house_photo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Upload Applicant Signature</label>
                <input type="file" name="application_signature" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Upload Supervisor Signature</label>
                <input type="file" name="supervisor_signature" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
            <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
