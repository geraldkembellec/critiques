<?php
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	if(!isset($_SESSION['user'])){
        	echo '<script language="javascript">document.location.replace("index.php");</script>'; 
	}
?>
<!DOCTYPE html>
<html class="js svg wf-adelle-n4-active wf-adelle-n7-active wf-active" lang="fr-FR">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<link rel="stylesheet" id="labex-cap-style-css" href="template_fichiers/style.css" type="text/css" media="all">
	<link rel="stylesheet" id="critiques" href="css/critiques.css" type="text/css" media="all">
	<script async src="template_fichiers/fly5lvw.js"></script>
	<script type="text/javascript" src="js/critiques.js"></script>
	<script type="text/javascript" src="template_fichiers/modernizr.js"></script>
	<script type="text/javascript" src="template_fichiers/jquery_002.js"></script>
	<script type="text/javascript" src="template_fichiers/jquery-migrate.js"></script>
	<script type="text/javascript" src="template_fichiers/jquery.js"></script>
	<script type="text/javascript" src="template_fichiers/application.js"></script>
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
	<meta name="msapplication-tileimage" content="http://labexcap.fr/wp-content/themes/labex-cap/img/mstile-144x144.png">
	<link rel="icon" href="http://labexcap.fr/wp-content/themes/labex-cap/img/favicons/favicon.ico" type="image/x-icon">
	<link href="template_fichiers/d.css" rel="stylesheet">
	<link href="template_fichiers/sbi.css" rel="stylesheet" type="text/css" id="sbi-style">
	<link type="text/css" rel="stylesheet" href="css/cairn.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
	<title>formulaire de saisie d'une critique</title>
</head>
<body>
<section class="main">
	<header class="page-title page-title-bg4">
		<h1>Bases de données Critiques d'Art - <em>Saisie des critiques</em></h1>
        <input type="reset" value="Abandonner la saisie de cette critique" onClick="document.location.replace('insertion.php');" />
	</header>
<div class="container">
<h1>Espace de saisie</h1>
<div id="transparent" style="visibility:hidden;"></div>
<form name="critique" method="get" action="test.php">
<!-- Type de critique -->
    <fieldset>
    	<p>
        <label class="control-label col-sm-8">Type de critique</label>
        <select name="typeCritique" onChange="afficher_type_critique();" > 
             <option />
        	<optgroup label="Périodique">
            	<option value="article">Article de périodique</option>
            </optgroup>
            <optgroup label="Partie d'ouvrage">
                <option value="preface">Préface</option>
                <option value="chapitre">Chapitre d'ouvrage</option>
                <option value="introduction">Introduction</option>
                <option value="postface">Postface</option>
             </optgroup>
             <optgroup label="Ouvrage complet">
            	<option value="monographie">Monographie</option>
             </optgroup>
        </select>
        </p>
    </fieldset>
    <fieldset name="revue" id="revue">
		<!-- Revue -->
     </fieldset>
    <fieldset name="chapitre_ouvrage" id="chapitre_ouvrage" style="visibility: hidden; display:none;">
        <!-- Chapitre -->
     </fieldset> 
	<fieldset name="monographie" id="monographie" style="visibility: hidden; display:none;">
       <!-- Monographie -->
    </fieldset>
    <br>
    <fieldset>
        <legend>Signature de la critique</legend>
                <?php
					if(isset($_SESSION['auteurs'])){
						//print_r($_SESSION['auteurs']);
						foreach($_SESSION['auteurs'] as $auteur){
							afficherAuteurById($auteur);
						}
					}
					if(isset($_POST['collectif'])){
						afficherCollectifById($_POST['collectif']);
						echo '<input type="hidden" name="collectif" value="'.$_POST['collectif'].'">';
					}
				?>
        <p>
        <label class="control-label col-sm-8">Attribution</label>
        <select name="type" required>
            <option value="certifié">Auteur certifié</option>
            <option value="attribué">Attribué à l'auteur</option>
        </select>
        </p>
        <p>
		<label class="control-label col-sm-8">Type de signature</label>
        	<select name="typeSignature" onChange="afficher_autre();" >
			   <option value="patronyme">Patronyme(s)</option>
               <option value="initiales">Initiales</option>
               <option value="pseudo">Pseudonyme</option>
               <option value="anonyme">Anonyme</option>
        	</select>
		<span name="autre_signature" id="autre_signature" style="visibility: hidden; display:none;">
			<label class="control-label col-sm-8">Précisez l'intitulé du pseudonyme</label>
			<input name="pseudonyme" id="pseudonyme" />
        </span>
		</p>   
    </fieldset>
    <fieldset>
         <p>
            <input type="reset" value="Vider les champs du formulaire" onClick="location.reload();" />
            <input type="submit" value="Envoyer" />
        </p>
	</fieldset>
</form>
 </div>
 </section>
</body>
</html>