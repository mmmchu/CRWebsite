<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Car Reservation Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="home.css">
</head>
<body>
    <section class="header" id="header">
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
                    <li><a href = "#package">OCCASION</a></li>
                    <li><a href = "#car">OUR CAR</a></li>
                    <li><a href = "#about">ABOUT</a></li>
                    <li><a href = "login.php">LOG OUT</a></li>
                </ul>
            </span>
        </nav>
        
<div class="text-box">
    <h1>Desiring a Luxury Car Experience?</h1>
    <p>Experience the epitome of sophistication with our luxury, sports, and classic cars. <br>From elegant sedans and spacious wagons to versatile sports vehicles, we have a car to suit every lifestyle and meet all your driving needs.</p>
    <a href="#package" class="button">Let's Get Started!</a>
</div>
    </section>

<!--Package-->
<section class="package" id="package">
    <h1>Occasions</h1>
    <br><p>Providing you with a grand lifestyle is our slogan. We offer the most premium cars in the industry. Drive well and safe</p></br>
    <section class="car" id="car">
    <div class="row">
        <div class="car-col">
            <img src="picture/wedding.jpg">
            <div class="layer">
                <h3>Wedding</h3>
            </div>
            <div class="description">
                <p>Nottrides offers luxury cars for the day of your life. We know how much the day is important for you, So you can rely on us for all your wedding transportation needs.</p>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/business.jpg">
            <div class="layer">
                <h3>Business Travel</h3>
            </div>
            <div class="description">
                <p>Nottrides offers ride services for corporates. We understand the importance of your VIP (be it your Client, Boss or a Guest), so we've got you covered.</p>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/videoshoot.jpg">
            <div class="layer">
                <h3>Video Shoots</h3>
            </div>
            <div class="description">
                <p>Nottrides offers rental services for your Pre-Wedding / Music Video / Movie / Photo Shoots. Feel free to reach out to us for short term rentals.</p>
            </div>
        </div>
    </div>
    <section class="car1" id="car1">
        <div class="row1">
        <div class="car-card">
        <h2 class="car-type">Luxurious</h2>
        <div class="car-price">RM1350-RM9800<span>per day</span></div>
        <a href="luxurious.php" class="rent-button">Rent</a>
        </div>
        <div class="car-card">
        <h2 class="car-type">Sports</h2>
        <div class="car-price">RM1600-RM7000<span>per day</span></div>
        <a href="sports.php" class="rent-button">Rent</a>
        </div>
        <div class="car-card">
        <h2 class="car-type">Classic</h2>
        <div class="car-price">RM2200-RM3200<span>per day</span></div>
        <a href="classic.php" class="rent-button">Rent</a>
        </div>
    </div>
    </section>
    </section>
</section>

<!--CAR-->
<section class="car" id="car">
    <h1>Our Cars</h1>

    <div class="row">
        <div class="car-col">
            <img src="picture/roll1.png">
            <div class="layer">
                <h3>Rolls Royce Phantom</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/bent.png">
            <div class="layer">
                <h3>Bentley Continental Flying Spur</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/benz1.png">
            <div class="layer">
                <h3>Mercedes Benz CLS 350</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="car-col">
            <img src="picture/jaguar3.png">
            <div class="layer">
                <h3>Jaguar S Type</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/ferrari3.png">
            <div class="layer">
                <h3>Ferrari F430 Scuderia </h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/lamboo.png">
            <div class="layer">
                <h3>Lamborghini Murcielago LP640</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="car-col">
            <img src="picture/Porsche1.webp">
            <div class="layer">
                <h3>Porsche Boxster</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/lexus3.png">
            <div class="layer">
                <h3>Lexus SC430</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/mk2.png">
            <div class="layer">
                <h3>Jaguar MK 2</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="car-col">
            <img src="picture/rollcla.png">
            <div class="layer">
                <h3>Rolls Royce Silver Spirit Limousine</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/mg.png">
            <div class="layer">
                <h3>MG TD</h3>
            </div>
        </div>
        <div class="car-col">
            <img src="picture/white.jpg">
         
            </div>
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
    <a href="home.php"><h2>About Us</h2></a>
    <p>The best car rental reservation system created by Yuken, Mabel and Ken Siang from University of Nottingham Malaysia Campus
    using HTML,CSS,Javascript,php and sql.</p>
    <br>
    <span>Powered By: </span>
    <span id="group">Group 34</span>
</section>

<script>
    var header = document.getElementById("header");
    var images = ["picture/lux2.jpg", "picture/lux3.jpg", "picture/sport1.jpeg", "picture/sport2.jpg", "picture/lux1.jpg"];
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