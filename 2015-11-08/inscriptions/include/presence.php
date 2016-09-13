<div align="center">
    <table width="960" border="1" bordercolor="#666666" bgcolor="#EEEEEE" class="titre4_anthracite">
      <tr bordercolor="#999999">
        <td colspan="2"><div align="center"></div></td>
		<?php
        // ************************************************* Affichage des dates du calendrier de présence  ****************************************************************
		$date=maketime($_SESSION['jour_debut_precamp']);
		$debut_precamp = explode("-", $_SESSION['jour_debut_precamp']);
		for($i=0;$i < 8;$i++) 
		{ echo '<td><div align="center">'.date_fran($date+3600*24*$i).'</div></td>'."\n";}
		?>
      </tr>
      <?php
		  $titre_litteral = array("Petit-Dej", "Matinée", "Déjeuner","Après-midi","Dîner", "Soirée","Nuit sur place");
		  $titre = array("petit_dej", "matine", "dejeuner","apres_midi","diner", "soiree","tente");
		  $heure=array(7,9,12,14,19,20,22);
			// ************************************************* Boucle pour la création des lignes  ****************************************************************
		  for($j=0;$j < 7;$j++) 
		  {	echo '<tr bordercolor="#999999" bgcolor="#CCCCCC">'."\n";
		  	echo '<td bgcolor="#CCCCCC"><div align="center">'."\n";
			echo '<input id="'.$titre[$j].'_tout" name="'.$titre[$j].'_tout" value=1 ';
			if ($tab[$titre[$j].'_tout']!=0) echo "checked=\"checked\"";
			echo 'type="checkbox" onclick="remplir_'.$titre[$j].'();" >Tout cocher/d&eacute;cocher </div></td>'."\n";
			echo '<td><div align="center">'.$titre_litteral[$j].'</div></td>'."\n";
			// ************************************************* Boucle pour la création des checkbox du calendrier  ****************************************************************
			for($i=23;$i < 31;$i++) 
			{ 	// ******************************************   Calcul de la date correspondant à la cellule  ***************************
				$jour=$debut_precamp[2]+$i-23;
				$date= mktime($heure[$j],0,0, $debut_precamp[1], $jour, $debut_precamp[0]);
				// ******************************************   Si la cellule est pendant le camp on change la couleur  ***********************************************************
				if ($date>=maketime($_SESSION['jour_debut_camp']) and $date<maketime($_SESSION['jour_fin_camp']))
				{echo '<td bgcolor="#FFFF99">';}
				else {echo '<td>';}
				echo '<div align="center"> ';
				echo '<input id="'.$titre[$j].'_'.$i.'" name="'.$titre[$j].'_'.$i.'" value=1 ';
				if ($tab[$titre[$j].'_'.$i]!=0) echo "checked=\"checked\"";
				// ******************************************   Test si le camps n'est pas déjà commencé ou déjà fini   ***********************************************************
				if ($date>=maketime($_SESSION['jour_debut_precamp']) and $date<maketime($_SESSION['jour_fin_postcamp']))
				{
					echo 'type="checkbox" >' ;
					// ************************************************* Affichage du lieu de couchage  ****************************************************************
					if ($titre[$j]=='tente') { $t=$i-22; echo'<br>'.$_SESSION['couchage_j'.$t];}
				}
				else {echo 'type="hidden"  >' ;}
				echo '</div></td>'."\n";
			}
			echo "</tr>";
		}
		?>
      <tr bordercolor="#999999">
        <td colspan="2"><div align="center"></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="23_tout" name="23_tout" value=1  <?php if ($tab['23_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_23();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="24_tout" name="24_tout" value=1  <?php if ($tab['24_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_24();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="25_tout" name="25_tout" value=1  <?php if ($tab['25_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_25();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="26_tout" name="26_tout" value=1  <?php if ($tab['26_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_26();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="27_tout" name="27_tout" value=1  <?php if ($tab['27_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_27();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="28_tout" name="28_tout" value=1  <?php if ($tab['28_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_28();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="29_tout" name="29_tout" value=1  <?php if ($tab['29_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_29();" >
      Tout cocher/d&eacute;cocher </div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="30_tout" name="30_tout" value=1  <?php if ($tab['30_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_30();" >
      Tout cocher/d&eacute;cocher </div></td>
      </tr>
  </table>
</div>
