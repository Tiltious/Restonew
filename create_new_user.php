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
    <body style="background-image: url('1ORFF0J0.jpg');background-size:cover;">
        <?php
            if (isset($_POST['submit'])) {
                # code...            
                if ($_POST['password']!=$_POST['password_conf']) {
                    ?>
                    <div class="alert alert-danger alert-dismissible text-center p-5" style="position:absolute;top:15%;left:36%;z-index:1;">
                        <button class="btn btn-danger btn-sm"  type="button" class="close" data-dismiss="alert" style="position: absolute;right:15px;top:15px"><i class="fas fa-times"></i></button>
                        <h4>Ασυμφωνία Κωδικών</h4>
                        <p class="pt-2 mb-0">Η επαλήθευση του κωδικού απέτυχε</p>
                    </div>
                    <?php
                }else {
                    # code... 
                    include 'functions.php';
                    $conn = Connection();
                    $username = $_POST['username'];
                    $fname = $_POST['firstname'];
                    $lname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $psw = $_POST['password'];
                    $usr_creation = "INSERT INTO Users (Username,Firstname,Lastname,Email,Password)
                                    VALUES ('$username','$fname','$lname','$email','$psw')";
                    if ($conn->query($usr_creation)===true) {
                        ?>
                            <div class="alert alert-success alert-dismissible text-center p-5" style="position:absolute;top:15%;left:36%;z-index:1;">
                            <a class="btn btn-danger btn-sm" href="menu.php" style="position: absolute;right:15px;top:15px"><i class="fas fa-times"></i></a>
                                <h4>Η επεξεργασία ολοκληρώθηκε!</h4>
                                <p class="pt-2 mb-0">Ο νέος χρήστης δημιουργήθηκε επιτυχώς</p>
                            </div>
                        <?php
                    }else {                        
                        ?>
                        <div class="alert alert-danger alert-dismissible text-center p-5" style="position:absolute;top:15%;left:14.5%;z-index:1;">
                            <button class="btn btn-danger btn-sm"  type="button" class="close" data-dismiss="alert" style="position: absolute;right:15px;top:15px"><i class="fas fa-times"></i></button>
                            <h4>Σφάλμα</h4>
                            <p class="pt-2 mb-0"><?php echo "Error: " . $usr_creation . "<br>" . $conn->error; ?></p>
                        </div>
                        <?php
                    }
                    $conn->close();
                }
            }
        ?>
        <?php include 'navbar.html'?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card" style="width:60%;margin:auto;background-color: #ffffff00;">
                        <div class="card-header text-center bg-warning">
                            <h3>Εγγραφή Νέου Χρήστη</h3><p>Εισάγετε τα στοιχεία εγγραφής</p> 
                        </div>
                        <form action="" method="post">
                            <div class="card-body" style="background-color: #042227f5;color: #e0ffff;">
                                <div class="form-group">
                                    <label for="username">Όνομα Χρήστη</label>
                                    <input class="form-control" type="text" name="username" placeholder="Εισάγετε το όνομα χρήστη" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Όνομα</label>
                                    <input class="form-control" type="text" name="firstname" placeholder="Εισάγετε το όνομα χρήστη" required>
                                </div>
                                <div class="form-group">   
                                    <label for="username">Επώνυμο</label>
                                    <input class="form-control" type="text" name="lastname" placeholder="Εισάγετε το όνομα χρήστη" required>
                                </div>
                                <div class="form-group">    
                                    <label for="username">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="Εισάγετε το όνομα χρήστη" required>
                                </div>
                                <div class="form-group">    
                                    <label for="password">Κωδικός</label>
                                    <input class="form-control" type="password" name="password" placeholder="Εισάγετε κωδικό χρήστη" required>
                                </div>
                                <div class="form-group">    
                                    <label for="password">Επιβεβαίωση Κωδικού</label>
                                    <input class="form-control" type="password" name="password_conf" placeholder="Εισάγετε κωδικό χρήστη" required>
                                </div>                      
                            </div>
                            <div class="card-footer bg-warning">                                
                                <div class="form-group">
                                    <input class="form-control btn btn-success" type="submit" name="submit">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>