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


    public function getCategoryById($id) : Category|false {
        $ps = $this->conn->prepare('
            SELECT * 
            FROM category 
            WHERE id = :id 
        ');
        $ps->bindValue('id', $id);
        $ps->execute();
        // erzeig aus eine SQL datensatz ein Objekt der Klasse Category
        // FALSE wenn kein Datensatz gefunden wurde
        return $ps->fetchObject('Category');
    }

    public function getCategories() : array {
        $ps = $this->conn->prepare('
        SELECT *
        FROM category
        ');
        $ps->execute();

        // erzeugt aus jedem Datensatz ein Obj der Klasse Category
        // sammelt diese im Array und gibt das Array zurueck
        return $ps->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    public function createProduct(string $sku, int $brand_id, ?int $category_id,
                                    string $name, string $description, string $picture,
                                    float $price, int $stock, bool $is_removed) : int {
                                        $ps = $this->conn->prepare('
                                        INSERT INTO product
                                        (sku, brand_id, category_id, name,
                                        description, picture, price, stock, is_removed)
                                        VALUES
                                        (:sku, :brand_id, :category_id, :name,
                                        :description, :picture, :price, :stock, :is_removed)
                                        ');

                                        $ps->bindValue('sku', $sku);
                                        $ps->bindValue('brand_id', $brand_id);
                                        $ps->bindValue('category_id', $category_id);
                                        $ps->bindValue('name', $name);
                                        $ps->bindValue('description', $description);
                                        $ps->bindValue('picture', $picture);
                                        $ps->bindValue('price', $price);
                                        $ps->bindValue('stock', $stock);
                                        $ps->bindValue('is_removed', $is_removed, PDO::PARAM_BOOL);
                                        $ps->execute();
                                        return $this->conn->lastInsertId();
    }

    public function getProductBySku(string $sku) : Product | FALSE {
        $ps = $this->conn->prepare('
        SELECT *
        FROM product
        WHERE sku = :sku
        ');
        $ps->bindValue('sku', $sku);
        $ps->execute();
        return $ps->fetchObject('Product');
    }

    // liefert ALLE Produkte zurueck (auch stock 0 bzw. is_removed)
    public function getProducts() : array {
        $ps = $this -> conn -> prepare('
        SELECT *
        FROM product
        ');
        $ps->execute();
        return $ps->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public function getProductById($productId, bool $includeUnavailable=FALSE) : Product | False {
        $products = $this->getProducts();
        foreach($products as $p){
            if($p->id == $productId){
                if($includeUnavailable == TRUE){
                    // Produkt gefunden
                    return $p;
                } else {
                    // Produkt gefunden, muss verfuegbar sein
                    if($p->isAvailable()){
                        return $p;
                    }
                    return false;
                }
            }
        }
        // es gibt kein Produkt mit der ID
        return false;
    }


    public function addToCart(int $productId, int $qty) : void {

        // wann soll ein besetehender Eintrag bearbeitet werden?
        // wenn product-ID schon einthalten ist
        $cartEdited = false;
        // foreach($_SESSION['cart'] as $entry){
        //     if($entry['product_id'] == $productId){
        //         // gefunden! aktualisieren!
        //         $entry['qty'] += $qty;
        //         $cartEdited = true;
        //         break;
        //     }
        // }
        // FUNKTIONIERT NICHT, WEIL MIT FOREACH EINE KOPIE ERSTELLT WIRD

        for($i=0; $i < count($_SESSION['cart']); $i++){
            if($_SESSION['cart'][$i]['product_id'] == $productId){
                // gefunden! aktualisieren!
                $_SESSION['cart'][$i]['qty'] += $qty;
                return;
            }
        }

        // einzelnen Warenkorbeintrag erstellen
        $cartEntry = [];
        // Key-Value pair im Assoziativen array
        $cartEntry['product_id'] = $productId;
        $cartEntry['qty'] = $qty;

        // eienzelnen Eintrag in das Session-Array speichern
        $_SESSION['cart'][] = $cartEntry;
    }

    // loescht ein Produkt aus dem Warenkorb
    public function deleteFromCart(int $productId) : void {
        // aus einem Array loeschen: array_splice()
        for($i = 0; $i < count($_SESSION['cart']); $i++){
            // hat das EElement am Index i die gesuchte productId?
            if($_SESSION['cart'][$i]['product_id'] == $productId){
                // loesche Eintrag aus dem Warenkorb
                array_splice($_SESSION['cart'], $i, 1);
                return;
            }
        }
        
    }


    public function createOrder($address, $city, $zip, $country) : int {
        $now = new DateTime();
        $user = $this->getCurrentUser();

        // Speichere Order, damit wir eine OrderID bekommen
        // total wird erst spaeter ermittelt
        $total = 0;

        $ps = $this->conn->prepare('
            INSERT INTO orders
            (user_id, order_date, zip, country, address, city, total)
            VALUES
            (:user_id, :order_date, :zip, :country, :address, :city, :total)
        ');
        $ps->bindValue('user_id', $user->id);
        $ps->bindValue('order_date', $now->format('Y-m-d H:i:s'));
        $ps->bindValue('zip', $zip);
        $ps->bindValue('country', $country);
        $ps->bindValue('address', $address);
        $ps->bindValue('city', $city);
        // total anfangs 0! wird spaeter aktualisiert
        $ps->bindValue('total', $total);
        $ps->execute();
        $orderId = $this->conn->lastInsertId();

        // nachdem eine Bestellung angelegt wurde (ID!)
        // koennen nun die einzelnen Bestellpositionen gespeichert werden.
        // Bestellpositionen -- Warenkorbeintraege
        // fuer jeden Warenkorbeintrag wird eine bestellposition gespeichert.
        // waehrenddessen die Gesamtsumme der Bestellung ermitteln


        // NO UPDATE Values in foreach!! foreach akes a copy of the array!!
        foreach($_SESSION['cart'] as $entry){
            
            $productId = $entry['product_id'];
            
            $qty = $entry['qty'];

            $product = $this->getProductById($productId);
            $productPrice = $product->price;

            $ps = $this->conn->prepare('
                INSERT INTO order_position
                (product_id, order_id, stock, unit_price)
                VALUES
                (:product_id, :order_id, :stock, :unit_price)
            ');
            $ps->bindValue('product_id', $productId);
            $ps->bindValue('order_id', $orderId);
            $ps->bindValue('stock', $qty);
            $ps->bindValue('unit_price', $productPrice);
            $ps->execute();

            // Position zum Gesamtpreis addieren
            $total += $qty * $productPrice;

        }

        // Aktualisierung des Gesamtbetrags der Bestellung
        $ps = $this->conn->prepare('
            UPDATE orders
            SET total = :total
            WHERE id = :id
        ');

        $ps->bindValue('total', $total);
        $ps->bindValue('id', $orderId);
        $ps->execute();


        // Warenkorb leeren
        $_SESSION['cart'] = [];

        return $orderId;

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