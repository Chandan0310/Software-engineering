<?php
$meter = isset($_GET['meter']) ? $_GET['meter'] : "";
$pageTitle = "Main Dashboard";
include 'includes/header.php';
?>

    <h2>Main Dashboard</h2>

    <div class="dashboard-options">

        <a href="user_dashboard.php?meter=<?php echo $meter; ?>" class="dash-box">
            <h3>User</h3>
            <p>Register new users</p>
        </a>

        <a href="employee_dashboard.php" class="dash-box">
            <h3>Employee</h3>
            <p>Generate electricity bills</p>
        </a>

        <a href="admin_dashboard.php" class="dash-box">
            <h3>Admin</h3>
            <p>View all consumer records</p>
        </a>

    </div>

    <div style="margin-top:30px;">
        <a href="view.php" class="dash-box" style="width:95%;">
            <h3>View Bill (Any Meter Number)</h3>
            <p>Enter meter number and check bill details</p>
        </a>
    </div>

<?php include 'includes/footer.php'; ?>
