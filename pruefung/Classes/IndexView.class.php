<?php

class IndexView {

    public function renderCurrentView(){        

        switch ($_SESSION['current_view']){
                            
            case ("login"):
                include_once "./templates/loginform.temp.php";
                break;

            case ("signup"):
                include_once "./templates/signupform.temp.php";
                break;

            case ("products"):
                include_once "./templates/products.temp.php";
                break;
            
            case ("agent_home"):
                include_once "./templates/agent_home.temp.php";
                break;

            case ("signup_user"):
                include_once "./templates/signup_user.temp.php";
                break;

            default:
                include_once "./templates/default.temp.php";
                break;
        }       
    }

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