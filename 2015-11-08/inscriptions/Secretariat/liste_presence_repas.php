<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $date_repas = $_GET["date_repas"];
	  include('include/fonction_php.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Style3 {
	font-family: Tahoma;
	font-size: 16px;
	position: relative;
	font-weight: bold;

}
.Style11 {
	font-family: Tahoma;
	font-size: 20px;
	position: relative;
	font-weight: bold;
	color: #967236;
}
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
}
-->
</style>
 <link href="/normal.css" rel="stylesheet" type="text/css">
 <style type="text/css">
<!--
.Style8 {color: #FFFFFF}
.Style19 {
	font-family: Tahoma;
	font-size: 12px;
	color: #990000;
	font-style: italic;
}
.Style20 {
	font-size: 12px;
	font-weight: bold;
}
.Style22 {font-size: 14px}
.Style24 {font-size: 12; font-weight: bold; }
body {
	background-color: #EFB554;
}
.Style25 {	font-family: Verdana;
	font-size: 12px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
-->
 </style>
</head>

<body>
<?php
include('../include/base/connexion_serveur.php');
$req_equipe= "  SELECT * FROM equipe ".$_SESSION['where_simple']." order by numero_equipe " ;
$res_equipe= log_mysql_query($req_equipe , $mysql);
# $present=' ".$_SESSION['and']." and present_au_pele=1';
?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
  <tr>
    <td height="200">
		<?php
		$date=maketime($_SESSION['jour_debut_precamp']); ?>
  	<p align="center" class="Style11"><br>
  	<?php echo 'Liste des repas du '.date_fran($date+3600*24*($date_repas-23)). ' : </p>'; ?>
<table width="1200" border="0">
	<tr>
		<td colspan="2" class="Style11">Repas <br><br> </td>
		<td width="178">&nbsp;</td>
		<td width="807">&nbsp;</td>
	</tr>

<!-- **************************************************************   PRESENCE PETIT-DEJ    ******************************************-->
	<tr>
		<td colspan="2" class="Style11">Petit Dej </td>
		<td width="178">&nbsp;</td>
		<td width="807">&nbsp;</td>
	</tr>
	<?php
	
	$compteur=0;
	while ($tabequipe = mysql_fetch_array ($res_equipe))
	if ($tabequipe['index_equipe']!=""){?>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE equipe='".$tabequipe['index_equipe']."'  ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157"><?php echo $tabequipe['numero_equipe'].' - '.$tabequipe['nom_equipe']; ?></td>
		<td class="Style25">
		<?php   
		   	$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE equipe='".$tabequipe['index_equipe']."' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE equipe='".$tabequipe['index_equipe']."' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<?php } ?>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'abs' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">ABS</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type= 'abs' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type= 'abs' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'staff' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">Staff</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type= 'staff' ".$_SESSION['".$_SESSION['and']." and']." ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type= 'staff' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Intendance</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Parcours</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Réparation Vélo</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Technique</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Multi-Media</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Infirmerie</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Secretariat</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ogm' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and'].$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">OGM</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ogm' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and'].$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ogm' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and'].$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ggg' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and'].$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">GGG</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ggg' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and'].$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ggg' ".$_SESSION['and']." and petit_dej_".$date_repas."=1 ".$_SESSION['and'].$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
	  <td colspan="2" class="Style3">Total= <?php echo $compteur; ?></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
		<td colspan="2" class="Style11">Déjeuner</td>
		<td width="178">&nbsp;</td>
		<td width="807">&nbsp;</td>
	</tr>
	<?php
	
	$compteur=0;
	mysql_data_seek($res_equipe,0);
	while ($tabequipe = mysql_fetch_array ($res_equipe))
	{if ($tabequipe['index_equipe']!=""){?>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE equipe='".$tabequipe['index_equipe']."'  ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157"><?php echo $tabequipe['numero_equipe'].' - '.$tabequipe['nom_equipe']; ?></td>
		<td class="Style25">
		<?php   
		   	$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE equipe='".$tabequipe['index_equipe']."' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE equipe='".$tabequipe['index_equipe']."' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<?php }} ?>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'abs' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">ABS</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type= 'abs' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type= 'abs' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'staff' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">Staff</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type= 'staff' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type= 'staff' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Intendance</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Parcours</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present." order by nomV  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Réparation Vélo</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Technique</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Multi-Media</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Infirmerie</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Secretariat</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr> 
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ogm' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and'].$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">OGM</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ogm' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and'].$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ogm' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and'].$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ggg' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and'].$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">GGG</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ggg' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and'].$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ggg' ".$_SESSION['and']." and dejeuner_".$date_repas."=1 ".$_SESSION['and'].$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
	  <td colspan="2" class="Style3">Total= <?php echo $compteur; ?></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
		<td colspan="2" class="Style11">Diner </td>
		<td width="178">&nbsp;</td>
		<td width="807">&nbsp;</td>
	</tr>
	<?php
	
	$compteur=0;
	mysql_data_seek($res_equipe,0);
	while ($tabequipe = mysql_fetch_array ($res_equipe))
	{if ($tabequipe['index_equipe']!=""){?>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE equipe='".$tabequipe['index_equipe']."'  ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157"><?php echo $tabequipe['numero_equipe'].' - '.$tabequipe['nom_equipe']; ?></td>
		<td class="Style25">
		<?php   
		   	$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE equipe='".$tabequipe['index_equipe']."' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE equipe='".$tabequipe['index_equipe']."' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<?php }} ?>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'abs' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">ABS</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type= 'abs' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type= 'abs' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'staff' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">Staff</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type= 'staff' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type= 'staff' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Intendance</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and intendance=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Parcours</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and parcours=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Réparation Vélo</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and velo=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Technique</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and technique=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Multi-Media</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and media=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Infirmerie</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and infirmerie=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">TTV Secretariat</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ttv' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and']." and secretariat=1 ".$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ogm' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and'].$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">OGM</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ogm' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and'].$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ogm' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and'].$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
		<td width="40">		
          <?php   
			   $req="select count(*) FROM `fiche` WHERE type = 'ggg' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and'].$present ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			   $compteur=$compteur+$resultat[0];
			?>
		</td>
		<td width="157">GGG</td>
		<td class="Style25">
		<?php   
			$req_liste= "  SELECT regime,nom_usage,prenom FROM fiche WHERE type = 'ggg' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and'].$present;
		   	$res_liste= log_mysql_query($req_liste , $mysql);
		   	while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ if (strlen(trim($tabres['regime']))>4) echo $tabres['regime']."(".$tabres['nom_usage'].' '.$tabres['prenom'].") " ;}
		?></td>
		<td class="Style25">
		<?php   $req_liste= "  SELECT nom_usage,prenom FROM fiche WHERE type = 'ggg' ".$_SESSION['and']." and diner_".$date_repas."=1 ".$_SESSION['and'].$present." order by nom_usage  " ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  { echo $tabres['nom_usage'].' '.$tabres['prenom'].'; ';}
		?></td>
	</tr>   
	<tr>
	  <td colspan="2" class="Style3">Total= <?php echo $compteur; ?></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	</tr>   		  
	  
    </table></td>


</table>




</body>
</html>
