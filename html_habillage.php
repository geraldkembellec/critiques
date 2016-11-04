<?php
$titrePrincipal="Bibliographies de critiques d'art francophones";
$debut_container='
<body class="page page-id-556 page-template page-template-labex-cap-php">
	<div class="page-container font-adelle">--
';
$debut_header='
		<header class="site-header">
			<a class="site-header__img_link" href="'.$url_site.'" title="'.$titrePrincipal.'" rel="home"></a>
			<div class="site-header__top" ><br>
				<h1 class="site-header__logo">
					'.$titrePrincipal.'
				</h1>
				<h2 class="site-header__baseline">Projet du Laboratoire d’excellence Création Arts Patrimoines</h2>
				<form role="search" method="get" id="searchform" class="searchform" action="rechercher.php">
				<div>
                    <input name="quicksearch" id="autocomplete" type="text">
					<label class="screen-reader-text" for="autocomplete">Recherche pour&nbsp;:</label>
					<input id="searchsubmit" value="Rechercher" type="submit">
				</div>
			    </form>
					<script>
					$( "#autocomplete" ).autocomplete({
    				source: "suggest.php",
    				minLength: 3
					});
					</script>
             </div>

			<div class="main-navigation-wrapper" id="navbar">			
				<nav class="main-navigation">
					<div class="other-links">
						<a href="annuaire/" class="icon-book" title="Annuaire"></a>
						<span class="label">Annuaire</span>
						<a href="mediatheque" class="icon-layers" title="Médiathèque"></a>
						<span class="label">Médiathèque</span>
';
$entete='
<!DOCTYPE html>
<html class="js svg wf-adelle-n4-active wf-adelle-n7-active wf-active" lang="fr-FR">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
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
$debut_container='<body class="page page-id-556 page-template page-template-labex-cap-php"><div class="page-container font-adelle">';
$debut_header='<header class="site-header">
			<a class="site-header__img_link" href="'.$url_site.'" title="'.$titrePrincipal.'" rel="home"></a>
			<div class="site-header__top" ><br>
				<h1 class="site-header__logo">
					<!-- <a title="'.$titrePrincipal.'" rel="home">'.$titrePrincipal.'</a> -->
					'.$titrePrincipal.'
				</h1>
				<h2 class="site-header__baseline">Projet du Laboratoire d’excellence Création Arts Patrimoines</h2>
				<form role="search" method="get" id="searchform" class="searchform" action="rechercher.php">
				<div>
                    <input name="quicksearch" id="autocomplete" type="text">
					<label class="screen-reader-text" for="autocomplete">Recherche pour&nbsp;:</label>
					<input id="searchsubmit" value="Rechercher" type="submit">
				</div>
			    </form>
                <!--
                <form action="index.php">
    				<input id="autocomplete" name="searchFor" type="text" rows="5"/>
    				<button type="submit">search</button>
					</form>
                -->
					<script>
					$( "#autocomplete" ).autocomplete({
    				source: "suggest.php",
    				minLength: 3
					});
					</script>
             </div>

			<div class="main-navigation-wrapper" id="navbar">			
				<nav class="main-navigation">
					<div class="other-links">
						<a href="annuaire/" class="icon-book" title="Annuaire"></a>
						<span class="label">Annuaire</span>
						<a href="mediatheque" class="icon-layers" title="Médiathèque"></a>
						<span class="label">Médiathèque</span>
';
$suite_header='
				</div>
					<div class="main-navigation-container">
						<div class="menu-navigation-principale-container">
                        
                        <ul id="menu-navigation-principale" class="nav-menu">
                                       
                        <li id="menu-item-125" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current-menu-ancestor current-menu-parent menu-item-has-children menu-item-125">
                        	<a href="index.php">Accueil</a>
						</li>
						<li id="menu-item-135" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-135">
							<a href="annuaire_critiques.php">Critiques</a>
						</li>
						<li id="menu-item-134" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-134">
							<a href="rechercher.php">Rechercher</a>
						</li>
						<li id="menu-item-143" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-143">
                        	<a>Chercheurs</a>
						</li>
						<li id="menu-item-139" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-139">
                        	<a>Actualités</a>
						</li>
						<li id="menu-item-137" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-137">
                        	<a>Mentions légales</a>
						</li>		
';
$fin_header='
</ul>
                   </div>
                  </div>
				</nav>
			</div>

		</header>
';
$debut_main='
<section class="main">
	<header class="page-title page-title-bg4">
		<h2>Penser le texte à intégrer ici
		<!-- LABEX <abbr title="Création, Arts, Patrimoine">CAP</abbr> - <em>heSam Université</em> -->
		</h2> 
	</header>
';
$debut_article='
 	<article class="landing-intro">
					<p style="text-align: justify;"> 
';
$debut_liste='
	<ul class="pagination letters">
';
$fin_liste='
	</ul><br>
';
$fin_article='
	</article>
 	<br/>
';
$fin_main='
</section>
';
$footer='
<footer class="site-footer font-adelle">
			<div class="menu-pied-de-page-container">
            	<div class="site-footer__copyright"><a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />L’ensemble du contenu de ce site web, sauf exception signalée, est mis à disposition sous licence <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International License</a></div>
            </div>
</footer>
';
$fin_container='
</div>
<!-- /.page-container -->
</body>
</html>';
?>