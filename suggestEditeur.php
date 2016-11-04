<?php
header('Content-type: text/json');
header('Content-type: application/json'); 
include 'config.php';

$variable=$_GET['term'];
$sql="SELECT * FROM `editeur` WHERE nom LIKE '%".$variable."%'";
//echo $sql;
$array=array();
$req_auteur=$pdo->query($sql) or die('erreur SQL');
	while ($enr = $req_auteur->fetch())
    { 
		$id = $enr['pk_id_critiqueDart'];
		$nom = utf8_encode($enr['nom']);
		array_push($array,$nom);
    }
echo json_encode($array);
?>