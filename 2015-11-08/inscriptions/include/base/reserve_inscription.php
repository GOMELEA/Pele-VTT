<?php
# Crée une inscription dans la base MySql sur laquelle les fiches pourront être rattachées à la validation finale de l'inscription
	include('connexion_serveur.php');
	$_aujourdhui=date("Y-m-d-G-i-s");
	
	# On stocke dans l'inscription la date, et l'adresse IP
	$req_inscription="INSERT INTO `inscription` (`nom_inscription`,`date_inscription`,`IP`)  VALUES ('RESERVE','".
							$_aujourdhui."','".$_SERVER["REMOTE_ADDR"]."');";
	$res_insertion =    log_mysql_query($req_inscription  , $mysql );
	
	if ( $res_insertion == 1)
	{
	   $req_ident = "SELECT   MAX(`index_inscription`)  FROM `inscription` ";
	   $res_ident =  log_mysql_query($req_ident , $mysql );
	   $tabres2 = mysql_fetch_array ($res_ident);
	   $_SESSION['numero_inscription']= $tabres2[0] ;
	}
	mysql_close();
?>
