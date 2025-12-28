<!DOCTYPE html>
<html>
<head>
    <title>My Bike Ordering System : Customers</title>
</head>
<body>
<center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="customers.php" method="post">
        Customer ID
        <input name="cid" type="text"> <br>
        First Name
        <input name="fname" type="text"> <br>
        Last Name
        <input name="lname" type="text"> <br>
        Phone Number
        <input name="phone" type="text"> <br>
        Email
        <input name="email" type="text"> <br>
        Address
        <input name="address" type="text"> <br>
        <button type="submit" name="create">Create</button>
        <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
        <tr>
            <td>Customer ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Phone Number</td>
            <td>Email</td>
            <td>Address</td>
            <td></td>
        </tr>
        <tr>
            <td>CS01</td>
            <td>Muhammad</td>
            <td>Ali</td>
            <td>017-3456789</td>
            <td>muhd.ali2844@gmail.com</td>
            <td>n0.5, Jalan Lily 5, Taman Lily</td>
            <td>
                <a href="customers.php">Edit</a>
                <a href="customers.php">Delete</a>
            </td>
        </tr>
        <tr>
            <td>CS02</td>
            <td>Siti</td>
            <td>Umairah</td>
            <td>013-7237466</td>
            <td>siti433@gmail.com</td>
            <td>A-11-7, Resedensi Tulip</td>
            <td>
                <a href="customers.php">Edit</a>
                <a href="customers.php">Delete</a>
            </td>
        </tr>
    </table>
</center>
</body>
</html>