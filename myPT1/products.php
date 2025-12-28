<!DOCTYPE html>
<html>
<head>
    <title>My Bike Ordering System : Products</title>
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
        <input name="pid" type="text"> <br>
        Name
        <input name="name" type="text"> <br>
        Price
        <input name="price" type="text"> <br>
        Category
        <select name="Category">
            <option value="Gaming Keyboard">Gaming Keyboard</option>
            <option value="Gaming Headset">Gaming Headset</option>
            <option value="Gaming Mouse">Gaming Mouse</option>
        </select> <br>
        Type
        <input name="cond" type="radio" value="Wired"> Wired
        <input name="cond" type="radio" value="Wireless"> Wireless <br>
        Description
        <input name="description" type="text"> <br>
        Quantity
        <input name="quantity" type="text"> <br>
        <button type="submit" name="create">Create</button>
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
        <tr>
            <td>CR01</td>
            <td>K70 RGB Pro Mechanical Gaming Keyboard iCUE</td>
            <td>989</td>
            <td>Gaming Keyboard</td>
            <td>
                <a href="products_details.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR02</td>
            <td>CORSAIR K57 RGB</td>
            <td>483</td>
            <td>Gaming Keyboard</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR03</td>
            <td>CORSAIR K70 Pro Mini 60% Mechanical Keyboard</td>
            <td>1089</td>
            <td>Gaming Keyboard</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR04</td>
            <td>CORSAIR K70 RGB TKL Tenkeyless</td>
            <td>899</td>
            <td>Gaming Keyboard</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR05</td>
            <td>CORSAIR K65 LUX RGB Compact Mechanical Keyboard</td>
            <td>719</td>
            <td>Gaming Keyboard</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR06</td>
            <td>K70 CORSAIR HS55 Surround 3.5mm Analog</td>
            <td>299</td>
            <td>Gaming Headset</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR07</td>
            <td>CORSAIR HS80 RGB Wireless Dolby Atmos</td>
            <td>899</td>
            <td>Gaming Headset</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR08</td>
            <td>CORSAIR HS65 Surround 3.5mm Analog</td>
            <td>499</td>
            <td>Gaming Headset</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR09</td>
            <td>CORSAIR Virtuoso RGB Wireless</td>
            <td>1315</td>
            <td>Gaming Headset</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CR10</td>
            <td>CORSAIR Harpoon Pro RGB Wired Optical</td>
            <td>129</td>
            <td>Gaming Mouse</td>
            <td>
                <a href="products.php">Details</a>
                <a href="products.php">Edit</a>
                <a href="products.php">Delete</a>
            </td>
        </tr>
    </table>
</center>
</body>
</html>