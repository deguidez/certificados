<?php
    include('../conexao.php');
    include('../protect.php');
    $pesquisa = $_POST['pesquisa'];
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://certificado.univaco.edu.br/public/css/fontawesome/all.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="../src/img/logo_afya.ico">
        <title>Certificados BETA</title>
    </head>
    <header>
        <div style="background-color: #fc0303;" class="row p-3 justify-content-between text-white sticky-top align-items-center">
            <h1 class="ml-5">Certificados BETA</h1>
        </div>
    </header>
    <body>
        <div style="width:80%" class="container mt-3 align-items-center">
        <div class="container">
            <form action="" method="post">
                <div class="form-row ml-0">
                    <div class="col-sm-9">
                        <input type="text" maxlength="50" class="form-control" id="pesquisa" placeholder="Digite a pesquisa" name="pesquisa">
                    </div>
                    <div class="col-sm-3">
                        <button style="background-color: #fc0303; color:#FFF" id="enviar" type="submit" name=button class="btn">Procurar</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover table-sm table-striped mt-4">
        <thead class="thead">
        <tr>
            <th scope="col">Registro</th>
            <th scope="col">Nome</th>
            <th scope="col">Link de validação</th>
            <th scope="col">PDF</th>
        </tr>
        </thead>
        <tbody>';
        
        if($pesquisa == ""){
            $result = $conn->query("SELECT * FROM tb_certificado WHERE registro <> 0 ORDER BY tb_certificado.registro ASC");
        }
        else{
            $result = $conn->query("SELECT * FROM tb_certificado WHERE registro LIKE \"%$pesquisa%\" OR nome_grupo LIKE \"%$pesquisa%\" ORDER BY tb_certificado.registro ASC");
        }

        foreach ($result as $value) {
            $html .= '<tr>';
            $html .= "<td>" . $value['registro'] . "</td>";
            $html .= "<td>" . $value['nome_grupo'] . "</td>";
            $html .= '<td><a href="../validar/index.php?registro='.$value['registro'].'" target="_blank">Validação</a></td>';
            $html .= '<td class="text-center"><a href="gerar.php?registro='.$value['registro'].'" target="_blank"><i class="far fa-file-pdf text-danger text-center"></i></a></td>';
            $html .= '</tr>';
        } 
        
        $html .='</tbody></table></div><br><br><br><br>';
        
        $html .='
        <script src="https://jornada.univaco.edu.br/src/js/jquery-3.2.1.slim.min.js"></script>
        <script src="https://jornada.univaco.edu.br/src/js/popper.min.js"></script>
        <script src="https://jornada.univaco.edu.br/src/js/bootstrap.min.js"></script>
    </body>
    <footer style="background-color: #fc0303;" class="p-4 fixed-bottom">
        <p style="color:white; font-size:125%" class="text-center align-items-center font-weight-bold">Univaço 2023</p>
    </footer>
    </html>';
    echo $html;
?>