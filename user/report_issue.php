<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO issues (user_id, title, description, status) VALUES (?, ?, ?, 'pending')");
    $stmt->bind_param("iss", $user_id, $title, $description);
    if ($stmt->execute()) {
        $success = "Issue reported successfully!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Report an Issue</title>
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include '../includes/topbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Report an Issue</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Issue Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Issue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../includes/footer.php'; ?>
        </div>
    </div>
</body>
</html>
