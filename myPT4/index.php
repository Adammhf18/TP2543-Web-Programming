<?php
session_start(); // Start the session to access session variables
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gaming Peripheral Shop : Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        html {
            width:100%;
            height:100%;
            background:url(logo.png) center center no-repeat;
            min-height:100%;
        }
    </style>
</head>
<body>

<?php include_once 'nav_bar.php'; ?>

<div class="container">
    <h1>Welcome to the Gaming Peripheral Shop</h1>
    <p>Your one-stop shop for the best gaming peripherals.</p>

    <?php if (isset($_SESSION['sid'])): ?>
        <p>Hello, Staff ID: <?php echo htmlspecialchars($_SESSION['sid']); ?>. Your role is: <?php echo htmlspecialchars($_SESSION['role']); ?>.</p>
    <?php else: ?>
        
    <?php endif; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
