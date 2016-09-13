// JavaScript Document
function copie_cheque1()
{
    var nom_cheque_1 = document.getElementById("nom_cheque_1");
    var prenom_cheque_1 = document.getElementById("prenom_cheque_1");
    var nom_resp = document.getElementById("nom_inscription").value;
    var prenom_resp = document.getElementById("prenom_inscription").value;

	if (nom_cheque_1.value=="")
	{
		nom_cheque_1.value=nom_resp;
		prenom_cheque_1.value=prenom_resp;
	};
}
function copie_cheque2()
{
    var nom_cheque_2 = document.getElementById("nom_cheque_2");
    var prenom_cheque_2 = document.getElementById("prenom_cheque_2");
    var nom_cheque_1 = document.getElementById("nom_cheque_1").value;
    var prenom_cheque_1 = document.getElementById("prenom_cheque_1").value;

	if (nom_cheque_2.value=="")
	{
		nom_cheque_2.value=nom_cheque_1;
		prenom_cheque_2.value=prenom_cheque_1;
	};
}
function copie_cheque3()
{
    var nom_cheque_3 = document.getElementById("nom_cheque_3");
    var prenom_cheque_3 = document.getElementById("prenom_cheque_3");
    var nom_cheque_2 = document.getElementById("nom_cheque_2").value;
    var prenom_cheque_2 = document.getElementById("prenom_cheque_2").value;

	if (nom_cheque_3.value=="")
	{
		nom_cheque_3.value=nom_cheque_2;
		prenom_cheque_3.value=prenom_cheque_2;
	};
}


