<?php
# Gère la création d'une nouvelle route sur la base Mysql 

# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX       montage de la requete de création d'une nouvelle route         XXXXXXXXXXXXXXXXXXXXXxXXX

$req_modif_fiche = "INSERT INTO  route() VALUES()";
$res_insertion =    log_mysql_query( $req_modif_fiche, $mysql );

if ( $res_insertion == 1)
{
		$_index_nouvelle_route=mysql_insert_id();
}
else
{
   echo "Une erreur s'est produite lors de l'envoie de votre pré-inscription au serveur". "<BR>" ;
   echo "Veuillez nous en excuser et avoir l'obligeance de re-essayer". "<BR>" ;
   echo "Si l'erreur persiste, merci de nous contacter à l'adresse suivante : webmaster@pele-vtt.fr". "<BR>" ;
}

mysql_close();
?>
