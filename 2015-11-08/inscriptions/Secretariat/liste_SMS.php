<?php
	session_start(); 
	$faire = $_GET["faire"];
	include('include/fonction_php.php');
	include('../include/base/connexion_serveur.php');

	if ($faire=="export")
	{
		$req= "SELECT DISTINCT `tel_mobile`,`nom_usage`,`prenom` FROM fiche INNER JOIN route ON  fiche.route_index=route.index_route	";
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
		 
		$req=$req." and tel_mobile<>'' GROUP BY tel_mobile";
		$res= log_mysql_query($req , $mysql);
		//Boucle sur les resultats
		if ($_POST['appli']=='Android')
		$csv_output= "Name,Number\n";

		while($row = mysql_fetch_array($res)) 
		{
			$tel_mob=str_replace("-","",$row['tel_mobile']);
			$_nom=preg_replace("#[^a-zA-Z ]#", "", OterAccents($row['nom_usage']));
			$_prenom=preg_replace("#[^a-zA-Z ]#", "", OterAccents($row['prenom']));
			if ($_POST['appli']=='Iphone')
				$csv_output .= "$tel_mob,$_nom $_prenom\n";
			else
				$csv_output .= "$_nom $_prenom,$tel_mob\n";
			
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv; filename=".$_POST['titre'].$_POST['cdpostal'].$_POST['type'].$_POST['annee_min'].$_POST['equipe']."export.csv");
		print $csv_output; exit;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>

		
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
  <tr>
    <td>
	<p align="center"><?php include('menu.html'); ?><br></p>	</td>
	</td>
  </tr>
  <tr>
    <td>
  	<p align="center" class="titre1_marron">
  	  Export CSV pour envoie de SMS aux participants </p>
	<p align="center" class="titre2_noir">
		<BR>soit l'appli Iphone <a href="http://www.applicationiphone.com/appstore/productivite/377826584/groupe-sms!-textes-masse-sms/">Group SMS</a> 
		(Petit <a onclick="window.open(this, 'Zazie', 'scrollbars=1,width=1000,height=470'); return false;" href="Video/tuto_SMS.html">Tuto</a> ) 
		<BR>soit l'appli Android <a href="https://play.google.com/store/apps/details?id=com.waxsoft.smslam&hl=fr">SMSlam</a> 
		<BR>Attention, il faut supprimer la première ligne vide du fichier !! Désolé....
	</p>
      
      <form method="POST" action="liste_SMS.php?faire=export" >
        <table border="0" align="center">
	  <tr class="titre3_noir">
		<td>Titre</td>
		<td>Code Postal</td>
		<td>Type</td>
		<td>Poste</td>
		<td>equipe</td>
        <td align="center">Depuis<BR>l'année<BR>>=</td>
		<td align="center">Jusqu'à<BR>l'année<br><=</td>
		<td align="center">Age Min<BR>lors du camp<BR>>=</td>
		<td align="center">Age Max<BR>lors du camp<BR><=</td>

	  </tr>
	  <tr>
	    <td><select size="1" id="titre" name="titre">
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
			 echo '<select name="cdpostal" id="cdpostal">';
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
	    <td><select size="1" id="type" name="type">
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
	    <td><select size="1" id="poste" name="poste">
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
			 echo '<select name="equipe" id="equipe">';
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
    	<td align="center"><input id="annee_min"  name="annee_min" size="2" maxlength="4" type="text" value="<?php if ($_POST['annee_min']<>"") echo $_POST['annee_min'];?>"></td>
		<td align="center"><input id="annee_max"  name="annee_max" size="2" maxlength="4" type="text" value="<?php if ($_POST['annee_max']<>"") echo $_POST['annee_max'];?>"></td>
		<td align="center"><input id="age_min"  name="age_min" size="1" maxlength="2" type="text" value="<?php if ($_POST['age_min']<>"") echo $_POST['age_min'];?>"></td>
		<td align="center"><input id="age_max" name="age_max" size="1" maxlength="2" type="text" value="<?php if ($_POST['age_max']<>"") echo $_POST['age_max'];?>"></td>
	  </tr>
      <tr>
      	<td colspan="9" align="center" height="100">
			<select size="1" id="appli" name="appli">
			<option value="<?php if ($_POST['appli']<>"") echo $_POST['appli']; else echo "Android";?>"  selected="selected" ><?php if ($_POST['appli']<>"") echo $_POST['appli']; else echo "Android";?></option>
			<option value="Iphone">Iphone</option>
			<option value="Android">Android</option>
			</select>
       		<input id="button" name="button" type="submit"  value=" Export ">
       	</td>
 	  </tr>
 
	  </table>
      
      </td>
    </form>


</table>
</body>
</html>
