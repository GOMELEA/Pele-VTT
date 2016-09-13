<?php 
# <!-- Gère la validation de l'inscription -->

session_start(); 
include('Secretariat/include/fonction_php.php');
include('Secretariat/include/log_url.php');     
include('include/test_session_ok.php'); // ** Test si la Session a déjà été tué  *************
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../total.css">
</head>
<body>
<script type="text/javascript">
function bonmail(mailteste)
{
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

	if(reg.test(mailteste))
	{
		return(true);
	}
	else
	{
		return(false);
	}
}
function calculer_soutien()
{
// Déclaration de variables
    var soutien = document.getElementById("soutien");
    var total_reglement = document.getElementById("total_reglement");
	var soutien_val = parseFloat(soutien.value);
	total_reglement_session = <? echo $_SESSION['reglement_total']; ?>;

	total_reglement.value = total_reglement_session + soutien_val;

}
function valider_inscription()
{
// Déclaration de variables
	var titre_inscription= document.getElementById("titre_inscription");
	var nom_inscription= document.getElementById("nom_inscription");
    var prenom_inscription= document.getElementById("prenom_inscription");
    var courriel_inscription= document.getElementById("courriel_inscription");
	var validation=true;

// Test si l'adresse est complète
	if (titre_inscription.value=="Sans_titre")
		{ 	alert("Veuillez renseigner le titre");
			validation=false; }
	if (nom_inscription.value.length<3)
		{ 	alert("Veuillez renseigner le nom");
			validation=false; }
	if (prenom_inscription.value.length<3)
		{ 	alert("Veuillez renseigner le prénom");
			validation=false; }
	if (!bonmail(courriel_inscription.value))
		{ 	alert("Veuillez saisir un courriel valide");
			validation=false; }
	if(validation==true)
	{
		// les données sont ok, on peut envoyer le formulaire
		return true;}
    else 
	{
    return false;}
}
</script>

<form  name="formInscription" method="post" action="inscription_pdf.php" onSubmit="return valider_inscription()" >
<?php include('include/bandeau_route.php'); ?>
<p align="center"><img src="Photo/3validation.jpg" width="467" height="62"></p>

<table width="1010" align="center"  cellspacing="0"  class="titre3_anthracite" >
	<!-- Participation Financière -->
	<tr align="left">
		<td height="37" colspan="2" class="titre2_marron" >Participation Financi&egrave;re </td>
	</tr>
	<tr align="left">
	  <td width="20" rowspan="2"><br><br></td>
		 <td width="934" align="left" class="titre2_anthracite"><p>La participation financi&egrave;re demand&eacute;e est largement inf&eacute;rieure au co&ucirc;t r&eacute;el d'un tel s&eacute;jour. 
         	Ceci a &eacute;t&eacute; d&eacute;cid&eacute; volontairement afin de donner &agrave; tous, la chance de participer au p&eacute;l&eacute; VTT. 
            Ce p&eacute;l&eacute; n'est donc possible que parce que <strong>des b&eacute;n&eacute;voles donnent de leur temps et de leur argent</strong>.</p>
		   <p>&nbsp;</p></td>
	</tr>
	<tr align="left">
	  <td align="center" class="titre2_anthracite">Si vous avez &agrave; coeur d'aider financi&egrave;rement vous aussi, afin de faire perdurer le p&eacute;l&eacute; VTT,<br>
merci d'indiquer le montant de votre soutien :
  <input id="soutien" name="soutien" size="10" maxlength="10" type="text"  onChange="calculer_soutien();" >
  <strong>&euro;</strong><br>
<br></td>
    </tr>
	<tr align="left">
		 <td width="20"><br><br></td>
		 <td width="934" class="titre3_anthracite">R&eacute;glement Total (P&eacute;l&eacute; + Soutien):
				<input id="total_reglement" name="total_reglement" size="10" maxlength="10" type="text" value="<?php echo $_SESSION['reglement_total'];?>" READONLY >
            <strong>&euro; </strong><br><br>
		</td>
	</tr>
	<tr align="left">
		<td height="37" colspan="2" class="titre2_marron" >Autres Formes d'aide</td>
	</tr>
	<tr align="left">
		 <td width="20"></td>
		 <td width="934"> <?php echo $_SESSION['soutien'] ?><br><br></td>
	</tr>
