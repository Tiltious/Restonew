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
        <div class="container py-2 mt-5 delete_container" style="background-color: #042227f5;color: #e0ffff;">
            <div class="row start_menu" style="background-color: #ff000077">
                <div class="col-12 text-center">
                    <h1 class="text-white">Διαγραφή Παραγγελίας με αριθμό : <span style="color:#042227;">
                    <?php
                        $order_id = $_GET['order_id'];
                        echo $order_id;
                    ?></span>
                    </h1>
                    <p>Έχετε επιλέξει διαγραφή της παραγγελίας. Αυτή η ενέργεια είναι μη αναστρέψιμη. Επιθυμείτε να συνεχίσετε;</p>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="delete_order_id" value="<?php echo $order_id ?>">
                        <button type="submit" name="delete_order_confirmation" class="mr-2 btn btn-danger"><i class="fas fa-minus-circle"></i> Επιβεβαίωση</button>
                        <a class="ml-2 btn btn-primary" href="orders.php"><i class="fas fa-arrow-circle-left"></i> Πίσω στις Παραγγελίες</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>