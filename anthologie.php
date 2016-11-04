<?php
		session_start();
		include 'config.php';
		include 'lib_fonctions.php';
		include 'html_habillage.php';
		if(isset($_GET['critique'])&&$_GET['critique']!=''){
			$url_auteur=getAuteurURL_ById($_GET['critique']);
			$sous_titre = file_get_contents('critiques/'.$url_auteur.'/sous_titre.txt');
			//or die("Le fichier ".'critiques/'.$url_auteur.'/sous_titre.txt'." ne peut être chargé, il est soit absent soit corrompu.");
			$bio = file_get_contents('critiques/'.$url_auteur.'/resume.txt');
			// or die("Le fichier de biographie bio.txt ne peut être chargé, il est soit absent soit corrompu.");
			$fichier_specialistes = fopen("critiques/".$url_auteur."/specialistes.csv", "r");
			// or die("Le fichier des spéccialistes ne peut être chargé, il est soit absent soit corrompu.");
			$auteurs_de_la_page_critique=array();
			while ($ligne = fgetcsv($fichier_specialistes, 1024, ",")){
				array_push($auteurs_de_la_page_critique, $ligne);
				
			}
			foreach($auteurs_de_la_page_critique as $specialiste){
				if(!strcmp($specialiste[8],'editeur')){
					$auteur_principal.=$specialiste[2];
					$auteur_principal.=", ";
					$auteur_principal.=$specialiste[1];
				}
			}
			if($auteur_principal=='')$auteur_principal.="Projet BCAF";
			
			//afficher_entete_avec_meta($titre,$auteur,$critique,$description,$mots_cles,$date,$lieu,$rattachement,$type,$url)
			afficher_entete_avec_meta('Notice bibliographique de '.getAuteurPrenomNomById($_GET['critique']),$auteur_principal,getAuteurPrenomNomById($_GET['critique']),$bio,getAuteurPrenomNomById($_GET['critique']),date('Y-m-d'),'Paris','Université Paris 1 Panthéon-Sorbonne, UFR 03','Web page',getAuteurURL_ById($_GET['critique']),'');
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
		$url_auteur=getAuteurURL_ById($_GET['critique']);
		echo "
		 	<article class='std'>
			<h2 class='std__title'>";
				echo " ";
				afficherAuteurByIdModeBiblio($_GET['critique']);
				//echo $auteur_principal;
		echo "</h2>";
		echo "<h3>".$sous_titre."</h3><br />";
		afficher_pseudos_by_id_critiqueDart($_GET['critique']);
//echo $url_auteur;

echo "<h4>Bibliographies</h4><p><ul>";
echo "<li>Bibliographie primaire <a href='critiques/".$url_auteur."/primaire.pdf'>";
echo "<img src='images/pdf.jpg' height='20' width='20' title='pour afficher le pdf cliquer sur le lien, pour télécharger le pdf click droit et enregister sous' alt='logo PDF'></a></li>";
echo "<li>Bibliographie secondaire <a href='critiques/".$url_auteur."/secondaire.pdf'>";
echo "<img src='images/pdf.jpg' height='20' width='20' title='pour afficher le pdf cliquer sur le lien, pour télécharger le pdf click droit et enregister sous' alt='logo PDF'></a></li>";
echo "<li>Sources d'archives identifiées <a href='critiques/".$url_auteur."/archives.pdf'>";
echo "<img src='images/pdf.jpg' height='20' width='20' title='pour afficher le pdf cliquer sur le lien, pour télécharger le pdf click droit et enregister sous' alt='logo PDF'></a></li></ul></p>";

/*
echo "<h4>Éléments de biographie</h4>";
echo "<p align=\"justify\">".$bio."</p>";
$anthologie=array();
*/

$fichier = fopen("critiques/".$url_auteur."/biblio.csv", "r");
if($fichier!=NULL){
	echo "<h4>Principales collaborations</h4>";
	$lesCollaborations=array();
	// or die("Le fichier ne peut être chargé, il est soit absent soit corrompu.");
	while ($ligne = fgetcsv($fichier, 1024, ",")){
		array_push($lesCollaborations, $ligne);
	}
	echo "<p><ul>";
	foreach($lesCollaborations as $critique){
		$url_collaboration="avance.php?auteur=".$_GET['critique']."&typeCritique=article&revue=".urlencode($critique[0]);
		if ($critique[1]!=''){
			//$url_collaboration.="&Titre_SousTitre=".urlencode($critique[1])."&choix=".urlencode('choix_sous_titre_et_titre');
		}
		echo "<li><a href='".$url_collaboration."' title='afficher les articles issus de la collaboration'><em>".$critique[0]. "</em></a>, ";
		if ($critique[1]!=''){
			echo "<q> ".$critique[1]." </q>, ";
			$url_collaboration+="?Titre_SousTitre=".urlencode($critique[1]);
		}
		echo "(".$critique[2].")";
		echo ".</li>";
	}
	echo "</ul></p>";
	//echo "Date : ".date('Y-m-d');
}
$biblio_secondaire=array();
$fichier2 = fopen("critiques/".$url_auteur."/secondaire.csv", "r");
//or die("ne peut charger.");
if($fichier2!=NULL){
	echo "<h4>Principales notices bibliographiques et ouvrages de référence</h4>";
	while ($ligne = fgetcsv($fichier2, 1024, ",")){
		array_push($biblio_secondaire, $ligne);
	}
	//print_r($anthologie);
	echo "<p><ul>";
	foreach($biblio_secondaire as $critique){
		//print_r($critique);
		echo "<li><span>".$critique[0];
		//, &laquo; ".$critique[3]." &raquo; (".$critique[1].")";
		// Test sur 
		if($critique[8]=="Article"){
			echo ", <q>".$critique[1]."</q>, ";
			if($critique[2]!='')echo " ".$critique[2].", ";
			echo "<em>".$critique[3]."</em>";
		}
		if($critique[8]=="Ouvrage")echo ", <em>".$critique[3]."</em>";
		// Test la ville et éditeur et collection
		if($critique[4]!="")echo ", ".$critique[4];
		if($critique[5]!="")echo ", ".$critique[5];
		if($critique[6])echo ", ".$critique[6];
		if($critique[7])echo ", ".$critique[7];
		if($critique[9]!=''){
			echo ", <a href='$critique[9]' target='new'>$critique[9]</a>";
			if($critique[10]=="pdf"){
				echo "<img src='images/pdf.jpg' height='20' width='20' title='pour afficher le pdf cliquer sur le lien, pour télécharger le pdf click droit et enregister sous' alt='logo PDF'>";
			}
		}
		echo "</span>.</li>";
	}
	echo "</ul></p>";
}

$fichier3 = fopen("critiques/".$url_auteur."/sites.csv", "r");
if($fichier3 !=NULL){
	echo "<h4>Webographie</h4>";
	$sitographie=array();
	echo "<p><ul>";
	while ($ligne = fgetcsv($fichier3, 1024, ",")){
		array_push($sitographie, $ligne);
	}
	foreach($sitographie as $site){
		//print_r($site);
		echo "<li><span>".$site[0];
		if($site[1]!='') echo ", &laquo; ".$site[1]." &raquo;";
		if($site[2]!='') echo ", hébergé par ".$site[2];
		echo ", <a href='".$site[3]."' target='new'>";
		echo $site[3];
		echo "</a>.";
	}
	echo "</ul></p>";
}
/*
echo "<h4>Travaux de recherche téléchargeables</h4>";
echo "<p><ul><li><a href='";
echo "critiques/".$url_auteur."/travaux-de-recherche";
echo "'>";
echo "Les travaux universitaires portant sur le critique";
echo "</a></li></ul></p>";
echo "<p align='right'>";
echo "<a href='";
				echo 'critiques/'.$url_auteur.'/bibliographie.pdf';
				echo "' target='_blank'>Télécharger cette fiche au format PDF</a>";
echo "</p>";
*/
}
else {
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
		echo "<p>Il faut choisir un critique dans l'onglet <em>Critiques</em></p>";
}
    echo $fin_article;
	echo $fin_main;
	echo $footer;
	echo $fin_container;
?>