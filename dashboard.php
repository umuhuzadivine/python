<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM houses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is your dashboard.</p>
        <a href="house_register.php" class="btn btn-primary">Register a House</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>

        <h3 class="mt-4">Your Registered Houses</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>House Number</th>
                    <th>House Photo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['house_number']; ?></td>
                        <td><img src="<?php echo $row['house_photo']; ?>" width="100"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
