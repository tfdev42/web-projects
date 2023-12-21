<?php
if(count($errors) > 0) {
    echo '<div><ul id="errors">';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul></div>';
    
}
?>