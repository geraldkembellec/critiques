<?php
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	if(!isset($_SESSION['user'])){
        	echo '<script language="javascript">document.location.replace("index.php");</script>'; 
	}
//print_r($_POST);
$ISSN='NULL';
$couverture='NULL';
$titre="'".addslashes ($_POST['TitrePeriodique'])."'";
if($_POST['PériodeCouverte']!=''){
	$couverture="'".$_POST['PériodeCouverte']."'";; 
}
$periodicite="'".$_POST['type']."'";
if($_POST['issn']!=''){
	$ISSN="'".$_POST['issn']."'";
}
$id_revue=inserer_nouvelle_revue($titre,$ISSN,$periodicite,$couverture);
echo '<script language="javascript">document.location.replace("choisir_type_critique.php");</script>';
?>