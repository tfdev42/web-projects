<?php
session_start();

class View {

    public function renderCurrentView($currentView){
        

        switch ($currentView){
                            
            case ("login_form"):
                include_once "./templates/login_form.template.php";
                break;

            case ("signup_form"):
                include_once "./templates/signup_form.template.php";
                break;

            default:
                include_once "./templates/welcome.template.php";
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
        unset($_SESSION["errors"]);
    }
}