<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

$issuesQuery = "SELECT issues.id, users.username, issues.title, issues.description, issues.status, issues.created_at FROM issues JOIN users ON issues.user_id = users.id";
$issuesResult = $conn->query($issuesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Manage Issues</title>
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include '../includes/topbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Issues</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Reported On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $issuesResult->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                                            <td><span class="badge bg-<?php echo ($row['status'] == 'resolved') ? 'success' : 'warning'; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td>
                                                <a href="edit_issue.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Update</a>
                                                <a href="delete_issue.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
</body>
</html>
