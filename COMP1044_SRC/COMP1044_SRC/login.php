<?php
  session_start();
    require "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $uname = $_POST["uname"];
        $pw = $_POST["pw"];

        $sql = "SELECT * FROM signup_form WHERE BINARY Username = '$uname' AND BINARY Pass_word = '$pw'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $sql = "UPDATE signup_form SET last_login_time = NOW() WHERE Username = '$uname'";
            $conn->query($sql); 
            $_SESSION["username"] = $uname;
            $_SESSION["password"] = $pw;
            header("Location: home.php");
            exit();
        }
        else{ 
            echo "<script>alert('Invalid login credentials')</script>";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

  <body>
      <div class="center">
        <h1>Login</h1>
        <form action="login.php" method="post">
          <div class="txt_field">
            <input type="text" id="username" name="uname" autocomplete="off" required>
            <span></span>
            <label for="uname">Username</label>
          </div>
          <div class="txt_field">
            <input type="password" id="password" name="pw" autocomplete="off" required>
            <i class="fa fa-eye" id="togglePassword"></i>
            <span></span>
            <label for="pw">Password</label>
          </div>
          <div class="checkbox">
              <input type="checkbox" id="remember-me" name="remember-me">
              <label for="remember-me">Remember me</label>
          </div>
          <div class="pass">Forgot Password?</div>
          <input type="submit" value="Login">
          <div class="signup_link">
            Don't have an account ? <a href="signUp.php">Register</a>
          </div>
        </form>
      </div>
      <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        if (password.type === 'password') {
            password.type = 'text';
            togglePassword.classList.toggle('fa-eye-slash');
        } else {
            password.type = 'password';
            togglePassword.classList.toggle('fa-eye-slash');
        }
    });
</script>

  </body>
</html>


