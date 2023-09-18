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