				<?php
					echo 'Diplome Encadrement <select size="1" id="diplome_encadrement" name="diplome_encadrement" >';
					if ($tab['diplome_encadrement']<>"")
					{
						$res=mysql_fetch_array(log_mysql_query("SELECT abreviation_diplome FROM diplome WHERE index_diplome='".$tab['diplome_encadrement']."'",$mysql));
						echo '<option value="'.$tab['diplome_encadrement'].'"  selected="selected" >'.stripslashes($res[0]).'</option>';
					}
					echo '<option value=""></option>';
					$resultat=log_mysql_query("SELECT * FROM diplome ",$mysql) or die ("Requête non executée.");
					//Génération de la liste déroulante des diplomes
					while ($ligne=mysql_fetch_array($resultat))
					{
						$ligne=stripslashes_deep($ligne);
						echo '<option value ="'.$ligne["index_diplome"].'">'.$ligne["abreviation_diplome"].'</option>';
					}
					echo '</select> 
					<input id="stagiaire_encadrement" name="stagiaire_encadrement" value="1" ';
					if ($tab['stagiaire_encadrement']=="1") echo "checked=\"checked\"";
					echo 'type="checkbox" />Stagiaire
					<input id="attestation_encadrement" name="attestation_encadrement" value="1" ';
					if ($tab['attestation_encadrement']=="1") echo "checked=\"checked\"";
					echo 'type="checkbox" />28 jours ex';
					if ($tab['diplome_encadrement']<>"")
					{
						$res=mysql_fetch_array(log_mysql_query("SELECT * FROM diplome WHERE index_diplome='".$tab['diplome_encadrement']."'",$mysql));
						echo '<BR>'.stripslashes($res['description_diplome']);
						echo '<BR> Code Téléprocédure : '.stripslashes($res['conversion_gam']);
					}

				?>
