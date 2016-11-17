<?php
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	include 'html_habillage.php';
	
	if(!isset($_SESSION['user'])){
		echo '<script language="javascript">document.location.replace("index.php");</script>';
	}
	
	echo $entete;
	echo $debut_container;
	echo $debut_header;
	if(isset($_SESSION['user'])){
		echo "<a href=\"unconnect.php\" class=\"icon-deconnect\" title=\"Se déconnecter\"></a></div>";
	} else {
		echo "<a href=\"connectV2.php\" class=\"icon-person\" title=\"S’identifier\"></a></div>";
	}
	milieu_header();
	echo $fin_header;
?>
<section class="main">
<h1>Espace de saisie</h1>
    <div class="container">
    <h3 style="margin: 20px 30px;">Valider le(s) auteur(s)</h3>
<?php
	print("<div style='margin-left: 50px; margin-bottom: 20px;'>");
	if(isset($_GET['auteurs']) AND $_GET['auteurs'] !=''){
		print("Vous avez choisi les auteurs : ");
		foreach($_GET['auteurs'] as $auteur){
			afficherAuteurById($auteur);
		}
		print("<form action=\"choisir_type_critique.php\" method=\"post\">");
		print("<input type=\"hidden\" name=\"auteurs[]\" value=".$_GET['auteurs'].">");
		$_SESSION['auteurs']=$_GET['auteurs'];
		unset($_SESSION['collectif_nomme']);
		print("<input type=\"submit\" value=\"Valider\" style=\"float: left; margin-right: 10px;\">");
		print("</form>");
		print("<input type=\"button\" value=\"Annuler la saisie\" onclick=\"document.location.replace('insertion.php');\" />");
	}
	if(isset($_GET['collectif_nomme']) AND $_GET['collectif_nomme'] !=''){
		unset($_SESSION['auteurs']);
		print("<br><br>Vous avez choisi le collectif nommé : ");
		//print($_GET['collectif_nomme']);
		$_SESSION['collectif_nomme']=$_GET['collectif_nomme'];
		afficherCollectifById($_SESSION['collectif_nomme']);
		print("<form class=\"form-horizontal\" role=\"form\" action=\"choisir_type_critique.php\" method=\"post\">");
		print("<input type=\"hidden\" name=\"collectif\" value=\"".$_GET['collectif_nomme']."\">");
	    print("<input type=\"submit\" value=\"Valider\" style=\"float: left; margin-right: 10px;\">");
	    print("</form>");
		print("<input type=\"button\" value=\"Annuler la saisie\" onclick=\"document.location.replace('insertion.php');\" />");
	}
	if($_GET['auteurs']=='' AND $_GET['collectif_nomme']==''){
		print("Erreur ou absence de saisie <input type=\"button\" value=\"Annuler la saisie\" onclick=\"document.location.replace('insertion.php');\" />");
	}
	print("</div>");
?>
