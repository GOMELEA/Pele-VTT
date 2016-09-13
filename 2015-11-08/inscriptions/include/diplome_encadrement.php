<div align="center">
    <table width="960" border="0" class="titre4_anthracite" >
		<tr align="left">
		  <td colspan="4">Diplome d'encadrement </td>
	    </tr>
		<tr align="left">
		  <td width="2">&nbsp;</td>
		  <td colspan="3">
			<select size="1" id="diplome_encadrement" name="diplome_encadrement" >
				<?php
					if ($tab['diplome_encadrement']<>"")
					{
						$res=mysql_fetch_array(log_mysql_query("SELECT nom_diplome FROM diplome WHERE index_diplome='".$tab['diplome_encadrement']."'",$mysql));
						echo '<option value="'.$tab['diplome_encadrement'].'"  selected="selected" >'.stripslashes($res[0]).'</option>';
					}
					echo '<option value="1"></option>';
					$resultat=log_mysql_query("SELECT * FROM diplome ",$mysql) or die ("Requête non executée.");
					//Génération de la liste déroulante des diplomes
					while ($ligne=mysql_fetch_array($resultat))
					{
						$ligne=stripslashes_deep($ligne);
						echo '<option value ="'.$ligne["index_diplome"].'">'.$ligne["nom_diplome"].'</option>';
					}
					echo '</select>';
				?>
		  </td>
		</tr>
		<tr>
		  <td width="2">&nbsp;</td>
		  <td width="90"><input id="stagiaire_encadrement" name="stagiaire_encadrement" value="1" <?php if ($tab['stagiaire_encadrement']=="1") echo "checked=\"checked\"";?>  type="checkbox" />Stagiaire </td>
		  <td width="20">&nbsp;</td>
		  <td><input id="attestation_encadrement" name="attestation_encadrement" value="1" <?php if ($tab['attestation_encadrement']=="1") echo "checked=\"checked\"";?>  type="checkbox" />Je justifie d'au moins 28 jours d'animations de mineurs dans les 5 dernières années </td>
	    </tr>
  </table>
</div>
