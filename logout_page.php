<?php
    session_start();
?>
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
            <div class="row start_menu"  style="background-color: #042227f5;color: #e0ffff;">
                <div class="col-12 text-center">
                    <h1 class="text-white">Αποσύνδεση</h1><p>Έχετε επελέξει αποσύνδεση. Θέλετε να προχωρήσετε σε αυτή την ενέργεια;</p>
                    <form action="login_page.php" method="POST">
                        <a class="btn text-light" href="menu.php" style="font-size: 1rem;font-weight: bold;color:#1db9d4f5;background-color:#1db9d4f5 ;">
                            <i class="fas fa-arrow-circle-left"></i> Επιστροφή
                        </a>
                        <input class="btn btn-light" type="submit" name="logout_submit" value="Αποσύνδεση" style="font-size: 1rem;font-weight:bold;color:#1db9d4f5;">
                    </form> 
                </div>  
            </div>
        </div>
    </body>
</html>