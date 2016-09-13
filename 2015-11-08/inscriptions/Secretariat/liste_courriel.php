<?php
	session_start(); 
	$absent = $_GET["absent"];
	$action = $_GET["action"];
	include('include/fonction_php.php');
	include('../include/base/connexion_serveur.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>
<SCRIPT LANGUAGE="JavaScript">
function confirmation_supprimer_definitivement() 
{
var msg = "Êtes-vous sur de vouloir supprimer définitivement ce courriel ?";
if (confirm(msg))
    return false;
else 
    return true;
}
</SCRIPT>
<?php 
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     supprime le courriel
	if ($action=="supprimer" and ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement'])or $_SERVER["REMOTE_USER"]=="o.lefrancois"))
	{ 
		$req_modif_fiche = "UPDATE fiche INNER JOIN route ON  fiche.route_index=route.index_route  SET courriel_resp='' ".
				" where courriel_resp='".$_POST['courriel_supprime']."' and n_departement='".$_SESSION['n_departement']."'";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql ); 
		$req_modif_fiche = "UPDATE fiche INNER JOIN route ON  fiche.route_index=route.index_route  SET courriel='' ".
				" where courriel='".$_POST['courriel_supprime']."' and n_departement='".$_SESSION['n_departement']."'";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql ); 
		$req_modif_fiche = "UPDATE inscription INNER JOIN route ON  inscription.route_index=route.index_route  SET courriel_inscription='' ".
				" where courriel_inscription='".$_POST['courriel_supprime']."' and n_departement='".$_SESSION['n_departement']."'";
		$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql ); 
	}
