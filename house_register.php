<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $house_number = $_POST['house_number'];
    $user_id = $_SESSION['user_id'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["house_photo"]["name"]);
    move_uploaded_file($_FILES["house_photo"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO houses (house_number, house_photo, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $house_number, $target_file, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('House registered successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register House</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Register a House</h2>
        <form action="house_register.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="house_number" class="form-label">House Number</label>
                <input type="text" name="house_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="house_photo" class="form-label">Upload House Photo</label>
                <input type="file" name="house_photo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register House</button>
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>
