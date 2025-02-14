<?php
session_start();
include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Register - Quality Improvement</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-primary">
    <div class="container">
        <div class="register-form">
            <h3 class="text-center">Create Account</h3>
            <form action="" method="POST">
                <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <p class="text-center mt-3"><a href="login.php">Already have an account? Login</a></p>
        </div>
    </div>
</body>
</html>
