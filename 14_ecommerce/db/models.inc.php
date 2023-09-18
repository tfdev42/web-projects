<?php

class Brand {
    public int $id;
    public string $name;
    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
}

class User {
    public int $id;
    public string $fname;
    public string $lname;
    public string $email;
    public string $password;
    public bool $is_admin;
}

?>