<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

include('../../../include/base/connexion_serveur.php');
include('../fonction_php.php');

echo 'Début Dump';
$entete = "-- ----------------------\n";
$entete .= "-- dump de la base ".$base." au ".date("d-M-Y")."\n";
$entete .= "-- ----------------------\n\n\n";
$creations = "";
$insertions = "\n\n";

$listeTables = log_mysql_query("show tables", $mysql);
while($table = mysql_fetch_array($listeTables))
{
	$creations .= "-- -----------------------------\n";
	$creations .= "-- creation de la table ".$table[0]."\n";
	$creations .= "-- -----------------------------\n";
	$listeCreationsTables = log_mysql_query("show create table ".$table[0], $mysql);
	while($creationTable = mysql_fetch_array($listeCreationsTables))
	{
	  $creations .= $creationTable[1].";\n\n";
	}
	$donnees = log_mysql_query("SELECT * FROM ".$table[0], $mysql);
	$insertions .= "-- -----------------------------\n";
	$insertions .= "-- insertions dans la table ".$table[0]."\n";
	$insertions .= "-- -----------------------------\n";
	while($nuplet = mysql_fetch_array($donnees))
	{
		$insertions .= "INSERT INTO ".$table[0]." VALUES(";
		for($i=0; $i < mysql_num_fields($donnees); $i++)
		{
		  if($i != 0)
			 $insertions .=  ", ";
			 $insertions .=  "'";
		  	$insertions .= addslashes($nuplet[$i]);
			$insertions .=  "'";
		}
		$insertions .=  ");\n";
	}
	$insertions .= "\n";
}
$nom_fichier="../../../data/_SaveSQL/".date("Y-m-d--G:i").".sql";
echo 'Ouverture fichier'.$nom_fichier;
$fichierDump = fopen($nom_fichier, "wb");
fwrite($fichierDump, $entete);
fwrite($fichierDump, $creations);
fwrite($fichierDump, $insertions);
fclose($fichierDump);
echo 'Dump OK';
?>