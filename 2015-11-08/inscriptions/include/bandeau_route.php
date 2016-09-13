<!-- Gère l'affichage du bandeau (en haut de la page) personnalisé en fonction des paramètres de la route -->
<table width="960" height="189" border="0" align="center" background="Photo/bandeau_vide.jpg" bgcolor="#FFFFFF">
	<tr>
		<td width="329" rowspan="2"></td>
		<td width="275" height="84"></td>
		<td width="115" rowspan="2"></td>
		<td width="223" rowspan="2"><img src="Photo/<?php echo $_SESSION['departement'] ?>.jpg" width="138" height="150"></td>
	</tr>
	<tr>
          <td height="99" class="titre2_marron_clair" align="center">
                de <?php echo $_SESSION['lieu_depart'] ?><br>
                à <?php echo $_SESSION['lieu_arrive'] ?><br></div>
                <div class="titre3_marron_clair">
                <br>du <?php echo convdate($_SESSION['jour_debut_camp']) ?> 
                au <?php echo convdate($_SESSION['jour_fin_camp']) ?>
                </div>
          </td>
	</tr>
</table>
