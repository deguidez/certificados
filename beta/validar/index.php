<?php
    include('../conexao.php');
    $registro = $_GET['registro'];

    $query ="SELECT 
    tb_certificado.nome_grupo ,
    tb_certificado.id ,
    tb_certificado.dia ,
    tb_certificado.livro ,
    tb_certificado.folha,
    tb_certificado.registro,
    tb_certificado.identificacao_evento,
    tb_certificado.inicio_fim,
    cargo_prof.nome as cargoProf,
    cargo_cor.nome as cargoCor,
    tb_condicao.nome as condicao,
    tb_liga_proj.texto as liga_proj,
    tb_texto.texto as texto,
    tb_tema.nome as tema,
    tb_template.caminho as template,
    tb_template.verso as templateVerso,
    nome_prof.nome as professor,
    ass_prof.nome as nomeProfessor,
    ass_prof.caminho as assProfessor,
    ass_cor.nome as nome_cordenador,
    ass_cor.caminho as ass_cor
    FROM `tb_certificado`
    
    INNER join tb_ass as nome_prof on nome_prof.id = tb_certificado.professor
    INNER join tb_ass as ass_prof on ass_prof.id = tb_certificado.assinatura_prof
    INNER join tb_ass as ass_cor on ass_cor.id = tb_certificado.assinatura_cor
    INNER join tb_condicao on tb_condicao.id = tb_certificado.id_condicao
    INNER join tb_tema on tb_tema.id = tb_certificado.id_tema
    INNER join tb_texto on tb_texto.id = tb_certificado.id_texto
    INNER join tb_template on tb_template.id = tb_certificado.id_modelo
    INNER join tb_liga_proj on tb_liga_proj.id = tb_certificado.liga_proj 
    INNER join tb_cargo as cargo_prof on cargo_prof.id = tb_certificado.idCargoProf
    INNER join tb_cargo as cargo_cor on cargo_cor.id = tb_certificado.idCargoCor
    where tb_certificado.registro = $registro";

    $result = $conn->query($query);

    $value = $result->fetch_assoc();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<link rel="icon" type="image/x-icon" href="../src/img/logo_afya.ico">
    <title>Validação</title>
</head>
<body>
    <div style="background-color: #fc0303;" class="row p-4 sticky-top"></div>

    <div style="width:80%" class="container mt-3 pt-3 ">
        <div class="row ">
            <div class="col-md-10 text-center" style="margin: 0 auto;">
                <img src="https://certificado.univaco.edu.br/public/img/logo/novas/UNIVACO_ENDOSSO_AFYA-11.png" alt="logo" id="logo" style=" width: 60%">
            </div>
        </div>
        <div class="row ">
            <div class="col-md-10 text-center" style="margin: 0 auto;">
                <img src="https://certificado.univaco.edu.br/public/img/validate.png" alt="validate" id="validate" style=" width: 20%">
            </div>
        </div><br><br>
        <div class="row ">
            <div class="col-md-10 text-center" style="margin: 0 auto;">';
    if($value){
        if($value['identificacao_evento'] == 1){

            $html .= '<h3>CERTIFICADO AUTÊNTICO</h3><br><br>

            <span>Certificamos que</span>
            <strong><span id="nome">'.$value['nome_grupo'].'</span></strong>
            <span>'.$value['texto'].'</span><br>
            <strong><span id="curso"> '.$value['condicao'] ." ". $value['tema'].'</span><br>
            </strong>'.$value['liga_proj'].'.<br><br><br>
            <h5>Data da consulta:'.date("d/m/Y").'</h5>';
            
             } elseif ($value['identificacao_evento'] == 2) {

            $html .='<h3>CERTIFICADO AUTÊNTICO</h3><br><br>

            <span>Certificamos que</span>
            <strong><span id="nome"> '.$value['nome_grupo'].'</span></strong>
            <span> '.$value['texto'].'</span><br>
            <strong><span id="curso"> '.$value['condicao'] ." ". $value['tema'].'</span></strong>.<br><br><br>
            
            <h5>Data da consulta:'. date("d/m/Y").'</h5>';
             }
    }else {
        $html .='<h2>Não foi encontrado o certificado </h2>';
     }

    $html .='</div></div></div>';
    
    $html .='
    <script src="https://jornada.univaco.edu.br/src/js/jquery-3.2.1.slim.min.js"></script>
    <script src="https://jornada.univaco.edu.br/src/js/popper.min.js"></script>
    <script src="https://jornada.univaco.edu.br/src/js/bootstrap.min.js"></script>
</body>
<footer style="background-color: #fc0303;" class="p-2 fixed-bottom">
    <p style="color:white; font-size:125%" class="text-center align-items-center font-weight-bold">©Copyright: Univaço 2023</p>
</footer>
</html>';
echo $html;
?>

