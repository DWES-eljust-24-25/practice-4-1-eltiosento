<?php
//In this script, place the functions
declare(strict_types=1);


function validateContact(array $contact): array
{
    $errors = [];

    if (empty($contact['firstname'])) {
        $errors['firstname'] = "* Name is required";
    } elseif (strlen($contact['firstname']) < 4) {
        $errors['firstname'] = "* Name must be at least 4 characters long";
    }

    if (empty($contact['surname'])) {
        $errors['surname'] = "* Surname is required";
    }

    if (empty($contact['birthdate'])) {
        $errors['birthdate'] = "* Birthdate is required";
    }

    if (empty($contact['phone'])) {
        $errors['phone'] = "* Phone is required";
    } elseif (!preg_match("/^(6|7)\d{8}$/", $contact['phone'])) {
        $errors['phone'] = "* Invalid phone number";
    }

    if (empty($contact['email'])) {
        $errors['email'] = "* Email is required";
    } elseif (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "* Invalid email address";
    }
    return $errors;
}
