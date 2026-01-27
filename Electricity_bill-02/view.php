<?php
include 'includes/db.php';

if(isset($_POST['search'])){
    $meter=$_POST['meter'];
    $q=mysqli_query($conn,"SELECT * FROM consumers WHERE meter_no=$meter");
    $row=mysqli_fetch_assoc($q);
}
$pageTitle = "View Bill";
include 'includes/header.php';
?>
<h2>View Electricity Bill</h2>

<form method="post">
<label>Enter Meter Number</label>
<input type="number" name="meter" required>
<button name="search">View Bill</button>
<button type="button" class="secondary-btn"
onclick="window.location.href='main_dashboard.php'">
Back to Dashboard
</button>

</form>

<?php if(isset($row)){ 
    $fine = 150;
    $dueWithFine = $row['due_amount'] + $fine;
?>
<div class="info">
<p><b>Name:</b> <?php echo $row['name']; ?></p>
<p><b>Service Number:</b> <?php echo isset($row['id']) ? $row['id'] : $row['meter_no']; ?></p>
<p><b>Meter No:</b> <?php echo $row['meter_no']; ?></p>
<p><b>Paid:</b> ₹<?php echo $row['paid_amount']; ?></p>
<p><b>Due:</b> ₹<?php echo $row['due_amount']; ?></p>
<p><b>Bill Date:</b> <?php echo $row['bill_date']; ?></p>
<p><b>Due Date:</b> <?php echo $row['due_date']; ?></p>
<p style="color:red; margin-top:10px;"><b>Amount after Due Date (with Fine):</b> ₹<?php echo $dueWithFine; ?></p>
</div>
<?php } ?>

<?php include 'includes/footer.php'; ?>
