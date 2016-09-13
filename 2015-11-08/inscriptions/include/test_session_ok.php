<?php
// ************************************************* Test si la Session a déjà été tué  ****************************************************************
if ($_SESSION['index_route']=="") 
{
	echo "Votre inscription a d&eacute;j&agrave; &eacute;t&eacute; envoy&eacute;e au serveur "  . "<BR>" ;
	echo "<BR>" ;
	echo '<a href="../../sommaire_inscription.php">Merci de vous rediriger vers l\'accueil</a> ';
	die();
	
}
?>