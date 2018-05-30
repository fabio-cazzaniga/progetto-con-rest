var index = 0;
var totale = 1;

function aggiungiOpzione() {
    index++;
    totale++;

    var li = document.createElement("li");
    li.className = "mdl-list__item ftm";

    var span = document.createElement("span");
    span.className = "mdl-list__item-primary-content spc";

    var div = document.createElement("div");
    div.className = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label";

    var input = document.createElement("input");
    input.className = "mdl-textfield__input";
    input.setAttribute("type", "text");
    input.setAttribute("id", "puntovendita" + index);

    var label = document.createElement("label");
    label.className = "mdl-textfield__label";
    label.setAttribute("for", "puntovendita" + index);
    label.appendChild(document.createTextNode("Nuovo punto vendita ..."));

    var a = document.createElement("a");
    a.className = "mdl-list__item-secondary-action mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect";
    a.setAttribute("onclick", "cancellaOpzione(this)");

    var i = document.createElement("i");
    i.className = "material-icons gr";
    i.appendChild(document.createTextNode("delete"));

    div.appendChild(input);
    div.appendChild(label);
    span.appendChild(div);
    li.appendChild(span);
    a.appendChild(i);
    li.appendChild(a);

    /*metodo javascript per inizializzare i componenti del material design lite*/
    componentHandler.upgradeDom();
    document.getElementById("unli").appendChild(li);
    componentHandler.upgradeDom();
}

function cancellaOpzione(obj) {

    if ($("#unli li").length > 1) {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        totale--;
    } else {
        alert("Devi avere almeno un punto vendita!");
    }

}

function uploadImg() {
    uploadFile();
}

function aggiungiEsercente() {
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var showToastButton = document.querySelector('#demo-show-toast');
    var data = {message: 'Messaggio di prova '};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
}
function ottieniImmagine(percorso)
{
    var array = percorso.split("/");
    return "proxyImage.php?pic="+array[3];
}

/*controllo arrivato qui @valemochuz*/



function aggiungiEsercente() {
    var json = JSON.stringify(new Esercente(getNome(), getEmail(), "aspettandoOTP", getFileName(), getPuntiVendita()));
    $.ajax({
        //imposto il tipo di invio dati (GET O POST)
        type: "POST",
        //Dove devo inviare i dati recuperati dal form?
        url: "../backEnd_json/aggiunta_esercente.php",
        //Quali dati devo inviare?
        data: "esercente=" + json,
        dataType: "html",
        success: function (msg) {
            if (msg != "errore") {
                messaggio("Esercente aggiunto");
            }
            else {
                messaggio("Impossibile aggiungere esercente");
            }

            // messaggio di avvenuta aggiunta valori al db (preso dal file risultato_aggiunta.php) potete impostare anche un alert("Aggiunto, grazie!");
        },
        error: function () {
            alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
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
            document.getElementById("topcard").className += " topcard";
            document.getElementById("topcard").style.backgroundImage = "url('"+ottieniImmagine(getFileName())+"')";
            componentHandler.upgradeDom();
        }
    });
}

function getFileName() {
    var fileInput = document.getElementById('file');
    var fileName = fileInput.value.split(/(\\|\/)/g).pop();
    var str = "/var/uploads/" + fileName;
    return str;
}

function messaggio(testo) {
    var handler = function (event) {
    }
    'use strict';
    var data = {
        message: testo,
        timeout: 3000,
        actionHandler: handler,
        actionText: 'Ok'
    };
    document.querySelector('#demo-snackbar-example').MaterialSnackbar.showSnackbar(data);
}
