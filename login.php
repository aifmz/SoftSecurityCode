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
// Database configuration
$host = 'localhost';
$db_user = 'root'; // Default WAMP MySQL user
$db_password = ''; // Default WAMP MySQL password is blank
$db_name = 'sign_up'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user input
    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        exit;
    }


    
    // Escape and sanitize inputs to prevent XSS
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');



    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            echo "Login successful. Welcome, user ID: " . $row['id'];
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>


<body>
    <div class="center">
        <h1>LOGIN</h1>
        <form method="post" action="">
          <div class="txt_field">
            <input type="text" name="email" required>
            <span></span>
            <label>Email</label>
          </div>
          <div class="txt_field">
            <input type="password" name="password" required>
            <span></span>
            <label>Password</label>
          </div>
          <div class="pass">Forgot Password?</div>
          <input type="submit" name="Login" value="Login">
          <div class="signup_link">
            Not a member? <a href="SignUp.php">Signup</a>
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