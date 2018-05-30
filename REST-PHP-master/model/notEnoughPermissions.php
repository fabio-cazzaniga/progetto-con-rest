<?php

$nomesito = "Insufficient Permissions";

include("./auth.php");

?>
<div>
    <h1>Non Autorizzato</h1>
    <p>Non hai abbastanza permessi per visualizzare questa pagina!
        Verrai reindirizzato automaticamente al login!
    </p>
</div>

<?php

echo '<script type="text/javascript"> window.open("../view/login.php' . '" , "_self");</script>';

// TODO: includere footer

?>

</body>
</html>
