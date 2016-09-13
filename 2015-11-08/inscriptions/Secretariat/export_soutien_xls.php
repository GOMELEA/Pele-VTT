<?php

// ************************************************* CHARGEMENT DES SOUTIENS  ****************************************************************
session_start(); 
include("../include/base/connexion_serveur.php");
include('include/fonction_php.php');


# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de mise à jour         XXXXXXXXXXXXXXXXXXXXXxXXX
$_aujourdhui=date("Y-m-d");
$_requette = "UPDATE   `soutien`  SET date_impression = '" . $_aujourdhui ."' ".$_SESSION['where_soutien']."";
$res_insertion =    log_mysql_query($_requette  , $mysql );

$req="select * FROM `soutien` ".$_SESSION['where_soutien']."";
$res = log_mysql_query($req , $mysql);

//Premiere ligne = nom des champs (si on en a besoin)
$csv_output .= "Route;Année;Type;Saisi par; Société;Titre;Nom;Prenom;Adresse 1;Adresse 2;Adresse 3; Code Postal;Ville;".
				"Pays;Courriel;Téléphone;Mobile;Observations;Date d'impression\n";
//Boucle sur les resultats
while($row = mysql_fetch_array($res)) 
{
$csv_output .= "$row[departement];$row[annee];$row[type];$row[saisi_par];$row[societe];$row[titre];$row[nom];$row[prenom];".
				"$row[adresse_1];$row[adresse_2];$row[adresse_3];$row[cdpostal];$row[ville];$row[pays];$row[courriel];$row[telephone];".
				"$row[tel_mobile];$row[observations];$row[date_impression]\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=export.csv");
print $csv_output;


   
?>


