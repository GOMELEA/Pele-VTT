<?php
$req_liste= "  SELECT * FROM mdp WHERE autorisation= '".$autorisation."' order by n_departement,login" ;
$res_liste= log_mysql_query($req_liste , $mysql);
echo '<table width="800" border="1">
		  <tr class="Style12">
			<td><div align="center">N&deg;</div></td>
			<td><div align="center">D&eacute;partement</div></td>
			<td><div align="center">Login</div></td>
			<td><div align="center">Mot de Passe </div></td>
			<td><div align="center">Suppr</div></td>
			<td><div align="center">Modif</div></td>
		  </tr>';
while ($tabres = mysql_fetch_array ($res_liste))
{	echo'
	  <tr class="Style12">
		<td><div align="center">'.$tabres['n_departement'].'</div></td>
		<td><div align="center">&nbsp;</div></td>
		<td><div align="center">'.$tabres['login'].'</div></td>
		<td><div align="center">'.$tabres['mdp'].'</div></td>
		<td><div align="center"><img src="supprimer.jpg" width="16" height="16" onClick="confirmation('.$tabres['index_mdp'].');"></div></td>
		<td><div align="center"><a href="gestion_mdp.php?index_mdp='.$tabres['index_mdp'].'&faire=modifier"><img src="modifier.jpg" width="16" height="16"></a></div></td>
	</tr>';
}
echo '</table>';
?>