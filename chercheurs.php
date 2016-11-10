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

<p align="justify" class="paragraphe" style="margin-top:0;">
	L’annuaire des chercheurs répertorie les coordonnées des chercheurs ayant collaboré au programme de recherche par la mise à disposition de leur bibliographie, l’édition d’une ou plusieurs pages consacrées à un auteur ou par une expertise scientifique.
	Nous tenons à  remercier particulièrement tous les chercheurs qui par leur généreuse contribution et leur vision collective de la recherche ont permis à ce programme d’exister.
</p>

<div>
	<iframe src="Annuaire_des_chercheurs.pdf" width="950px" height="550" class="chercheurs_pdf"></iframe>
</div>

<?php
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
