<?php
$conn = mysqli_connect("localhost","root","","electricity_db");

if(isset($_POST['search'])){
    $meter = $_POST['meter'];
    $q = mysqli_query($conn,"SELECT * FROM users WHERE meter_no=$meter");
    $row = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>View Bill</h2>

<form method="post">
<label>Enter Meter Number</label>
<input type="number" name="meter" required>
<button name="search">View</button>
</form>

<?php if(isset($row)){ ?>
<div class="info">
<p><b>Name:</b> <?php echo $row['name']; ?></p>
<p><b>Meter No:</b> <?php echo $row['meter_no']; ?></p>
<p><b>Paid:</b> ₹<?php echo $row['paid_amount']; ?></p>
<p><b>Due:</b> ₹<?php echo $row['due_amount']; ?></p>
<p><b>Bill Date:</b> <?php echo $row['bill_date']; ?></p>
<p><b>Due Date:</b> <?php echo $row['due_date']; ?></p>
</div>
<?php } ?>
</div>

</body>
</html>
