<?php

$nomesito = "Reset Password";



?>
<body>
<div>
    <h1>RESET PASSWORD</h1>
    <?php
    
    // Se è stato premuto il pulsante conferma
    if (isset($_POST[KEY_SUBMIT_RESET_PASSWORD])) {
        $errors = [];
        $user = getPostString($dbc, $errors, KEY_RESET_PASSWORD_EMAIL);

        if ($user != null) {
            if (empty($errors)) {
// Genera un token univoco per il reset password
                $q = "SELECT email FROM amministratore WHERE email=?";
                $stmt = $dbc->prepare($q);
                $stmt->bind_param("s", $user);
                $stmt->execute();

                $stmt_result = $stmt->get_result();

                // corrispondenza utente trovata, tentare di inviare la mail di reset password
                if ($stmt_result->num_rows == 1) {
                    $stmt->close();

                    // link viene generato dopo getResetMailBody()

                    // salt is automatically generated in password_hash()
                    $token = password_hash($stmt_result->fetch_array(MYSQLI_NUM)[0], PASSWORD_BCRYPT);

                    // update user entry with generated token
                    $qu = "UPDATE amministratore SET token=? WHERE email=?";
                    $stmt = $dbc->prepare($qu);
                    $stmt->bind_param("ss", $token, $user);
                    $stmt->execute();

                    $stmt->close();

                    // gen link
                    $_SESSION[KEY_LOGINRESET_LINK] = 'login.php?' . KEY_LOGRESET_USERNAME . '=' . $user . '&' . KEY_LOGRESET_TOKEN . '=' . $token;

                    $sent = sendMail($config, 'MySMOWeb - Reset Password', getResetMailBody($dbc, $config));
                    if ($sent) {
                        echo '<p>
                        Un \'email di ripristino della password è stata inviata all\'indirizzo salvato!
                        </p>

                        <a class="btn btn-success btn-full-large" href="dashboardApertamente.php">Torna Indietro</a>
                        ';
                    } else {
                        echo '<p>
                        Invio email non riuscito, riprovare e, se l\'errore persiste, contattare i tecnici!
                        </p>
                        
                        <a class="btn btn-warning btn-full-large" href="dashboardApertamente.php">Torna Indietro</a>
                        ';
                    }
                } else {
                    echo '<p>
                        Utente non trovato, controllare di aver inserito la mail corretta!
                        </p>
                        
                        <a class="btn btn-warning btn-full-large" href="dashboardApertamente.php">Torna Indietro</a>
                        ';
                }
            } else {
                echo '<p>
Utente non trovato, controllare di aver inserito la mail corretta!
</p>

<a class="btn btn-warning btn-full-large" href="dashboardApertamente.php">Torna Indietro</a>
';

                reportErrors($errors, $alert, true);
            }
        } else {
            echo '<p>
                        Utente non trovato, controllare di aver inserito la mail corretta!
                        </p>
                        
                        <a class="btn btn-warning btn-full-large" href="dashboardApertamente.php">Torna Indietro</a>
                        ';
        }
    }
    // Pagina normale, prima che venga premuto il pulsante conferma
    else
    {
        echo '    <p>
        Confermare l\'indirizzo email registrato per resettare la password
    </p>
    <form action="resetPassword.php" method="post">
        <!-- Input Email (Per evitare che qualche malandrino clicchi a caso, devono sapere la mail giusta per inviare la mail di reset password) -->
        <div>
            <span>Email Utente </span>
            <input class="form-control" type="email" maxlength="20" required name="' . KEY_RESET_PASSWORD_EMAIL . '" placeholder="email@gmail.com">
        </div>
        <!-- Pulsante Conferma -->
        <div id="send-reset-pass">
            <input type="submit" class="btn btn-danger btn-full-large" value="Invia" name="' . KEY_SUBMIT_RESET_PASSWORD . '">
        </div>
    </form>';
    }
    ?>
</div>
</body>
</html>
