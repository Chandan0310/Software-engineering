<?php
include 'includes/db.php';
include 'includes/functions.php';
$pageTitle = "Employee Dashboard";
include 'includes/header.php';
?>

<h2>Employee Dashboard</h2>

<form method="post">
<label>Meter Number</label>
<input type="number" name="meter" required>

<label>Present Reading/Units</label>
<input type="number" name="present" required>

<button name="generate">Generate Bill</button>

<button type="button" class="secondary-btn"
onclick="window.location.href='main_dashboard.php'">
Back to Dashboard
</button>

</form>

<?php
if(isset($_POST['generate'])){

    $meter = $_POST['meter'];
    $present = $_POST['present'];

    $q = mysqli_query($conn,"SELECT * FROM consumers WHERE meter_no=$meter");

    if(mysqli_num_rows($q)==0){
        echo "<p class='error'>Invalid Meter Number</p>";
    } else {

        $row = mysqli_fetch_assoc($q);

        $units = $present - $row['past_units'];
        if($units < 0) {
            $units = 0; // Should ideally throw error or handle rollover, but keeping simple as per spec
        }

        // Use the new modular calculation function
        $amount = calculateBill($units);

        $total_due = $row['due_amount'] + $amount;

        mysqli_query($conn,"UPDATE consumers SET
            past_units = $present,
            present_units = $present,
            due_amount = $total_due,
            bill_date = CURDATE(),
            due_date = DATE_ADD(CURDATE(), INTERVAL 15 DAY)
            WHERE meter_no = $meter
        ");

        echo "<div class='info'>
                <p><b>Bill Generated Successfully</b></p>
                <p>Units Used: $units</p>
                <p>Calculation Method: Tiered Pricing</p>
                <p>Current Bill: ₹$amount</p>
                <p>Total Due: ₹$total_due</p>
                <p>Bill Date: " . date("Y-m-d") . "</p>
              </div>";
    }
}
?>

<?php include 'includes/footer.php'; ?>
