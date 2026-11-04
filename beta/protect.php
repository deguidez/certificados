<?php
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://jornada.univaco.edu.br/src/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://jornada.univaco.edu.br/src/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://certificado.univaco.edu.br/public/css/fontawesome/all.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="../src/img/logo_afya.ico">
        <title>Permissão negada</title>
    </head>
    <header>
        <div style="background-color: #fc0303;" class="row p-3 justify-content-between text-white sticky-top align-items-center">
            <h1 class="ml-5">Certificados BETA</h1>
        </div>
    </header>
    <body>
        <div class="container text-center mt-5">
            <h2>Você não pode acessar esta página poque não está logado.</h2><br>
            <p>
                <a style="background-color: #fc0303; color:white;" class="btn" href = "../../restrict/login">
                    Entrar
                </a>
            </p>
        </div>
        
    </body>
    <footer style="background-color: #fc0303;" class="p-4 fixed-bottom">
        <p style="color:white; font-size:125%" class="text-center align-items-center font-weight-bold">Univaço 2023</p>
    </footer>
    </html>';

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        die($html);
    }

?>