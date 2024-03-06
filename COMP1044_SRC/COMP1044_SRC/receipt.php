<?php
    session_start();
    require "config.php";

    $sql = "SELECT customer_info.cus_name, customer_info.cus_email, customer_info.cus_tel, booking_info.checkin_date, booking_info.checkout_date, booking_info.Occasion
        FROM customer_info 
        JOIN booking_info ON customer_info.reservation_id = booking_info.reservation_id
        WHERE customer_info.reservation_id = '".$_SESSION["reser_id"]."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cus_name = $row["cus_name"];
            $cus_email = $row["cus_email"];
            $cus_tel = $row["cus_tel"];
            $occasion = $row["Occasion"];
            $checkin_date = $row["checkin_date"];
            $checkout_date = $row["checkout_date"];
        }
    }

    $carID = $_SESSION["carID"];
    $totalAmountDue = 0;
    
    $sql = "SELECT price_perday FROM cars_info WHERE car_id = '$carID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $pricePerDay = $row['price_perday'];
    } else {
        $pricePerDay = 0;
    }

    $duration = date_diff(date_create($checkin_date), date_create($checkout_date))->format('%a');

    $totalAmountDue = ($duration + 1) * $pricePerDay;

?>

<!DOCTYPE html>
<html>
<head>
<title>Car Reservation Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="receipt.css">

</head>
<body>
    <section class="header">
        <nav>
            <div class="dropdown">
                <img src="picture/blank-profile-picture-973460_1280.jpg" style="width:60px;border-radius: 50%;"></a>
                <div class="dropdown-content">
                <a href="customerinfo.php" class="dropdown-item">Customer Booking</a>
                <a href="customerinfo.php" class="dropdown-item">Customer Details</a>
              </div>
            </div>
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

<!--RECEIPT-->
<section class="receipt">
  <h2 class="receipt-title">Car Rental Receipt</h2>

  <div class="receipt-details">
    <div class="receipt-row">
      <h4 class="receipt-label">Reserved Car:</h4>
      <p class="receipt-value"><?php echo $_SESSION["car_name"]; ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Reservation Number:</h4>
      <p class="receipt-value"><?php echo $_SESSION["reser_id"]; ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Customer Name:</h4>
      <p class="receipt-value"><?php echo $cus_name ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Email Address:</h4>
      <p class="receipt-value"><?php echo $cus_email ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Contact Number:</h4>
      <p class="receipt-value"><?php echo $cus_tel ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Occasion:</h4>
      <p class="receipt-value"><?php echo $occasion ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Rental Period:</h4>
      <p class="receipt-value"><?php echo date('d/m/Y', strtotime($checkin_date)) . ' to ' . date('d/m/Y', strtotime($checkout_date)) ?></p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Rental Duration:</h4>
      <p class="receipt-value">
        <?php 
        $duration = date_diff(date_create($checkin_date), date_create($checkout_date))->format('%a'); 
        if ($duration == 0) {
            echo "1 day";
        } else {
            echo "$duration days";
        }
        ?>
      </p>
    </div>

    <div class="receipt-row">
      <h4 class="receipt-label">Total Amount Due:</h4>
      <p class="receipt-value">MYR <?php echo $totalAmountDue ?></p>
    </div>
  </div>

    <div class="receipt-confirm">
        <!-- <a href="#" class="receipt-button" download>Download</a> -->
        <a href="#" class="receipt-button" onclick="window.print();">Print</a>
    </div>


  <div class="receipt-confirm">
    <a href="home.php" class="receipt-button">Back to home page</a>
  </div>
</section>

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
