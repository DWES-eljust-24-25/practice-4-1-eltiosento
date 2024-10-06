<?php
//This script is to show the validated data from contact.php
session_start();
if (isset($_SESSION['contacts'])) {
    $contacts = $_SESSION['contacts'];
    echo "<h2>No errors!</h2>";
    echo "<p>ID: " . $contacts['id'] . "</p>";
    echo "<p>Title: " . $contacts['title'] . "</p>";
    echo "<p>Firstname: " . $contacts['firstname'] . "</p>";
    echo "<p>Surname: " . $contacts['surname'] . "</p>";
    echo "<p>Birthdate: " . $contacts['birthdate'] . "</p>";
    echo "<p>Phone: " . $contacts['phone'] . "</p>";
    echo "<p>Email: " . $contacts['email'] . "</p>";
    if (!empty($contacts['types'])) {
        echo "<p>Types: " . implode(", ", $contacts['types']) . "</p>";
    } else {
        echo "<p>Types: None</p>";
    }
}
session_destroy();