</table>


<br>
<!-- Coordonnées de la personne qui inscrit -->
<table width="1010" align="center"  cellspacing="0"  class="titre3_anthracite" >
    <tr align="left">
     	<td height="36" colspan="2" class="titre2_marron" > Courriel de confirmation </td>
    </tr>
	<tr align="left">
		<td width="22"><br></td>
	    <td width="932">Un courriel de confirmation va vous &ecirc;tre envoy&eacute; avec un fichier pdf en pi&egrave;ce jointe, comportant l'int&eacute;gralit&eacute;
        	 de votre inscription. <strong>Ces documents seront &agrave; imprimer et &agrave; nous renvoyer . </strong><br><br>
	        Merci de renseigner les &eacute;lements suivants pour l'envoi du courriel : <br><br>
	        Titre:     
                <select size="1" id="titre_inscription" name="titre_inscription" >
					  <option value="Sans_titre"></option>
					  <option value="Monsieur">Monsieur</option>
					  <option value="Madame">Madame</option>
					  <option value="Mademoiselle">Mlle</option>
					  <option value="Frere">Fr&egrave;re</option>
					  <option value="Pere">P&egrave;re</option>
					  <option value="Soeur">Soeur</option>
					  <option value="Mgr">Mgr</option>
                </select>
            Nom:<input id="nom_inscription" name="nom_inscription" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();">
            Pr&eacute;nom : <input id="prenom_inscription" name="prenom_inscription" size="30" type="text" ><br><br>
	        Courriel : <input id="courriel_inscription" name="courriel_inscription" size="50" maxlength="50" type="text"  > <br><br>
        </td>
	</tr>
</table>
<br>

<table width="1010" align="center"  cellspacing="0"  class="titre2_anthracite" >
	<tr align="left">
		<td height="40" colspan="3" class="titre2_marron" > Validation de l'inscription </td>
    </tr>
	<tr align="center">
		<td colspan="3"><span style="color:#C00;font-weight: 800">   Votre inscription ne sera valid&eacute;e qu'&agrave; r&eacute;ception de l'int&eacute;gralit&eacute; des documents <br>
	        et de votre r&eacute;glement par ch&egrave;que.</span><br><br>
		    <strong>Si d'ici 15 jours,<br>
            nous n'avons pas re&ccedil;u ces informations par courrier, <br>
            votre inscription </strong><span style="color:#C00; font-weight:bold;">sera automatiquement supprim&eacute;e</span>. <br><br>
		</td>
	</tr>
	<tr align="left">
		<td height="40" colspan="3" class="titre2_marron" >  Fin de l'inscription </td>
    </tr>
	<tr align="center">
		<td colspan="3"><strong>Pour terminer votre inscription et recevoir le courriel de confirmation,</strong><br>
            <span style="color:#C00;font-weight: 800">veuillez appuyer sur le bouton Validation</span><br><br>
	    </td>
	</tr>
	<tr align="center">
	  <td width="387" rowspan="3" align="right"><img src="Photo/fleche.gif" width="100" height="50"></td>
	  <td width="185" align="center" valign="middle">&nbsp;</td>
	  <td width="430" rowspan="3" align="left"><img src="Photo/fleche_gauche.gif" width="100" height="50"></td>
    </tr>
	<tr align="center">
	  <td align="center" valign="middle"><input id="butt" name="butt" type="submit"  value=" Validation "></td>
    </tr>
	<tr align="center">
	  <td align="center" valign="middle">&nbsp;</td>
    </tr>
	<tr align="center">
	  <td align="right">&nbsp;</td>
	  <td align="center" valign="middle">&nbsp;</td>
	  <td align="left">&nbsp;</td>
    </tr>
</table>
<br>
<div align="center"><img src="Photo/3validation.jpg" width="467" height="62"></div>
</form>
</body>
</html>
