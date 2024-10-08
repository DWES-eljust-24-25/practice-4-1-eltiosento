<?php
//In this script do the self-validated form

require_once __DIR__ . '/functions.php';
session_start();

$contactsArray = require_once __DIR__ . '/data.php';

$contacts = [];
$errors = [];


// variables per la capçalera i el peu de pàgina
$pageTitle = 'Practice 4.1. Forms - Contact Form';
$authorName = 'Vicent Roselló';

// Comprovar si hi ha un ID passat per URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Busquem el contacte corresponent a l'ID
    foreach ($contactsArray as $contact) {
        if ($contact['id'] === $id) {
            $contacts = $contact;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $contacts['id'] = trim(strip_tags($_POST['id']));
    $contacts['title'] = $_POST['title'];
    $contacts['firstname'] = trim(strip_tags($_POST['firstname']));
    $contacts['surname'] = trim(strip_tags($_POST['surname']));
    $contacts['birthdate'] = $_POST['birthdate'];
    $contacts['phone'] = trim(strip_tags($_POST['phone']));
    $contacts['email'] = trim(strip_tags($_POST['email']));
    $contacts['favourite'] = $_POST['favourite'] ?? false;
    $contacts['important'] = $_POST['important'] ?? false;
    $contacts['archived'] = $_POST['archived'] ?? false;

    $errors = validateContact($contacts);

    $_SESSION['contacts'] = $contacts;

    if (empty($errors)) {
        header('Location: checkdata.php');
    }
}

?>

<?php include __DIR__ . '/head.part.php'; ?>


<h1>Contact</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div>
        <label for="id">ID</label>
        <input type="text" id="id" name="id" value="<?= $contacts['id'] ?? '0'; ?>" readonly>
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
        <input type="checkbox" id="favourite" name="favourite" value="true" <?= ($contacts['favourite'] ?? false) ? 'checked' : ''; ?>>
        <label for="favourite">Favourite</label><br>
        <input type="checkbox" id="important" name="important" value="true" <?= ($contacts['important'] ?? false) ? 'checked' : ''; ?>>
        <label for="important">Important</label><br>
        <input type="checkbox" id="archived" name="archived" value="true" <?= ($contacts['archived'] ?? false) ? 'checked' : ''; ?>>
        <label for="archived">Archived</label><br>
    </div>
    <br>
    <div>
        <input type="submit" value="Save" <?= (($contacts['id'] ?? 0) == 0) ? '' : 'disabled' ?>>
        <input type="submit" value="Update" <?= (($contacts['id'] ?? 0) != 0) ? '' : 'disabled' ?>>
        <input type="submit" value="Delete" disabled>
    </div>
</form>

<?php include __DIR__ . '/footer.part.php'; ?>