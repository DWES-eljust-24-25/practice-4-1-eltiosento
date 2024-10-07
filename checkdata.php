<?php
//This script is to show the validated data from contact.php
session_start();

// variables per la capçalera i el peu de pàgina
$pageTitle = 'Practice 4.1. Forms - Check Data';
$authorName = 'Vicent Roselló';

include __DIR__ . '/head.part.php';

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
    echo "<p>Favourite: " . ($contacts['favourite'] ? 'Yes' : 'No') . "</p>";
    echo "<p>Important: " . ($contacts['important'] ? 'Yes' : 'No') . "</p>";
    echo "<p>Archived: " . ($contacts['archived'] ? 'Yes' : 'No') . "</p>";
}

include __DIR__ . '/footer.part.php';

session_destroy();
