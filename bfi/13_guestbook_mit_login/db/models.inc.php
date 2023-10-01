<?php
// Abbildung der DB-Tabellen als Klassen in PHP

class User
{
    public int $id;
    public string $email;
    public string $password;
    public string $name;
    public DateTime $birthdate;
    public bool $admin;
    public bool $newsletter;
    public function __construct(int $id, string $email, 
        string $password, string $name, DateTime $birthdate,
        bool $admin, bool $newsletter)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->admin = $admin;
        $this->newsletter = $newsletter;
    }
}

?>