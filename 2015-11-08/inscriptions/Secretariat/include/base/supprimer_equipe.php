<?php
# Supprime l'�quipe s�lectionn�e par la variable $index_equipe (dans l'url) 
$req_inscription="DELETE FROM  `equipe` WHERE `index_equipe`=".$index_equipe;
$res_insertion =    log_mysql_query($req_inscription  , $mysql );

# Supprime l'�quipe s�lectionn�e dans les fiches individuelles 
$req_modif_fiche = "UPDATE   `fiche`  SET equipe='' WHERE `equipe` = '". $index_equipe ."' ";
$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );



if ( $res_insertion <> 1)
{
   echo "Une erreur s'est produite lors de l'envoie de votre pr�-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter � l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}
?>
