<?php
  session_start();
  require "config.php";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $checkin = $_POST["checkin"] ?? "";
    $checkout = $_POST["checkout"] ?? "";

    if ($checkin !== $_SESSION["checkin"] || $checkout !== $_SESSION["checkout"]) {
      $_SESSION["checkin"] = $checkin;
      $_SESSION["checkout"] = $checkout;
    }

    if (!empty($checkin) && !empty($checkout)) {

        $checkin = date('Y-m-d', strtotime($checkin));
        $checkout = date('Y-m-d', strtotime($checkout));
        $sql = "SELECT * FROM booking_info  WHERE (checkin_date <= ? AND checkout_date >= ?) OR (checkin_date >= ? AND checkin_date <= ?) OR (checkout_date >= ? AND checkout_date <= ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $checkin, $checkout, $checkin, $checkout, $checkin, $checkout);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $booked_cars = array(); 

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $booked_car_id = $row["car_id"];
                array_push($booked_cars, $booked_car_id); 
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        echo "<script>
            window.onload = function() {
                var booked_cars = " . json_encode($booked_cars) . "; // convert the array to a JavaScript array
        
                for (var i = 0; i < booked_cars.length; i++) {
                    var car_id = booked_cars[i];
                    document.getElementById(car_id).querySelector('button.box-foot').disabled = true;
                    document.getElementById(car_id).querySelector('button.box-foot').style.opacity = '0.5';
                }
            }
        </script>";
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
  }
  // session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<title>Car Reservation Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="car.css">

</head>
<body>
    <section class="header" id="header">
        <nav>
            <img src="picture/blank-profile-picture-973460_1280.jpg" style="width:60px;border-radius: 50%;"></a>
            <span id="name"><?php echo $_SESSION["username"]; ?></span>

            <span class="nav-links">
                <ul>
                    <li><a href = "home.php">HOME</a></li>
                    <li><a href = "customerinfo.php">RESERVATION</a></li>
                    <li><a href = "#car">OUR CAR</a></li>
                    <li><a href = "#about">ABOUT</a></li>
                    <li><a href = "login.php">LOG OUT</a></li>
                </ul>
            </span>
        </nav>

        <div class="text-box">
            <h1>SPORTS</h1>
            <p>Providing you with a grand lifestyle is our slogan. We offer the most premium cars in the industry. <br>Drive well and safe</p>
            <a href="home.php" class="button">Visit Us to Know More</a>
        </div>

    </section>

<!--CAR-->
<section class="car" id="car">

  <section class="check-availability">
      <h2>Check Availability</h2>
      <form id="booking-form" action="sports.php" method="POST">
          <div class="date-container">
              <div class="date-input">
                  <label for="checkin">Check In</label>
                  <input type="date" name="checkin" id="checkin" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $_SESSION["checkin"] ?? ''; ?>" placeholder="DD MM YYYY" required>
              </div>
              <div class="date-input">
                  <label for="checkout">Check Out</label>
                  <input type="date" name="checkout" id="checkout" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $_SESSION["checkout"] ?? ''; ?>" placeholder="DD MM YYYY" required>
                  <!-- <span id="checkout-error" style="display: none; color: red;">Check-out date must not be earlier than check-in date</span> -->
              </div>
          </div>
          <button type="submit" class="check-btn">Check</button>
      </form>
      </section>
          

    <div class="row">

        <div class="car-col" id="6">
          <img src="picture/ferrari3.png">
          <h3>Ferrari F430 Scuderia</h3>
          <div>Colors: Red</div>
          <div>RM6000 per day</div>     
          <button type="submit" class="box-foot" onclick="storeCarId('6')">Rent</button>
        </div>

        <div class="car-col" id="7">
          <img src="picture/Lamboo.png">
          <h3>Lamborghini Murcielago LP640</h3>  
          <div>Colors: Matte Black</div>
          <div>RM7000 per day</div>          
          <button type="submit" class="box-foot" onclick="storeCarId('7')">Rent</button>
        </div>

        <div class="car-col" id="8">
          <img src="picture/Porsche1.webp">
          <h3>Porsche Boxster</h3>
          <div>Colors: White</div>
          <div>RM2800 per day</div>
          <button type="submit" class="box-foot" onclick="storeCarId('8')">Rent</button>
        </div>

        <div class="car-col" id="9">
          <img src="picture/lexus3.png">
          <div class="box-title">
          <h3>Lexus SC430</h3>
          <div>Colors: Black</div>
          <div>RM1600 per day</div>
          <button type="submit" class="box-foot" onclick="storeCarId('9')">Rent</button>
        </div>

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

<script>
    var header = document.getElementById("header");
    var images = ["picture/lux2.jpg", "picture/lux3.jpg", "picture/lux1.jpg"];
    var index = 0;

    function changeImage() {
        header.classList.add("change-image");

        setTimeout(function() {
            header.style.backgroundImage = "linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url(" + images[index] + ")";
            header.classList.remove("change-image");
            index++;
            if (index == images.length) {
                index = 0;
            }
        }, 1000);
}

setInterval(changeImage, 2500);
</script>


</body>
</html>

<script>
function storeCarId(carId) {
  sessionStorage.setItem('carId', carId);
  location.href = 'paySp.php?carId=' + carId;
}
</script>

<script>
document.getElementById('booking-form').addEventListener('submit', function(event) {
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');
    const checkoutError = document.getElementById('checkout-error');

    if (checkout.value < checkin.value) {
        event.preventDefault();
        checkoutError.style.display = 'block';
    } else {
        checkoutError.style.display = 'none';
    }
});

document.getElementById('checkin').addEventListener('change', function() {
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');

    if (checkin.value > checkout.value) {
        checkout.value = checkin.value;
    }

    checkout.min = checkin.value;
});
</script>
