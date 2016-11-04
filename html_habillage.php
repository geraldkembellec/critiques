<?php
$titrePrincipal="Bibliographies de critiques d'art francophones";
$debut_container='
<body class="page page-id-556 page-template page-template-labex-cap-php">
	<div class="page-container font-adelle">--
';
$entete='
<!DOCTYPE html>
<html class="js svg wf-adelle-n4-active wf-adelle-n7-active wf-active" lang="fr-FR">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<title>Critiques dâ€™art - Bibliographies en ligne de critiques dâ€™art francophones</title>
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

			<div class="additional-links" style="width: 185px;">
				<a href="annuaire/" class="icon-book" title="Annuaire"></a>
				<a href="mediatheque" class="icon-layers" title="Médiathèque"></a>
';
$fin_header='
			<div class="site-header__top" ><br>
				<a href="http://critiquesdart.univ-paris1.fr/" class="logo-critiques">
					<img src="logos/Logo_critiques.png" width="650" height="80" alt="critiques d’art" title="Logo Critiques">
				</a>
				<a href="http://www.univ-paris1.fr/" style="float: right; margin-right: 35px;">
					<img src="logos/Logo_ufr03.jpg" width="180" height="90" alt="Université Paris_1" title="Logo Paris 1">
				</a>

				<form role="search" method="get" id="searchform" class="searchform" action="rechercher.php" style="top: 137px;">
					<div>
	                    <input name="quicksearch" id="autocomplete" type="text" style="border-radius: 10px;">
						<label class="screen-reader-text" for="autocomplete">Recherche pour&nbsp;:</label>
						<input id="searchsubmit" value="Rechercher" type="submit">
					</div>
			    </form>

                <!-- <form action="index.php">
    				<input id="autocomplete" name="searchFor" type="text" rows="5"/>
    				<button type="submit">search</button>
				</form> -->

				<script>
					$( "#autocomplete" ).autocomplete({
    					source: "suggest.php",
    					minLength: 3
					});
				</script>
             </div>
			<div class="main-navigation-wrapper" id="navbar">
				<nav class="main-navigation">
					<div class="main-navigation-container">
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
	                        	<a href="chercheurs.php">Chercheurs</a>
							</li>
							<li id="menu-item-139" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-139">
	                        	<a href="actualites.php">ActualitÃ©s</a>
							</li>
						</ul>
     				</div>
				</nav>
			</div>
		</header>
';
$debut_article='
 	<article class="landing-intro">
		<p style="text-align: justify;">
';
$debut_liste='
	<ul class="custom-pagination pagination letters">
';
$fin_liste='
	</ul><br>
';
$fin_article='
	</article>
 	<br/>
';
$footer='
<footer class="site-footer font-adelle">
		<div class="site-footer-logos">


			<a href="http://labexcap.fr/" class="footer_logo">
				<img src="logos/Logo_Labex_CAP.jpg" width="120" height="60" alt="Labex CAP" title="Logo Labex CAP">
			</a>
			<a href="http://www.hesam.eu/" class="footer_logo">
				<img src="logos/Logo_heSam.jpg" width="90" height="60" alt="Hésam Université" title="Logo Hésam Université">
			</a>
			<a href="http://hicsa.univ-paris1.fr/" class="footer_logo">
				<img src="logos/Logo_HiCSA.jpg" width="120" height="60" alt="HiCSA" title="Logo HiCSA">
			</a>
			<!-- <a href="http://www.univ-paris1.fr/" class="footer_logo">
				<img src="logos/Logo_ufr03.jpg" width="120" height="60" alt="Université Paris_1" title="Logo Paris 1">
			</a> -->
			<a href="http://www.citechaillot.fr/" class="footer_logo">
				<img src="logos/Logo_cite_architecture_patrimoine.png" width="150" height="60" alt="Cite de l’architecture et du patrimoine" title="Logo de la Cite de l’architecture et du patrimoine">
			</a>
			<a href="http://www.ecoledulouvre.fr/" class="footer_logo">
				<img src="logos/Logo_ecoledulouvre.jpeg" width="200" height="60" alt="Logo École du Louvre" title="Logo École du Louvre">
			</a>
			<a href="http://www.enc-sorbonne.fr/" class="footer_logo">
				<img src="logos/Logo_enc.jpg" width="120" height="60" alt="École nationale des chartes" title="Logo École nationale des chartes">
			</a>
		</div>
		<div class="site-footer-licence">
			<a href="http://creativecommons.org/licenses/by/4.0/" class="footer_logo">
				<img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" />
			</a>
			<br />
			Mentions légales
        </div>
</footer>
';
$fin_container='
</div>
<!-- /.page-container -->
</body>
</html>';
?>