<?php
    session_start();
    require "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $uname = $_POST["uname"];
        $email = $_POST["email"]; 
        $pw = $_POST["pw"]; 
        $staff_id = $uname . rand(1000, 9999);
        $_SESSION['staff_id'] = $staff_id;

        $sql = "INSERT INTO signup_form (Username,Email,Pass_word,staff_id) VALUES ('$uname','$email','$pw','$staff_id');";
    
        if($conn->query($sql)){
            header("Location: Login.php");  
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Car Rental Reservation Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Avenir:wght@400;500;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="center">
      <!-- <a href="login.php"><img src="https://cdn-icons-png.flaticon.com/512/57/57165.png" class="btn"></a> -->
      <h1>Sign Up</h1>
      <form action="signUp.php" method="POST">
        <div class="txt_field">
        <input type="text" id="username" name="uname" autocomplete="off" required>
          <span></span>
          <label for="uname">Username</label>
        </div>
        <div class="txt_field">
            <input type="email" id="email" name="email" autocomplete="off" required>
            <span></span>
            <label for="email">E-mail</label>
          </div>
        <div class="txt_field">
          <input type="password" id="password" autocomplete="off" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
            <input type="password" id="comPass" name="pw" autocomplete="off" required>
            <span></span>
            <label for="pw">Confirm Password</label>
            <span id="comPassError" style="color:red; display:none;">Passwords do not match</span>
        </div>            
            <input type="submit" value="Sign Up">

            <div class="signup_link">
            Already have an account ? <a href="login.php">Login</a>
          </div>
      </form>
    </div>

    <script>
        const form = document.querySelector('form');
        const username = document.querySelector('#username');
        const password = document.querySelector('#password');
        const comPass = document.querySelector('#comPass');
        
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            if (comPass.value != password.value) {
                comPassError.style.display = 'block';
            }
            else{
              form.submit();
            }
        }
        );
    </script>

  </body>
</html>


