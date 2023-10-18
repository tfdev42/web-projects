<?php
// Ausgabe des $errors array
if(count($errors) > 0)
{
    echo '<ul id="errors">';
    foreach($errors as $error){
        echo '<li>'.htmlspecialchars($error).'</li>';
    }
    echo '</ul>';
}

?>