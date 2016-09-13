<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  if ($_SESSION['index_route']=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
	  $equipe = $_GET["equipe"];
	  $go = $_GET["go"];
	  $action = $_GET["action"];
	  include('include/fonction_php.php');
?><html>
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
		
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Saisie LA FICHE
	if ($action=="sauvegarder" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		include('include/base/saisie_equipe_dans_base.php');

	}
?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
	<tr align="center">
    	<td>
			<?php include('menu.html'); ?><br>
		</td>
	</tr>
	<tr align="center" class="Style11" height="50">
	    <td colspan="2">
  	  		<p>Saisie de la composition des équipes </p>
    	</td>
 	</tr>
	<tr  align="left" class="Style11">
		<form method="GET" action="saisie_equipe.php" >
		<td colspan="2">Nom de l'&eacute;quipe 
            <select name="equipe" id="equipe" onChange="submit();">
             <?
			$resultat2=log_mysql_query("SELECT `index_equipe`,`numero_equipe`,`nom_equipe` FROM `equipe` WHERE `index_equipe`='".$equipe."' ",$mysql) or die ("Requête non executée.");
            $ligne2=mysql_fetch_array($resultat2);
			$ligne2=stripslashes_deep($ligne2);
            echo '<option value="'.$ligne2["index_equipe"].'" selected="selected" >'.$ligne2["numero_equipe"].' '.$ligne2["nom_equipe"].'</option>;';	
            $resultat_index=log_mysql_query("SELECT `index_equipe`,`numero_equipe`,`nom_equipe` FROM `equipe` ".$_SESSION['where_simple']." order by `numero_equipe`",$mysql) or die ("Requête non executée.");
            while ($ligne_index=mysql_fetch_array($resultat_index))
            {
				$ligne=stripslashes_deep($ligne);
				echo '<option value='.$ligne_index["index_equipe"].'>'.$ligne_index["numero_equipe"].' '.$ligne_index["nom_equipe"].'</option>';
            }
            echo '</select>';
            ?>
		</td>
		</form>
 	</tr>
</table>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
	<form  name="formSaisie" method="post" action="saisie_equipe.php?equipe=<?php echo $equipe; ?>&action=sauvegarder">
	<tr  align="left" class="Style11">
		<td colspan="2"><br>Animateurs <br>
		</td>
 	</tr>
	<tr  align="left" class="Style11">
		<td align="center" >Garçons 
		</td>
		<td align="center" >Filles 
		</td>
 	</tr>
	<tr  align="left" valign="top">
		<td align="left" >
		<?php   
			$req="SELECT `equipe`,`index`,`nom_usage`,`prenom` FROM `fiche` WHERE type='animateur'  and titre='Monsieur' ".$_SESSION['and']." and (equipe='' or equipe='".$equipe."') order by `nom_usage`,`prenom` ";
			$resultat=log_mysql_query($req,$mysql) or die ("Requête non executée.");
		   	while ($tabres = mysql_fetch_array ($resultat))
		  	{ 	$tabres=stripslashes_deep($tabres);
		 ?>
			<input id="Cbox_<?php echo $tabres['index']; ?>" name="Cbox_<?php echo $tabres['index']; ?>" value=1  <?php if ($tabres['equipe']==$equipe) echo "checked=\"checked\"";?> type="checkbox">
			<?php echo $tabres['nom_usage'].' '.$tabres['prenom']; ?>
			<BR>
			<?php
			}
			?>
		</td>
		<td align="left" >
		<?php   
			$req="SELECT `equipe`,`index`,`nom_usage`,`prenom` FROM `fiche` WHERE type='animateur'  and titre<>'Monsieur' ".$_SESSION['and']." and (equipe='' or equipe='".$equipe."') order by `nom_usage`,`prenom` ";
			$resultat=log_mysql_query($req,$mysql) or die ("Requête non executée.");
		   	while ($tabres = mysql_fetch_array ($resultat))
		  	{ $tabres=stripslashes_deep($tabres);
		 ?>
			<input id="Cbox_<?php echo $tabres['index']; ?>" name="Cbox_<?php echo $tabres['index']; ?>" value=1  <?php if ($tabres['equipe']==$equipe) echo "checked=\"checked\"";?> type="checkbox">
			<?php echo $tabres['nom_usage'].' '.$tabres['prenom']; ?>
			<BR>
			<?php
			}
			?>
		</td>
	<tr  align="left" class="Style11">
		<td colspan="2"><br>Collégiens <br>
		</td>
 	</tr>
	<tr  align="left" class="Style11">
		<td align="center" >Garçons 
		</td>
		<td align="center" >Filles 
		</td>
 	</tr>
	<tr  align="left" valign="top">
		<td align="left" >
		<?php   
			$req="SELECT `equipe`,`index`,`nom_usage`,`prenom` FROM `fiche` WHERE type='collegien'  and sexe='H' ".$_SESSION['and']." and (equipe='' or equipe='".$equipe."') order by `nom_usage`,`prenom` ";
			$resultat=log_mysql_query($req,$mysql) or die ("Requête non executée.");
		   	while ($tabres = mysql_fetch_array ($resultat))
		  	{ $tabres=stripslashes_deep($tabres);
		 ?>
			<input id="Cbox_<?php echo $tabres['index']; ?>" name="Cbox_<?php echo $tabres['index']; ?>" value=1  <?php if ($tabres['equipe']==$equipe) echo "checked=\"checked\"";?> type="checkbox">
			<?php echo $tabres['nom_usage'].' '.$tabres['prenom']; ?>
			<BR>
			<?php
			}
			?>
		</td>
		<td align="left" >
		<?php   
			$req="SELECT `equipe`,`index`,`nom_usage`,`prenom` FROM `fiche` WHERE type='collegien'  and sexe='F' ".$_SESSION['and']." and (equipe='' or equipe='".$equipe."') order by `nom_usage`,`prenom` ";
			$resultat=log_mysql_query($req,$mysql) or die ("Requête non executée.");
		   	while ($tabres = mysql_fetch_array ($resultat))
		  	{ $tabres=stripslashes_deep($tabres);
		 ?>
			<input id="Cbox_<?php echo $tabres['index']; ?>" name="Cbox_<?php echo $tabres['index']; ?>" value=1  <?php if ($tabres['equipe']==$equipe) echo "checked=\"checked\"";?> type="checkbox">
			<?php echo $tabres['nom_usage'].' '.$tabres['prenom']; ?>
			<BR>
			<?php
			}
			?>
		</td>
	<tr  align="left" class="Style3">
		<td colspan="2"> 
			<br><input id="button3" name="button" type="submit"  value=" Validation "><br><br>
		</td>
 	</tr>
	</form>
</table>
</body>
</html>