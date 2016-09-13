<?php 
# <!-- Gère les sauvegardes, modifications, suppression des fiches -->

session_start(); 
$type = $_GET["type"];
$faire = $_GET["faire"];
$index = $_GET["index"];
include('Secretariat/include/fonction_php.php');
include('Secretariat/include/log_url.php');     
include('include/test_session_ok.php'); // ** Test si la Session a déjà été tué  *************
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../total.css">
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">
function confirmation(index) 
{
	var msg = "Êtes-vous sur de vouloir supprimer ce participant ?";
	if (confirm(msg))
	location.replace('valid_inscription.php?index='+index+'&faire=supprimer');
}
</SCRIPT>

<?php
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     SUPPRIME LA FICHE
if ($faire=="supprimer")
{ 
	include('include/base/connexion_serveur.php');
	include('include/base/supprimer_fiche.php');
}
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     MODIFIE LA FICHE
elseif ($faire=="modifier")
{ 
	include('include/base/connexion_serveur.php');
	include('include/base/copie_variable_post.php');
	include('include/base/update_fiche.php');
}
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Saisie le nombre de DVD
elseif ($faire=="recalculer")
{ 
	$_SESSION['qte_dvd']=$_POST['qte_dvd'];
}
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     CREE LA FICHE
elseif ($faire=="sauver")
{
	include('include/base/connexion_serveur.php');
	# vérifie que la fiche n'a pas déjà été créée, pour éviter de démultiplier une fiche si le participant fait "recalculer la page"
	# $_SESSION['fiche_faite'] est passé à OK lors du remplissage de la fiche - Permet de savoir s'il s'agit d'un recalculer ou d'une vrai demande de sauvegarde
	$req="select count(*) FROM `fiche` WHERE nom_usage = '".mysql_real_escape_string(strtoupper($_POST['nom_usage']))."' and prenom = '".
		mysql_real_escape_string (ucwords(strtolower($_POST['prenom'])))."' and route_index = '".$_SESSION['index_route']."'" ;
	$res = log_mysql_query($req , $mysql);
	$resultat_doublon=mysql_fetch_array($res); 
	if (($resultat_doublon[0]<>"0") and ($_SESSION['fiche_faite']=="OK") )
	{
	echo "<script>alert(\"Cette personne : ".(strtoupper($_POST['nom_usage']))." ".ucwords(strtolower($_POST['prenom']))." est déjà inscrite sur cette route,".
		" vous ne pouvez pas l\'inscrire de nouveau. En cas de problème, envoyez nous un courriel à : ".$_SESSION['courriel_expediteur'].". Merci  \")</script>";
	$_SESSION['fiche_faite']="";
	} 
	# vérifie qu'un collégien ou un staff n'est pas déjà inscrit sur une autre route à la même date
	$req="select n_departement,jour_debut_camp,jour_fin_camp FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route 
			WHERE (type='collegien' or type='staff') and nom_usage = '".mysql_real_escape_string(strtoupper($_POST['nom_usage'])).
			"' and prenom = '".mysql_real_escape_string (ucwords(strtolower($_POST['prenom'])))."' and date_naissance = '".$_POST['date_naissance']."' and annee='".date('Y')."' " ;
	$res = log_mysql_query($req , $mysql);
	$resultat_deja_inscrit=mysql_fetch_array($res); 
	if ((convdate($resultat_deja_inscrit['jour_debut_camp'])>=convdate($_SESSION['jour_debut_camp']) and convdate($resultat_deja_inscrit['jour_debut_camp'])<=convdate($_SESSION['jour_fin_camp'])) or
		(convdate($resultat_deja_inscrit['jour_fin_camp'])>=convdate($_SESSION['jour_debut_camp']) and convdate($resultat_deja_inscrit['jour_fin_camp'])<=convdate($_SESSION['jour_fin_camp'])))
	{
		$deja_inscrit="Oui";
		if ($_SESSION['fiche_faite']=="OK")
			echo "<script>alert(\"Cette personne : ".ucwords(strtolower($_POST['prenom']))." ".(strtoupper($_POST['nom_usage']))." est déjà inscrite sur la route du ".
			$resultat_deja_inscrit['n_departement'].", vous ne pouvez pas l\'inscrire de nouveau sur la route du ".$_SESSION['n_departement'].
			". En cas de problème, envoyez nous un courriel à  ".$_SESSION['courriel_expediteur'].". Merci  \")</script>";
	}
	else $deja_inscrit="Non";
	$_SESSION['fiche_faite']="";	

	if ($resultat_doublon[0]=="0" and $deja_inscrit=="Non" )
	{   if (!isset($_SESSION['numero_inscription'])) include('include/base/reserve_inscription.php'); // Réserve le N° d'inscription si cela n'a pas été fait
		include('include/base/connexion_serveur.php');
		include('include/base/copie_variable_post.php');
		include('include/base/sauve_fiche.php');
		if (
			($_type="staff" and $_SESSION['code_confidentiel_staff_OK']==true)
			or ($_type="collegien" and $_sexe="F" and $_SESSION['code_confidentiel_collegienne_OK']==true)
			or ($_type="collegien" and $_sexe="H" and $_SESSION['code_confidentiel_collegien_OK']==true)
			)
		{
			$tab['observation_attente']=date('j/n/Y à G:i:s')." : Inscription définitive \n".$tab['observation_attente'];
			$req_modif_fiche = "UPDATE   `attente`  SET code_confidentiel='',etat_attente='inscrit', index_inscription='".$_SESSION['numero_inscription']."',observation_attente='" . $tab['observation_attente'].
								"' WHERE `index_attente`= '".$_SESSION['index_attente']."' ;";
			$res_insertion =log_mysql_query($req_modif_fiche  , $mysql );
			$_SESSION['index_attente']='';
			if ($_type="staff") 					$_SESSION['code_confidentiel_staff_OK']="";
			if ($_type="collegien" and $_sexe="F") 	$_SESSION['code_confidentiel_collegienne_OK']="";
			if ($_type="collegien" and $_sexe="H") 	$_SESSION['code_confidentiel_collegien_OK']="";
		}

	}
}

