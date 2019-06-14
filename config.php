<?php
try
{
    // On se connecte à MySQL
	global $pdo;
    $pdo = new PDO('mysql:host=localhost;dbname=critiquesdart;charset=utf8', 'labexcap', 'motdepasse');
	$pdo->exec("SET CHARACTER SET utf8");
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message 
	die('Erreur : '.$e->getMessage());
}
$url_site='http://critiquesdart.univ-paris1.fr/';
$chemin_relatif_images='wp-content/themes/labex-cap/img/';
$chemin_relatif_icones='http://labexcap.fr/wp-content/themes/labex-cap/img/favicons/';
// Les mots de passe sont cryptés : crypt(motdepasse,login)
$users['admin']['login']='admin';
$users['admin']['password']='crypted';
$users['admin']['level']='admin';
$users['admin']['label']='Admin';
?>
