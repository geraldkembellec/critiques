<?php
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	unset($_SESSION['auteurs']);
	unset($_SESSION['collectif_nomme']);
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
<script async src="template_fichiers/fly5lvw.js"></script>
<script type="text/javascript" src="template_fichiers/modernizr.js"></script>
<script type="text/javascript" src="template_fichiers/jquery_002.js"></script>
<script type="text/javascript" src="template_fichiers/jquery-migrate.js"></script>
<script type="text/javascript" src="template_fichiers/jquery.js"></script>
<script type="text/javascript" src="template_fichiers/application.js"></script>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<meta name="msapplication-tileimage" content="http://labexcap.fr/wp-content/themes/labex-cap/img/mstile-144x144.png">
		<link rel="icon" href="http://labexcap.fr/wp-content/themes/labex-cap/img/favicons/favicon.ico" type="image/x-icon">
		<style type="text/css">
		.font-adelle,.tk-adelle{font-family:"adelle",serif;}
        </style>
        <link href="template_fichiers/d.css" rel="stylesheet">
	<link href="template_fichiers/sbi.css" rel="stylesheet" type="text/css" id="sbi-style">
<link type="text/css" rel="stylesheet" href="css/cairn.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<title>formulaire de saisie d'une critique</title>
    <script language="javascript">
            function multi() {
				document.getElementById('multi').style.display="block";
				document.getElementById('multi').style.visibility="visible";     
				document.getElementById('collectif').style.display="none";
				document.getElementById('collectif').style.visibility="hidden";
				vider();
            }
			function collectif() {
				document.getElementById('collectif').style.display="block";
				document.getElementById('collectif').style.visibility="visible";    
				document.getElementById('multi').style.visibility="hidden";   
				document.getElementById('multi').style.display="none";
				vider();
			}
			function vider(){
				document.getElementById('auteur').value = "";
				document.getElementById('auteurs').value = "";
				document.getElementById('collectif_nomme').value = "";
				return false;
			};
    </script>
</head> 
<body onLoad="javascript:multi()">
<section class="main">
	<header class="page-title page-title-bg4">
		<h1>Bases de données Critiques d'Art - <em>Saisie des critiques</em></h1>
	</header>
<h1>Espace de saisie</h1>
    
    <div class="container">
    <h2>Choisir  <a href="javascript:multi()">l'auteur, les auteurs</a> ou <a href="javascript:collectif()">le collectif nommé</a></h2>
    <div class="form-group">
   <form class="form-horizontal" role="form" method="get" action="action_page.php">
   <fieldset>
       <legend>Saisie du/des auteur(s) ou du collectif</legend>
       
       <div class="col-sm-10" id="collectif" style="visibility: hidden; display:none;" >
         <label class="control-label col-sm-8" for="collectif_nomme">Sélectionnez le collectif</label>
         <select name="collectif_nomme" id="collectif_nomme">
         		<option value="" />
                <?php
          			afficherTousLesCollectifFormOption();
		 		?>
         </select>
       </div>
        <div class="col-sm-10" id="multi" style="visibility: hidden; display:none;" >         
       <!-- Si vous n'avez qu'un auteur à selectionner; cliquez <a href="javascript:mono()">ici</a>) -->
        <br />
        <label class="control-label col-sm-8" for="auteurs[]">Cliquez sur Ctrl (windows) / CMD (Mac) pour selectionner un ou plusieur(s) auteur(s). </label>
        <select name="auteurs[]" id="auteurs" multiple>
        <?php
          afficherTousLesAuteursFormOption();
		 ?>
        </select>
        </div>
	</fieldset>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Envoyer</button>
        <input type="button" class="btn btn-default" name="index" value="Retour à la page d'accueil" onclick="self.location.href='index.php'" />
      </div>
    </div>
  </form>
    </div>
</body>
</html>