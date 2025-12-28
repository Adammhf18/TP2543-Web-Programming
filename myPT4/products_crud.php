<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

    try {

        $stmt = $conn->prepare("INSERT INTO tbl_products_a194333(fld_product_num,
        fld_product_name, fld_product_price, fld_product_type, fld_product_category,
        fld_product_description, fld_product_stock) VALUES(:pid, :name, :price, :type,
        :category, :description, :stock)");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];

        $stmt->execute();
    }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

//Update
if (isset($_POST['update'])) {

    try {

        $stmt = $conn->prepare("UPDATE tbl_products_a194333 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_type = :type,
        fld_product_category = :category, fld_product_description = :description, fld_product_stock = :stock
        WHERE fld_product_num = :oldpid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type =  $_POST['type'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $oldpid = $_POST['oldpid'];

        $stmt->execute();

        header("Location: products.php");
    }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

//Delete
if (isset($_GET['delete'])) {

    try {

        $stmt = $conn->prepare("DELETE FROM tbl_products_a194333 WHERE fld_product_num = :pid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

        $pid = $_GET['delete'];

        $stmt->execute();

        header("Location: products.php");
    }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

//Edit
if (isset($_GET['edit'])) {

    try {

        $stmt = $conn->prepare("SELECT * FROM tbl_products_a194333 WHERE fld_product_num = :pid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

        $pid = $_GET['edit'];

        $stmt->execute();

        $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

// Image upload handling (for both create and update actions)
if (isset($_POST['create']) || isset($_POST['update'])) {
    // Define allowed image formats and max dimensions
    $allowed_types = ['image/jpeg', 'image/png'];
    $max_width = 300;
    $max_height = 400;

    // Check if the file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_type = $image['type'];
        $image_size = $image['size'];
        $image_tmp_name = $image['tmp_name'];

        // Get image dimensions
        list($width, $height) = getimagesize($image_tmp_name);

        // Validate image type
        if (!in_array($image_type, $allowed_types)) {
            echo "<script>alert('Invalid image format. Only JPG and PNG are allowed.');</script>";
            exit;
        }

        // Validate image dimensions
        if ($width > $max_width || $height > $max_height) {
            echo "<script>alert('Image dimensions exceed the maximum allowed size (300x400).');</script>";
            exit;
        }

        // Validate image size (max 2MB)
        if ($image_size > 2 * 1024 * 1024) {
            echo "<script>alert('Image size exceeds the maximum allowed size of 2MB.');</script>";
            exit;
        }

        // Rename the image file based on product ID
        $image_name = strtolower($_POST['pid']) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
        $target_dir = 'uploads/products/'; // Directory where images are stored
        $target_file = $target_dir . $image_name;

        // Move the uploaded image to the server
        if (move_uploaded_file($image_tmp_name, $target_file)) {
            // Update the product table with the image filename if the upload is successful
            $stmt = $conn->prepare("UPDATE tbl_products_a194333 SET fld_product_image = :image WHERE fld_product_num = :pid");
            $stmt->bindParam(':image', $image_name, PDO::PARAM_STR);
            $stmt->bindParam(':pid', $_POST['pid'], PDO::PARAM_STR);
            $stmt->execute();
        } else {
            echo "<script>alert('Error uploading image.');</script>";
            exit;
        }
    } else {
        // If no image is uploaded, you can proceed without changing the image (for updates)
        if (isset($_POST['update'])) {
            // Proceed with updating the product without changing the image
        }
    }
}

$conn = null;
?>