<?php  
require_once 'maininclude.inc.php';
$dba->requireLoggedIn();

$user = $dba->getCurrentUser();

// Passwort ändern
if(isset($_POST['bt_update_password'])){
    // Daten einlesen
    $oldPassword = trim($_POST['old_password']);
    $newPassword = trim($_POST['new_password']);
    $newPasswordRepeat = trim($_POST['new_password_repeat']);

    if(empty($oldPassword)){
        $errors[] = 'Bitte das aktuelle Passwort eingeben!';
    }
    if(empty($newPassword)){
        $errors[] = 'Bitte das neue Passwort eingeben!';
    }
    if(empty($newPasswordRepeat)){
        $errors[] = 'Bitte das neue Passwort bestätigen!';
    }
    if(strcmp($newPassword, $newPasswordRepeat) != 0){
        $errors[] = 'Das neue Passwort wurde falsch bestätigt!';
    }
    if(strlen($newPassword) < 8){
        $errors[] = 'Das neue Passwort muss mind. 8 Zeichen haben!';
    }

    if(!$dba->isCurrentPassword($oldPassword)){
        $errors[] = 'Das derzeitige Passwort ist nicht korrekt!';
    }

    if(count($errors) == 0){
        // Passwort aktualisieren
        $dba->changePassword($newPassword);
        header('Location: ./profile.php?pwchange=true');
        exit();
    }
} else if(isset($_POST['bt_update_email'])){
    $email = trim($_POST['email']);
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
        $errors[] = 'Bitte eine korrekte E-Mail Adresse eingeben!';
    }
    // Email darf noch nicht bei einem anderen Account existieren
    $userByEmail = $dba->getUserByEmail($email);
    if($userByEmail != FALSE && $userByEmail->id != $user->id){
        $errors[] = 'Es existiert bereits ein Account mit dieser E-Mail Adresse!';
    }
    if(count($errors) == 0){
        $updateUser = $dba->getCurrentUser();
        $updateUser->email = $email;
        $dba->editUser($updateUser);
        header('Location: ./profile.php?emailchange=true');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Profil: <?php echo htmlspecialchars($user->email); ?></h1>
        <?php  
        if(isset($_GET['pwchange'])){
            echo '<p><strong>Das Passwort wurde geändert.</strong></p>';
        } else if(isset($_GET['emailchange'])){
            echo '<p><strong>Email wurde geändert.</strong></p>';
        }
        ?>
        <?php include 'showerrors.inc.php'; ?>
        <h2>Meine Verträge</h2>


        <h2>Vertrag abschließen</h2>
        <p>
            Wählen Sie ihre gewünschte Versicherung:
        </p>

        <h2>Passwort ändern</h2>
        <form action="profile.php" method="POST">
            <p>Muss noch fertig programmiert werden!</p>
            <label>Aktuelles Passwort:</label><br>
            <input type="password" name="old_password"><br>
            <label>Neues Passwort (mindestens 8 Zeichen):</label><br>
            <input type="password" name="new_password"><br>
            <label>Neues Passwort wiederholen:</label><br>
            <input type="password" name="new_password_repeat"><br>
            <button name="bt_update_password">Passwort ändern</button>
        </form>
        <h2>E-Mail ändern</h2>
        <p>
            Ihre Aktuelle E-Mail Adresse: <?php echo htmlspecialchars($user->email); ?>
        </p>
        <form action="profile.php" method="POST">
            <p>Muss noch fertig programmiert werden!</p>
            <label>Neue E-Mail Adresse:</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>"><br>
            <button name="bt_update_email">Email ändern</button>
        </form>
        
    </main>
</body>
</html>