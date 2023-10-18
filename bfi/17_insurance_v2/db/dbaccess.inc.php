<?php
require_once 'models.inc.php';
class DbAccess
{ 
    private PDO $conn;

    // public getter-Methode für private Eigenschaft 
    // um außerhalb der Klasse auf die Variable zugreifen zu können
    public function getConn() : PDO {
        return $this->conn; 
    }

    public function createUser($fname, $lname, $email, $password, $street, $zip, $city, $country, $payment_type, $iban) : int {
        // Passwort darf nur als Hash in der DB gespeichert werden!
        $password = password_hash($password, PASSWORD_DEFAULT);

        $ps = $this->conn->prepare('
        INSERT INTO user 
        (fname, lname, email, password, street, zip, city, country, payment_type, iban)
        VALUES
        (:fname, :lname, :email, :password, :street, :zip, :city, :country, :payment_type, :iban)
        ');
        $ps->bindValue('fname', $fname);
        $ps->bindValue('lname', $lname);
        $ps->bindValue('email', $email);
        $ps->bindValue('password', $password);
        $ps->bindValue('street', $street);
        $ps->bindValue('zip', $zip);
        $ps->bindValue('city', $city);
        $ps->bindValue('country', $country);
        $ps->bindValue('payment_type', $payment_type);
        $ps->bindValue('iban', $iban);
        $ps->execute();
        return $this->conn->lastInsertId();
    }


    /**
     * Ändere das Passwort für den aktuellen User
     */
    public function changePassword(string $newPassword) {
        $user = $this->getCurrentUser();
        $user->password = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->editUser($user);
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


    public function getUserByEmail(string $email) : User|false {
        // TODO! Implementieren!

        return false;
    }


    public function isLoggedIn() : bool {
        if(isset($_SESSION['userid']) && ctype_digit(''.$_SESSION['userid'])){
            return true;
        }
        return false;
    }


    public function getCurrentUser() : User|false {
        if($this->isLoggedIn()){
            // wenn angemeldet, user laden mit der aktuellen User-ID die in der Session steht. Diese steht nur in der Session wenn man gerade angemeldet ist.
            return $this->getUserById($_SESSION['userid']);
        }
        // Nicht angemeldet, false zurückgeben 
        return false;
    }


    /**
     * Prüft ob das übergebene Passwort das aktuelle Passwort des Users ist
     */
    public function isCurrentPassword(String $pw) : bool {
        // aktuellen User laden
        $user = $this->getCurrentUser();
        // prüfen ob das gespeicherte Passwort mit dem eingegebenen Passwort übereinstimmt
        return password_verify($pw, $user->password);
    }


    public function login($id, string $password) : int|false {
        // Lade User anhand der ID
        $user = $this->getUserById($id);
        if($user == FALSE){
            // es gibt keinen User mit dieser ID
            return false;
        }
        // Passwort check
        if(password_verify($password, $user->password)){
            // PW korrekt - Anmeldung durchführen
            // --> in der Session die User-ID speichern
            $_SESSION['userid'] = $user->id;

            // Die ID des eingeloggten Users zurückgeben
            return $user->id;
        }
        // PW falsch
        return false; 
    }


    // wird aufgerufen wenn man NICHT angemeldet
    // sein darf um eine Seite aufzurufen. 
    // leitet auf den Index weiter wenn der User
    // bereits angemeldet ist. 
    public function requireNotLoggedIn(){
        if($this->isLoggedIn()){
            header('Location: index.php');
            exit();
        }
    }


    public function requireLoggedIn(){
        if($this->isLoggedIn() == FALSE){
            header('Location: login.php');
            exit();
        }
    }


    public function logout(){
        // Lösche alle Session-Variablen
        // --> $_SESSION['userid']
        //$_SESSION['userid'] = '';
        session_destroy();
    }


    public function createProduct(string $name, string $description, float $pricePerMinute) : int {
        $ps = $this->conn->prepare('
            INSERT INTO product 
            (name, description, price_per_minute)
            VALUES
            (:name, :description, :price_per_minute)
        ');
        $ps->bindValue('name', $name);
        $ps->bindValue('description', $description);
        $ps->bindValue('price_per_minute', $pricePerMinute);
        $ps->execute();
        return $this->conn->lastInsertId();
    }


    public function editProduct(Product $p) {
        $ps = $this->conn->prepare('
            UPDATE product 
            SET name = :name, description = :description, 
            price_per_minute = :price_per_minute
            WHERE id = :id 
        ');
        $ps->bindValue('name', $p->name);
        $ps->bindValue('description', $p->description);
        $ps->bindValue('price_per_minute', $p->price_per_minute);
        $ps->bindValue('id', $p->id);
        $ps->execute();
    }


    // Liefert ALLE Produkte zurück
    public function getProducts() : array {
        $ps = $this->conn->prepare('
        SELECT * 
        FROM product 
        ');
        $ps->execute();
        return $ps->fetchAll(PDO::FETCH_CLASS, 'Product');
    }


    public function getProductById($productId, bool $includeUnavailable=false) : Product | False 
    {
        $products = $this->getProducts();
        foreach($products as $p){
            if($p->id == $productId){
                return $p;
            }
        }
        // es gibt kein Produkt mit der ID
        return false;
    }


    public function __construct()
    {
        // Zugangsdaten zur Datenbank
        $host = '127.0.0.1';
        $dbName = 'boatinsurance';
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