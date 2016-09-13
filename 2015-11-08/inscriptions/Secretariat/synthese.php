<?php
	session_start(); 
	$Selection = $_GET["Selection"];
	$go = $_GET["go"];
	if ($_SESSION['index_route']=="" and $Selection=="") header("Location: http://www.pele-vtt.fr/inscriptions/Secretariat/index.php\n\n"); 
	include('include/fonction_php.php');
	include('include/log_url.php');     
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>

<?php
include('../include/base/connexion_serveur.php');
// ************************  Chargement des données de la route
$pos=strpos($Selection, "+"); 
if ($pos>0)
	{
	$annee=substr($Selection,0, $pos-1); 
	$departement=substr($Selection, $pos+2); 
	}
if ($pos>0) 
{
	$resultat = log_mysql_query("Select * from `route` where `annee`='".$annee."' and `departement`='".$departement."'", $mysql);
	$tab = mysql_fetch_array ($resultat);
	$route=$tab['index_route'];
	include('../include/base/charge_variable_route.php');
}
?>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
    <tr>
        <td> <p align="center" class="titre2_marron">Synthèse des inscriptions: </p><br></td>
    </tr>
    <tr>
        <td>
            <table width="700" border="1" class="titre2_noir">
                <tr>
                    <td width="135"></td>
                    <td width="62"><div align="center">H</div></td>
                    <td width="60"><div align="center">F</div></td>
                    <td width="87"><div align="center">Total</div></td>
                    <td width="137"><div align="center">Montant Inscription &euro; </div></td>
                    <td width="179" ><div align="center">DVD €</div></td>
                </tr>
                <tr>
                    <td><div align="left">Coll&eacute;giens</div></td>
                    <td><div align="center"> 
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'collegien' and sexe='H' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo '<a href="liste_jeunes.php?type=collegien&sexe=H">'.$resultat[0].'</a>';
						   $nbcol_H=$resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'collegien' and sexe='F' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo '<a href="liste_jeunes.php?type=collegien&sexe=F">'.$resultat[0].'</a>';
						   $nbcol_F=$resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'collegien'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'collegien'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement_dvd) AS SOMME  FROM `inscription` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                            echo '<a href="liste_dvd.php?type=collegien&sexe=H">'.$resultat[0].'</a>';			 
                        ?>
                    </div></td>
                </tr>
                <tr>
                    <td><p align="left">Staff</p></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'staff' and sexe='H' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo '<a href="liste_jeunes.php?type=staff&sexe=H">'.$resultat[0].'</a>';
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'staff' and sexe='F'".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo '<a href="liste_jeunes.php?type=staff&sexe=F">'.$resultat[0].'</a>';
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'staff' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'staff'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td width="179"><div align="center">Soutien &euro; </div></td>
                </tr>
                <tr>
                    <td colspan="3"><div align="right"><a href="liste_non_jeunes.php?type=ggg">GGG</a></div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'ggg' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'ggg'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td width="179" rowspan="4"><div align="center">
                        <?php 
                           $req="select sum(soutien) AS SOMME  FROM `inscription` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat1=mysql_fetch_array($res); 
                           echo '<a href="liste_soutien.php">'.$resultat1[0].'</a>';
                         ?>
                    </div></td>
                </tr>
                <tr>
                    <td colspan="3"><div align="right"><a href="liste_non_jeunes.php?type=ogm">OGM</a></div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'ogm' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'ogm'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                </tr>
                <tr class="Style3">
                    <td colspan="3"><div align="right"><a href="liste_non_jeunes.php?type=animateur">Animateurs</a></div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'animateur' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'animateur'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                </tr>
                <tr>
                    <td colspan="3"><div align="right"><a href="liste_non_jeunes.php?type=ttv">TTV</a></div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'ttv' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'ttv'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                </tr>
                <tr class="Style3">
                    <td colspan="3"><div align="right"><a href="liste_non_jeunes.php?type=abs">ABS</a></div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` WHERE type = 'abs' ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` WHERE type = 'abs'  ".$_SESSION['and'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">Montant Encaiss&eacute; &euro; </div></td>
                </tr>
                <tr>
                    <td colspan="3"><div align="right">Total</div></td>
                    <td><div align="center">
                        <?php 
                           $req="select count(*) FROM `fiche` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(reglement) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat=mysql_fetch_array($res); 
                           echo $resultat[0];
                         ?>
                    </div></td>
                    <td><div align="center">
                        <?php 
                           $req="select sum(montant_1) AS SOMME  FROM `inscription` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat1=mysql_fetch_array($res); 
                           $req="select sum(montant_2) AS SOMME  FROM `inscription` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat2=mysql_fetch_array($res); 
                           $req="select sum(montant_3) AS SOMME  FROM `inscription` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat3=mysql_fetch_array($res); 
                           $req="select sum(liquide) AS SOMME  FROM `inscription` ".$_SESSION['where'] ;
                           $res = log_mysql_query($req , $mysql);
                           $resultat4=mysql_fetch_array($res); 
                           echo $resultat1[0]+$resultat2[0]+$resultat3[0]+$resultat4[0];
                         ?>
                    </div></td>
                </tr>
            </table>
        <br></td>
    </tr>
    <tr>
        <td><p align="center" class="titre2_marron">R&eacute;partition des TTV : </p><br></td>
    </tr>
    <tr>
        <td>
            <table width="886" border="1" class="titre2_noir">
                <tr>
                    <td width="100"><div align="center">Poste</div></td>
                    <td width="77"><div align="center"><a href="liste_ttv.php?poste=parcours">Parcours</a></div></td>
                    <td width="104"><div align="center"><a href="liste_ttv.php?poste=intendance">Intendance</a></div></td>
                    <td width="89"><div align="center"><a href="liste_ttv.php?poste=velo">R&eacute;paration</a></div></td>
                    <td width="114"><div align="center"><a href="liste_ttv.php?poste=media">Multi-Media</a></div></td>
                    <td width="117"><div align="center"><a href="liste_ttv.php?poste=infirmerie">Infirmerie</a></div></td>
                    <td width="126"><div align="center"><a href="liste_ttv.php?poste=secretariat">Secr&eacute;tariat</a></div></td>
                    <td width="125"><div align="center"><a href="liste_ttv.php?poste=technique">Technique</a></div></td>
                    <td width="125"><div align="center"><a href="liste_ttv.php?poste=priere">Prière</a></div></td>
                </tr>
                <tr>
                    <td><div align="center">Nbre TTV </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(parcours) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(intendance) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(velo) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(media) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(infirmerie) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(secretariat) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(technique) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                    <td><div align="center">
                    <?php 
                       $req="select sum(priere) AS SOMME  FROM `fiche` ".$_SESSION['where'] ;
                       $res = log_mysql_query($req , $mysql);
                       $resultat=mysql_fetch_array($res); 
                       echo $resultat[0];
                     ?>
                    </div></td>
                </tr>
            </table>
        <br></td>
    </tr>
    <tr>
        <td><p align="center" class="titre2_marron"">Pr&eacute;sence : </p><br></td>
    </tr>
    <tr>
        <td>
        <?php $condition ="";include('include/presence_parametrable.php'); ?>
        </td>
    </tr>
</table >
</body >
</html >
