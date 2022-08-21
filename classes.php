<?php
    class AdminUser {
        public $adm_id;
        public $adm_username;
        public $amd_firstname;
        public $adm_lastname;
        public $adm_emai;
        function __construct($adm_id,$adm_username,$amd_firstname,$adm_lastname,$adm_emai){
            $this->adm_id = $adm_id;
            $this->adm_username = $adm_username;
            $this->amd_firstname = $amd_firstname;
            $this->adm_lastname = $adm_lastname;
            $this->adm_emai = $adm_emai;
        }
    }
    class Order {
        public $order_id;
        public $order_user_firstname;
        public $order_user_lastname;
        public $order_date;
        public $order_status;
        function __construct($order_id,$order_user_firstname,$order_user_lastname,$order_date,$order_status){
            $this->order_id = $order_id;
            $this->order_user_firstname = $order_user_firstname;
            $this->order_user_lastname = $order_user_lastname;
            $this->order_date = $order_date;
            $this->order_status = $order_status;
        }
    }    
    class ProductDetails{
        public $category;
        public $pr_id;
        public $name;
        public $description;
        public $price;
        function __construct($category,$pr_id,$name,$description,$price){
            $this->category = $category;
            $this->pr_id=$pr_id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
        }
    }    
    class ProductOrder{
        public $quantity;
        public $name;
        public $comment;
        function __construct($quantity,$name,$comment){
            $this->quantity = $quantity;
            $this->name = $name;
            $this->comment = $comment;
        }
    }
?>