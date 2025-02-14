<?php
// admin/admin_dashboard.php - Admin Dashboard
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

// Fetch total users
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = ($totalUsersResult) ? $totalUsersResult->fetch_assoc()['total_users'] : 0;



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="sb-nav-fixed">
    <?php include '../includes/topbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Admin Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Overview of Quality Management</li>
                    </ol>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-gradient-primary text-white mb-4">
                                <div class="card-body">Total Users: <?php echo htmlspecialchars($totalUsers); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-gradient-success text-white mb-4">
                                <div class="card-body">KPI Entries: <?php echo htmlspecialchars($totalKpi); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-gradient-warning text-white mb-4">
                                <div class="card-body">Feedback Received: <?php echo htmlspecialchars($totalFeedback); ?></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-gradient-danger text-white mb-4">
                                <div class="card-body">Compliance Issues: <?php echo htmlspecialchars($totalCompliance); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">KPI Performance Overview</h4>
                                    <canvas id="kpiChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Compliance Tracking</h4>
                                    <canvas id="complianceChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../includes/footer.php'; ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const kpiData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'KPI Entries',
                    data: [30, 50, 45, 60, 70, 80], 
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            };

            const complianceData = {
                labels: ['Resolved', 'Pending', 'Critical'],
                datasets: [{
                    label: 'Compliance Issues',
                    data: [50, 30, 20], 
                    backgroundColor: ['green', 'orange', 'red']
                }]
            };

            if (document.getElementById('kpiChart')) {
                new Chart(document.getElementById('kpiChart').getContext('2d'), { type: 'line', data: kpiData });
            }

            if (document.getElementById('complianceChart')) {
                new Chart(document.getElementById('complianceChart').getContext('2d'), { type: 'pie', data: complianceData });
            }
        });
    </script>
</body>
</html>