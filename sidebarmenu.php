<!-- 
    Το sidebarmenu.php περιλαμβάνεται (child) στο menu.php το οποίο περιλαμβάνει
    τις κλάσεις (classes.php) και τις συναρτήσεις (functions.php) οι οποίες χρησιμοποιούνται
    στο συγκεκριμένο script
-->
<nav class="navbar">
    <ul class="navbar-nav">
        <?php
            $conn = Connection();
            $qcat = 'SELECT * FROM Menu_Categories';
            $cats = array();
            $dets = array();
            if ($result = $conn->query($qcat)) {
                while ($row = $result->fetch_row()){?>
                    <li class="nav-item"><a href="#<?php echo $row[1]?>" class="nav-link text-warning">
                        <!-- Show Categories -->
                        <?php 
                            echo '<h5 class="pl-3">'.$row[1].'</h5>';?></a></li><?php
                            $qprod = 'SELECT ID,Name,Description,Price_per_Unit FROM Products WHERE Category='.$row[0];
                                if ($result1 = $conn->query($qprod)) {
                                    while ($row1 = $result1->fetch_row()){?>
                                    <!-- Show Products/Category -->
                                        <?php
                                            array_push($dets,new ProductDetails($row[1],$row1[0],$row1[1],$row1[2],$row1[3]));
                                    }
                                }array_push($cats,$row[1]);
                }
            }
            $_SESSION['pr_categories'] = $cats;
            $conn->close();
            ?>
    </ul>
</nav>