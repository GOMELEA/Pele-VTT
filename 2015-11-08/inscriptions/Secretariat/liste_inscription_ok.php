<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
      session_start(); 
	  include('include/fonction_php.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Style3 {
	font-family: Tahoma;
	font-size: 16px;
	position: relative;
	font-weight: bold;

}
.Style11 {
	font-family: Tahoma;
	font-size: 20px;
	position: relative;
	font-weight: bold;
	color: #967236;
}
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	position: relative;
	color: #333333;
}
-->
</style>
 <link href="/normal.css" rel="stylesheet" type="text/css">
 <style type="text/css">
<!--
.Style8 {color: #FFFFFF}
.Style19 {
	font-family: Tahoma;
	font-size: 12px;
	color: #990000;
	font-style: italic;
}
.Style20 {
	font-size: 12px;
	font-weight: bold;
}
.Style22 {font-size: 14px}
.Style24 {font-size: 12; font-weight: bold; }
body {
	background-color: #EFB554;
}
.Style25 {	font-family: Verdana;
	font-size: 12px;
	position: relative;
	color: #333333;
	background-color: #EEEEEE;
}
-->
 </style>
</head>

<body>
<?php
	function NbJours($debut, $fin) 
	{
	  $tDeb = explode("-", $debut);
	  $tFin = explode("-", $fin);
	  $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
			  mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
	  return(($diff / 86400)+1);
	}
include('../include/base/connexion_serveur.php');
//$req_liste= "  Delete FROM inscription WHERE nom_inscription= 'RESERVE' and (TO_DAYS(NOW())-TO_DAYS(date_inscription))>0 ; ";
//$res_liste= log_mysql_query($req_liste , $mysql);
?>
<table width="990" border="0" align="center" bgcolor="#FFFFFF">
    <tr>
        <td>
        <p align="center"><?php include('menu.html'); ?><br></p>
        </td>
    </tr>
    <tr>
        <td>
            <p align="center" class="Style11">Liste des inscriptions OK</p>
            <table width="1200" border="0">
                <tr class="Style25">
                    <td width="220">
                    </td>
                    <td width="70"><div align="center">Inscrit<br>Depuis<br>(jours)</div>
                    </td>
                    <td><div align="center">Il nous manque ...</div>
                    </td>
                    <td><div align="center">Ils attendent l'envoi ...</div>
                    </td>
                </tr>
            
				<?php  
				$req_liste= "  SELECT * FROM inscription WHERE complete='1'  ".$_SESSION['and']."  order by nom_inscription, prenom_inscription ; ";
				$res_liste= log_mysql_query($req_liste , $mysql);
				while ($tabres = mysql_fetch_array ($res_liste))
				{	$tabres=stripslashes_deep($tabres);
                ?>
                <tr class="Style25">
                    <td>
                    <?php 
                        echo '<a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">'.$tabres['nom_inscription'].' '.$tabres['prenom_inscription'].'</a>';
                    ?> 
                    </td>
                    <td			
                        <?php   // Nombre de jours depuis l'inscription
                        $Nombres_jours =  NbJours($tabres['date_inscription'], date("Y-m-d-G-i"))-1;
                        echo '>';
                        echo '<div align="center">'.round($Nombres_jours).'</div>'; ?>
                    </td>
                    <td>
                    <?php
                        // Reste � r�gler
                        $reste_a_regler=$tabres['total_reglement']-$tabres['montant_1']-$tabres['montant_2']-$tabres['montant_3']-$tabres['liquide']-$tabres['reglement_caf']-$tabres['nb_cheque_10']
							*10-$tabres['nb_cheque_15']*15-$tabres['nb_cheque_20']*20;
                        if ($reste_a_regler>0) echo 'le r�glement de '.$reste_a_regler.'�, ';
                        // Documents manquants
                        $req_liste1= "  SELECT `nom_usage`, `prenom`, `index`, `type`, `documents_signe` FROM fiche WHERE fiche_numero_inscription=".$tabres['index_inscription']." and corbeille<>'oui' ; ";
                        $res_liste1= log_mysql_query($req_liste1 , $mysql);
                        $les_documents=true;
                        while ($tabres1 = mysql_fetch_array ($res_liste1))
                        {	$tabres1=stripslashes_deep($tabres1);
                            if ($tabres1['documents_signe']<>1) 
                            {   
                                if ($les_documents==true) echo ' les documents de ';
                                $les_documents=false;
                                switch ($tabres1['type']) {
                                case "collegien":
                                    $couleur="#FFFFFF";break;
                                case "staff":
                                    $couleur="#E7D63F";break;
                                case "animateur":
                                    $couleur="#195DB0";break;
                                case "ttv":
                                    $couleur="#92131E";break;
                                case "abs":
                                    $couleur="#076A58";break;
                                case "ggg":
                                    $couleur="#000000";break;
                                case "ogm":
                                    $couleur="#EF6703";break;
                                }
                                echo '<p style=" background : '.$couleur.' ; display : inline ;">'.
                                     '<a href="secretariat_fiche.php?Selection='.$tabres1['index'].'&go=Afficher" ';
                                if ($tabres1['type']<>"collegien") echo 'style="color:#FFFFFF;"';
                                echo '>'.$tabres1['nom_usage'].' '.$tabres1['prenom'].'</a>'.',</p>';
                            }
                          }
                    ?> 
                    </td>
                    <td>
                    <?php
                        // Confirmation manquante
                        if ($tabres['date_confirmation']=="0000-00-00") echo ' de la <a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">confirmation,</a>';
                        // Envoi des infos manquante
                        if ($tabres['date_info_pratique']=="0000-00-00") echo ' des <a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">infos du p�l�,</a>';
                        // Envoi des attestations
                        if ($tabres[43]=="0000-00-00" and $tabres['demande_attestation']=='1') echo ' de <a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher"> l\'attestation et du re�u,</a>';
                    ?> 
                    </td>
                </tr>
				<?php
                }
                ?>
            </table>    
		</td>
	</tr>
</table>    
</body>
</html>
