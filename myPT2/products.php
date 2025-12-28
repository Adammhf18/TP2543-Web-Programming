<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gaming Peripheral Shop : Products</title>
</head>
<body>
<center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="post">
        Product ID
        <input name="pid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>"> <br>
        Name
        <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>"> <br>
        Price
        <input name="price" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>"> <br>
        Category
        <select name="category">
            <option value="Gaming Keyboard" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Gaming Keyboard") echo "selected"; ?>>Gaming Keyboard</option>
            <option value="Gaming Headset" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Gaming Headset") echo "selected"; ?>>Gaming Headset</option>
            <option value="Mouse" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Mouse") echo "selected"; ?>>Mouse</option>
        </select> <br>
        Type
        <input name="type" type="radio" value="Wired" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Wired") echo "checked"; ?>> Wired
        <input name="type" type="radio" value="Wireless" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Wireless") echo "checked"; ?>> Wireless <br>
        Description
        <input name="description" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_description']; ?>"> <br>
        Stock
        <input name="stock" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>"> <br>
        <?php if (isset($_GET['edit'])) { ?>
            <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
            <button type="submit" name="update">Update</button>
        <?php } else { ?>
            <button type="submit" name="create">Create</button>
        <?php } ?>
        <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
        <tr>
            <td>Product ID</td>
            <td>Name</td>
            <td>Price</td>
            <td>Category</td>
            <td></td>
        </tr>
        <?php
        // Read
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a194333");
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        foreach($result as $readrow) {
            ?>
            <tr>
                <td><?php echo $readrow['fld_product_num']; ?></td>
                <td><?php echo $readrow['fld_product_name']; ?></td>
                <td><?php echo $readrow['fld_product_price']; ?></td>
                <td><?php echo $readrow['fld_product_category']; ?></td>
                <td>
                    <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>">Details</a>
                    <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>">Edit</a>
                    <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
                </td>
            </tr>
            <?php
        }
        $conn = null;
        ?>

    </table>
</center>
</body>
</html>