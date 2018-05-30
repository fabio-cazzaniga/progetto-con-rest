<?php
/**
 * Created by IntelliJ IDEA.
 * User: student
 * Date: 30/05/18
 * Time: 13.35
 */
$db=require __DIR__ . '/../database/db.php';

function faiLogin()
{
    if (isset($_SESSION[KEY_LOGGED_IN])) {
        echo '<script type="text/javascript"> window.open("../view/dashboardApertamente.php' . '" , "_self");</script>';
    }

// Only for Password Reset - with token and email in URL
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[KEY_LOGRESET_USERNAME]) && isset($_GET[KEY_LOGRESET_TOKEN])) {
        $user = $_GET[KEY_LOGRESET_USERNAME];
        $token = $_GET[KEY_LOGRESET_TOKEN];

        $q = "SELECT id_amministratore FROM amministratore WHERE email=? AND token=?";
        $stmt = $db->prepare($q);
        $stmt->bind_param("ss", $user, $token);
        $stmt->execute();

        $stmt_result = $stmt->get_result();

        // corrispondenza utente trovata, salvare il valore tramite le sessioni
        if ($stmt_result->num_rows == 1) {
            $_SESSION[KEY_LOGGED_IN] = $user;

            echo '<script type="text/javascript"> window.open("../view/dashboardApertamente.php' . '" , "_self");</script>';
        } else {
            $alert = alert("danger", "Errore!", "Combinazione utente e token errata, se i problemi persistono, contattare i tecnici.");

            $errors[] = [mysqli_error($db), 'Query' . interpolateQuery($q, [$user, $token])];
            reportErrors($errors, $alert, true, 'red');
        }

        $stmt->close();
    }
}

function ottieniListaEsercente(){

    $query = "SELECT * FROM `amministratore` WHERE `scrittura` = FALSE;";

    $result = $db->query($query);

    $i = 0;
    while ($riga = $result->fetch_assoc()) {
        $riga['esercizi'] = array();
        $result_esercizi = $db->query("SELECT `paese` FROM `esercizio` WHERE `id_amministratore` = " . $riga['id_amministratore']);
        while ($riga_esercizi = $result_esercizi->fetch_assoc()) {
            array_push($riga['esercizi'], $riga_esercizi['paese']);
        }
        $output[$i] = $riga;
        $i += 1;
    }
    return $output;
}