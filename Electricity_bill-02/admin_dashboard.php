<?php
include 'includes/db.php';
$q = mysqli_query($conn,"SELECT * FROM consumers");
$pageTitle = "Admin Dashboard";
include 'includes/header.php';
?>

<h2>Admin Dashboard</h2>

<?php while($row = mysqli_fetch_assoc($q)){ ?>
<div class="info">
    <p><b>Service No:</b> <?php echo isset($row['id']) ? $row['id'] : $row['meter_no']; ?></p>
    <p><b>Meter No:</b> <?php echo $row['meter_no']; ?></p>
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Category:</b> <?php echo ucfirst($row['category']); ?></p>
    <p><b>Due Amount:</b> ₹<?php echo $row['due_amount']; ?></p>
    <p><b>Bill Date:</b> <?php echo $row['bill_date']; ?></p>
</div>
<?php } ?>

<button type="button" class="secondary-btn"
onclick="window.location.href='main_dashboard.php'">
Back to Dashboard
</button>

<?php include 'includes/footer.php'; ?>
