<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

$usersQuery = "SELECT id, username, email, role FROM users";
$usersResult = $conn->query($usersQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Manage Users</title>
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include '../includes/topbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">List of Registered Users</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="add_user.php" class="btn btn-primary mb-3">Add New User</a>
                            <table id="datatablesSimple" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $usersResult->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo ucfirst($row['role']); ?></td>
                                            <td>
                                                <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../includes/footer.php'; ?>
        </div>
    </div>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