?>
<!-- Table utilisée pour la mise en page générale -->
<table width="1010" border="0" align="center" bgcolor="#FFFFFF">
    <tr>
        <td colspan="7" align="center">
			<?php include('include/bandeau_route.php'); ?>
            <br><img src="Photo/2controle.jpg" width="467" height="62"><br>
		</td>
  	</tr>
  	<tr class="titre2_anthracite">
        <td width="60" height="75" bgcolor="#FFFFFF"></td>
        <td width="227" align="center" bgcolor="#EFB554"><strong>Ajoutez des inscriptions </strong></td>
        <td width="89" align="center" valign="middle" bgcolor="#EFB554"><a href="inscription_pelevtt.php?faire=copier"><img src="Photo/panier.gif" width="50" height="50" border="0"></a></td>
        <td width="106" bgcolor="#FFFFFF"></td>
        <td width="385" valign="middle" bgcolor="#EFB554" align="center" ><strong>Une fois, toutes vos personnes inscrites, <br>
        continuez votre inscription</strong></td>
        <td width="75" ><a href="fin_inscription.php"><img src="Photo/fleche.gif" width="75" height="75" border="0"></a></td>
        <td width="38" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
        <td height="20" colspan="7" ></td>
  	</tr>
</table>


<!-- Affichage des fiches d'inscription avec possibilité de supprimer ou de modifier -->
<table width="1010" border="0" align="center" bgcolor="#FFFFFF">
	<tr>
    	<td>
    <table width="950" border="1" align="center"  bordercolor="#b4883d" style="font-weight:bold; font-family:Verdana, Geneva, sans-serif; font-size:14px">
              <!-- Titre des collones -->
                <tr align="center" valign="middle">
                    <td width="90">Inscription</td>
                    <td width="240">Nom</td>
                    <td width="240">Pr&eacute;nom</td>
                    <td width="110">R&eacute;glement<br> (&euro;) </td>
                    <td width="90">Modifier</td>
                    <td width="90">Dupliquer</td>
                    <td width="90">Supprimer</td>
                </tr>
                <?php
                include('include/base/connexion_serveur.php');
                $mydb  = mysql_select_db($bdd, $mysql);
                $_numero=$_SESSION['numero_inscription'];
                $req_liste_1  = " SELECT `type`,`nom_usage`,`prenom`,`reglement`,`index`   FROM `fiche` WHERE fiche_numero_inscription = $_numero order by `type` ;" ;
                $res_liste_1   = log_mysql_query($req_liste_1  , $mysql);
                while ($tabres = mysql_fetch_array ($res_liste_1))
                { $tabres=stripslashes_deep($tabres);?>
                    <!-- Affichage de chaque inscrit -->
                    <tr height="46" align="center" valign="middle" bgcolor="#FFFFFF" bordercolor="#b4883d" style="font-weight: normal;">
                        <td>
                            <?php  echo '<img src="Photo/inscription_'.$tabres['type'].'_petit.jpg" width="100" height="25" border="1">';?>
                        </td>
                        <td><?php echo stripslashes($tabres['nom_usage']); ?></td>
                        <td><?php echo stripslashes($tabres['prenom']); ?></td>
                        <td><?php echo $tabres['reglement']; ?></td>
                        <td><a href="inscription.php?type=<?php echo $tabres[0]; ?>&index=<?php echo $tabres['index']; ?>&faire=modifier"><img src="Photo/modifier.jpg" border="0" ></a></td>
                        <td><a href="inscription_pelevtt.php?index=<?php echo $tabres['index']; ?>&faire=copier"><img src="Photo/copy.png" border="0" ></a></td>
                        <td><img src="Photo/corbeille.jpg" onClick='confirmation(<?php echo $tabres['index']; ?>);' border="0" ></td>
                    </tr>
                <?php
                }
                # Dans le cas ou la route commercialise un DVD, gestion de la commande
                if ($_SESSION['cout_dvd']<>'0')
                {	echo'
                <form  name="qteDVD" method="post" action="valid_inscription.php?faire=recalculer" >
                <tr height="46" align="center" valign="middle" style="font-weight: normal;">
                      <td colspan="2"><div align="left">'.$_SESSION['dvd_text'].'</div></td>
                      <td>Qt&eacute; :    
                        <input id="qte_dvd" name="qte_dvd" size="3" maxlength="3" type="text" value="'.$_SESSION['qte_dvd'].'">
                        <input id="button" name="button" type="submit"  value="OK"></td>
                      <td>'.($_SESSION['cout_dvd']*$_SESSION['qte_dvd']).'</td>
                      <td colspan="3">&nbsp;</td>
                </tr>
                </form>';
                }
                ?>
                <!-- Affichage du réglement total -->
                <tr height="46" align="center" valign="middle">
                    <td >&nbsp; </td>
                    <td colspan="2">Total R&eacute;glement </td>
                    <td>
                    <?php
                        $req_dispo="select sum(reglement) AS SOMME FROM `fiche` WHERE fiche_numero_inscription = $_numero" ;
                        $res_libres = log_mysql_query($req_dispo , $mysql);
                        $resultat=mysql_fetch_array($res_libres); 
                        echo ($resultat[0]+($_SESSION['cout_dvd']*$_SESSION['qte_dvd']));
                        $_SESSION['reglement_total']=($resultat[0]+($_SESSION['cout_dvd']*$_SESSION['qte_dvd'])); ?> 
                     </td>
                    <td colspan="3" >&nbsp;</td>
                </tr>
            </table>	
		</td>
	</tr>
</table>

<table width="1010" border="0" align="center" bgcolor="#FFFFFF">
    <tr>
        <td height="20" colspan="7" ></td>
  	</tr>
  	<tr class="titre2_anthracite">
        <td width="60" height="75" bgcolor="#FFFFFF"></td>
        <td width="227" align="center" bgcolor="#EFB554"><strong>Ajoutez des inscriptions </strong></td>
        <td width="89" align="center" valign="middle" bgcolor="#EFB554"><a href="inscription_pelevtt.php?faire=copier&index=<?php echo $index;?>"><img src="Photo/panier.gif" width="50" height="50" border="0"></a></td>
        <td width="106" bgcolor="#FFFFFF"></td>
        <td width="385" valign="middle" bgcolor="#EFB554" align="center" ><strong>Une fois, toutes vos personnes inscrites, <br>
        continuez votre inscription</strong></td>
        <td width="75" ><a href="fin_inscription.php"><img src="Photo/fleche.gif" width="75" height="75" border="0"></a></td>
        <td width="38" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
        <td height="20" colspan="7" ></td>
  	</tr>
</table>

<table width="1010" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
        <td align="center"><img src="Photo/2controle.jpg" width="467" height="62"></td>
  </tr>
</table>
<br><br>
</body>
</html>
