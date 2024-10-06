<?php
//In this script do the self-validated form

//$contacts = require_once __DIR__ . '/data.php';

require_once __DIR__ . '/functions.php';
session_start();

$contacts = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $contacts['id'] = trim(strip_tags($_POST['id']));
    $contacts['title'] = $_POST['title'];
    $contacts['firstname'] = trim(strip_tags($_POST['firstname']));
    $contacts['surname'] = trim(strip_tags($_POST['surname']));
    $contacts['birthdate'] = $_POST['birthdate'];
    $contacts['phone'] = trim(strip_tags($_POST['phone']));
    $contacts['email'] = trim(strip_tags($_POST['email']));
    $contacts['types'] = $_POST['types'] ?? [];

    $errors = validateContact($contacts);

    $_SESSION['contacts'] = $contacts;

    if (empty($errors)) {
        header('Location: checkdata.php');
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Vicent Roselló">
    <title>Contact</title>
    <style>
        h1,
        p {
            text-align: center;
        }

        form {
            border: 1px solid black;
            padding: 20px;
            width: 600px;
            margin: 0 auto;
        }

        input {
            margin: 5px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Contact</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="id">ID</label>
            <input type="text" id="id" name="id" value="0" readonly>
        </div>
        <br>
        <div>
            <label>Title</label><br>
            <input type="radio" id="Mr" name="title" value="Mr." checked>
            <label for="Mr">Mr.</label>
            <input type="radio" id="Mrs" name="title" value="Mrs." <?php if (($contacts['title'] ?? '') === 'Mrs.') echo 'checked';  ?>>
            <label for="Mrs">Mrs.</label>
            <input type="radio" id="Miss" name="title" value="Miss" <?php if (($contacts['title'] ?? '') === 'Miss') echo 'checked';  ?>>
            <label for="Miss">Miss</label>
        </div>
        <br>
        <div>
            <label for="firstname">First name</label>
            <input type="text" id="firstname" name="firstname" value="<?= $contacts['firstname'] ?? ''; ?>">
            <span class="error"><?php echo $errors['firstname'] ?? ''; ?></span><br>
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" value="<?= $contacts['surname'] ?? ''; ?>">
            <span class="error"><?php echo $errors['surname'] ?? ''; ?></span><br>
        </div>
        <br>
        <div>
            <label for="birthdate">Birth date</label>
            <input type="date" id="birthdate" name="birthdate" value="<?= $contacts['birthdate'] ?? ''; ?>">
            <span class="error"><?php echo $errors['birthdate'] ?? ''; ?></span><br>
        </div>
        <div>
            <label for="phone">Mobile Phone</label>
            <input type="text" id="phone" name="phone" value="<?= $contacts['phone'] ?? ''; ?>">
            <span class="error"><?php echo $errors['phone'] ?? ''; ?></span><br>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" value="<?= $contacts['email'] ?? ''; ?>">
            <span class="error"><?php echo $errors['email'] ?? ''; ?></span><br>
        </div>
        <br>
        <div>
            <label>Type</label><br>
            <input type="checkbox" id="favourite" name="types[]" value="Favourite" <?php if (in_array('Favourite', $contacts['types'] ?? [])) echo 'checked'; ?>>
            <label for="favourite">Favourite</label><br>
            <input type="checkbox" id="important" name="types[]" value="Important" <?php if (in_array('Important', $contacts['types'] ?? [])) echo 'checked'; ?>>
            <label for="important">Important</label><br>
            <input type="checkbox" id="archived" name="types[]" value="Archived" <?php if (in_array('Archived', $contacts['types'] ?? [])) echo 'checked'; ?>>
            <label for="archived">Archived</label><br>
        </div>
        <br>
        <div>
            <input type="submit" value="Save">
            <input type="submit" value="Update" disabled>
            <input type="submit" value="Delete" disabled>
        </div>
    </form>
</body>

</html>