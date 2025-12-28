<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "picture/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            // Include db.php
            include 'db.php';

            try {
                // Create a database connection
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Construct an update prepared statement
                $stmt = $conn->prepare("UPDATE myguestbook SET picture = :picture WHERE id = :id");

                // Bind parameters
                $stmt->bindParam(':picture', $target_file, PDO::PARAM_STR);
                $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

                // Execute the prepared statement
                $stmt->execute();

                // Redirect to list.php
                header("Location: list.php");
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Close connection
            $conn = null;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
