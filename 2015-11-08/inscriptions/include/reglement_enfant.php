<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr align="left">
            <td width="967" class="titre1_marron" >R&eacute;glement <span class="titre3_marron">(dont <?php echo $_SESSION['tarif_asso'] ?>&euro; de cotisation &agrave; : <?php echo $_SESSION['nom_association'] ?>)</span></td>
        </tr>
        <tr align="left">
            <td width="967" class="titre3_anthracite" >(Aucun remboursement ne sera effectu&eacute; si le d&eacute;sistement intervient moins de 10 jours avant le d&eacute;but du camp)<span class="titre3_marron"></span></td>
        </tr>
    </table>
	<table width="960" border="0" class="titre4_anthracite" >
		<tr align="left">
			<td colspan="4"> <?php echo $_SESSION['paiement_accepte'] ?></td>
		</tr>
		<tr align="left" class="titre3_anthracite">
            <td> 
            <?php if ($tab['reglement']=="") $tab['reglement']=$_SESSION['tarif_1enf']; ?>
            <input id="reglement" name="reglement" value=<?php echo $_SESSION['tarif_1enf'] ?> <?php if ($tab['reglement']==$_SESSION['tarif_1enf']) echo "checked=\"checked\"";?> type="radio">
            1 Enfant : <?php echo $_SESSION['tarif_1enf'] ?>&euro; </td>
            <td>
            <input id="reglement" name="reglement" value=<?php echo $_SESSION['tarif_2enf']/2 ?> <?php if (($tab['reglement']*2)==$_SESSION['tarif_2enf']) echo "checked=\"checked\"";?> type="radio">
            2 Enfants : <?php echo $_SESSION['tarif_2enf'] ?>&euro; </td>
            <td>
            <input id="reglement" name="reglement" value=<?php echo $_SESSION['tarif_3enf']/3 ?> <?php if (($tab['reglement']*3)==$_SESSION['tarif_3enf']) echo "checked=\"checked\"";?> type="radio">
            3 Enfants : <?php echo $_SESSION['tarif_3enf'] ?>&euro; </td>
            <td>
            <input id="reglement" name="reglement" value=<?php echo $_SESSION['tarif_enf_sup'] ?> <?php if ($tab['reglement']==$_SESSION['tarif_enf_sup']) echo "checked=\"checked\"";?> type="radio">
            Enfant suppl&eacute;mentaire : <?php echo $_SESSION['tarif_enf_sup'] ?>&euro; </td>
		</tr>
    </table>
</div>
