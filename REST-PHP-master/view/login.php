<?php

$nomesito = "Login";
handleAlerts($alert);


?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Material Design Lite -->
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Material Design icon font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!--Link al file CSS -->
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css"/>
        <link rel="stylesheet" type="text/css" href="../src/css/styleClass.css">

        <title>Login MySmartOpinion</title>

    </head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <main class="mdl-layout__content">
    <div class="page-content">

    <style>

        .demo-card-wide.mdl-card {
            width: 512px;
            height: 359px;
            margin: auto;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .demo-card-wide > .mdl-card__title, form .mdl-card__title {
            color: #fff;
            background-color: rgb(63, 81, 181);
        }

        .mdl-textfield {
            position: relative;
            font-size: 16px;
            display: inline-block;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding: 20px 0;
        }

        .mdl-card__supporting-text {
            color: rgba(0, 0, 0, .54);
            font-size: 1rem;
            line-height: 18px;
            overflow: hidden;
            padding: 16px;
            width: auto;
        }

        .mdl-button.mdl-button--colored {
            color: white;
            margin: auto;
        }

        .mdl-button {
            color: white;
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0;
            cursor: pointer;
            text-align: center;
            line-height: 36px;
        }

    </style>

    <script type="text/javascript" src="../public/aggEsScript.js"></script>

    <div class="demo-card-wide mdl-card mdl-shadow--2dp">

    <div class="mdl-card__title" style="height: 120px;">
        <h2 class="mdl-card__title-text">Login MySmartOpinion</h2>
    </div>
        <form action="/dashboardApertamente" method="post">
            <div class="mdl-card__supporting-text" style="height: 150px">

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="email" id="nome" required name="<?php echo KEY_LOGIN_USERNAME?>">
                    <label class="mdl-textfield__label" for="nome">Username</label>
                </div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="pass" required name="<?php echo KEY_LOGIN_PASSWORD?>">
                    <label class="mdl-textfield__label" for="pass">Password</label>
                </div>

            </div>
            <div id="demo-snackbar-example" class="mdl-js-snackbar mdl-snackbar">
                <div class="mdl-snackbar__text"></div>
                <button class="mdl-snackbar__action" type="button"></button>
            </div>

            <div class="mdl-card__title">
                <input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="logsubmit" type="submit" name="<?php echo KEY_LOGIN_SUBMIT?>" value="Sign In">
            </div>
        </form>
        <p class="reset-pass"><a href="resetPassword.php">Recupera password</a></p>