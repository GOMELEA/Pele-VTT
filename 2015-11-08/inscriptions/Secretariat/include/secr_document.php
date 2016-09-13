<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
	background-color: #CCCCCC;
}
.Style11 {
	font-family: Verdana;
	font-size: 24px;
	position: relative;
	color: #967236;
	font-weight: bold;
}
.Style14 {font-size: 14px}
</style>
</head>

<body>
<?php
	// Calcul de l'age
	$naissance=mktime(0,0,0,substr($tab['date_naissance'],5,2),substr($tab['date_naissance'],8,2),substr($tab['date_naissance'],0,4));
	$d1 = explode("-", $_SESSION['jour_debut_camp']);
	$date_camp=mktime(0,0,0, $d1[1], $d1[2], $d1[0]);
	$secondes = ($date_camp > $naissance)? $date_camp - $naissance : $naissance - $date_camp;
	$age = date('Y', $secondes) - 1970;
?>
<br>
<div align="center">
    <table width="414" align="center"  cellspacing="0"  class="Style12" >
      <tr align="left">
        <td width="967" class="Style11" <?php if ($tab['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($tab['documents_signe']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"'?>><div align="center">Documents 
          <input id="documents_signe" name="documents_signe" value="1" <?php if ($tab['documents_signe']!="0") echo "checked=\"checked\"";?>  type="checkbox">
        </div></td>
      </tr>
      <tr align="left">
        <td><input id="charte_pelerin" name="charte_pelerin" value="1" <?php if ($tab['charte_pelerin']!="0") echo "checked=\"checked\"";?>  type="checkbox">
            <span class="Style14">Charte du Pélerin Signée 
            <input id="fiche_inscription_signee" name="fiche_inscription_signee" value="1" <?php if ($tab['fiche_inscription_signee']!="0") echo "checked=\"checked\"";?>  type="checkbox">
          Fiche d'inscription</span></td>
      </tr>
      <tr align="left">
        <td><span class="Style14">
			  <?
			if ($type=="collegien" or $type=="staff")
			{
               echo'
              <input id="fiche_liaison" name="fiche_liaison" value="1" ';
              if ($tab['fiche_liaison']!="0") echo "checked=\"checked\"";
              echo '  type="checkbox">
        	</span>
			<span class="Style14"> Fiche Sanitaire </span>';
			}
			if ($type<>"collegien" and $type<>"staff")
			{
				echo'
				<input id="certificat_vaccination" name="certificat_vaccination" value="1" ';
				if ($tab['certificat_vaccination']!="0") echo "checked=\"checked\"";
				echo '  type="checkbox">
			</span>
			<span class="Style14">Vaccination OK jusqu\'au </span>';
			echo'
				<input id="validite_vaccination" name="validite_vaccination" size="10" type="date"  value="'.$tab['validite_vaccination'].'">(aaaa-mm-jj)<br>';
			}
			?>
		<span class="Style14">
        <?php
			if ($type=="ttv" or $type=="abs")
			{
				echo '<input id="assurance_voiture" name="assurance_voiture" value="1"';
				if ($tab['assurance_voiture']!="0") echo "checked=\"checked\"";
				echo 'type="checkbox"> Carte Verte ';
			}
			if ($type<>"collegien" and $type<>"staff")
			{
				echo '<input id="casier" name="casier" value="1"';
				if ($tab['casier']!="0") echo "checked=\"checked\"";
				echo 'type="checkbox"> Casier Judiciaire <br>';
			}
			if ($tab['diplome_medical']!="" and $tab['diplome_medical']!="sans")
			{
				echo '<input id="diplome_medical_ok" name="diplome_medical_ok" value="1"';
				if ($tab['diplome_medical_ok']!="0") echo "checked=\"checked\"";
				echo 'type="checkbox"> Diplome Médical';
			}
			if ($tab['permis']!="" and $tab['permis']!="sans")
			{
				echo '<input id="permis_ok" name="permis_ok" value="1"';
				if ($tab['permis_ok']!="0") echo "checked=\"checked\"";
				echo 'type="checkbox"> Permis de Conduire <br>';
			}
			if ($tab['intendance']=="1")
			{
				echo '<input id="manipulation_denrees" name="manipulation_denrees" value="1"';
				if ($tab['manipulation_denrees']!="0") echo "checked=\"checked\"";
				echo 'type="checkbox"> Manipulation denrées <br>';
			}
			if ($tab['diplome_encadrement']!="" or $tab['diplome_encadrement']!="1")
			{
				if ($tab['attestation_encadrement']=="1")
				{
					echo '<input id="attestation_encadrement_ok" name="attestation_encadrement_ok" value="1"';
					if ($tab['attestation_encadrement_ok']!="0") echo "checked=\"checked\"";
					echo 'type="checkbox"> Attestation Exp Anim pdt 28 jours<br>';
				}
				echo '<input id="diplome_encadrement_ok" name="diplome_encadrement_ok" value="1"';
				if ($tab['diplome_encadrement_ok']!="0") echo "checked=\"checked\"";
				echo 'type="checkbox"> Diplome Encadrement <br>';
				$fichier='../data/_DIPLOME_ENCADREMENT/'.formatage_nom_de_fichier($tab['nom_usage']).'_'.formatage_nom_de_fichier($tab['prenom']).'_'.$tab['date_naissance'].'.jpg';
				if (file_exists($fichier)) echo '<a href='.$fichier.'><img src="../Photo/jpg.gif" width="36" height="34" border="0"></a>';
				echo '<input type = "file" name = "diplome_encadrement" size="2"><input type = "hidden" name="MAX_FILE_SIZE" value="2000000">';
			}
		?>
        </span>
		</td>
      </tr>
      <tr align="left">
        <td valign="middle" class="Style14">R&eacute;gime: 
        <TEXTAREA rows=2 cols=40 id="regime" name="regime"><?php echo $tab['regime'];?> </TEXTAREA></td>
      </tr>
    </table>
</div>

</div>
 
</body>

</html>
