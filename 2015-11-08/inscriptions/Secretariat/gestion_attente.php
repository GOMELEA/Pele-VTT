<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $type = $_GET["type"];
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
    <LINK rel=stylesheet type="text/css" href="../../total.css">
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


$req_modif_fiche = "UPDATE   `attente`  SET etat_attente='trop tard' WHERE `date_limite_inscription`< '".date('Y-m-d G:i:s')."' and `date_limite_inscription`<>'0000-00-00 00:00:00' and etat_attente<>'inscrit' ;";
$res_insertion =    log_mysql_query($req_modif_fiche  , $mysql );



?>
<table width="1100" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	
	</td>
  </tr>
  <tr>
    <td>
    	<p align="center" class="Style11">Gestion de la liste d'attente </p>
	</td>
  </tr>
  <tr>
    <td>
        <table border="1" align="center" class="titre2_noir">
          <tr>
            <td align="right" border="0">Synthèse</td>
            <td align="center" valign="middle" width="100">Collégiens</td>
            <td align="center" valign="middle" width="100">Collégiennes</td>
            <td align="center" valign="middle" width="100">Staffs</td>
          </tr>
          <tr>
            <td align="right" border="0">Nb de places totales</td>
            <td align="center" valign="middle"><?php echo $_SESSION['max_collegien'];?></td>
            <td align="center" valign="middle"><?php echo $_SESSION['max_collegienne'];?></td>
            <td align="center" valign="middle"><?php echo $_SESSION['max_staff'];?></td>
          </tr>
          <tr>
            <td align="right" border="0">Nb d'inscrits</td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `fiche` WHERE type = 'collegien' and sexe='H' ".$_SESSION['and'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $resultat[0];
				   $nbcollegien=$resultat[0];
				 ?>
            </td>
            <td align="center" valign="middle">
                 <?php 
				   $req="select count(*) FROM `fiche` WHERE type = 'collegien' and sexe='F' ".$_SESSION['and'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $resultat[0];
				   $nbcollegienne=$resultat[0];
				 ?>
            </td>
            <td align="center" valign="middle">
                 <?php 
				   $req="select count(*) FROM `fiche` WHERE type = 'staff' ".$_SESSION['and'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $resultat[0];
				   $nbstaff=$resultat[0];
				 ?>
            </td>
          </tr>
          <tr>
            <td align="right" border="0">Nb de personnes en attente de place</td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `attente` WHERE type_attente = 'collegien' and sexe_attente='H' and etat_attente='attente' ".$_SESSION['and_simple'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $resultat[0];
				 ?>
            </td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `attente` WHERE type_attente = 'collegien' and sexe_attente='F' and etat_attente='attente' ".$_SESSION['and_simple'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $resultat[0];
				 ?>
            </td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `attente` WHERE type_attente = 'staff' and etat_attente='attente' ".$_SESSION['and_simple'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $resultat[0];
				 ?>
            </td>
          </tr>
          <tr bgcolor="#EFB554">
            <td align="right" border="0">Nb de places à proposer</td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `attente` WHERE type_attente = 'collegien' and sexe_attente='H' and etat_attente='place dispo' ".$_SESSION['and_simple'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $_SESSION['max_collegien']-$nbcollegien-$resultat[0];
				 ?>
            </td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `attente` WHERE type_attente = 'collegien' and sexe_attente='F' and etat_attente='place dispo' ".$_SESSION['and_simple'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $_SESSION['max_collegienne']-$nbcollegienne-$resultat[0];
				 ?>
            </td>
            <td align="center" valign="middle">
            	<?php 
				   $req="select count(*) FROM `attente` WHERE type_attente = 'staff' and etat_attente='place dispo' ".$_SESSION['and_simple'] ;
				   $res = log_mysql_query($req , $mysql);
				   $resultat=mysql_fetch_array($res); 
				   echo $_SESSION['max_staff']-$nbstaff-$resultat[0];
				 ?>
            </td>
          </tr>
          <tr>
            <td align="right" border="0">Obligation de passer par la Liste d'attente</td>
            <td align="center" valign="middle"><?php if ($_SESSION['forcage_collegien_attente']==1) echo "Oui"; ?></td>
            <td align="center" valign="middle"><?php if ($_SESSION['forcage_collegienne_attente']==1) echo "Oui"; ?></td>
            <td align="center" valign="middle"><?php if ($_SESSION['forcage_staff_attente']==1) echo "Oui"; ?></td>
          </tr>
        </table>
	</td>
  </tr>
</table>

  <div style=" margin-left: auto; margin-right: auto; background-color: #FFF ; width: 1100px; height: 400px; overflow: auto;">
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td >
    	<?php
		$titre="Collégiens";
		$_type="collegien";
        $_sexe="and sexe_attente='H'";
        $_etat="and (etat_attente='place dispo' or etat_attente='attente') ";
		$_ordre="by date_limite_inscription , date_liste_attente";
		include('include/tableau_attente.php');
		?>
	</td>
  </tr>
  <tr>
    <td >
    	<?php
		$titre="Collégiennes";
		$_type="collegien";
        $_sexe="and sexe_attente='F'";
        $_etat="and (etat_attente='place dispo' or etat_attente='attente') ";
		$_ordre="by date_limite_inscription , date_liste_attente";
		include('include/tableau_attente.php');
		?>
	</td>
  </tr>
  <tr>
    <td >
    	<?php
		$titre="Staff";
		$_type="staff";
        $_sexe="";
        $_etat="and (etat_attente='place dispo' or etat_attente='attente') ";
		$_ordre="by date_limite_inscription , date_liste_attente";
		include('include/tableau_attente.php');
		?>
	</td>
  </tr>
</div>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td >
    	<p align="center" class="Style11">---------- Fiches Archivées par nom ----------</p>
	</td>
  </tr>
  <tr>
    <td >
    	<?php
		$titre="Collégiens";
		$_type="collegien";
        $_sexe="and sexe_attente='H'";
        $_etat="and (etat_attente='supprime' or etat_attente='trop tard' or etat_attente='inscrit') ";
		$_ordre="by nom_attente , prenom_attente";
		include('include/tableau_attente.php');
		?>
	</td>
  </tr>
  <tr>
    <td >
    	<?php
		$titre="Collégiennes";
		$_type="collegien";
        $_sexe="and sexe_attente='F'";
        $_etat="and (etat_attente='supprime' or etat_attente='trop tard' or etat_attente='inscrit') ";
		$_ordre="by nom_attente , prenom_attente";
		include('include/tableau_attente.php');
		?>
	</td>
  </tr>
  <tr>
    <td >
    	<?php
		$titre="Staff";
		$_type="staff";
        $_sexe="";
        $_etat="and (etat_attente='supprime' or etat_attente='trop tard' or etat_attente='inscrit') ";
		$_ordre="by nom_attente , prenom_attente";
		include('include/tableau_attente.php');
		?>
	</td>
  </tr></table>





</body>
</html>
