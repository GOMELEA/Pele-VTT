<?php
	session_start(); 
	$faire = $_GET["faire"];
	include("../fpdf.php");
	include("../phpToPDF.php");
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
# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     AFFICHE LES ETIQUETTES
if ($faire=="etiquette")
{
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Initialisation PDF
	$PDF = new phpToPDF();
	$PDF->AddPage();
	$PDF -> SetMargins (0,0) ;
	$PDF->SetXY(5,0);
	$PDF->SetFont('Arial','',10);
	$nb_etiquette=0;
	$nbcol=1;
	$nblig=0;
	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Génération Etiquette Adresse DVD
	if  ($_POST['genre']=='Adresse DVD')
	{	
	    $req_liste= "  SELECT * FROM inscription WHERE qte_dvd> '0' ".$_SESSION['and']."  order by nom_inscription ; ";
	    $res_liste= log_mysql_query($req_liste , $mysql);
		while ($tabres = mysql_fetch_array ($res_liste))
		{
			$tabres=stripslashes_deep($tabres);
			$texte="\n";
			if ($tabres['nom_inscription']<>"" or $tabres['prenom_inscription']<>"") 
				{$texte=$texte.$tabres['titre_inscription'].' '.$tabres['nom_inscription'].' '.$tabres['prenom_inscription']."\n ";}
			# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Recherche de l'adresse
			$req_liste2= "  SELECT * FROM fiche WHERE 	fiche_numero_inscription=".$tabres['index_inscription']." ; ";

			$res_liste2= log_mysql_query($req_liste2 , $mysql);
			while ($tabres2 = mysql_fetch_array ($res_liste2))
			{
				if (formatage_nom_de_fichier($tabres['nom_inscription'].$tabres['prenom_inscription'])==formatage_nom_de_fichier($tabres2['nom_usage'].$tabres2['prenom']))  # XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Récupération adresse du particiapnt
				{
					if ($tabres2['adresse_1']<>"") 
						{$texte=$texte.$tabres2['adresse_1']."\n ";}
					if ($tabres2['adresse_2']<>"") 
						{$texte=$texte.$tabres2['adresse_2']."\n ";}
					if ($tabres2['adresse_3']<>"") 
						{$texte=$texte.$tabres2['adresse_3']."\n ";}
					$texte=$texte.$tabres2['cdpostal'].' '.$tabres2['ville']."\n ";
					if ($tabres2['pays']<>"") 
						{$texte=$texte.$tabres2['pays']."\n ";}
					break;
				}
				elseif (formatage_nom_de_fichier($tabres['nom_inscription'].$tabres['prenom_inscription'])==formatage_nom_de_fichier($tabres2['nom_resp'].$tabres2['prenom_resp']))  # XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Récupération adresse du responsable
				{
					if ($tabres2['adresse_1_resp']<>"") 
						{$texte=$texte.$tabres2['adresse_1_resp']."\n ";}
					if ($tabres2['adresse_2_resp']<>"") 
						{$texte=$texte.$tabres2['adresse_2_resp']."\n ";}
					if ($tabres2['adresse_3_resp']<>"") 
						{$texte=$texte.$tabres2['adresse_3_resp']."\n ";}
					$texte=$texte.$tabres2['cdpostal_resp'].' '.$tabres2['ville_resp']."\n ";
					if ($tabres2['pays_resp']<>"") 
						{$texte=$texte.$tabres2['pays_resp']."\n ";}
					break;
				}
			}
			if ($tabres['adresse_1']<>"") 
				{$texte=$texte.$tabres['adresse_1']."\n ";}
			if ($tabres['adresse_2']<>"") 
				{$texte=$texte.$tabres['adresse_2']."\n ";}
			if ($tabres['adresse_3']<>"") 
				{$texte=$texte.$tabres['adresse_3']."\n ";}
			$texte=$texte.$tabres['cdpostal'].' '.$tabres['ville']."\n ";
			if ($tabres['pays']<>"") 
				{$texte=$texte.$tabres['pays']."\n ";}
			$PDF->SetFont('Arial','',10);
			$PDF->SetXY(($nbcol-1)*70+5,$nblig*37);
			$PDF->MultiCell(60,5, $texte, 0,"C");
			$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+2);
			$PDF->SetFont('Arial','',6);
			$PDF->MultiCell(60,5, $tabres['qte_dvd'], 0,"R");

			$nb_etiquette=$nb_etiquette+1;
			$nbcol=$nbcol+1;
			if ($nbcol==4) {$nbcol=1;$nblig=$nblig+1;}
			if ($nb_etiquette==21) {$PDF->AddPage();$nb_etiquette=0;$nblig=0;$PDF->SetXY(5,0);}
		}
	}
	else
	{
		# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Requete SQL
		if ($_POST['type']=="" and $_POST['poste']=="") $condition=$_SESSION['where'];
		else
		{
			$condition="where 1=1 ";
			switch ($_POST['poste'])
			{
				case "parcours" : $condition=$condition." and parcours='1' "; break;
				case "intendance" : $condition=$condition." and intendance='1' "; break;
				case "velo" : $condition=$condition." and velo='1' "; break;
				case "multi-media" : $condition=$condition." and media='1' "; break;
				case "infirmerie" : $condition=$condition." and infirmerie='1' "; break;
				case "technique" : $condition=$condition." and technique='1' "; break;
				case "secretariat" : $condition=$condition." and secretariat='1' "; break;
				case "priere" : $condition=$condition." and priere='1' "; break;
			};
			if ($_POST['type']<>"") $condition=$condition." and `type`='".$_POST['type']."'";
			$condition=$condition.$_SESSION['and'];
		}
		if ($_POST['genre']=='Adresse') $req="select * FROM `fiche` ".$condition." order by cdpostal, ville,adresse_1 ";
		else $req="select * FROM `fiche` ".$condition." order by nom_usage, prenom ";
		$res = log_mysql_query($req , $mysql);

		# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Génération Etiquette Présentation
		if  ($_POST['genre']=='Présentation')
		{	while ($tabres = mysql_fetch_array ($res))
			{
				$tabres=stripslashes_deep($tabres);
				if ($_POST['type']=='collegien')
				{
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37);
					$PDF->SetFont('Arial','B',25);
					$PDF->MultiCell(60,5, "\n".$tabres['prenom'], 0,"C");
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+15);
					$PDF->SetFont('Arial','B',16);
					$PDF->MultiCell(60,5, $tabres['nom_usage'], 0,"C");
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+20);
					$PDF->SetFont('Arial','B',12);
					$naissance=mktime(0,0,0,substr($tabres['date_naissance'],5,2),substr($tabres['date_naissance'],8,2),substr($tabres['date_naissance'],0,4));
					$d1 = explode("-", $_SESSION['jour_debut_camp']);
					$date_camp=mktime(0,0,0, $d1[1], $d1[2], $d1[0]);
					$secondes = ($date_camp > $naissance)? $date_camp - $naissance : $naissance - $date_camp;
					$age = date('Y', $secondes) - 1970;
					$PDF->MultiCell(60,5, $age, 0,"L");
				}
				elseif ($_POST['type']=='abs')
				{
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37);
					$PDF->SetFont('Arial','B',20);
					$titre="";
					if ($tabres['titre']=="Mgr") $titre="Mgr";
					elseif ($tabres['titre']=="Frere") $titre="Frère";
					elseif ($tabres['titre']=="Pere") $titre="Père";
					elseif ($tabres['titre']=="Soeur") $titre="Soeur";
					$PDF->MultiCell(60,5, "\n".$titre." ".$tabres['prenom'], 0,"C");
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+15);
					$PDF->SetFont('Arial','B',14);
					$PDF->MultiCell(60,5, $tabres['nom_usage'], 0,"C");
				}
				elseif ($_POST['type']=='ttv')
				{
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37);
					$PDF->SetFont('Arial','B',20);
					$PDF->MultiCell(60,5, "\n".$tabres['prenom'], 0,"C");
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+15);
					$PDF->SetFont('Arial','B',14);
					$PDF->MultiCell(60,5, $tabres['nom_usage'], 0,"C");
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+25);
					$PDF->SetFont('Arial','B',12);
					if ($tabres['gg']<>"0") $poste=$tabres['gg'];
					elseif ($tabres['parcours']!=0) $poste="TTV Parcours";
					elseif ($tabres['intendance']!=0) $poste="TTV Intendance";
					elseif ($tabres['vélo']!=0) $poste="TTV Vélo";
					elseif ($tabres['media']!=0) $poste="TTV Multi-Média";
					elseif ($tabres['secretariat']!=0) $poste="TTV Secrétariat";
					elseif ($tabres['technique']!=0) $poste="TTV Technique";
					elseif ($tabres['priere']!=0) $poste="TTV Prière";
					$PDF->MultiCell(60,5, $poste, 0,"C");
				}
				else
				{
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37);
					$PDF->SetFont('Arial','B',20);
					$PDF->MultiCell(60,5, "\n\n".$tabres['prenom'], 0,"C");
					$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+20);
					$PDF->SetFont('Arial','B',14);
					$PDF->MultiCell(60,5, $tabres['nom_usage'], 0,"C");
					if ($tabres['gg']<>"0") 
					{
						$poste=$tabres['gg'];
						$PDF->SetXY(($nbcol-1)*70+5,$nblig*37+25);
						$PDF->SetFont('Arial','B',12);
						$PDF->MultiCell(60,5, $poste, 0,"C");
					}
				}
				$nb_etiquette=$nb_etiquette+1;
				$nbcol=$nbcol+1;
				if ($nbcol==4) {$nbcol=1;$nblig=$nblig+1;}
				if ($nb_etiquette==21) {$PDF->AddPage();$nb_etiquette=0;$nblig=0;$PDF->SetXY(5,0);}
			}
		}
		# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     Génération Etiquette ADRESSE
		else
		{	while ($tabres = mysql_fetch_array ($res))
			{
				$tabres=stripslashes_deep($tabres);
				$texte="\n";
				if ($tabres['nom_usage']<>"" or $tabres['prenom']<>"") 
					{$texte=$texte.$tabres['titre'].' '.$tabres['nom_usage'].' '.$tabres['prenom']."\n ";}
				if ($tabres['societe']<>"") 
					{$texte=$texte.$tabres['societe']."\n ";}
				if ($tabres['adresse_1']<>"") 
					{$texte=$texte.$tabres['adresse_1']."\n ";}
				if ($tabres['adresse_2']<>"") 
					{$texte=$texte.$tabres['adresse_2']."\n ";}
				if ($tabres['adresse_3']<>"") 
					{$texte=$texte.$tabres['adresse_3']."\n ";}
				$texte=$texte.$tabres['cdpostal'].' '.$tabres['ville']."\n ";
				if ($tabres['pays']<>"") 
					{$texte=$texte.$tabres['pays']."\n ";}
				$PDF->SetXY(($nbcol-1)*70+5,$nblig*37);
				$PDF->MultiCell(60,5, $texte, 0,"C");
				$nb_etiquette=$nb_etiquette+1;
				$nbcol=$nbcol+1;
				if ($nbcol==4) {$nbcol=1;$nblig=$nblig+1;}
				if ($nb_etiquette==21) {$PDF->AddPage();$nb_etiquette=0;$nblig=0;$PDF->SetXY(5,0);}
			}
		}
	}
	$chemin="../data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee']."/";
	$fichier="etiquettetest.PDF";
	error_reporting(0);
	mkdir ("data/".formatage_repertoire($_SESSION['departement']),0777);
	mkdir ("data/".formatage_repertoire($_SESSION['departement'])."/".$_SESSION['annee'],0777);
	error_reporting(1);
	$PDF->Output($chemin.$fichier, "F");
	?>
	<code>
	   <?php
	   header("Content-type: application/pdf" );
	   readfile($chemin.$fichier);
	   ?>
	</code> 
    <?php
    }
