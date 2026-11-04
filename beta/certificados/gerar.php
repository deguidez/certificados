<?php
    use Dompdf\Dompdf;
    require_once '../../src/vendor/dompdf/autoload.inc.php';
    include("../conexao.php");
    $dompdf = new Dompdf(["enable_remote" => true]);
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

    $num = $result->num_rows;
    
    //print_r($value['template']);

    $texto = "";
			
				$img = '<img src="'.$value['template'].'" style="width:100%;"/>';
				
				if ($value['identificacao_evento'] == 1) {
					$texto .= "<span>Certificamos que </span>";
					$texto .= '<strong><span id="nome"> ' . $value['nome_grupo'] . ' </span></strong>';
					$texto .= '<span>' . $value['texto'] . ' </span>';
					$texto .= '<strong><span id="curso"> ' . $value['condicao'] .' '. $value['tema'] . '</span></strong> ';
					$texto .= ' ' . $value['liga_proj'] . '.<br /><br />';
					$texto .= ' <span style="float: right">Ipatinga, ' . date("d/m/Y", strtotime($value['dia'])) . '</span>';
				} elseif ($value['identificacao_evento'] == 2) {
					$texto .= "<span>Certificamos que </span>";
					$texto .= '<strong><span id="nome"> ' . $value['nome_grupo'] . ' </span></strong>';
					$texto .= '<span> ' . $value['texto'] . ' </span>
					';
					$texto .= '<strong><span id="curso"> ' . $value['condicao'] . ' '.$value['tema'] . '. </span></strong><br/><br />';
					$texto .= ' <span style="float: right"> Ipatinga, ' . date("d/m/Y", strtotime($value['dia'])) . ' </span>';
				} else {
					$texto .= "<h2>Não foi encontrado o certificado </h2>";
				}
			$html = '<title>Certificado Univaço</title><head>
				</head><div style="position:absolute; top:0;left:0; text-align:justify;">'.$img.'
				<style> 
				@font-face {
				font-family: myFirstFont;
				src: url(https://certificado.univaco.edu.br/public/fontes/champagne_limousines/Champagne & Limousines.ttf);
				}

				* {
				font-family: myFirstFont;
				}
				</style>
				<div style="position:absolute; top:30%; left:20px; width:900px;  padding:20px; font-size:16px; font-family: \'myFirstFont\', sans-serif;">';
			$html .= $texto;
			$html .= $value['inicio_fim'];
			$html .= '</div>';
			
				if($value['assProfessor'] != '' ){
					$html .= '<div id="ass" style=" position:absolute;bottom:80px;left:20px;width:350px; height:100px; ">';
					$html .= '<div style="width:50%;position:absolute; top:-20px; left:90px;"><img src="' . $value['assProfessor']. '" style="width:100%;"/></div>';
					$html .= '<div style=" border-top:1px solid #000;margin:40px auto;  padding:10px; width:80%; font-size:14px; text-align:center; font-family: \'myFirstFont\', sans-serif;">
							' . $value['nomeProfessor']. ' 
								<br/>' . $value['cargoProf']. ' 
							
							</div>';
					$html .= '</div>';
				}
				$html .= '<div style="width:25%;position:absolute; bottom:0; left:60px; color:#000; font-family: \'myFirstFont\', sans-serif; font-size:12px">Certificado validado pelo link: <br>https://certificado.univaco.edu.br/beta/validar/index.php?registro='.$value['registro'].'</div>';
				if($value['ass_cor'] != ''){
					

					$html .= '<div id="ass" style=" position:absolute;bottom:80px;right:40px;  width:350px; height:100px; ">';

						$html .= '<div style="width:50%;position:absolute; top:-17px; left:90px;"><img src="'.$value['ass_cor'].'" style="width:90%;"/></div>';
					

						$html .='<div style=" border-top:1px solid #000;margin:40px auto;  padding:10px; width:80%; font-size:14px; text-align:center; font-family: \'myFirstFont\', sans-serif;">
						'.$value['nome_cordenador'].'<br />'.$value['cargoCor'].'
											
								</div>';
					$html .= '</div>';
				}	

			
			$html .= '</div><div style="page-break-after: always;"></div>';

			$html .='<div style="position:absolute; top:0;left:0; text-align:justify;"><img src="'.$value['templateVerso'].'" style="width:100%;"/></div>';
			
			/*print_r($dados);*/
			
			$dompdf->loadHtml($html);

			$dompdf->setPaper('A4', 'landscape');
		
			$dompdf->render();

			
			$dompdf->stream(
				"certificado.pdf",
				array(
					"Attachment" => false //Para realizar o download somente alterar para true
				)
			);

?>