<?php
	session_start(); 
	$absent = $_GET["absent"];
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
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
    <tr>
        <td> <p align="center" class="titre2_marron">Liste de tous les participants <?php if ($absent=="oui") echo 'Inscrits mais pas présents'; ?> par Ordre Alphab&eacute;tique </p><br></td>
    </tr>
    <tr>
        <td>
            <table width="1190" bordercolor="#999999" bgcolor="#EEEEEE" >
                <thead class="titre2_noir">
                <tr>
                    <td colspan="4"><div align="center">Participant</div></td>
                    <td colspan="5"><div align="center">Responsable</div></td>
                </tr>
                <tr>
                    <td>Inscr.</td>
                    <td>Nom</td>
                    <td>Pr&eacute;nom</td>
                    <td>Fonction</td>
                    <td>Nom</td>
                    <td>Pr&eacute;nom</td>
                    <td>Tel 1</td>
                    <td>Tel 2</td>
                    <td>Lien</td>
                </tr>
                </thead>
	<?php   
        $req_liste= "  SELECT * FROM fiche  ".$_SESSION['where']." order by nom_usage,prenom" ;
		if ($absent=="oui") $req_liste= "  SELECT * FROM fiche WHERE present_au_pele <>'1'  ".$_SESSION['and']." order by nom_usage,prenom" ;
        $res_liste= mysql_query($req_liste , $mysql);
		$cpt=0;
        while ($tabres = mysql_fetch_array ($res_liste))
        {
            $tabres=stripslashes_deep($tabres);
			if ($cpt%2 == 1) $couleur_de_fond="#EEEEEE";
			else $couleur_de_fond="#CCCCCC";
			$cpt=$cpt+1;
            echo '
                <tr class="titre3_anthracite_sans_fond" bgcolor="'.$couleur_de_fond.'">
					<td><a href="secretariat_inscription.php?Selection='.$tabres['fiche_numero_inscription'].'&go=Afficher">'.$tabres['fiche_numero_inscription'].'</a></td>
					<td><a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a></td>
					<td>'.$tabres['prenom'].'</td>
					<td>';
						If ($tabres['gg']==1)  echo "GG "; 
						echo $tabres['type']; 
						If ($tabres['equipe']!="") 
						{
							$res1=mysql_query(" SELECT nom_equipe FROM equipe WHERE index_equipe='".$tabres['equipe']."'", $mysql);
							$equip=mysql_fetch_array ($res1);
							echo " - " .$equip['nom_equipe'];
						}
						If ($tabres['parcours']==1)  echo " Parcours"; 
						If ($tabres['intendance']==1)  echo " Intendance"; 
						If ($tabres['velo']==1)  echo " Réparation  Vélo"; 
						If ($tabres['media']==1)  echo " Multi-Média"; 
						If ($tabres['secretariat']==1)  echo " Secretariat"; 
						If ($tabres['technique']==1)  echo " Technique "; 
						If ($tabres['infirmerie']==1)  echo " Infirmerie "; echo '</td>
					<td>'.$tabres['nom_resp'].'</td>
					<td>'.$tabres['prenom_resp'].'</td>
					<td>';
						if ($tabres['tel_mobile_resp']<>"") {echo $tabres['tel_mobile_resp'];} else {echo $tabres['tel_mobile_resp2'];}
						echo '</td>
					<td>';
						if ($tabres['tel_mobile_resp2']<>"") {echo $tabres['tel_mobile_resp2'];} else {echo $tabres['telephone_resp'];}
						echo '</td>
					<td>'.$tabres['lien_personne'].'</td>
                </tr>';
			if ($tabres['prenom_autre']<>"" or $tabres['nom_autre']<>"")
			{
				if ($cpt%2 == 1) $couleur_de_fond="#EEEEEE";
				else $couleur_de_fond="#CCCCCC";
				$cpt=$cpt+1;
				echo '
					<tr class="titre3_anthracite_sans_fond" bgcolor="'.$couleur_de_fond.'">
						<td  colspan="4" align="right"><strong>Autre Resp : </strong> </td>
						<td>'.$tabres['nom_autre'].'</td>
						<td>'.$tabres['prenom_autre'].'</td>
						<td>'.$tabres['tel_mobile_autre'].'</td>
						<td>'.$tabres['tel_mobile_autre2'].'</td>
						<td></td>
					</tr>';
			}
		 }
	?>
            </table>
		</td>
	</tr>
</table>
</body>
</html>
