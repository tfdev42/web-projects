<?php

class Controller {

    public function getCurrentView() {

        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            
            if (isset($_POST["bt_show_login"])){
                return "login_form";
            }

            if (isset($_POST["bt_show_signup"])){
                return "signup_form";
            }

            if (isset($_POST["bt_show_products"])){
                return "products_list";
            }

            if (isset($_POST["bt_show_products_details"])){
                return "products_details";
            }

            if (isset($_POST["bt_show_orders"])){
                return "orders";
            }

            if (isset($_POST["bt_show_admin"])){
                return "admin";
            }
        }
        
    }
}