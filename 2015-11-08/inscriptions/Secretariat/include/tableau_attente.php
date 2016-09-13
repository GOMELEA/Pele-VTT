<?php  
$req_liste= "  SELECT * FROM attente WHERE type_attente= '".$_type."' ".$_sexe." ".$_etat." ".$_SESSION['and_simple']." order ".$_ordre.";" ;
$res_liste= log_mysql_query($req_liste , $mysql);

if (mysql_num_rows($res_liste)>0) echo '<p  class="Style11">'.$titre.'</p>';

while ($tabres = mysql_fetch_array ($res_liste))
{
	$tabres=stripslashes_deep($tabres);
	echo '
	<A NAME="'.$tabres['index_attente'].'"></A>
	<table width="960" border="1" class="titre3_anthracite">
		<tr>
			<td width="75">'.date('j/n/Y',maketime($tabres['date_liste_attente'])).' &agrave; '.date('G:i:s',maketime($tabres['date_liste_attente'])).'</td>
			<td width="161" style=" font-weight:700">'.$tabres['nom_attente'].'</td>
			<td width="210" style="font-weight:700">'.$tabres['prenom_attente'].'</td>
			<td width="150" align="center"'; 
			// Couleur
			if ($tabres['etat_attente']=="place dispo" or $tabres['etat_attente']=="inscrit") echo ' bgcolor="#74B574">';
			elseif ($tabres['etat_attente']=="supprime" or $tabres['etat_attente']=="trop tard") echo ' bgcolor="#D63E3E">';
			else echo '>';
			// Contenu
			if ($tabres['etat_attente']=="inscrit") echo '<a href="secretariat_fiche.php?Selection='.$tabres['index_inscription'].'&go=Afficher ">Inscrit N '.$tabres['index_inscription'].'</a>';
			elseif ($tabres['etat_attente']=="supprime") echo 'Supprim&eacute;';
			elseif ($tabres['etat_attente']=="attente") echo 'Attente Place';
			elseif ($tabres['date_limite_inscription']<>NULL) echo date('j/n/Y',maketime($tabres['date_limite_inscription'])).' &agrave; '.date('G:i:s',maketime($tabres['date_limite_inscription']));
	echo'
				</td>
			<td width="278" rowspan="5" valign="top"><textarea rows="6" cols="38" id="observation_attente" name="observation_attente" DISABLED>'.$tabres['observation_attente'].'</textarea></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>'.$tabres['cdpostal_attente'].'</td>
			<td>'.$tabres['ville_attente'].'</td>
			<td rowspan="3" align="center">';
	if ((substr($_SERVER["REMOTE_USER"],0,11)=="secretariat"  and substr($_SERVER["REMOTE_USER"],11,6)==$_SESSION['n_departement']) or $_SERVER["REMOTE_USER"]=="o.lefrancois")
		echo '<a href="modif_attente.php?index='.$tabres['index_attente'].'"><img src="../Photo/modifier.png" border="0" height="60"></a>';
	echo'
			</td>
		</tr>
		<tr>
			<td>'.$tabres['titre_resp_attente'].'</td>
			<td>'.$tabres['nom_resp_attente'].'</td>
			<td>'.$tabres['prenom_resp_attente'].'</td>
		</tr>
		<tr>
			<td rowspan="2">&nbsp;</td>
			<td>'.$tabres['telephone_attente'].'</td>
			<td>'.$tabres['tel_mobile_attente'].'</td>
		</tr>
		<tr>
			<td colspan="3">'.$tabres['courriel1_attente'].' , '.$tabres['courriel2_attente'].'</td>
		</tr>
	</table>
	<br>';
}
?>
