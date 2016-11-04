<?php
function milieu_header(){
	// Donne les infos de session et les accès si connecté
	if(isset($_SESSION['user'])){
		echo "<li id=\"menu-item-135\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-135\">";
		echo "<a href=\"insertion.php\">Saisie</a>";
		echo "</li>";
		echo "<li class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\">Bonjour ".$_SESSION['user']."</li>"; 
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
	// Liste les critiques d'art dans des paragraphes
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
	// Dans un formulaire : liste des revues avec la date de couverture
	global $pdo;
	$sql = "SELECT titre, couverture FROM periodique ORDER BY titre";
	$req_titre_periodique=$pdo->query($sql) or die('erreur SQL'); 
	while ($r = $req_titre_periodique->fetch())
    {
		print('<option value="'.$r['titre'].' ('.$r['couverture'].')" />');
    }
}
function afficherAuteurById($id){
	// Affiche un auteur depuis son identifiant
	global $pdo;
	$sql = "SELECT nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_auteur->fetch())
    { 
		print('<p><a>'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
}
function afficherAuteurByIdModeBiblio($id){
	// Affiche un auteur depuis son identifiant sans hyperlien
	global $pdo;
	$sql = "SELECT nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE pk_id_critiqueDart = ".$id;
	//print($sql);
	$req_auteur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_auteur->fetch())
    { 
		//print('<span>'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</span>, ');
		print('<span>'.$r['prenom'].' '.$r['nom'].'</span>');
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
	$sql = "SELECT * FROM collectif` WHERE pk_id_collectif =".$id;
	$req_collectif=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_collectif->fetch())
    {
		print('<p><a>'.$r['titre'].'</a></p>');
    }
}
function afficherAuteursParLettre($lettre){
	// Affiche tous les auteurs dont le nom commence par la lettre passée en argument
	global $pdo;
	$sql = "SELECT nom, prenom, anneeNaissance, anneeMort FROM critiquedart WHERE nom LIKE '".$lettre."%' order by nom";
	//print($sql);
	$req_auteurs=$pdo->query($sql) or die('erreur SQL');
 	while ($r = $req_auteurs->fetch())
    {
		print('<p><a>'.$r['prenom'].' '.$r['nom'].' ('.$r['anneeNaissance'].'-'.$r['anneeMort'].')</a></p>');
    }
	return($r);
}
function inserer_nouvelle_revue($titre,$ISSN,$periodicite,$couverture){
	// insère une nouvelle revue, pas de retour
	global $pdo;
	$sql='INSERT INTO periodique (ISSN,titre,periodicite,couverture) VALUES ('.$ISSN.','.$titre.','.$periodicite.','.$couverture.')';
	$req_nouvelle_revue=$pdo->query($sql) or die('erreur SQL');
	//$id=$pdo->lastInsertId();
	//return($id);
}
function inserer_nouvel_ouvrage($TitreOuvrage,$sousTitreOuvrage,$CoordinationOuvrage,$Pagination,$AnneeEdition,$Editeur,$VilleEdition,$ISBN,$CollectionOuvrage,$Edition,$Editeur){
	// insère un nouvel ouvrage collectif
	global $pdo;
	$sql='INSERT INTO ouvrage (ISBN_10, annee, titre, complement_titre, coordonnateur, collection, edition, fk_id_editeur) ';
	$sql.=' VALUES ('.$ISBN.','.$AnneeEdition.','.$TitreOuvrage.','.$sousTitreOuvrage.','.$CoordinationOuvrage.','.$CollectionOuvrage.','.$Edition.','.$Editeur.')';
	$req_nouvel_ouvrage=$pdo->query($sql) or die('erreur SQL');
}
function editeur_id($nomEditeur){
	// Retourne l'identifiant d'un éditeur depuis son nom passé en argument
	global $pdo;
	$sql='SELECT `pk_id_editeur` FROM `editeur` WHERE `nom` LIKE '.$nomEditeur.' LIMIT 1';
	$req_id_editeur=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_id_editeur->fetch()){
		$id=$r['pk_id_editeur'];
	}
	return($id);
}
function inserer_nouvel_editeur($Editeur,$VilleEdition){
	// Crée un éditeur depuis son nom et sa ville passés en argument, retoure son identifiant
	global $pdo;
	$sql='INSERT INTO editeur (nom,ville) VALUES ('.$Editeur.','.$VilleEdition.')';
	$req_nouvel_editeur=$pdo->query($sql) or die('erreur SQL');
	return(editeur_id($Editeur));
}
function testLogin($login,$password,$users){
	// Vérifie que le mot de passe correspond à l'identifiant depuis les arguments retourne TRUE ou FALSE
	// echo crypt($password,$users[$login]['login']);
	// echo $users[$login]['password'];
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
	// Retourne l'identifiant d'une revue depuis son nom
	global $pdo;
	$revue_et_date = explode(" (", chop(trim($nomRevue,")")));
	$titre_revue=$revue_et_date[0];
	$couverture=$revue_et_date[1];
	//echo $titre_revue;
	//echo $couverture;
	$sql='SELECT `pk_id_periodique` FROM `periodique` WHERE `titre` LIKE \''.addslashes($titre_revue).'\' AND couverture LIKE \''.$couverture.'\'';
	$req_id_revue=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_id_revue->fetch()){
		$id=$r['pk_id_periodique'];
	}
	//echo $id;
	return($id);
}
function numero_periodique_id($id_revue,$numero,$annee,$nb_page,$titre_numero,$volume,$dateprecise){
	// Retourne l'identidiant d'un numero de périodique depuis son numéro, l'id du périodique lié en clé étrangère, l'année et éventuellement la date
	global $pdo;
	//$sql='SELECT pk_id_numero_periodique FROM `numeroperiodique` WHERE numero=NULL AND annee=1929 AND `nb_pages` = NULL AND titre=NULL AND volume LIKE 'X' AND dateprecise=NULL AND fk_id_periodique=66';
	$sql='SELECT pk_id_numero_periodique FROM numeroperiodique WHERE fk_id_periodique='.$id_revue;
	if($numero!='')$sql.=' AND numero='.$numero;
	if($annee!='')$sql.=' AND annee='.$annee;
	if($volume!='')$sql.=' AND volume LIKE \''.addslashes($volume).'\'';
	if($dateprecise!='')$sql.=' AND dateprecise LIKE \''.addslashes($dateprecise).'\'';
	echo $sql;
	$req_id_numero=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_id_numero->fetch()){
		$id=$r['pk_id_numero_periodique'];
	}
	if($id==''){
		//echo 'pas trouvé';
		$id=inserer_numero_periodique($id_revue,$numero,$annee,$nb_page,$titre_numero,$volume,$dateprecise);
	}
	//else echo $id;
	return($id);	
}
function inserer_numero_periodique($id_revue,$numero,$annee,$nb_pages,$titre_numero,$volume,$dateprecise){
	//Insère un numéro de prériodique et retourne son identifiant
	global $pdo;
	$sql='INSERT INTO numeroperiodique (pk_id_numero_periodique, numero, annee, nb_pages, titre, volume, dateprecise, fk_id_periodique)';
	$sql.=' VALUES (NULL,';
	if($numero!='')$sql.=$numero.',';
	else $sql.='NULL,';
	if($annee!='')$sql.=$annee.',';
	else $sql.='NULL,';
    if($nb_pages!='')$sql.=$nb_pages.',';
	else $sql.='NULL,';
	if($titre_numero!='')$sql.='\''.addslashes($titre_numero).'\',';
	else $sql.='NULL,';
	if($volume!='')$sql.='\''.addslashes($volume).'\',';
	else $sql.='NULL,';
	if($dateprecise!='')$sql.='\''.addslashes($dateprecise).'\',';
	else $sql.='NULL,';
	$sql.=$id_revue;
	$sql.=')';
	$req_insert_numero=$pdo->query($sql) or die('erreur SQL');
	return(numero_periodique_id($id_revue,$numero,$annee,$nb_page,$titre_numero,$volume,$dateprecise));
}
function inserer_critique($titre,$complementTitre,$type,$pagination,$attribution,$reedition,$fk_id_ouvrage,$fk_id_numero_periodique){
	// Insère une nouvelle critique et retourne son identifiant
	global $pdo;
	$sql='INSERT INTO critique (`pk_id_critique`, `titre`, `complementTitre`, `type`, `pagination`, `attribution`, `reedition`, `fk_id_ouvrage`, `fk_id_numeroperiodique`)';
	$sql.='VALUES (NULL,';
	$sql.='\''.$titre.'\',';
	if($complementTitre!='')$sql.='\''.addslashes($complementTitre).'\',';
	else $sql.='NULL,';
	$sql.='\'article\',';
	if($pagination!='')$sql.='\''.$pagination.'\',';
	else $sql.='\'n.p.\',';
	$sql.='\''.$type.'\',';
	if($reedition!='')$sql.=$reedition;
	else $sql.='NULL,';
	if($fk_id_ouvrage!='')$sql.='\''.$fk_id_ouvrage.'\',';
	else $sql.='NULL,';
	if($fk_id_numero_periodique!='')$sql.='\''.$fk_id_numero_periodique.'\'';
	else $sql.='NULL';
	$sql.=')';
	$req_insert_critique=$pdo->query($sql) or die('erreur SQL');
	$id_critique=$pdo->lastInsertId();
	return($id_critique);
	}
