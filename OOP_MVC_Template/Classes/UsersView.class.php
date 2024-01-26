<?php

class UsersView extends Users {

    public function showUsers($firstName) {

        $results = $this->getUser($firstName);

        if( ! $results){
            echo "No users found";
        } else {
            foreach($results as $result){
                echo "full name: {$result["users_firstname"]} {$result["users_lastname"]} <br>";
            }
        }    
    }






}