?>

<table width="1200" border="0" align="center" bgcolor="#FFFFFF" >
    <tr>
        <td>
            <p align="center"><?php include('menu.html'); ?><br></p>	</td>
        </td>
    </tr>
    <tr>
        <td>
            <p align="center" class="titre2_marron"><br>Edition d'étiquettes :
            <span class="titre3_marron"><br>(pour des planches A4 de 24 étiquettes de 70 * 37 mm sans aucune marge) <br></span></p>
            <form method="POST" action="liste_etiquette.php?faire=etiquette" >
            <table border="0" align="center">
                <tr class="titre4_anthracite">
                    <td>Type</td>
                    <td>Poste</td>
                    <td>Genre d'étiquette</td>
                    <td rowspan=2><INPUT name='Button' type='submit' VALUE='Etiquette'> </td>
                </tr>
                <tr class="titre3_anthracite_sans_fond">
                    <td><select size="1" id="type" name="type">
                          <option value="<?php if ($_POST['type']<>"") echo $_POST['type']; else echo "";?>"  selected="selected" ><?php if ($_POST['type']<>"") echo $_POST['type']; else echo "";?></option>
                                  <option value=""></option>
                                  <option value="ttv">ttv</option>
                                  <option value="abs">abs</option>
                                  <option value="collegien">collegien</option>
                                  <option value="animateur">animateur</option>
                                  <option value="staff">staff</option>
                                  <option value="ggg">ggg</option>
                                  <option value="ogm">ogm</option>
                            </select></td>
                    <td><select size="1" id="poste" name="poste">
                          <option value="<?php if ($_POST['poste']<>"") echo $_POST['poste']; else echo "";?>"  selected="selected" ><?php if ($_POST['poste']<>"") echo $_POST['poste']; else echo "";?></option>
                                  <option value=""></option>
                                  <option value="parcours">parcours</option>
                                  <option value="intendance">intendance</option>
                                  <option value="velo">velo</option>
                                  <option value="multi-media">multi-media</option>
                                  <option value="infirmerie">infirmerie</option>
                                  <option value="secretariat">secretariat</option>
                                  <option value="technique">technique</option>
                                  <option value="priere">priere</option>
                            </select></td>
                    <td><select size="1" id="genre" name="genre">
                                  <option value="Présentation" selected="selected">Présentation</option>
                                  <option value="Adresse" >Adresse</option>
                                  <option value="Adresse DVD" >Adresse DVD</option>
                            </select></td>
                </tr>
			</table>
            </form>
            <br><br>
        </td>
    </tr>
</table>
</body>
</html>
