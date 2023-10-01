<?php
require_once 'models.inc.php';


class DbAccess
{ 
    private PDO $conn;

    // Registriert einen neuen User in der Datenbank
    public function register(string $email, string $password, string $name,
                            DateTime $birthdate, bool $newsletter) : int 
    {
        $ps = $this->conn->prepare('
        INSERT INTO user
        (email, password, name, birthdate, newsletter)
        VALUES
        (:email, :pw, :name, :birthdate, :newsletter)
        ');
        $ps->bindValue('email', $email);

        // password_hash($klartext, PASSWORD_DEFAULT) erzeugt einen Hash vom Passwort
        // Passwörter dürfen nur als Hash in die Datenbank geschrieben werden!
        $ps->bindValue('pw', password_hash($password, PASSWORD_DEFAULT)); // HASH!!
        $ps->bindValue('name', $name);

        // DateTime --> als String formatiert ausgeben lassen
        // MySQL benötigt das folgende Format: Y-m-d
        $ps->bindValue('birthdate', $birthdate->format('Y-m-d'));
        // bei Boolean explizit sagen, dass es ein Boolean ist!
        $ps->bindValue('newsletter', $newsletter, PDO::PARAM_BOOL);
        $ps->execute();
        return $this->conn->lastInsertId();
    }

    // Meldet den User am System an wenn die Kombination aus 
    // E-Mail und Passwort korrekt ist. 
    // Gibt true zurück wenn Login erfolgreich war, ansonsten false.
    // Schreibt bei Erfolg die User-ID in die Session --> $_SESSION['user_id']
    public function login(string $email, string $password) : bool {
        // finde User anhand der Email
        $user = $this->getUserByEmail($email);
        
        // wurde ein User gefunden?
        if($user == false){
            return false;
        }

        // Passwort prüfen
        // password_verify vergleicht das vom Benutzer eingegebene 
        // Passwort mit dem im User-Objekt gespeicherten Hash --> true oder false
        if(password_verify($password, $user->password) == false){
            // Passwort falsch
            return false;
        }
        
        // Alles OK! Am System anmelden!
        // User-ID in der Session speichern
        $_SESSION['user_id'] = $user->id;
        // Login erfolgreich, true zurückgeben
        return true;
    }


    // Meldet den User ab. Löscht die Session.
    public function logout(){
        $_SESSION['user_id'] = 0;
        session_destroy();
    }


    // Aufrufen wenn User angemeldet sein muss um die Seite aufzurufen.
    // Nichts passiert wenn der User angemeldet ist.
    // Wenn der User nicht angemeldet ist, wird dieser zur Login-Seite weitergeleitet.
    public function requireLoggedIn(){
        if(!$this->isLoggedIn()){
            header('Location: login.php?require_login=true');
            exit();
        }
    }


    // Prüft ob der aktuelle User angemeldet ist.
    // Gibt true zurück wenn ja, ansonsten false
    public function isLoggedIn() : bool {
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0){
            return true;
        }
        return false;
    }


    // Lädt einen User anhand der E-Mail Adresse aus der Tabelle user.
    // Gibt ein User-Objekt zurück, ansonsten false. 
    public function getUserByEmail(string $email) : User|false {
        $ps = $this->conn->prepare('
        SELECT * 
        FROM user 
        WHERE email = :email
        ');
        $ps->bindValue('email', $email);
        $ps->execute();
        while($row = $ps->fetch()){
            // Birthdate: DB liefert birthdate als String im Format Y-m-d
            // deshalb von String --> DateTime
            $birthdate = DateTime::createFromFormat('Y-m-d', $row['birthdate']);
            $user = new User($row['id'], $row['email'], $row['password'], 
                            $row['name'], $birthdate, $row['admin'], $row['newsletter']);
            return $user;
        }
        // keinen User gefunden
        return false;
    }


    // Lädt einen User anhand der ID aus der Tabelle user.
    // Gibt ein User-Objekt zurück, ansonsten false. 
    public function getUserById($id) : User|false {
        $ps = $this->conn->prepare('
        SELECT * 
        FROM user 
        WHERE id = :id
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
        while($row = $ps->fetch()){
            // Birthdate: DB liefert birthdate als String im Format Y-m-d
            // deshalb von String --> DateTime
            $birthdate = DateTime::createFromFormat('Y-m-d', $row['birthdate']);
            $user = new User($row['id'], $row['email'], $row['password'], 
                            $row['name'], $birthdate, $row['admin'], $row['newsletter']);
            return $user;
        }
        // keinen User gefunden
        return false;
    }


    public function __construct()
    {
        // Zugangsdaten zur Datenbank
        $host = '127.0.0.1';
        $dbName = '20230726_guestbook';
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