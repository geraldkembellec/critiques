<?php
/* Configure le script en français */
setlocale (LC_TIME, 'fr_FR','fra');
//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
date_default_timezone_set("Europe/Paris");
//Definit l'encodage interne
mb_internal_encoding("UTF-8");
//Convertir une date US en françcais
function date_fr($date_us){
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
		echo "<li id=\"menu-item-135\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-135\">";
		echo "<a href=\"insertion.php\">Saisie</a>";
		echo "</li>";
		echo "<li class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\">Bonjour ".$_SESSION['label']."</li>"; 
	}
	else{
			echo "<li class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\">Non connecté</li>";
	}
}
function listerAuteurs(){
	// Affiche les auteurs par lettre
	// Les lettres qui ne pointent pas vers des auteurs sont grisées
	global $pdo;
	$liste='';
	foreach(range('A', 'Z') as $lettre){
		$sql = "SELECT COUNT(DISTINCT pk_id_critiqueDart) AS compteur FROM critiquedart WHERE nom LIKE '".$lettre."%' order by nom";
		$req_nb_auteur = $pdo->query($sql);
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
	$req_auteurs=$pdo->query($sql) or die('erreur SQL'); 
	while ($r = $req_auteurs->fetch())
    {
		print('<option value="'.$r['titre'].' ('.$r['annee'].')" />');
    }
}
function afficherTousLesAuteurs(){
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom, anneeNaissance, anneeMort FROM critiquedart order by nom";
	//print($sql);
	$req_auteurs=$pdo->query($sql) or die('erreur SQL'); 
	//$tab_auteurs[]=mysql_fetch_array($req_auteurs);
	//
    //$r = mysql_fetch_array($);
	while ($r = $req_auteurs->fetch())
    {
		print('<p><a href="biblio_auteur.php?critique='.$r['pk_id_critiqueDart'].'">'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
	return($r);
}
function afficherTousLesAuteursFormOption(){
	// Dans un formulaire : liste les auteurs
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom FROM critiquedart order by nom";
	$req_auteurs=$pdo->query($sql) or die('erreur SQL'); 
	while ($r = $req_auteurs->fetch())
    {
		print('<option value="'.$r['pk_id_critiqueDart'].'">'.$r['prenom'].' '.$r['nom'].'</option>');
    }
}
function affichierToutesLesRevuesFormOption(){
	global $pdo;
	$sql = "SELECT titre, couverture FROM periodique ORDER BY titre";
	//echo $sql;
	$req_titre_periodique=$pdo->query($sql) or die('erreur SQL'); 
	while ($r = $req_titre_periodique->fetch())
    {
		print('<option value="'.$r['titre'].' ('.$r['couverture'].')" />');
    }
}
function afficherAuteurById($id){
	// Affiche un auteur depuis son identifiant
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL');
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
	$req_auteur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_auteur->fetch())
    { 
		print($r['prenom'].' '.$r['nom']);
    }
	return($r['prenom'].' '.$r['nom']);
}
function getAuteurNomPrenomById($id){
	global $pdo;
	$sql = "SELECT nom, prenom FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	$req_auteur=$pdo->query($sql) or die('erreur SQL');
	$nom_complet='';
	while ($r = $req_auteur->fetch())
    { 
		$nom_complet.=$r['prenom'].' '.$r['nom'];
    }
	return($nom_complet);
}

function afficherAuteurByIdModeBiblio($id,$date){
	// Affiche un auteur depuis son identifiant
	global $pdo;
	$sql = "SELECT nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_auteur->fetch())
    { 
		if($date!='')print('<span>'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</span> ');
		else print('<span>'.$r['prenom'].' '.$r['nom'].'</span>');
    }
}
function afficherTousLesCollectifFormOption(){
	// Affiche un collectif depuis son identifiant passé en argument
	global $pdo;
	$sql = "SELECT * FROM collectif";
	$req_collectif=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_collectif->fetch())
    { 
		print('<option value="'.$r['pk_id_collectif'].'">'.$r['titre'].'</option>');
    }
}
function afficherCollectifById($id){
	// Affiche un collectif depuis son identifiant passé en argument
	global $pdo;
	$sql = "SELECT * FROM collectif WHERE pk_id_collectif =".$id;
	echo $sql;
	$req_collectif=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_collectif->fetch())
    {
		print('<p><a>'.$r['titre'].'</a></p>');
    }
}
function afficherAuteursParLettre($lettre){
	// Affiche tous les auteurs dont le nom commence par la lettre passée en argument
	global $pdo;
	$sql = "SELECT pk_id_critiqueDart, nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE nom LIKE '".$lettre."%' order by nom";
	//print($sql);
	$req_auteurs=$pdo->query($sql) or die('erreur SQL');
 	while ($r = $req_auteurs->fetch())
    {
	print('<p><a href="biblio_auteur.php?critique='.$r['pk_id_critiqueDart'].'">'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
	return($r);
}
function inserer_nouvelle_revue($titre,$ISSN,$periodicite,$couverture){
	global $pdo;
	$sql='INSERT INTO periodique (ISSN,titre,periodicite,couverture) VALUES ('.$ISSN.','.addslashes($titre).','.$periodicite.','.$couverture.')';
	//echo $sql;
	$req_nouvelle_revue=$pdo->query($sql) or die('erreur SQL');
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
	if($sousTitreOuvrage!='')$sql.='\''.$sousTitreOuvrage.'\',';
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
	echo $sql;
	$req_nouvel_ouvrage=$pdo->query($sql) or die('erreur SQL table ouvrage fonction inserer_nouvel_ourage');
	$id=$pdo->lastInsertId();
	return($id);
}
function editeur_id($nomEditeur){
	global $pdo;
	$sql='SELECT `pk_id_editeur` FROM `editeur` WHERE `nom` LIKE \''.addslashes($nomEditeur).'\' LIMIT 1';
	//echo $sql;
	$req_id_editeur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_id_editeur->fetch()){
		$id=$r['pk_id_editeur'];
	}
	return($id);
}
function AfficherNomEditeur($pk_id_editeur){
	global $pdo;
	$sql='SELECT `nom` FROM `editeur` WHERE `pk_id_editeur` LIKE '.$pk_id_editeur.' LIMIT 1';
	//echo $sql;
	$req_nom_editeur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_nom_editeur->fetch()){
		$nom=$r['nom'];
	}
	return($nom);
}
function AfficherVilleEditeur($pk_id_editeur){
	global $pdo;
	$sql='SELECT `ville` FROM `editeur` WHERE `pk_id_editeur` LIKE '.$pk_id_editeur.' LIMIT 1';
	//echo $sql;
	$req_ville_editeur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_ville_editeur->fetch()){
		$ville=$r['ville'];
	}
	return($ville);
}
function inserer_nouvel_editeur($Editeur,$VilleEdition){
	global $pdo;
	$sql='INSERT INTO editeur (nom,ville) VALUES (\''.addslashes($Editeur).'\',\''.addslashes($VilleEdition).'\')';
	//echo $sql;
	$req_nouvel_editeur=$pdo->query($sql) or die('erreur SQL');
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
	//echo $sql;
	$req_id_revue=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_id_revue->fetch()){
		$id=$r['pk_id_periodique'];
	}
	//echo $id;
	return($id);
}
function ouvrage_id($nomOuvrage){
	global $pdo;
	$ouvrage_et_date = explode(" (", chop(trim($nomOuvrage,")")));
	$titre_ouvrage=$ouvrage_et_date[0];
	$couverture=$ouvrage_et_date[1];
	$sql='SELECT `pk_id_ouvrage` FROM `ouvrage` WHERE `titre` LIKE \''.addslashes($titre_ouvrage).'\'';
	//echo $sql;
	$req_id_ouvrage=$pdo->query($sql) or die('erreur SQL');
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
	$req_id_numero=$pdo->query($sql) or die('erreur SQL');
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
	$req_insert_numero=$pdo->query($sql) or die('erreur SQL');
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
	//if($complementTitre!='')$sql.='\''.addslashes($complementTitre).'\',';
	if($complementTitre!='')$sql.='\''.$complementTitre.'\',';
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
	$req_insert_critique=$pdo->query($sql) or die('erreur SQL');
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
		$insertion_pseudo=$pdo->query($sql_insertion) or die('erreur SQL');
		$id_pseudo=$pdo->lastInsertId();
	}
	return($id_pseudo);
}
function listeCritiquesAuteurMonographies($id_auteur,$id_critique){
	global $pdo;
	$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre, ouvrage.complement_titre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND critique.type = \'monographie\'
ORDER BY annee,titre';
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	//echo "critique n° ".$id_critique;
	while ($r = $req_biblio->fetch()){
		
		echo "<li>";
		$id_editeur=$r['idEditeur'];
		$id=$r['pk_id_critique'];
		if($id_critique==$id){echo "<mark>";}
		$titre=$r['titre'];
		$annee=$r['annee'];
		$complement_titre=$r['complement_titre'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		if($r['fk_id_pseudonyme']==NULL){
			composition_signature($r['pk_id_signature'],$r['typeSignature']);
		}
		else afficher_pseudo($r['fk_id_pseudonyme']);
		echo ", &laquo; ".$titre." &raquo;";
		echo " (".$annee.")";
		if($complement_titre!='')echo ", [".$complement_titre."]";
		if($id_editeur!=''){ 
			$nom_editeur=AfficherNomEditeur($id_editeur);
			$ville_editeur=AfficherVilleEditeur($id_editeur);
			if($nom_editeur!='')echo ", ".$nom_editeur;
			if($ville_editeur!='')echo ", ".$ville_editeur;
		}
		if($r['collection']!='') echo ", coll. « ".$r['collection']." »";
		if($r['pagination']!='n.p.' && $r['pagination']!='n.r.') echo ", ".$r['pagination']." p. ";
			else echo ", ".$r['pagination'];
		}
		if($id_critique==$id){echo "</mark>";}
		echo "</li>";
		
	}
function listeCritiquesAuteurParticipationOuvrage($id_auteur,$id_critique){
	global $pdo;
	$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre as titreChapitre, critique.complementTitre as complementTitreChapitre, ouvrage.titre, ouvrage.complement_titre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, ouvrage.coordonnateur, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND critique.type = \'chapitre\'
ORDER BY annee,titre';
	//echo $sql;
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	//echo "critique n° ".$id_critique;
	while ($r = $req_biblio->fetch()){	
		echo "<li>";
		$id_editeur=$r['idEditeur'];
		$id=$r['pk_id_critique'];
		if($id_critique==$id){echo "<mark>";}
		$titre_ouvrage=$r['titre'];
		$annee=$r['annee'];
		$titre=$r['titreChapitre'];
		$complement_titre=$r['complementTitreChapitre'];
		$coordonnateur=$r['coordonnateur'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		if($r['fk_id_pseudonyme']==NULL){
			composition_signature($r['pk_id_signature'],$r['typeSignature']);
		}
		else afficher_pseudo($r['fk_id_pseudonyme']);
		echo ", &laquo; ".$titre." &raquo;";
		echo " (".$annee.")";
		if($complement_titre!='')echo ", [".$complement_titre."]";
		if($coordonnateur!='')echo ", in ".$coordonnateur." (dir)";
		echo ", <em>".$titre_ouvrage."</em>";
		if($id_editeur!=''){ 
			$nom_editeur=AfficherNomEditeur($id_editeur);
			$ville_editeur=AfficherVilleEditeur($id_editeur);
			if($nom_editeur!='')echo ", ".$nom_editeur;
			if($ville_editeur!='')echo ", ".$ville_editeur;
		}
		if($r['collection']!='') echo ", coll. « ".$r['collection']." »";
		if($r['pagination']!='n.p.' && $r['pagination']!='n.r.') echo ", pp. ".$r['pagination'];
			else echo ", ".$r['pagination'];
		}
		if($id_critique==$id){echo "</mark>";}
		echo "</li>";	
}
function listePrefaces($id_auteur,$id_critique){
	global $pdo;
	$sql='SELECT DISTINCT ouvrage.annee as annee, pk_id_critique, critique.titre as titreChapitre, ouvrage.titre, ouvrage.complement_titre as complementTitre, ouvrage.fk_id_editeur as idEditeur, ouvrage.collection, ouvrage.coordonnateur, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage FROM ouvrage INNER JOIN critique ON critique.fk_id_ouvrage = ouvrage.pk_id_ouvrage INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' AND critique.type = \'preface\'
ORDER BY annee,titre';
	//echo $sql;
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	//echo "critique n° ".$id_critique;
	while ($r = $req_biblio->fetch()){	
		echo "<li>";
		$id_editeur=$r['idEditeur'];
		$id=$r['pk_id_critique'];
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
		echo ", &laquo; ".$titre." &raquo;";
		echo " (".$annee.")";
		if($coordonnateur!='')echo ", in ".$coordonnateur." (dir)";
		echo ", <em>".$titre_ouvrage."</em>";
		if($complement_titre!='')echo ", [".$complement_titre."]";
		if($id_editeur!=''){ 
			$nom_editeur=AfficherNomEditeur($id_editeur);
			$ville_editeur=AfficherVilleEditeur($id_editeur);
			if($nom_editeur!='')echo ", ".$nom_editeur;
			if($ville_editeur!='')echo ", ".$ville_editeur;
		}
		if($r['collection']!='') echo ", coll. « ".$r['collection']." »";
		if($r['pagination']!='n.p.' && $r['pagination']!='n.r.') echo ", pp. ".$r['pagination'];
			else echo ", ".$r['pagination'];
		}
		if($id_critique==$id){echo "</mark>";}
		echo "</li>";	
}
function listeCritiquesAuteurArticles($id_auteur,$id_critique){
	global $pdo;
	$sql='SELECT DISTINCT numeroperiodique.annee as annee, dateprecise, pk_id_critique, critique.titre, critique.complementTitre, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage, fk_id_numeroperiodique FROM numeroperiodique 
INNER JOIN critique ON critique.fk_id_numeroperiodique = numeroperiodique.pk_id_numero_periodique
INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' ORDER BY annee, dateprecise';
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_biblio->fetch()){
		echo "<li>";
		$id=$r['pk_id_critique'];
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
			else echo ", ".$r['pagination'];
		}
		else {
			echo "ceci n'est pas un périodique";
		}
		if($id_critique==$id){echo "</mark>";}
		echo "</li>";
		//echo $sql;
	}
}
function composition_signature($id_signature,$type){
	global $pdo;
	$sql='SELECT fk_id_critiquedart FROM compositionsignature ';
	$sql.='WHERE fk_id_signature='.$id_signature;
	//echo $sql;
	$taille=(tailleSignature($id_signature));
	$req_signature=$pdo->query($sql) or die('erreur SQL');
	//echo "Type : ".$type;
	$i=0;
	if($type=='patronyme'){
		while ($r = $req_signature->fetch()){
			$i++;
			afficherAuteurByIdModeBiblio($r['fk_id_critiquedart']);
			if($i < $taille && $taille=2) echo " et ";
			elseif($i < $taille && $taille>2) echo ", ";
		}
	}
	elseif($type=='initiales'){
		while ($r = $req_signature->fetch()){
			afficher_initiales($r['fk_id_critiquedart']);
		}
	}
	elseif($type=='pseudonyme'){
		
	}
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
		echo ", &laquo; ".$titre." &raquo;";
		if($complement_titre!='')echo ", ".$complement_titre;
		if($r['complementTitreNumero']!='')echo ", ".$r['complementTitreNumero'];
		echo " (".$r['annee'].")";
		echo ", <em>".$r['nom_revue']."</em>";
		if($r['numero']!='') echo ", n° ".$r['numero'];
		if($r['volume']!='') echo ", ".$r['volume'];
		//if($r['dateprecise']!='') echo ", le ".date("d-m-Y", strtotime($r['dateprecise']));
		if($r['dateprecise']!=''){
			 //echo ", le ".$r['dateprecise'];
			 echo ", le ".date_fr($r['dateprecise']);
		}
	}
}
function afficher_initiales($id_auteur){
	global $pdo;
	$sql='SELECT initiales FROM critiquedart WHERE pk_id_critiqueDart='.$id_auteur;
	//echo $sql;
	$req_initiales=$pdo->query($sql) or die('erreur SQL');
	foreach ($req_initiales as $initiales){
		print($initiales[0]);
	}
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
		echo ', peut correspondre à une signature composite ou à un pseudonyme">'.$r['titre'].'</abbr>';
	}
}
function afficher_coordination($nom_prenom){
	global $pdo;
	$sql='SELECT count(pk_id_ouvrage) as nombre FROM `ouvrage` WHERE `coordonnateur` LIKE \'%'.$nom_prenom.'%\'';
	//echo $sql;
	$nombre_coordination=$pdo->query($sql) or die('erreur SQL');
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
			echo ', « '.$r['titre'].' »';
			echo ' ('.$r['annee'].')';
			if($r['complement_titre']!='' OR $r['complement_titre']!=NULL)echo ", [".$r['complement_titre'].']';
			if($r['fk_id_editeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($r['fk_id_editeur']);
			$ville_editeur=AfficherVilleEditeur($r['fk_id_editeur']);
			if($nom_editeur!='')echo ", ".$nom_editeur;
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($r['collection']!='') echo ", coll. « ".$r['collection']." »";
		}
			echo '</li>';
		}
		echo "</ol>";
	}
}