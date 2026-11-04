<?php
#Arquivos diretorios raizes
#$pastaInterna = "www/certificados/";
$pastaInterna = "";
define('DIRPAGE',"https://certificado.univaco.edu.br/{$pastaInterna}");
if (substr($_SERVER['DOCUMENT_ROOT'],-1) == '/') {
  define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$pastaInterna}");
}else {
  define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}/{$pastaInterna}");
}
define('DS', DIRECTORY_SEPARATOR );
define('DIRIMG',DIRPAGE."public/img/");
define('DIRASSETS',DIRPAGE."public/assets/");
define('DIRCSS',DIRPAGE."public/css/");
define('DIRJS',DIRPAGE."public/js/");
define('DIRADMIN',DIRPAGE."public/admin/");
define('DIRAUDIO',DIRPAGE."public/audio/");
define('DIRDESIGN',DIRPAGE."public/design/");
define('DIRFONT',DIRPAGE."public/font/");
define('DIRVIDEO',DIRPAGE."public/video/");
define('DIRUPLOAD',DIRREQ."public/upload/");

?>
