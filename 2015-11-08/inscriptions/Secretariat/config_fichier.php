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
.Style15 {font-size: 14px}
</style>
</head>

<body>
<div align="center">
    <br>
  	<table border="0" class="Style12" >
		<tr align="left">
		  <td colspan="9" class="Style11" ><div align="center">Liste des fichiers (seulement au format .pdf) </div></td>
      </tr>
		<tr align="left">
		  <td colspan="9" class="Style11" ><div align="left">Fichiers avec le courrier d'inscription </div></td>
      </tr>
		<tr align="left">
          <td align="right">Charte du p&eacute;lerin </td>
          <td>      <input type = "file" name = "charte_pelerin" size="40"><input type = "hidden" name="MAX_FILE_SIZE2" value="100000">
			</td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/charte_du_pelerin.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
	      <td><div align="right">Fiche sanitaire </div></td>
		  <td><input type = "file" name = "fiche_sanitaire" size="40"><input type = "hidden" name="MAX_FILE_SIZE2" value="100000"></td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/fiche_sanitaire.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
	  	  </tr>
		<tr align="left">
		  <td colspan="9" class="Style11" ><div align="left">Courrier d'information sur le camp (<span class="Style15">envoy&eacute; avec le courriel de confirmation</span>) pour : </div></td>
      </tr>
		<tr align="left">
          <td align="right">Coll&eacute;gien</td>
          <td>
            <input type = "file" name = "collegien" size="40">
            <input type = "hidden" name="MAX_FILE_SIZE2" value="100000">
          </td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/Information_collegien.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
          <td><div align="right">Staff</div></td>
          <td><input type = "file" name = "staff" size="40">
              <input type = "hidden" name="MAX_FILE_SIZE2" value="100000"></td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/Information_staff.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
          <td><div align="right">Animateurs</div></td>
          <td><input type = "file" name = "animateur" size="40">
              <input type = "hidden" name="MAX_FILE_SIZE2" value="100000"></td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/Information_animateur.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
	  </tr>
		<tr align="left">
          <td align="right">TTV</td>
          <td>
            <input type = "file" name = "ttv" size="40">
            <input type = "hidden" name="MAX_FILE_SIZE2" value="100000">
          </td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/Information_ttv.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
          <td><div align="right">ABS</div></td>
          <td><input type = "file" name = "abs" size="40">
              <input type = "hidden" name="MAX_FILE_SIZE2" value="100000"></td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/Information_abs.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
          <td><div align="right">Fiche Sanitaire Vélo</div></td>
          <td><input type = "file" name = "velo" size="40">
              <input type = "hidden" name="MAX_FILE_SIZE2" value="100000"></td>
          <td align="right"><a href= 
		  						<?php 
									$fichier='../data/'.formatage_repertoire($tab['departement']).'/'.$tab['annee'].'/Fiche_sanitaire_Velo.pdf';
									echo $fichier.'>'; 
									if (file_exists($fichier)) echo '<img src="../Photo/pdf.gif" width="36" height="34" border="0">';
								  ?>
							 </a>
		  </td>
	  </tr>

 </table>
    <blockquote>
      <p>&nbsp;</p>
    </blockquote>
</div>

</div>
 
</body>

</html>
