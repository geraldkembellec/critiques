<?php
		session_start();
		include 'config.php';
		include 'lib_fonctions.php';
		include 'html_habillage.php';
		echo $entete;
		echo $debut_container;
		echo $debut_header;
		if(isset($_SESSION['user'])){
        	echo "<a href=\"unconnect.php\" class=\"icon-deconnect\" title=\"Se déconnecter\"></a>
						<span class=\"label\">Se deconnecter</span>"; 
		}
		else{
			echo "<a href=\"connectV2.php\" class=\"icon-person\"></a>
						<span class=\"label\">
                        S’identifier</span>";
		}
		echo $suite_header;
		milieu_header();
	    echo $fin_header;
		echo $debut_main;
		echo $debut_article;
		///
	global $pdo;	
	$sql = "SELECT * FROM `view_articles` WHERE `idCritique` IS NOT NULL";
	if(isset($_GET['Titre_SousTitre']) && $_GET['choix']=='choix_sous_titre_et_titre'){
		 $sql .= " AND (critiqueComplementTitre LIKE '%".addslashes($_GET['Titre_SousTitre'])."%' OR titreCritique LIKE '%".addslashes($_GET['Titre_SousTitre'])."%')";
	}
	if(isset($_GET['Titre_SousTitre']) && $_GET['choix']=='choix_titre'){
		 $sql .= " AND titreCritique LIKE '%".addslashes($_GET['Titre_SousTitre'])."%'";
	}
	if(isset($_GET['typeSignature']))$sql .= " AND typeSignature='".$_GET['typeSignature']."'";
	if(isset($_GET['idCritiqueDart']))$sql .= " AND idCritiqueDart=".$_GET['idCritiqueDart'];
	if(isset($_GET['revue']))$sql .= " AND revue LIKE '%".addslashes($_GET['revue'])."%'";
	if(isset($_GET['anneeEditionMin']))$sql .= " AND annee >=".$_GET['anneeEditionMin'];
	if(isset($_GET['anneeEditionMax']))$sql .= " AND annee <=".$_GET['anneeEditionMax'];
	//echo $sql;
	$resultats=$pdo->query($sql) or die('erreur SQL');
	echo "
		 	<article class='std'>
			<h2 class='std__title'>
				Les documents retrouvés</h2>";
				echo "<h3>Liste des articles de périodiques</h3><ol>";
				$resultats=$pdo->query($sql) or die('erreur SQL');
				foreach ($resultats as $enr){
					print('<li vocab="http://schema.org/" typeof="ScholarlyArticle">');
					$critique["id"]=$enr['critique'];
					$critique["nom"]=$enr['nom'];
					$critique["prenom"]=$enr['prenom'];
					$critique["typeSignature"]=$enr["typeSignature"];
					$critique["idSignature"]=$enr["idSignature"];
					if($enr["typeSignature"]=='patronyme'){
						$critique["signature"]=$enr['nom'].' '.$enr['prenom'];
					}
					$critique["titre"]=$enr['titreCritique'];
					$critique["complement_titre"]=$enr['critiqueComplementTitre'];
					$critique["revue"]=$enr['revue'];
					$critique["annee"]=$enr['annee'];
					$critique["date"]=$enr['datePrecise'];
					$critique["volume"]=$enr['volume'];
					$critique["numero"]=$enr['numero'];
					$critique["pagination"]=$enr['pagination'];
					$critique["idPseudonyme"]=$enr['idPseudonyme'];
					$critique["complementTitreNumero"]=$enr['complementTitreNumero'];
					$critique["annee"]=$enr['annee'];
					$critique["date"]=$enr['datePrecise'];
					print('<span property="author">');
					if($critique['idPseudonyme']==NULL){
						composition_signature($critique["idSignature"],$critique["typeSignature"]);
					}
					else if($critique['idPseudonyme']!=NULL){
						
						afficher_pseudo($critique['idPseudonyme']);
					}
					print('</span>');
					echo ", &laquo;&nbsp;";
					print('<span property="name">');
					echo $critique["titre"];
					echo "</span>";
					echo "&nbsp;&raquo;";
					if($critique["complement_titre"]='')echo ", ".$critique["complement_titre"];
					echo ", <em>".$critique["revue"]."</em>";
					if($critique["volume"]!='') echo ", ".$critique["volume"];
					if($critique['numero']!='' && $critique['numero'] != NULL) echo ", n° ".$critique['numero'];
					if($critique['complementTitreNumero']!='' && $critique['complementTitreNumero']!=NULL)echo ", ".$critique['complementTitreNumero'];
					if($critique['date']!=''){ echo ", ".date_fr($critique['date']);}
					elseif($critique['complementTitreNumero']!=''){
						echo " ".$critique['annee'];
					}
					else{
						echo ", ".$critique['annee'];
					}
					if($critique["pagination"] != ('' || NULL)){
						echo ", ".$critique["pagination"];
					}
					echo ".";
					echo "</li>";
				}
	
	echo "</ol>".$fin_article;
	echo $fin_main;
	echo $footer;
	echo $fin_container;
?>