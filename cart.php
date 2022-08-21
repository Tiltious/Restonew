<div class="card" style="background-color: #042227f5;" id="basket">
    <div class="card-header text-center bg-warning">
        <?php echo $_SESSION['adm_username']; ?>
    </div> 
    <div class="card-body" style="color: #eaffff; ">
        <?php
            $conn = Connection(); //Η συνάρτηση Connection συμπεριλαμβάνεται στον 'πατερα' του καλθιού το Menu.php
            if (isset($_POST['submit'])) {
                
                $x = $_POST['name'];
                $y = $_POST['quantity'];
                $z = $_POST['comment'] ;
                $w = $_POST['pr_id'];
                $pr_price = $_POST['pr_price'];
                $qur = "SELECT Name,Quantity FROM Cart WHERE Name ='$x'";
                $res = $conn->query($qur)->fetch_row();
                $name = $res[0];$qua = $res[1];
                
                if ($res[0]) {
                    $update= "UPDATE Cart SET Quantity = $qua+$y, Price = ($qua+$y)*$pr_price WHERE Name ='$name'";
                    $upd_res = $conn->query($update);
                }else{
                    $query = "INSERT INTO Cart VALUES (null,'$x','$y','$z','$w',$y*$pr_price)";
                    $ins_result = $conn->query($query);
                }   
            }
            displayCart($conn);
            
        ?>
    </div>
    <div class="card-footer pb-0 bg-warning">
        <p>Σύνολο : <?php echo $conn->query("SELECT SUM(Price) FROM Cart")->fetch_row()[0];$conn ->close(); ?> &euro;</p>
        <div class="text-center">
            <form action="delete.php" method="post" class="btn-group">   
                <a class="btn btn-success btn-sm" role="button" href="neworder.php">Ολοκλήρωση</a>
                <input class="btn btn-danger btn-sm mr-2" type="submit" name="cartdelete" value="Διαγραφή Καλαθιού">
            </form>
        </div>
    </div>
</div>