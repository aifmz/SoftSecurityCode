<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Suggestions Website</title>
    <link rel="stylesheet" href="./css/login.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/> <!--Swiper JS-->


</head>



<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default WAMP username
$password = "";     // Default WAMP password
$dbname = "sign_up";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate if passwords match
    if ($password !== $cpassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Check if email already exists using a prepared statement
        $checkEmailQuery = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmailQuery->bind_param("s", $email);
        $checkEmailQuery->execute();
        $checkEmailQuery->store_result();

        if ($checkEmailQuery->num_rows > 0) {
            echo "<script>alert('Email already registered!');</script>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert into database using a prepared statement
            $insertQuery = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insertQuery->bind_param("sss", $name, $email, $hashed_password);

            if ($insertQuery->execute()) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "Error: " . $insertQuery->error;
            }

            $insertQuery->close();
        }

        $checkEmailQuery->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/login.css"/>
</head>
<body>
    <div class="center">
        <h1>REGISTER</h1>
        <form method="post">
          <div class="txt_field">
            <input type="text" name="Name" minlength="3" required>
            <span></span>
            <label>Name</label>
          </div>
          <div class="txt_field">
            <input type="email" name="email" required>
            <span></span>
            <label>Email</label>
          </div>
          <div class="txt_field">
            <input type="password" name="password" minlength="5" required>
            <span></span>
            <label>Password</label>
          </div>
          <div class="txt_field">
            <input type="password" name="cpassword" minlength="5" required>
            <span></span>
            <label>Confirm Password</label>
          </div>
          <input type="submit" name="submit" value="Register">
          <div class="signup_link">
            Already a member? <a href="login.php">Login</a>
          </div>
        </form>
    </div>
</body>
</html>



<body>
    <div class="center">
        <h1>REGISTER</h1>
        <form method="post">
          <div class="txt_field">
            <input type="text" name = "Name" minlength = "3" required>
            <span></span>
            <label>Name</label>
          </div>
          <div class="txt_field">
            <input type="text" name ="email" required>
            <span></span>
            <label>Email</label>
          </div>
          <div class="txt_field">
            <input type="password" name = "password" minlength = "5" required>
            <span></span>
            <label>Password</label>
          </div>
          <div class="txt_field">
            <input type="password" name = "cpassword" minlength = "5" required>
            <span></span>
            <label>Confirm Password</label>
          </div>
          <div class="pass">Forgot Password?</div>
          <input type="submit" name ="submit" value="Register">
          <div class="signup_link">
            Already a member? <a href="login.php">Login</a>
          </div>
        </form>
      </div>



    <script src="./main.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints:{
            600: {
                slidesPerView: 2            }
        }
      });
    </script>




</body>
</html>