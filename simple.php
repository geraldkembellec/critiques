<?php
		session_start();
		
		$totalHits = 0;
		
		include 'config.php';
		include 'lib_fonctions.php';
		include 'html_habillage.php';
		echo $entete;
		echo $debut_container;
		echo $debut_header;
		if(isset($_SESSION['user'])){
			echo "<a href=\"unconnect.php\" class=\"icon-deconnect\" title=\"Se déconnecter\"></a></div>";
		} else {
			echo "<a href=\"connectV2.php\" class=\"icon-person\" title=\"S’identifier\"></a></div>";
		}
		milieu_header();
	    echo $fin_header;
		echo $debut_article;
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////	
function les_introductions_simple($verbose){
	global $pdo;	
	$sql2="SELECT *  FROM `VIEW_introductions` WHERE `nom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `collection` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `titre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `ouvrageTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `ouvrageComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `coordonnateur` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `nom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `prenom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `critiqueComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `ISBN` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql2 .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql2 .= " ORDER by annee, titre";
	}
	//echo $sql2;
	$resultats=$pdo->query($sql2) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	
	global $totalHits;
	$nb_introductions=$resultats->rowCount();
	$totalHits += $nb_introductions;
	
	if($nb_introductions > 0) {
		echo "<h3 id='introductions'>Introductions (".$nb_introductions.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
		
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
		
		echo "</ol>";
	}
}
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function les_coordinations_simple($verbose){
	global $pdo;	
	$rappel="<li>Vous cherchez une <mark>direction d'ouvrage</mark></li>";
	$sql2="SELECT *  FROM `VIEW_coordinations_ouvrages` WHERE `coordonnateur` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `collection` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `ISBN_10` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `titre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql2.=" OR `complement_titre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql2 .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql2 .= " ORDER by annee, titre";
	}
	//echo $sql2;
	$resultats=$pdo->query($sql2) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	
	global $totalHits;
	$nb_coordinations=$resultats->rowCount();
	$totalHits += $nb_coordinations;
	
	if($nb_coordinations > 0) {
		echo "<h3 id='coordinations'>Coordinations d'ouvrages (".$nb_coordinations.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
		foreach ($resultats as $r){
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
}
/////////////////////////////////////////////////////
//////////////////  Les Postfaces   /////////////////
/////////////////////////////////////////////////////	
function les_postfaces($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>postface</mark></li>";
	$sql = "SELECT * FROM `VIEW_postfaces` WHERE ";
	$sql .= " ouvrageComplementTitre LIKE '%".addslashes($_GET['quicksearch'])."%' ";
	$sql .= "OR titre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `ouvrageTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `ouvrageComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `nom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `prenom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `critiqueComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `ISBN` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `collection` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " ORDER by annee, titre";
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	
	global $totalHits;
	$nb_chapitres=$resultats->rowCount();
	$totalHits += $nb_chapitres;
	
	if($nb_chapitres > 0) {
		echo "<h3 id='postfaces'>Postfaces (".$nb_chapitres.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
		
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
			echo fin_COinS();
			echo ".</li>";
		}
		
		echo "</ol>";
	}
}

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
function les_prefaces($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>préface</mark></li>";
	$sql = "SELECT * FROM `VIEW_prefaces` WHERE ";
	$sql .= " ouvrageComplementTitre LIKE '%".addslashes($_GET['quicksearch'])."%' ";
	$sql .= "OR titre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `ouvrageTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `ouvrageComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `nom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `prenom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `critiqueComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `ISBN` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR `collection` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " ORDER by annee, titre";
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	
	global $totalHits;
	$nb_prefaces=$resultats->rowCount();
	$totalHits += $nb_prefaces;
	
	if($nb_prefaces > 0) {
		echo "<h3 id='prefaces'>Préfaces (".$nb_prefaces.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
		
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
		
		echo "</ol>";
	}
}

