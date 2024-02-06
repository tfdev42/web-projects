<?php

class IndexView {

    /**
     * Renders the Current View after the GET request to display the
     * appropriate template
     */
    public function renderCurrentView(){        

        switch ($_SESSION['current_view']){
                            
            case ("login"):
                include "./templates/login.temp.php";
                break;

            case ("signup"):
                include "./templates/signup.temp.php";
                break;

            case ("products"):
                include "./templates/products.temp.php";
                break;
            
            case ("admin"):
                include "./templates/admin.temp.php";
                break;

            case ("index"):
                include "./templates/index.temp.php";
                break;
            
            case ("cart"):
                include "./templates/cart.temp.php";
                break;

            case ("orders"):
                include "./templates/orders.temp.php";
                break;

            case ("profile"):
                include "./templates/profile.temp.php";
                break;

            case ("analytics"):
                include "./templates/analytics.temp.php";
                break;

            case ("success"):
                include "./templates/success.temp.php";
                break;

            default:
                include "./templates/404.temp.php";
                break;
        }       
    }


    /**
     * loop through the Errors array if set
     * and echo the contents
     */
    public function renderErrors() {

        if(isset($_SESSION["errors"])){
            $errors = $_SESSION["errors"];
            echo '<ul class="error">';
            foreach ($errors as $error){
                echo '<li>';
                echo htmlspecialchars($error);
                echo '</li>';
            }
            echo '</ul>';
        }
        $_SESSION["errors"] = null;
    }
}