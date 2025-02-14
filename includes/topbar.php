<!-- Topbar -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                    <div class="nav-profile-img">
                        <img src="../assets/images/faces/face1.jpg" alt="image">
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black"><?php echo $_SESSION['username']; ?></p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="../admin/profile.php">
                        <i class="mdi mdi-account-circle me-2 text-success"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../auth/logout.php">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