/////////////////////////////////////////////////////
///////////////// Chapitres /////////////////////////
/////////////////////////////////////////////////////
function les_chapitres_simple($verbose){
	global $pdo;	
	$sql = "SELECT * FROM `VIEW_chapitres` WHERE ouvrageComplementTitre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR titre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `ouvrageTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `ouvrageComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `nom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `prenom` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `critiqueComplementTitre` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `ISBN` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .=" OR `collection` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	//$sql .=" OR `idEditeur` LIKE '%".addslashes($_GET['quicksearch'])."%'";
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
	
	global $totalHits;
	$nb_chapitres=$resultats->rowCount();
	$totalHits += $nb_chapitres;
	
	if($nb_chapitres > 0) {
		echo "<h3 id='chapitres'>Collaborations à des ouvrages collectifs (".$nb_chapitres.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
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
}

/////////////////////////////////////////////////////
////////// Monographies /////////////////////////////
/////////////////////////////////////////////////////
function les_monographies($verbose){
	global $pdo;	
	$rappel="<li>La critique est une <mark>monographie</mark></li>";
	$sql = "SELECT * FROM `VIEW_monographies` WHERE ";
	$sql .= " ouvrageComplementTitre LIKE '%".addslashes($_GET['quicksearch'])."%' OR titre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR titre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR ouvrageComplementTitre LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " ORDER by annee, titre";
	//echo $sql;
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	//$resultats=$pdo->query($sql) or die(mysql_errno() . " " . mysql_error());
	
	global $totalHits;
	$nb_monographies=$resultats->rowCount();
	$totalHits += $nb_monographies;
	
	if($nb_monographies > 0) {
		echo "<h3 id='monographies'>Ouvrages et ouvrages traduits (".$nb_monographies.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
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
			echo ", <span itemprop='datePublished'>".$critique['annee']."</span>";
			
			echo fin_COinS();
			echo ".</li>";
		}
		
		echo "</ol>";
	}
}
/////////////////////////////////////////////////////
///////////// Articles //////////////////////////////
/////////////////////////////////////////////////////
function les_articles_simple($verbose){
	global $pdo;
	$sql = "SELECT * FROM `VIEW_articles` WHERE `titreCritique` LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR (critiqueComplementTitre LIKE '%".addslashes($_GET['quicksearch'])."%' OR titreCritique LIKE '%".addslashes($_GET['quicksearch'])."%')";
	$sql .= " OR ISSN LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR nom LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR prenom LIKE '%".addslashes($_GET['quicksearch'])."%'";
	$sql .= " OR revue LIKE '%".urldecode(addslashes($_GET['quicksearch']))."%'";
	if($_GET['orderBy']!=NULL && $_GET['orderBy']!=''){
		$sql .= " ORDER by ".$_GET['orderBy'];
	}
	else{
		$sql .= " ORDER by nom, prenom, annee, datePrecise, revue, pagination";
	}
	if($rappel!='' && $verbose===TRUE){
		echo "<h3>Rappel de la requête</h3><ol>".$rappel."</ol>";
	}
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	
	global $totalHits;
	$nb_articles=$resultats->rowCount();
	$totalHits += $nb_articles;
	
	$lien_JSON="<a href='API/json_encode_article.php?Titre_SousTitre=".$_GET['Titre_SousTitre']."&choix=".$_GET['choix'];
	$lien_JSON.="&auteur=".$_GET['auteur']."&type=".$_GET['type']."&typeSignature=".$_GET['typeSignature']."&pseudonyme=".$_GET['pseudonyme'];
	$lien_JSON.="&anneeEditionMin=".$_GET['anneeEditionMin']."&anneeEditionMax=".$_GET['anneeEditionMax']."&typeCritique=".$_GET['typeCritique'];
	$lien_JSON.="&revue=".$_GET['revue']."&ouvrage=' onclick='window.open(this.href); return false;'>";
	$lien_JSON.="<img src='https://upload.wikimedia.org/wikipedia/commons/c/c9/JSON_vector_logo.svg'";
	$lien_JSON.="alt='au format JSON' heigth='20' width='20' title='Logo JSON'/> Exporter les articles présentés au format JSON</a>";
	
	if($nb_articles > 0) {
		echo "<h3 id='articles'>Articles (".$nb_articles.") <a href='#navigation' title='remonter'>&uarr;</a></h3><ol>";
		//$resultats=$pdo->query($sql) or die('erreur SQL');
		foreach ($resultats as $enr){
			$critique["ISSN"]=$enr['ISSN'];
			$critique["id"]=$enr['idCritique'];
			$critique["nom"]=$enr['nom'];
			$critique["prenom"]=$enr['prenom'];
			$critique["typeSignature"]=$enr["typeSignature"];
			$critique["idSignature"]=$enr["idSignature"];
			if($enr["typeSignature"]=='patronyme'){$critique["signature"]=$enr['nom'].' '.$enr['prenom'];}
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
		
		if($verbose===TRUE){
			echo "<div align='right'>";
			echo $lien_JSON;
			echo "</div>";
		}
	}
}
////////////////////////////////////////////////////////
	//echo 'générique';
   if($_GET['quicksearch']!=''){
	   echo "<h2 id='ancre' class='std__title'>
			Résultats de la recherche</h2>
	   <p>Votre requête porte sur le terme : <q><mark>". $_GET['quicksearch']."</mark></q>";
	   // Penser à tester les éditeurs
	   global $editeur;
	   $editeur=rechercher_editeur_id($_GET['quicksearch']);
	   if($editeur != NULL && strlen($_GET['quicksearch'])>=4){
		   echo ", et peut correspondre à l'éditeur <q>";
		   echo AfficherNomEditeur($editeur);
		   echo "</q>";
	   }
	   echo ".</p>";
	   echo "<p id='navigation' align ='right'>
			<a href='#monographies' title='Aller directement aux monographies' style='color: #1f398f;'>Ouvrages</a>,
			<a href='#coordinations' title='Aller directement aux coordinations d&rsquo;ouvrages' style='color: #1f398f;'>coordinations</a>,
			<a href='#chapitres' title='Aller directement aux chapitres' style='color: #1f398f;'>collaborations</a>,
	   		<a href='#introductions' title='Aller directement aux introductions' style='color: #1f398f;'>introductions</a>,
			<a href='#prefaces' title='Aller directement aux préfaces' style='color: #1f398f;'>préfaces</a>,
			<a href='#postfaces' title='Aller directement aux postfaces' style='color: #1f398f;'>postfaces</a>,
			<a href='#articles' title='Aller directement aux articles' style='color: #1f398f;'>articles</a>
	   </p>";
	   
	   // Penser à tester les alias
	   les_monographies(FALSE);
	   les_coordinations_simple(FALSE);
	   les_chapitres_simple(FALSE);
	   les_introductions_simple(FALSE);
	   les_prefaces(FALSE);
	   les_postfaces(FALSE);
	   les_articles_simple(FALSE);
   }
   else{
	   echo "<h2 id='ancre' class='std__title'>
			Pas de résultats</h2>";
	   echo "<p>Veuillez recommencer en spécifiant davantage votre recherche.</p>";
	}
	   
	//break;
	//les_articles();
	echo "<p align='right'><b>Nombre de références : $totalHits</b></p>";
	echo "<p align='right'><b><a href='rechercher.php' style='color: #1f398f'>Recommencer la recherche.</a><a href='#navigation' title='remonter'>&uarr;</a></b></p>";
	//if (get_magic_quotes_gpc()) {echo "activé";}
	//else {echo "desactivé";}
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
