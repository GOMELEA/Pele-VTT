<?php
# Calcul s'il reste de la dispo pour les collégiens et staff et renvoie le résultat dans les variable logiques $_SESSION['dispo_collegien_F'],$_SESSION['dispo_collegien_H'],$_SESSION['dispo_staff']

   include('include/base/connexion_serveur.php');
   $req_dispo="select count(*) FROM `fiche` WHERE `type` = 'collegien' and `sexe` = 'F' and `route_index` = '".$_SESSION['index_route']."' and `corbeille` <> 'oui'"  ;
   $res_libres = log_mysql_query($req_dispo , $mysql);
   $resultat=mysql_fetch_array($res_libres); 
   $nbre_dispo_collegien_F=($_SESSION['max_collegienne']-$resultat[0]);
   if ($nbre_dispo_collegien_F>0)
   		$_SESSION['dispo_collegien_F']=true;
	Else
   		$_SESSION['dispo_collegien_F']=false;
   
   $req_dispo="select count(*) FROM `fiche` WHERE `type` = 'collegien' and `sexe` = 'H'and `route_index` = '".$_SESSION['index_route']."' and `corbeille` <> 'oui'"  ;
   $res_libres = log_mysql_query($req_dispo , $mysql);
   $resultat=mysql_fetch_array($res_libres); 
   $nbre_dispo_collegien_H=($_SESSION['max_collegien']-$resultat[0]);
   if ($nbre_dispo_collegien_H>0)
   		$_SESSION['dispo_collegien_H']=true;
	Else
   		$_SESSION['dispo_collegien_H']=false;

   $req_dispo="select count(*) FROM `fiche` WHERE `type` = 'staff' and `route_index` = '".$_SESSION['index_route']."' and `corbeille` <> 'oui'"  ;
   $res_libres = log_mysql_query($req_dispo , $mysql);
   $resultat=mysql_fetch_array($res_libres); 
   $nbre_dispo_staff=($_SESSION['max_staff']-$resultat[0]);
   if ($nbre_dispo_staff>0)
   		$_SESSION['dispo_staff']=true;
	Else
   		$_SESSION['dispo_staff']=false;
	mysql_close();
?>
