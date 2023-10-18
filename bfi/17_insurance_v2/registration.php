<?php 
require_once 'maininclude.inc.php';

// Diese Seite darf nur aufgerufen werden wenn
// man noch NICHT angemeldet ist.
$dba->requireNotLoggedIn();

if(isset($_POST['bt_registration']))
{
    $fname = trim($_POST['firstname']);
    $lname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $street = trim($_POST['street']);
    $zip = trim($_POST['zip']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $paymentType = trim($_POST['payment_type']);
    $iban = trim($_POST['iban']);

    if(strlen($fname) == 0){
        $errors[] = 'Please enter your firstname';
    }
    if(strlen($lname) == 0){
        $errors[] = 'Please enter your lastname';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
        $errors[] = 'Please enter a valid email';
    } else if($dba->getUserByEmail($email) != FALSE){
        $errors[] = 'An account with this email already exists. Sorry!';
    }

    if(strlen($password) < 8){
        $errors[] = 'Your password must contain at least 8 chars';
    }

    if(count($errors) == 0){
        $userId = $dba->createUser($fname, $lname, $email, $password, $street, $zip, $city, $country, $paymentType, $iban);
        header('Location: login.php?userid='.$userId);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Account erstellen</h1>
        <?php include 'showerrors.inc.php'; ?>
        <form action="registration.php" method="POST">
            <label>Firstname</label><br>
            <input type="text" name="firstname"><br>
            <label>Lastname</label><br>
            <input type="text" name="lastname"><br>
            <label>Email</label><br>
            <input type="text" name="email"><br>
            <label>Password:</label><br>
            <input type="password" name="password"><br>
            <label>Straße</label><br>
            <input type="text" name="street"><br>
            <label>PLZ</label><br>
            <input type="text" name="zip"><br>
            <label>Ort</label><br>
            <input type="text" name="city"><br>
            <label>Land</label><br>
            <input type="text" name="country"><br>
            <label>Zahlungsart</label><br>
            <select name="payment_type">
                <option value=""></option>
                <option value="R">Rechnung</option>
                <option value="B">Bankeinzug</option>
            </select>
            <br>
            <label>IBAN (bei Bankeinzug)</label><br>
            <input type="text" name="iban"><br>
            
            <button name="bt_registration">Registration</button>
        </form>
    </main>
</body>
</html>