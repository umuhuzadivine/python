<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search House</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Search House</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Enter House Number:</label>
                <input type="text" class="form-control" name="house_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $house_number = $_POST['house_number'];

            $sql = "SELECT users.*, houses.house_number, houses.house_photo 
                    FROM users 
                    INNER JOIN houses ON users.user_id = houses.user_id
                    WHERE houses.house_number = '$house_number'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h3 class='mt-4'>House Details</h3>";
                echo "<p><strong>House Number:</strong> " . $row['house_number'] . "</p>";
                echo "<p><strong>Owner:</strong> " . $row['username'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                echo "<p><strong>Province:</strong> " . $row['province'] . "</p>";
                echo "<p><strong>District:</strong> " . $row['district'] . "</p>";
                echo "<p><strong>Sector:</strong> " . $row['sector'] . "</p>";
                echo "<p><strong>Cell:</strong> " . $row['cell'] . "</p>";
                echo "<p><strong>Village:</strong> " . $row['village'] . "</p>";
                
                if (!empty($row['house_photo'])) {
                    echo "<p><strong>House Photo:</strong></p>";
                    echo "<img src='" . $row['house_photo'] . "' width='300' class='img-thumbnail'>";
                }
            } else {
                echo "<p class='text-danger mt-3'>No house found with this number.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
