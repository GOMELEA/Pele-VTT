<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  $Selection = $_GET["Selection"];
	  if ($_SESSION['index_route']=="" and $Selection=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
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
	font-size: 10px;
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
$condition=" AND annee=".$Selection;
$where_condition=" WHERE route.annee=".$Selection;
?>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?></p>
	</td>
  </tr>
  <tr>
  	<td>  	
		<p align="center" class="Style11">Synthèse du Total des routes de l'année <?php echo $Selection; ?></p>
		<br>
	</td>
  </tr>
  <tr>
    <td><table width="700" border="1">
      <tr class="Style3">
        <td width="135"><div align="center"></div></td>
        <td width="62"><div align="center">H</div></td>
        <td width="60"><div align="center">F</div></td>
        <td width="87"><div align="center">Total</div></td>
        <td width="137"><div align="center">Montant Inscription &euro; </div></td>
        <td width="179" ><div align="center">DVD €</div></td>
      </tr>
      <tr class="Style3">
        <td><div align="left">Coll&eacute;giens</div></td>
        <td><div align="center"> 
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'collegien' and sexe='H' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0].'';
			 ?>
        </div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'collegien' and sexe='F' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0].'';
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'collegien'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'collegien'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement_dvd) AS SOMME  FROM `inscription` INNER JOIN route ON inscription.route_index = route.index_route ".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
				echo $resultat[0].'';			 
			?>
		</div></td>
        </tr>
      <tr class="Style3">
        <td><p align="left">Staff</p>          </td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'staff' and sexe='H' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0].'';
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'staff' and sexe='F'".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0].'';
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'staff' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'staff'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        <td width="179"><div align="center">Soutien &euro; </div></td>
      </tr>
      <tr class="Style3">
        <td colspan="3"><div align="right">GGG</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'ggg' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'ggg'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        <td width="179" rowspan="4" align="center">
	        <?php 
			   $req="select sum(inscription.soutien) AS SOMME  FROM `inscription` INNER JOIN route ON inscription.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat1=mysql_fetch_array($res); 
			   echo $resultat1[0].'';
			 ?>
            <div align="center"></div></td>
      </tr>
      <tr class="Style3">
        <td colspan="3"><div align="right">OGM</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'ogm' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'ogm'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        </tr>
      <tr class="Style3">
        <td colspan="3"><div align="right">Animateurs</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'animateur' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'animateur'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        </tr>
      <tr class="Style3">
        <td colspan="3"><div align="right">TTV</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'ttv' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'ttv'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        </tr>
      <tr class="Style3">
        <td colspan="3"><div align="right">ABS</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'abs' ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE type = 'abs'  ".$condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        <td><div align="center">Montant Encaiss&eacute; &euro; </div></td>
      </tr>
      <tr class="Style3">
        <td colspan="3"><div align="right">Total</div></td>
        <td><div align="center">
			<?php 
			   $req="select count(*) FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
		</div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(reglement) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
        </div></td>
        <td><div align="center">
			<?php 
			   $req="select sum(montant_1) AS SOMME  FROM `inscription`  INNER JOIN route ON inscription.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat1=mysql_fetch_array($res); 
			   $req="select sum(montant_2) AS SOMME  FROM `inscription` INNER JOIN route ON inscription.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat2=mysql_fetch_array($res); 
			   $req="select sum(montant_3) AS SOMME  FROM `inscription` INNER JOIN route ON inscription.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat3=mysql_fetch_array($res); 
			   $req="select sum(liquide) AS SOMME  FROM `inscription` INNER JOIN route ON inscription.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat4=mysql_fetch_array($res); 
			   echo $resultat1[0]+$resultat2[0]+$resultat3[0]+$resultat4[0];
			 ?>
        </div></td>
      </tr>
    </table>
    <blockquote>&nbsp;</blockquote></td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="Style11">R&eacute;partition des TTV : </p>
	</td>
  </tr>
  <tr>
    <td height="55" class="Style3">      <table width="886" border="1">
        <tr>
          <td width="100"><div align="center">Poste</div></td>
          <td width="77"><div align="center">Parcours</div></td>
          <td width="104"><div align="center">Intendance</div></td>
          <td width="89"><div align="center">R&eacute;paration</div></td>
          <td width="114"><div align="center">Multi-Media</div></td>
          <td width="117"><div align="center">Infirmerie</div></td>
          <td width="126"><div align="center">Secr&eacute;tariat</div></td>
          <td width="125"><div align="center">Technique</div></td>
          <td width="125"><div align="center">Prière</div></td>
        </tr>
        <tr>
          <td><div align="center">Nbre TTV </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(parcours) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(intendance) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(velo) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(media) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(infirmerie) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(secretariat) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(technique) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
          <td><div align="center">
			<?php 
			   $req="select sum(priere) AS SOMME  FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route".$where_condition ;
			   $res = log_mysql_query($req , $mysql);
			   $resultat=mysql_fetch_array($res); 
			   echo $resultat[0];
			 ?>
          </div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="12">&nbsp;</td>
  </tr>
</table >
 



</body >
</html >
