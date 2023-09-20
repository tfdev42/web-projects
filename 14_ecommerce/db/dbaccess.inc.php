<?php
require_once 'models.inc.php';
class DbAccess
{ 
    private PDO $conn;

    public function createBrand(string $name) : int {
        $ps = $this->conn->prepare('
        INSERT INTO brand 
        (name)
        VALUES 
        (:name);
        ');
        $ps->bindValue('name', $name);
        $ps->execute();
        return $this->conn->lastInsertId();
    }


    public function getBrandByName(string $name) : Brand|false 
    {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM brand 
            WHERE name = :name 
        ');
        $ps->bindValue('name', $name);
        $ps->execute();
        // $row ist ein Datensatz
        while($row = $ps->fetch()){
            $id = $row['id'];
            $name = $row['name'];
            $brand = new Brand($id, $name);
            return $brand;
        }
        return false;
    }


    public function getBrands() : array {
        $ps = $this->conn->prepare('
        SELECT * 
        FROM brand 
        ');
        $ps->execute();
        $brands = [];
        while($row = $ps->fetch()){
            $id = $row['id'];
            $name = $row['name'];
            $brand = new Brand($id, $name);
            $brands[] = $brand;
        }
        return $brands;
    }


    public function getBrandById(int $id) : Brand|false {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM brand 
            WHERE id = :id 
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
        // $row ist ein Datensatz
        while($row = $ps->fetch()){
            $id = $row['id'];
            $name = $row['name'];
            $brand = new Brand($id, $name);
            return $brand;
        }
        return false;
    }


    public function editBrand(Brand $brand){
        $ps = $this->conn->prepare('
            UPDATE brand 
            SET name = :name 
            WHERE id = :id 
        ');
        $ps->bindValue('name', $brand->name);
        $ps->bindValue('id', $brand->id);
        $ps->execute();
    }


    public function deleteBrand(int $id){
        $ps = $this->conn->prepare('
            DELETE FROM brand 
            WHERE id = :id 
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
    }


    public function createUser($fname, $lname, $email, $password, $is_admin) : int {
        // Passwort darf nur als Hash in der DB gespeichert werden!
        $password = password_hash($password, PASSWORD_DEFAULT);

        $ps = $this->conn->prepare('
        INSERT INTO user 
        (fname, lname, email, password, is_admin)
        VALUES
        (:fname, :lname, :email, :password, :is_admin)
        ');
        $ps->bindValue('fname', $fname);
        $ps->bindValue('lname', $lname);
        $ps->bindValue('email', $email);
        $ps->bindValue('password', $password);
        $ps->bindValue('is_admin', $is_admin, PDO::PARAM_BOOL);
        $ps->execute();
        return $this->conn->lastInsertId();
    }


    public function getUserByEmail(string $email) : User|false {
        $ps = $this->conn->prepare('
        SELECT * 
        FROM user 
        WHERE email = :email 
        ');
        $ps->bindValue('email', $email);
        $ps->execute();
        // fetchObject() ist für 0 oder 1 Datensatz
        // erstellt automatisch ein Objekt der Klasse User
        return $ps->fetchObject('User');
    }

    public function getUserById(int $id) : User|false {
        $ps = $this->conn->prepare(
            'SELECT *
            FROM user
            WHERE id = :id'
        );
        $ps->bindValue('id', $id);
        $ps->execute();
        return $ps->fetchObject('User');
    }

    public function isLoggedIn() : bool {
        if(isset($_SESSION['userid']) && ctype_digit(''.$_SESSION['userid'])){ // ctype_digit benoetigt einen STRING -->> ''.
            return true;
        }
        return false;
    }

    public function getCurrentUser() : User|false {
        if($this->isLoggedIn()){
            // wenn angemeldet, user laden
            // mit der aktuellen User-ID die in der Session steht.
            // Diese steht nur in der Session wenn man gerade angemeldet ist.
            return $this->getUserById($_SESSION['userid']);
        }
        // nicht angemeldet
        return false;
    }



    // wird aufgerufen wenn man NICHT angemeldet
    // sein darf um eine Seite yu laden
    // leitet auf den Index weiter wenn der User
    // bereits angemeldet ist.
    public function requireNotLoggedIn(){
        if($this->isLoggedIn()){
            header('Location: index.php');
            exit();
        }
    }

    // wenn man nicht angemeldet sind --> weiterleitung zur Loginseite
    public function requireLoggedIn(){
        if($this->isLoggedIn() == FALSE){
            header('Location: login.php');
        }
    }



    public function login(string $email, string $password) : int|false{
        // Lade User an hand der Email
        $user = $this->getUserByEmail($email);
        if($user == FALSE){
            // es gibt keinen user mit dieser Email
            return false;
        }
        // Password check
        if(password_verify($password, $user->password)){
            // PW korrekt  anmeldung durchfuehren
            // --> in der Session di user-ID speichern
            $_SESSION['userid'] = $user->id;

            // die ID des eingeloggten Users returnen
            return $user->id;
        }
        // PW falsch
        return false;
    }


    public function logout(){
        session_destroy();
        // loesche alle Session-Variablen
        // --> $_SESSION['userid']
    }

    public function isAdmin() : bool {
        $user =$this->getCurrentUser();
        // nicht angemeldet oder nicht admin
        if($user == FALSE || $user->is_admin == FALSE){
            return false;
        }
        return true;
    }

    // beim aufruf einer Seite die Adminrechte erfordert
    // leitet zum index weiter wenn user nicht admin ist
    public function requireAdmin(){
        if($this->isAdmin() == FALSE){
            header('Location: index.php');
            exit();
        }
    }

    public function __construct()
    {
        // Zugangsdaten zur Datenbank
        $host = '127.0.0.1';
        $dbName = '20230911_ecommerce';
        $dbUser = 'root';
        $dbPassword = '';
        // Aufbau der DB-Connection
        $conn = new PDO("mysql:dbname=$dbName; host=$host", $dbUser, $dbPassword);
        // DB-Fehlermeldungen sollen angezeigt werden
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // initialisiert die Eigenschaft private PDO $conn;
        // die lokale Variable $conn wird auf die Eigenschaft $conn zugewiesen.
        $this->conn = $conn;
    }
}

?>