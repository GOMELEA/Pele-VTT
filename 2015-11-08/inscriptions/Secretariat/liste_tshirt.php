<?php
	session_start(); 
	$type = $_GET["type"];
	$taille = $_GET["taille"];
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
        <td> <p align="center" class="titre2_marron">Liste T-Shirts</p></td>
    </tr>
	<?php
	if ($type<>'')
	{
		echo '
	<tr>
        <td><p class="titre2_marron">Liste des personnes au poste de '.$type.' avec un Tshirt de taille '.$taille.' : </p></td>
    </tr>
	<tr>
        <td>
			<table width="600" border="1" class="titre2_noir" >
				<tr class="Style3">
					<td>Titre</td>
					<td>Nom</td>
					<td>Pr&eacute;nom</td>
					<td>Type</td>
					<td>Age </td>
				</tr>';
		// si pas TTV
		if (strpos("ogm ggg collegien staff abs",$type) !== false)
			$req="SELECT * FROM fiche WHERE taille_teeshirt='".$taille."' and `type`='".$type."' ".$_SESSION['and'].' order by nom_usage';
		// si TTV
		else
			$req="SELECT * FROM fiche WHERE taille_teeshirt='".$taille."' and ".$type."='1' ".$_SESSION['and'].' order by nom_usage';
		$res_liste= log_mysql_query($req , $mysql);
		while ($tabres = mysql_fetch_array ($res_liste))
		{
			$tabres=stripslashes_deep($tabres);
			echo '
				<tr class="titre3_noir">
					<td>'.$tabres['titre'].'</td>
					<td><a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a></td>
					<td>'.$tabres['prenom'].'</td>
					<td>'.$type.'</td>';
					$naissance=mktime(0,0,0,substr($tabres['date_naissance'],5,2),substr($tabres['date_naissance'],8,2),substr($tabres['date_naissance'],0,4));
					$d1 = explode("-", $_SESSION['jour_debut_camp']);
					$date_camp=mktime(0,0,0, $d1[1], $d1[2], $d1[0]);
					$secondes = ($date_camp > $naissance)? $date_camp - $naissance : $naissance - $date_camp;
					$age = date('Y', $secondes) - 1970;
					echo '
					<td>'.$age.'</td>
				</tr>';
		}
		echo '</table>
		</td>
	</tr>';
	}
	?>
	
    <tr>
        <td><p class="titre2_marron">R&eacute;partition des T-Shirts : </p></td>
    </tr>
    <tr>
        <td>
            <table border="1" class="titre2_noir">
                <tr>
                    <td width="110" ></td>
                    <td width="80" ><div align="center">S</div></td>
                    <td width="80" ><div align="center">M</div></td>
                    <td width="80" ><div align="center">L</div></td>
                    <td width="80" ><div align="center">XL</div></td>
                    <td width="80" ><div align="center">XXL</div></td>
                </tr>
                	<?php
		  				$type = array("ogm","ggg","collegien","staff","animateur","abs","parcours","intendance","velo","media","infirmerie","secretariat","technique","priere");
						$taille=array("S","M","L","XL","XXL");
						// Boucle sur le type
						for($s=0;$s < 14;$s++) 
						{
							echo '
				<tr>
                    <td width="110" >'.$type[$s].'</td>';
							// Boucle sur la taille
							for($t=0;$t < 5;$t++) 
							{
								// si pas TTV
								if ($s<6) $req="SELECT COUNT(*) FROM fiche WHERE taille_teeshirt='".$taille[$t]."' and `type`='".$type[$s]."' ".$_SESSION['and'];
								// si TTV
								if ($s>=6) $req="SELECT COUNT(*) FROM fiche WHERE taille_teeshirt='".$taille[$t]."' and ".$type[$s]."='1' ".$_SESSION['and'];
								$res= log_mysql_query($req, $mysql);
								echo '
                    <td width="80" ><div align="center"><a href="liste_tshirt.php?taille='.$taille[$t].'&type='.$type[$s].'">'.mysql_result($res,0).'</a></div></td>';
							}
						echo '
				</tr>';
						}
					?>
                </tr>
            </table>
            <br>
        <br></td>
    </tr>
</table >
</body >
</html >
