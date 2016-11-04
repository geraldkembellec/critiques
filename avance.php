<?php
		session_start();
		include 'config.php';
		include 'lib_fonctions.php';
		include 'html_habillage.php';
		echo $entete;
		echo $debut_container;
		echo $debut_header;
		if(isset($_SESSION['user'])){
        	echo "<a href=\"unconnect.php\" class=\"icon-deconnect\" title=\"Se déconnecter\"></a>
						<span class=\"label\">Se deconnecter</span>"; 
		}
		else{
			echo "<a href=\"connectV2.php\" class=\"icon-person\"></a>
						<span class=\"label\">
                        S’identifier</span>";
		}
		echo $suite_header;
		milieu_header();
	    echo $fin_header;
		echo $debut_main;
		echo $debut_article;
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////	
function les_introductions($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>introduction</mark></li>";
	$sql = "SELECT * FROM `VIEW_introductions` WHERE `idCritique` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR ouvrageTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR ouvrageTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['typeSignature']!=''){
		$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
	}
	if($_GET['auteur']!=''){
		$sql .= " AND idCritiqueDart=".$_GET['auteur'];
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['ouvrage']!=''){
		$sql .= " AND ouvrageTitre LIKE '%".urldecode(addslashes($_GET['ouvrage']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de l'ouvrage associé est (ou contient la chaîne) <q><mark>".$_GET['ouvrage']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	//echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, titre";
	}
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	$nb_introductions=$resultats->rowCount();
	echo "<h3 id='introductions'>Liste des introductions correspondantes (".$nb_introductions.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
	//
	foreach ($resultats as $enr){
		
		$critique["id"]=$enr['idCritique'];
		$critique["idOuvrage"]=$enr['idOuvrage'];
					$critique["nom"]=$enr['nom'];
					$critique["prenom"]=$enr['prenom'];
					$critique["typeSignature"]=$enr["typeSignature"];
					$critique["idSignature"]=$enr["idSignature"];
					if($enr["typeSignature"]=='patronyme'){
						$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
					}
					$critique["titre"]=$enr['titre'];
					$critique["complement_titre"]=$enr['ouvrageComplement_Titre'];
					$critique["annee"]=$enr['annee'];
					$critique["pagination"]=$enr['pagination'];
					$critique["idPseudonyme"]=$enr['idPseudo'];
					$critique["idEditeur"]=$enr['idEditeur'];
					$critique["ISBN"]=$enr['ISBN'];
					$critique["collection"]=$enr['collection'];
					$critique["titreOuvrage"]=$enr['ouvrageTitre'];
					$critique["coordonnateur"]=$enr['coordonnateur'];
		//print_r($critique);
		/////
		$nom_editeur=AfficherNomEditeur($critique["idEditeur"]);
		$ville_editeur=AfficherVilleEditeur($critique["idEditeur"]);
		///
		echo "<li itemscope itemtype='http://schema.org/Chapter' itemid='".$url_site."/critiques/biblio_auteur.php?critique=".composition_signature($critique['idSignature'],$critique['typeSignature'],TRUE)."&idcritiquesignee=".$critique["id"]."'>";
		echo debut_COinS_chapitre($critique["ISBN"],urlencode($critique["titre"]." ".$critique["complement_titre"]),urlencode($critique["titreOuvrage"]),urlencode($critique["signature"]),urlencode($critique["nom"]),urlencode($critique["prenom"]),$critique["annee"],$numero,$critique["pagination"],urlencode($nom_editeur),urlencode($critique["coordonnateur"]));
		if($critique["idPseudonyme"]==NULL){
			composition_signature($critique['idSignature'],$critique['typeSignature']);
		}
		else afficher_pseudo($critique['idPseudonyme']);
		echo ", <q>".$critique['titre']." </q>";
		if($critique['complement_titre']!=''){
			echo ", ".$critique['complement_titre'];
		}
		echo ", in ";
		if($critique["coordonnateur"]!=='' && $critique["coordonnateur"]!=NULL) echo $critique["coordonnateur"].", ";
		echo "<em>".$critique["titreOuvrage"]."</em>";
		if($critique["complement_titre_ouvrage"]!='' && $critique["complement_titre_ouvrage"] != NULL){
			echo " [".$critique["complement_titre_ouvrage"]."]";
		}
		if($critique['idEditeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($critique['idEditeur']);
			$ville_editeur=AfficherVilleEditeur($critique['idEditeur']);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($critique['collection']!=''){ 
			echo ", coll. <q>".$critique['collection']."</q>";
		}
		if($critique["annee"]!=='' && $critique["annee"]!=NULL) echo ", ".$critique["annee"];
		if($critique["pagination"]!=='' && $critique["pagination"]!=NULL && $critique["pagination"]!='n.p.' && $critique["pagination"]!='n.r.') echo ", p. ".$critique["pagination"];
		echo fin_COinS();
		echo ".</li>";
	}
	/////
	echo "</ol>";
	//
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function les_coordinations($verbose){
	global $pdo;	
	$rappel="<li>Vous cherchez une <mark>direction d'ouvrage</mark></li>";
	$sql = "SELECT * FROM `VIEW_coordinations_ouvrages` WHERE `pk_id_ouvrage` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (complement_titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND complement_titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['typeSignature']!=''){
		//$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
		if($_GET['typeSignature']=='anonyme') $sql .= " AND coordonnateur LIKE 'n.a.'";
	}
	if($_GET['auteur']!=''){
		$sql .= " AND coordonnateur LIKE '%".addslashes(getAuteurByIdModeBiblio($_GET['auteur']))."%'";
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['ouvrage']!=''){
		$sql .= " AND titre LIKE '%".urldecode(addslashes($_GET['ouvrage']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de la monographie est (ou contient la chaîne) <q><mark>".$_GET['ouvrage']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	//echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, titre";
	}
	//echo $sql;
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	$nb_coordinations=$resultats->rowCount();
	echo "<h3 id='coordinations'>Liste des coordinations d'ouvrages correspondantes (".$nb_coordinations.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
	foreach ($resultats as $r){
		//print_r($r);
			echo '<li>';
			//debut_COinS_direction_ouvrage($ISBN,$titre,$signature,$ville,$editeur,$collection,$directeur_ouvrage,$date,$pagination);
			if($r['fk_id_editeur']!=''){ 
				$nom_editeur=AfficherNomEditeur($r['fk_id_editeur']);
				$ville_editeur=AfficherVilleEditeur($r['fk_id_editeur']);
			}
			echo debut_COinS_direction_ouvrage($r["ISBN_10"],urlencode($r["titre"]." ".$r["complement_titre"]),urlencode($r["signature"]),urlencode($ville_editeur),urlencode($nom_editeur),urlencode($r["collection"]),$r["coordonnateur"],$r["annee"],$r["pagination"]);
			if($r['coordonnateur']!='' OR $r['coordonnateur']!=NULL)echo $r['coordonnateur'].' (dir)';
			echo ', <em>'.$r['titre'].'</em>';
			if($r['complement_titre']!='' OR $r['complement_titre']!=NULL)echo ", [".$r['complement_titre'].']';
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
			if($r['collection']!='') echo ", coll. <q>".$r['collection']."</q>";
			if($r['annee']!='')echo ', '.$r['annee'];
			if($r['titre']!='')echo ".";
			echo '</li>';
	}
	echo "</ol>";
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////	
function les_postfaces($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>postface</mark></li>";
	$sql = "SELECT * FROM `VIEW_postfaces` WHERE `idCritique` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR ouvrageTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR ouvrageTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['typeSignature']!=''){
		$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
	}
	if($_GET['auteur']!=''){
		$sql .= " AND idCritiqueDart=".$_GET['auteur'];
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['ouvrage']!=''){
		$sql .= " AND titre LIKE '%".urldecode(addslashes($_GET['ouvrage']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de la monographie est (ou contient la chaîne) <q><mark>".$_GET['ouvrage']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	//echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, titre";
	}
	//echo $sql;
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	$nb_chapitres=$resultats->rowCount();
	echo "<h3 id='postfaces'>Liste des postfaces correspondantes (".$nb_chapitres.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
	//
	foreach ($resultats as $enr){
		
		$critique["id"]=$enr['idCritique'];
		$critique["idOuvrage"]=$enr['idOuvrage'];
					$critique["nom"]=$enr['nom'];
					$critique["prenom"]=$enr['prenom'];
					$critique["typeSignature"]=$enr["typeSignature"];
					$critique["idSignature"]=$enr["idSignature"];
					if($enr["typeSignature"]=='patronyme'){
						$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
					}
					$critique["titre"]=$enr['titre'];
					$critique["complement_titre"]=$enr['ouvrageComplement_Titre'];
					$critique["annee"]=$enr['annee'];
					$critique["pagination"]=$enr['pagination'];
					$critique["idPseudonyme"]=$enr['idPseudo'];
					$critique["idEditeur"]=$enr['idEditeur'];
					$critique["ISBN"]=$enr['ISBN'];
					$critique["collection"]=$enr['collection'];
					$critique["titreOuvrage"]=$enr['ouvrageTitre'];
					$critique["coordonnateur"]=$enr['coordonnateur'];
		//print_r($critique);
		/////
		$nom_editeur=AfficherNomEditeur($critique["idEditeur"]);
		$ville_editeur=AfficherVilleEditeur($critique["idEditeur"]);
		///
		echo "<li itemscope itemtype='http://schema.org/Chapter' itemid='".$url_site."/critiques/biblio_auteur.php?critique=".composition_signature($critique['idSignature'],$critique['typeSignature'],TRUE)."&idcritiquesignee=".$critique["id"]."'>";
		echo debut_COinS_chapitre($critique["ISBN"],urlencode($critique["titre"]." ".$critique["complement_titre"]),urlencode($critique["titreOuvrage"]),urlencode($critique["signature"]),urlencode($critique["nom"]),urlencode($critique["prenom"]),$critique["annee"],$numero,$critique["pagination"],urlencode($nom_editeur),urlencode($critique["coordonnateur"]));
		if($critique["idPseudonyme"]==NULL){
			composition_signature($critique['idSignature'],$critique['typeSignature']);
		}
		else afficher_pseudo($critique['idPseudonyme']);
		echo ", <em>".$critique['titre']." </em>";
		if($critique['complement_titre']!=''){
			echo ", ".$critique['complement_titre'];
		}
		echo ", ".$critique['annee'];
		echo " in <q>".$critique["titreOuvrage"]."</q>";
		if($critique["coordonnateur"]!=='' && $critique["coordonnateur"]!=NULL) echo ', '.$critique["coordonnateur"].' (dir)';
		if($critique['idEditeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($critique['idEditeur']);
			$ville_editeur=AfficherVilleEditeur($critique['idEditeur']);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($critique['collection']!=''){ 
			echo ", coll. <q>".$critique['collection']."</q>";
		}
		if($critique["annee"]!=='' && $critique["annee"]!=NULL) echo " , ".$critique["annee"];
		if($critique["pagination"]!=='' && $critique["pagination"]!=NULL) echo " , p. ".$critique["pagination"];
		echo fin_COinS();
		echo ".</li>";
	}
	/////
	echo "</ol>";
	//
}

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function les_prefaces($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>préface</mark></li>";
	$sql = "SELECT * FROM `VIEW_prefaces` WHERE `idCritique` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR ouvrageTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR ouvrageTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['typeSignature']!=''){
		$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
	}
	if($_GET['auteur']!=''){
		$sql .= " AND idCritiqueDart=".$_GET['auteur'];
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['ouvrage']!=''){
		$sql .= " AND titre LIKE '%".urldecode(addslashes($_GET['ouvrage']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de la monographie est (ou contient la chaîne) <q><mark>".$_GET['ouvrage']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	//echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, titre";
	}
	//echo $sql;
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	$nb_chapitres=$resultats->rowCount();
	echo "<h3 id='prefaces'>Liste des préfaces correspondantes (".$nb_chapitres.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
	//
	foreach ($resultats as $enr){
		
		$critique["id"]=$enr['idCritique'];
		$critique["idOuvrage"]=$enr['idOuvrage'];
					$critique["nom"]=$enr['nom'];
					$critique["prenom"]=$enr['prenom'];
					$critique["typeSignature"]=$enr["typeSignature"];
					$critique["idSignature"]=$enr["idSignature"];
					if($enr["typeSignature"]=='patronyme'){
						$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
					}
					$critique["titre"]=$enr['titre'];
					$critique["complement_titre"]=$enr['critiqueComplementTitre'];
					$critique["complement_titre_ouvrage"]=$enr['ouvrageComplement_Titre'];
					$critique["annee"]=$enr['annee'];
					$critique["pagination"]=$enr['pagination'];
					$critique["idPseudonyme"]=$enr['idPseudo'];
					$critique["idEditeur"]=$enr['idEditeur'];
					$critique["ISBN"]=$enr['ISBN'];
					$critique["collection"]=$enr['collection'];
					$critique["titreOuvrage"]=$enr['ouvrageTitre'];
					$critique["coordonnateur"]=$enr['coordonnateur'];
		//print_r($critique);
		/////
		$nom_editeur=AfficherNomEditeur($critique["idEditeur"]);
		$ville_editeur=AfficherVilleEditeur($critique["idEditeur"]);
		///
		echo "<li itemscope itemtype='http://schema.org/Chapter' itemid='".$url_site."/critiques/biblio_auteur.php?critique=".composition_signature($critique['idSignature'],$critique['typeSignature'],TRUE)."&idcritiquesignee=".$critique["id"]."'>";
		echo debut_COinS_chapitre($critique["ISBN"],urlencode($critique["titre"]." ".$critique["complement_titre"]),urlencode($critique["titreOuvrage"]),urlencode($critique["signature"]),urlencode($critique["nom"]),urlencode($critique["prenom"]),$critique["annee"],$numero,$critique["pagination"],urlencode($nom_editeur),urlencode($critique["coordonnateur"]));
		if($critique["idPseudonyme"]==NULL){
			composition_signature($critique['idSignature'],$critique['typeSignature']);
		}
		else afficher_pseudo($critique['idPseudonyme']);
		echo ", <q>".$critique['titre']."</q>";
		if($critique['complement_titre']!=''){
			echo ", ".$critique['complement_titre'];
		}
		//echo ", ".$critique['annee'];
		echo ", in ";
		if($critique["coordonnateur"]!=='' && $critique["coordonnateur"]!=NULL) echo $critique["coordonnateur"].", ";
		echo "<em>".$critique["titreOuvrage"]."</em>";
		if($critique["complement_titre_ouvrage"]!='' && $critique["complement_titre_ouvrage"] != NULL){
			echo " [".$critique["complement_titre_ouvrage"]."]";
		}
		if($critique['idEditeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($critique['idEditeur']);
			$ville_editeur=AfficherVilleEditeur($critique['idEditeur']);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($critique['collection']!=''){ 
			echo ", coll. <q>".$critique['collection']."</q>";
		}
		if($critique["annee"]!=='' && $critique["annee"]!=NULL) echo ", ".$critique["annee"];
		if($critique["pagination"]!=='' && $critique["pagination"]!=NULL && $critique["pagination"]!='n.p.' && $critique["pagination"]!='n.r.') echo ", p. ".$critique["pagination"];
		echo fin_COinS();
		echo ".</li>";
	}
	/////
	echo "</ol>";
	//
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

/////////////////////////////////////////////////////
///////////////// Chapitres /////////////////////////
/////////////////////////////////////////////////////
function les_chapitres($verbose){
	global $pdo;	
	$rappel="<li>La critique est un <mark>chapitre</mark></li>";
	$sql = "SELECT * FROM `VIEW_chapitres` WHERE `idCritique` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['typeSignature']!=''){
		$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
	}
	if($_GET['auteur']!=''){
		$sql .= " AND idCritiqueDart=".$_GET['auteur'];
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['ouvrage']!=''){
		$sql .= " AND titre LIKE '%".urldecode(addslashes($_GET['ouvrage']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de la monographie est (ou contient la chaîne) <q><mark>".$_GET['ouvrage']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	//echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, titre";
	}
	//echo $sql;
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	$nb_chapitres=$resultats->rowCount();
	echo "<h3 id='chapitres'>Liste des chapitres correspondants (".$nb_chapitres.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
	//
	foreach ($resultats as $enr){
		
		$critique["id"]=$enr['idCritique'];
		$critique["idOuvrage"]=$enr['idOuvrage'];
					$critique["nom"]=$enr['nom'];
					$critique["prenom"]=$enr['prenom'];
					$critique["typeSignature"]=$enr["typeSignature"];
					$critique["idSignature"]=$enr["idSignature"];
					if($enr["typeSignature"]=='patronyme'){
						$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
					}
					$critique["titre"]=$enr['titre'];
					$critique["complement_titre"]=$enr['ouvrageComplement_Titre'];
					$critique["annee"]=$enr['annee'];
					$critique["pagination"]=$enr['pagination'];
					$critique["idPseudonyme"]=$enr['idPseudo'];
					$critique["idEditeur"]=$enr['idEditeur'];
					$critique["ISBN"]=$enr['ISBN'];
					$critique["collection"]=$enr['collection'];
					$critique["titreOuvrage"]=$enr['ouvrageTitre'];
					$critique["coordonnateur"]=$enr['coordonnateur'];
		//print_r($critique);
		/////
		$nom_editeur=AfficherNomEditeur($critique["idEditeur"]);
		$ville_editeur=AfficherVilleEditeur($critique["idEditeur"]);
		///
		echo "<li itemscope itemtype='http://schema.org/Chapter' itemid='".$url_site."/critiques/biblio_auteur.php?critique=".composition_signature($critique['idSignature'],$critique['typeSignature'],TRUE)."&idcritiquesignee=".$critique["id"]."'>";
		echo debut_COinS_chapitre($critique["ISBN"],urlencode($critique["titre"]." ".$critique["complement_titre"]),urlencode($critique["titreOuvrage"]),urlencode($critique["signature"]),urlencode($critique["nom"]),urlencode($critique["prenom"]),$critique["annee"],$numero,$critique["pagination"],urlencode($nom_editeur),urlencode($critique["coordonnateur"]));
		if($critique["idPseudonyme"]==NULL){
			composition_signature($critique['idSignature'],$critique['typeSignature']);
		}
		else afficher_pseudo($critique['idPseudonyme']);
		echo ", <q>".$critique['titre']." </q>";
		if($critique['complement_titre']!=''){
			echo ", ".$critique['complement_titre'];
		}
		//echo ", ".$critique['annee'];
		echo ", in ";
		if($critique["coordonnateur"]!=='' && $critique["coordonnateur"]!=NULL) echo ' '.$critique["coordonnateur"].", ";
		echo "<em>".$critique["titreOuvrage"]."</em>";
		if($critique["complement_titre_ouvrage"]!='' && $critique["complement_titre_ouvrage"] != NULL){
			echo " [".$critique["complement_titre_ouvrage"]."]";
		}
		if($critique['idEditeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($critique['idEditeur']);
			$ville_editeur=AfficherVilleEditeur($critique['idEditeur']);
			if($ville_editeur!='')echo ", ".$ville_editeur;
			if($nom_editeur!='')echo ", ".$nom_editeur;
		}
		if($critique['collection']!=''){ 
			echo ", coll. <q>".$critique['collection']."</q>";
		}
		if($critique["annee"]!=='' && $critique["annee"]!=NULL) echo ", ".$critique["annee"];
		if($critique["pagination"]!=='' && $critique["pagination"]!=NULL && $critique["pagination"]!='n.p.' && $critique["pagination"]!='n.r.') echo ", p. ".$critique["pagination"];
		echo fin_COinS();
		echo ".</li>";
	}
	/////
	echo "</ol>";
	//
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////

/////////////////////////////////////////////////////
////////// Monographies /////////////////////////////
/////////////////////////////////////////////////////
function les_monographies($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>monographie</mark></li>";
	$sql = "SELECT * FROM `VIEW_monographies` WHERE `idCritique` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND ouvrageComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['typeSignature']!=''){
		$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
	}
	if($_GET['auteur']!=''){
		$sql .= " AND idCritiqueDart=".$_GET['auteur'];
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['ouvrage']!=''){
		$sql .= " AND titre LIKE '%".urldecode(addslashes($_GET['ouvrage']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de la monographie est (ou contient la chaîne) <q><mark>".$_GET['ouvrage']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	//echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, titre";
	}
	//echo $sql;
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	$nb_monographies=$resultats->rowCount();
	echo "<h3 id='monographies'>Liste des monographies correspondantes (".$nb_monographies.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
	foreach ($resultats as $enr){
		// https://schema.org/Book
		// attributs : isbn, numberOfPages
		// extention de CreativeWork : author, creator, editor, datePublished, locationCreated, publisher, translator
		// extension de Thing : name
		$critique["id"]=$enr['idCritique'];
		$critique["idOuvrage"]=$enr['idOuvrage'];
		$critique["nom"]=$enr['nom'];
		$critique["prenom"]=$enr['prenom'];
		$critique["typeSignature"]=$enr["typeSignature"];
		$critique["idSignature"]=$enr["idSignature"];
		if($enr["typeSignature"]=='patronyme'){
				$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
		}
		$critique["titre"]=$enr['titre'];
		$critique["complement_titre"]=$enr['ouvrageComplementTitre'];
		$critique["annee"]=$enr['annee'];
		$critique["pagination"]=$enr['pagination'];
		$critique["idPseudonyme"]=$enr['idPseudo'];
		$critique["idEditeur"]=$enr['idEditeur'];
		$critique["ISBN"]=$enr['ISBN'];
		$critique["collection"]=$enr['collection'];
		//print_r($critique);
		/////
		$nom_editeur=AfficherNomEditeur($critique["idEditeur"]);
		$ville_editeur=AfficherVilleEditeur($critique["idEditeur"]);
		///
		echo "<li itemscope itemtype='http://schema.org/Book' itemid='".$url_site."/critiques/biblio_auteur.php?critique=".composition_signature($critique['idSignature'],$critique['typeSignature'],TRUE)."&idcritiquesignee=".$critique["id"]."#".$critique["id"]."'>";
		echo debut_COinS_monographie($critique["ISBN"],urlencode($critique["titre"]." ".$critique["complement_titre"]),urlencode($critique["signature"]),urlencode($ville_editeur),urlencode($nom_editeur),urlencode($critique["collection"]),urlencode($critique["prenom"]),urlencode($critique["nom"]),$critique["annee"],$critique["pagination"]);
		if($critique["idPseudonyme"]==NULL){
			print('<span itemprop="author">');
			composition_signature($critique['idSignature'],$critique['typeSignature']);
			print('</span>');
		}
		elseif($enr["typeSignature"]=='anonyme'){
			composition_signature($critique["idSignature"],$critique["typeSignature"]);
		}
		else afficher_pseudo($critique['idPseudonyme']);
		echo ", <em><span itemprop='name'>".$critique['titre']."</span></em>";
		if($critique['complement_titre']!=''){
			echo ", [<span itemprop='alternativeHeadline'>".$critique['complement_titre']."</span>]";
		}
		echo ", <span itemprop='datePublished'>".$critique['annee']."</span>";
		if($critique['idEditeur']!=''){ 
			$nom_editeur=AfficherNomEditeur($critique['idEditeur']);
			$ville_editeur=AfficherVilleEditeur($critique['idEditeur']);
			if($ville_editeur!='')echo ", <span itemprop='locationCreated'>".$ville_editeur."</span>";
			if($nom_editeur!='')echo ", <span itemprop='publisher'>".$nom_editeur."</span>";
		}
		if($critique['collection']!=''){ 
			echo ", coll. <span itemprop='isPartOf'>";
			echo "<q itemscope itemtype='http://bib.schema.org/Collection'>";
			echo "<span itemprop='name'>".$critique['collection']."</span>";
			echo "</q>";
			echo "</span>";
		}
		echo fin_COinS();
		echo ".</li>";
	}
	/////
	echo "</ol>";
}
/////////////////////////////////////////////////////
///////////// Articles //////////////////////////////
/////////////////////////////////////////////////////
function les_articles($verbose){
	global $pdo;
	$rappel="<li>La critique est un article de revue</li>";
	$sql = "SELECT * FROM `VIEW_articles` WHERE `idCritique` IS NOT NULL";
	//$sql = "SELECT * FROM `view_articles` WHERE `idCritique` IS NOT NULL";
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (critiqueComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titreCritique LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
		 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titreCritique LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	//
	if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
		 $sql .= " AND critiqueComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
		 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
	}
	//
	if($_GET['typeSignature']!=''){
		$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
		$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
	}
	if($_GET['auteur']!=''){
		$sql .= " AND idCritiqueDart=".$_GET['auteur'];
		$rappel.="<li>L'auteur (ou un des auteurs) est <mark>".getAuteurPrenomNomById($_GET['auteur'])."</mark>.</li>";
	}
	if($_GET['revue']!=''){
		$sql .= " AND revue LIKE '%".urldecode(addslashes($_GET['revue']))."%'";
		//$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".urldecode($_GET['revue'])."</mark></q>.</li>";
		$rappel.="<li>Le nom de la revue est (ou contient la chaîne) <q><mark>".$_GET['revue']."</mark></q>.</li>";
	}
	if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
		$sql .= " AND annee >=".$_GET['anneeEditionMin'];
		$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
	}
	if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
		$sql .= " AND annee <=".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	 //echo $sql;
	if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']!=NULL){
		$sql .= " AND annee BETWEEN ".$_GET['anneeEditionMin']." AND ".$_GET['anneeEditionMax'];
		$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
	}
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by annee, datePrecise, pagination";
	}
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	$resultats=$pdo->query($sql) or die('erreur SQL');
	$nb_articles=$resultats->rowCount();
	$lien_JSON="<a href='API/json_encode_article.php?Titre_SousTitre=".$_GET['Titre_SousTitre']."&choix=".$_GET['choix'];
	$lien_JSON.="&auteur=".$_GET['auteur']."&type=".$_GET['type']."&typeSignature=".$_GET['typeSignature']."&pseudonyme=".$_GET['pseudonyme'];
	$lien_JSON.="&anneeEditionMin=".$_GET['anneeEditionMin']."&anneeEditionMax=".$_GET['anneeEditionMax']."&typeCritique=".$_GET['typeCritique'];
	$lien_JSON.="&revue=".$_GET['revue']."&ouvrage=' onclick='window.open(this.href); return false;'>";
	$lien_JSON.="<img src='https://upload.wikimedia.org/wikipedia/commons/c/c9/JSON_vector_logo.svg'";
	$lien_JSON.="alt='au format JSON' heigth='20' width='20' title='Logo JSON'/> Exporter les articles présentés au format JSON</a>";
	echo "<h3 id='articles'>Liste des articles de périodiques correspondants (".$nb_articles.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
				//$resultats=$pdo->query($sql) or die('erreur SQL');
				
				foreach ($resultats as $enr){
					$critique["ISSN"]=$enr['ISSN'];
					$critique["id"]=$enr['idCritique'];
					$critique["nom"]=$enr['nom'];
					$critique["prenom"]=$enr['prenom'];
					$critique["typeSignature"]=$enr["typeSignature"];
					$critique["idSignature"]=$enr["idSignature"];
					if($enr["typeSignature"]=='patronyme'){
						$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
					}
					$critique["titre"]=$enr['titreCritique'];
					$critique["complement_titre"]=$enr['critiqueComplementTitre'];
					$critique["revue"]=$enr['revue'];
					$critique["annee"]=$enr['annee'];
					$critique["date"]=$enr['datePrecise'];
					$critique["volume"]=$enr['volume'];
					$critique["numero"]=$enr['numero'];
					$critique["pagination"]=$enr['pagination'];
					$critique["idPseudonyme"]=$enr['idPseudonyme'];
					$critique["complementTitreNumero"]=$enr['complementTitreNumero'];
					$critique["annee"]=$enr['annee'];
					echo "<li itemscope itemtype='http://schema.org/ScholarlyArticle' itemid='".$url_site."/critiques/biblio_auteur.php?critique=".composition_signature($critique['idSignature'],$critique['typeSignature'],TRUE)."&idcritiquesignee=".$critique["id"]."#".$critique["id"]."'>";
					echo debut_COinS_article($critique["ISSN"],urlencode($critique["titre"]),urlencode($critique["revue"]),urlencode($critique["signature"]),urlencode($critique["nom"]),urlencode($critique["prenom"]),$critique["date"],$critique["annee"],$critique["volume"],$critique["numero"],$critique["pagination"]);
					echo fin_COinS();
					print('<span itemprop="author">');
					if($critique['idPseudonyme']!=NULL){
						composition_signature($critique["idSignature"],$critique["typeSignature"]);
					}
					elseif($critique['idPseudonyme']==NULL){
						composition_signature($critique["idSignature"],$critique["typeSignature"]);
					}
					elseif($enr["typeSignature"]=='anonyme'){
						composition_signature($critique["idSignature"],$critique["typeSignature"]);
					}
					if($critique['idPseudonyme']!=NULL){
						afficher_pseudo($critique['idPseudonyme']);
					}
					print('</span>');
					echo ", <q>";
					print('<span itemprop="name">');
					echo $critique["titre"];
					echo "</span>";
					echo "</q>";
					if($critique["complement_titre"]!='')echo ", ".$critique["complement_titre"];
					echo ", ";
					print('<em itemprop="headline">');
					echo $critique["revue"];
					print('</em>');
					print('<span itemprop="isPartOf" itemscope itemtype="http://schema.org/PublicationIssue" itemid="#issue">');
						if($critique["volume"]!='') echo ", ".$critique["volume"];
						if($critique['numero']!='' && $critique['numero'] != NULL) echo ", n° ".$critique['numero'];
						if($critique['complementTitreNumero']!='' && $critique['complementTitreNumero']!=NULL)echo ", ".$critique['complementTitreNumero'];
						if($critique['date']!=''){ 
							echo ", ";
							print('<time itemprop="datePublished" datetime="');
							echo $critique['date'];
							print('">');
							echo date_fr($critique['date']);
							print('</time>');
						}
						elseif($critique['complementTitreNumero']!=''){
							echo " ".$critique['annee'];
						}
						else{
							echo ", ".$critique['annee'];
						}
					print('</span>');
					if($critique["pagination"] != ('' || NULL ) AND $critique["pagination"] != 'n.p.' AND $critique["pagination"] != 'n.r.') {
								echo ", p. ";
								print('<span itemprop="pagination">');
								echo $critique["pagination"];
								print('</span>');
					}
					echo ".";
					echo "</li>";
				}
	
	echo "</ol>";
	if($nb_articles==0){
		//echo "Pas de résulat.";
	}
	else{
		if($verbose===TRUE){
			echo "<div align='right'>";
			echo $lien_JSON;
			echo "</div>";
		}
	}
}
////////////////////////////////////////////////////////
		
		echo "<h2 id='ancre' class='std__title'>
				Résultats de la recherche</h2>";
switch ($_GET['typeCritique']) {
    case 'article':
	// Préparer les liens de réagencement
		$lien_agencer_nom_article="<a href='avance.php?Titre_SousTitre=".$_GET['Titre_SousTitre']."&choix=".$_GET['choix'];
		$lien_agencer_nom_article.="&auteur=".$_GET['auteur']."&type=".$_GET['type']."&typeSignature=".$_GET['typeSignature']."&pseudonyme=".$_GET['pseudonyme'];
		$lien_agencer_nom_article.="&anneeEditionMin=".$_GET['anneeEditionMin']."&anneeEditionMax=".$_GET['anneeEditionMax']."&typeCritique=".$_GET['typeCritique'];
		$lien_agencer_nom_article.="&revue=".urlencode(urldecode($_GET['revue']))."&ouvrage=&orderBy=nom,%20annee,%20datePrecise,%20pagination'> auteur</a>";
		$lien_agencer_revue_article="<a href='avance.php?Titre_SousTitre=".$_GET['Titre_SousTitre']."&choix=".$_GET['choix'];
		$lien_agencer_revue_article.="&auteur=".$_GET['auteur']."&type=".$_GET['type']."&typeSignature=".$_GET['typeSignature']."&pseudonyme=".$_GET['pseudonyme'];
		$lien_agencer_revue_article.="&anneeEditionMin=".$_GET['anneeEditionMin']."&anneeEditionMax=".$_GET['anneeEditionMax']."&typeCritique=".$_GET['typeCritique'];
		$lien_agencer_revue_article.="&revue=".urlencode($_GET['revue'])."&ouvrage=&orderBy=revue,%20annee,%20datePrecise,%20pagination'> revue</a>";
		$lien_agencer_date_article="<a href='avance.php?Titre_SousTitre=".$_GET['Titre_SousTitre']."&choix=".$_GET['choix'];
		$lien_agencer_date_article.="&auteur=".$_GET['auteur']."&type=".$_GET['type']."&typeSignature=".$_GET['typeSignature']."&pseudonyme=".$_GET['pseudonyme'];
		$lien_agencer_date_article.="&anneeEditionMin=".$_GET['anneeEditionMin']."&anneeEditionMax=".$_GET['anneeEditionMax']."&typeCritique=".$_GET['typeCritique'];
		$lien_agencer_date_article.="&revue=".urlencode(urldecode($_GET['revue']))."&ouvrage=&orderBy=%20annee,%20datePrecise,%20pagination#navbar'> date</a>";
        //echo 'les articles';
		echo "<div id='navigation' align='right'>";
		echo "<u>ordonner par :</u> <br /> $lien_agencer_nom_article, $lien_agencer_revue_article, $lien_agencer_date_article </div>";
		les_articles(TRUE);
	break;
	case 'monographie':
		les_monographies(TRUE);
	break;
	case 'chapitre':
		//print_r($_GET);
		les_chapitres(TRUE);
	break;
		case 'preface':
		//print_r($_GET);
		les_prefaces(TRUE);
	break;
	case 'postface':
		//print_r($_GET);
		les_postfaces(TRUE);
	break;
	case 'direction':
		//print_r($_GET);
		les_coordinations(TRUE);
	break;
	case 'introduction':
		les_introductions(TRUE);
	break;
    default:
       //echo 'générique';
	   if($_GET['auteur']!='' || $_GET['anneeEditionMax']!='' || $_GET['anneeEditionMin']!='' || $_GET['Titre_SousTitre']!='' || $_GET['typeSignature']!='' || $_GET['revue']!=''){
		   echo "<p id='navigation' align ='right'>
		   <a href='#articles' title='Aller directement aux articles'>Articles</a>, 
		   <a href='#chapitres' title='Aller directement aux chapitres'>chapitres</a>,
		   <a href='#monographies' title='Aller directement aux monographies'>ouvrages</a>,
		   <a href='#prefaces' title='Aller directement aux préfaces'>préfaces</a>,
		   <a href='#postfaces' title='Aller directement aux postfaces'>postfaces</a>,
		   <a href='#coordinations' title='Aller directement aux coordinations d&rsquo;ouvrages'>coordinations</a>,
		   <a href='#introductions' title='Aller directement aux introductions'>introductions</a>
		   </p>";
		   //
			if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre_et_titre'){
				 $rappel.='<li>Le titre ou le complément de titre de critique contiennent la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
			}
			if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_titre'){
				 $rappel.='<li>Le titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
			}
			if($_GET['Titre_SousTitre']!='' && $_GET['choix']=='choix_sous_titre'){
				 $rappel.='<li>Le complément de titre de critique contient la chaîne suivante : <q><mark>'.$_GET['Titre_SousTitre'].'</mark></q>.</li>';
			}
			if($_GET['typeSignature']!=''){
				$rappel.='<li>La critique doit être signée sous forme de <mark>'.$_GET['typeSignature'].'</mark>.</li>';
			}
			if($_GET['anneeEditionMin']!=NULL && ($_GET['anneeEditionMax']==NULL || $_GET['anneeEditionMax']=='')){
				$rappel.="<li>La période de recherche est postérieure à <mark>".$_GET['anneeEditionMin']."</mark>.</li>";
			}
			if($_GET['anneeEditionMax']!=NULL && ($_GET['anneeEditionMin']==NULL || $_GET['anneeEditionMin']=='')){
				$rappel.="<li>La période de recherche est antérieure à <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
			}
			if($_GET['anneeEditionMax']!=NULL && $_GET['anneeEditionMin']){
				$rappel.="<li>La période de recherche est comprise entre <mark>".$_GET['anneeEditionMin']."</mark> et <mark>".$_GET['anneeEditionMax']."</mark>.</li>";
			}
	//echo $sql;
	if($rappel!=''){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
		   //
		   les_articles(FALSE);
		   les_chapitres(FALSE);
		   les_monographies(FALSE);
		   les_prefaces(FALSE);
		   les_postfaces(FALSE);
		   les_coordinations(FALSE);
		   les_introductions(FALSE);
	   }
	   else{
		   echo "<p>Veuillez recommencer en spécifiant davantage votre recherche.</p>";
		}
	   
	break;
	   //les_articles();
	   
} 
	echo "<p align='right'><a href='rechercher.php?opt=avance'>Recommencer la recherche.</a>  <a href='#navigation' title='remonter'>&uarr;</a></p>";
//if (get_magic_quotes_gpc()) {echo "activé";}
//else {echo "desactivé";}
		///
		echo $fin_article;
		echo $fin_main;
		echo $footer;
		echo $fin_container;
		
		?>