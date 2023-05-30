<?php
// Establish database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dbwt';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the registration form is submitted
if (isset($_POST['register'])) {
    $name = $_POST['full-name'];
    $email = $_POST['your-email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm-password'];

    // Check if the email is already registered
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if($password == $confirmpassword){     

    if (mysqli_num_rows($result) > 0) {
        $error = "Email already exists. Please choose a different email.";
    } else {
        // Insert the new user into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
        if (mysqli_query($conn, $query)) {
            $success = "Registration successful. You can now login.";
        } else {
            $error = "Error occurred. Please try again later.";
        }
    }
    }else {
    $error = "Password and Confirm password is not same";

    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="css1/nunito-font1.css">
    <link rel="stylesheet" href="css1/style.css"/>
   
</head>
<body class="form-v6">
    <!-- <h2>Registration</h2> -->
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p><?php echo $success; ?></p>
    <?php endif; ?>
 
       
	<div class="page-content">
		<div class="form-v6-content">
			<div class="form-left">
				<img src="images/form-v6.jpg" alt="form">
			</div>
			<form class="form-detail" action="#" method="post">
				<h2>Register Form</h2>
				<div class="form-row">
					<input type="text" name="full-name" id="full-name" class="input-text" placeholder="Your Name" required>
				</div>
				<div class="form-row">
					<input type="text" name="your-email" id="your-email" class="input-text" placeholder="Email Address" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				<div class="form-row">
					<input type="password" name="password" id="password" class="input-text" placeholder="Password" required>
				</div>
				<div class="form-row">
					<input type="password" name="confirm-password" id="confirm-password" class="input-text" placeholder="Confirm Password" required>
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Register">
                    <a href="login.php">
                         <input type="button" name="Sign_In" class="Sign_In" value="Sign In">
                    </a>
				</div>
			</form>
		</div>
	</div>
</body>
	
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
