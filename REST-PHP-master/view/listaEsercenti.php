<?php
function visualizzaEsercente($variabile)
{
    ?>
    <?php require __DIR__ . '/parcials/header.php'; ?>
    <body>
    <?php while ($row = mysqli_fetch_array($variabile, MYSQLI_ASSOC)) {

    echo ' 
<u1  style="float: left; padding: 30px"> 
<div class="myTable">
            <div class="product-item">
                <form method="post" style="text-align: center" action="" >
                    <div style="color: black"> <strong>ID:</strong> ' . $row['id_amministratore'] . '</div>
                    <div style="color: black"><strong>Nome:</strong> ' . $row['nome'] . '</div>
                    <div style="color: black"><strong>E-Mail:</strong> ' . $row['email'] . '</div>
                </form>
            </div>
            
</div></u1>';
}
}?>


<!--fine listaEsercenti-->

<?php
include("parcials/footer.php");
?>