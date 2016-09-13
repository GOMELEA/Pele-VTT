<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
.Style11 {
	font-family: Verdana;
	font-size: 18px;
	position: relative;
	color: #967236;
	font-weight: bold;
}

.Style13 {font-size: 18px}
</style>

</head>

<body>
<br>
    <table width="370" border="1" bordercolor="#666666" bgcolor="#EEEEEE" class="Style12">
      <tr bordercolor="#999999">
        <td colspan="10" class="Style11" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($tab['present_au_pele']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><div align="center">
          <input id="present_au_pele" name="present_au_pele" value=1 <?php if ($tab['present_au_pele']!=0) echo "checked=\"checked\"";?> type="checkbox"> 
          Pr&eacute;sence lors du p&eacute;l&eacute;
        </div></td>
      </tr>
      <tr bordercolor="#999999">
        <td colspan="2"><div align="center">Tout cocher/d�cocher</div></td>
		<?php
        // ************************************************* Affichage des dates du calendrier de pr�sence  ****************************************************************
		$date=maketime($_SESSION['jour_debut_precamp']);
		$debut_precamp = explode("-", $_SESSION['jour_debut_precamp']);
		for($i=0;$i < 8;$i++) 
		{ echo '<td><div align="center">'.date_fran_jour($date+3600*24*$i).'</div></td>'."\n";}
		?>
      </tr>
      <?php
		  $titre_litteral = array("Petit-Dej", "Matin�e", "D�jeuner","Apr�s-midi","D�ner", "Soir�e","Nuit sur place");
		  $titre = array("petit_dej", "matine", "dejeuner","apres_midi","diner", "soiree","tente");
		  $heure=array(7,9,12,14,19,20,22);
			// ************************************************* Boucle pour la cr�ation des lignes  ****************************************************************
		  for($j=0;$j < 7;$j++) 
		  {	echo '<tr bordercolor="#999999" bgcolor="#CCCCCC">'."\n";
		  	echo '<td bgcolor="#CCCCCC"><div align="center">'."\n";
			echo '<input id="'.$titre[$j].'_tout" name="'.$titre[$j].'_tout" value=1 ';
			if ($tab[$titre[$j].'_tout']!=0) echo "checked=\"checked\"";
			echo 'type="checkbox" onclick="remplir_'.$titre[$j].'();" ></div></td>'."\n";
			echo '<td width="94"><div align="center">'.$titre_litteral[$j].'</div></td>'."\n";
			// ************************************************* Boucle pour la cr�ation des checkbox du calendrier  ****************************************************************
			for($i=23;$i < 31;$i++) 
			{ 	// ******************************************   Calcul de la date correspondant � la cellule  ***************************
				$jour=$debut_precamp[2]+$i-23;
				$date= mktime($heure[$j],0,0, $debut_precamp[1], $jour, $debut_precamp[0]);
				// ******************************************   Si la cellule est pendant le camp on change la couleur  ***********************************************************
				if ($date>=maketime($_SESSION['jour_debut_camp']) and $date<maketime($_SESSION['jour_fin_camp']))
				{echo '<td bgcolor="#FFFF99">';}
				else {echo '<td>';}
				echo '<div align="center"> ';
				echo '<input id="'.$titre[$j].'_'.$i.'" name="'.$titre[$j].'_'.$i.'" value=1 ';
				if ($tab[$titre[$j].'_'.$i]!=0) echo "checked=\"checked\"";
				// ******************************************   Test si le camps n'est pas d�j� commenc� ou d�j� fini   ***********************************************************
				if ($date>=maketime($_SESSION['jour_debut_precamp']) and $date<maketime($_SESSION['jour_fin_postcamp']))
				{
					echo 'type="checkbox" >' ;
				}
				else {echo 'type="hidden"  >' ;}
				echo '</div></td>'."\n";
			}
			echo "</tr>";
		}
		?>
      <tr bordercolor="#999999">
        <td colspan="2"><div align="center">Tout cocher/d�cocher</div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="23_tout" name="23_tout" value=1  <?php if ($tab['23_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_23();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="24_tout" name="24_tout" value=1  <?php if ($tab['24_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_24();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="25_tout" name="25_tout" value=1  <?php if ($tab['25_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_25();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="26_tout" name="26_tout" value=1  <?php if ($tab['26_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_26();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="27_tout" name="27_tout" value=1  <?php if ($tab['27_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_27();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="28_tout" name="28_tout" value=1  <?php if ($tab['28_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_28();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="29_tout" name="29_tout" value=1  <?php if ($tab['29_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_29();" ></div></td>
        <td bordercolor="#999999" bgcolor="#CCCCCC"><div align="center">
      <input id="30_tout" name="30_tout" value=1  <?php if ($tab['30_tout']!=0) echo "checked=\"checked\"";?> type="checkbox" onClick="remplir_30();" >
      </tr>
  </table>
</body>
