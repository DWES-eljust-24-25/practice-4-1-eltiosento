<?php
//In this script, do the contact list table
require_once __DIR__ . '/functions.php';

$contacts = require_once __DIR__ . '/data.php';

$headers = ['ID', 'Title', 'Firstname', 'Surname', 'Birthdate'];

echo '<style>

    h2, p {
        text-align: center;
        margin: 15 auto;
    }

    </style>';

echo '<h2>Contact List</h2>';
// Afegim un botó per a crear un nou contacte.
echo '<p><a href="contact_form.php"><button type="button">Create new contact</button></a></p>';

showTable($contacts, $headers);
