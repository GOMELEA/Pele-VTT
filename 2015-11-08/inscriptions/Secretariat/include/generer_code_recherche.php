<?
// Recherche des fiches où le code de recherche n'est pas calculé
$req_liste= "  SELECT `index` FROM fiche WHERE code_recherche= '' ".$_SESSION['and_annee_precedente']." " ;
$res_liste= log_mysql_query($req_liste , $mysql);
while ($tabres = mysql_fetch_array ($res_liste))
{
    // Calcul du code de recherche
    $tab['code_recherche'] = "";
    $chaine = "abcdefghijklmnpqrstuvwxy123456789ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<10; $i++) 
    {
        $tab['code_recherche'] .= $chaine[rand()%strlen($chaine)];
    }
    // Sauvegarde du code de recherche
    $req_modif_fiche = "UPDATE   `fiche`  SET code_recherche='" . $tab['code_recherche']."' WHERE `index` = '".$tabres['index'] ."' ";
    $res_insertion =    log_mysql_query($req_modif_fiche  , $mysql );
}
?>