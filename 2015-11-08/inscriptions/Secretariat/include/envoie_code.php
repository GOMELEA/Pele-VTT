<?php
include(dirname(__FILE__)."/Secretariat/include/fonction_php.php");
// ************************************************* ENVOIE DU COURRIEL  ****************************************************************

 	// Calcul du code Confidentiel
	$tab['code_confidentiel'] = "";
	$chaine = "abcdefghjkmnpqrstuvwxy123456789ABCDEFGHJKMNPQRSTUVWXYZ123456789";
	srand((double)microtime()*1000000);
	for($i=0; $i<6; $i++) 
	{
		$tab['code_confidentiel'] .= $chaine[rand()%strlen($chaine)];
	}
 	// Sauvegarde du code Confidentiel

	$tab['observation_attente']=date('j/n/Y � G:i:s')." : Envoie Courriel Code \n".$tab['observation_attente'];
	$req_modif_fiche = "UPDATE   `attente`  SET code_confidentiel='" . $tab['code_confidentiel']."',observation_attente='" . mysql_real_escape_string ($tab['observation_attente']).
						"',etat_attente='place dispo' WHERE `index_attente` = '". $index ."' ";
	$res_insertion =    log_mysql_query($req_modif_fiche  , $mysql );


 	// On va chercher la d�finition de la classe
   require('../class.phpmailer.php');
 
   // On cr�� une nouvelle instance de la classe
   $mail = new PHPMailer();
   $mail->SMTPDebug=true;
 
   // De qui vient le message, e-mail puis nom
   $mail->From = $_SESSION['courriel_expediteur'];
   $mail->FromName = "Secr�tariat P�l� VTT - ".$_SESSION['departement'];
   // D�finition du sujet/objet
   $mail->Subject = "Place de Disponible au P�l� VTT";
 
   // On d�finit le corps du message
   $_message="Bonjour ". $tab['titre_resp_attente']." ". $tab['prenom_resp_attente'] ." " .$tab['nom_resp_attente'] .",\n\n".
   		"Une place vient d'�tre lib�r�e sur le p�l� VTT du ".$_SESSION['departement'].". Vous avez inscrit ". $tab['prenom_attente'] ." " .$tab['nom_attente'] .
		" sur la liste d'attente pour une place de ". $tab['type_attente'] .". \n\n".
		"Pour vous inscrire, rendez-vous sur le site http://www.pele-vtt.fr. \n\nVoici le code confidentiel qui vous est personnel :   ". $tab['code_confidentiel'] .
		"  \n\nCe code est indispensable pour votre inscription et restera valide jusqu'au ".date('j/n/Y � G:i:s',maketime($tab['date_limite_inscription'])).
		". \nD�sol�, mais pass� cette date, la place disponible sera propos�e � une autre personne.\n\n ".
		"A tr�s bient�t\n\n\nLe Secr�tariat\n";

   $mail->Body = $_message;
 
   // Il reste encore � ajouter au moins un destinataire
   $mail->AddAddress($tab['courriel1_attente'], $tab['prenom_resp_attente'] ." " .$tab['nom_resp_attente']);
   $mail->AddAddress($tab['courriel2_attente'], $tab['prenom_resp_attente'] ." " .$tab['nom_resp_attente']);
   $mail->AddBcc($_SESSION['courriel_copie']);

   // Pour finir, on envoi l'e-mail
   if(!$mail->Send())
   { //Teste le return code de la fonction
      echo $mail->ErrorInfo; //Affiche le message d'erreur 
   }

?>

