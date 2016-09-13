<input id="reglement" name="reglement" type="hidden" value="<?php echo $_SESSION['tarif_anim'] ?>">
<div align="center">
    <table width="960" align="center"  cellspacing="0"  class="titre4_anthracite" >
        <tr align="left">
            <td width="967" class="titre1_marron" >R&eacute;glement <span class="Style14">(dont <?php echo $_SESSION['tarif_asso'] ?>&euro; de cotisation &agrave; : <?php echo $_SESSION['nom_association'] ?>)</span> </td>
        </tr>
    </table>
  	<table width="960" border="0" class="titre4_anthracite" >
        <tr align="left">
            <td><span class="Style14"> La participation financi&egrave;re est fix&eacute;e &agrave; <?php echo $_SESSION['tarif_anim'] ?>&euro; et correspond &agrave; la participation pour les repas </span></td>
        </tr>
    </table>
</div>
