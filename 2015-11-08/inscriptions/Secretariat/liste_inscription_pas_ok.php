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
			<?php  /// ************************ Inscriptions non-terminées 
                $req_liste="SELECT `index_inscription`,`date_inscription` FROM   fiche  INNER JOIN inscription ON fiche.fiche_numero_inscription = inscription.index_inscription".
					" Where `nom_inscription`='RESERVE' and inscription.corbeille <>'oui' and fiche.route_index='".$_SESSION['index_route']."' and ((TO_DAYS(NOW())-TO_DAYS(date_inscription))>0);";
                $res_liste= log_mysql_query($req_liste , $mysql);
                if (mysql_num_rows($res_liste)<>0)
                {
                echo '
            <table width="990" border="0" align="center" bgcolor="#FFFFFF">
              <tr>
                <td>
                    <br><p align="center" class="Style11">Liste des inscriptions non-terminées : </p>
                    <table  border="0" width="300" align="center">
                        <tr class="Style25" >
                            <td width="100"><div align="center">Index</div></td>
                            <td width="180">Date d\'incription</td>
                        </tr>';
                    while ($tabres = mysql_fetch_array ($res_liste))
                    {
                        echo'
                        <tr class="Style25">
                            <td align="center"><a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">'.$tabres['index_inscription'].'</a> </td>
                            <td>'.$tabres['date_inscription'].'</td>
                        </tr>';
                     }
            		echo '
                    </table>
                </td>
              </tr>
            </table>';
				}
			?>


			<?php  /// ************************ Fiches sans inscriptions
                $req_liste="SELECT `index`,`nom_usage`, `prenom`, `type` FROM   fiche  WHERE `fiche_numero_inscription`=0;";
                $res_liste= log_mysql_query($req_liste , $mysql);
                if (mysql_num_rows($res_liste)<>0)
                {
                echo '
            <table width="990" border="0" align="center" bgcolor="#FFFFFF">
              <tr>
                <td>
                    <br><p align="center" class="Style11">Liste des fiches sans inscriptions !!!! </p>
                    <table  border="1"  align="center">';
                    while ($tabres = mysql_fetch_array ($res_liste))
                    {	echo'
						<tr>
						<td  height="40" valign="middle" >';
							switch ($tabres['type']) {
								case "ttv":
									echo '<img src="../Photo/inscription_ttv_petit.jpg" border="1">';
									break;
								case "abs":
									echo '<img src="../Photo/inscription_abs_petit.jpg" border="1">';
									break;
								case "staff":
									echo '<img src="../Photo/inscription_staff_petit.jpg" border="1">';
									break;
								case "animateur":
									echo '<img src="../Photo/inscription_animateur_petit.jpg" border="1">';
									break;
								case "collegien":
									echo '<img src="../Photo/inscription_collegien_petit.jpg" border="1">';
									break;
								case "ggg":
									echo '<img src="../Photo/inscription_ggm_petit.jpg" border="1">';
									break;
								case "ogm":
									echo '<img src="../Photo/inscription_ggm_petit.jpg" border="1">';
									break;
								}
							echo '
						</td>
						<td width="220" valign="middle">'.$tabres['nom_usage']." ".$tabres['prenom'].'</td>
						<td width="50"  align="center"><a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher"><img src="../Photo/modifier.jpg" width="40" height="40" border="0"></a></td>
						</tr>';
                     }
            		echo '
                    </table>
                </td>
              </tr>
            </table>';
				}
			?>

            <p align="center" class="Style11">Liste des inscriptions en attente : </p>
            <table width="1200" border="0">
                <tr class="Style25">
                    <td width="220">
                    </td>
                    <td width="70"><div align="center">Inscrit<br>Depuis<br>(jours)</div>
                    </td>
                    <td width="70"><div align="center">Relancé<br>il y a<br>(jours)</div>
                    </td>
                    <td><div align="center">Il nous manque ...</div>
                    </td>
                    <td width="250"><div align="center">Ils attendent l'envoi ...</div>
                    </td>
                </tr>
            
				<?php  
				$req_liste= "  SELECT * FROM inscription WHERE complete<> '1'  ".$_SESSION['and']."  order by date_inscription, index_inscription ; ";
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
                        if ($Nombres_jours>7 and $Nombres_jours<15 and $tabres['date_relance']=="0000-00-00") echo 'bgcolor="#FFCC00"';
                        if ($Nombres_jours>=15 and $tabres['date_relance']=="0000-00-00") echo 'bgcolor="#CC0033"';
                        echo '>';
                        echo '<div align="center">'.round($Nombres_jours).'</div>'; ?>
                    </td>
                    <td				
                        
                        <?php  // Nombre de jours depuis la relance
                        if ($tabres['date_relance']<>"0000-00-00")
                        {
                            $Nombres_jours =  NbJours($tabres['date_relance'], date("Y-m-d-G-i"))-1;
                            if ($Nombres_jours>7 and $Nombres_jours<15 ) echo 'bgcolor="#FFCC00"';
                            if ($Nombres_jours>=15) echo 'bgcolor="#CC0033"';
                        }
                        echo '>';
                        if ($tabres['date_relance']<>"0000-00-00") echo '<div align="center">'.round($Nombres_jours).'</div>';?>
                    </td>
                    <td>
                    <?php
                        // Reste à régler
                        $reste_a_regler=$tabres['total_reglement']-$tabres['montant_1']-$tabres['montant_2']-$tabres['montant_3']-$tabres['liquide']-$tabres['reglement_caf']-$tabres['nb_cheque_10']-$tabres['nb_cheque_20'];
                        if ($reste_a_regler>0) echo 'le réglement de '.$reste_a_regler.'€, ';
                        // Documents manquants
                        $req_liste1= "  SELECT `nom_usage`, `prenom`, `index`, `type`, `documents_signe` FROM fiche WHERE fiche_numero_inscription=".$tabres['index_inscription']."  and corbeille<>'oui'; ";
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
                        if ($tabres['date_info_pratique']=="0000-00-00") echo ' des <a href="secretariat_inscription.php?Selection='.$tabres['index_inscription'].'&go=Afficher">infos du pélé,</a>';
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
