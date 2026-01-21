<?php
$conn = mysqli_connect("localhost","root","","electricity_db");
$q = mysqli_query($conn,"SELECT * FROM consumers");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Admin Dashboard</h2>

<?php while($row = mysqli_fetch_assoc($q)){ ?>
<div class="info">
    <p><b>Meter No:</b> <?php echo $row['meter_no']; ?></p>
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Category:</b> <?php echo ucfirst($row['category']); ?></p>
    <p><b>Due Amount:</b> ₹<?php echo $row['due_amount']; ?></p>
</div>
<?php } ?>

<button type="button" class="secondary-btn"
onclick="window.location.href='main_dashboard.php'">
Back to Dashboard
</button>

</div>

</body>
</html>
