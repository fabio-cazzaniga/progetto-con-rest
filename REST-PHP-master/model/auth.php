<?php

/*
 * #----------#
 * # Auth.PHP #
 * #----------#
 *
 *
 * Questo script verrà incluso in ogni altri script.
 *
 * Contiene:
 * - il codice per gestire l'autenticazione
 * - il tag <head> a cui verrà aggiunto il resto della pagina
 *
 */

include("utils.php");
define('KEY_LOGGED_IN', 'logged_user');
define('KEY_LOGIN_USERNAME', 'username');
define('KEY_LOGIN_PASSWORD', 'password');
define('KEY_LOGIN_SUBMIT', 'login_clicked');
define('KEY_LOGRESET_USERNAME', 'lou');
define('KEY_LOGRESET_TOKEN', 'lot');
define('KEY_LOGINRESET_LINK', 'key_loginreset_link');
define('KEY_SUBMIT_RESET_PASSWORD', 'btn_reset_password');
define('KEY_RESET_PASSWORD_EMAIL', 'input_reset_password');
define('KEY_FORCE_RESET_PASSWORD', 'forcereset_pass');
define('KEY_RESETPASS_PASS', 'resetform_pass');
define('KEY_RESETPASS_PASSCONFIRM', 'resetform_passconf');
define('KEY_RESETPASS_SUBMIT', 'resetform_submit');

// login tramite le sessioni
session_start();

// messaggio di alert che apparirà nel caso si verifichino errori
$alert = [];

$errors = []; // Initialize an error array.

// Se l'utente sta cercando di loggarsi (cliccato sul pulsante login)
if (isset($_POST[KEY_LOGIN_SUBMIT]))
{
    $user = getPostString($db, $errors, KEY_LOGIN_USERNAME);
    $pass = getPostString($db, $errors, KEY_LOGIN_PASSWORD);
    
    // decifra la password tramite sha2=>256
    $hp = substr(hash('sha256', $pass), 0, 64);
    $q = "SELECT id_amministratore FROM amministratore WHERE email=? AND password=?";
    $stmt = $dbc->prepare($q);
    $stmt->bind_param("ss", $user, $hp);
    $stmt->execute();
    
    $stmt_result = $stmt->get_result();
    
    // corrispondenza utente trovata, salvare il valore tramite le sessioni
    if ($stmt_result->num_rows == 1)
    {
        $_SESSION[KEY_LOGGED_IN] = $user;
        
        // redirect on index page
        echo '<script type="text/javascript"> window.open("../view/dashboardApertamente.php' . '" , "_self");</script>';
    }
    else
    {
        $alert = alert("red", "Errore!", "Combinazione utente e password errata!");
    }
    
    $stmt->close();
}
else
{
    $guest_links = [
        'index.php', 'login.php', 'logout.php', 'notEnoughPermissions.php', 'resetPassword.php'
    ];
    
    // logged in
    if(isset($_SESSION[KEY_LOGGED_IN]))
    {
        $user = $_SESSION[KEY_LOGGED_IN];
        
        $q = "SELECT id_amministratore FROM amministratore WHERE email=?";
        $stmt = $dbc->prepare($q);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        
        $stmt_result = $stmt->get_result();
        
        // not found
        if ($stmt_result->num_rows != 1)
        {
            unset($_SESSION[KEY_LOGGED_IN]);
            
            if (!in_array(basename($_SERVER['SCRIPT_NAME']), $guest_links))
            {
                echo '<script type="text/javascript"> window.open("notEnoughPermissions.php' . '" , "_self");</script>';
            }
        }
        
        $stmt->close();
    }
    // Not logged in
    else
    {
        if (!in_array(basename($_SERVER['SCRIPT_NAME']), $guest_links))
        {
            echo '<script type="text/javascript"> window.open("notEnoughPermissions.php' . '" , "_self");</script>';
        }
    }
}

?>

