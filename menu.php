<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="menus.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/d9cfeb5e5f.js" crossorigin="anonymous"></script>
        <?php include 'functions.php'; include 'classes.php'; ?>
        <title>Resto Restaurant</title>
    </head>
    <body style="background-image: url('1ORFF0J0.jpg');background-size:contain;">
        <?php 
            include 'navbar.html';
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div id="sidebar" style="background-color: #042227f5;">
                        <h3 class="text-dark text-center p-2 bg-warning">Menu</h3>
                        <?php include 'sidebarmenu.php' ?> 
                    </div>          
                </div>
                <div class="col-6 " id="main"  style="background-color: #042227f5;color: #e0ffff;">
                <?php
                        if ($_GET['product_id']) {
                    ?>
                    <div class="alert alert-success alert-dismissible text-center p-5" style="position:absolute;top:5%;left:5%;z-index:1;">
                    <a class="btn btn-danger btn-sm" href="menu.php" style="position: absolute;right:15px;top:15px"><i class="fas fa-times"></i></a>
                        <h4>Η επεξεργασία ολοκληρώθηκε!</h4>
                        <p class="pt-2 mb-0">Η επεξεργασία του προϊόντος με κωδικό : <strong><?php echo $_GET['product_id'] ?></strong>  ολοκληρώθηκε επιτυχώς.</p>
                    </div>
                    <?php }?>
                    <div class="container">
                        <div class="row">
                            <div class="col text-justify">
                                <h1 class="text-center text-warning">Resto Menu
                                    <button data-toggle="collapse" data-target="#edit_menu" style="position: absolute;right:0px;top:12px" class="btn btn-warning">
                                        <i style="font-size: 17pt;" class="fas fa-edit"></i>
                                    </button></h1>
                                    <?php
                                        foreach ($cats as $pr_cat) {
                                            ?>
                                            <h2 style="border-bottom: 2px solid #e0ffff;padding: 10% 0% 1% 0%;" class="text-warning" id="<?php echo $pr_cat;?>"><?php echo $pr_cat;?></h2>
                                            <?php
                                            foreach ($dets as $pr_det) {
                                                if ($pr_det->category == $pr_cat) {
                                                    ?>
                                                    <h4 style="padding: 1% 0%;"><?php echo $pr_det->name?>                                                    
                                                        <span style="position: absolute;right:2.5%"><?php echo $pr_det->price." &euro;" ?></span>
                                                    </h4>
                                                    <p><?php echo $pr_det->description; ?></p>
                                                        <div class="collapse" id="edit_menu">
                                                            <a href="menumanagement.php?pr_id=<?php echo $pr_det->pr_id ?>" style="padding:0% 0% 2%;" class="btn text-info">
                                                                <i style="font-size: 17pt;" class="fas fa-edit"></i> Επεξεργασία
                                                            </a>
                                                        </div>
                                                        <form class="form-inline" action="" method="POST">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input class="form-control" type="hidden" name="name" value="<?php echo $pr_det->name?>">
                                                                    <input class="form-control" type="hidden" name="pr_id" value="<?php echo $pr_det->pr_id?>">
                                                                    <input class="form-control" type="hidden" name="pr_price" value="<?php echo $pr_det->price?>">
                                                                    <input class="form-control" type="number" name="quantity" id="" placeholder="Quantity" min="1" required>
                                                                    <input class="form-control" type="text" name="comment" id="" placeholder="Comments">                                                    
                                                                    <div class="input-control-append">
                                                                        <button class="form-control btn btn-success py-0" type="submit" name="submit">
                                                                            <i class="fas fa-cart-plus"> Προσθήκη </i>
                                                                        </button>
                                                                    </div>
                                                                </div>                                             
                                                            </div>
                                                        </form>
                                                    <?php 
                                                    }
                                                }
                                            }?>                          
                            </div>                
                        </div>    
                    </div>
                </div>
                <div class="col-3">
                    <?php include 'cart.php' ?>
                </div>
            </div>
        </div>
    </body>
</html>

