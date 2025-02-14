<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$user_id = $_GET['id'];
$stmt = $conn->prepare("SELECT username, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_users.php?success=User updated successfully");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit User</title>
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include '../includes/topbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit User</h1>
                    <form method="POST">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                        <label>Role</label>
                        <select name="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
