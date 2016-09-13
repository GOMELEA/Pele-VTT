<?php
	session_start(); 
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
        <td> <p align="center" class="titre2_marron">Liste des personnes non-inscrit à la DDCS </p>
        	 
        </td>
    </tr>
    
    <tr style="page-break-before:always">
        <td> <p align="center" class="titre2_marron"><br>Liste des Majeurs non inscrits</p><br>
        </td>
    </tr>
    <tr>
        <td>
            <table align="center" bordercolor="#999999" bgcolor="#EEEEEE" >
                <thead class="titre2_noir">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center">Diplomes</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>Nom</td>
                    <td>Pr&eacute;nom</td>
                    <td>Encadrement</td>
                    <td>Medical</td>
                </tr>
                </thead>
	<?php   
        $req_liste= "SELECT * FROM fiche ".$_SESSION['where']." and inscrit_DDCS<>'1' order by type,nom_usage" ;
        $res_liste= mysql_query($req_liste , $mysql);
		$cpt=0;
        while ($tabres = mysql_fetch_array ($res_liste))
        {
			$res=mysql_fetch_array(log_mysql_query("SELECT abreviation_diplome FROM diplome WHERE index_diplome='".$tabres['diplome_encadrement']."'",$mysql));
			$abreviation_encadrement= stripslashes($res[0]);
			$tabres=stripslashes_deep($tabres);
			if ($cpt%2 == 1) $couleur_de_fond="#EEEEEE";
			else $couleur_de_fond="#CCCCCC";
			$naissance=mktime(0,0,0,substr($tabres['date_naissance'],5,2),substr($tabres['date_naissance'],8,2),substr($tabres['date_naissance'],0,4));
			$d1 = explode("-", $_SESSION['jour_debut_camp']);
			$date_camp=mktime(0,0,0, $d1[1], $d1[2], $d1[0]);
			$secondes = ($date_camp > $naissance)? $date_camp - $naissance : $naissance - $date_camp;
			$age = date('Y', $secondes) - 1970;
			if ($age>=18 or $age<0)
			{
            echo '
                <tr class="titre3_anthracite_sans_fond" bgcolor="'.$couleur_de_fond.'">
					<td>'.$tabres['type']; 
					if ($tabres['parcours']=='1') echo ' - Parcours </td>';
					elseif ($tabres['intendance']=='1') echo ' - Intendance </td>';
					elseif ($tabres['velo']=='1') echo ' - Vélo </td>';
					elseif ($tabres['media']=='1') echo ' - Multi-Média </td>';
					elseif ($tabres['infirmerie']=='1') echo ' - Santé </td>';
					elseif ($tabres['secretariat']=='1') echo ' - Secrétariat </td>';
					elseif ($tabres['technique']=='1') echo ' - Technique </td>';
					elseif ($tabres['priere']=='1') echo ' - Prière </td>';
					echo '
					<td><a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a></td>
					<td>'.$tabres['prenom'].'</td>
					<td>'.$abreviation_encadrement.'</td>
					<td>'.$tabres['diplome_medical'].'</td>
                </tr>';
			$cpt=$cpt+1;
			}
		}
	?>
            </table>
		</td>
	</tr>
</table>
</body>
</html>
