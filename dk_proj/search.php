<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $userSearch = $_POST["usersearch"];
    

    try {
        
        require_once "includes/dbh.inc.php";
        
        $query ="SELECT *
        FROM comments
        WHERE username = :userSearch;
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":userSearch", $userSearch);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
        

    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }

}

else {
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
</head>
<body>
    <section>
    <h3>Search results:</h3>

    <?php

    if (empty($results)){
    echo "<div>";
    echo "<p>There were no results!</p>";
    echo "</div>";
    } else {
    // var_dump($results);
        foreach ($results as $row){?>
        <h4><?php echo htmlspecialchars($row["username"]); ?></h4>
        <p><?php echo htmlspecialchars($row["comment_text"]);  ?></p>
        <p><?php echo htmlspecialchars($row["created_at"]);  ?></p>
        <?php } ?>
    <?php } ?>
    </section>
    
</body>
</html>