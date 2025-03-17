<?php
session_start();
include 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Approve house registration
if (isset($_GET['approve_id'])) {
    $user_id = $_GET['approve_id'];
    $update_sql = "UPDATE users SET document_issued = 'Approved' WHERE user_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    echo "<script>alert('House registration approved!'); window.location='admin_dashboard.php';</script>";
}

// Delete user
if (isset($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    echo "<script>alert('User deleted!'); window.location='admin_dashboard.php';</script>";
}

// Fetch all registered users and houses
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['admin_username']; ?> (Admin)</h2>
        <a href="admin_logout.php" class="btn btn-danger">Logout</a>

        <h3 class="mt-4">User Registrations</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>House Photo</th>
                    <th>Location</th>
                    <th>Applicant Signature</th>
                    <th>Supervisor Signature</th>
                    <th>Document Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><img src="<?php echo $row['house_photo']; ?>" width="100"></td>
                        <td><?php echo $row['province'] . ", " . $row['district'] . ", " . $row['sector'] . ", " . $row['cell'] . ", " . $row['village']; ?></td>
                        <td><img src="<?php echo $row['name_of_application_and_signature']; ?>" width="100"></td>
                        <td><img src="<?php echo $row['name_of_supervisor_and_signature']; ?>" width="100"></td>
                        <td><?php echo $row['document_issued']; ?></td>
                        <td>
                            <?php if ($row['document_issued'] === 'Pending') { ?>
                                <a href="admin_dashboard.php?approve_id=<?php echo $row['user_id']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <?php } ?>
                            <a href="admin_dashboard.php?delete_id=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
