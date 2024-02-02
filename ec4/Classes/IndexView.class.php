<?php

class IndexView {

    /**
     * Renders the Current View after the GET request to display the
     * appropiate template
     */
    public function renderCurrentView(){        

        switch ($_SESSION['current_view']){
                            
            case ("login"):
                include_once "./templates/login.temp.php";
                break;

            case ("signup"):
                include_once "./templates/signup.temp.php";
                break;

            case ("products"):
                include_once "./templates/products.temp.php";
                break;
            
            case ("admin"):
                include_once "./templates/admin.temp.php";
                break;

            case ("index"):
                include_once "./templates/index.temp.php";
                break;

            default:
                include_once "./templates/404.temp.php";
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
            foreach ($errors as $error){
                echo '<p class="error">';
                echo htmlspecialchars($error);
                echo '</p><br>';
            }
        }
        $_SESSION["errors"] = null;
    }
}