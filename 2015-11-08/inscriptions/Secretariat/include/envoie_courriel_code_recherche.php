<?
while ($tabres = mysql_fetch_array ($res_liste))
{	
	$tabres=stripslashes_deep($tabres);
    $text_code="";
    $req2_liste= "  SELECT nom_usage, prenom, code_recherche from fiche INNER JOIN inscription ON fiche.fiche_numero_inscription = inscription.index_inscription ".
                "WHERE nom_inscription='".addslashes($tabres['nom_inscription'])."' and prenom_inscription='".addslashes($tabres['prenom_inscription']).
                "' and inscription.route_index='".$res1['index_route']."'" ;
    $res2_liste= log_mysql_query($req2_liste , $mysql);
    while ($resultat = mysql_fetch_array ($res2_liste))
    {
        $resultat=stripslashes_deep($resultat);
		$text_code=$text_code.$resultat['nom_usage']." ".$resultat['prenom']." Code : ".$resultat['code_recherche']."\n";
    }
   // On créé une nouvelle instance de la classe
   $mail = new PHPMailer();
   $mail->SMTPDebug=true;
 
   // De qui vient le message, e-mail puis nom
   $mail->From = $_SESSION['courriel_expediteur'];
   $mail->FromName = "Secrétariat Pélé VTT - ".$_SESSION['departement'];
   // Définition du sujet/objet
   $mail->Subject = "Code pour inscription au pélé VTT";
 
   // On définit le corps du message
   $mail->Body = "Bonjour ". $tabres['titre_inscription']." ". $tabres['prenom_inscription'] ." " .$tabres['nom_inscription'] .",\n\n".
                    $_SESSION['debut_courriel_code_recherche']."\n".$text_code."\n".$_SESSION['fin_courriel_code_recherche'];
 
   // Il reste encore à ajouter au moins un destinataire
   $mail->AddAddress($tabres['courriel_inscription'], $tabres['prenom_inscription'] ." " .$tabres['nom_inscription']);
   $mail->AddCC($_SESSION['courriel_copie']);
   // Pour finir, on envoi l'e-mail
   if(!$mail->Send())
   { //Teste le return code de la fonction
      echo $mail->ErrorInfo; //Affiche le message d'erreur 
   }
}
?>