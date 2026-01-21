<?php
$conn = mysqli_connect("localhost","root","","electricity_db");

$generatedMeter = "";  

if(isset($_POST['register'])){
    $generatedMeter = rand(100000,999999);
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $category = $_POST['category'];

    $billDate = date("Y-m-d");
    $dueDate  = date("Y-m-d", strtotime("+15 days"));

    if(mysqli_query($conn,"INSERT INTO consumers
        (meter_no,name,phone,address,pincode,category,bill_date,due_date)
        VALUES
        ($generatedMeter,'$name','$phone','$address','$pincode','$category',
        '$billDate','$dueDate')
    ")){
        $billNo = mysqli_insert_id($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Registration</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>User Registration</h2>

<?php if($generatedMeter != ""){ ?>
   
    <div class="info">
        <p><b>Registration Successful!</b></p>
        <p>Your Meter Number is:</p>
        <h3><?php echo $generatedMeter; ?></h3>

        <p>Your Bill Number is:</p>
        <h3><?php echo $billNo; ?></h3>

        <button type="button"
        onclick="window.location.href='main_dashboard.php?meter=<?php echo $generatedMeter; ?>&bill_no=<?php echo $billNo; ?>'">
        Go to Main Dashboard
        </button>
    </div>

<?php } else { ?>

<form method="post">

<label>Name (camelCase)</label>
<input type="text" name="name" pattern="[a-z]+([A-Z][a-z]+)*" required>

<label>Phone (10 digits)</label>
<input type="text" name="phone" pattern="[0-9]{10}" required>

<label>Address</label>
<textarea name="address"></textarea>

<label>Pincode</label>
<input type="text" name="pincode" pattern="[0-9]{6}" required>

<label>Category</label>
<select name="category">
    <option>household</option>
    <option>commercial</option>
    <option>industry</option>
</select>

<button name="register">Register</button>

<button type="reset" class="secondary-btn">
Reset
</button>

</form>


<?php } ?>

</div>

</body>
</html>
