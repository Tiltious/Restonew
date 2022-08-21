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
    <body style="background-image: url('1ORFF0J0.jpg');background-size:cover;">
    <?php include 'navbar.html'?>
        <div class="container">
            <div class="row start_menu" style="background-color: #042227f5;color: #e0ffff;">
                <div class="col-12 text-center">
                    <h1 class="text-white">Καλώς Ήρθες <span style="color:orangered;">
                    <?php
                        $adm_firstname = $_SESSION['adm_firstname'];
                        echo $adm_firstname;
                    ?></span>
                    </h1>
                </div>
            </div>
        </div>
    </body>
</html>