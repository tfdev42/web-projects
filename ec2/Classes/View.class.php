<?php

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
        if ( ! empty($_SESSION["errors"])){
            $errors = $_SESSION["errors"];
            foreach ($errors as $error){
                echo '<div class="error">';
                echo "$error";
                echo '</div><br>';
            }
        }
    }
}