<?php

class View {

    public static function renderErrors() {
        if(isset($_SESSION["errors"])){
            $errors = $_SESSION["errors"];
            foreach ($errors as $error){
                echo '<p class=error>';
                echo  $error;
                echo '</p><br>';
            }
        }
        $_SESSION["errors"]=null;
    }

    public static function renderMessages() {
        if(isset($_SESSION["messages"])){
            $messages = $_SESSION["messages"];
            foreach ($messages as $message){
                echo '<p class=message>';
                echo  $message;
                echo '</p><br>';
            }
        }
        $_SESSION["messages"]=null;
    }

    public static function renderSuccess() {
        return "Action Successfull!";
    }

    public static function renderFail() {
        return "Action Failed!";
    }



}