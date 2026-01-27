<?php
include 'includes/db.php';
include 'includes/functions.php';

$generatedMeter = "";  
$errors = [];

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $category = $_POST['category'];

    // Validation
    if(!validateName($name)){
        $errors[] = "Name must contain alphabets only.";
    }
    if(!validatePhone($phone)){
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    if(empty($errors)){
        $generatedMeter = rand(100000,999999);
        $billDate = date("Y-m-d");
        $dueDate  = date("Y-m-d", strtotime("+15 days"));

        // Check for duplicate meter (highly unlikely but good practice)
        $check = mysqli_query($conn, "SELECT * FROM consumers WHERE meter_no = $generatedMeter");
        while(mysqli_num_rows($check) > 0){
            $generatedMeter = rand(100000,999999);
            $check = mysqli_query($conn, "SELECT * FROM consumers WHERE meter_no = $generatedMeter");
        }

        if(mysqli_query($conn,"INSERT INTO consumers
            (meter_no,name,phone,address,pincode,category,bill_date,due_date)
            VALUES
            ($generatedMeter,'$name','$phone','$address','$pincode','$category',
            '$billDate','$dueDate')
        ")){
            $billNo = mysqli_insert_id($conn);
        } else {
            $errors[] = "Database Error: " . mysqli_error($conn);
        }
    }
}
$pageTitle = "User Registration";
include 'includes/header.php';
?>

<h2>User Registration</h2>


<?php if($generatedMeter != ""){ ?>
   
    <div class="info">
        <p><b>Registration Successful!</b></p>
        <p>Your Meter Number is:</p>
        <h3><?php echo $generatedMeter; ?></h3>

        <p>Your Service Number is:</p>
        <h3><?php echo $billNo; ?></h3>

        <button type="button"
        onclick="window.location.href='main_dashboard.php?meter=<?php echo $generatedMeter; ?>&bill_no=<?php echo $billNo; ?>'">
        Go to Main Dashboard
        </button>
    </div>

<?php } else { ?>

<?php if(!empty($errors)){ ?>
    <div class="error" style="background:#ffebee; padding:10px; border-left:5px solid #f44336;">
        <?php foreach($errors as $err) echo "<p>$err</p>"; ?>
    </div>
<?php } ?>

<form method="post">

<label>Name (Alphabets only)</label>
<input type="text" name="name" pattern="[A-Za-z\s]+" title="Alphabets only" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>

<label>Phone (10 digits)</label>
<input type="text" name="phone" pattern="[0-9]{10}" title="Exactly 10 digits" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required>

<label>Address</label>
<textarea name="address"><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea>

<label>Pincode</label>
<input type="text" name="pincode" pattern="[0-9]{6}" value="<?php echo isset($_POST['pincode']) ? $_POST['pincode'] : ''; ?>" required>

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

<?php include 'includes/footer.php'; ?>
