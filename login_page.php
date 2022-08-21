<?php
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="login_page.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body style="background-image: url('1ORFF0J0.jpg');background-size:cover;">
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="card my-5" style="width:60%;margin:auto;background-color: #ffffff00;">
                        <div class="card-header text-center bg-warning">
                            <h3>Καλώς Ήρθατε!</h3><p>Εισάγετε τα στοιχεία εισόδου σας</p> 
                        </div>
                        <div class="card-body" style="background-color: #042227f5;color: #e0ffff;">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Όνομα Χρήστη</label>
                                    <input class="form-control" type="text" name="username" placeholder="Εισάγετε το όνομα χρήστη" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Κωδικός</label>
                                    <input class="form-control" type="password" name="password" placeholder="Εισάγετε κωδικό χρήστη" required>
                                </div>                            
                        </div>
                            <div class="card-footer bg-warning">                                
                                <div class="form-group">
                                    <input class="form-control btn btn-success" type="submit" name="submit">
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    <?php
                        if (isset($_POST['submit'])) {
                            include 'functions.php';
                            $conn = Connection();
                                $usr = $_POST['username'];
                                $psw = $_POST['password'];
                                $login_query = "SELECT * FROM Users WHERE Username = '$usr' AND Password = '$psw'";
                                $result = $conn->query($login_query);
                                $row = $result->fetch_row();
                                if ($result->num_rows == 1) {
                                    include 'classes.php';
                                    $admin = new AdminUser($row[0],$row[1],$row[2],$row[3],$row[4]);
                                    $_SESSION['adm_username']= $admin->adm_username; 
                                    $_SESSION['adm_id']= $admin->adm_id; 
                                    $_SESSION['adm_firstname']= $admin->amd_firstname; 
                                    $_SESSION['adm_lastname']= $admin->adm_lastname; 
                                    $_SESSION['adm_email']= $admin->adm_emai; 
                                    $conn->close();
                                    header("Location: welcome.php");
                                }else {
                                    ?>
                                    <div class="alert alert-danger alert-dismissible" style="position: absolute;top:50%;left:36%">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Πρόβλημα εισόδου!</strong>
                                        <p class="mt-2">
                                            <?php echo "Λάθος κωδικός ή όνομα χρήστη."; ?>
                                        </p>
                                    </div> 
                                    <?php
                                }
                            $conn->close();
                        }    
                        if (isset($_POST['logout_submit'])) {
                            session_destroy();              
                        }
                        ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>