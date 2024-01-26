<?php

class UsersContr extends Users {

    public function createUser($firstName, $lastName, $DoB) {

        return $this->setUser($firstName, $lastName, $DoB);
        // and other properties
        
    }

}