function inserer_signature($type_signature,$fk_id_pseudonyme,$fk_id_collectif,$fk_id_critique){
	// Insère la signature d'une critique et retourne son identifiant
	global $pdo;
	if($fk_id_pseudonyme=='')$fk_id_pseudonyme='NULL';
	if($fk_id_collectif=='')$fk_id_collectif='NULL';
	if($fk_id_critique=='')$fk_id_critique='NULL';
	$sql='INSERT INTO signature (pk_id_signature, type, fk_id_pseudonyme, fk_id_collectif, fk_id_critique)';
	$sql.=' VALUES (NULL, ';
	$sql.='\''.$type_signature.'\',';
	$sql.=$fk_id_pseudonyme.',';
	$sql.=$fk_id_collectif.',';
	$sql.=$fk_id_critique.')';
	$req_insert_signature=$pdo->query($sql) or die('erreur SQL');
	$id_signature=$pdo->lastInsertId();
	return($id_signature);
}
function inserer_composition_signature($id_signature,$id_critique_dart){
	// Insère un élément de composition de signature d'une critique
	global $pdo;
	$sql='INSERT INTO compositionsignature (fk_id_signature, fk_id_critiquedart)';
	$sql.=' VALUES ('.$id_signature.', '.$id_critique_dart.')';
	$req_insert_composition_signature=$pdo->query($sql) or die('erreur SQL');
}
function testerOuCreerPseudo($auteur,$pseudo){
	// Teste l'existence d'un pseudo pour un auteur
	// si oui renvoie l'id
	// si non le crée et renvoie l'id
	global $pdo;
	$sql='SELECT pk_id_pseudonyme FROM pseudonyme WHERE titre LIKE \''.addslashes($pseudo).'\' AND fk_id_critiqueDart_signataire ='.$auteur.' AND fk_id_critiqueDart_depositaire='.$auteur;
	$req_pseudo=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_pseudo->fetch()){
		$id_pseudo=$r['pk_id_pseudonyme'];
	}
	if(is_null($id_pseudo)){
		$sql_insertion='INSERT INTO pseudonyme (pk_id_pseudonyme, titre, utilisation, fk_id_critiqueDart_signataire, fk_id_critiqueDart_depositaire)';
		$sql_insertion.=' VALUES (NULL, \''.addslashes($pseudo).'\',\'originale\','.$auteur.','.$auteur.')';
		$insertion_pseudo=$pdo->query($sql_insertion) or die('erreur SQL');
		$id_pseudo=$pdo->lastInsertId();
	}
	return($id_pseudo);
}
function listeCritiquesAuteurArticles($id_auteur){
	global $pdo;
	/*
	$sql='SELECT pk_id_critique, titre, complementTitre, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage, fk_id_numeroperiodique ';
	$sql.='FROM critique ';
	$sql.='INNER JOIN signature ON fk_id_critique = pk_id_critique ';
	$sql.='INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature ';
	$sql.='WHERE fk_id_critiquedart='.$id_auteur;
	*/
	$sql='SELECT DISTINCT numeroperiodique.annee as annee, dateprecise, pk_id_critique, critique.titre, critique.complementTitre, critique.type as typeCritique, pagination, attribution, reedition, pk_id_signature, signature.type as typeSignature, fk_id_pseudonyme, fk_id_collectif, fk_id_ouvrage, fk_id_numeroperiodique FROM numeroperiodique 
INNER JOIN critique ON critique.fk_id_numeroperiodique = numeroperiodique.pk_id_numero_periodique
INNER JOIN signature ON fk_id_critique = pk_id_critique INNER JOIN compositionsignature ON pk_id_signature = fk_id_signature WHERE fk_id_critiquedart='.$id_auteur.' ORDER BY annee, dateprecise';
	$req_biblio=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_biblio->fetch()){
		echo "<li>";
		$id=$r['pk_id_critique'];
		$titre=$r['titre'];
		$complement_titre=$r['complementTitre'];
		if($r['attribution']=='attribué') echo 'Attribué à ';
		//echo ' '.$id;
		//echo "<pre>";
		//print_r($r);
		//echo "</pre>";
		composition_signature($r['pk_id_signature']);
		if($r['fk_id_numeroperiodique']!=''){
			afficher_n_periodique($r['fk_id_numeroperiodique'],$titre,$complement_titre);
			if($r['pagination']!='') echo ", p. ".$r['pagination'];
		}
		else {
			echo "ceci n'est pas un périodique";
		}
		echo "</li>";
		//echo $sql;
		
	}
}
function composition_signature($id_signature){
	global $pdo;
	$sql='SELECT fk_id_critiquedart FROM compositionsignature ';
	$sql.='WHERE fk_id_signature='.$id_signature;
	//echo $sql;
	$req_signature=$pdo->query($sql) or die('erreur SQL');
	while ($r = $req_signature->fetch()){
		afficherAuteurByIdModeBiblio($r['fk_id_critiquedart']);
	}
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
		if($complement_titre!='')echo ", [$complement_titre]";
		echo ", (".$r['annee'].")";
		echo ", <em>".$r['nom_revue']."</em>";
		if($r['numero']!='') echo ", n° ".$r['numero'];
		if($r['volume']!='') echo ", vol. ".$r['volume'];
		if($r['dateprecise']!='') echo ", le ".date("d-m-Y", strtotime($r['dateprecise']));
	}
}