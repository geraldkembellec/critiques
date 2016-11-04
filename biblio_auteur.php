<?php
	error_reporting (0);
	
	session_start();
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
	if(!isset($_GET['critique'])){echo "Il faut choisir un critique";}
	echo "
	 	<article class='std'>
		<h2 class='std__title'>
			Bibliographie de ";
			afficherAuteurByIdModeBiblio($_GET['critique'],'date');
	echo "</h2>";
	echo "<h3>Liste des monographies</h3><ol>";
		listeCritiquesAuteurMonographies($_GET['critique'],$_GET['idcritiquesignee']);
	echo "</ol>";
	echo "<h3>Liste des collaborations à des ouvrages collectifs</h3><ol>";
		listeCritiquesAuteurParticipationOuvrage($_GET['critique'],$_GET['idcritiquesignee']);
	echo "</ol>";
	echo "<h3>Liste des articles de périodiques</h3><ol>";
		listeCritiquesAuteurArticles($_GET['critique'],$_GET['idcritiquesignee']);
	echo "</ol>";
	echo "<h3>Liste des introductions, préfaces ou postfaces d'ouvrages</h3><ol>";
		listePrefacesPostfaces($_GET['critique'],$_GET['idcritiquesignee']);
	echo "</ol>";
		$auteur_mode_biblio=getAuteurByIdModeBiblio($_GET['critique']);
		afficher_coordination($auteur_mode_biblio);
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>