<?php
# XXXXXX Test si la nouvelle route a été renseignée
if ($ndepartement<>"")
{
	# XXXXXX Recherche de l'index de la route pour l'année en cours
	$resultat = log_mysql_query("Select index_route from `route` where `n_departement`='".$ndepartement."' and `annee`='".date ('Y')."'", $mysql) or die ("Requête non executée.");
	$tab = mysql_fetch_array($resultat);
	$index_nouvelle_route=$tab[0];
	if ($index_nouvelle_route<>"")  # Teste si la route existe
	{
		# XXXXXX Modification de l'inscription
		$rech = log_mysql_query("Select observation_inscription from `inscription` where `index_inscription`='".$index_inscription."' ", $mysql) or die ("Requête non executée.");
		$tab = mysql_fetch_array($rech);
		$tab=stripslashes_deep($tab);

		$_aujourdhui=date("Y-m-d-G-i");
		$observation = "************************************************** \n".$_aujourdhui." Fiche envoyée par la route du ".$_SESSION['n_departement']." ************************************************** \n".mysql_real_escape_string($tab['observation_inscription']);
		
		$req_modif_inscr = "UPDATE   `inscription`  SET route_index='" .$index_nouvelle_route."', regle=0, complete=0, observation_inscription='" . $observation."' WHERE `index_inscription` = '". $index_inscription ."' ";
		$res_insertion =    log_mysql_query( $req_modif_inscr, $mysql );
		
		if ( $res_insertion == 1)
		{
		}
		else
		{
		   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
		   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
		   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pelevtt.fr". "<BR>" ;
		}
		
		# XXXXXX Modification des fiches
		$rech = log_mysql_query("Select `index` from `fiche` where `fiche_numero_inscription`='".$index_inscription."' ", $mysql) or die ("Requête non executée.");
		while ($tab = mysql_fetch_array($rech))
		{
			$req_modif_fiche = "UPDATE `fiche` SET route_index='" .$index_nouvelle_route."', present_au_pele=0 WHERE `index`= '". $tab['index']."' ";
			$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );
		
			if ( $res_insertion == 1)
			{
			}
			else
			{
			   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
			   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
			   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pelevtt.fr". "<BR>" ;
			}
		
		}
	}
}
?>