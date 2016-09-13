<?php
# Gère les paramètres de connexion à la base Mysql
# Prévoir de refermer la base après appel de cet include avec un "mysql_close();"

# xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     CONNEXION AU SERVEUR        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
$host = 'localhost';
$bdd = 'pelevtt_release';
$user = 'pelevtt';
$pwd = 'p3l3vtt-r0camad0ur';
$port ='';

if (! isset($timeout)) $timeout = 30;
if (! isset($host)) $host = 'localhost';
set_time_limit($timeout);

# xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     test si la connexion est OK       XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

$mysql = mysql_connect($host, $user, $pwd);
if (!$mysql) {
   echo "Impossible de se connecter : " . mysql_error();
   echo "<BR>" ;
   echo "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
   die('');
}

$res = mysql_select_db($bdd, $mysql);
?>
