<?php
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
	echo $debut_article;
	echo $debut_liste;
	$resultat=listerAuteurs();
	echo $resultat;
	echo $fin_liste;
	if(isset($_GET['lettre'])){
		print('<h3>'.$_GET['lettre'].' / <a href="annuaire_critiques.php">afficher tous les auteurs</a></h3><hr class="listing-redline">');
		afficherAuteursParLettre($_GET['lettre']);
	} else {
		print('<h3>Tous les auteurs</h3><hr class="listing-redline">');
		afficherTousLesAuteurs();
	}
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>