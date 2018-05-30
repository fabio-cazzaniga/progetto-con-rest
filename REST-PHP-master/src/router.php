<?php 
//-----------------------------------------Functions to define method behavior---------------------------------//

function get($uri)
{
    $headers = apache_request_headers();
    switch ($uri) {

        case '/login':
            getLogin($headers);
            break;

        case '/resetPassword.php':
            getResetPassword($headers);
            break;

        case '/dashboardApertamente.php':
            getdashboardApertamente($headers);
            break;

        case '/listaEsercenti.php':
            getlistaEsercenti($headers);
            break;

        default:
            echo "è andato in default get";
            notFound();
            break;
    }
}

function post($uri){
    $headers = apache_request_headers();
    switch ($uri) {
        
        case '/login':
            postlogin();
            break;

        case '/dashboardApertamente':
            postdashboardApertamente();
            break;


        default:
            echo "è andato in default post";
            notFound();
            break;
    }
}

function notFound(){
    http_response_code(404);
    echo "404 Classico Not Found";
}

function badRequest(){
    http_response_code(400);
    echo "Method not implemented";
}

//-----------------------------------------Functions to get the work done---------------------------------//


function getLogin($headers){
    if(strpos($headers["Accept"], 'html') !== false) {
        if ($headers = '/login') {
            require __DIR__ . '/../model/auth.php';
            require __DIR__ . '/../model/Object.php';
            faiLogin();
            require __DIR__ . '/../view/login.php';
        }
    }else{
        echo "not find";
    }
}

function getResetPassword($headers){
    if(strpos($headers["Accept"], 'html') !== false) {
        if ($headers = '/resetPassword') {
            require __DIR__ . '/../model/auth.php';
            require __DIR__ . '/../view/resetPassword.php';
        }
    }else{
        echo "not find";
    }
}

function getdashboardApertamente($headers){
    if(strpos($headers["Accept"], 'html') !== false) {
        if ($headers = '/dashboardApertamente') {
            require __DIR__ . '/../view/dashboardApertamente.php';
        }
    }else{
        echo "not find";
    }
}

function getlistaEsercenti($headers){
    if(strpos($headers["Accept"], 'html') !== false) {
        if ($headers = '/login') {
            require __DIR__ . '/../model/Object.php';
            $variabile=ottieniListaEsercente();
            require __DIR__ . '/../view/listaEsercenti.php';
            visualizzaEsercente($variabile);
        }
    }else{
        echo "not find";
    }
}

function postQualcosa(){
    var_dump($_POST);
    //Qui faccio qualcosa con il coso del post
    echo "<br/>ho fatto la post\n";
}

function postLogin()
{
        require __DIR__ . '/../model/auth.php';
        require __DIR__ . '/../view/login.php';
}


function  postdashboardApertamente()
{
            require __DIR__ . '/../view/dashboardApertamente.php';

}

?>