<?php
    session_start();
    require "config.php";

    $reservation_id = $_GET['reservation_id'];
    $car_id = $_GET['car_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $carid = $_POST['carid'];
        $reser_id = $_POST['reservation_id'];
        $checkin_date = $_POST['cus_checkin'];
        $checkout_date = $_POST['cus_checkout'];
        $newcus_checkin = date('Y-m-d', strtotime($checkin_date));
        $newcus_checkout = date('Y-m-d', strtotime($checkout_date));

        $query = "SELECT * FROM booking_info WHERE car_id = '$carid' AND reservation_id != '$reser_id' AND ((checkin_date >= '$newcus_checkin' AND checkin_date < '$newcus_checkout') OR (checkout_date > '$newcus_checkin' AND checkout_date <= '$newcus_checkout'))";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<script>alert('This car is not available for the selected dates. Please try again with different dates.');</script>";
            echo "<script>window.location='customerinfo.php'</script>";
        } else {
            $query = "UPDATE booking_info SET checkin_date = '$newcus_checkin', checkout_date = '$newcus_checkout' WHERE reservation_id = '$reser_id'";
            $result = $conn->query($query);
        
            if ($result) {
                echo "<script>alert('Booking information updated successfully!'); window.location='customerinfo.php'</script>";
            } else {
                echo "<script>alert('Booking information update failed!'); window.location='customerinfo.php'</script>";
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
                <span id="name"><?php echo  $_SESSION["username"];  ?></span>

                <span class="nav-links">
                    <ul>
                        <li><a href = "home.php">HOME</a></li>
                        <li><a href = "customerinfo.php">BACK</a></li>
                        <li><a href = "#about">ABOUT</a></li>
                        <li><a href = "login.php">LOG OUT</a></li>
                    </ul>
                </span>
            </nav>
        </section>

    <!--PAYMENT-->
    <section>
        <div class="payment">
            <h2>Reservation ID : <?php echo $reservation_id ?></h2>
            <form action="change.php" method="POST">

                <input type="hidden" name="carid" id="carid" value="<?php echo $car_id; ?>" required class="info">
                <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo $reservation_id; ?>" required class="info">

                <h4>New Check In Date</h4>
                <div class="row">
                    <div class="col">
                        <input type="date" name="cus_checkin" id="cus_checkin" min="<?php echo date('Y-m-d'); ?>" required class="info">               
                    </div>
                </div>

                <h4>New Check Out Date</h4>
                <div class="row">
                    <div class="col">
                        <input type="date" name="cus_checkout" id="cus_checkout" min="<?php echo date('Y-m-d'); ?>" required class="info">               
                        <span id="checkout-error" style="display: none; color: red;">Check-out date must not be earlier than check-in date</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button id="button" type="submit">UPDATE</button>
                    </div>
                </div>

            </form>
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
    using HTML,CSS,Javascript,php and sql.</p>            <br>
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


    