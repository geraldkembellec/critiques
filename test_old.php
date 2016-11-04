<?php
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	if(!isset($_SESSION['user'])){
        	echo '<script language="javascript">document.location.replace("index.php");</script>'; 
	}
	//$string = str_replace("'","'",$string); 
	
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
</head>
<body>
    <section class="main">
        <header class="page-title page-title-bg4">
            <h1>Bases de données Critiques d'Art - <em>Saisie des critiques</em></h1>
        </header>
           <div class="container">
            <h1>Espace de saisie</h1>
            <?php
			if(!isset($_SESSION['auteurs'])){
				//echo "<mark>On teste</mark>";
			}
                //if(isset($_POST)){
				//	print_r($_POST);
				//}
                if(isset($_GET)){
					print('<pre>');
					print_r($_GET);
					print('</pre>');
				}
				
				switch ($_GET['typeCritique']) {
    				case 'preface':
						$titre=$_GET['TitreChapitre'];
						$sousTitre=$_GET['ComplémentTitreChapitre'];
						$nomOuvrage=$_GET['TitreOuvrage'];
						$id_ouvrage=ouvrage_id($nomOuvrage);
						echo 'ouvrage n° '.$id_ouvrage;
						$pagination=$_GET['pagination_chapitre'];
						echo 'Ce document est une préface intitulée <cite>'.$titre.'</cite> ';
						if(isset($sousTitre) && $sousTitre !=''){
							echo ' ['.$sousTitre.'], ';
						}
						echo ' pour l\'ouvrage <em>'.$nomOuvrage.'</em>';
						if($pagination !='')echo ', pp. '.$pagination.', ';
						////
						$id_critique=inserer_critique($titre,$sousTitre,'preface',$pagination,$_GET['type'],'',$id_ouvrage,'');
						////
						if($_GET['pseudonyme']!=''){
							foreach($_SESSION['auteurs'] as $auteur){
								$id_pseudo=testerOuCreerPseudo($auteur,$_GET['pseudonyme']);
							}
						}
						else $id_pseudo='';
						$id_signature=inserer_signature($_GET['typeSignature'],$id_pseudo,$_GET['collectif'],$id_critique);
						echo " et signé (signature n° $id_signature) par ";
						if(isset($_SESSION['auteurs'])){
							foreach($_SESSION['auteurs'] as $auteur){
								inserer_composition_signature($id_signature,$auteur);
								afficherAuteurByIdModeBiblio($auteur);
							}
						}
						if(isset($_GET['collectif'])){
							afficherCollectifById($_GET['collectif']);
						}
						if($_GET['pseudonyme']!=''){
							echo " sous le pseudonyme <mark><em>".$_GET['pseudonyme']."</em></mark>";
						}
       				break;
					case 'introduction':
       					echo 'Ceci est une introduction';
       				break;
					case 'postface':
       					echo 'Ceci est une postface';
       				break;
					///////////////////////////////////////////////////////////////////////////////
					case 'monographie':
						if($_GET['ISBN']=='')$ISBN='';
						else $ISBN=$_GET['ISBN'];
						if($_GET['AnneeEdition']=='')$AnneeEdition='';
						else $AnneeEdition=$_GET['AnneeEdition'];
       					echo 'Ceci est une monographie intitulée';
						echo ' <cite>'.$_GET['TitreMonographie'].'</cite>';
						$TitreMonographie=$_GET['TitreMonographie'];
						if(isset($_GET['SousTitreMonographie']) && $_GET['SousTitreMonographie']!=''){
							$SousTitreMonographie=$_GET['SousTitreMonographie'];
							echo ' ['.$_GET['SousTitreMonographie'].']';
						}
						else $SousTitreMonographie='';
						if(isset($_GET['pagination']) && $_GET['pagination']!='' && $_GET['pagination']!='n.p.'){
							$pagination=$_GET['pagination'];
							echo ', '.$_GET['pagination'].' p., ';
						}
						else{
							echo 'n.p.';
							$pagination='n.p.';
						}
						echo " parue en ";
						echo $_GET['AnneeEdition'];
						if($_SESSION['reedition']=='')$Edition='';
						else{
							$Edition=$_SESSION['reedition'];
							echo " première édition en ".$Edition;
						}
						echo " et signée par ";
						if(isset($_SESSION['auteurs'])){
							foreach($_SESSION['auteurs'] as $auteur){
							//inserer_composition_signature($id_signature,$auteur);
							afficherAuteurByIdModeBiblio($auteur);
							}
						}
						if($_GET['VilleEdition']==''){
							$VilleEdition='';
						}
						else{
							$VilleEdition = $_GET['VilleEdition'];
							echo " à ".$VilleEdition;
						}
						if($_GET['Editeur']!=''){
							$id_editeur=editeur_id($_GET['Editeur']);
							if($id_editeur==''){
								$id_editeur=inserer_nouvel_editeur($_GET['Editeur'],$VilleEdition);
							}
							echo ", aux éditions ".$_GET['Editeur']." (éditeur n°".$id_editeur.")";
						}
						else $id_editeur='';
						if($_GET['CollectionMonographie']!=''){
							$CollectionMonographie=$_GET['CollectionMonographie'];
							echo ", coll. <em>« ".$_GET['CollectionMonographie']." »</em>";
						}
						else $CollectionMonographie='';
						$id_ouvrage=inserer_nouvel_ouvrage($ISBN,$AnneeEdition,$TitreMonographie,$SousTitreMonographie,'',$CollectionMonographie,$id_editeur,$Edition);
						echo " Id ouvrage = ".$id_ouvrage;
						//inserer_critique($titre,$complementTitre,$type,$pagination,$attribution,$reedition,$fk_id_ouvrage,$fk_id_numero_periodique)
			 			$id_critique=inserer_critique($TitreMonographie,$sousTitreOuvrage,$_GET['typeCritique'],$pagination,$_GET['type'],$Edition,$id_ouvrage,'');
						echo " Id critique = ".$id_critique;
						if($_GET['pseudonyme']!=''){
							foreach($_SESSION['auteurs'] as $auteur){
								$id_pseudo=testerOuCreerPseudo($auteur,$_GET['pseudonyme']);
							}
						}
						else $id_pseudo='';
						$id_signature=inserer_signature($_GET['typeSignature'],$id_pseudo,$_GET['collectif'],$id_critique);
						echo " Id signature = ".$id_signature;
						echo " en ";
						echo $_GET['AnneePublication'];
						echo " et signé (signature n° $id_signature) par ";
						if(isset($_SESSION['auteurs'])){
							foreach($_SESSION['auteurs'] as $auteur){
								inserer_composition_signature($id_signature,$auteur);
								afficherAuteurByIdModeBiblio($auteur);
							}
						}
						if(isset($_GET['collectif'])){
							afficherCollectifById($_GET['collectif']);
						}
						if($_GET['pseudonyme']!=''){
							echo " sous le pseudonyme <mark><em>".$_GET['pseudonyme']."</em></mark>";
						}
       				break;
					//////////////////////////////////////////////////////////////////////////////////
    				case 'article':
       					echo 'Cette critique est un article';
						echo ' intitulé <cite>'.$_GET['TitreArticlePeriodique'].'</cite> ';
						echo 'paru dans <em>'.$_GET['titres_revues'].'</em>';
						if(isset($_GET['ComplementTitreArticlePeriodique']) && $_GET['ComplementTitreArticlePeriodique']!=''){
							echo ' ['.$_GET['ComplementTitreArticlePeriodique'].'], ';
						}
						if(isset($_GET['pagination']) && $_GET['pagination']!='')echo ', pp. '.$_GET['pagination'].', ';
						if(isset($_GET['Numero']) && $_GET['Numero']!='')echo ' N°. '.$_GET['Numero'].', ';
						if(isset($_GET['Volume']) && $_GET['Volume']!='')echo ' Vol. '.$_GET['Volume'].', ';
						$id_revue=revue_id($_GET['titres_revues']);
						$id_numero_periodique=numero_periodique_id($id_revue,$_GET['Numero'],$_GET['AnneePublication'],$_GET['nb_page_numero'],$_GET['TitreNumeroPeriodique'],$_GET['ComplementTitrePeriodique'],$_GET['Volume'],$_GET['DatePrecise']);
						//echo 'périodique n°'.$id_revue.' numero de périodique '.$id_numero_periodique;
						$id_critique=inserer_critique($_GET['TitreArticlePeriodique'],$_GET['ComplementTitreArticlePeriodique'],$_GET['type'],$_GET['pagination'],$_GET['attribution'],'','',$id_numero_periodique);
						if($_GET['pseudonyme']!=''){
							foreach($_SESSION['auteurs'] as $auteur){
								$id_pseudo=testerOuCreerPseudo($auteur,$_GET['pseudonyme']);
							}
						}
						else $id_pseudo='';
						$id_signature=inserer_signature($_GET['typeSignature'],$id_pseudo,$_GET['collectif'],$id_critique);
						echo " en ";
						echo $_GET['AnneePublication'];
						echo " et signé (signature n° $id_signature) par ";
						if(isset($_SESSION['auteurs'])){
							foreach($_SESSION['auteurs'] as $auteur){
								inserer_composition_signature($id_signature,$auteur);
								afficherAuteurByIdModeBiblio($auteur);
							}
						}
						if(isset($_GET['collectif'])){
							afficherCollectifById($_GET['collectif']);
						}
						if($_GET['pseudonyme']!=''){
							echo " sous le pseudonyme <mark><em>".$_GET['pseudonyme']."</em></mark>";
						}
       		 		break;
					//////////////////////////////////////////////////////////////////////////////////////////////////
					case 'chapitre':
						$titre=$_GET['TitreChapitre'];
						$sousTitre=$_GET['ComplémentTitreChapitre'];
						$nomOuvrage=$_GET['TitreOuvrage'];
						$id_ouvrage=ouvrage_id($nomOuvrage);
						$pagination=$_GET['pagination_chapitre'];
						echo 'Cette critique est un chapitre';
						echo ' intitulé <cite>'.$titre.'</cite> ';
						if(isset($sousTitre) && $sousTitre !=''){
							echo ' ['.$sousTitre.'], ';
						}
						echo 'paru dans <em>'.$nomOuvrage.'</em>';
						if($pagination !='')echo ', pp. '.$pagination.', ';
						////
						$id_critique=inserer_critique($titre,$sousTitre,'chapitre',$pagination,$_GET['type'],'',$id_ouvrage,'');
						////
						if($_GET['pseudonyme']!=''){
							foreach($_SESSION['auteurs'] as $auteur){
								$id_pseudo=testerOuCreerPseudo($auteur,$_GET['pseudonyme']);
							}
						}
						else $id_pseudo='';
						$id_signature=inserer_signature($_GET['typeSignature'],$id_pseudo,$_GET['collectif'],$id_critique);
						echo " et signé (signature n° $id_signature) par ";
						if(isset($_SESSION['auteurs'])){
							foreach($_SESSION['auteurs'] as $auteur){
								inserer_composition_signature($id_signature,$auteur);
								afficherAuteurByIdModeBiblio($auteur);
							}
						}
						if(isset($_GET['collectif'])){
							afficherCollectifById($_GET['collectif']);
						}
						if($_GET['pseudonyme']!=''){
							echo " sous le pseudonyme <mark><em>".$_GET['pseudonyme']."</em></mark>";
						}
					break;
					//////////////////////////////////////////////////////////////////////////////////////////////////
   					default:
        				echo "<mark>Vous n'avez pas saisi de type pour votre critique, veuillez recommancer</mark>";
				}
				/*
				if($_GET['typeSignature']!='autre'){
					echo "signé par ".($_GET['typeSignature'])." et ".($_GET['type']);
				}
				else echo "signé par ".$_GET['valeur_autre_signature'];
				*/
				//echo '.';
				$url_de_verif="biblio_auteur.php?critique=".$_SESSION['auteurs'][0]."&idcritiquesignee=".$id_critique;
				unset($_SESSION['auteurs']);
				unset($_GET['collectif']);
            ?>
            <a href="insertion.php">Nouvelle saisie</a> I  <a href="index.php">Index</a>
            <p align="center">
            
            	<mark>Attention : ne rechargez surtout pas la page pour éviter une erreur d'insertion dans la base (vous allez être redirigé(e) pour vérification dans quelques secondes)</mark>.
                <?php 
				flush();
				sleep(10);
				echo '<script language="javascript">document.location.replace("'.$url_de_verif.'");</script>'; ?>
            </p>
            </div>
    </section>
</body>
</html>