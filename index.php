<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quality Improvement System</title>
    <!-- Styles -->
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
    
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1 class="display-4">Welcome to Quality Improvement System</h1>
                            <p class="lead">Streamline quality management, issue reporting, and compliance tracking.</p>
                            <a href="auth/login.php" class="btn btn-primary btn-lg">Login</a>
                            <a href="auth/register.php" class="btn btn-secondary btn-lg">Register</a>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
</body>
</html>
