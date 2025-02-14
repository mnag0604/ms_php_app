<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}
include '../database/db_connect.php';

$user_id = $_SESSION['user_id'];

// Fetch user-specific data
$userKpiQuery = "SELECT COUNT(*) AS user_kpi FROM kpi_tracking WHERE user_id = $user_id";
$userKpiResult = $conn->query($userKpiQuery);
$userKpi = $userKpiResult->fetch_assoc()['user_kpi'];

$userFeedbackQuery = "SELECT COUNT(*) AS user_feedback FROM feedback WHERE user_id = $user_id";
$userFeedbackResult = $conn->query($userFeedbackQuery);
$userFeedback = $userFeedbackResult->fetch_assoc()['user_feedback'];

$userComplianceQuery = "SELECT COUNT(*) AS user_compliance FROM compliance_records WHERE id = $user_id";
$userComplianceResult = $conn->query($userComplianceQuery);
$userCompliance = $userComplianceResult->fetch_assoc()['user_compliance'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>User Dashboard</title>
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
                    <h1 class="mt-4">User Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Your Performance Overview</li>
                    </ol>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-gradient-primary text-white mb-4">
                                <div class="card-body">Your KPI Entries: <?php echo $userKpi; ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-gradient-success text-white mb-4">
                                <div class="card-body">Feedback Submitted: <?php echo $userFeedback; ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-gradient-warning text-white mb-4">
                                <div class="card-body">Your Compliance Issues: <?php echo $userCompliance; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Your KPI Progress</h4>
                                    <canvas id="userKpiChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Your Compliance Status</h4>
                                    <canvas id="userComplianceChart"></canvas>
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
        const userKpiData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Your KPI Entries',
                data: [10, 20, 15, 25, 30, 40], 
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        };

        const userComplianceData = {
            labels: ['Resolved', 'Pending', 'Critical'],
            datasets: [{
                label: 'Your Compliance Issues',
                data: [10, 5, 2], 
                backgroundColor: ['green', 'orange', 'red']
            }]
        };

        new Chart(document.getElementById('userKpiChart'), { type: 'bar', data: userKpiData });
        new Chart(document.getElementById('userComplianceChart'), { type: 'pie', data: userComplianceData });
    </script>
</body>
</html>
