<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>Formulaire de création d'un critique</title>
    <link rel="stylesheet" href="css/styleFormulaire.css">
	<!-- jQuery Color Picker -->
	<link rel="stylesheet" href="css/colorpicker.css">
    <!-- jQuery  -->
	<script src="js/jquery-1.4.3.min.js"></script>
	<script src="js/jquery-ui-1.8.5.min.js"></script>
    <!-- Modernizr -->
	<script src="js/modernizr.js"></script>
    <!-- Webforms2 -->
	<script src="js/webforms2-p.js"></script>
</head>
<body>
<!-- Script DATE  -->
	<script>
	var initDatepicker = function() {  
    $('input[type=date]').each(function() {  
        var $input = $(this);  
        $input.datepicker({  
            minDate: $input.attr('min'),  
            maxDate: $input.attr('max'),  
            dateFormat: 'yy-mm-dd'  
        });  
    });  
};  
  
if(!Modernizr.inputtypes.date){  
    $(document).ready(initDatepicker);  
};  
  </script>
<?php
$prenom=$_GET['prenom'];
$nom=$_GET['nom'];
$annee_naissance=$_GET['naissance'];
$annee_mort=$_GET['mort'];
$ISNI=$_GET['insi'];
$initiales=$_GET['initiales'];
$URL_WP=$prenom.'_'.$nom;
if(!isset($nom) || !isset($prenom) || !isset($annee_naissance) || !isset($annee_mort)){
$form='
    <h1>Formulaire de création d\'un nouveau critique </h1>
	<form id="form1" name="form1" method="get" action="create_critique.php">
	 <fieldset>
	 <!--<legend>Nouveau critique</legend> -->
  <p>
    <label for="prenom">Prénom </label>
    <input name="prenom" type="text" value="prenom" size="128" maxlength="128" required />
  </p>
  <p>
  	<label for="nom">NOM</label>
    <input name="nom" type="text" value="NOM" size="128" maxlength="128" required />
  </p>
  <p>
  	<label for="naissance">Date de naissance (entre 1880 et 1920)</label>
	<input type="year" name="naissance" min="1880" max="1920" value="1880" required />
  </p>
  <!-- 
  <p>
    <label for="mort">Date de mort (entre 1880-01-01 et 2014-12-31)</label>
    <input type="date" name="mort" min="1880-01-01" max="2014-12-31" value="1880-01-01" />
  </p>
  -->
  <p>
    <label for="mort">Date de mort (entre 1880 et 2014)</label>
    <input type="year" name="mort" min="1880" max="2014" value="1880" />
  </p>
  <p>
  	<label for="isni">ISNI :</label>
	<input type="text" name="insi" id="isni" />
  </p>
  <p align="center">
   <button type="submit" class="boutonSubmit" role="button" aria-disabled="false">
    Soumettre le formulaire
  	</button>
  </p>
  </fieldset>
 
  </form>
';
echo $form;
}
elseif(isset($nom) && isset($prenom) && isset($annee_naissance) && isset($annee_mort)){
	$path='./critiques/';
	$nouvel_auteur=$URL_WP;
	echo $path.$nouvel_auteur;
	mkdir($path.$nouvel_auteur,0700) or die('Marche pas');
}
else echo 'données incompletes';

/*
INSERT INTO `critiques`.`critiquedart` (`pk_id_critiqueDart`, `nom`, `prenom`, `anneeNaissance`, `anneeMort`, `ISNI`, `initiales`, `URL_WP`)
VALUES (NULL, 'ROSENTHAL', 'Léon', '1870', '1932', ' 0000 0001 0858 8150', 'L.R', NULL);
*/
?>
</html>