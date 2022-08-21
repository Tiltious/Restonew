<?php session_start() ?>
<?php
    $quecheck = "SELECT COUNT(ID) FROM Cart";
    if ($conn->query($quecheck)->fetch_row()[0] > 0) {
        $user_id = $_SESSION['adm_id'];                
        $neworder = "INSERT INTO Orders (user_ID,Status) VALUES ($user_id,'In process')";//id auto-increment date_current date
        $resultneworder = $conn->query($neworder);                       //"INSERT INTO Orders VALUES(null,null,'On proccess')"
        $last_id = $conn->insert_id;
        $query = "SELECT pr_ID,Quantity FROM Cart";
        $result = $conn->query($query);
        while ($row = $result->fetch_row()) {
            $query3 = "INSERT INTO Order_Details (orderID,pr_ID,pr_Qnt) VALUES ($last_id,$row[0],$row[1])";
            $result3 = $conn->query($query3);
        }
        $conn->query("DELETE FROM Cart");
        $placed_order = "ok";

    }else {
        $placed_order = "empty";
    }
?>