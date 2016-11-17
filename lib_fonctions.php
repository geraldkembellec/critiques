<?php
error_reporting (0);

/* Configure le script en français */
setlocale (LC_TIME, 'fr_FR','fra');
//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
date_default_timezone_set("Europe/Paris");
//Definit l'encodage interne
mb_internal_encoding("UTF-8");

function date_fr($date_us){
	//Convertir une date US en françcais
	$date_explosee = explode("-", $date_us);
	$jour = $date_explosee[2];
	switch ($date_explosee[1]) {
    	case 1:
			$mois ='janvier';
       	break;
		case 2:
			$mois ='février';
       	break;
		case 3:
			$mois ='mars';
       	break;
		case 4:
			$mois ='avril';
       	break;
		case 5:
			$mois ='mai';
       	break;
		case 6:
			$mois ='juin';
       	break;
		case 7:
			$mois ='juillet';
       	break;
		case 8:
			$mois ='août';
       	break;
		case 9:
			$mois ='septembre';
       	break;
		case 10:
			$mois ='octobre';
       	break;
		case 11:
			$mois ='novembre';
       	break;
		case 12:
			$mois ='décembre';
       	break;
	}
	$annee = $date_explosee[0];
	$date_fr=$jour.' '.$mois.' '.$annee;
	return($date_fr);
}
function milieu_header(){
	if(isset($_SESSION['user'])){
		echo "<div class=\"connection-status connection-status-connecte\">
				Bonjour ".$_SESSION['label']."&nbsp
				<a href=\"insertion.php\" style=\"color: white;\">Saisie</a>
			</div>";
	} else {
		echo "<div class=\"connection-status\">Non connecté</div>";
	}
}
function listerAuteurs(){
	// Affiche les auteurs par lettre
	// Les lettres qui ne pointent pas vers des auteurs sont grisées
	global $pdo;
	$liste='';
	foreach(range('A', 'Z') as $lettre){
		$sql = "SELECT COUNT(DISTINCT pk_id_critiqueDart) AS compteur FROM critiquedart WHERE nom LIKE '".$lettre."%' order by nom";
		$req_nb_auteur = $pdo->query($sql) or die ('erreur SQL dans la fonction listerAuteurs()');
		// On affiche chaque entrée une à une
		while ($donnees = $req_nb_auteur->fetch()){
			$ligne='';
			if($donnees["compteur"] > 0){
				$ligne.='<li><a href="annuaire_critiques.php?lettre=';
				$ligne.=$lettre;
				$ligne.='">'.$lettre.'</a></li>';
			}
			else{
				$ligne.='<li><span class="desactivate">';
				$ligne.=$lettre;
				$ligne.='</span></li>';
			}
		}
		$liste.=$ligne;
	}
	return($liste);
}
function afficherTousLesOuvragesFormOption(){
	// Dans un formulaire : liste les ouvrages collectifs
	global $pdo;
	$sql = "SELECT pk_id_ouvrage, titre, annee FROM ouvrage order by titre";
	$req_auteurs=$pdo->query($sql) or die('erreur SQL dans la fonction afficherTousLesOuvragesFormOption()'); 
	while ($r = $req_auteurs->fetch())
    {
		print('<option value="'.$r['titre'].' ('.$r['annee'].')" />');
    }
}
function afficherTousLesOuvragesFormOptionSansAnneeNiDoublon(){
	// Dans un formulaire : liste les ouvrages collectifs
	global $pdo;
	$sql = "SELECT distinct titre FROM ouvrage order by titre";
	$req_auteurs=$pdo->query($sql) or die('erreur SQL dans la fonction afficherTousLesOuvragesFormOptionSansAnneeNiDoublon('); 
	while ($r = $req_auteurs->fetch())
    {
		print('<option value="'.$r['titre'].'">');
		print($r['titre']);
		print('</option>');
    }
}
function afficherTousLesAuteurs(){
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom, anneeNaissance, anneeMort, URL_WP FROM critiquedart order by nom";
	$req_auteurs=$pdo->query($sql) or die('erreur SQL dans la fonction afficherTousLesAuteurs()'); 
	
	print('<div class="divAuteurs">');
	
	while ($r = $req_auteurs->fetch())
    {
		print('<p><a href="'.$r["URL_WP"].'">'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
    
	print('</div>');
	return($r);
}
function afficherTousLesAuteursFormOption(){
	// Dans un formulaire : liste les auteurs
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom FROM critiquedart order by nom";
	$req_auteurs=$pdo->query($sql) or die('erreur SQL dans la fonction afficherTousLesAuteursFormOption()'); 
	while ($r = $req_auteurs->fetch())
    {
		print('<option value="'.$r['pk_id_critiqueDart'].'">'.$r['prenom'].' '.$r['nom'].'</option>');
    }
}
function afficherTousLesAuteursFormOptionSansId(){
	// Dans un formulaire : liste les auteurs
	global $pdo;
	$sql = "SELECT nom, prenom FROM critiquedart order by nom";
	$req_auteurs=$pdo->query($sql) or die('erreur SQL dans la fonction afficherTousLesAuteursFormOptionSansId()'); 
	while ($r = $req_auteurs->fetch())
    {
		print('<option value="'.$r['prenom'].' '.$r['nom'].'">'.$r['prenom'].' '.$r['nom'].'</option>');
    }
}
function affichierToutesLesRevuesFormOption(){
	global $pdo;
	$sql = "SELECT titre, couverture FROM periodique ORDER BY titre";
	//echo $sql;
	$req_titre_periodique=$pdo->query($sql) or die('erreur SQL dans la fonction affichierToutesLesRevuesFormOption()'); 
	while ($r = $req_titre_periodique->fetch())
    {
		print('<option value="'.$r['titre'].' ('.$r['couverture'].')" />');
    }
}
function afficherToutesLesRevuesFormOptionSansDateNiDoublon(){
	global $pdo;
	$sql = "SELECT distinct titre FROM periodique ORDER BY titre";
	//echo $sql;
	$req_titre_periodique=$pdo->query($sql) or die('erreur SQL dans la fonction afficherToutesLesRevuesFormOptionSansDateNiDoublon()'); 
	while ($r = $req_titre_periodique->fetch())
    {
		print('<option value="'.$r['titre'].'" >'.$r['titre'].'</option>');
    }
}
function affichierToutesLesCritiquesFormOption(){
	global $pdo;
	$sql = "SELECT titre, complementTitre FROM critique WHERE (titre IS NOT NULL) ORDER BY titre";
	//echo $sql;
	$req_titre_critique=$pdo->query($sql) or die('erreur SQL dans la fonction affichierToutesLesCritiquesFormOption()'); 
	while ($r = $req_titre_critique->fetch())
    {
		print('<option value="'.$r['titre'].' '.$r['complementTitre'].'" />');
    }
}
function affichierToutesLesCritiquesFormOptionSansDoublon(){
	global $pdo;
	$sql = "SELECT distinct titre FROM critique WHERE (titre IS NOT NULL) ORDER BY titre";
	//echo $sql;
	$req_titre_critique=$pdo->query($sql) or die('erreur SQL dans la fonction affichierToutesLesCritiquesFormOptionSansDoublon()'); 
	while ($r = $req_titre_critique->fetch())
    {
		print('<option value="'.$r['titre'].'" />');
    }
}
function afficherAuteurById($id){
	// Affiche un auteur depuis son identifiant
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction afficherAuteurById()');
	while ($r = $req_auteur->fetch())
    { 
		print('<p><a href="biblio_auteur.php?critique='.$r['pk_id_critiqueDart'].'">'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
}
function afficherAuteurNomPrenomById($id){
	// Affiche un auteur depuis son identifiant
	global $pdo;
	$sql = "SELECT nom, prenom FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$chaine_retour='';
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction afficherAuteurNomPrenomById()');
	while ($r = $req_auteur->fetch())
    { 
		//print($r['prenom'].' '.$r['nom']);
		if($r['prenom']!='' && $r['prenom']!=NULL)print($r['nom'].', '.$r['prenom']);
		else print($r['nom']);
    }
	if($r['prenom']!='' && $r['prenom']!=NULL)return($r['nom'].', '.$r['prenom']);
	else return($r['nom']);
}
function getAuteurURL_ById($id){
	global $pdo;
	$sql = "SELECT nom, prenom, URL_WP FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction getAuteurURL_ById()');
	$nom_complet='';
	while ($r = $req_auteur->fetch())
    { 
		//$nom_complet.=$r['prenom'].'_'.$r['nom'];
                $url=$r['URL_WP'];
    }
	return($url);
}

function getAuteurPrenomNomById($id){
	global $pdo;
	$sql = "SELECT nom, prenom FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction getAuteurPrenomNomById()');
	$nom_complet='';
	while ($r = $req_auteur->fetch())
    { 
		$nom_complet.=$r['prenom'].' '.$r['nom'];
    }
	return($nom_complet);
}
function rechercherIdAuteurByPrenom_NOM($prenom_NOM){
	global $pdo;
	$sql = "SELECT `pk_id_critiqueDart` FROM critiquedart WHERE CONCAT(`prenom`,' ',`nom`) like '".addslashes($prenom_NOM)."%'";
	//echo $sql;
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction rechercherIdAuteurByPrenom_NOM()');
	while ($r = $req_auteur->fetch())
    { 
		$id=$r['pk_id_critiqueDart'];
    }
	return($id);
}
function afficherAuteurByIdModeBiblio($id,$date){
	// Affiche un auteur depuis son identifiant
	global $pdo;
	$auteur='';
	$sql = "SELECT nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction afficherAuteurByIdModeBiblio()');
	while ($r = $req_auteur->fetch())
    { 
		if($date!=''){
			print($r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')');
		}
		else{
			print($r['nom']);
			if($r['prenom']!=='' && $r['prenom']!==NULL) print(', '.$r['prenom']);
		}
    }
	$auteur.=$r['nom'];
	if($r['prenom']!='' && $r['prenom'] != NULL){
		$auteur.=', '.$r['prenom'];
	}
	return($auteur);
}
function getAuteurByIdModeBiblio($id){
	// Retourne un auteur depuis son identifiant sous la forme "NOM, Prénom"
	global $pdo;
	$sql = "SELECT nom, prenom FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL dans la fonction getAuteurByIdModeBiblio()');
	while ($r = $req_auteur->fetch())
    { 
		$auteur.=$r['nom'];
		if($r['prenom']!='' && $r['prenom'] != NULL){
			$auteur.=', '.$r['prenom'];
		}
    }
	return($auteur);
}
function afficherTousLesCollectifFormOption(){
	// Affiche un collectif depuis son identifiant passé en argument
	global $pdo;
	$sql = "SELECT * FROM collectif";
	$req_collectif=$pdo->query($sql) or die('erreur SQL dans la fonction afficherTousLesCollectifFormOption()');
	while ($r = $req_collectif->fetch())
    { 
		print('<option value="'.$r['pk_id_collectif'].'">'.$r['titre'].'</option>');
    }
}
function afficherCollectifById($id){
	// Affiche un collectif depuis son identifiant passé en argument
	global $pdo;
	$sql = "SELECT * FROM collectif WHERE pk_id_collectif =".$id;
	//echo $sql;
	$req_collectif=$pdo->query($sql) or die('erreur SQL dans la fonction afficherCollectifById()');
	while ($r = $req_collectif->fetch())
    {
		print('<p><a>'.$r['titre'].'</a></p>');
    }
}
function afficherAuteursParLettre($lettre){
	// Affiche tous les auteurs dont le nom commence par la lettre passée en argument
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom, anneeNaissance, anneeMort, URL_WP FROM critiquedart WHERE nom LIKE '".$lettre."%' order by nom";
	
	$req_auteurs=$pdo->query($sql) or die('erreur SQL dans la fonction afficherAuteursParLettre()');    
    while ($r = $req_auteurs->fetch())
    {
    	print('<p><a href="'.$r["URL_WP"].'">'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
    
	return($r);
}
function inserer_nouvelle_revue($titre,$ISSN,$periodicite,$couverture){
	global $pdo;
	$sql='INSERT INTO periodique (ISSN,titre,periodicite,couverture) VALUES ('.$ISSN.','.addslashes($titre).','.$periodicite.','.$couverture.')';
	//echo $sql;
	$req_nouvelle_revue=$pdo->query($sql) or die('erreur SQL dans la fonction inserer_nouvelle_revue()');
	//$id=$pdo->lastInsertId();
	//$pdo->commit();
	//return($id);
}
function inserer_nouvel_ouvrage($ISBN,$AnneeEdition,$TitreOuvrage,$sousTitreOuvrage,$CoordinationOuvrage,$CollectionOuvrage,$Editeur,$Edition){
	global $pdo;
	$sql='INSERT INTO ouvrage (ISBN_10, annee, titre, complement_titre, coordonnateur, collection, edition, fk_id_editeur) ';
	$sql.=' VALUES (';
	if($ISBN!='')$sql.='\''.$ISBN.'\',';
	else $sql.='NULL,';
	if($AnneeEdition!='')$sql.=$AnneeEdition.',';
	else $sql.='NULL,';
	$sql.='\''.addslashes($TitreOuvrage).'\',';
	if($sousTitreOuvrage!='')$sql.='\''.addslashes($sousTitreOuvrage).'\',';
	else $sql.='NULL,';
	if($CoordinationOuvrage!='')$sql.='\''.addslashes($CoordinationOuvrage).'\',';
	else $sql.='NULL,';
	if($CollectionOuvrage!='')$sql.='\''.addslashes($CollectionOuvrage).'\',';
	else $sql.='NULL,';
	if($Edition!='')$sql.=$Edition.',';
	else $sql.='NULL,';
	if($Editeur!='')$sql.=$Editeur;
	else $sql.='NULL';
	$sql.=')';
	echo "<script>javascript('".$sql."')</script>";
	$req_nouvel_ouvrage=$pdo->query($sql) or die('erreur SQL table ouvrage fonction inserer_nouvel_ouvrage()');
	$id=$pdo->lastInsertId();
	return($id);
}
function editeur_id($nomEditeur){
	global $pdo;
	$sql='SELECT `pk_id_editeur` FROM `editeur` WHERE `nom` LIKE \''.addslashes($nomEditeur).'\' LIMIT 1';
	$req_id_editeur=$pdo->query($sql) or die('erreur SQL dans la fonction editeur_id()');
	while ($r = $req_id_editeur->fetch()){
		$id=$r['pk_id_editeur'];
	}
	return($id);
}
function rechercher_editeur_id($nomEditeur){
	global $pdo;
	$sql='SELECT `pk_id_editeur` FROM `editeur` WHERE `nom` LIKE \'%'.addslashes($nomEditeur).'%\' LIMIT 1';
	//echo $sql;
	$req_id_editeur=$pdo->query($sql) or die('erreur SQL dans la fonction rechercher_editeur_id()');
	while ($r = $req_id_editeur->fetch()){
		$id=$r['pk_id_editeur'];
	}
	return($id);
}
function AfficherNomEditeur($pk_id_editeur){
	global $pdo;
	$nom=NULL;
	if(isset($pk_id_editeur) && $pk_id_editeur!=NULL && $pk_id_editeur!=''){
		$sql='SELECT `nom` FROM `editeur` WHERE `pk_id_editeur` LIKE '.$pk_id_editeur.' LIMIT 1';
		$req_nom_editeur=$pdo->query($sql) or die('erreur SQL dans fonction AfficherNomEditeur() pour id ='.$pk_id_editeur.' avec la requête :<br>'.$sql);
		while ($r = $req_nom_editeur->fetch()){
			$nom=$r['nom'];
		}
	}
	return($nom);
}
function AfficherVilleEditeur($pk_id_editeur){
	global $pdo;
	$ville=NULL;
	if(isset($pk_id_editeur) && $pk_id_editeur!=NULL && $pk_id_editeur!=''){
		$sql='SELECT `ville` FROM `editeur` WHERE `pk_id_editeur` LIKE '.$pk_id_editeur.' LIMIT 1';
		$req_ville_editeur=$pdo->query($sql) or die('erreur SQL dans la fonction AfficherVilleEditeur() pour id ='.$pk_id_editeur.' avec la requête :<br>'.$sql);
		while ($r = $req_ville_editeur->fetch()){
			$ville=$r['ville'];
		}
	}
	return($ville);
}
function inserer_nouvel_editeur($Editeur,$VilleEdition){
	global $pdo;
	$sql='INSERT INTO editeur (nom,ville) VALUES (\''.addslashes($Editeur).'\',\''.addslashes($VilleEdition).'\')';
	$req_nouvel_editeur=$pdo->query($sql) or die('erreur SQL dans la fonction inserer_nouvel_editeur()');
	return(editeur_id($Editeur));
}
function testLogin($login,$password,$users){
	//echo crypt($password,$users[$login]['login']);
	//echo $users[$login]['password'];
	if($users[$login]['password']===crypt($password,$users[$login]['login'])){
		//echo "mot de passe validé pour ".$login;
		return TRUE;
	}
	else{
		//echo "mot de passe invalide pour ".$login;
		return FALSE;
	}
}
function revue_id($nomRevue){
	global $pdo;
	$revue_et_date = explode(" (", chop(trim($nomRevue,")")));
	$titre_revue=$revue_et_date[0];
	$couverture=$revue_et_date[1];
	$sql='SELECT `pk_id_periodique` FROM `periodique` WHERE `titre` LIKE \''.addslashes($titre_revue).'\' AND couverture LIKE \''.$couverture.'\'';
	$req_id_revue=$pdo->query($sql) or die('erreur SQL dans la fonction revue_id()');
	while ($r = $req_id_revue->fetch()){
		$id=$r['pk_id_periodique'];
	}
	return($id);
}
function revue_id_sans_date($nomRevue){
	global $pdo;
	$sql='SELECT `pk_id_periodique` FROM `periodique` WHERE `titre` LIKE \''.addslashes($nomRevue).'\'';
	$req_id_revue=$pdo->query($sql) or die('erreur SQL dans la fonction revue_id_sans_date()');
	while ($r = $req_id_revue->fetch()){
		$id=$r['pk_id_periodique'];
	}
	return($id);
}
function get_revue_by_id_sans_date($id_revue){
	global $pdo;
	$sql='SELECT `titre` FROM `periodique` WHERE `pk_id_periodique`  = '.$id_revue;
	$req_revue=$pdo->query($sql) or die('erreur SQL dans la fonction get_revue_by_id_sans_date()');
	while ($r = $req_revue->fetch()){
		$id=$r['titre'];
	}
	return($id);
}
function afficher_revue_by($id_revue){
	global $pdo;
	$sql='SELECT `titre`, `couverture` FROM `periodique` WHERE `pk_id_periodique` = '.$id_revue;
	$req_revue=$pdo->query($sql) or die('erreur SQL dans la fonction de afficher_revue_by()');
	while ($r = $req_revue->fetch()){
		echo $r['titre'].' ('.$r['couverture'].')';
	}
}
function ouvrage_id($nomOuvrage){
	global $pdo;
	/*
	plutot que de segmenter la chaine en découpant avec les parenthèses, vérifier la présence d'une date en parenthèse en fin de chaine
	$ouvrage_et_date = explode(" (", chop(trim($nomOuvrage,")")));
	$titre_ouvrage=$ouvrage_et_date[0];
	$couverture=$ouvrage_et_date[1];
	*/
	if (preg_match("#[0-9]{4}\)$#", $nomOuvrage))
	{
    	//echo "la chaîne <q>$var1</q> se termine par la chaine cherchée";
		$titre_ouvrage=chop(substr($nomOuvrage,0,-6)); 
	}
	$sql='SELECT `pk_id_ouvrage` FROM `ouvrage` WHERE `titre` LIKE \''.addslashes($titre_ouvrage).'\'';
	//echo $sql;
	//sleep(20);
	$req_id_ouvrage=$pdo->query($sql) or die('erreur SQL dans la fonction ouvrage_id()');
	while ($r = $req_id_ouvrage->fetch()){
		$id=$r['pk_id_ouvrage'];
	}
	return($id);
}
function numero_periodique_id($id_revue,$numero,$annee,$nb_page,$titre_numero,$complementTitre,$volume,$dateprecise){
	global $pdo;
	//$sql='SELECT pk_id_numero_periodique FROM `numeroperiodique` WHERE numero=NULL AND annee=1929 AND `nb_pages` = NULL AND titre=NULL AND volume LIKE 'X' AND dateprecise=NULL AND fk_id_periodique=66';
	$sql='SELECT pk_id_numero_periodique FROM numeroperiodique WHERE fk_id_periodique='.$id_revue;
	if($numero!='')$sql.=' AND numero='.$numero;
	if($annee!='')$sql.=' AND annee='.$annee;
	if($volume!='')$sql.=' AND volume LIKE \''.addslashes($volume).'\'';
	if($complementTitre!='')$sql.=' AND complementTitre LIKE \''.addslashes($complementTitre).'\'';
	if($dateprecise!='')$sql.=' AND dateprecise LIKE \''.addslashes($dateprecise).'\'';
	//echo $sql;
	//flush();
	//sleep(10);
	$req_id_numero=$pdo->query($sql) or die('erreur SQL dans la fonction numero_periodique_id()');
	while ($r = $req_id_numero->fetch()){
		$id=$r['pk_id_numero_periodique'];
	}
	if($id==''){
		//echo 'pas trouvé';
		$id=inserer_numero_periodique($id_revue,$numero,$annee,$nb_page,$titre_numero,$complementTitre,$volume,$dateprecise);
	}
	//else echo $id;
	return($id);	
}
function inserer_numero_periodique($id_revue,$numero,$annee,$nb_pages,$titre_numero,$complementTitre,$volume,$dateprecise){
	//echo $titre_numero;
	global $pdo;
	$sql='INSERT INTO numeroperiodique (pk_id_numero_periodique, numero, annee, nb_pages, titre, complementTitre, volume, dateprecise, fk_id_periodique)';
	$sql.=' VALUES (NULL,';
	if($numero!='')$sql.=$numero.',';
	else $sql.='NULL,';
	if($annee!='')$sql.=$annee.',';
	else $sql.='NULL,';
    if($nb_pages!='')$sql.=$nb_pages.',';
	else $sql.='NULL,';
	if($titre_numero!='')$sql.='\''.addslashes($titre_numero).'\',';
	else $sql.='NULL,';
	if($complementTitre!='')$sql.='\''.addslashes($complementTitre).'\',';
	else $sql.='NULL,';
	if($volume!='')$sql.='\''.addslashes($volume).'\',';
	else $sql.='NULL,';
	if($dateprecise!='')$sql.='\''.addslashes($dateprecise).'\',';
	else $sql.='NULL,';
	$sql.=$id_revue;
	$sql.=')';
	$req_insert_numero=$pdo->query($sql) or die('erreur SQL dans la fonction inserer_numero_periodique()');
	//Ci-dessous le bug qui faisait planter tout le servive avec une boucle
	//return(numero_periodique_id($id_revue,$numero,$annee,$nb_pages,$titre_numero,$complementTitre,$volume,$dateprecise));
	$id=$pdo->lastInsertId();
	return($id);
}
function inserer_critique($titre,$complementTitre,$type,$pagination,$attribution,$reedition,$fk_id_ouvrage,$fk_id_numero_periodique){
	global $pdo;
	$sql='INSERT INTO critique (`pk_id_critique`, `titre`, `complementTitre`, `type`, `pagination`, `attribution`, `reedition`, `fk_id_ouvrage`, `fk_id_numeroperiodique`)';
	$sql.='VALUES (NULL,';
	$sql.='\''.addslashes($titre).'\',';
	//$sql.='\''.$titre.'\',';
	if($complementTitre!='')$sql.='\''.addslashes($complementTitre).'\',';
	//if($complementTitre!='')$sql.='\''.$complementTitre.'\',';
	else $sql.='NULL,';
	$sql.='\''.$type.'\',';
	if($pagination!='')$sql.='\''.$pagination.'\',';
	else $sql.='\'n.p.\',';
	$sql.='\''.$attribution.'\',';
	if($reedition!='')$sql.=$reedition;
	else $sql.='NULL,';
	if($fk_id_ouvrage!='')$sql.='\''.$fk_id_ouvrage.'\',';
	else $sql.='NULL,';
	if($fk_id_numero_periodique!='')$sql.='\''.$fk_id_numero_periodique.'\'';
	else $sql.='NULL';
	$sql.=')';
	echo $sql;
	$req_insert_critique=$pdo->query($sql) or die('erreur SQL dans la fonction inserer_critique()');
	$id_critique=$pdo->lastInsertId();
	return($id_critique);
}
function inserer_signature($type_signature,$fk_id_pseudonyme,$fk_id_collectif,$fk_id_critique){
	global $pdo;
	if($fk_id_pseudonyme=='')$fk_id_pseudonyme='NULL';
	else $type_signature='pseudonyme';
	if($fk_id_collectif=='')$fk_id_collectif='NULL';
	if($fk_id_critique=='')$fk_id_critique='NULL';
	$sql='INSERT INTO signature (pk_id_signature, type, fk_id_pseudonyme, fk_id_collectif, fk_id_critique)';
	$sql.=' VALUES (NULL, ';
	$sql.='\''.$type_signature.'\',';
	$sql.=$fk_id_pseudonyme.',';
	$sql.=$fk_id_collectif.',';
	$sql.=$fk_id_critique.')';
	$req_insert_signature=$pdo->query($sql) or die('erreur SQL sur la fonction inserer_signature()');
	$id_signature=$pdo->lastInsertId();
	//echo $sql;
	return($id_signature);
}
function inserer_composition_signature($id_signature,$id_critique_dart){
	global $pdo;
	$sql='INSERT INTO compositionsignature (fk_id_signature, fk_id_critiquedart)';
	$sql.=' VALUES ('.$id_signature.', '.$id_critique_dart.')';
	//echo $sql;
	$req_insert_composition_signature=$pdo->query($sql) or die('erreur SQL sur la fonction inserer_composition_signature()');
}
function testerOuCreerPseudo($auteur,$pseudo){
	global $pdo;
	$sql='SELECT pk_id_pseudonyme FROM pseudonyme WHERE titre LIKE \''.addslashes($pseudo).'\' AND fk_id_critiqueDart_signataire ='.$auteur.' AND fk_id_critiqueDart_depositaire='.$auteur;
	//echo $sql;
	$req_pseudo=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_pseudo->fetch()){
		$id_pseudo=$r['pk_id_pseudonyme'];
	}
	if(is_null($id_pseudo)){
		$sql_insertion='INSERT INTO pseudonyme (pk_id_pseudonyme, titre, utilisation, fk_id_critiqueDart_signataire, fk_id_critiqueDart_depositaire)';
		$sql_insertion.=' VALUES (NULL, \''.addslashes($pseudo).'\',\'originale\','.$auteur.','.$auteur.')';
		//echo $sql_insertion;
		$insertion_pseudo=$pdo->query($sql_insertion) or die('erreur SQL dans la fonction testerOuCreerPseudo()');
		$id_pseudo=$pdo->lastInsertId();
	}
	return($id_pseudo);
}
function listeCritiquesAuteurMonographies($id_auteur,$id_critique){
	global $pdo;
	// pb de selection du complément de titre qui est renseigné dans monographie et critique
	$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre, ouvrage.complement_titre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND critique.type = \'monographie\'
ORDER BY annee,titre';
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	//echo "critique n° ".$id_critique;
	while ($r = $req_biblio->fetch()){
		
		$id_editeur=$r['idEditeur'];
		$id=$r['pk_id_critique'];
		echo "<li id='".$id."'>";
		if($id_critique==$id){echo "<mark>";}
		$titre=$r['titre'];
		$annee=$r['annee'];
		$reedition=$r['reedition'];
		$complement_titre=$r['complement_titre'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		if($r['fk_id_pseudonyme']==NULL){
			composition_signature($r['pk_id_signature'],$r['typeSignature']);
		}
		else afficher_pseudo($r['fk_id_pseudonyme']);
		echo ", <em>".$titre."</em>";
		//echo " (".$annee.")";
		if($complement_titre!='')echo ", [".$complement_titre."]";
		if($id_editeur!=''){ 
			$nom_editeur=AfficherNomEditeur($id_editeur);
			$ville_editeur=AfficherVilleEditeur($id_editeur);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($r['collection']!=''){ 
			echo ", coll. <q>".$r['collection']."</q>";
		}
		/*
		if($r['pagination']!='n.p.' && $r['pagination']!='n.r.'){
			echo ", ".$r['pagination']." p.";
		}
		else{
			echo ", ".$r['pagination'];
		}
		Demande Marie le 14 janvier 2016
		*/
		echo ", ".$r['annee'].'.';
		}
		if($reedition!=''){echo "première édition en ".$reedition;}
		if($id_critique==$id){echo "</mark>";}
		echo "</li>";
	}
function listeCritiquesAuteurParticipationOuvrage($id_auteur,$id_critique){
	global $pdo;
	// suppression des introductions
	//$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre as titreChapitre, critique.complementTitre as complementTitreChapitre, ouvrage.titre, ouvrage.complement_titre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, ouvrage.coordonnateur, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND critique.type = \'chapitre\' OR critique.type = \'introduction\' ORDER BY annee,titre';
	
$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre as titreChapitre, critique.complementTitre as complementTitreChapitre, ouvrage.titre, ouvrage.complement_titre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, ouvrage.coordonnateur, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND critique.type = \'chapitre\' ORDER BY annee,titre';

	//echo $sql;
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	//echo "critique n° ".$id_critique;
	while ($r = $req_biblio->fetch()){
		//print_r($r);
		$id_editeur=$r['idEditeur'];
		$id=$r['pk_id_critique'];
		echo "<li id='".$id."'>";
		if($id_critique==$id){echo "<mark>";}
		$titre_ouvrage=$r['titre'];
		$annee=$r['annee'];
		$titre=$r['titreChapitre'];
		$complement_titre=$r['complementTitreChapitre'];
		$coordonnateur=$r['coordonnateur'];
		$pagination=$r['pagination'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		if($r['fk_id_pseudonyme']==NULL){
			composition_signature($r['pk_id_signature'],$r['typeSignature']);
		}
		else afficher_pseudo($r['fk_id_pseudonyme']);
		echo ", <q>".$titre."</q>";
		//echo " (".$annee.")";
		if($complement_titre!='')echo ", [".$complement_titre."]";
		if($coordonnateur!='')echo ", in ".$coordonnateur." (dir)";
		echo ", <em>".$titre_ouvrage."</em>";
		if($id_editeur!=''){ 
			$ville_editeur=AfficherVilleEditeur($id_editeur);
			$nom_editeur=AfficherNomEditeur($id_editeur);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($r['collection']!=''){
			echo ", coll. <q>".$r['collection']."</q>";
		}
		echo ", ".$r['annee'];
		if($pagination!='n.p.' && $pagination !='n.r.' && $pagination !='' && $pagination!=NULL){
			 echo ", p. ".$pagination;
		}
		echo ".";
		if($id_critique==$id){
			echo "</mark>";
		}
		echo "</li>";
	}
}
function listePrefacesPostfaces($id_auteur,$id_critique){
	global $pdo;
	$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre as titreChapitre, ouvrage.titre, ouvrage.complement_titre as complementTitre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, ouvrage.coordonnateur, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND (critique.type = \'preface\' OR critique.type = \'postface\' OR critique.type = \'introduction\')
ORDER BY annee,titre';
	//echo $sql;
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	//echo "critique n° ".$id_critique;
	while ($r = $req_biblio->fetch()){	
	//print_r($r);
		$id_editeur=$r['idEditeur'];
		$id=$r['pk_id_critique'];
		echo "<li id='".$id."'>";
		if($id_critique==$id){echo "<mark>";}
		$titre_ouvrage=$r['titre'];
		$annee=$r['annee'];
		$titre=$r['titreChapitre'];
		$complement_titre=$r['complementTitre'];
		$coordonnateur=$r['coordonnateur'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		if($r['fk_id_pseudonyme']==NULL){
			composition_signature($r['pk_id_signature'],$r['typeSignature']);
		}
		else afficher_pseudo($r['fk_id_pseudonyme']);
		echo ", <q>".$titre."</q>";
		if($coordonnateur!='')echo ", in ".$coordonnateur." (dir)";
		echo ", <em>".$titre_ouvrage."</em>";
		if($complement_titre!='')echo ", [".$complement_titre."]";
		if($id_editeur!=''){ 
			$ville_editeur=AfficherVilleEditeur($id_editeur);
			$nom_editeur=AfficherNomEditeur($id_editeur);	
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($r['collection']!='') echo ", coll. <q>".$r['collection']."</q>";
		if(isset($annee))echo ", ".$annee;
		if($r['pagination']!=='n.p.' AND $r['pagination']!=='n.r.' AND $r['pagination']!=='' AND $r['pagination']!=NULL) echo ", p. ".$r['pagination'];
			//else echo ", ".$r['pagination'];
		
		
		if($id_critique==$id){echo "</mark>";}
		if($r['titre']!=='')echo ".";
		}
		echo "</li>";	
}
function listeCritiquesAuteurArticles($id_auteur,$id_critique){
	global $pdo;
	$sql='SELECT DISTINCT numeroperiodique.annee as annee, dateprecise, pk_id_critique, critique.titre, critique.complementTitre, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage, fk_id_numeroperiodique FROM numeroperiodique 
INNER JOIN critique ON critique.fk_id_numeroperiodique = numeroperiodique.pk_id_numero_periodique
INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' ORDER BY annee, dateprecise';
	//echo $sql;
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_biblio->fetch()){

		$id=$r['pk_id_critique'];
		echo "<li id='".$id."'>";
		if($id_critique==$id){echo "<mark>";}
		$titre=$r['titre'];
		$complement_titre=$r['complementTitre'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		if($r['fk_id_pseudonyme']==NULL){
			composition_signature($r['pk_id_signature'],$r['typeSignature']);
		}
		else afficher_pseudo($r['fk_id_pseudonyme']);
		if($r['fk_id_numeroperiodique']!=''){
			afficher_n_periodique($r['fk_id_numeroperiodique'],$titre,$complement_titre);
			if($r['pagination']!='n.p.' && $r['pagination']!='n.r.') echo ", p. ".$r['pagination'];
		}
		else {
			echo "ceci n'est pas un périodique";
		}
		if($id_critique==$id){echo "</mark>";}
		echo ".";
		echo "</li>";
		//echo $sql;
	}
}
function composition_signature($id_signature,$type,$silent){
	global $pdo;
	$sql='SELECT fk_id_critiquedart FROM compositionsignature ';
	$sql.='WHERE fk_id_signature='.$id_signature;
	//echo $sql;
	$taille=(tailleSignature($id_signature));
	$req_signature=$pdo->query($sql) or die('erreur SQL');
	//echo "Type : ".$type;
	$i=0;
	$auteur_1='';
	// retourne l'id du promier auteur en plus d'afficher la composition de la signature
	if($type=='patronyme'){
		while ($r = $req_signature->fetch()){
			$i++;
			if($auteur_1=='')$auteur_1.=$r['fk_id_critiquedart'];
			if($silent!=TRUE)afficherAuteurByIdModeBiblio($r['fk_id_critiquedart']);
			if($i < $taille && $taille=2){ echo " et ";}
			elseif($i < $taille && $taille>2) { echo ", ";}
		}
	}
	elseif($type=='initiales'){
		while ($r = $req_signature->fetch()){
			if($auteur_1=='')$auteur_1.=$r['fk_id_critiquedart'];
			if($silent!=TRUE)afficher_initiales($r['fk_id_critiquedart']);
		}
	}
	elseif($type=='anonyme'){
		while ($r = $req_signature->fetch()){
			if($auteur_1=='')$auteur_1.=$r['fk_id_critiquedart'];
			if($silent!=TRUE)afficher_anonyme($r['fk_id_critiquedart']);
		}
	}
	return $auteur_1;
	/*
	else{
		while ($r = $req_signature->fetch()){
			afficherAuteurByIdModeBiblio($r['fk_id_critiquedart']);
		}
	}
	*/
}
function afficher_n_periodique($id_numero_periodique,$titre,$complement_titre){
	global $pdo;
	$sql='SELECT periodique.titre as nom_revue, numero, annee, numeroperiodique.titre as titre_numero, complementTitre as complementTitreNumero, volume, dateprecise, fk_id_periodique FROM periodique ';
	$sql.='INNER JOIN numeroperiodique ON periodique.pk_id_periodique=numeroperiodique.fk_id_periodique ';
	$sql.='WHERE pk_id_numero_periodique='.$id_numero_periodique;
	//echo $sql;
	$req_numero_et_revue=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_numero_et_revue->fetch()){
		echo ", <q>".$titre."</q>";
		if($complement_titre!='')echo ", ".$complement_titre;
		echo ", <em>".$r['nom_revue']."</em>";
		if($r['volume']!='') echo ", ".$r['volume'];
		if($r['numero']!='') echo ", n° ".$r['numero'];
		//if($r['dateprecise']!='') echo ", le ".date("d-m-Y", strtotime($r['dateprecise']));
		if($r['complementTitreNumero']!='')echo ", ".$r['complementTitreNumero'];
		if($r['dateprecise']!=''){
			 //echo ", le ".$r['dateprecise'];
			 echo ", ".date_fr($r['dateprecise']);
		}
		elseif($r['complementTitreNumero']!=''){
			echo " ".$r['annee'];
		}
		else{echo ", ".$r['annee'];}
	}
}
function afficher_initiales($id_auteur){
	global $pdo;
	$sql='SELECT initiales FROM critiquedart WHERE pk_id_critiqueDart='.$id_auteur;
	//echo $sql;
	$req_initiales=$pdo->query($sql) or die('erreur SQL');
	foreach ($req_initiales as $initiales){
		echo '<abbr title="Initiales de ';
		afficherAuteurNomPrenomById($id_auteur);
		echo '">'.$initiales[0].'</abbr>';
	}
}
function afficher_anonyme($id_auteur){
	echo '<abbr title="non signé atrribué à  ';
	afficherAuteurNomPrenomById($id_auteur);
	echo '">Anonyme</abbr>';
}
function tailleSignature($id_signature){
	global $pdo;
	$sql='SELECT COUNT(fk_id_critiquedart) as nombre_auteurs FROM compositionsignature WHERE fk_id_signature='.$id_signature;
	//echo $sql;
	$tailleSignature=$pdo->query($sql) or die('erreur SQL');
	foreach($tailleSignature as $r){
		$taille=$r['nombre_auteurs'];
	}
	return($taille);
	
}
function afficher_pseudo($id_pseudo){
	global $pdo;
	$sql='SELECT titre, fk_id_critiqueDart_signataire FROM pseudonyme WHERE pk_id_pseudonyme='.$id_pseudo;
	//echo $sql;
	$pseudo=$pdo->query($sql) or die('erreur SQL fonction afficher_pseudo()');
	foreach($pseudo as $r){
		echo '<abbr title="Signature de ';
		afficherAuteurNomPrenomById($r['fk_id_critiqueDart_signataire']);
		echo ', correspond à un pseudonyme">'.$r['titre'].'</abbr>';
	}
}
function afficher_coordination($nom_prenom){
	global $pdo;
	$sql='SELECT count(pk_id_ouvrage) as nombre FROM `ouvrage` WHERE `coordonnateur` LIKE \'%'.addslashes($nom_prenom).'%\'';
	//echo $sql;
	$nombre_coordination=$pdo->query($sql) or die('erreur SQL dans la fonction afficher_coordination()');
	foreach($nombre_coordination as $r){
		$taille=$r['nombre'];
	}
	if($taille > 0){
		$sql2='SELECT annee, titre, complement_titre, coordonnateur, collection, edition, fk_id_editeur';
		$sql2.=' FROM `ouvrage` WHERE `coordonnateur` LIKE \'%'.$nom_prenom.'%\' ORDER BY `annee` ASC';
		//echo $sql2;
		$liste_coordination=$pdo->query($sql2) or die('erreur SQL');
		echo '<h3>Coordination d\'ouvrages</h3><ol>';
		foreach($liste_coordination as $r){
			echo '<li>';
			if($r['coordonnateur']!='' OR $r['coordonnateur']!=NULL)echo $r['coordonnateur'].' (dir)';
			echo ', <em>'.$r['titre'].'</em>';
			if($r['complement_titre']!='' OR $r['complement_titre']!=NULL)echo ", [".$r['complement_titre'].']';
			if($r['fk_id_editeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($r['fk_id_editeur']);
			$ville_editeur=AfficherVilleEditeur($r['fk_id_editeur']);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
			if($r['collection']!='') echo ", coll. <q>".$r['collection']."</q>";
			if($r['annee']!='')echo ', '.$r['annee'];
			if($r['titre']!='')echo ".";
		}
			echo '</li>';
		}
		echo "</ol>";
	}
}
function debut_COinS_monographie($ISBN,$titre,$signature,$ville,$editeur,$collection,$prenom,$nom,$date,$pagination){
	// Entame l'encadrement du texte affiché 
	// pour une monographie dans une balise span
	// selon la norme Z39-88 (COinS) OpenURL
	// rend détectable par un LGRB comme Zotero ou Mendeley
	$debut_span="<span class='Z3988' title='url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fcritiquesdart.univ-paris1.fr%3A2";
	if($ISBN!='' && $ISBN!=NULL){
		$debut_span.="&amp;rft_id=urn%3Aisbn%3A";
		$debut_span.=$ISBN;
	}
	$debut_span.="&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book";
	$debut_span.="&amp;rft.btitle=";
	$debut_span.=$titre;
	if($ville!='' && $ville!=NULL){
		$debut_span.="&amp;rft.place=";
		$debut_span.=$ville;
	}
	if($editeur!='' && $editeur!=NULL){
		$debut_span.="&amp;rft.publisher=";
		$debut_span.=$editeur;
	}
	if($date!='' && $date!=NULL){
		$debut_span.="&amp;rft.date=";
		$debut_span.=$date;
	}
	if($collection!='' && $collection!=NULL){
		$debut_span.="&amp;rft.series=";
		$debut_span.=$collection;
	}
	$debut_span.="&amp;rft.aufirst=".$prenom;
	$debut_span.="&amp;rft.aulast=".$nom;
	if($pagination!='' && $pagination!=NULL){
		$debut_span.="&amp;rft.tpages=";
		$debut_span.=$pagination;
	}
	if($ISBN!='' && $ISBN!=NULL){
		$debut_span.="&amp;rft.isbn=";
		$debut_span.=$ISBN;
	}
	$debut_span.="'>";
	return($debut_span);

}
function debut_COinS_direction_ouvrage($ISBN,$titre,$signature,$ville,$editeur,$collection,$directeur_ouvrage,$date,$pagination){
	// Entame l'encadrement du texte affiché 
	// pour une monographie dans une balise span
	// selon la norme Z39-88 (COinS) OpenURL
	// rend détectable par un LGRB comme Zotero ou Mendeley
	$debut_span="<span class='Z3988' title='url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fcritiquesdart.univ-paris1.fr%3A2";
	if($ISBN!='' && $ISBN!=NULL){
		$debut_span.="&amp;rft_id=urn%3Aisbn%3A";
		$debut_span.=$ISBN;
	}
	$debut_span.="&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book";
	$debut_span.="&amp;rft.btitle=";
	$debut_span.=$titre;
	if($ville!='' && $ville!=NULL){
		$debut_span.="&amp;rft.place=";
		$debut_span.=$ville;
	}
	if($editeur!='' && $editeur!=NULL){
		$debut_span.="&amp;rft.publisher=";
		$debut_span.=$editeur;
	}
	if($date!='' && $date!=NULL){
		$debut_span.="&amp;rft.date=";
		$debut_span.=$date;
	}
	if($collection!='' && $collection!=NULL){
		$debut_span.="&amp;rft.series=";
		$debut_span.=$collection;
	}
	$direction=explode(";", $directeur_ouvrage);
	//print_r($direction);
	foreach($direction as $r){
		$debut_span.="&amp;rft.au=".urlencode($r);
		//$debut_span.="&amp;rft.au=".urlencode('ROSENTHAL, Léon');
	}
	if($pagination!='' && $pagination!=NULL){
		$debut_span.="&amp;rft.tpages=";
		$debut_span.=$pagination;
	}
	if($ISBN!='' && $ISBN!=NULL){
		$debut_span.="&amp;rft.isbn=";
		$debut_span.=$ISBN;
	}
	$debut_span.="'>";
	return($debut_span);
}
function debut_COinS_article($ISSN,$titre,$revue,$signature,$nom,$prenom,$date,$annee,$tome,$numero,$pagination){
	// Entame l'encadrement du texte affiché 
	// pour un article de revue ou de journal dans une balise span
	// selon la norme Z39-88 (COinS) OpenURL
	// rend détectable par un LGRB comme Zotero ou Mendeley
	$debut_span="<span class='Z3988' title='url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2";
	$debut_span.="&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Ajournal&amp;rft.genre=article&amp;rft.atitle=";
	$debut_span.="&amp;rft.atitle=";
	$debut_span.=$titre;
	if($date!='' && $date!=NULL){
		$debut_span.="&amp;rft.date=";
		$debut_span.=$date;
	}
	else{
		$debut_span.="&amp;rft.date=";
		$debut_span.=$annee;
	}
	$debut_span.="&amp;rft.aufirst=".$prenom;
	$debut_span.="&amp;rft.aulast=".$nom;
	$debut_span.="&amp;rft.jtitle=".$revue;
	if($tome!=''  && $tome!=NULL){
		$debut_span.="&amp;rft.volume=".$tome;
	}
	if($numero!=''  && $numero!=NULL){
 		$debut_span.="&amp;rft.issue=".$numero;
	}
	/*
	if($signature!='' && $signature!=NULL){
		$debut_span.="&amp;rft.au=";
		$debut_span.=$signature;
	}
	*/
	if($pagination!='' && $pagination!=NULL){
		$debut_span.="&amp;rft.pages=";
		$debut_span.=$pagination;
	}
	if($ISSN!='' && $ISSN!=NULL){
		$debut_span.="&amp;rft.issn=";
		$debut_span.=$ISSN;
	}
	$debut_span.="'>";
	return($debut_span);

}
function debut_COinS_chapitre($ISBN,$titre,$ouvrage,$signature,$nom,$prenom,$date,$numero,$pagination,$editeur,$coordonnateur){
	// Entame l'encadrement du texte affiché 
	// pour un chapitre d'ouvrage dans une balise span
	// selon la norme Z39-88 (COinS) OpenURL
	// rend détectable par un LGRB comme Zotero ou Mendeley
	
	$debut_span="<span class='Z3988' title=";
	$debut_span.="'url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2";
	$debut_span.="&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook";
	$debut_span.="&amp;rft.genre=bookitem&amp;rft.atitle=";
	$debut_span.=$titre;
	$debut_span.="&amp;rft.btitle=";
	$debut_span.=$ouvrage;
	if($editeur!='' && $editeur!=NULL){
		$debut_span.="&amp;rft.publisher=";
		$debut_span.=$editeur;
	}
	$debut_span.="&amp;rft.aufirst=".$prenom;
	$debut_span.="&amp;rft.aulast=".$nom;
	$debut_span.="&amp;rft.date=".$date;
	if($pagination!='' && $pagination!=NULL){
		$debut_span.="&amp;rft.pages=";
		$debut_span.=$pagination;
	}
	if($ISBN!='' && $ISBN!=NULL){
		$debut_span.="&amp;rft.isbn=";
		$debut_span.=$ISBN;
	}
	$debut_span.="'>";
	return($debut_span);
}
function fin_COinS(){
	// Termine l'encadrement du texte affiché 
	// selon la norme Z39-88 (COinS) OpenURL
	$fin_span="</span>";
	return($fin_span);
}
function afficher_pseudos_by_id_critiqueDart($idCritiqueDart){
	global $pdo;
	$sql_nombre="SELECT COUNT(pseudonyme) as nombre_pseudo FROM `VIEW_pseudonymes` WHERE `idAuteur` = ";
	$sql_nombre.=$idCritiqueDart;
	$result=$pdo->query($sql_nombre) or die('erreur SQL dans la fonction afficher_pseudos_by_id_critiqueDart()');
	foreach ($result as $r) $taille=$r['nombre_pseudo'];
	$sql="SELECT `pseudonyme` FROM `VIEW_pseudonymes` WHERE `idAuteur` = ";
	$sql.=$idCritiqueDart;
	//echo $sql;
	if($taille>0){
		$liste_pseudos=$pdo->query($sql) or die('erreur SQL dans la fonction afficher_pseudos_by_id_critiqueDart()');
		//print($taille);
		echo "Pseudonyme(s) recensé(s) pour ce critique : <ol>";
		foreach($liste_pseudos as $r){
			echo "<li>".$r['pseudonyme']."</li>";
		}
		echo "</ol>";
	}
	else echo "<p>Pas de pseudonyme recensé pour ce critique.</p>";
}
function afficher_entete_avec_meta($titre,$auteur,$critique,$description,$mots_cles,$date,$lieu,$rattachement,$type,$url,$contributeur){
	global $url_site;
	$entete='
<!DOCTYPE html>
<html class="js svg wf-adelle-n4-active wf-adelle-n7-active wf-active" lang="fr-FR">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link href="http://purl.org/dc/elements/1.1/" rel="schema.DC" />
	<meta charset="UTF-8">
	<meta name="keywords" content="'.$mots_cles.'" />
	<meta name="DC.format" content="text/html" />
	<meta name="DC.publisher" content="Université Paris 1, Panthéon-Sorbonne, UFR 03" />
	<meta name="DC.title" content="'.$titre.'" />
	<meta name="DC.date" content="'.$date.'" />
	<meta name="DC.identifier" content="'.$url.'" />
	<meta name="DC.subject" content="'.$mots_cles.'" />
	<meta name="DC.description" content="'.$description.'" />
	<meta name="DC.creator" content="'.$auteur.'" />
	<meta name="DC.type" content="'.$type.'" />
	<meta name="DC.language" content="fr" />
	<meta name="DC.relation" content="'.$url_site.'" />
	<meta name="DC.contributor" content="'.$contributeur.'" />
	<meta name="DC.rights" content="https://creativecommons.org/licenses/by/3.0/" />
	<meta name="DC.coverage" content="France" />
	<meta name="DC.coverage" lang="en" content="19-20th centuries">
	<meta name="DC.coverage" lang="fr" content="19-20emes siècles">
	<meta name="DC.source" content="http://critiquesdart.univ-paris1.fr">
	<title>Critiques d’art - Bibliographies en ligne de critiques d’art francophones</title>
	<link rel="stylesheet" id="labex-cap-style-css" href="template_fichiers/style.css" type="text/css" media="all">
	<script async src="template_fichiers/fly5lvw.js"></script>
	<script type="text/javascript" src="js/critiques.js"></script>
	<script type="text/javascript" src="template_fichiers/modernizr.js"></script>
	<script type="text/javascript" src="template_fichiers/jquery_002.js"></script>
	<script type="text/javascript" src="template_fichiers/jquery-migrate.js"></script>
	<script type="text/javascript" src="template_fichiers/jquery.js"></script>
	<script type="text/javascript" src="template_fichiers/application.js"></script>
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
	<link rel="canonical" href="'.$url_site.'">
	<link rel="apple-touch-icon" sizes="57x57" href="'.$chemin_relatif_icones.'apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="'.$chemin_relatif_icones.'apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="'.$chemin_relatif_icones.'apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="'.$chemin_relatif_icones.'apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="'.$chemin_relatif_icones.'apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="'.$chemin_relatif_icones.'apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="'.$chemin_relatif_icones.'apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="'.$chemin_relatif_icones.'apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="'.$chemin_relatif_icones.'apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="'.$chemin_relatif_icones.'favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="'.$chemin_relatif_icones.'favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="'.$chemin_relatif_icones.'favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="'.$chemin_relatif_icones.'favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="'.$chemin_relatif_icones.'favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-tilecolor" content="#ffffff">
	<meta name="msapplication-tileimage" content="'.$chemin_relatif_images.'mstile-144x144.png">
	<link rel="icon" href="'.$chemin_relatif_icones.'favicon.ico" type="image/x-icon">
	<style type="text/css">.font-adelle,.tk-adelle{font-family:"adelle",serif;}</style>
	<link href="template_fichiers/d.css" rel="stylesheet">
	<link href="template_fichiers/sbi.css" rel="stylesheet" type="text/css" id="sbi-style">
	<link type="text/css" rel="stylesheet" href="css/cairn.css">
	<link type="text/css" rel="stylesheet" href="css/critiques.css">
	<link rel="search" type="application/opensearchdescription+xml" title="Critiques" href="http://critiquesdart.univ-paris1.fr/opensearch.xml" />
</head>';
echo $entete;
}