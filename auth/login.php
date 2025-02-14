<?php
session_start();
include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../user/dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid credentials";
        }
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login - Quality Improvement</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-primary">
    <div class="container">
        <div class="login-form">
            <h3 class="text-center">Login</h3>
            <form action="" method="POST">
                <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <p class="text-center mt-3"><a href="register.php">Create an account</a></p>
        </div>
    </div>
</body>
</html>
