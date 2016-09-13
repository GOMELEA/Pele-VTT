	 <table width="960" border="1" bordercolor="#666666" bgcolor="#EEEEEE" class="titre4_anthracite">
      <tr bordercolor="#999999">
        <td colspan="2"><div align="center"></div></td>
		<?php
        // ************************************************* Affichage des dates du calendrier de présence  ****************************************************************
		$date=maketime($_SESSION['jour_debut_precamp']);
		$debut_precamp = explode("-", $_SESSION['jour_debut_precamp']);
		for($i=0;$i < 8;$i++) 
		{ echo '<td><div align="center">'.date_fran($date+3600*24*$i).'</div></td>'."\n";}
		echo '<td width="60"><div align="center">Total</div></td>'."\n";
		?>
      </tr>
      <?php
		  $titre_litteral = array("Petit-Dej", "Matinée", "Déjeuner","Après-midi","Dîner", "Soirée","Nuit sur place");
		  $titre = array("petit_dej", "matine", "dejeuner","apres_midi","diner", "soiree","tente");
		  $heure=array(7,9,12,14,19,20,22);
			// ************************************************* Boucle pour la création des lignes  ****************************************************************
		  for($j=0;$j < 7;$j++) 
		  {	echo '<tr bordercolor="#999999" bgcolor="#CCCCCC">'."\n";
			echo '<td colspan="2" width="94"><div align="center">'.$titre_litteral[$j].'</div></td>'."\n";
			$total=0;
			// ************************************************* Boucle pour la création des sommes du calendrier  ****************************************************************
			for($i=23;$i < 32;$i++) 
			{ 	// ******************************************   Calcul de la date correspondant à la cellule  ***************************
				$jour=$debut_precamp[2]+$i-23;
				$date= mktime($heure[$j],0,0, $debut_precamp[1], $jour, $debut_precamp[0]);
				// ******************************************   Si la cellule est pendant le camp on change la couleur  ***********************************************************
				if ($date>=maketime($_SESSION['jour_debut_camp']) and $date<maketime($_SESSION['jour_fin_camp']))
				{echo '<td bgcolor="#FFFF99">';}
				else {echo '<td>';}
				echo '<div align="center"> ';
				if ($i<>31)
				{
					$req="select sum(".$titre[$j].'_'.$i.") AS SOMME  FROM `fiche` ".$_SESSION['where'] .$condition;
					$res = log_mysql_query($req , $mysql);
					$resultat=mysql_fetch_array($res); 
					echo  $resultat[0];
					$total=$total+$resultat[0];
				}
				Else
				{	echo  $total;}
				echo '</div></td>'."\n";
			}
			echo "</tr>";
		}
		?>
  </table>
