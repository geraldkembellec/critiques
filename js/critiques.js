// JavaScript Document
function eswd_charger_fichier(fichier, mode){
	// Retourne le contenu HTML d'une page, perment ensuite de l'insérer dans un div 
	var requete = null;
	if (mode == undefined || mode == '') mode = false;
	if (window.XMLHttpRequest) requete = new XMLHttpRequest();
	else if (window.ActiveXObject) requete = new ActiveXObject("Microsoft.XMLHTTP");
	else return;
	requete.open('GET', fichier, mode);
	requete.send(null);
	return requete.responseText;
}
function afficher_autre(){
	// Fait apparaitre un champs complémentaire dans la saisie de signature d'une critique
	if(document.forms.critique.typeSignature.selectedIndex==2){
		document.getElementById('autre_signature').style.visibility="visible";
		document.getElementById('autre_signature').style.display="block";
	}
	else{
		document.getElementById('autre_signature').style.visibility="hidden";
		document.getElementById('autre_signature').style.display="none";
	}; 
}
function afficher_type_critique(){
	// Selecteur de formulaire
	switch (document.forms.critique.typeCritique.selectedIndex) {
		case 1:
			// Revue
			document.getElementById('revue').style.visibility="visible";
			document.getElementById('revue').style.display="block";
			document.getElementById('monographie').style.visibility="hidden";
			document.getElementById('monographie').style.display="none";
			document.getElementById('chapitre_ouvrage').style.visibility="hidden";
			document.getElementById('chapitre_ouvrage').style.display="none";
			document.getElementById('monographie').innerHTML ='';
			document.getElementById('chapitre_ouvrage').innerHTML ='';
			contenu=eswd_charger_fichier('revue.php', false);
			document.getElementById('revue').innerHTML = contenu;
		break;
		case 2:
			// Chapitre
			document.getElementById('chapitre_ouvrage').style.visibility="visible";
			document.getElementById('chapitre_ouvrage').style.display="block";
			document.getElementById('monographie').style.visibility="hidden";
			document.getElementById('monographie').style.display="none";
			document.getElementById('revue').style.visibility="hidden";
			document.getElementById('revue').style.display="none";
			document.getElementById('revue').innerHTML ='';
			document.getElementById('monographie').innerHTML ='';
			contenu=eswd_charger_fichier('chapitre.php', false);
			document.getElementById('chapitre_ouvrage').innerHTML = contenu;
		break;
		case 3: 
			document.getElementById('chapitre_ouvrage').style.visibility="visible";
			document.getElementById('chapitre_ouvrage').style.display="block";
			document.getElementById('monographie').style.visibility="hidden";
			document.getElementById('monographie').style.display="none";
			document.getElementById('revue').style.visibility="hidden";
			document.getElementById('revue').style.display="none";
			document.getElementById('revue').innerHTML ='';
			document.getElementById('monographie').innerHTML ='';
			contenu=eswd_charger_fichier('chapitre.php', false);
			document.getElementById('chapitre_ouvrage').innerHTML = contenu;
		break;
		case 4: 
			document.getElementById('chapitre_ouvrage').style.visibility="visible";
			document.getElementById('chapitre_ouvrage').style.display="block";
			document.getElementById('monographie').style.visibility="hidden";
			document.getElementById('monographie').style.display="none";
			document.getElementById('revue').style.visibility="hidden";
			document.getElementById('revue').style.display="none";
			document.getElementById('revue').innerHTML ='';
			document.getElementById('monographie').innerHTML ='';
			contenu=eswd_charger_fichier('chapitre.php', false);
			document.getElementById('chapitre_ouvrage').innerHTML = contenu;
		break;
		case 5: 
			document.getElementById('chapitre_ouvrage').style.visibility="visible";
			document.getElementById('chapitre_ouvrage').style.display="block";
			document.getElementById('monographie').style.visibility="hidden";
			document.getElementById('monographie').style.display="none";
			document.getElementById('revue').style.visibility="hidden";
			document.getElementById('revue').style.display="none";
			document.getElementById('revue').innerHTML ='';
			document.getElementById('monographie').innerHTML ='';
			contenu=eswd_charger_fichier('chapitre.php', false);
			document.getElementById('chapitre_ouvrage').innerHTML = contenu;
		break;
		case 6:
			document.getElementById('monographie').style.visibility="visible";
			document.getElementById('monographie').style.display="block";
			document.getElementById('chapitre_ouvrage').style.visibility="hidden";
			document.getElementById('chapitre_ouvrage').style.display="none";
			document.getElementById('revue').style.visibility="hidden";
			document.getElementById('revue').style.display="none";
			document.getElementById('revue').innerHTML ='';
			document.getElementById('chapitre_ouvrage').innerHTML ='';
			contenu=eswd_charger_fichier('monographie.php', false);
			document.getElementById('monographie').innerHTML = contenu;
		break;
		default:
			document.getElementById('revue').style.visibility="visible";
			document.getElementById('revue').style.display="block";
			document.getElementById('monographie').style.visibility="hidden";
			document.getElementById('monographie').style.display="none";
			document.getElementById('chapitre_ouvrage').style.visibility="hidden";
			document.getElementById('chapitre_ouvrage').style.display="none";
			document.getElementById('monographie').innerHTML ='';
			document.getElementById('chapitre_ouvrage').innerHTML ='';
			contenu=eswd_charger_fichier('revue.php', false);
			document.getElementById('revue').innerHTML = contenu;
		break;
	}
}
function cache() {
	// Cache le div transparent
	document.getElementById("transparent").style.visibility="hidden";
	document.getElementById("transparent").style.height="0px";
}
function recherche_avancee() {
	// Affiche le formulaire avancé
	document.getElementById("avancee").style.visibility="visible";
	document.getElementById("avancee").style.display="block";
	document.getElementById("simple").style.visibility="hidden";
	document.getElementById("simple").style.display="none";
}
function recherche_simple() {
	// Affiche le formulaire avancé
	document.getElementById("simple").style.visibility="visible";
	document.getElementById("simple").style.display="block";
	document.getElementById("avancee").style.visibility="hidden";
	document.getElementById("avancee").style.display="none";
}
function nouvelle_revue() {
	// Affiche le formulaire de saisie de revue dans le div transparent
	var text = '';
	document.getElementById("transparent").style.height="260px";
	document.getElementById("transparent").style.visibility="visible";
	//text+='<form id="nouvelle_revue" name="nouvelle_revue" method="post" action="nouvelleRevue.php" onSubmit="return(envoyerNouveauPeriodique(this));">';
	text+='<form id="nouvelle_revue" name="nouvelle_revue" method="post" action="nouvelleRevue.php">';
	text+='<h3>Vous allez saisir un nouveau Périodique</h3>';
	text+='<p><label class="control-label col-sm-8">Titre du périodique</label><input name="TitrePeriodique" type="text" size="45" maxlength="255" required /><p>';
    //text+='<p><label class="control-label col-sm-8">Complément de titre de périodique</label>';
	//text+='<input name="ComplementTitrePeriodique" type="text" size="45" maxlength="255" /></p>';
	text+='<p><label class="control-label col-sm-8">Période Couverte</label><input name="PériodeCouverte" type="text" size="9" maxlength="9" /></p>';
	text+='<p><label class="control-label col-sm-8">Périodicité</label>';
    text+='<select name="type"><option value="mensuel">Mensuel</option><option value="quotidien">Quotidien</option>';
	text+='<option value="hebdomadaire">Hebdomadaire</option>';
	text+='<option value="bi-mensuel">Bi-mensuel</option><option value="semestriel">Semestriel</option><option value="annuel">Annuel</option>';
	text+='<option value="trimestriel">Trimestriel</option><option value="nonrenseigne">Non Renseigné</option></select><p>';
	text+='<p><label class="control-label col-sm-8">ISSN</label><input name="issn" type="text" size="9" maxlength="9" /></p>';
	text+='<p><input type="submit" value="Valider la saisie du nouveau périodique" style="margin-right: 10px;">';
    text+='<input type="button" Value="Annuler" onClick="javascript:cache();" style="margin-right: 10px;" />';
    text+='</p></form>';
	document.getElementById("transparent").innerHTML = text;
}
function nouvel_ouvrage() {
	// Affiche le formulaire de saisie d'ouvrage dans le div transparent
	var text = '';
	document.getElementById("transparent").style.height="480px";
	document.getElementById("transparent").style.visibility="visible";
	text+='<form id="nouvelOuvrage" name="nouvelOuvrage" method="post" action="nouvelOuvrage.php">';
	text+='<h3>Vous allez saisir un nouvel ouvrage</h3>';
	text+='<p><label class="control-label col-sm-8">Titre de l\'ouvrage</label><input name="TitreOuvrage" type="text" size="50" maxlength="255" required /></p>';
    text+='<p><label class="control-label col-sm-8">Complément de titre de l\'ouvrage</label><input name="SousTitreOuvrage" type="text" size="50" maxlength="255" /></p>';
    text+='<p><label class="control-label col-sm-8">Coordination de l\'ouvrage</label><input name="CoordinationOuvrage" type="text" size="50" maxlength="255" /></p>';
    text+='<p><label class="control-label col-sm-8">Collection de l\'ouvrage</label><input name="CollectionOuvrage" type="text" size="50" maxlength="255" /></p>';
    text+='<p><label class="control-label col-sm-8">Pagination (n.p. si non paginé, n.r. si non renseigné)</label><input name="Pagination" type="text" size="20" maxlength="20" /></p>';
	text+='<p><label class="control-label col-sm-8">Année d\'édition</label><input name="AnneeEdition" type="text" size="4" maxlength="4" required /></p>';
	text+='<p><label class="control-label col-sm-8">Editeur</label><input name="Editeur" id="Editeur" type="text" size="50" maxlength="255" /></p>';
	text+='<p><label class="control-label col-sm-8">Année de première éditon (si nécessaire)</label>';
	text+='<input name="Edition" type="text" size="4" maxlength="4" /></p>';
	text+='<p><label class="control-label col-sm-8">Ville d\'édition</label><input name="VilleEdition" type="text" size="50" maxlength="255" /></p>';
    text+='<p><label class="control-label col-sm-8">ISBN</label><input name="ISBN" type="text" size="19" maxlength="19" /></p>';
	text+='<p><input type="submit" value="Valider la saisie du nouvel ouvrage" style="margin-right: 10px;">';
    text+='<input type="button" Value="Annuler" onClick="javascript:cache();" style="margin-right: 10px;" />';
    text+='</p></form>';
	document.getElementById("transparent").innerHTML = text;
}
function multi() {
	document.getElementById('multi').style.display="block";
	document.getElementById('multi').style.visibility="visible";     
	document.getElementById('collectif').style.display="none";
	document.getElementById('collectif').style.visibility="hidden";
	vider();
}
function collectif() {
	document.getElementById('collectif').style.display="block";
	document.getElementById('collectif').style.visibility="visible";    
	document.getElementById('multi').style.visibility="hidden";   
	document.getElementById('multi').style.display="none";
	vider();
}
function vider(){
	document.getElementById('auteur').value = "";
	document.getElementById('auteurs').value = "";
	document.getElementById('collectif_nomme').value = "";
	return false;
};