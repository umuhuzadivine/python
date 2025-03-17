<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if admin already exists
    $check_admin = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $check_admin->bind_param("s", $email);
    $check_admin->execute();
    $result = $check_admin->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Admin already exists!');</script>";
    } else {
        // Insert new admin
        $sql = "INSERT INTO admins (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Admin registered successfully! Please login.'); window.location='admin_login.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Signup</h2>
        <form action="admin_signup.php" method="POST">
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
            <button type="submit" class="btn btn-primary">Signup</button>
            <p class="mt-3">Already have an account? <a href="admin_login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
