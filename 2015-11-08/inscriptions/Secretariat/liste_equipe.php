<?php
	session_start(); 
	include('include/fonction_php.php');
	include('../include/base/connexion_serveur.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <LINK rel=stylesheet type="text/css" href="../../total.css">
</head>
<body>
<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
    <tr>
        <td> <p align="center" class="titre2_marron">Liste par Equipe </p><br></td>
    </tr>
    <tr>
        <td>
			<table  border="1">
				<thead
                <tr class="titre2_noir">
					<td colspan="2" align="center"> Equipe </td>
					<td align="center"> Animateur </td>
					<td colspan="2" align="center"> Collégiens </td>
                </tr>
                </thead>
    <?
        $req_liste= "  SELECT * FROM equipe WHERE route_index = '".$_SESSION['index_route']."' order by numero_equipe" ;
        $res_liste= log_mysql_query($req_liste , $mysql);
        while ($tabres = mysql_fetch_array ($res_liste))
        {	$tabres=stripslashes_deep($tabres);
			echo'
              <tr class="titre3_anthracite_sans_fond">
                <td>
                     <img src="../data/'.formatage_repertoire($_SESSION['departement']).'/foulard_equipe_'.$tabres['index_equipe'].'.jpg" height="150" >
                </td>
                <td>
                    <p class="titre2_noir">'.$tabres['numero_equipe'].' '.$tabres['nom_equipe'].'</p>
                    <p> Foulard : '.$tabres['foulard'].'</p>
                    <p> Tente : '.$tabres['tente'].'</p>
                    <p> Sous-Camp : '.$tabres['sous_camp'].'</p>
                </td>
                <td align="center">';
				$req_animateur= "  SELECT * FROM fiche WHERE equipe='".$tabres['index_equipe']."' and type='animateur'  order by nom_usage" ;
				$res_animateur= log_mysql_query($req_animateur , $mysql);
				while ($tabanim = mysql_fetch_array ($res_animateur))
				{	$tabanim=stripslashes_deep($tabanim);
					echo'
					<p> <a href="secretariat_fiche.php?Selection='.$tabanim['index'].'&go=Afficher">'.$tabanim['nom_usage'].'</a> '.$tabanim['prenom'].'<br>'.$tabanim['tel_mobile'].'</p>';
				}
				echo '</td>
				<td align="center">';
				$req_collegien= "  SELECT * FROM fiche WHERE equipe='".$tabres['index_equipe']."'  and type='collegien'  order by nom_usage" ;
				$res_collegien= log_mysql_query($req_collegien , $mysql);
				$cpt=0;
				while ($tabcoll = mysql_fetch_array ($res_collegien))
				{	$tabcoll=stripslashes_deep($tabcoll);
					$cpt=$cpt+1;
					echo '<a href="secretariat_fiche.php?Selection='.$tabcoll['index'].'&go=Afficher">'.$tabcoll['nom_usage'].'</a>  '.$tabcoll['prenom'].'<br>';
					if ($cpt==6) echo '</td><td align="center">';
				}
				echo '</td>
			 </tr>';
        }
        echo '</table>';
	?>
</td>
  </tr>


</table>




</body>
</html>
