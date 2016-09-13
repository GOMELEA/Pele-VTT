<?php 
	$req_liste1= "  select `annee` FROM `fiche` INNER JOIN route ON fiche.route_index = route.index_route WHERE `nom_usage`='".
					mysql_real_escape_string(strtoupper($tabres['nom_usage']))."' and `prenom`='".$tabres['prenom']."' and `date_naissance`='".$tabres['date_naissance'].
					"' and (`gg`='".$titre[$j]."' or `type`='".$titre[$j]."') and fiche.corbeille <>'oui'; ";
	$res_liste1= log_mysql_query($req_liste1 , $mysql);
	while ($tabres1 = mysql_fetch_array ($res_liste1))
		{   
			echo $tabres1['annee'].' ';
		}

?>
