<?php
include 'includes/db.php';

if(!isset($_GET['meter']) || $_GET['meter']==""){
    header("Location: register.php");
    exit();
}

$meter = $_GET['meter'];

$q = mysqli_query($conn,"SELECT * FROM consumers WHERE meter_no = $meter");

if(mysqli_num_rows($q)==0){
    header("Location: register.php");
    exit();
}

$row = mysqli_fetch_assoc($q);
$pageTitle = "User Dashboard";
include 'includes/header.php';
?>

<h2>User Dashboard</h2>

<div class="info">
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Service Number:</b> <?php echo isset($row['id']) ? $row['id'] : $row['meter_no']; ?></p>
    <p><b>Meter No:</b> <?php echo $row['meter_no']; ?></p>
    <p><b>Paid Amount:</b> ₹<?php echo $row['paid_amount']; ?></p>
    <p><b>Due Amount:</b> ₹<?php echo $row['due_amount']; ?></p>
    <p><b>Bill Date:</b> <?php echo $row['bill_date']; ?></p>
    <p><b>Due Date:</b> <?php echo $row['due_date']; ?></p>
    <p style="color:red; margin-top:10px;"><b>Amount after Due Date (with Fine):</b> ₹<?php echo $row['due_amount'] + 150; ?></p>
</div>

<button type="button"
onclick="window.location.href='register.php'">
New Registration
</button>

<button type="button" class="secondary-btn"
onclick="window.location.href='main_dashboard.php?meter=<?php echo $meter; ?>'">
Back to Dashboard
</button>

<?php include 'includes/footer.php'; ?>
