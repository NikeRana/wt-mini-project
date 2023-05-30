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

// Check if the login form is submitted
if (isset($_POST['Sign_In'])) {
    $email = $_POST['your_email_1'];
    $password = $_POST['password_1'];

    // Query the database for the user


    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
  echo "$row";
    if ($row) {
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, create session and redirect to dashboard
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.html");
            exit;
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/sourcesanspro-font.css">
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="form-v8">

    <!-- <h2>Login</h2> -->
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
<div class="page-content">
		<div class="form-v8-content">
			<div class="form-left">
				<img src="images/form-v8.jpg" alt="form">
			</div>
			<div class="form-right">
				<div class="tab">
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-in')">Sign In</button>
					</div>
				</div>
				<form class="form-detail" action="#" method="post">
					<div class="tabcontent" id="sign-in">
						<div class="form-row">
							<label class="form-row-inner">
								<input type="text" name="your_email_1" id="your_email_1" class="input-text" required>
								<span class="label">E-Mail</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input type="password" name="password_1" id="password_1" class="input-text" required>
								<span class="label">Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div class="form-row-last">
							<input type="submit" name="Sign_In" class="Sign_In" value="Sign In">
                            <a href="registration.php">
                                <input type="button" name="Sign_Up" class="Sign_Up" value="Sign Up">
                            </a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
