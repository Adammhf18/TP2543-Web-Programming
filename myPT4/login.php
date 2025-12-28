<?php
session_start();
include_once 'database.php';

// Check if form has been submitted and the variables are set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffid = $_POST['sid'];
    $pass = $_POST['pass'];

    // Connect to the database
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare a statement to check if the user exists
        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a194333 WHERE fld_staff_num = :sid");
        $stmt->bindParam(':sid', $staffid, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and verify the password
        if ($user && $pass == $user['fld_staff_password']) {
            // Set session variables upon successful login
            $_SESSION['sid'] = $user['fld_staff_num'];  // Store the staff number
            $_SESSION['role'] = $user['user_level'];    // Store the user level (role)

            // Redirect to the dashboard or another page
            header("Location: index.php");  // Modify this to your desired location
            exit;
        } else {
            $error = "Invalid username or password.";
        }

    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            margin-top: 100px;
        }
        .login-box {
            border: 1px solid #ddd;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 login-box">
            <h2 class="text-center">Login</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Staff ID</label>
                    <input type="text" class="form-control" name="sid" id="sid" placeholder="Enter your Staff ID" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
