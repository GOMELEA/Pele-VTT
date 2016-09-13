<?php

	if ($_SERVER["REMOTE_USER"]<>"")
		$nom_fichier="/var/www/Jemca/www.pele-vtt.fr/inscriptions/data/_Log/".date("Y-m-d")."-".$_SERVER["REMOTE_USER"]."-"."Diff.sql";
	else 
		$nom_fichier="/var/www/Jemca/www.pele-vtt.fr/inscriptions/data/_Log/".date("Y-m-d")."-".$_SERVER["REMOTE_ADDR"]."-"."Diff.sql";
		
	$fichierDiff = fopen($nom_fichier, "a");
	$log="/***".date("G:i")."|"."http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\n";
	fwrite($fichierDiff, $log);
	fclose($fichierDiff);
?>