?>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	
	</td>
  </tr>
  <tr class="titre3_noir">
    <td>
	    <form  name="supprime_courriel" method="post" onSubmit="confirmation_supprimer_definitivement()" action="liste_courriel.php?action=supprimer">
		Courriel à supprimer dans votre base : 
		<input id="courriel_supprime" name="courriel_supprime" size="50" type="text" >
		<INPUT TYPE="submit"  VALUE="Supprimer">
		</form name="supprime_courriel">
	</td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="titre1_marron">
  	  Liste des courriels : </p>
      <form name="liste_courriel" method="POST" action="liste_courriel.php" >
	<table border="0">
	  <tr class="titre3_noir">
		<td>Courriel</td>
		<td>Titre</td>
		<td>Code Postal</td>
		<td>Type</td>
		<td>Poste</td>
		<td>equipe</td>
		<td>s&eacute;parateur </td>
	  </tr>
	  <tr>
	    <td><select size="1" id="type_courriel" name="type_courriel" onChange="document.forms['liste_courriel'].submit();" >
              <option value="<?php if ($_POST['type_courriel']<>"") echo $_POST['type_courriel']; else echo "Courriel du participant";?>"  selected="selected" ><?php if ($_POST['type_courriel']<>"") echo $_POST['type_courriel']; else echo "Courriel du participant";?></option>
              <option value="Courriel de la personne qui a fait l inscription">Courriel de la personne qui a fait l inscription</option>
              <option value="Courriel de la personne responsable">Courriel de la personne responsable</option>
              <option value="Courriel du participant">Courriel du participant</option>
              <option value="Tous les courriels">Tous les courriels</option>
            	</select></td>
	    <td><select size="1" id="titre" name="titre" onChange="document.forms['liste_courriel'].submit();">
              <option value="<?php if ($_POST['titre']<>"") echo $_POST['titre']; else echo "";?>"  selected="selected" ><?php if ($_POST['titre']<>"") echo $_POST['titre']; else echo "";?></option>
              <option value=""></option>
              <option value="Monsieur">Monsieur</option>
              <option value="Madame">Madame</option>
              <option value="Mademoiselle">Mlle</option>
              <option value="Frere">Fr&egrave;re</option>
              <option value="Pere">P&egrave;re</option>
              <option value="Soeur">Soeur</option>
              <option value="Mgr">Mgr</option>
            	</select></td>
	    <td>
        <?	
			 echo '<select name="cdpostal" id="cdpostal" onChange="document.forms[\'liste_courriel\'].submit();">';
            $resultat=log_mysql_query("SELECT DISTINCT `cdpostal` FROM `fiche` where `route_index`='".$_SESSION['index_route']."' order by `cdpostal` ",$mysql) or die ("Requête non executée.");
            echo  '<option value="';
				if ($_POST['cdpostal']<>"") echo $_POST['cdpostal'];
				else echo "";
			echo '"  selected="selected" >';
				if ($_POST['cdpostal']<>"") echo $_POST['cdpostal'];
				else echo "";
			echo '</option>';
            echo '<option value=""></option>';
            while ($ligne=mysql_fetch_array($resultat))
            {
				$ligne=stripslashes_deep($ligne);
				echo '<option value="'.$ligne["cdpostal"].'">'.$ligne["cdpostal"].'</option>';
            }
            echo '</select>';
		?>
	    <td><select size="1" id="type" name="type" onChange="document.forms['liste_courriel'].submit();">
              <option value="<?php if ($_POST['type']<>"") echo $_POST['type']; else echo "";?>"  selected="selected" ><?php if ($_POST['type']<>"") echo $_POST['type']; else echo "";?></option>
                      <option value=""></option>
					  <option value="ttv">ttv</option>
					  <option value="abs">abs</option>
					  <option value="collegien">collegien</option>
					  <option value="animateur">animateur</option>
					  <option value="staff">staff</option>
					  <option value="ggg">ggg</option>
					  <option value="ogm">ogm</option>
				</select></td>
	    <td><select size="1" id="poste" name="poste" onChange="document.forms['liste_courriel'].submit();">
              <option value="<?php if ($_POST['poste']<>"") echo $_POST['poste']; else echo "";?>"  selected="selected" ><?php if ($_POST['poste']<>"") echo $_POST['poste']; else echo "";?></option>
                      <option value=""></option>
					  <option value="parcours">parcours</option>
					  <option value="intendance">intendance</option>
					  <option value="velo">velo</option>
					  <option value="multi-media">multi-media</option>
					  <option value="infirmerie">infirmerie</option>
					  <option value="secretariat">secretariat</option>
					  <option value="technique">technique</option>
					  <option value="priere">priere</option>
				</select></td>
	    <td>
        <?	
			 echo '<select name="equipe" id="equipe" onChange="document.forms[\'liste_courriel\'].submit();">';
            $resultat=log_mysql_query("SELECT  * FROM `equipe` where `route_index`='".$_SESSION['index_route']."' order by `numero_equipe` ",$mysql) or die ("Requête non executée.");
            echo  '<option value="';
				if ($_POST['equipe']<>"") echo $_POST['equipe'];
				else echo "";
			echo '"  selected="selected" >';
				if ($_POST['equipe']<>"")
				{
					$res=log_mysql_query("SELECT  * FROM `equipe` WHERE index_equipe='".$_POST['equipe']."' and `route_index`='".$_SESSION['index_route']."'  ",$mysql);
					$ligne=mysql_fetch_array($res);
					echo $ligne['numero_equipe'].' - '.$ligne['nom_equipe'];
				}
				else echo "";
			echo '</option>';
            echo '<option value=""></option>';
            while ($ligne=mysql_fetch_array($resultat))
            {
				$ligne=stripslashes_deep($ligne);
				echo '<option value="'.$ligne["index_equipe"].'">'.$ligne["numero_equipe"].' - '.$ligne["nom_equipe"].'</option>';
            }
            echo '</select>';
		?>
    </td>
	    <td><select size="1" id="separateur" name="separateur" onChange="document.forms['liste_courriel'].submit();">
              <option value="<?php if ($_POST['separateur']<>"") echo $_POST['separateur']; else echo "point-virgule";?>"  selected="selected" ><?php if ($_POST['separateur']<>"") echo $_POST['separateur']; else echo "point-virgule";?></option>
					  <option value="virgule">virgule</option>
					  <option value="point-virgule">point-virgule</option>
				</select></td>
	    </tr>
	  <tr class="titre3_noir">
		<td></td>
		<td align="center">Depuis<BR>l'année<BR>>=</td>
		<td align="center">Jusqu'à<BR>l'année<br><=</td>
		<td align="center">Age Min<BR>lors du camp<BR>>=</td>
		<td align="center">Age Max<BR>lors du camp<BR><=</td>
		<td></td>
		<td></td>
	  </tr>
 	  <tr class="titre3_noir">
		<td></td>
		<td align="center"><input id="annee_min"  name="annee_min" size="2" maxlength="4" type="text" value="<?php if ($_POST['annee_min']<>"") echo $_POST['annee_min'];?>" onChange="document.forms['liste_courriel'].submit();"></td>
		<td align="center"><input id="annee_max"  name="annee_max" size="2" maxlength="4" type="text" value="<?php if ($_POST['annee_max']<>"") echo $_POST['annee_max'];?>" onChange="document.forms['liste_courriel'].submit();"></td>
		<td align="center"><input id="age_min"  name="age_min" size="1" maxlength="2" type="text" value="<?php if ($_POST['age_min']<>"") echo $_POST['age_min'];?>" onChange="document.forms['liste_courriel'].submit();"></td>
		<td align="center"><input id="age_max" name="age_max" size="1" maxlength="2" type="text" value="<?php if ($_POST['age_max']<>"") echo $_POST['age_max'];?>" onChange="document.forms['liste_courriel'].submit();"></td>
		<td></td>
		<td></td>
	  </tr>
	  
	  </table>
      
      <table>
      <tr>
		<td width="132">&nbsp;</td>
		<td width="807">&nbsp;</td>
	  </tr>
	  <tr>
		<td class="Style25">Courriel</td>
		<?php
			$req= "SELECT `index`, `courriel`, `courriel_resp`, `courriel_inscription`,`nom_usage`,`prenom` FROM fiche INNER JOIN inscription ON  fiche.fiche_numero_inscription=inscription.index_inscription
											 INNER JOIN route ON  fiche.route_index=route.index_route	";

		   $req=$req. "WHERE route.n_departement='".$_SESSION['n_departement']."' ";
		   if ($_POST['annee_min']=="" & $_POST['annee_max']=="") $req=$req. "and fiche.route_index = ".$_SESSION['index_route']." ";
		   if ($_POST['annee_max']<>"") $req=$req. "and route.annee <= ".$_POST['annee_max']." ";
		   if ($_POST['annee_min']<>"") $req=$req. "and route.annee >= ".$_POST['annee_min']." ";
		   
		   if ($_POST['titre']<>"") $req=$req." and titre='".$_POST['titre']."' ";
		   if ($_POST['cdpostal']<>"") $req=$req." and cdpostal='".$_POST['cdpostal']."' ";
		   if ($_POST['type']<>"") $req=$req." and type='".$_POST['type']."' ";
		   if ($_POST['equipe']<>"") $req=$req." and equipe='".$_POST['equipe']."' ";
		   if ($_POST['age_min']<>"") $req=$req." and (YEAR(DATE_SUB('".$_SESSION['jour_debut_camp']."', INTERVAL TO_DAYS(date_naissance) DAY)) >= ".$_POST['age_min'].") ";
		   if ($_POST['age_max']<>"") $req=$req." and (YEAR(DATE_SUB('".$_SESSION['jour_debut_camp']."', INTERVAL TO_DAYS(date_naissance) DAY)) <= ".$_POST['age_max'].") ";
		   if ($_POST['separateur']=="" or $_POST['separateur']=="point-virgule") $separateur="; "; else $separateur=", ";
		   switch ($_POST['poste'])
		   {
			   	case "parcours" : $req=$req." and parcours='1' "; break;
			   	case "intendance" : $req=$req." and intendance='1' "; break;
			   	case "velo" : $req=$req." and velo='1' "; break;
			   	case "multi-media" : $req=$req." and media='1' "; break;
			   	case "infirmerie" : $req=$req." and infirmerie='1' "; break;
			   	case "technique" : $req=$req." and technique='1' "; break;
			   	case "secretariat" : $req=$req." and secretariat='1' "; break;
			   	case "priere" : $req=$req." and priere='1' "; break;
		   }
		   
			if ($_POST['type_courriel']=="Courriel de la personne responsable") 
			{	
				$req_liste= "SELECT DISTINCT `courriel_resp` FROM ( ".$req." ) tableinter order by courriel_resp DESC";
			}
			elseif ($_POST['type_courriel']=="Courriel de la personne qui a fait l inscription") 
			{	
				$req_liste= "SELECT DISTINCT `courriel_inscription` FROM ( ".$req." ) tableinter order by courriel_inscription DESC";
			}
			elseif ($_POST['type_courriel']=="Tous les courriels")   
			{
				$req_liste= "SELECT DISTINCT `courriel` FROM ( ".$req." ) tableinter1 UNION SELECT `courriel_inscription` FROM ( ".$req." ) tableinter2 UNION SELECT `courriel_resp` FROM ( ".$req." ) tableinter3 ORDER BY `courriel` DESC";
			}
			else   //($_POST['type_courriel']=="Courriel du participant") 
			{
				$req_liste= "SELECT DISTINCT `courriel` FROM ( ".$req." ) tableinter order by courriel DESC";
			}
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   $courriel="";
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ $courriel=$tabres[0].$separateur.$courriel ;}
		?>
		<td><?php echo $courriel; ?></td>
	  </tr>
	  <tr>
		<td class="Style25"><? if ($_POST['type_courriel']<>"Tous les courriels") echo "Sans courriel"; ?> </td>
		<?php
			if ($_POST['type_courriel']=="Courriel de la personne responsable") 
			{	
				$req_liste= "SELECT `index`,`nom_usage`,`prenom` FROM ( ".$req." ) tableinter WHERE `courriel_resp`='' ORDER BY `nom_usage` DESC";
			}
			elseif ($_POST['type_courriel']=="Courriel de la personne qui a fait l inscription") 
			{	
				$req_liste= "SELECT `index`,`nom_usage`,`prenom` FROM ( ".$req." ) tableinter WHERE `courriel_inscription`='' ORDER BY `nom_usage` DESC";
			}
			else   //($_POST['type_courriel']=="Courriel du participant") 
			{
				$req_liste= "SELECT `index`,`nom_usage`,`prenom` FROM ( ".$req." ) tableinter WHERE `courriel`='' ORDER BY `nom_usage` DESC";
			}
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   $courriel="";
		   while ($tabres = mysql_fetch_array ($res_liste))
 		  	{ $courriel='<a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].' '.$tabres['prenom'].'</a>'.$separateur.$courriel ;	 ;}

		?>
		<td><?php if ($_POST['type_courriel']<>"Tous les courriels") echo $courriel; ?></td>
	  </tr> 
      </table>
<br><br>
      
      
      
      </td>
      </form name="liste_courriel">


</table>
</body>
</html>
