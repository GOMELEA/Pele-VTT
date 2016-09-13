<?php
	session_start(); 
	include('include/fonction_php.php');
	include('../include/base/connexion_serveur.php');
	$_SESSION['date_debut_anniv']=$_POST['date_debut_anniv'];
	$_SESSION['date_fin_anniv']=$_POST['date_fin_anniv'];
	$_d_debut_anniv = explode('/',$_SESSION['date_debut_anniv']);
	$_d_jour_debut =date("z", mktime(0, 0, 0, $_d_debut_anniv[1],$_d_debut_anniv[0], 2000));
	$_d_fin_anniv = explode('/',$_SESSION['date_fin_anniv']);
	$_d_jour_fin =date("z", mktime(0, 0, 0, $_d_fin_anniv[1],$_d_fin_anniv[0], 2000));

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
        <td> <p align="center" class="titre2_marron">Liste des Anniversaires </p><br></td>
    </tr>
    <tr>
        <td class="titre3_noir" align="center"> 
        	<form  name="formBordereau" method="post" action="liste_anniversaire.php" >
            de   
            <input id="date_debut_anniv" name="date_debut_anniv" size="10" type="text" value="<?php echo $_SESSION['date_debut_anniv'];?>">
            &agrave; 
            <input id="date_fin_anniv" name="date_fin_anniv" size="10" type="text" value="<?php echo $_SESSION['date_fin_anniv'];?>" > 
            <input id="butt" name="butt" type="submit"  value=" Validation ">
            <br><br>
            (date sous la forme jj/mm, ne pas oublier de mettre les 0, par exemple 1 avril : 01/04)
            </form>
    	</td>
    </tr>
    <tr>
    	<td align="center">
        <table width="800" bordercolor="#999999" bgcolor="#EEEEEE" >
            <thead class="titre2_noir">
                <tr>
                    <td>Titre</td>
                    <td>Nom</td>
                    <td>Pr&eacute;nom</td>
                    <td>Type</td>
                    <td align="center">Jour</td>
                    <td align="center">Mois</td>
                    <td align="center">On F&ecirc;te ses </td>
                </tr>
            </thead>
	<?php   
        $req_liste= "  SELECT * FROM fiche WHERE DAYOFYEAR(date_naissance)>= '".$_d_jour_debut."' and DAYOFYEAR(date_naissance)<= '".$_d_jour_fin."'  ".$_SESSION['and']." order by DAYOFYEAR(date_naissance)" ;
        $res_liste= log_mysql_query($req_liste , $mysql);
        while ($tabres = mysql_fetch_array ($res_liste))
        {
            $tabres=stripslashes_deep($tabres);
            if ($cpt%2 == 1) $couleur_de_fond="#EEEEEE";
            else $couleur_de_fond="#CCCCCC";
            $cpt=$cpt+1;
            echo ' 
                <tr class="titre3_anthracite_sans_fond" bgcolor="'.$couleur_de_fond.'">
					<td>'.$tabres['titre'].'</td>
					<td><a href="secretariat_fiche.php?Selection='.$tabres['index'].'&go=Afficher">'.$tabres['nom_usage'].'</a></td>
					<td>'.$tabres['prenom'].'</td>
					<td>'.$tabres['type'].'</td>
					<td align="center">'.substr($tabres['date_naissance'],8,2).'</td>
					<td align="center">'.substr($tabres['date_naissance'],5,2).'</td>
					<td align="center">'.(date('Y/')-substr($tabres['date_naissance'],0,4)).' ans</td>
                </tr>';
		 }
	?>
            </table>
		</td>
    </tr>
</table>
</body>
</html>