function calculer_reste_a_payer()
{
    var total_reglement = parseFloat(document.getElementById("total_reglement").value);
    var montant_1 = parseFloat(document.getElementById("montant_1").value);
    var montant_2 = parseFloat(document.getElementById("montant_2").value);
    var montant_3 = parseFloat(document.getElementById("montant_3").value);
    var liquide = parseFloat(document.getElementById("liquide").value);
    var reglement_caf = parseFloat(document.getElementById("reglement_caf").value);
    var nb_cheque_10 = parseFloat(document.getElementById("nb_cheque_10").value);
    var nb_cheque_20 = parseFloat(document.getElementById("nb_cheque_20").value);
    var reste_a_regler = document.getElementById("reste_a_regler");

  	reste_a_regler.value  = total_reglement - ( montant_1  + montant_2 + montant_3 + liquide + reglement_caf + 10* nb_cheque_10 + 20*nb_cheque_20) ;
}
function remplir_petit_dej()
{
	// Déclaration de variables
	var petit_dej_23= document.getElementById("petit_dej_23");
	var petit_dej_24= document.getElementById("petit_dej_24");
	var petit_dej_25= document.getElementById("petit_dej_25");
	var petit_dej_26= document.getElementById("petit_dej_26");
	var petit_dej_27= document.getElementById("petit_dej_27");
	var petit_dej_28= document.getElementById("petit_dej_28");
	var petit_dej_29= document.getElementById("petit_dej_29");
	var petit_dej_30= document.getElementById("petit_dej_30");
	var petit_dej_tout= document.getElementById("petit_dej_tout");

	    if (petit_dej_tout.checked==false)
	    {
			petit_dej_23.checked = false;
		    petit_dej_24.checked = false;
		    petit_dej_25.checked = false;
		    petit_dej_26.checked = false;
		    petit_dej_27.checked = false;
		    petit_dej_28.checked = false;
		    petit_dej_29.checked = false;
		    petit_dej_30.checked = false;
         }
		 else
		{
		    petit_dej_23.checked = true;
		    petit_dej_24.checked = true;
		    petit_dej_25.checked = true;
		    petit_dej_26.checked = true;
		    petit_dej_27.checked = true;
		    petit_dej_28.checked = true;
		    petit_dej_29.checked = true;
		    petit_dej_30.checked = true;
		}
}
function remplir_matine()
{
	// Déclaration de variables
	var matine_23= document.getElementById("matine_23");
	var matine_24= document.getElementById("matine_24");
	var matine_25= document.getElementById("matine_25");
	var matine_26= document.getElementById("matine_26");
	var matine_27= document.getElementById("matine_27");
	var matine_28= document.getElementById("matine_28");
	var matine_29= document.getElementById("matine_29");
	var matine_30= document.getElementById("matine_30");
	var matine_tout= document.getElementById("matine_tout");

	    if (matine_tout.checked==false)
	    {
			matine_23.checked = false;
		    matine_24.checked = false;
		    matine_25.checked = false;
		    matine_26.checked = false;
		    matine_27.checked = false;
		    matine_28.checked = false;
		    matine_29.checked = false;
		    matine_30.checked = false;
         }
		 else
		{
		    matine_23.checked = true;
		    matine_24.checked = true;
		    matine_25.checked = true;
		    matine_26.checked = true;
		    matine_27.checked = true;
		    matine_28.checked = true;
		    matine_29.checked = true;
		    matine_30.checked = true;
		}
}
function remplir_dejeuner()
{
	// Déclaration de variables
	var dejeuner_23= document.getElementById("dejeuner_23");
	var dejeuner_24= document.getElementById("dejeuner_24");
	var dejeuner_25= document.getElementById("dejeuner_25");
	var dejeuner_26= document.getElementById("dejeuner_26");
	var dejeuner_27= document.getElementById("dejeuner_27");
	var dejeuner_28= document.getElementById("dejeuner_28");
	var dejeuner_29= document.getElementById("dejeuner_29");
	var dejeuner_30= document.getElementById("dejeuner_30");
	var dejeuner_tout= document.getElementById("dejeuner_tout");

	    if (dejeuner_tout.checked==false)
	    {
			dejeuner_23.checked = false;
		    dejeuner_24.checked = false;
		    dejeuner_25.checked = false;
		    dejeuner_26.checked = false;
		    dejeuner_27.checked = false;
		    dejeuner_28.checked = false;
		    dejeuner_29.checked = false;
		    dejeuner_30.checked = false;
         }
		 else
		{
		    dejeuner_23.checked = true;
		    dejeuner_24.checked = true;
		    dejeuner_25.checked = true;
		    dejeuner_26.checked = true;
		    dejeuner_27.checked = true;
		    dejeuner_28.checked = true;
		    dejeuner_29.checked = true;
		    dejeuner_30.checked = true;
		}
}
function remplir_apres_midi()
{
	// Déclaration de variables
	var apres_midi_23= document.getElementById("apres_midi_23");
	var apres_midi_24= document.getElementById("apres_midi_24");
	var apres_midi_25= document.getElementById("apres_midi_25");
	var apres_midi_26= document.getElementById("apres_midi_26");
	var apres_midi_27= document.getElementById("apres_midi_27");
	var apres_midi_28= document.getElementById("apres_midi_28");
	var apres_midi_29= document.getElementById("apres_midi_29");
	var apres_midi_30= document.getElementById("apres_midi_30");
	var apres_midi_tout= document.getElementById("apres_midi_tout");

	    if (apres_midi_tout.checked==false)
	    {
			apres_midi_23.checked = false;
		    apres_midi_24.checked = false;
		    apres_midi_25.checked = false;
		    apres_midi_26.checked = false;
		    apres_midi_27.checked = false;
		    apres_midi_28.checked = false;
		    apres_midi_29.checked = false;
		    apres_midi_30.checked = false;
         }
		 else
		{
		    apres_midi_23.checked = true;
		    apres_midi_24.checked = true;
		    apres_midi_25.checked = true;
		    apres_midi_26.checked = true;
		    apres_midi_27.checked = true;
		    apres_midi_28.checked = true;
		    apres_midi_29.checked = true;
		    apres_midi_30.checked = true;
		}
}
function remplir_diner()
{
	// Déclaration de variables
	var diner_23= document.getElementById("diner_23");
	var diner_24= document.getElementById("diner_24");
	var diner_25= document.getElementById("diner_25");
	var diner_26= document.getElementById("diner_26");
	var diner_27= document.getElementById("diner_27");
	var diner_28= document.getElementById("diner_28");
	var diner_29= document.getElementById("diner_29");
	var diner_30= document.getElementById("diner_30");
	var diner_tout= document.getElementById("diner_tout");

	    if (diner_tout.checked==false)
	    {
			diner_23.checked = false;
		    diner_24.checked = false;
		    diner_25.checked = false;
		    diner_26.checked = false;
		    diner_27.checked = false;
		    diner_28.checked = false;
		    diner_29.checked = false;
		    diner_30.checked = false;
         }
		 else
		{
		    diner_23.checked = true;
		    diner_24.checked = true;
		    diner_25.checked = true;
		    diner_26.checked = true;
		    diner_27.checked = true;
		    diner_28.checked = true;
		    diner_29.checked = true;
		    diner_30.checked = true;
		}
}
function remplir_soiree()
{
	// Déclaration de variables
	var soiree_23= document.getElementById("soiree_23");
	var soiree_24= document.getElementById("soiree_24");
	var soiree_25= document.getElementById("soiree_25");
	var soiree_26= document.getElementById("soiree_26");
	var soiree_27= document.getElementById("soiree_27");
	var soiree_28= document.getElementById("soiree_28");
	var soiree_29= document.getElementById("soiree_29");
	var soiree_30= document.getElementById("soiree_30");
	var soiree_tout= document.getElementById("soiree_tout");

	    if (soiree_tout.checked==false)
	    {
			soiree_23.checked = false;
		    soiree_24.checked = false;
		    soiree_25.checked = false;
		    soiree_26.checked = false;
		    soiree_27.checked = false;
		    soiree_28.checked = false;
		    soiree_29.checked = false;
		    soiree_30.checked = false;
         }
		 else
		{
		    soiree_23.checked = true;
		    soiree_24.checked = true;
		    soiree_25.checked = true;
		    soiree_26.checked = true;
		    soiree_27.checked = true;
		    soiree_28.checked = true;
		    soiree_29.checked = true;
		    soiree_30.checked = true;
		}
}
function remplir_tente()
{
	// Déclaration de variables
	var tente_23= document.getElementById("tente_23");
	var tente_24= document.getElementById("tente_24");
	var tente_25= document.getElementById("tente_25");
	var tente_26= document.getElementById("tente_26");
	var tente_27= document.getElementById("tente_27");
	var tente_28= document.getElementById("tente_28");
	var tente_29= document.getElementById("tente_29");
	var tente_30= document.getElementById("tente_30");
	var tente_tout= document.getElementById("tente_tout");

	    if (tente_tout.checked==false)
	    {
			tente_23.checked = false;
		    tente_24.checked = false;
		    tente_25.checked = false;
		    tente_26.checked = false;
		    tente_27.checked = false;
		    tente_28.checked = false;
		    tente_29.checked = false;
		    tente_30.checked = false;
         }
		 else
		{
		    tente_23.checked = true;
		    tente_24.checked = true;
		    tente_25.checked = true;
		    tente_26.checked = true;
		    tente_27.checked = true;
		    tente_28.checked = true;
		    tente_29.checked = true;
		    tente_30.checked = true;
		}
}
function remplir_23()
{
	// Déclaration de variables
	var petit_dej_23= document.getElementById("petit_dej_23");
	var matine_23= document.getElementById("matine_23");
	var dejeuner_23= document.getElementById("dejeuner_23");
	var apres_midi_23= document.getElementById("apres_midi_23");
	var diner_23= document.getElementById("diner_23");
	var soiree_23= document.getElementById("soiree_23");
	var tente_23= document.getElementById("tente_23");
	var t23_tout= document.getElementById("23_tout");

		if (t23_tout.checked==false)
	    {
			petit_dej_23.checked = false;
		    matine_23.checked = false;
		    dejeuner_23.checked = false;
		    apres_midi_23.checked = false;
		    diner_23.checked = false;
		    soiree_23.checked = false;
		    tente_23.checked = false;
         }
		 else
		{
			petit_dej_23.checked = true;
		    matine_23.checked = true;
		    dejeuner_23.checked = true;
		    apres_midi_23.checked = true;
		    diner_23.checked = true;
		    soiree_23.checked = true;
		    tente_23.checked = true;
		}
}
function remplir_24()
{
	// Déclaration de variables
	var petit_dej_24= document.getElementById("petit_dej_24");
	var matine_24= document.getElementById("matine_24");
	var dejeuner_24= document.getElementById("dejeuner_24");
	var apres_midi_24= document.getElementById("apres_midi_24");
	var diner_24= document.getElementById("diner_24");
	var soiree_24= document.getElementById("soiree_24");
	var tente_24= document.getElementById("tente_24");
	var t24_tout= document.getElementById("24_tout");

	    if (t24_tout.checked==false)
	    {
			petit_dej_24.checked = false;
		    matine_24.checked = false;
		    dejeuner_24.checked = false;
		    apres_midi_24.checked = false;
		    diner_24.checked = false;
		    soiree_24.checked = false;
		    tente_24.checked = false;
         }
		 else
		{
			petit_dej_24.checked = true;
		    matine_24.checked = true;
		    dejeuner_24.checked = true;
		    apres_midi_24.checked = true;
		    diner_24.checked = true;
		    soiree_24.checked = true;
		    tente_24.checked = true;
		}
}
function remplir_25()
{
	// Déclaration de variables
	var petit_dej_25= document.getElementById("petit_dej_25");
	var matine_25= document.getElementById("matine_25");
	var dejeuner_25= document.getElementById("dejeuner_25");
	var apres_midi_25= document.getElementById("apres_midi_25");
	var diner_25= document.getElementById("diner_25");
	var soiree_25= document.getElementById("soiree_25");
	var tente_25= document.getElementById("tente_25");
	var t25_tout= document.getElementById("25_tout");

	    if (t25_tout.checked==false)
	    {
			petit_dej_25.checked = false;
		    matine_25.checked = false;
		    dejeuner_25.checked = false;
		    apres_midi_25.checked = false;
		    diner_25.checked = false;
		    soiree_25.checked = false;
		    tente_25.checked = false;
         }
		 else
		{
			petit_dej_25.checked = true;
		    matine_25.checked = true;
		    dejeuner_25.checked = true;
		    apres_midi_25.checked = true;
		    diner_25.checked = true;
		    soiree_25.checked = true;
		    tente_25.checked = true;
		}
}
function remplir_26()
{
	// Déclaration de variables
	var petit_dej_26= document.getElementById("petit_dej_26");
	var matine_26= document.getElementById("matine_26");
	var dejeuner_26= document.getElementById("dejeuner_26");
	var apres_midi_26= document.getElementById("apres_midi_26");
	var diner_26= document.getElementById("diner_26");
	var soiree_26= document.getElementById("soiree_26");
	var tente_26= document.getElementById("tente_26");
	var t26_tout= document.getElementById("26_tout");

	    if (t26_tout.checked==false)
	    {
			petit_dej_26.checked = false;
		    matine_26.checked = false;
		    dejeuner_26.checked = false;
		    apres_midi_26.checked = false;
		    diner_26.checked = false;
		    soiree_26.checked = false;
		    tente_26.checked = false;
         }
		 else
		{
			petit_dej_26.checked = true;
		    matine_26.checked = true;
		    dejeuner_26.checked = true;
		    apres_midi_26.checked = true;
		    diner_26.checked = true;
		    soiree_26.checked = true;
		    tente_26.checked = true;
		}
}
function remplir_27()
{
	// Déclaration de variables
	var petit_dej_27= document.getElementById("petit_dej_27");
	var matine_27= document.getElementById("matine_27");
	var dejeuner_27= document.getElementById("dejeuner_27");
	var apres_midi_27= document.getElementById("apres_midi_27");
	var diner_27= document.getElementById("diner_27");
	var soiree_27= document.getElementById("soiree_27");
	var tente_27= document.getElementById("tente_27");
	var t27_tout= document.getElementById("27_tout");

	    if (t27_tout.checked==false)
	    {
			petit_dej_27.checked = false;
		    matine_27.checked = false;
		    dejeuner_27.checked = false;
		    apres_midi_27.checked = false;
		    diner_27.checked = false;
		    soiree_27.checked = false;
		    tente_27.checked = false;
         }
		 else
		{
			petit_dej_27.checked = true;
		    matine_27.checked = true;
		    dejeuner_27.checked = true;
		    apres_midi_27.checked = true;
		    diner_27.checked = true;
		    soiree_27.checked = true;
		    tente_27.checked = true;
		}
}
function remplir_28()
{
	// Déclaration de variables
	var petit_dej_28= document.getElementById("petit_dej_28");
	var matine_28= document.getElementById("matine_28");
	var dejeuner_28= document.getElementById("dejeuner_28");
	var apres_midi_28= document.getElementById("apres_midi_28");
	var diner_28= document.getElementById("diner_28");
	var soiree_28= document.getElementById("soiree_28");
	var tente_28= document.getElementById("tente_28");
	var t28_tout= document.getElementById("28_tout");

	    if (t28_tout.checked==false)
	    {
			petit_dej_28.checked = false;
		    matine_28.checked = false;
		    dejeuner_28.checked = false;
		    apres_midi_28.checked = false;
		    diner_28.checked = false;
		    soiree_28.checked = false;
		    tente_28.checked = false;
         }
		 else
		{
			petit_dej_28.checked = true;
		    matine_28.checked = true;
		    dejeuner_28.checked = true;
		    apres_midi_28.checked = true;
		    diner_28.checked = true;
		    soiree_28.checked = true;
		    tente_28.checked = true;
		}
}
function remplir_29()
{
	// Déclaration de variables
	var petit_dej_29= document.getElementById("petit_dej_29");
	var matine_29= document.getElementById("matine_29");
	var dejeuner_29= document.getElementById("dejeuner_29");
	var apres_midi_29= document.getElementById("apres_midi_29");
	var diner_29= document.getElementById("diner_29");
	var soiree_29= document.getElementById("soiree_29");
	var tente_29= document.getElementById("tente_29");
	var t29_tout= document.getElementById("29_tout");

	    if (t29_tout.checked==false)
	    {
			petit_dej_29.checked = false;
		    matine_29.checked = false;
		    dejeuner_29.checked = false;
		    apres_midi_29.checked = false;
		    diner_29.checked = false;
		    soiree_29.checked = false;
		    tente_29.checked = false;
         }
		 else
		{
			petit_dej_29.checked = true;
		    matine_29.checked = true;
		    dejeuner_29.checked = true;
		    apres_midi_29.checked = true;
		    diner_29.checked = true;
		    soiree_29.checked = true;
		    tente_29.checked = true;
		}
}
function remplir_30()
{
	// Déclaration de variables
	var petit_dej_30= document.getElementById("petit_dej_30");
	var matine_30= document.getElementById("matine_30");
	var dejeuner_30= document.getElementById("dejeuner_30");
	var apres_midi_30= document.getElementById("apres_midi_30");
	var diner_30= document.getElementById("diner_30");
	var soiree_30= document.getElementById("soiree_30");
	var tente_30= document.getElementById("tente_30");
	var t30_tout= document.getElementById("30_tout");

	    if (t30_tout.checked==false)
	    {
			petit_dej_30.checked = false;
		    matine_30.checked = false;
		    dejeuner_30.checked = false;
		    apres_midi_30.checked = false;
		    diner_30.checked = false;
		    soiree_30.checked = false;
		    tente_30.checked = false;
         }
		 else
		{
			petit_dej_30.checked = true;
		    matine_30.checked = true;
		    dejeuner_30.checked = true;
		    apres_midi_30.checked = true;
		    diner_30.checked = true;
		    soiree_30.checked = true;
		    tente_30.checked = true;
		}
}