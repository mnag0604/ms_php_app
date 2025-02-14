<!-- Sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="../assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo $_SESSION['username']; ?></span>
                    <span class="text-secondary text-small"><?php echo ucfirst($_SESSION['role']); ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../admin/dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../admin/kpi_tracking.php">
                <span class="menu-title">KPI Tracking</span>
                <i class="mdi mdi-chart-line menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../admin/feedback.php">
                <span class="menu-title">Feedback Management</span>
                <i class="mdi mdi-message-text menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../admin/compliance.php">
                <span class="menu-title">Compliance Tracking</span>
                <i class="mdi mdi-shield-check menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../auth/logout.php">
                <span class="menu-title">Logout</span>
                <i class="mdi mdi-logout menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
