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
</head>
<body>
<section class="main">
	<header class="page-title page-title-bg4">
		<h1>Bases de données Critiques d'Art - <em>Saisie des critiques</em></h1>
	</header>
<h1>Espace de saisie</h1>
    <div class="container">
    <h2>Valider le(s) auteur(s)</h2>
<?php
session_start();
include 'config.php';
include 'lib_fonctions.php';
if(!isset($_SESSION['user'])){
        	echo '<script language="javascript">document.location.replace("index.php");</script>'; 
	}

if(isset($_GET['auteurs']) AND $_GET['auteurs'] !=''){
	print("Vous avez choisi les auteurs : ");
	foreach($_GET['auteurs'] as $auteur){
		afficherAuteurById($auteur);
	}
	print("<form action=\"choisir_type_critique.php\" method=\"post\">");
	print("<input type=\"hidden\" name=\"auteurs[]\" value=".$_GET['auteurs'].">");
	$_SESSION['auteurs']=$_GET['auteurs'];
	unset($_SESSION['collectif_nomme']);
	print("<input type=\"submit\" value=\"Valider\">");
	print("</form>");
	print("<button value=\"Gras\" onclick=\"document.location.replace('insertion.php');\"><img src=\"\" alt=\"Annuler la saisie\" /></button>");
}
if(isset($_GET['collectif_nomme']) AND $_GET['collectif_nomme'] !=''){
	unset($_SESSION['auteurs']);
	print("Vous avez choisi le collectif nommé : ");
	//print($_GET['collectif_nomme']);
	$_SESSION['collectif_nomme']=$_GET['collectif_nomme'];
	afficherCollectifById($_SESSION['collectif_nomme']);
	print("<form class=\"form-horizontal\" role=\"form\" action=\"choisir_type_critique.php\" method=\"post\">");
	print("<input type=\"hidden\" name=\"collectif\" value=\"".$_GET['collectif_nomme']."\">");
    print("<input type=\"submit\" value=\"Valider\">");
    print("</form>");
	print("<button value=\"Gras\" onclick=\"document.location.replace('insertion.php');\"><img src=\"\" alt=\"Annuler la saisie\" /></button>");
}
if($_GET['auteurs']=='' AND $_GET['collectif_nomme']==''){
	print("Erreur ou absence de saisie <button value=\"Gras\" onclick=\"document.location.replace('insertion.php');\"><img src=\"\" alt=\"Re-saisir\" /></button>");
}
?>
</body>
</html>