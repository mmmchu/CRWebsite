<?php
    session_start();
    require "config.php";

    if (isset($_GET['carId'])) {
        $carId = $_GET['carId'];

        $sql = "SELECT car_name, car_image FROM cars_info WHERE car_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $carId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $carName = $row['car_name'];
        $imagePath = $row['car_image'];
        $_SESSION["car_name"] = $carName;
        $_SESSION["carID"] = $carId;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $carID = $_POST["carID"];
        $cusname = $_POST["cusname"];
        $cusemail = $_POST["cusemail"]; 
        $custel = $_POST["custel"]; 
        $cusadd = $_POST["cusadd"];
        $cus_checkin = $_POST["cus_checkin"]; 
        $cus_checkout = $_POST["cus_checkout"];
        $reservation_id = $cusname . rand(1000, 9999); 
        $_SESSION["reser_id"] = $reservation_id;
        $staff_id = $_SESSION['staff_id'];
        $cus_checkin = date('Y-m-d', strtotime($cus_checkin));
        $cus_checkout = date('Y-m-d', strtotime($cus_checkout));
        $occasion = $_POST["occasion"];

        $sqlcheck = "SELECT * FROM booking_info  WHERE car_id = ? AND (checkin_date <= ? AND checkout_date >= ?) OR (checkin_date >= ? AND checkin_date <= ?) OR (checkout_date >= ? AND checkout_date <= ?)";
        $stmt = $conn->prepare($sqlcheck);
        $stmt->bind_param("issssss", $carID, $cus_checkin, $cus_checkout, $cus_checkin, $cus_checkout, $cus_checkin, $cus_checkout);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $matchFound = false;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["car_id"] == $carID) {
                    echo "<script>alert('Booking dates not available')</script>";
                    $matchFound = true;
                    break;
                }
            }
            if (!$matchFound) {
                $sqlreserid = "INSERT INTO booking_info (reservation_id,car_id,staff_id,checkin_date,checkout_date,Occasion) VALUES ('$reservation_id','$carID','$staff_id','$cus_checkin','$cus_checkout','$occasion')";
                if ($conn->query($sqlreserid)) {
                    $sql = "INSERT INTO customer_info (cus_name,cus_email,cus_tel,cus_add,reservation_id) VALUES ('$cusname','$cusemail','$custel','$cusadd','$reservation_id');";
                    if ($conn->query($sql)) {
                        header("Location: receipt.php");  
                        exit();
                    }
                }
            }
        } else {
            $sqlreserid = "INSERT INTO booking_info (reservation_id,car_id,staff_id,checkin_date,checkout_date,Occasion) VALUES ('$reservation_id','$carID','$staff_id','$cus_checkin','$cus_checkout','$occasion')";
            if ($conn->query($sqlreserid)) {
                $sql = "INSERT INTO customer_info (cus_name,cus_email,cus_tel,cus_add,reservation_id) VALUES ('$cusname','$cusemail','$custel','$cusadd','$reservation_id');";
                if ($conn->query($sql)) {
                    header("Location: receipt.php");  
                    exit();
                }
            }
        }
    } 
?>

<!DOCTYPE html>
<html>
<head>
<title>Car Reservation Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="payment.css">

</head>
<body>
    <section class="header">
        <nav>
            <img src="picture/blank-profile-picture-973460_1280.jpg" style="width:60px; border-radius: 50%;"></a>
            <span id="name"><?php echo $_SESSION["username"]; ?></span>

            <span class="nav-links">
                <ul>
                    <li><a href = "home.php">HOME</a></li>
                    <li><a href = "customerinfo.php">RESERVATION</a></li>
                    <li><a href = "#about">ABOUT</a></li>
                    <li><a href = "login.php">LOG OUT</a></li>
                </ul>
            </span>
        </nav>
    </section>

    <div class="container">
    <div class="top-section">

        <div class="reserved-car">
            <h1>Reserved car: </h1>
            <img class = picture src = "<?php echo $imagePath; ?>" alt="<?php echo $carName; ?>">
            <h2><?php echo $carName; ?></h2>
        </div>

        <div class="customer-details">
            <h2>Customer Details</h2>
            <form id="booking-form" action="payLux.php" method="POST">
                <div class="form-group">
                    <label for="cusname">Full Name</label>
                    <input type="text" name="cusname" id="cusname" required class="info">
                </div>
                <input type="hidden" name="carID" id="carId" value="<?php echo $carId; ?>" required class="info">
                <div class="form-group">
                    <label for="cusemail">Email Address</label>
                    <input type="email" name="cusemail" id="cusemail" required class="info">
                </div>
                <div class="form-group">
                    <label for="cusadd">Billing Address</label>
                    <input type="text" name="cusadd" id="cusadd" required class="info">
                </div>
                <div class="form-group">
                    <label for="custel">Contact Number</label>
                    <input type="text" name="custel" id="custel" required class="info">
                </div>
                <div class="form-group">
                    <label for="occasion">Occasion</label>
                    <select name="occasion" id="occasion" required class="info">
                        <option value="">Select Occasion</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Video Shoots">Video Shoots</option>
                        <option value="Business Travel">Business Travel</option>
                        <option value="Others"> Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cus_checkin">Check In</label>
                    <input type="date" name="cus_checkin" id="cus_checkin" min="<?php echo date('Y-m-d'); ?>" required class="info">
                </div>
                <div class="form-group">
                    <label for="cus_checkout">Check Out</label>
                    <input type="date" name="cus_checkout" id="cus_checkout" min="<?php echo date('Y-m-d'); ?>" required class="info">
                    <span id="checkout-error" style="display: none; color: red;">Check-out date must not be earlier than check-in date</span>
                </div>
                <div class="form-group">
                    <button id="button" type="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!--Contact-->
<section class="contact">
    <h1>Rent Our Premium Cars<br>For a Luxurious Lifestyle</h1>
    <a href="" class="button">CONTACT US</a>
</section>

<!--About-->
<section class="about" id="about">
<a href="luxurious.php"><h2>About Us</h2></a>
<p>The best car rental reservation system created by Yuken, Mabel and Ken Siang from University of Nottingham Malaysia Campus
    using HTML,CSS,Javascript,php and sql.</p><br>
<span>Powered By: </span>
<span id="group">Group 34</span>
</section>
</body>
</html>

<script>
const checkinInput = document.getElementById('cus_checkin');
const checkoutInput = document.getElementById('cus_checkout');
const checkoutError = document.getElementById('checkout-error');
const submitButton = document.querySelector('button');

checkoutInput.addEventListener('change', function() {
  const checkinDate = new Date(checkinInput.value);
  const checkoutDate = new Date(checkoutInput.value);

  if (checkoutDate < checkinDate) {
    checkoutError.style.display = 'block';
    checkoutInput.value = '';
    submitButton.disabled = true;
  } else {
    checkoutError.style.display = 'none';
    submitButton.disabled = false;
  }
});
</script>


 