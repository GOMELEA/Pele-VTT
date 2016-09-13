<?php
// ************************************************* ENVOIE DU COURRIEL  ****************************************************************

 	// On va chercher la d�finition de la classe
   require('class.phpmailer.php');
 
   // On cr�� une nouvelle instance de la classe
   $mail = new PHPMailer();
   $mail->SMTPDebug=true;
 
   // De qui vient le message, e-mail puis nom
   $mail->From = $_SESSION['courriel_expediteur'];
   $mail->FromName = "Secr�tariat P�l� VTT - ".$_SESSION['departement'];
   // D�finition du sujet/objet
   $mail->Subject = "Inscription sur liste d'attente au P�l� VTT";
 
   // On d�finit le corps du message
   $_message="Bonjour ". $_POST['titre_resp_attente']." ". ucwords(strtolower($_POST['prenom_attente'])) ." " .strtoupper($_POST['nom_resp_attente']) .",\n\n".
   		"Vous venez d'inscrire en ligne ". ucwords(strtolower($_POST['prenom_attente']))." ".strtoupper($_POST['nom_attente'])." sur la liste d'attente au p�l� VTT .".
		" \nD�s que nous aurons des places disponibles nous vous recontacterons par courriel. ".
  		"\n\nA tr�s bient�t\n\nLe Secr�tariat\n";

   $mail->Body = $_message;
 
   // Il reste encore � ajouter au moins un destinataire
   $mail->AddAddress($_POST['courriel1_attente'].','.$_POST['courriel2_attente']);
   $mail->AddBcc($_SESSION['courriel_copie']);

   // Pour finir, on envoi l'e-mail
   if(!$mail->Send())
   { //Teste le return code de la fonction
      echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
   }

?>

