// JavaScript Document
function control_ttv(test)
{
	var validation=true; 

	if (test=="recherche") validation=validation&control_recherche();
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_naissance_etranger();
	validation=validation&valider_profession_competence();
	validation=validation&valider_adresse_personne_a_contacter();
	validation=validation&valider_lien_personne();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();
	validation=validation&valider_poste();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function control_ggg(test)
{
	var validation=true; 
	
	if (test=="recherche") validation=validation&control_recherche();
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_naissance_etranger();
	validation=validation&valider_profession_competence();
	validation=validation&valider_encadrement();
	validation=validation&valider_adresse_personne_a_contacter();
	validation=validation&valider_lien_personne();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function control_ogm(test)
{
	var validation=true; 
	
	if (test=="recherche") validation=validation&control_recherche();
	
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_naissance_etranger();
	validation=validation&valider_profession_competence();
	validation=validation&valider_encadrement();
	validation=validation&valider_adresse_personne_a_contacter();
	validation=validation&valider_lien_personne();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function control_abs(test)
{
	var validation=true; 
	
	if (test=="recherche") validation=validation&control_recherche();
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_naissance_etranger();
	validation=validation&valider_diocese();
	validation=validation&valider_encadrement();
	validation=validation&valider_adresse_personne_a_contacter();
	validation=validation&valider_lien_personne();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}

function control_collegien(test)
{
	var validation=true; 
	
	if (test=="recherche") validation=validation&control_recherche();
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_sexe();
	validation=validation&valider_scolaire();
	validation=validation&valider_adresse_resp();
	validation=validation&valider_reglement();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();
	validation=validation&valider_materiel();
	//validation=validation&valider_reglement_enfant();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function control_animateur(test)
{
	var validation=true; 
	
	if (test=="recherche") validation=validation&control_recherche();
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_naissance_etranger();
	validation=validation&valider_sexe();
	validation=validation&valider_niveau_scolaire();
	validation=validation&valider_encadrement();
	validation=validation&valider_adresse_personne_a_contacter();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function control_staff(test)
{
	var validation=true; 
	
	if (test=="recherche") validation=validation&control_recherche();
	validation=validation&Ctrl_date_valide();
	validation=validation&valider_adresse_inscrit();
	validation=validation&valider_sexe();
	validation=validation&valider_scolaire();
	validation=validation&valider_reglement();
	validation=validation&valider_adresse_resp();
	validation=validation&valider_assurance_rc();
	validation=validation&valider_droit_image();
	//validation=validation&valider_reglement_enfant();

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function bonmail(mailteste)
{
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

	if(reg.test(mailteste))
	{
		return(true);
	}
	else
	{
		return(false);
	}
}
function control_contact_attente()
{
	// Déclaration de variables
	var nom_attente= document.getElementById("nom_attente");
    var prenom_attente= document.getElementById("prenom_attente");
    var cdpostal_attente= document.getElementById("cdpostal_attente");
    var ville_attente= document.getElementById("ville_attente");
	var titre_resp_attente= document.getElementById("titre_resp_attente");
	var nom_resp_attente= document.getElementById("nom_resp_attente");
    var prenom_resp_attente= document.getElementById("prenom_resp_attente");
    var telephone_attente= document.getElementById("telephone_attente");
    var tel_mobile_attente= document.getElementById("tel_mobile_attente");
    var courriel1_attente= document.getElementById("courriel1_attente");
    var courriel2_attente= document.getElementById("courriel2_attente");
	var validation=true; 

// Test si l'adresse est complète
	if (nom_attente.value.length<3)
		{ 	alert("Veuillez renseigner le nom de l'inscrit");
			validation=false; }
	if (prenom_attente.value.length<3)
		{ 	alert("Veuillez renseigner le prénom de l'inscrit");
			validation=false; }
	if (cdpostal_attente.value.length<3)
		{ 	alert("Veuillez renseigner le code postal de l'inscrit");
			validation=false; }
	if (ville_attente.value.length<3)
		{ 	alert("Veuillez renseigner la ville de l'inscrit");
			validation=false; }
	if (titre_resp_attente.value.length<3)
		{ 	alert("Veuillez renseigner le titre de la personne à avertir");
			validation=false; }
	if (nom_resp_attente.value.length<3)
		{ 	alert("Veuillez renseigner le nom de la personne à avertir");
			validation=false; }
	if (prenom_resp_attente.value.length<3)
		{ 	alert("Veuillez renseigner le prénom de la personne à avertir");
			validation=false; }
	if (telephone_attente.value.length<10&tel_mobile_attente.value.length<10)
		{ 	alert("Veuillez renseigner au moins un numéro de telephone de la personne à avertir");
			validation=false; }
	if (!bonmail(courriel1_attente.value))
		{ 	alert("Veuillez renseigner un courriel valide de la personne à avertir");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}

function control_recherche()
{
	var msg = "Vous avez réutilisé les données de l'année dernière. Avez-vous bien vérifié que celles-ci sont à jour ?";
	return confirm(msg);
}


function valider_adresse_inscrit()
{
// Déclaration de variables
	var titre= document.getElementById("titre");
	var nom= document.getElementById("nom_usage");
    var prenom= document.getElementById("prenom");
    var taille_teeshirt= document.getElementById("taille_teeshirt");
	var adresse_1= document.getElementById("adresse_1");
	var adresse_2= document.getElementById("adresse_2");
	var adresse_3= document.getElementById("adresse_3");
    var cdpostal= document.getElementById("cdpostal");
    var ville= document.getElementById("ville");
    var ville_naissance= document.getElementById("ville_naissance");
    var dep_naissance= document.getElementById("dep_naissance");
    var telephone= document.getElementById("telephone");
    var tel_mobile= document.getElementById("tel_mobile");
    var courriel= document.getElementById("courriel");
	var a_nai_1= document.getElementById("a_nai_1");
	var validation=true; 

// Test si l'adresse est complète
	if (titre.value.length<3)
		{ 	alert("Veuillez renseigner le titre de l'inscrit");
			validation=false; }
	if (nom.value.length<3)
		{ 	alert("Veuillez renseigner le nom de l'inscrit");
			validation=false; }
	if (prenom.value.length<3)
		{ 	alert("Veuillez renseigner le prénom de l'inscrit");
			validation=false; }
	if (taille_teeshirt.value.length<1)
		{ 	alert("Veuillez renseigner la taille du T-Shirt de l'inscrit");
			validation=false; }
	if (adresse_1.value.length<3&adresse_2.value.length<3&adresse_3.value.length<3)
		{ 	alert("Veuillez renseigner l'adresse de l'inscrit");
			validation=false; }
	if (cdpostal.value.length<3)
		{ 	alert("Veuillez renseigner le code postal de l'inscrit");
			validation=false; }
	if (ville.value.length<3)
		{ 	alert("Veuillez renseigner la ville de l'inscrit");
			validation=false; }
	if (ville_naissance.value.length<3)
		{ 	alert("Veuillez renseigner la ville de naissance de l'inscrit");
			validation=false; }
	if (telephone.value.length<10&tel_mobile.value.length<10)
		{ 	alert("Veuillez renseigner au moins un numéro de telephone de l'inscrit");
			validation=false; }
	if (!bonmail(courriel.value))
		{ 	alert("Veuillez renseigner un courriel valide de l'inscrit");
			validation=false; }
	if (a_nai_1.value.length<3)
		{ 	alert("Veuillez renseigner la date de naissance de l'inscrit");
			validation=false; }

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_naissance_etranger()
{
// Déclaration de variables
    var dep_naissance= document.getElementById("dep_naissance");
    var nom_pere= document.getElementById("nom_pere");
    var prenom_pere= document.getElementById("prenom_pere");
    var nom_mere= document.getElementById("nom_mere");
    var prenom_mere= document.getElementById("prenom_mere");
    var pays_naissance= document.getElementById("pays_naissance");
	var validation=true; 

// Test si né à l'étranger
	if (dep_naissance.value.length<5)
		{ 	
		if (nom_pere.value.length<3)
			{ 	alert("Veuillez renseigner le nom du père de l'inscrit");
				validation=false; }
		if (prenom_pere.value.length<3)
			{ 	alert("Veuillez renseigner le prénom du père de l'inscrit");
				validation=false; }
		if (nom_mere.value.length<3)
			{ 	alert("Veuillez renseigner le nom de jeune fille de la mère de l'inscrit");
				validation=false; }
		if (prenom_mere.value.length<3)
			{ 	alert("Veuillez renseigner le prénom de la mère de l'inscrit");
				validation=false; }
		if (pays_naissance.value.length<3)
			{ 	alert("Veuillez renseigner le pays de naissance de l'inscrit");
				validation=false; }
		}
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}

function Ctrl_date()
{	
// Déclaration de variables
    var j_nai_1= document.getElementById("j_nai_1");
    var m_nai_1= document.getElementById("m_nai_1");
    var a_nai_1= document.getElementById("a_nai_1");

// Mise à zéro des variables si elles ne sont pas des chiffres, et pas compatibles avec les dates
	if  (isNaN (j_nai_1.value)+(parseFloat(j_nai_1.value)<1)+(parseFloat(j_nai_1.value)>31))  {j_nai_1.value= ""}
	if  (isNaN (m_nai_1.value)+(parseFloat(m_nai_1.value)<1)+(parseFloat(m_nai_1.value)>12))  {m_nai_1.value= ""}
	if  (isNaN (a_nai_1.value)+(parseFloat(a_nai_1.value)<1917)+(parseFloat(a_nai_1.value)>2008))  {a_nai_1.value= ""}
}

function Ctrl_date_valide()
{
	var j_nai_1= document.getElementById("j_nai_1");
    var m_nai_1= document.getElementById("m_nai_1");
    var a_nai_1= document.getElementById("a_nai_1");
	var validation=true; 
	var ma_date = new Date();
	
// Verifie que la date est valide
	ma_date.setFullYear(a_nai_1.value,m_nai_1.value-1,j_nai_1.value);
	if(ma_date.getFullYear()!=a_nai_1.value || ma_date.getMonth()!=(m_nai_1.value-1) || ma_date.getDate()!=j_nai_1.value)
		{ 	alert("La date de naissance n'est pas valide" + ma_date.getFullYear() + "/" + a_nai_1.value + "/" + ma_date.getMonth() + "/" +(m_nai_1.value-1) + "/" + ma_date.getDate()+ "/" +j_nai_1.value);
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_sexe()
{	
// Déclaration de variables
    var sexe= document.getElementById("sexe").value;
	var titre= document.getElementById("titre").value;
	var validation=true; 

	if (sexe.length<1)
		{ 	alert("Veuillez renseigner le sexe de l'inscrit");
			validation=false; }
	if (sexe=="F"&titre!="Madame"&titre!="Mademoiselle"&titre!="Soeur" )
		{ 	alert("Veuillez corriger le sexe (F) ou le titre de l'inscrit, ceci ne sont pas cohérents");
			validation=false; }
	if (sexe=="H"&titre!="Monsieur"&titre!="Frere"&titre!="Pere"&titre!="Mgr" )
		{ 	alert("Veuillez corriger le sexe (H) ou le titre de l'inscrit, ceci ne sont pas cohérents");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_reglement_enfant()
{	
// Déclaration de variables
    var reglement= document.getElementById("reglement");
	var validation=true; 

	if (reglement.checked==false)
		{ 	alert("Veuillez choisir le réglement");
			validation=false; }

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_scolaire()
{	
// Déclaration de variables
    var etablissement_scolaire= document.getElementById("etablissement_scolaire");
    var classe= document.getElementById("classe");
	var validation=true; 

	if (etablissement_scolaire.value.length<6)
		{ 	alert("Veuillez renseigner l'établissement scolaire de l'inscrit");
			validation=false; }
	if (classe.value.length<1)
		{ 	alert("Veuillez renseigner la classe de l'inscrit");
			validation=false; }

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_encadrement()
{	
// Déclaration de variables
    var diplome_encadrement= document.getElementById("diplome_encadrement");
	var validation=true; 

	if (diplome_encadrement.value<1)
		{ 	alert("Veuillez renseigner vos diplomes d'encadrement");
			validation=false; }

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_niveau_scolaire()
{	
// Déclaration de variables
    var niveau_scolaire= document.getElementById("niveau_scolaire");
	var validation=true; 

	if (niveau_scolaire.value.length<3)
		{ 	alert("Veuillez renseigner le niveau scolaire");
			validation=false; }

if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_diocese()
{	
// Déclaration de variables
    var diocese= document.getElementById("diocese");
	var validation=true; 

	if (diocese.value.length<3)
		{ 	alert("Veuillez renseigner le diocèse de rattachement ou la congrégation");
			validation=false; }

if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}

function valider_profession_competence()
{	
// Déclaration de variables
    var profession= document.getElementById("profession");
    var competence= document.getElementById("competence");
	var validation=true; 

	if (profession.value.length<3)
		{ 	alert("N'oubliez pas que mère de famille, c'est une profession!! Merci de remplir la case profession");
			validation=false; }
	if (competence.value.length<3)
		{ 	alert("Pas de fausse modestie !! Veuillez remplir la case des compétences utiles");
			validation=false; }

if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}

function valider_adresse_resp()
{
// Déclaration de variables
	var nom_resp= document.getElementById("nom_resp");
    var prenom_resp= document.getElementById("prenom_resp");
	var adresse_1_resp= document.getElementById("adresse_1_resp");
	var adresse_2_resp= document.getElementById("adresse_2_resp");
	var adresse_3_resp= document.getElementById("adresse_3_resp");
    var cdpostal_resp= document.getElementById("cdpostal_resp");
    var ville_resp= document.getElementById("ville_resp");
    var telephone_resp= document.getElementById("telephone_resp");
    var tel_mobile_resp= document.getElementById("tel_mobile_resp");
    var tel_mobile_resp2= document.getElementById("tel_mobile_resp2");
    var courriel_resp= document.getElementById("courriel_resp");
	var validation=true; 

// Test si l'adresse est complète
	if (nom_resp.value.length<3)
		{ 	alert("Veuillez renseigner le nom du responsable");
			validation=false; }
	if (prenom_resp.value.length<3)
		{ 	alert("Veuillez renseigner le prénom du responsable");
			validation=false; }
	if (adresse_1_resp.value.length<3&adresse_2_resp.value.length<3&adresse_3_resp.value.length<3)
		{ 	alert("Veuillez renseigner l'adresse du responsable");
			validation=false; }
	if (cdpostal_resp.value.length<3)
		{ 	alert("Veuillez renseigner le code postal du responsable");
			validation=false; }
	if (ville_resp.value.length<3)
		{ 	alert("Veuillez renseigner la ville du responsable");
			validation=false; }
	if (telephone_resp.value.length<10&tel_mobile_resp.value.length<10&tel_mobile_resp2.value.length<10)
		{ 	alert("Veuillez renseigner au moins un numéro de telephone du responsable");
			validation=false; }
	if (!bonmail(courriel_resp.value))
		{ 	alert("Veuillez renseigner un courriel valide");
			validation=false; }

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_adresse_personne_a_contacter()
{
// Déclaration de variables
	var nom_resp= document.getElementById("nom_resp");
    var prenom_resp= document.getElementById("prenom_resp");
	var adresse_1_resp= document.getElementById("adresse_1_resp");
	var adresse_2_resp= document.getElementById("adresse_2_resp");
	var adresse_3_resp= document.getElementById("adresse_3_resp");
    var cdpostal_resp= document.getElementById("cdpostal_resp");
    var ville_resp= document.getElementById("ville_resp");
    var telephone_resp= document.getElementById("telephone_resp");
    var tel_mobile_resp= document.getElementById("tel_mobile_resp");
    var tel_mobile_resp2= document.getElementById("tel_mobile_resp2");
    var courriel_resp= document.getElementById("courriel_resp");
	var validation=true; 

// Test si l'adresse est complète
	if (nom_resp.value.length<3)
		{ 	alert("Veuillez renseigner le nom de la personne à prévenir en cas d'urgence");
			validation=false; }
	if (prenom_resp.value.length<3)
		{ 	alert("Veuillez renseigner le prénom de la personne à prévenir en cas d'urgence");
			validation=false; }
	if (adresse_1_resp.value.length<3&adresse_2_resp.value.length<3&adresse_3_resp.value.length<3)
		{ 	alert("Veuillez renseigner l'adresse de la personne à prévenir en cas d'urgence");
			validation=false; }
	if (cdpostal_resp.value.length<3)
		{ 	alert("Veuillez renseigner le code postal de la personne à prévenir en cas d'urgence");
			validation=false; }
	if (ville_resp.value.length<3)
		{ 	alert("Veuillez renseigner la ville de la personne à prévenir en cas d'urgence");
			validation=false; }
	if (telephone_resp.value.length<10&tel_mobile_resp.value.length<10&tel_mobile_resp2.value.length<10)
		{ 	alert("Veuillez renseigner au moins un numéro de telephone de la personne à prévenir en cas d'urgence");
			validation=false; }
	//if (!bonmail(courriel_resp.value))
		//{ 	alert("Veuillez renseigner un courriel valide de la personne à prévenir en cas d'urgence");
			//validation=false; }

  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}function valider_lien_personne()
{
// Déclaration de variables
	var lien_personne= document.getElementById("lien_personne");
	var validation=true; 

// Test si la réponse est complète
	if (lien_personne.value.length<3)
		{ 	alert("Veuillez renseigner le lien avec la personne responsable");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_assurance_rc()
{
// Déclaration de variables
	var assurance_information= document.getElementById("assurance_information");
	var validation=true; 

// Test si la réponse est complète
	if (assurance_information.checked==false)
		{ 	alert("Veuillez cocher que vous avez été informé de l'intérêt de souscrire une assurance RC ou extra-scolaire");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_droit_image()
{
// Déclaration de variables
	var droit_image= document.getElementById("droit_image");
	var validation=true; 

// Test si la réponse est complète
	if (droit_image.checked==false)
		{ 	alert("Désolé, mais il n'y a pas de bénévole disponible pour parcourir l'ensemble des photos et video qui seront prises lors du camp et y extraire les prises où vous serez présent.\nSi vous vous proposez de faire le camp avec nous dans l'équipe multi-média, ça peut se discuter....\nen attendant, il vous faut cocher le droit à l'image...");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_materiel()
{
// Déclaration de variables
	var materiel_verifie= document.getElementById("materiel_verifie");
	var validation=true; 

// Test si la réponse est complète
	if (materiel_verifie.checked==false)
		{ 	alert("Veuillez cocher que le matériel a été vérifié");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_poste()
{
// Déclaration de variables
	var parcours= document.getElementById("parcours");
	var intendance= document.getElementById("intendance");
	var velo= document.getElementById("velo");
	var media= document.getElementById("media");
	var infirmerie= document.getElementById("infirmerie");
	var secretariat= document.getElementById("secretariat");
	var technique= document.getElementById("technique");
	var priere= document.getElementById("priere");
	var validation=true; 

// Test si la réponse est complète
	if (parcours.checked+intendance.checked+velo.checked+media.checked+infirmerie.checked+secretariat.checked+technique.checked+priere.checked==false)
		{ 	alert("Veuillez cocher le poste pour le service");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}
function valider_reglement()
{
// Déclaration de variables
	var reglement= document.getElementById("reglement");
	var validation=true; 

// Test si la réponse est complète
	if (reglement.value<=0)
		{ 	alert("Veuillez cocher le montant du réglement");
			validation=false; }
  if(validation==true) {
    // les données sont ok, on peut envoyer le formulaire
    return true;
  }
  else {
    return false;
  }
}