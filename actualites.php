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
?>

<div style="width: 710px; float: left;">
	<h2 class="std__title" style="margin-top: 0; font-size: 25.5px;">Actualités</h2>
	
	<h3 class="titre_actualites">Journée inaugurale</h3>
	<h4>3 février 2017</h4>
	<p class="paragraphe" align="justify">
		Une journée inaugurale est prévue le vendredi 3 février 2017 ; ce sera l’occasion de présenter le programme de recherche de manière concrète au public et à la communauté scientifique. 
	</p>
	
	<h3 class="titre_actualites">Colloque international</h3>
	<h4>18 et 19 mai 2017</h4>
	<p class="paragraphe" align="justify">
		Un colloque international avec appel à communication pourra les 18 et 19 mai 2017, proposer les premiers résultats liés à l’exploitation du site et de la base pour de nouveaux travaux. 
		Il ne s’agira plus alors de faire le point sur l’existant, mais bien de s’interroger sur de nouvelles perspectives de recherche. Intitulé « Une nouvelle histoire de la critique d’art à la lumière des humanités numériques ? », il permettra de questionner à la fois les attendus théoriques et les résultats pratiques du site selon quatre grands axes : faire carrière, masse critique, nouveaux corpus et au-delà de la critique d’art. 
	</p>
	<p class="paragraphe" align="justify">
		Plus qu’un simple outil documentaire, le site permet de revoir en profondeur la manière d’aborder la critique d’art et les critiques d’art. 
		Non discriminant, puisqu’il ne prévoit pas de typologie ou de classement autre que le support de diffusion du texte (article, ouvrage ou chapitre d’ouvrage), interdisciplinaire, il met de côté l’appréciation de la valeur critique du texte - éminemment subjective - au profit d’une vision d’ensemble de la production littéraire des auteurs concernés, quel que soit le champ artistique sur lequel leur regard s’est porté (photographie, cinéma, beaux-arts, architecture, etc.). 
		Il permet ainsi une approche renouvelée à la fois de la production critique de chaque auteur - aucun texte ne prenant le pas sur un autre - et sur la critique d’art en général dont le champ se voit élargi à une grande diversité à la fois d’objets et de supports. Ce sont ces renouvellements, qui sont également des questionnements théoriques, que le colloque se propose d’aborder.
	</p>
</div>

<div style="width: 360px; float: right;">
	<h3 class="std__title"style="margin-top: 3px;">Evénements passés</h3>
	<h3 class="titre_actualites" style="font-size: 15px;">Journée d’études</h3>
	<h4 style="font-size: 13px;"> 25 juin 2015</h4>
	<p class="paragraphe" align="justify" style="font-size: 13px;">
		Une première journée d’études a été organisée le 25 juin 2015 ; elle proposait un état des lieux de la recherche sur la critique durant la IIIe République ainsi qu’une réflexion sur les implications d’un tel site à la fois interdisciplinaire et monographique ; 
		l’accent a été mis sur la critique des arts dits mineurs (photographie, cinéma, arts décoratifs), et sur la diversité nécessaire des approches scientifiques de cet objet, à la croisée des études littéraires, historiques et artistiques.
	</p>
</div>

<?php
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
