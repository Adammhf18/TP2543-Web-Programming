<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CryptoSeven : Products</title>
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
                <h2>Create New Product</h2>
            </div>
            <form action="products.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="productid" class="col-sm-3 control-label">ID</label>
                    <div class="col-sm-9">
                        <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productname" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productprice" class="col-sm-3 control-label">Price</label>
                    <div class="col-sm-9">
                        <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" min="0.0" step="0.01" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productcategory" class="col-sm-3 control-label">Brand</label>
                    <div class="col-sm-9">
                        <select name="category" class="form-control" id="productcategory" required>
                            <option value="">Please select</option>
                            <option value="Gaming Keyboard" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Gaming Keyboard") echo "selected"; ?>>Gaming Keyboard</option>
                            <option value="Gaming Headset" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Gaming Headset") echo "selected"; ?>>Gaming Headset</option>
                            <option value="Mouse" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Mouse") echo "selected"; ?>>Mouse</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="producttype" class="col-sm-3 control-label">Type</label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input name="type" type="radio" id="producttype" value="Wired" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Wired") echo "checked"; ?> required> Wired
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="type" type="radio" id="producttype" value="Wireless" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Wireless") echo "checked"; ?>> Wireless
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productdescription" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <input name="description" type="text" class="form-control" id="productdescription" placeholder="Product Description" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_description']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="productstock" class="col-sm-3 control-label">Stock</label>
                    <div class="col-sm-9">
                        <input name="stock" type="text" class="form-control" id="productstock" placeholder="Product Stock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <?php if (isset($_GET['edit'])) { ?>
                            <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
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
                <h2>Products List</h2>
            </div>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th></th>
                </tr>
                <?php
                // Read
                $per_page = 5;
                if (isset($_GET["page"]))
                    $page = $_GET["page"];
                else
                    $page = 1;
                $start_from = ($page-1) * $per_page;
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT * FROM tbl_products_a194333");
                    $stmt = $conn->prepare("select * from tbl_products_a194333 LIMIT $start_from, $per_page");
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
                            <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
                            <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                            <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("SELECT * FROM tbl_products_a194333");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $total_records = count($result);
                        }
                        catch(PDOException $e){
                            echo "Error: " . $e->getMessage();
                        }
                        $total_pages = ceil($total_records / $per_page);
                        ?>
                        <?php if ($page==1) { ?>
                            <li class="disabled"><span aria-hidden="true">«</span></li>
                        <?php } else { ?>
                            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <?php
                        }
                        for ($i=1; $i<=$total_pages; $i++)
                            if ($i == $page)
                                echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
                            else
                                echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
                        ?>
                        <?php if ($page==$total_pages) { ?>
                            <li class="disabled"><span aria-hidden="true">»</span></li>
                        <?php } else { ?>
                            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
                        <?php } ?>
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