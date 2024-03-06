<?php
    session_start();
    require "config.php";
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
            <a href="user.php"><img src="picture/blank-profile-picture-973460_1280.jpg" style="width:60px; border-radius: 50%;"></a>
            <span id="name"><?php echo $_SESSION["username"]; ?></span>

            <span class="nav-links">
                <ul>
                    <li><a href = "home.php">HOME</a></li>
                    <li><a href = "luxurious.php">BACK</a></li>
                    <li><a href = "#about">ABOUT</a></li>
                    <li><a href = "login.php">LOG OUT</a></li>
                </ul>
            </span>
        </nav>
    </section>

<!--PAYMENT-->
<section>

    <div class="payment">
        <h2>Cancel Reservation Form</h2>
        <form action="" method="post">
        
            <h4>Reservation Number</h4>
            <div class="row">
                <div class="col">
                    <input type="text" placeholder="xxxxxx" required class="info">               
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="checkbox" required>
                    <span>term and condition</span>             
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit">CONFIRM</button>
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
<a href="home.php"><h2>About Us</h2></a>
<p>The best car rental reservation system created by Yuken, Mabel and Ken Siang from University of Nottingham Malaysia Campus
    using HTML,CSS,Javascript,php and sql.</p><br>
<span>Powered By: </span>
<span id="group">Group 34</span>
</section>
</body>
</html>

<script>
    function handle(){
        document.getElementById("info").style.color="black";
}

const form = document.querySelector('form');
          form.addEventListener('submit', (e) => {
          e.preventDefault();
        
          if (true) {
            alert('Cancel Successfully')
            window.location.href="home.php"
            
          } else {
            alert('Wrong Reservation Date');
          }
        });
</script>
 