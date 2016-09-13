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
</style>
</head>

<body>
<div align="center">
    <br>
  <table width="525" border="0" class="Style12" >
		<tr align="left" valign="middle">
		  <td align="center" class="Style11 " <?php if ($inscription['corbeille']=="oui") echo 'bgcolor="#000000"';elseif ($inscription['complete']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"';?>>		    <a href="<?php echo "../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/".formatage_repertoire($_SESSION['departement'])."_".$_SESSION['annee']."_".$inscription['index_inscription']; ?>.PDF" target="_blank"><img src="../Photo/pdf.gif" height="25" border="0" title="Ouvrir le document récapitulatif de l'inscription"></a>Inscription N&deg;
            <input id="index_inscription" name="index_inscription" size="5" type="text"  value="<?php echo $inscription['index_inscription'];?>">
OK
<input id="complete" name="complete" value=1 <?php if ($inscription['complete']!=0) echo "checked=\"checked\"";?> type="checkbox"></td>
	  </tr>
		<tr align="left">
		  <td align="center" valign="top">
		    <div align="left">
		      <select size="1" id="titre_inscription" name="titre_inscription" >
		        <option value="<?php echo $inscription['titre_inscription'];?>"  selected="selected" ><?php echo $inscription['titre_inscription'];?></option>
		        <option value="Sans_titre"></option>
		        <option value="Monsieur">Monsieur</option>
		        <option value="Madame">Madame</option>
		        <option value="Mademoiselle">Mlle</option>
		        <option value="Frere">Fr&egrave;re</option>
		        <option value="Pere">P&egrave;re</option>
		        <option value="Soeur">Soeur</option>
		        <option value="Mgr">Mgr</option>
	          </select>
		      <input id="nom_inscription" name="nom_inscription" size="27" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $inscription['nom_inscription'];?>">
		      <input id="prenom_inscription" name="prenom_inscription" size="27" type="text" value="<?php echo $inscription['prenom_inscription'];?>">
          </div></td>
	  </tr>
		<tr align="left">
		  <td align="right">Date Inscrip.      
		    
		      <input id="date_inscription4" name="date_inscription" size="20" type="text"  value="<?php echo $inscription['date_inscription'];?>">
           
		    Mail
          <input id="courriel_inscription" name="courriel_inscription" size="35" maxlength="50" type="text" value="<?php echo $inscription['courriel_inscription'];?>"></td>
	  </tr>
  </table>
<table width="525" border="0" class="Style12" >
 
   <tr valign="bottom" bordercolor="#FFFFFF" bgcolor="#FFCC00" class="Style12" >
    <td colspan="5" class="Style11" 
	<?php if ($inscription['corbeille']=="oui") echo 'bgcolor="#000000"'; elseif ($inscription['regle']!=0) echo 'bgcolor="#33CC00"'; else echo 'bgcolor="#FFCC00"';?>><div align="center">R&eacute;glement <input id="regle" name="regle" value=1 <?php if ($inscription['regle']!=0) echo "checked=\"checked\"";?> type="checkbox"> 
        </div></td>
    </tr>
   <tr valign="bottom" bordercolor="#FFFFFF" bgcolor="#FFCC00" class="Style12" >
     <td colspan="5" >R&eacute;glement
       <input id="total_reglement" name="total_reglement" size="4" type="text"  value="<?php echo $inscription['total_reglement'];?>">
       <span class="Style16">&euro;</span>  dont soutien
       <input id="soutien" name="soutien" size="4" type="text"  value="<?php echo $inscription['soutien'];?>">
       <span class="Style16">&euro; </span>Reste &agrave; r&eacute;gler
       <input id="reste_a_regler" name="reste_a_regler" size="4" type="text" onMouseOver="calculer_reste_a_payer()">
&euro;</td>
   </tr>
   <?php 
   if ($_SESSION['cout_dvd']>0)
   {
	echo '<tr align="center" valign="bottom" bordercolor="#FFFFFF" bgcolor="#FFCC00" class="Style12" >';
    echo '<td colspan="5" >Qt&eacute; DVD :';
    echo '  <input id="qte_dvd" name="qte_dvd" size="4" type="text"  value="'.$inscription['qte_dvd'].'">';
    echo '  Cout DVD : ';
    echo '  <input id="reglement_dvd" name="reglement_dvd" size="4" type="text"  value="'.$inscription['reglement_dvd'].'">';
    echo '  &euro;</td>';
    echo '</tr>';
   }
   ?>
                      <tr bordercolor="#FFFFFF" bgcolor="#FFFF99" border="0">
                        <td width="13" rowspan="2" class="Style11"  ><div align="center">1</div></td>
                        <td width="126" ><div align="center"><strong>Date</strong>
                            <input id="date_cheque_1" name="date_cheque_1" size="10" type="date"  value="<?php echo $inscription['date_cheque_1'];?>">
                        </div></td>
                        <td width="116" ><strong>N&deg;</strong>
                          <input id="n_cheque_1" name="n_cheque_1" size="10" type="text"  value="<?php echo $inscription['n_cheque_1'];?>"></td>
                        <td width="146" ><div align="center">
                          <strong>Banque</strong>
                          <input id="banque_1" name="banque_1" size="10" type="text"  value="<?php echo $inscription['banque_1'];?>">
                        </div></td>
                        <td width="70" ><input id="montant_1" name="montant_1" size="4" type="text"  value="<?php echo $inscription['montant_1'];?>" onChange="calculer_reste_a_payer()" > 
                          <span class="Style16">&euro; </span></td>
                      </tr>
                      <tr bordercolor="#FFFFFF" border="0">
                        <td colspan="4" bgcolor="#FFFF99" ><strong>Nom
                          <input id="nom_cheque_1" name="nom_cheque_1" size="20" type="text"  value="<?php echo $inscription['nom_cheque_1'];?>">
						Pr&eacute;nom 
						<input id="prenom_cheque_1" name="prenom_cheque_1" size="15" type="text"  value="<?php echo $inscription['prenom_cheque_1'];?>"></strong><a href="#" onClick="copie_cheque1()"><img src="../Photo/coller.jpg" width="22" height="20" align="middle" title="Recopie le nom et prénom"></a></td>
                      </tr>
                      <tr bordercolor="#FFFFFF" border="0">
                        <td rowspan="2" class="Style11"  ><div align="center">2</div></td>
                        <td ><div align="center"><strong>Date</strong>
                            <input id="date_cheque_2" name="date_cheque_2" size="10" type="date"  value="<?php echo $inscription['date_cheque_2'];?>">

                        </div></td>
                        <td ><strong>N&deg;</strong>
                          <input id="n_cheque_2" name="n_cheque_2" size="10" type="text"  value="<?php echo $inscription['n_cheque_2'];?>"></td>
                        <td ><div align="center">
                          <strong>Banque</strong>
                          <input id="banque_2" name="banque_2" size="10" type="text"  value="<?php echo $inscription['banque_2'];?>">
                        </div></td>
                        <td ><input id="montant_2" name="montant_2" size="4" type="text"  value="<?php echo $inscription['montant_2'];?>" onChange="calculer_reste_a_payer()">
                          <span class="Style16">&euro; </span></td>
                      </tr>
                      <tr bordercolor="#FFFFFF" border="0">
                        <td colspan="4" ><strong>Nom
                          <input id="nom_cheque_2" name="nom_cheque_2" size="20" type="text"  value="<?php echo $inscription['nom_cheque_2'];?>">
Pr&eacute;nom 
<input id="prenom_cheque_2" name="prenom_cheque_2" size="15" type="text"  value="<?php echo $inscription['prenom_cheque_2'];?>">
                        </strong><a href="#" onClick="copie_cheque2()"><img src="../Photo/coller.jpg" width="22" height="20" align="middle" title="Recopie le nom et prénom"></a></td>
                      </tr>
                      <tr bordercolor="#FFFFFF" bgcolor="#FFFF99" border="0">
                        <td rowspan="2" class="Style11"  ><div align="center">3</div></td>
                        <td ><div align="center"><strong>Date</strong>
                            <input id="date_cheque_3" name="date_cheque_3" size="10" type="date"  value="<?php echo $inscription['date_cheque_3'];?>">

                        </div></td>
                        <td ><strong>N&deg;</strong>
                          <input id="n_cheque_3" name="n_cheque_3" size="10" type="text" value="<?php echo $inscription['n_cheque_3'];?>" ></td>
                        <td ><div align="center">
                          <strong>Banque</strong>
                          <input id="banque_3" name="banque_3" size="10" type="text" value="<?php echo $inscription['banque_3'];?>">
                        </div></td>
                        <td ><input id="montant_3" name="montant_3" size="4" type="text" value="<?php echo $inscription['montant_3'];?>" onChange="calculer_reste_a_payer()">
                          <span class="Style16">&euro; </span></td>
                      </tr>
                      <tr bordercolor="#FFFFFF" border="0">
                        <td colspan="4" bgcolor="#FFFF99" ><strong>Nom
                          <input id="nom_cheque_3" name="nom_cheque_3" size="20" type="text" value="<?php echo $inscription['nom_cheque_3'];?>">
Pr&eacute;nom 
<input id="prenom_cheque_3" name="prenom_cheque_3" size="15" type="text" value="<?php echo $inscription['prenom_cheque_3'];?>">
                        </strong><a href="#" onClick="copie_cheque3()"><img src="../Photo/coller.jpg" width="22" height="20" align="middle" title="Recopie le nom et prénom"></a></td>
                      </tr>
                      <tr bordercolor="#FFFFFF" border="0">
                        <td colspan="5" >
                        <strong>Date : </strong><input id="date_autre_reglement" name="date_autre_reglement" size="10" type="date"  value="<?php echo $inscription['date_autre_reglement'];?>">(aaaa-mm-jj)
                        <strong>Liquide : </strong><input id="liquide" name="liquide" size="4" type="text"  value="<?php echo $inscription['liquide'];?>" onChange="calculer_reste_a_payer()"> € 
                        <strong>Paiement CAF : </strong><input id="reglement_caf" name="reglement_caf" size="4" type="text" value="<?php echo $inscription['reglement_caf'];?>" onChange="calculer_reste_a_payer()"> € <BR>
                        <strong>Nombre de Chèques Vacances </strong>10 € : <input id="nb_cheque_10" name="nb_cheque_10" size="2" type="text" value="<?php echo $inscription['nb_cheque_10'];?>" onChange="calculer_reste_a_payer()">
                        15 € : <input id="nb_cheque_15" name="nb_cheque_15" size="2" type="text" value="<?php echo $inscription['nb_cheque_15'];?>" onChange="calculer_reste_a_payer()">
                        20 € : <input id="nb_cheque_20" name="nb_cheque_20" size="2" type="text" value="<?php echo $inscription['nb_cheque_20'];?>" onChange="calculer_reste_a_payer()"><BR>
                        Demande d'envoi d'attestation : <input id="demande_attestation" name="demande_attestation" value=1 <?php if ($inscription['demande_attestation']!=0) echo "checked=\"checked\"";?> type="checkbox" >
                        <br>
                        </td>
                      </tr>
  </table>    
  
</div>

</div>
 
</body>

</html>
