<?php
    session_start();
?>
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
    <body style="background-image: url('1ORFF0J0.jpg');background-size:contain;">
    <?php include 'navbar.html'?>
        <div class="container mt-2">
            <div class="row" >
                <div class="col text-center" style="background-color: #042227f5;">
                    <h1 class="text-white mt-3"><p>
                    <?php
                        $adm_username = $_SESSION['adm_username'];
                        $adm_id = $_SESSION['adm_id'];
                        echo $adm_username;
                    ?></p>Παραγγελίες</h1>
                </div>
                <div class="col-12 text-white p-5" style="background-color: #042227f5;">
                    <?php
                        if ($_GET['deleted'] and $x==0) {
                    ?>
                    <div class="alert alert-success alert-dismissible text-center p-5" style="position:absolute;top:0.5%;left:25%;z-index:1;">
                        <a class="btn btn-danger btn-sm" href="orders.php" style="position: absolute;right:15px;top:15px"><i class="fas fa-times"></i></a>
                        <h4>Η διαγραφή ολοκληρώθηκε!</h4>
                        <p class="pt-2 mb-0">Η διαγραφή της παραγγελίας με αριθμό <strong><?php echo $_GET['deleted'] ?></strong>  ολοκληρώθηκε επιτυχώς.</p>
                    </div>
                    <?php }?>
                    <form action="" method="POST" class="">
                        <div class="input-group">
                            <!-- Επιλογή είδους ταξινόμησης των στηλών ID ή Date. Default είναι η φθίνουσα ανά Date-->
                            <div class="input-group-prepend">
                                <label for="orderby" class="input-group-text bg-dark text-white">Ταξινόμηση</label>                                
                            </div>
                            <select name="orderby" id="orderby" class="form-control">
                                <optgroup label="Κατά ημερομηνία καταχώρησης">
                                    <option value="ORDER BY Date DESC">Νεότερη προς Παλιότερη</option>
                                    <option value="ORDER BY Date ASC">Παλιότερη προς Νεότερη</option>
                                </optgroup>
                                <optgroup label="Κατά αριθμό παραγγελίας">
                                    <option value="ORDER BY ID ASC">Άυξουσα</option>
                                    <option value="ORDER BY ID DESC">Φθίνουσα</option>
                                </optgroup>
                            </select>
                            <!-- Επιλογή διαχειριστή για εμφάνιση των παραγγελιών που έχει καταχωρήσει.
                                 Default είναι ο διαχειριστής που έχει συνδεθεί -->
                            <div class="input-group-prepend">
                                <label for="admin" class="input-group-text bg-dark text-white">Διαχειριστές</label>                                
                            </div>
                            <select name="admin" id="admin" class="form-control">
                                <optgroup label="Διαχειριστές">
                                    <option value="WHERE user_ID = <?php echo $adm_id ?>"><?php echo $adm_username ?></option>
                                    <?php
                                        $conn = Connection();
                                        // Υλοποιείται με αυτόν τον τρόπο ώστε ο συνδεμένος διαχειριστής να εμφανίζεται
                                        // σαν πρώτη επιλογή στην dropdown λίστα του select
                                        $query = "SELECT ID, Username FROM Users WHERE ID <> $adm_id";
                                        $users = $conn->query($query);
                                        while ($row = $users->fetch_row()) {
                                            ?>
                                            <option value="WHERE user_ID = <?php echo $row[0] ?>">
                                                <?php echo $row[1] ?>
                                            </option>                                          
                                            <?php
                                        }
                                    ?>      
                                </optgroup>
                                <option value="WHERE TRUE" style="font-weight:bold;">Όλοι οι διαχειριστές</option>  
                            </select>
                            <div class="input-group-prepend">
                                <label for="admin" class="input-group-text bg-dark text-white">Κατάσταση Παραγγελίας</label>                                
                            </div>
                            <select class="form-control" name="order_status" id="order_status">
                                <option value="AND TRUE">Όλες οι Παραγγελίες</option>
                                <option value="AND Status = 'In process'">Σε εξέλιξη</option>
                                <option value="AND Status = 'Completed'">Ολοκληρωμένες</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="form-control btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php
                        if (isset($_POST['orderby'])) {
                            $ordered = $_POST['orderby'];
                        }else {
                            $ordered = "ORDER BY Date DESC";
                        }
                        if (isset($_POST['admin'])) {
                            $userid = $_POST['admin'];
                        }else {
                            $userid = "WHERE User_ID = $adm_id";
                        }

                        if (isset($_POST['order_status'])) {
                            $order_status = $_POST['order_status'];
                        }else {
                            $order_status = "";
                        }
                        $query = "SELECT * FROM Orders $userid $order_status $ordered";
                        $result = $conn -> query($query);
                        if ($result) {
                            $order = array();
                            while ($row = $result->fetch_row()) {
                                $q_userdets = "SELECT Firstname,Lastname FROM Users WHERE ID = $row[1]";
                                $userdets = $conn->query($q_userdets)->fetch_row(); 
                                $current_order = new Order($row[0],$userdets[0],$userdets[1],$row[2],$row[3]); ?>
                                <div class="card text-dark mb-5">
                                    <h5 class="text-center pt-2">Στοιχεία Παραγγελίας<br>
                                        <a style="text-decoration: none;" href="ordermanagement.php?order_id=<?php echo $current_order->order_id?>">
                                            <i class="pt-2 fas fa-edit"></i> Επεξεργασία
                                        </a>
                                        <a class="text-danger ml-4" style="text-decoration: none;" href="delete_order_confirmation.php?order_id=<?php echo $current_order->order_id?>">
                                        <i class="fas fa-minus-circle"></i> Διαγραφή
                                        </a>
                                    </h5>
                                    <div class="card-body" style="background-color: #0b6372;">
                                    
                                    <!-- Πίνακας με τα στοιχεία της παραγγελίας -->
                                        <table class="table table-sm text-center mb-0 table-warning">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Αριθμός Παραγγελίας</th>
                                                    <th>Ωρα/Ημερομηνία Καταχώρησης</th>
                                                    <th>Κατάσταση Παραγγελίας</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td><?php echo $current_order->order_id?></td>
                                                        <td><?php echo $current_order->order_date?></td>
                                                        <td><?php echo $current_order->order_status?></td>
                                                    </tr>
                                            </tbody>
                                        </table>

                                    <!-- Πίνακας με το περιεχόμενο (λεπτομέριες) της παραγγελίας -->
                                        <table class="table table-striped table-sm text-center mb-0 table-warning mt-2">
                                            <thead class="thead-dark" >
                                                <tr><th>Προϊόν</th><th>Ποσότητα</th><th>Τιμή</th></tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $q = "SELECT pr_ID,pr_Qnt FROM Order_Details WHERE orderID = $row[0]" ;
                                                $order_dets = $conn->query($q);
                                                $sum = 0;
                                                while ($row2 = $order_dets->fetch_row()) {?>
                                                <tr class="">
                                                    <?php
                                                        $q = "SELECT Name,Price_per_Unit FROM Products WHERE ID = $row2[0]";
                                                        $pr_dets = $conn->query($q)->fetch_row();
                                                        ?>
                                                        <td><?php echo $pr_dets[0] ?></td>
                                                        <td><?php echo $row2[1]?></td>            
                                                        <td><?php echo $row2[1] * $pr_dets[1]." &euro;"?></td>                                                            
                                                </tr>
                                                <?php $sum += $row2[1] * $pr_dets[1] ; }?>
                                            </tbody>
                                            <tfoot class="thead-dark">
                                                <tr><th colspan="2">Σύνολο</th><td><?php echo $sum ?> &euro;</td></tr>
                                            </tfoot>
                                        </table>                                     
                                    </div> 
                                    <div class="card-footer text-right " style="font-size: 10pt;">
                                        Καταχωρήθηκε από : <?php echo $current_order->order_user_firstname." ".$current_order->order_user_lastname?> 
                                    </div> 
                                </div>
                            <?php                                                                
                            }
                        }$conn->close();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>