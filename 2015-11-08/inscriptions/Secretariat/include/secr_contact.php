<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
.Style12 {
	font-family: Verdana;
	font-size: 10px;
	color: #333333;
	background-color: #EEEEEE;
}
.Style11 {
	font-family: Verdana;
	font-size: 18px;
	color: #967236;
	font-weight: bold;
}
.Style14 {font-size: 16px}
</style>
</head>

<body>
<br>
<div align="center">
  	<table width="450"  border="0" class="Style12" >
		<tr align="left" height="23" >
			<td >GG<select size="0" id="gg" name="gg" >
              <option value="<?php echo $tab['gg'];?>"  selected="selected" ><?php echo $tab['gg'];?></option>
              <option value=""></option>
              <option value="GG ABS">GG ABS</option>
              <option value="GG Animateur">GG Animateur</option>
              <option value="GG Intendance">GG Intendance</option>
              <option value="GG Media">GG Media</option>
              <option value="GG Parcours">GG Parcours</option>
              <option value="GG Priere">GG Prière</option>
              <option value="GG Santé">GG Santé</option>
              <option value="GG Secretariat">GG Secretariat</option>
              <option value="GG Staff">GG Staff</option>
              <option value="GG Technique">GG Technique</option>
              <option value="GG Vélo">GG Vélo</option>
              </select></td>
		  	<td class="Style11" >Inscrit N&deg</td>
	  	    <td  class="Style11" >
	  	      <input id="index" name="index" size="4" maxlength="4" type="text" value="<?php echo $tab['index'];?>">
  	          <input id="code_recherche" name="code_recherche" size="10" type="text" value="<?php echo $tab['code_recherche'];?>"> </td>
		</tr>
	</table>
  	<table width="450"  border="0" class="Style12" >
		<tr align="left">
			<td height="23" class="Style12" >Sentinelle : <select size="1" id="sentinelle" name="sentinelle" <?php if ($_SERVER["REMOTE_USER"]<>"o.lefrancois") echo 'DISABLED'; ?>>
			  <option value="<?php echo $tab['sentinelle'];?>"  selected="selected" ><?php echo $tab['sentinelle'];?></option>
			  <option value=""></option>
			  <option value="Sentinelle OGM">Sentinelle OGM</option>
			  <option value="Sentinelle GGG">Sentinelle GGG</option>
			  <option value="Sentinelle ABS">Sentinelle ABS</option>
			  <option value="Sentinelle Animateur">Sentinelle Animateur</option>
			  <option value="Sentinelle Intendance">Sentinelle Intendance</option>
			  <option value="Sentinelle Parcours">Sentinelle Parcours</option>
			  <option value="Sentinelle Priere">Sentinelle Priere</option>
			  <option value="Sentinelle Santé">Sentinelle Santé</option>
			  <option value="Sentinelle Secretariat">Sentinelle Secretariat</option>
			  <option value="Sentinelle Staff">Sentinelle Staff</option>
			  <option value="Sentinelle Technique">Sentinelle Technique</option>
			  </select>
              Inscrit DDCS <input id="inscrit_DDCS" name="inscrit_DDCS" value=1 <?php  if ($tab['inscrit_DDCS']!=0) echo "checked=\"checked\""; ?> type="checkbox">
            </td>
		</tr>
	</table>
  	<table width="450" border="0" class="Style12" >
		<tr align="left" valign="bottom" bgcolor="#FFFF99">
		  	<td height="30" colspan="3"><div align="right">
			     <select size="1" id="titre" name="titre" >
					  <option value="<?php echo $tab['titre'];?>"  selected="selected" ><?php echo $tab['titre'];?></option>
					  <option value="Sans_titre"></option>
					  <option value="Monsieur">Monsieur</option>
					  <option value="Madame">Madame</option>
					  <option value="Mademoiselle">Mlle</option>
					  <option value="Frere">Fr&egrave;re</option>
					  <option value="Pere">P&egrave;re</option>
					  <option value="Soeur">Soeur</option>
					  <option value="Mgr">Mgr</option>
				</select>
				<input id="nom_usage" name="nom_usage" size="25" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_usage'];?>">
				<input id="nom_civil" name="nom_civil" size="25" type="text" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['nom_civil'];?>">
				<input id="prenom" name="prenom" size="22" type="text" value="<?php echo $tab['prenom'];?>"></div>
			</td>
	  	</tr>
		<tr align="left" valign="top" bgcolor="#FFFF99">
		  	<td height="29" colspan="3"><div align="right">		    	<select size="1" id="type" name="type" >
					  <option value="<?php echo $tab['type'];?>"  selected="selected" ><?php echo $tab['type'];?></option>
					  <option value="ttv">ttv</option>
					  <option value="abs">abs</option>
					  <option value="collegien">collegien</option>
					  <option value="animateur">animateur</option>
					  <option value="staff">staff</option>
					  <option value="ggg">ggg</option>
					  <option value="ogm">ogm</option>
				</select>
		  	  Sexe
				<select size="1" id="sexe" name="sexe" <?php if ($type!="staff" and $type!="collegien")echo 'disabled="disabled"';?>>
					  <option value="<?php echo $tab['sexe'];?>"  selected="selected" ><?php echo $tab['sexe'];?></option>
					  <option value="F">F</option>
					  <option value="H">H</option>
				</select>
		    	Nom JFille:<input id="nom_jeune_fille" name="nom_jeune_fille" size="30" type="text" onChange="javascript:this.value=this.value.toUpperCase();" 
							value="<?php echo $tab['nom_jeune_fille'];?>"></div>
			</td>
	  	</tr>
		<tr align="left">
		  	<td width="48" align="right">N&eacute; le </td>
		  	<td>
              <input id="j_nai_1"  name="j_nai_1" size="1" maxlength="2" type="hidden" value="<?php echo substr($tab['date_naissance'],8,2);?>">
              <input id="m_nai_1" name="m_nai_1" size="1" maxlength="2" type="hidden" value="<?php echo substr($tab['date_naissance'],5,2);?>">
              <input id="a_nai_1" name="a_nai_1" size="4" maxlength="4" type="hidden" onBlur="Ctrl_date();" value="<?php echo substr($tab['date_naissance'],0,4);?>">
              <input id="date_naissance" name="date_naissance" type="text" value="<?php echo date("d/m/Y", strtotime($tab['date_naissance']));?>">
			</td>
  	        <td>Taille T-Shirt
				<select size="1" id="taille_teeshirt" name="taille_teeshirt" >
					<option value="<?php echo $tab['taille_teeshirt'];?>"  selected="selected" ><?php echo $tab['taille_teeshirt'];?></option>
					<option value="S">S</option>
					<option value="M">M</option>
					<option value="L">L</option>
					<option value="XL">XL</option>
					<option value="XXL">XXL</option>
				</select>
			</td>
		</tr>
    </table>
  	<? if (strlen($tab['dep_naissance'])<5) echo '
    <table width="450" border="0" class="Style12" >
		<tr align="left">
		  <td align="right">N&eacute; en</td>
		  <td><input id="pays_naissance" name="pays_naissance" size="30" maxlength="40" type="text" value="'.$tab['pays_naissance'].'"></td>
		  <td></td>
		</tr>
		<tr align="left">
		  <td align="right">De Mr </td>
		  <td><input id="nom_pere" name="nom_pere" size="30" maxlength="40" type="text" value="'.$tab['nom_pere'].'"></td>
		  <td><input id="prenom_pere" name="prenom_pere" size="30" maxlength="40" type="text" value="'.$tab['prenom_pere'].'"></td>
		</tr>
		<tr align="left">
		  <td align="right">De Mme </td>
		  <td><input id="nom_mere" name="nom_mere" size="30" maxlength="40" type="text" value="'.$tab['nom_mere'].'"></td>
		  <td><input id="prenom_mere" name="prenom_mere" size="30" maxlength="40" type="text" value="'.$tab['prenom_mere'].'"></td>
		</tr>
	</table>'; ?>
  	<table width="450" border="0" class="Style12" >
		<tr align="left">
		  <td align="right">N&eacute; &agrave; </td>
		  <td><input id="ville_naissance" name="ville_naissance" size="23" maxlength="23" type="text" value="<?php echo $tab['ville_naissance'];?>"></td>
          <td width="130" rowspan="7" valign="bottom">
		  		<?php 
					for ($i = $_SESSION['annee']; $i >2008; $i--)
					{
						if (file_exists('../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($tab['nom_usage']).'_'.formatage_nom_de_fichier($tab['prenom']).'_'.$i.'.jpg')) break;
					}
					
					if ($i==2008) 
						echo ' <img src="../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($tab['nom_usage']).'_'.formatage_nom_de_fichier($tab['prenom']).
							'.jpg" width="125" height="168" alt="Charger une photo du p&eacute;lerin ( 240*320 pixel):">' ;
					else 
						echo ' <img src="../data/'.formatage_repertoire($_SESSION['departement']).'/'.formatage_nom_de_fichier($tab['nom_usage']).'_'.formatage_nom_de_fichier($tab['prenom']).'_'.$i.
							'.jpg" width="125" height="168" alt="Charger une photo du p&eacute;lerin ( 240*320 pixel):">' ;
				?></td>
		</tr>
		<tr align="left">
		  <td align="right">Dans le d&eacutep</td>
          <td height="20" ><select size="1" id="dep_naissance" name="dep_naissance" >
				<option value="<?php echo $tab['dep_naissance'];?>"  selected="selected" ><?php echo $tab['dep_naissance'];?></option>
				<option value="01 Ain">01 Ain</option>
				<option value="02 Aisne">02 Aisne</option>
				<option value="03 Allier">03 Allier</option>
				<option value="04 Alpes-de-Haute-Provence">04 Alpes-de-Haute-Provence</option>
				<option value="05 Hautes-Alpes">05 Hautes-Alpes</option>
				<option value="06 Alpes-Maritimes">06 Alpes-Maritimes</option>
				<option value="07 Ardèche">07 Ardèche</option>
				<option value="08 Ardennes">08 Ardennes</option>
				<option value="09 Ariège">09 Ariège</option>
				<option value="10 Aube">10 Aube</option>
				<option value="11 Aude">11 Aude</option>
				<option value="12 Aveyron">12 Aveyron</option>
				<option value="13 Bouches-du-Rhône">13 Bouches-du-Rhône</option>
				<option value="14 Calvados">14 Calvados</option>
				<option value="15 Cantal">15 Cantal</option>
				<option value="16 Charente">16 Charente</option>
				<option value="17 Charente-Maritime">17 Charente-Maritime</option>
				<option value="18 Cher">18 Cher</option>
				<option value="19 Corrèze">19 Corrèze</option>
				<option value="2A Corse-du-Sud">2A Corse-du-Sud</option>
				<option value="2B Haute-Corse">2B Haute-Corse</option>
				<option value="21 Côte-d'Or">21 Côte-d'Or</option>
				<option value="22 Côtes-d'Armor">22 Côtes-d'Armor</option>
				<option value="23 Creuse">23 Creuse</option>
				<option value="24 Dordogne">24 Dordogne</option>
				<option value="25 Doubs">25 Doubs</option>
				<option value="26 Drôme">26 Drôme</option>
				<option value="27 Eure">27 Eure</option>
				<option value="28 Eure-et-Loir">28 Eure-et-Loir</option>
				<option value="29 Finistère">29 Finistère</option>
				<option value="30 Gard">30 Gard</option>
				<option value="31 Haute-Garonne ">31 Haute-Garonne </option>
				<option value="32 Gers">32 Gers</option>
				<option value="33 Gironde">33 Gironde</option>
				<option value="34 Hérault">34 Hérault</option>
				<option value="35 Ille-et-Vilaine">35 Ille-et-Vilaine</option>
				<option value="36 Indre">36 Indre</option>
				<option value="37 Indre-et-Loire">37 Indre-et-Loire</option>
				<option value="38 Isère">38 Isère</option>
				<option value="39 Jura">39 Jura</option>
				<option value="40 Landes">40 Landes</option>
				<option value="41 Loir-et-Cher">41 Loir-et-Cher</option>
				<option value="42 Loire">42 Loire</option>
				<option value="43 Haute-Loire">43 Haute-Loire</option>
				<option value="44 Loire-Atlantique">44 Loire-Atlantique</option>
				<option value="45 Loiret">45 Loiret</option>
				<option value="46 Lot">46 Lot</option>
				<option value="47 Lot-et-Garonne">47 Lot-et-Garonne</option>
				<option value="48 Lozère">48 Lozère</option>
				<option value="49 Maine-et-Loire">49 Maine-et-Loire</option>
				<option value="50 Manche">50 Manche</option>
				<option value="51 Marne">51 Marne</option>
				<option value="52 Haute-Marne">52 Haute-Marne</option>
				<option value="53 Mayenne">53 Mayenne</option>
				<option value="54 Meurthe-et-Moselle">54 Meurthe-et-Moselle</option>
				<option value="55 Meuse">55 Meuse</option>
				<option value="56 Morbihan">56 Morbihan</option>
				<option value="57 Moselle">57 Moselle</option>
				<option value="58 Nièvre">58 Nièvre</option>
				<option value="59 Nord">59 Nord</option>
				<option value="60 Oise">60 Oise</option>
				<option value="61 Orne">61 Orne</option>
				<option value="62 Pas-de-Calais">62 Pas-de-Calais</option>
				<option value="63 Puy-de-Dôme ">63 Puy-de-Dôme </option>
				<option value="64 Pyrénées-Atlantiques">64 Pyrénées-Atlantiques</option>
				<option value="65 Hautes-Pyrénées">65 Hautes-Pyrénées</option>
				<option value="66 Pyrénées-Orientales">66 Pyrénées-Orientales</option>
				<option value="67 Bas-Rhin">67 Bas-Rhin</option>
				<option value="68 Haut-Rhin">68 Haut-Rhin</option>
				<option value="69 Rhône">69 Rhône</option>
				<option value="70 Haute-Saône">70 Haute-Saône</option>
				<option value="71 Saône-et-Loire">71 Saône-et-Loire</option>
				<option value="72 Sarthe">72 Sarthe</option>
				<option value="73 Savoie">73 Savoie</option>
				<option value="74 Haute-Savoie">74 Haute-Savoie</option>
				<option value="75 Paris">75 Paris</option>
				<option value="76 Seine-Maritime">76 Seine-Maritime</option>
				<option value="77 Seine-et-Marne">77 Seine-et-Marne</option>
				<option value="78 Yvelines">78 Yvelines</option>
				<option value="79 Deux-Sèvres">79 Deux-Sèvres</option>
				<option value="80 Somme">80 Somme</option>
				<option value="81 Tarn">81 Tarn</option>
				<option value="82 Tarn-et-Garonne">82 Tarn-et-Garonne</option>
				<option value="83 Var">83 Var</option>
				<option value="84 Vaucluse">84 Vaucluse</option>
				<option value="85 Vendée">85 Vendée</option>
				<option value="86 Vienne">86 Vienne</option>
				<option value="87 Haute-Vienne">87 Haute-Vienne</option>
				<option value="88 Vosges">88 Vosges</option>
				<option value="89 Yonne">89 Yonne</option>
				<option value="90 Territoire de Belfort">90 Territoire de Belfort</option>
				<option value="91 Essonne">91 Essonne</option>
				<option value="92 Hauts-de-Seine">92 Hauts-de-Seine</option>
				<option value="93 Seine-Saint-Denis">93 Seine-Saint-Denis</option>
				<option value="94 Val-de-Marne">94 Val-de-Marne</option>
				<option value="95 Val-d'Oise ">95 Val-d'Oise </option>
				<option value="971 Guadeloupe">971 Guadeloupe</option>
				<option value="972 Martinique">972 Martinique</option>
				<option value="973 Guyane">973 Guyane</option>
				<option value="974 La Réunion">974 La Réunion</option>
				<option value="976 Mayotte (depuis 2011)">976 Mayotte (depuis 2011)</option>
				<option value="987 Polynésie Française">987 Polynésie Française</option>
            	</select></td>
	    </tr>
		<tr align="left">
			  <td align="right">Adresse</td>
			  <td width="195"><input id="adresse_1" name="adresse_1" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_1'];?>"></td>
        </tr>
		<tr align="left">
			  <td align="right">&nbsp;</td>
			  <td><input id="adresse_2" name="adresse_2" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_2'];?>"></td>
        </tr>
		<tr align="left">
			  <td align="right">&nbsp;</td>
			  <td><input id="adresse_3" name="adresse_3" size="40" maxlength="40" type="text" value="<?php echo $tab['adresse_3'];?>"></td>
        </tr>
		<tr align="left">
			  <td align="right">Ville</td>
			  <td>
			  	  <input id="ville" name="ville" size="26" maxlength="26" type="text"  onChange="javascript:this.value=this.value.toUpperCase();" value="<?php echo $tab['ville'];?>">CP
				  <input id="cdpostal" name="cdpostal" size="7" maxlength="10" type="text" value="<?php echo $tab['cdpostal'];?>">
			  </td>
        </tr>
		<tr  align="left">
			  <td align="right">Courriel</td>
			  <td><input id="courriel" name="courriel" size="40" maxlength="40
              0" type="text" value="<?php echo $tab['courriel'];?>"></td>
        </tr>
		<tr  align="left">
			  <td align="right">Tel :	      </td>
			  <td>
					<input id="telephone" name="telephone" size="13" maxlength="14" type="text" value="<?php echo $tab['telephone'];?>">
					Mob :<input id="tel_mobile" name="tel_mobile" size="13" maxlength="14" type="text" value="<?php echo $tab['tel_mobile'];?>">
			  </td>
              <td></td>
		</tr>
		<tr  align="right">
              <td colspan="3" >Photo de l'inscrit : <input type = "file" name = "photo_identite" size="2"><input type = "hidden" name="MAX_FILE_SIZE" value="500000"></td>
		</tr>
	</table>
  	<table width="450" border="0" class="Style12" >
	<?php
		// ********************** Affichage Collegien et Staff
		if ($tab['type']=="collegien" )
		echo '
		<tr  align="left" valign="bottom" bgcolor="#FFFF99" >
			  <td colspan="2" align="right">
			  	Ecole<input id="etablissement_scolaire" name="etablissement_scolaire" size="43" maxlength="45" type="text" value="'.$tab['etablissement_scolaire'].'">
		      	en <select  id="classe" name="classe" >
					  <option value="'.$tab['classe'].'"  selected="selected" >'.$tab['classe'].'</option>
					  <option value=""></option>
					  <option value="CM2">CM2</option>
					  <option value="6ème">6ème</option>
					  <option value="5ème">5ème</option>
					  <option value="4ème">4ème</option>
					  <option value="3ème">3ème</option>
					  <option value="2nd">2nd</option>
              </select>
			  </td>
	  	</tr>
		<tr  align="left" bgcolor="#FFFF99" >
		  	<td colspan="2" align="right">
				Paroisse <input id="paroisse" name="paroisse" size="26" maxlength="30" type="text" value="'.$tab['paroisse'].'">
	      		Mvt <input id="mouvements" name="mouvements" size="26" maxlength="30" type="text" value="'.$tab['mouvements'].'">
			</td>
	  	</tr>';
		if ($tab['type']=="staff")
		echo '
		<tr  align="left" valign="bottom" bgcolor="#FFFF99" >
			  <td colspan="2" align="right">
			  	Ecole<input id="etablissement_scolaire" name="etablissement_scolaire" size="43" maxlength="45" type="text" value="'.$tab['etablissement_scolaire'].'">
		      	en <select  id="classe" name="classe" >
					  <option value="'.$tab['classe'].'"  selected="selected" >'.$tab['classe'].'</option>
					  <option value=""></option>
					  <option value="3ème">3ème</option>
					  <option value="2nd">2nd</option>
					  <option value="1ère">1ère</option>
					  <option value="Term">Term</option>
					  <option value="CAP1">CAP1</option>
					  <option value="CAP2">CAP2</option>
					  <option value="BEP">BEP</option>
					  <option value="PostBAC">PostBAC</option>
              </select>
			  </td>
	  	</tr>
		<tr  align="left" bgcolor="#FFFF99" >
		  	<td colspan="2" align="right">
				Paroisse <input id="paroisse" name="paroisse" size="26" maxlength="30" type="text" value="'.$tab['paroisse'].'">
	      		Mvt <input id="mouvements" name="mouvements" size="26" maxlength="30" type="text" value="'.$tab['mouvements'].'">
			</td>
	  	</tr>';
		if ($_SESSION['instrument_ok']=="1")
		{ echo '
		<tr  align="left" bgcolor="#FFFF99">
		  	<td colspan="2" align="left">
				Instrument <input id="instrument" name="instrument" size="26" maxlength="30" type="text" value="'.$tab['instrument'].'">
			</td>
	  	</tr>';
		}
		// ********************** Affichage Animateur
		if ($tab['type']=="animateur")
		{ echo '
		<tr  align="left" valign="bottom" bgcolor="#FFFF99">
			  <td colspan="2" align="left">
			  	Niveau Scolaire<input id="niveau_scolaire" name="niveau_scolaire" size="25" maxlength="30" type="text" value="'.$tab['niveau_scolaire'].'">
			  </td>
	  	</tr>
		<tr  align="left" bgcolor="#FFFF99" >
		  	<td colspan="2" align="left">
				Profession <input id="profession" name="profession" size="40" maxlength="40" type="text" value="'.$tab['profession'].'">
			</td>
	  	</tr>
		<tr  align="left" bgcolor="#FFFF99" >
		  	<td colspan="2" align="left">';
		include('secr_diplome_encadrement.php');
		echo '
			</td>
	  	</tr>';
		}
		// ********************** Affichage ABS
		if ($tab['type']=="abs")
		{ echo '
		<tr  align="left" valign="bottom" bgcolor="#FFFF99">
			  <td colspan="2" align="left">
			  	Diocèse/Congrégation <input id="diocese" name="diocese" size="45" maxlength="45" type="text" value="'.$tab['diocese'].'">
			  </td>
	  	</tr>
		<tr  align="left" valign="bottom" bgcolor="#FFFF99">
			  <td colspan="2" align="left">';
		include('secr_diplome_encadrement.php');
		echo '
			  </td>
	  	</tr>';
		}	
		// ********************** Affichage TTV GGG OGM
		if ($tab['type']=="ttv" or $tab['type']=="ggg" or $tab['type']=="ogm" )
		{ echo '
		<tr  align="left" valign="bottom" bgcolor="#FFFF99">
			  <td colspan="2" align="left">
				Diplome Medical <select size="1" id="diplome_medical" name="diplome_medical" >
				  <option value="'.$tab['diplome_medical'].'"  selected="selected" >'.$tab['diplome_medical'].'</option>
				  <option value="Docteur">Docteur</option>
				  <option value="Infirmière">Infirmiere</option>
				  <option value="Kiné">Kine</option>
				  <option value=""></option>
				</select>
			  </td>
	  	</tr>
		<tr  align="left" valign="bottom" bgcolor="#FFFF99">
			  <td colspan="2" align="left">';
		include('secr_diplome_encadrement.php');
		echo '
			  </td>
	  	</tr>
		<tr  align="left" valign="bottom" bgcolor="#FFFF99" >
			  <td colspan="2" align="right">
			  	Profession <input id="profession" name="profession" size="28" maxlength="40" type="text" value="'.$tab['profession'].'">
			  	Permis <input id="permis" name="permis" size="18" maxlength="40" type="text" value="'.$tab['permis'].'">
			  </td>
	  	</tr>
		<tr  align="left" valign="bottom" bgcolor="#FFFF99" >
			  <td colspan="2" align="right">
			  	Compétences <input id="competence" name="competence" size="56" maxlength="80" type="text" value="'.$tab['competence'].'">
			  </td>
	  	</tr>
		<tr  align="left" bgcolor="#FFFF99">
			  <td><div align="right">Poste</div></td>
			  <td>
				  <input id="parcours" name="parcours" value=1 '; if ($tab['parcours']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Parcours
				  <input id="intendance" name="intendance" value=1 '; if ($tab['intendance']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Intendance
				  <input id="velo" name="velo" value=1 '; if ($tab['velo']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Réparation Vélo
				  <input id="media" name="media" value=1 '; if ($tab['media']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Multi-Média <br>
				  <input id="infirmerie" name="infirmerie" value=1 '; if ($tab['infirmerie']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Infirmerie
				  <input id="secretariat" name="secretariat" value=1 '; if ($tab['secretariat']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Secrétariat
				  <input id="technique" name="technique" value=1 '; if ($tab['technique']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Technique
				  <input id="priere" name="priere" value=1 '; if ($tab['priere']!=0) echo "checked=\"checked\""; echo ' type="checkbox">Amicale Prière
			 </td>
	  	</tr>';
		}?>		
		
		<tr  align="left" valign="top" >
			  <td height="30"><div align="right">Equipe</div></td>
			  <td> 	
              		<select name="equipe" id="equipe" <? if ($type!="animateur" and $type!="collegien")echo 'disabled="disabled"';?>>
              		 <?
                    $resultat2=log_mysql_query("SELECT `index_equipe`,`numero_equipe`,`nom_equipe` FROM `equipe` WHERE `index_equipe`='".$tab['equipe']."' ",$mysql) or die ("Requête non executée.");
					$ligne2=mysql_fetch_array($resultat2);
					$ligne2=stripslashes_deep($ligne2);
					echo '<option value="'.$ligne2["index_equipe"].'" selected="selected" >'.$ligne2["numero_equipe"].' '.$ligne2["nom_equipe"].'</option>;';	
                    $resultat_index=log_mysql_query("SELECT `index_equipe`,`numero_equipe`,`nom_equipe` FROM `equipe` ".$_SESSION['where_simple']." order by `numero_equipe`",$mysql) or die ("Requête non executée.");
                    while ($ligne_index=mysql_fetch_array($resultat_index))
                    {
						$ligne_index=stripslashes_deep($ligne_index);
						echo '<option value='.$ligne_index["index_equipe"].'>'.$ligne_index["numero_equipe"].' '.$ligne_index["nom_equipe"].'</option>';
                    }
                    echo '</select>';
					?>
                    R&eacute;glement 
				  <input id="reglement" name="reglement" size="3" maxlength="3" type="text"   value="<?php echo $tab['reglement'];?>"> &euro;
			  </td>
	  	</tr>
  	</table>
</div>
</body>
</html>
