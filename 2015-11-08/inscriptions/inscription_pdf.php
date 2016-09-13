<?php
session_start();
include(dirname(__FILE__)."/Secretariat/include/fonction_php.php");
include('include/test_session_ok.php'); // ** Test si la Session a déjà été tué  *************
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../total.css">
</head>
<body>
<?
// ************************************************* SAUVEGARDE DE L'INSCRIPTION  ****************************************************************
include('include/base/connexion_serveur.php');
$_aujourdhui=date("Y-m-d-G-i");
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete d'insertion par blocs            XXXXXXXXXXXXXXXXXXXXXxXXX
$_requette = "UPDATE   `inscription`  SET titre_inscription = '" . $_POST['titre_inscription'] ."', nom_inscription = '" .mysql_real_escape_string($_POST['nom_inscription']) .
	  "', prenom_inscription = '"  . mysql_real_escape_string($_POST['prenom_inscription']) . "', courriel_inscription = '"  . $_POST['courriel_inscription'] .
	  "', qte_dvd = '"  . $_SESSION['qte_dvd'] . "', reglement_dvd = '"  . ($_SESSION['cout_dvd']*$_SESSION['qte_dvd']) ."', route_index = '"  . $_SESSION['index_route'] .
	  "', date_inscription_fin = '"  .$_aujourdhui. "', soutien = '"  .	$_POST['soutien']. "', total_reglement = '"  .$_POST['total_reglement']. 
	  "' WHERE index_inscription = '". $_SESSION['numero_inscription'] ."' ";
$res_insertion =    log_mysql_query($_requette  , $mysql );

$_var_index_inscription=$_SESSION['numero_inscription'];
include('resume_inscription_pdf.php');

// ************************************************* ENVOIE DU COURRIEL  ****************************************************************

 	// On va chercher la définition de la classe
   require('class.phpmailer.php');
 
   // On créé une nouvelle instance de la classe
   $mail = new PHPMailer();
   $mail->SMTPDebug=true;
 
   // De qui vient le message, e-mail puis nom
   $mail->From = $_SESSION['courriel_expediteur'];
   $mail->FromName = "Secrétariat Pélé VTT - ".$_SESSION['departement'];
   // Définition du sujet/objet
   $mail->Subject = "Inscription au Pélé VTT";
 
   // On définit le corps du message
   $_message="Bonjour ". $_POST['titre_inscription']." ". $_POST['prenom_inscription'] ." " .$_POST['nom_inscription'] .",\n\n".
   		"Vous venez de vous inscrire en ligne au pélé VTT. Vous trouverez en pièce jointe les documents à imprimer et à nous retourner ".
  		"signés accompagnés de votre réglement par courrier avant le ".date("d-m-Y", $delais).".\n \n \n Si vous n'arrivez pas à ouvrir la pièce jointe vous pouvez installer le logiciel ".
		"gratuit à l'adresse suivante http://get.adobe.com/fr/reader/\n\n\nLe Secrétariat\n";

   $mail->Body = $_message;
 
   // Il reste encore à ajouter au moins un destinataire
   $mail->AddAddress($_POST['courriel_inscription'], $_POST['prenom_inscription'] ." " .$_POST['nom_inscription']);
   $mail->AddBcc($_SESSION['courriel_copie']);

   // On met les fichiers en pièce jointe
   $mail->AddAttachment($chemin.$fichier);
   $mail->AddAttachment($chemin."charte_du_pelerin.pdf");
   // Test pour voir s'il y a des collégiens ou des staff, pour voir s'il faut joindre la fiche de liason sanitaire
   $req3="select count(*) FROM `fiche` WHERE (type = 'collegien' or type = 'staff') and fiche_numero_inscription = '". $_SESSION['numero_inscription'] ."' ";
   $res3 = log_mysql_query($req3 , $mysql);
   $resultat3=mysql_fetch_array($res3); 
   if ($resultat3[0]>0) $mail->AddAttachment($chemin."fiche_sanitaire.pdf");
   $mail->SetLanguage('fr', "/phpmailler/language/");


   // Pour finir, on envoi l'e-mail
   if(!$mail->Send())
   { //Teste le return code de la fonction
      echo $mail->ErrorInfo; //Affiche le message d'erreur 
   }

// ************************************************* AFFICHAGE DE LA PAGE  ****************************************************************
include('include/bandeau_route.php'); ?>

<br><br>
<div align="center">
    <table width="1010" align="center"  cellspacing="0"  class="titre2_anthracite" >
        <tr align="left">
            <td width="967" height="60" class="titre2_marron" align="center">
                Merci pour votre inscription
            </td>
        </tr>
		<tr align="center">
            <td>
            	<strong>Un courriel de confirmation vient de vous &ecirc;tre envoy&eacute; <br><br></strong>
                <a href="http://www.pele-vtt.fr"><img src="Photo/AccueilFond.gif" width="40" height="40" border="0"></a>
                <span style="color:#C00;font-weight: 800"><br><br>
                Si vous ne le recevez pas,<br>
                v&eacute;rifiez dans vos &quot;spams&quot; ou &quot;courrier ind&eacute;sirable&quot;,<br>
              il se peut que votre logiciel de messagerie soit un peu z&eacute;l&eacute;....</span><br><br>
          </td>
      </tr>
    </table>
</div>
<?php
	$_SESSION = array(); // on réécrit le tableau
	session_destroy(); // on détruit le tableau réécrit
?>
</body>
</html>


