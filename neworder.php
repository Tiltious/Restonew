<?php session_start() ?>
<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="menus.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/d9cfeb5e5f.js" crossorigin="anonymous"></script>
        <title>Resto Restaurant</title>
    </head>
    <body style="background-image: url(1ORFF0J0.jpg);background-size:cover;">   
    <?php include 'navbar.html' ?>     
        <div class="container mt-2"style="background-color: #042227f5;">
            <div class="row">
                <div class="col">
                    <div class="card mx-3 my-5"style="background-color: #04222700;">
                        <div class="card-header text-center text-dark bg-warning">
                            <h1>Cart Details</h1>
                        </div>
                        <div class="card-body mx-5"style="color: #e0ffffe5;overflow-y: scroll;height:450px"  >
                            <table class="table table-warning table-striped text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="py-3">Προϊόν</th><th class="py-3">Ποσότητα</th><th class="py-3">Τιμή</th>
                                        <th><button class="btn btn-warning" style="padding: 5px 110px;" data-toggle="collapse" data-target="#edit_cart">Επεξεργασία Καλαθιού</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    include 'functions.php';
                                    $conn = Connection();
                                    $que = "SELECT Name, Quantity,Price,pr_ID FROM Cart";
                                    $res = $conn->query($que);
                                    while ($row = $res->fetch_row()) {
                                        $query = "SELECT Price_per_Unit FROM Products WHERE ID = $row[3]";
                                        $price_per_unit = $conn->query($query)->fetch_row()[0];
                                        ?>
                                        <tr> 
                                            <?php
                                                echo '<td class="py-4">'.$row[0]."</td> ";
                                                echo '<td class="py-4">'.$row[1]."</td> ";  
                                                echo '<td class="py-4">'.$row[2]." &euro;"."</td> ";                                                     
                                            ?>
                                                <td >                                                    
                                                    <div id="edit_cart" class="collapse">
                                                        <form action="delete.php" method="POST" class="form-inline" style="margin-left:15%;;margin-bottom:0px">
                                                            <div class="form-group">
                                                                <input type="hidden" name="pr_name" value="<?php echo $row[0]?>">
                                                                <input class="form-control" type="number" name="quant" min="1" value="<?php echo $row[1]?>"> 
                                                                <input class="form-control" type="hidden" name="price" value="<?php echo $price_per_unit?>">  
                                                                <input class="btn btn-success btn-sm form-control" name="change_quant" type="submit" value="Αλλαγή">
                                                                <input class="btn-danger btn btn-sm form-control" type="submit" name="orderdelproduct" value="Διαγραφή">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>                             
                                            </tr>
                                            <?php }?>
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th colspan="2">Σύνολο</th>
                                        <td><?php echo $conn->query("SELECT SUM(Price) FROM Cart")->fetch_row()[0] ?> &euro;</td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                        <div class="card-footer text-center pb-0 bg-warning">
                            <form action="delete.php" method="POST" class="btn-group">
                                <input class="btn btn-success" name="neworder_submit" type="submit" value="Καταχώρηση Παραγγελίας">
                                <input class="btn btn-danger" name="neworder_delete" type="submit" value="Διαγραφή Καλαθιού">
                                <a class="btn btn-info" href="menu.php">Επιστροφή στο Μενού</a>
                            </form>
                            <?php
                                $placed_order = $_GET['placed_order'] ;
                                if ($placed_order=="ok") {
                                    ?>
                                        <div class="alert alert-success alert-dismissible fixed-top" style="position: absolute;top:25%;left:25%;width:50%;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <h4><i class="fas fa-check"></i> Ολοκλήρωση Καταχώρησης</h4>
                                            <p>Η παραγγελία σας καταχωρήθηκε επιτυχώς.</p>
                                        </div> 
                                    <?php
                                }elseif ($placed_order=="empty"){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fixed-top" style="position: absolute;top:25%;left:25%;width:50%;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <h4><i class="fas fa-exclamation-triangle"></i> Προσοχή!</h4>
                                            <p>Δεν είναι δυνατό να καταχωρηθεί κενή παραγγελία.</p> 
                                        </div> 
                                    <?php
                                }
                            ?>
                        <?php $conn->close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>