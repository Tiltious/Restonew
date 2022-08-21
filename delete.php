<?php
    include 'functions.php';
    $conn = Connection();
    if (isset($_POST['cartdelproduct'])) {
        $pr_name = $_POST['pr_name'];
        $delpr_query = "DELETE FROM Cart WHERE Name = '$pr_name'";
        $conn->query($delpr_query);
        header('Location: menu.php');
    }
    if (isset($_POST['orderdelproduct'])) {
        $pr_name = $_POST['pr_name'];
        $delpr_query = "DELETE FROM Cart WHERE Name = '$pr_name'";
        $conn->query($delpr_query);
        header('Location: neworder.php');                    
    }
    if (isset($_POST['cartdelete'])) {
        $delcart_query = "DELETE FROM Cart";
        $conn->query($delcart_query);
        header('Location: menu.php');
    }
    if (isset($_POST['change_quant'])) {
        $quantity = $_POST['quant'];
        $pr_name = $_POST['pr_name']; 
        $price = $_POST['price'];        
        $query = "UPDATE Cart SET Quantity = $quantity,Price = $quantity*$price WHERE Name = '$pr_name'";
        $conn->query($query);
        header('Location: neworder.php');  
    }
    if (isset($_POST['change_entry_quant'])) {
        $quantity = $_POST['entry_quant'];
        $order_id = $_POST['order_id'];
        $entry_id = $_POST['entry_id'];        
        $query = "UPDATE Order_Details SET pr_Qnt = $quantity WHERE ID = $entry_id";
        $conn->query($query);
        header("Location: ordermanagement.php?order_id=$order_id");  
    }
    if (isset($_POST['delete_entry'])) {
        $order_id = $_POST['order_id'];
        $entry_id = $_POST['entry_id'];   
        $delpr_query = "DELETE FROM Order_Details WHERE ID = $entry_id";
        $conn->query($delpr_query);
        header("Location: ordermanagement.php?order_id=$order_id");
    }
    if (isset($_POST['add_new_prod'])) {
        $order_id = $_POST['edit_order_id'];
        $quantity = $_POST['new_entry_quant'];
        $pr_id = $_POST['new_prod_id'];
        $q= "SELECT pr_Qnt FROM Order_Details WHERE orderID = $order_id AND pr_ID = $pr_id";
        if ($res = $conn->query($q)->fetch_row()) {
            $update= "UPDATE Order_Details SET pr_Qnt = $quantity + $res[0] WHERE orderID = $order_id AND pr_ID = $pr_id";
            $upd_res = $conn->query($update);

        }else {
            $query = "INSERT INTO Order_Details VALUES (null,$order_id,$pr_id,$quantity)";
            $conn->query($query);
        }
        header("Location: ordermanagement.php?order_id=$order_id");
    }
    if (isset($_POST['change_status'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];
        if ($order_status === "In process") {
            $query = "UPDATE Orders SET Status = 'Completed' WHERE ID = $order_id";
        }else {
            $query = "UPDATE Orders SET Status = 'In process' WHERE ID = $order_id";
        }
        $conn->query($query);
        header("Location: ordermanagement.php?order_id=$order_id");
        
    } 
    if (isset($_POST['neworder_submit'])) {
        include 'placeorder.php';
        header("Location: neworder.php?placed_order=$placed_order");
    }
    if (isset($_POST['neworder_delete'])){
        $conn->query("DELETE FROM Cart");
        header("Location: neworder.php");
    }
    if (isset($_POST['delete_order_confirmation'])) {
        $delete_order_id = $_POST['delete_order_id'];
        $query = "DELETE FROM Order_Details WHERE orderID = $delete_order_id;DELETE FROM Orders WHERE ID = $delete_order_id";
        $conn->query("DELETE FROM Order_Details WHERE orderID = $delete_order_id");
        $conn->query("DELETE FROM Orders WHERE ID = $delete_order_id");
        $conn->close();
        header("Location: orders.php?deleted=$delete_order_id");
    } 
    if (isset($_POST['edit_product_submit'])) {
        $id = $_POST['product_id'];
        $name = $_POST['product_name']; 
        $description = $_POST['product_description'];
        $category = $_POST['product_category'];
        $price_per_unit = $_POST['product_price_per_unit'];
        $query1 = "UPDATE Products 
                    SET Name='$name', Description='$description', Category=$category, Price_per_Unit=$price_per_unit
                    WHERE ID=$id";
        $conn->query($query1);
        $conn->close();
        header("Location: menu.php?product_id=$id");
    }
    
?>