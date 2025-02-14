<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_issues.php");
    exit();
}

$issue_id = $_GET['id'];
$stmt = $conn->prepare("SELECT title, description, status FROM issues WHERE id = ?");
$stmt->bind_param("i", $issue_id);
$stmt->execute();
$result = $stmt->get_result();
$issue = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE issues SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $issue_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_issues.php?success=Issue updated successfully");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Issue</title>
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include '../includes/topbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Issue</h1>
                    <form method="POST">
                        <label>Title</label>
                        <input type="text" name="title" value="<?php echo $issue['title']; ?>" disabled>
                        <label>Description</label>
                        <textarea name="description" disabled><?php echo $issue['description']; ?></textarea>
                        <label>Status</label>
                        <select name="status">
                            <option value="pending">Pending</option>
                            <option value="in progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
