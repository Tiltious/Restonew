<?php session_start()?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="welcom.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/d9cfeb5e5f.js" crossorigin="anonymous"></script>
        <?php include 'classes.php'; include 'functions.php';?>
    </head>
    <body style="background-image: url('1ORFF0J0.jpg');background-size:cover;">
        <?php include 'navbar.html'; ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col" style="background-color: #042227f5;">
                    <h1 class="text-center text-white mt-4">Επεξεργασία Παραγγελίας</h1>
                    <?php
                    $conn = Connection();
                    $order_id =  $_GET['order_id'];?>
                    <div class="card text-dark mb-5">
                        <h5 class="text-center pt-2">Στοιχεία Παραγγελίας<br></h5>
                        <div class="card-body" style="background-color: #0b6372;overflow-y: scroll;height:450px">
                            <table class="table table-sm text-center mb-0 table-warning">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Αριθμός Παραγγελίας</th>
                                        <th>Ωρα/Ημερομηνία Καταχώρησης</th>
                                        <th>Κατάσταση Παραγγελίας</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr><?php
                                                $query = "SELECT * FROM Orders WHERE ID=$order_id";
                                                $result_orders = $conn->query($query)->fetch_row();
                                            ?>
                                            <td class="py-2"><?php echo $result_orders[0]?></td>
                                            <td class="py-2"><?php echo $result_orders[2]?></td>
                                            <td class="py-2"><?php echo $result_orders[3]?></td>
                                            <td><form action="delete.php" style="display: inline;" method="POST">
                                                    <input type="hidden" name="order_id" value="<?php echo $order_id?>">
                                                    <input type="hidden" name="order_status" value="<?php echo $result_orders[3]?>">
                                                    <button type="submit" name="change_status" class="btn btn-info py-0">
                                                        <i class="fas fa-edit"></i> Αλλαγή Κατάστασης
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped text-center mb-0 table-warning mt-2">
                                <thead class="thead-dark" >
                                    <tr>
                                        <th class="py-3">ID</th><th class="py-3">Προϊόν</th><th class="py-3">Ποσότητα</th><th class="py-3">Τιμή</th>
                                        <th class="">
                                            <button class="btn btn-light py-0" data-toggle="collapse" style="margin: 0px 74px;" data-target="#edit_order">
                                                <i class="fas fa-edit"></i> Επεξεργασία Παραγγελίας
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <button data-toggle="collapse" data-target="#add_product" class="btn btn-success mt-2"style="width:100%">
                                    <i class="fas fa-plus-circle"></i> Προσθήκη Νέου Προϊόντος</button>
                                    <div class="collapse" id="add_product">
                                        <form action="delete.php" method="POST" class="">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label for="new_prod_id" class="input-group-text bg-dark text-white">Προϊόν</label>                                
                                                </div>
                                                <select name="new_prod_id" id="new_prod_id" class="form-control">
                                                <?php 
                                                    $query = "SELECT * FROM Menu_Categories";
                                                    $categories = $conn->query($query);

                                                    while ($cat = $categories->fetch_row()) { ?>
                                                    <optgroup label="<?php echo $cat[1] ?>">
                                                        <?php
                                                            $query = "SELECT * FROM Products WHERE Category = $cat[0]";
                                                            $product = $conn->query($query);
                                                            while ($prod = $product->fetch_row()) {                                                
                                                        ?>
                                                        <option value="<?php echo $prod[0] ?>"><?php echo $prod[1] ?></option>
                                                    <?php }?>
                                                    </optgroup>
                                                    <?php }?>
                                                </select>
                                                <div class="input-group-prepend">
                                                    <label for="orderby" class="input-group-text bg-dark text-white">Ποσότητα</label>                                
                                                </div>
                                                <input class="form-control" type="number" name="new_entry_quant" min="1" value="" required>
                                                <input type="hidden" name="edit_order_id" value="<?php echo $order_id?>">
                                                <div class="input-group-append">
                                                    <button type="submit" name="add_new_prod" class="form-control btn btn-success">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    $query = "SELECT * FROM Order_Details WHERE orderID = $order_id";
                                    $result_orders_details = $conn->query($query);
                                    //Μεταβλητή για το συνολικό κόστος της παραγγελίας
                                    $sum = 0;
                                    while ($row = $result_orders_details->fetch_row()) {?>
                                    <tr><?php
                                            $q = "SELECT Name,Price_per_Unit FROM Products WHERE ID = $row[2]";
                                            $pr_name = $conn->query($q)->fetch_row();
                                            ?>
                                            <td class="py-3"><?php echo $row[2]?></td>
                                            <td class="py-3"><?php echo $pr_name[0]?></td>  
                                            <td class="py-3"><?php echo $row[3]?></td>           
                                            <td class="py-3"><?php echo $row[3] * $pr_name[1]." &euro;"?></td>
                                            <td class="p-0">                                                    
                                                <div id="edit_order" class="collapse">
                                                    <form action="delete.php" method="POST" class="form-inline" style="margin-left:15%;margin-bottom:0px;margin-top:7px">
                                                        <div class="form-group">
                                                            <input type="hidden" name="order_id" value="<?php echo $order_id?>">
                                                            <input type="hidden" name="entry_id" value="<?php echo $row[0]?>">
                                                            <input class="form-control" type="number" name="entry_quant" min="1" value="<?php echo $row[3]?>">  
                                                            <input class="btn btn-success btn-sm form-control" name="change_entry_quant" type="submit" value="Αλλαγή">
                                                            <input class="btn-danger btn btn-sm form-control" type="submit" name="delete_entry" value="Διαγραφή">
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>                                                           
                                    </tr>
                                    <?php $sum += $row[3] * $pr_name[1]; //προσθέτει το κόστος κάθε εγγραφής στην παραγγελία
                                }?>                                    
                                </tbody> 
                                <tfoot class="thead-dark">
                                    <tr><th class="py-3" colspan="3">Σύνολο</th><td class="py-3"><?php echo $sum; ?> &euro;</td>
                                    </tr>
                                </tfoot>
                            </table>                                    
                        </div> 
                        <div class="card-footer text-right" style="font-size: 10pt;">
                            Καταχωρήθηκε από : 
                            <?php 
                                $emp_name = $conn->query("SELECT Firstname,Lastname FROM Users WHERE ID = $result_orders[1]")->fetch_row();
                                echo $emp_name[0]." ".$emp_name[1];
                            ?> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>        
        <?php $conn->close();?>                                
    </body>
</html>