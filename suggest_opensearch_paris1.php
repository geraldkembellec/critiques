<?php
header('Content-type: text/json');
header('Content-type: application/json'); 
include 'config.php';
$variable=$_GET['term'];
$sql="SELECT * FROM critiquedart WHERE prenom LIKE '%".$variable."%' OR nom LIKE '%".$variable."%'";
//echo $sql;
$array=array();
$output=array();
$req_auteur=$pdo->query($sql) or die('erreur SQL');
	while ($enr = $req_auteur->fetch())
    { 
		$id = $enr['pk_id_critiqueDart'];
		$prenom = $enr['prenom'];
		$nom = $enr['nom'];
		array_push($array,$prenom.' '.$nom);
    }
	array_push($output,$variable);
	array_push($output,$array);
echo json_encode($output);
?>