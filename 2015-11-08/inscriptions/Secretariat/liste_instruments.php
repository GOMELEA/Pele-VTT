<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
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
?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="Style11">Liste des instruments apportés (trié sur le nom de l'apporteur) : </p>
	<table width="1200" border="0">
      <tr class="Style20">
        <td width="150">Nom</td>
        <td width="150">Pr&eacute;nom</td>
        <td width="150">Type</td>
        <td width="150">Instrument</td>
        <td ></td>
        </tr>
	<?php  
		   $req_liste= "  SELECT * FROM fiche WHERE instrument<>'' ".$_SESSION['and']."  order by nom_usage ; ";
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
		  {$tabres=stripslashes_deep($tabres);
		 ?>
		<tr class="Style25">
		<td align="left"><?php echo '<a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a>'; ?> </td>
		<td align="left"><?php echo '<a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['prenom'].'</a>'; ?> </td>
		<td><?php echo $tabres['type']; ?></td>
		<td><?php echo $tabres['instrument']; ?></td>
		<td></td>
		</tr>
		<?php
		 }
		?>
    </table></td>
  </tr>


</table>




</body>
</html>
