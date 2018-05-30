var index = 0;
var totale = 1;
var esercenteNonModificatoJSON = "";
<?php echo "esercenteNonModificatoJSON = '" . $output . "';";?>
var esercenteNonModificato = JSON.parse(esercenteNonModificatoJSON);

function aggiungiOpzione() {
    index++;
    totale++;
    var li = document.createElement("li");
    li.className = "mdl-list__item";
    var span = document.createElement("span");
    span.className = "mdl-list__item-primary-content";
    var span2 = document.createElement("mdl-list__item-secondary-action");
    span2.className = "mdl-list__item-secondary-action";
    var div1 = document.createElement("div");
    div1.className = "mdl-textfield mdl-js-textfield";
    var input = document.createElement("input");
    input.className = "mdl-textfield__input";
    input.setAttribute("type", "text");
    input.setAttribute("id", "puntovendita" + index);
    var button = document.createElement("button");
    button.className = "mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-button--mini-fab mdl-button--colored";
    button.setAttribute("onclick", "cancellaOpzione(this)");
    var i = document.createElement("i");
    i.className = "material-icons";
    i.appendChild(document.createTextNode("delete"));
    var label = document.createElement("label");
    label.className = "mdl-textfield__label";
    label.setAttribute("for", "puntovendita" + index);
    label.appendChild(document.createTextNode("Nuovo punto vendita ..."));
    div1.appendChild(input);
    div1.appendChild(label);
    span.appendChild(div1);
    button.appendChild(i);
    span2.appendChild(button);
    li.appendChild(span);
    li.appendChild(span2);
    componentHandler.upgradeDom();
    document.getElementsByClassName("demo-list-control mdl-list")[0].appendChild(li);
    componentHandler.upgradeDom();
}

function cancellaOpzione(obj) {
    if ($(".mdl-list__item").length != 1) {
        obj.parentNode.parentNode.style.display = "none";
        totale--;
    }
    else {
        alert("Non puoi cancellare la prima opzione");
    }

}

function modificaEsercente() {
    if (esercenteNonModificato.email != getEmail()) {
        esercenteNonModificato.email = getEmail();
    }
    if (esercenteNonModificato.nome != getNome()) {
        esercenteNonModificato.nome = getNome();
    }
    if (getFileName() != "/var/uploads") //ho cambiato il file, devo ricaricare l'immagine
    {
        uploadFile();
    }
    esercenteNonModificato.esercizi = getPuntiVendita(); //modifico sempre la lista esercenti per comodità
    var json = JSON.stringify(esercenteNonModificato);
    $.ajax({
        //imposto il tipo di invio dati (GET O POST)
        type: "POST",
        //Dove devo inviare i dati recuperati dal form?
        url: "../backEnd_json/modifica_esercente.php",
        //Quali dati devo inviare?
        data: "esercente=" + json + "&id_amministratore=<?php echo $_GET['id']?>",
        dataType: "html",
        success: function (msg) {
            if (msg != "errore") {
                messaggio("Modifiche apportate correttamente" + msg);
            }
            else {
                messaggio("Errore, le modifiche non possono essere salvate" + msg);
            }

            // messaggio di avvenuta aggiunta valori al db (preso dal file risultato_aggiunta.php) potete impostare anche un alert("Aggiunto, grazie!");
        },
        error: function () {
            messaggio("Errore, impossibile interrogare la pagina"); //sempre meglio impostare una callback in caso di fallimento
        }
    });
}

function getNome() {
    if (document.getElementById("nome").value == "" || document.getElementById("nome").value == "undefined") {
        return "Nome azienda";
    }
    else {
        return document.getElementById("nome").value;
    }
}

function getEmail() {
    if (document.getElementById("email").value == "" || document.getElementById("email").value == "undefined") {
        return "email@gmail.com";
    }
    else {
        return document.getElementById("email").value;
    }
}

function getPuntiVendita() {
    var listaEsercenti = new Array();
    var index = 0;
    var s = $(".demo-list-control").find(".mdl-textfield__input");
    s.each(function () {
        if ($(this).val() == "" || $(this).val() == "undefined") {
            listaEsercenti[index] = "Nuovo punto vendita";
        }
        else {
            listaEsercenti[index] = $(this).val();
        }
        index++;
    });
    return listaEsercenti;
}

function uploadFile() {
    var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $(".mdl-spinner").first().show();
    $(".loading").first().show();
    $.ajax({
        url: '../backEnd_json/upload.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (php_script_response) {
            $(".mdl-spinner").first().hide();
            $(".loading").first().hide();
        }
    });
}

function getFileName() {
    try {
        var fileInput = document.getElementById('file');
        var fileName = fileInput.value.split(/(\\|\/)/g).pop();
        var str = "/var/uploads/" + fileName;
    } catch (err) {
        return "errore";
    }
    return str;
}

function messaggio(testo) {
    var handler = function (event) {
    }
    'use strict';
    var data = {
        message: testo,
        timeout: 2000,
        actionHandler: handler,
        actionText: 'Ok'
    };
    document.querySelector('#demo-snackbar-example').MaterialSnackbar.showSnackbar(data);
}