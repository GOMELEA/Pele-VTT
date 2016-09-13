<?php
	session_start();
	$_SESSION = array(); // on réécrit le tableau
	session_destroy(); // on détruit le tableau réécrit
	header('Location: http://www.pele-vtt.fr/sommaire_inscription.php?');  
?>