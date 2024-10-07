<?php
//In this script, do the contact list table
require_once __DIR__ . '/functions.php';

$contacts = require_once __DIR__ . '/data.php';

// variables per la capçalera i el peu de pàgina
$pageTitle = 'Practice 4.1. Forms - Contact List';
$authorName = 'Vicent Roselló';

// Es pot probar amb diferents capçales per a veure com es comporta la taula.
$headers = ['ID', 'Title', 'Firstname', 'Surname', 'Birthdate'];
$haders2 = ['ID', 'Title', 'Firstname', 'Surname', 'Birthdate', 'Phone', 'Email', 'Favourite', 'Important', 'Archived'];



include __DIR__ . '/head.part.php';

echo '<h2>Contact List</h2>';
// Afegim un botó per a crear un nou contacte.
echo '<p><a href="contact_form.php"><button type="button">Create new contact</button></a></p>';

showTable($contacts, $haders2);

include __DIR__ . '/footer.part.php';
