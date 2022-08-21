<?php
function Connection(){
    $conn = new mysqli("localhost","root", "**********","Resto");
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else{
        return $conn;
    }

}
function displayCart($conn){
    $query = "SELECT Quantity,Name,Price FROM Cart";
    $result = $conn->query($query);
    if ($result) {            
        while ($row = $result->fetch_row()) {
            ?>
            <form action="delete.php" method="POST">                
                <?php
                foreach ($row as $value) {
                    echo $value." ";
                }echo "&euro;"?>
                <input type="hidden" name="pr_name" value="<?php echo $row[1]?>">
                <button class="btn p-0 text-danger" type="submit" name="cartdelproduct"
                style="position:absolute;right:20px;border-radius:50%;background-color: white;">
                    <i class="fas fa-minus-circle" style="font-size:14pt; vertical-align:middle ;"></i>
                </button>
            </form>
            <?php
        }
    }
}
?>
