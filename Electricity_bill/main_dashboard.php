<?php
$meter = isset($_GET['meter']) ? $_GET['meter'] : "";
?>
<!DOCTYPE html>
<html>
<head>
<title>Main Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Main Dashboard</h2>

    <?php if($meter){ ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
        <p style="margin: 0;">Registration Successful!</p>
        <p style="margin: 0;">Your Meter Number is: <strong><?php echo $meter; ?></strong></p>
        <?php if(isset($_GET['bill_no'])){ ?>
        <p style="margin: 0;">Your Bill Number is: <strong><?php echo $_GET['bill_no']; ?></strong></p>
        <?php } ?>
    </div>
    <?php } ?>

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
            <h3>View Bill (Any Meter)</h3>
            <p>Enter meter number and check bill details</p>
        </a>
    </div>

</div>

</body>
</html>
