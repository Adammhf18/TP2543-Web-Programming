<?php
include_once 'orders_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CryptoSeven : Orders</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php include_once 'nav_bar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="page-header">
                <h2>Create New Order</h2>
            </div>
            <form action="orders.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="orderid" class="col-sm-3 control-label">ID</label>
                    <div class="col-sm-9">
                        <input name="oid" type="text" class="form-control" id="orderid" placeholder="Order ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="orderdate" class="col-sm-3 control-label">Order Date</label>
                    <div class="col-sm-9">
                        <input name="orderdate" type="text" class="form-control" id="orderdate" placeholder="Order Date" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sid" class="col-sm-3 control-label">Staff</label>
                    <div class="col-sm-9">
                        <select name="sid" class="form-control" id="sid" required>
                            <?php
                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a194333");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                            }
                            catch(PDOException $e){
                                echo "Error: " . $e->getMessage();
                            }
                            foreach($result as $staffrow) {
                                ?>
                                <option value="<?php echo $staffrow['fld_staff_num']; ?>" <?php if(isset($_GET['edit']) && $editrow['fld_staff_num']==$staffrow['fld_staff_num']) echo 'selected'; ?>>
                                    <?php echo $staffrow['fld_staff_fname']." ".$staffrow['fld_staff_lname'];?>
                                </option>
                                <?php
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer" class="col-sm-3 control-label">Customer</label>
                    <div class="col-sm-9">
                        <select name="cid" class="form-control" id="customer" required>
                            <?php
                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->prepare("SELECT * FROM tbl_customers_a194333");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                            }
                            catch(PDOException $e){
                                echo "Error: " . $e->getMessage();
                            }
                            foreach($result as $custrow) {
                                ?>
                                <option value="<?php echo $custrow['fld_customer_num']; ?>" <?php if(isset($_GET['edit']) && $editrow['fld_customer_num']==$custrow['fld_customer_num']) echo 'selected'; ?>>
                                    <?php echo $custrow['fld_customer_fname']." ".$custrow['fld_customer_lname'];?>
                                </option>
                                <?php
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <?php if (isset($_GET['edit'])) { ?>
                            <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_order_num']; ?>">
                            <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                        <?php } else { ?>
                            <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
                        <?php } ?>
                        <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="page-header">
                <h2>Order List</h2>
            </div>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Staff</th>
                    <th>Customer</th>
                    <th></th>
                </tr>
                <?php
                // Pagination setup
                $per_page = 5;
                if (isset($_GET["page"]))
                    $page = $_GET["page"];
                else
                    $page = 1;
                $start_from = ($page - 1) * $per_page;

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT o.fld_order_num, o.fld_order_date, s.fld_staff_fname, s.fld_staff_lname, c.fld_customer_fname, c.fld_customer_lname
                            FROM tbl_orders_a194333 o
                            JOIN tbl_staffs_a194333 s ON o.fld_staff_num = s.fld_staff_num
                            JOIN tbl_customers_a194333 c ON o.fld_customer_num = c.fld_customer_num
                            LIMIT $start_from, $per_page";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                }
                catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
                }

                foreach($result as $readrow) {
                    ?>
                    <tr>
                        <td><?php echo $readrow['fld_order_num']; ?></td>
                        <td><?php echo $readrow['fld_order_date']; ?></td>
                        <td><?php echo $readrow['fld_staff_fname']." ".$readrow['fld_staff_lname']; ?></td>
                        <td><?php echo $readrow['fld_customer_fname']." ".$readrow['fld_customer_lname']; ?></td>
                        <td>
                            <a href="orders_details.php?oid=<?php echo $readrow['fld_order_num']; ?>" class="btn btn-warning btn-xs">Details</a>
                            <a href="orders.php?edit=<?php echo $readrow['fld_order_num']; ?>" class="btn btn-success btn-xs">Edit</a>
                            <a href="orders.php?delete=<?php echo $readrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <nav>
                    <ul class="pagination">
                        <?php
                        // Calculate total records and pages
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT COUNT(*) FROM tbl_orders_a194333";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $total_records = $stmt->fetchColumn();
                        }
                        catch(PDOException $e){
                            echo "Error: " . $e->getMessage();
                        }

                        $total_pages = ceil($total_records / $per_page);

                        // Pagination buttons
                        if ($page == 1) {
                            echo '<li class="disabled"><span aria-hidden="true">«</span></li>';
                        } else {
                            echo '<li><a href="orders.php?page='.($page - 1).'" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo ($i == $page)
                                ? "<li class=\"active\"><a href=\"orders.php?page=$i\">$i</a></li>"
                                : "<li><a href=\"orders.php?page=$i\">$i</a></li>";
                        }

                        if ($page == $total_pages) {
                            echo '<li class="disabled"><span aria-hidden="true">»</span></li>';
                        } else {
                            echo '<li><a href="orders.php?page='.($page + 1).'" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
