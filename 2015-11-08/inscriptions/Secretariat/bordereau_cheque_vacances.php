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
<?php
	$_SESSION['date_debut_cheq']=$_POST['date_debut_cheq'];
	$_SESSION['date_fin_cheq']=$_POST['date_fin_cheq'];
	$_d_debut_cheq = explode('/',$_SESSION['date_debut_cheq']);
	$_d_debut_cheq = $_d_debut_cheq[2].'/'.$_d_debut_cheq[1].'/'.$_d_debut_cheq[0];
	$_d_fin_cheq = explode('/',$_SESSION['date_fin_cheq']);
	$_d_fin_cheq = $_d_fin_cheq[2].'/'.$_d_fin_cheq[1].'/'.$_d_fin_cheq[0];
?>
<form  name="formBordereau" method="post" action="bordereau_cheque_vacances.php" >

<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td> <p align="center"><?php include('menu.html'); ?></p> </td>
    </tr>
    <tr>
        <td> <p align="center" class="titre2_marron">Bordereau de remise de Ch&egrave;ques Vacances<br>
              de <input id="date_debut_cheq" name="date_debut_cheq" size="10" type="text" value="<?php echo $_SESSION['date_debut_cheq'];?>">
              &agrave; </span><input id="date_fin_cheq" name="date_fin_cheq" size="10" type="text" value="<?php echo $_SESSION['date_fin_cheq'];?>" > 
              <input id="butt" name="butt" type="submit"  value=" Validation "><br>
              <span class="titre3_marron">(date sous la forme jj/mm/aaaa)</span> </p>
		</td>
    </tr>
    <tr>
		<?php  
			// Extraction des enregistrement de ch�que dont la date est comprise entre les dates de d�but et de fin 
		   $cpt=0;
		   $montant_total=0;
		   $nb_cheque_10=0;
		   $nb_cheque_15=0;
		   $nb_cheque_20=0;
		   $req_liste= "  SELECT * FROM inscription WHERE date_autre_reglement>= '".$_d_debut_cheq."' and date_autre_reglement<='".$_d_fin_cheq."' ".$_SESSION['and']." AND (nb_cheque_10>0 or nb_cheque_15 >0 or nb_cheque_20>0) order by date_autre_reglement" ;
		   $res_liste= log_mysql_query($req_liste , $mysql);
		   while ($tabres = mysql_fetch_array ($res_liste))
		  {
			$tabres=stripslashes_deep($tabres);
			$cpt=$cpt+1;
		  	$tab[$cpt]['date_autre_reglement']=$tabres['date_autre_reglement'];
		  	$tab[$cpt]['nom_inscription']=$tabres['nom_inscription'];
		  	$tab[$cpt]['prenom_inscription']=$tabres['prenom_inscription'];
		  	$tab[$cpt]['nb_cheque_10']=$tabres['nb_cheque_10'];
		  	$tab[$cpt]['nb_cheque_15']=$tabres['nb_cheque_15'];
		  	$tab[$cpt]['nb_cheque_20']=$tabres['nb_cheque_20'];
			$tab[$cpt]['index_inscription']=$tabres['index_inscription'];
			$montant_total=$montant_total + floatval($tabres['nb_cheque_10']*10+$tabres['nb_cheque_15']*15+$tabres['nb_cheque_20']*20);
			$nb_cheque_10=$nb_cheque_10+$tabres['nb_cheque_10'];
			$nb_cheque_15=$nb_cheque_15+$tabres['nb_cheque_15'];
			$nb_cheque_20=$nb_cheque_20+$tabres['nb_cheque_20'];
		  }
		?>
		<td>
            <p align="left" class="titre2_noir">
            Date : <?php echo date("j/n/Y"); ?><br>
            Nombre total de ch&egrave;ques de 10 �: <?php echo $nb_cheque_10; ?><br>
            Nombre total de ch&egrave;ques de 15 �: <?php echo $nb_cheque_15; ?><br>
            Nombre total de ch&egrave;ques de 20 �: <?php echo $nb_cheque_20; ?><br>
            Montant Total (&euro;) : <?php echo $montant_total; ?> </p>
        </td>
    </tr>
	<tr>
    	<td>
            <table border="0">
                <tr class="titre2_marron">
                    <td width="52">N&deg;</td>
                    <td width="123">Date</td>
                    <td width="250">Nom</td>
                    <td width="194">Pr&eacute;nom</td>
                    <td width="150">Cheque 10 �</td>
                    <td width="150">Cheque 15 �</td>
                    <td width="150">Cheque 20 �</td>
                    <td width="140">Montant (&euro;) </td>
                </tr>
                <?php 
                $cpt_lg=1;
                if ($cpt>0) foreach ($tab as $ligne) 
                { 			
					if ($cpt_lg%2 == 1) $couleur_de_fond="#EEEEEE";
					else $couleur_de_fond="#CCCCCC";
				?>
                <tr class="titre2_noir" bgcolor="<? echo $couleur_de_fond; ?>">
                    <td align="center"><?php echo '<a href="secretariat_inscription.php?Selection='.$ligne['index_inscription'].'&go=Afficher">'.$cpt_lg.'</a>'; ?></td>
                    <td align="center">
						<?php 
                        $date = explode('-',$ligne['date_autre_reglement']);
                        $date = $date[2].'/'.$date[1].'/'.$date[0];
                        echo $date; ?></td>
                    <td><?php echo $ligne['nom_inscription']; ?> </td>
                    <td><?php echo $ligne['prenom_inscription']; ?></td>
                    <td align="center"><?php echo $ligne['nb_cheque_10']; ?></td>
                    <td align="center"><?php echo $ligne['nb_cheque_15']; ?></td>
                    <td align="center"><?php echo $ligne['nb_cheque_20']; ?></td>
                    <td align="right"><?php echo floatval($ligne['nb_cheque_10']*10+$ligne['nb_cheque_15']*15+$ligne['nb_cheque_20']*20); ?></td>
                </tr>
                <?php
                $cpt_lg=$cpt_lg+1;
                } 
                ?>
             </table>
          </td>
	</tr>
</table>
</form>



</body>
</html>
