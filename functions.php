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

/**
 * Funció genèrica per a mostrar una taula a partir d'un array associatiu qualsevol.
 * 
 * @param array $data Matriu d'arrays associatives
 * @param array|null $optionalHeader Opcional, Array amb el contingut de la capçalera, per defecte agafarà les claus de cada Array.
 */
function showTable(array $data, ?array $optionalHeader = null): void
{

    // Necessitem tindre una capçalera amb totes les claus aixi podem fer que tots els continguts estiguen alineats.
    $header = [];
    foreach ($data as $row) {
        // Agafem en un array les claus de cada fila:

        // Aquesta lina de codi simplica el foreach inical, així fem ús de noves funcionalitats d'arryas que te php.
        // merge mescla dos arrays i array_unique elimina els duplicats. Amb java sería com fer un Set.
        $header = array_unique(array_merge($header, array_keys($row)));

        /*
        $rowKeys = array_keys($row);

        foreach ($rowKeys as $key) {
            // Recorreguem la fila i si la clau no esta en la capçalera la posem.
            if (!in_array($key, $header)) {
                $header[] = $key;
            }
        }
        */
    }
    echo '<style>
    table {
        text-align: center;
        margin: 15 auto;
    }
        th {
        background-color: yellow;
    }
    </style>';

    echo '<body>';
    // Una altra forma de pintar una taula clavant l'estil dintre de l'etiqueta
    echo '<table border="1" cellpadding="5" cellspacing="0">';

    // Pintem la capçalera i la taula segon si hi ha capçalera opcional o no.
    if ($optionalHeader === null) {
        // Pintem la capçalera per defecte.
        echo '<tr>';
        echo '<th></th>';
        foreach ($header as $nameKey) {
            echo "<th>$nameKey</th>";
        }
        echo '</tr>';
        // Pintem el contingut
        foreach ($data as $row) {
            echo '<tr>';
            // Per cada fial creem un botó i enviarem l'id per al ulr. Aixi amb el $_GET podrem recuperar l'id.
            echo '<td><a href="contact_form.php?id=' . $row['id'] . '"><button type="button">Edit/View</button></a></td>';
            // Per cada fila anem a comprorar si conté la clau de la capçalera, si no la conté deixem l'etiqueta buida.
            foreach ($header as $nameKey) {
                // Amb isset podem comprobar si una clau esta definina a un array, 
                // Pertant si en torna true posarem el valor d'eixa clau, sino deixem l'etiqueta buida.
                echo isset($row[$nameKey]) ? "<td>{$row[$nameKey]}</td>" : '<td></td>';
            }
            echo '</tr>';
        }
    } else {
        // Pintem la capçalera opcional.
        echo '<tr>';
        echo '<th></th>';
        foreach ($optionalHeader as $name) {
            echo "<th>$name</th>";
        }
        echo '</tr>';
        // Pintem el contingut
        foreach ($data as $row) {
            echo '<tr>';
            // Per cada fial creem un botó i enviarem l'id per al ulr. Aixi amb el $_GET podrem recuperar l'id.
            echo '<td><a href="contact_form.php?id=' . $row['id'] . '"><button type="button">Edit/View</button></a></td>';
            // inicialitzem un contador per a que no es passe de la quantitat de capçaleres opcionals.
            $itemCount = 0;
            foreach ($header as $nameKey) {

                $itemCount++;
                if ($itemCount > count($optionalHeader)) {
                    break;
                }
                // Amb isset podem comprobar si una clau esta definina a un array, 
                // Pertant si en torna true posarem el valor d'eixa clau, sino deixem l'etiqueta buida.
                echo isset($row[$nameKey]) ? "<td>{$row[$nameKey]}</td>" : '<td></td>';
            }
            echo '</tr>';
        }
    }


    echo '</table>';
    echo '</body>';
}
