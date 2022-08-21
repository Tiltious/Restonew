<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="welcome.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/d9cfeb5e5f.js" crossorigin="anonymous"></script>

    </head>
    <body class=" bg-secondary" style="background-image: url('1ORFF0J0.jpg');background-size:cover;">
    <?php include 'navbar.html'?>
        <div class="container">
            <div class="row edit_product_menu"  style="background-color: #042227f5;color: #e0ffff;">
                <div class="col-12 text-center">
                    <h1 class="text-white">Επεξεργασία Προϊόντος</h1>
                    <?php
                        include "functions.php";
                        $conn = Connection();
                        $pr_id = $_GET['pr_id'];
                        $query = "SELECT * FROM Products WHERE ID = $pr_id";
                        $product = $conn->query($query)->fetch_row();
                    ?>
                    <form action="delete.php" method="POST">
                        <div class="form-group">
                            <label for="product_id">Κωδικός Προϊόντος</label>
                            <input class="form-control" type="text" name="product_id" value="<?php echo $product[0] ;?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Όνομα Προϊόντος</label>
                            <input class="form-control" type="text" name="product_name" value="<?php echo $product[1] ?>">
                        </div>
                        <div class="form-group">
                            <label for="product_categoyr">Κατηγορία Προϊόντος</label>
                            <select class="form-control" name="product_category" id="product_category">
                                <option value="<?php echo $product[3] ?>">
                                    <?php echo $product[3]." - ".$conn->query("SELECT Name FROM Menu_Categories WHERE ID = $product[3]")->fetch_row()[0]; ?>
                                </option>
                                <?php $pr_cats = $conn->query("SELECT ID,Name FROM Menu_Categories WHERE ID <> $product[3]"); 
                                    while ($row = $pr_cats->fetch_row()) {
                                        ?>
                                            <option value="<?php echo $row[0] ?>"><?php echo $row[0]."-".$row[1] ?></option>                
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_price_per_unit">Τιμή Προϊόντος</label>
                            <input class="form-control" type="text" name="product_price_per_unit" value="<?php echo $product[4] ?>">

                        </div>
                        <div class="form-group">
                            <label for="product_description">Περιγραφή Προϊόντος</label>
                            <textarea class="form-control" name="product_description" id=""  rows="4"><?php echo $product[2] ?></textarea>

                        </div>
                        <div class="btn-group mt-2">
                            <input class="btn btn-success" type="submit" name="edit_product_submit" value="Ολολήρωση Επεξεργασίας">
                            <a class="btn btn-primary" href="menu.php">Επιστροφή στο Μενού</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>