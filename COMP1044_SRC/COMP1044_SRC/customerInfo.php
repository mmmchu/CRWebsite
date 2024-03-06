<?php
    session_start();
    require "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["passwordedit"]) && isset($_SESSION["password"])) {
            $current_password = $_SESSION["password"];
            $password = $_POST["passwordedit"];
    
            if ($password == $current_password) {
                $reservation_id = $_POST["reservation_id"];
                $car_id = $_POST["car_id"];
                header("Location: change.php?reservation_id=" . $reservation_id . "&car_id=" . $car_id);
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        }
    }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $reservation_id = $_POST["reservation_id"];

        if (isset($_POST["password"]) && isset($_SESSION["password"])) {

            $current_password = $_SESSION["password"];
            $password = $_POST["password"];

                if ($password == $current_password) {
                
                    $delete_query = "DELETE booking_info, customer_info
                    FROM booking_info
                    JOIN customer_info ON booking_info.reservation_id = customer_info.reservation_id
                    WHERE booking_info.reservation_id = '$reservation_id'
                    ";
                    // echo "Debug: query = $delete_query<br>";

                    if ($conn->query($delete_query) === TRUE) {
                        echo "<script>alert('Reservation cancelled');</script>";
                    }else {
                        echo "Error deleting record: " . $conn->error;
                    }

                }else {
                    echo "<script>alert('Incorrect password');</script>";
                }
        }
    }

    $query = "SELECT booking_info.reservation_id, booking_info.staff_id, booking_info.checkin_date, booking_info.checkout_date, booking_info.Occasion, customer_info.cus_name, customer_info.cus_email, cars_info.car_id, cars_info.car_name
          FROM booking_info
          JOIN customer_info ON booking_info.reservation_id = customer_info.reservation_id
          JOIN cars_info ON booking_info.car_id = cars_info.car_id";

    $result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Car Reservation Website</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="table.css">
    </head>
<body>
    <section class="header">
        <nav>
            <a href="customerinfo.php"><img src="picture/blank-profile-picture-973460_1280.jpg" style="width:60px;border-radius: 50%;"></a>
            <span id="name"><?php echo $_SESSION["username"]; ?></span>

            <span class="nav-links">
                <ul>
                    <li><a href = "home.php">HOME</a></li>
                    <li><a href = "#about">ABOUT</a></li>
                    <li><a href = "login.php">LOG OUT</a></li>
                </ul>
            </span>
        </nav>
    </section>

<br>
<h1>Customer Reservation</h1>
<br><br>
<table class="table">
    <thead>
      <tr>
        <th>Reservation ID</th>
        <th>Staff ID</th>
        <th>Check In Date</th>
        <th>Check Out Date</th>
        <th>Occasion</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Car ID</th>
        <th>Reserved Car</th>
        <th></th>
      </tr>
    </thead>
<tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        $reservation_id = $row["reservation_id"];
        echo "<tr>";
        echo "<td>" . $row["reservation_id"] . "</td>";
        echo "<td>" . $row["staff_id"] . "</td>";
        echo "<td>" . $row["checkin_date"] . "</td>";
        echo "<td>" . $row["checkout_date"] . "</td>";
        echo "<td>" . $row["Occasion"] . "</td>";
        echo "<td>" . $row["cus_name"] . "</td>";
        echo "<td>" . $row["cus_email"] . "</td>";
        echo "<td>" . $row["car_id"] . "</td>";
        echo "<td>" . $row["car_name"] . "</td>";
        echo "<td>
        <button class='table-button' type='button' data-reservation-id='" . $reservation_id . "' onclick='showEditConfirmation(this)' name='edit_reservation'>Edit</button>
        <div id='editConfirmationModal" . $reservation_id . "' class='modal'>
            <div class='modal-content'>
                <span class='close' data-reservation-id='" . $reservation_id . "' onclick='hideEditConfirmation(this)'>&times;</span>
                <form method='post'>
                    <label for='passwordedit'>Staff password:</label>
                    <input type='hidden' name='reservation_id' value='" . $reservation_id . "'>
                    <input type='hidden' name='car_id' value='" . $row["car_id"] . "'>
                    <input type='password' id='passwordedit' name='passwordedit'>
                    <br>
                    <button type='submit' class='modal-confirm-button'>Edit</button>
                </form>
            </div>
        </div>
        <button class='table-button' type='button' data-reservation-id='" . $reservation_id . "' onclick='showConfirmation(this)' name='delete_reservation'>Delete</button>
                <div id='confirmationModal" . $reservation_id . "' class='modal'>
                <div class='modal-content'>
                    <span class='close' data-reservation-id='" . $reservation_id . "' onclick='hideConfirmation(this)'>&times;</span>
                    <form method='post'>
                    <label for='password'>Staff password:</label>
                    <input type='hidden' name='reservation_id' value='" . $reservation_id . "'>
                    <input type='password' id='password' name='password'>
                    <br>
                    <button type='submit' class='modal-confirm-button'>Delete</button>
                    </form>
                </div>
                </div>
            </td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>

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
    function showConfirmation(button) {
        var reservation_id = button.getAttribute('data-reservation-id');
        var modal = document.getElementById("confirmationModal" + reservation_id);
        modal.style.display = "block";
    }

    function hideConfirmation(button) {
        var reservation_id = button.getAttribute('data-reservation-id');
        var modal = document.getElementById("confirmationModal" + reservation_id);
        modal.style.display = "none";
    }
</script>

<script>
    function showEditConfirmation(button) {
        var reservation_id = button.getAttribute('data-reservation-id');
        var modal = document.getElementById("editConfirmationModal" + reservation_id);
        modal.style.display = "block";
    }

    function hideEditConfirmation(button) {
        var reservation_id = button.getAttribute('data-reservation-id');
        var modal = document.getElementById("editConfirmationModal" + reservation_id);
        modal.style.display = "none";
    }
</script>





