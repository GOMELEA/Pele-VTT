<?php
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de modification  pour l'INSCRIPTION         XXXXXXXXXXXXXXXXXXXXXxXXX

$requete="Select * from `fiche` where (`equipe`='".$equipe."' or equipe='') ".$_SESSION['and'];
# echo $requete;
$resultat = log_mysql_query($requete, $mysql) or die ("Requête non executée.");
# echo "poste 206".$_POST['Cbox_206']."-";
while ($tab = mysql_fetch_array ($resultat))
{	
	$l="Cbox_".$tab[index];
# 	echo "post".$_POST[$l]."index".$l;
	if ($_POST[$l]==1)
		{		
			$req_modif_fiche = "UPDATE   `fiche`  SET `equipe`='" .$equipe."' where `index`='".$tab[index]."' ";
			# echo $req_modif_fiche;
			$res_modif =    log_mysql_query( $req_modif_fiche, $mysql );
			# echo $tab[nom_usage];
		}
	if ($_POST[$l]!=1)
		{		
			$req_modif_fiche = "UPDATE   `fiche`  SET `equipe`='' where `index`='".$tab[index]."' ";
			# echo $req_modif_fiche;
			$res_modif =    log_mysql_query( $req_modif_fiche, $mysql );
			# echo $tab[nom_usage];
		}
}

?>