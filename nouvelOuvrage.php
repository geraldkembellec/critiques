<?php
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	if(!isset($_SESSION['user'])){
        	echo '<script language="javascript">document.location.replace("index.php");</script>'; 
	}
	if(isset($_GET)){
					print('<pre>');
					//print_r($_GET);
					print_r($_POST);
					print('</pre>');
				}

	$TitreOuvrage=$_POST['TitreOuvrage'];
	//echo $TitreOuvrage;
	$SousTitreOuvrage=NULL;
	if($_POST['SousTitreOuvrage']!=''){
		$SousTitreOuvrage=$_POST['SousTitreOuvrage'];
	}
	$CoordinationOuvrage=NULL;
	if($_POST['CoordinationOuvrage']!=''){
		$CoordinationOuvrage=$_POST['CoordinationOuvrage'];
	}
	$CollectionOuvrage=NULL;
	if($_POST['CollectionOuvrage']!=''){
		$CollectionOuvrage=$_POST['CollectionOuvrage'];
	}
	$Pagination=NULL;
	if($_POST['Pagination']!=''){
		$Pagination=$_POST['Pagination'];
	}
	$AnneeEdition=NULL;
	if($_POST['AnneeEdition']!=''){
		$AnneeEdition=$_POST['AnneeEdition'];
	}
	$Editeur=NULL;
	if($_POST['Editeur']!=''){
		$Editeur=$_POST['Editeur'];
	}
	$VilleEdition=NULL;
	if($_POST['VilleEdition']!=''){
		$VilleEdition=$_POST['VilleEdition'];
	}
	$ISBN=NULL;
	if($_POST['ISBN']!=''){
		$ISBN="'".$_POST['ISBN']."'";
	}
	$Edition=NULL;
	if($_POST['Edition']!=''){
		$Edition=$_POST['Edition'];
	}
	$Editeur_id=editeur_id($Editeur);
	if($Editeur_id=='' && $Editeur!='NULL'){
		//echo 'editeur non trouvé';
		$Editeur_id=inserer_nouvel_editeur($Editeur,$VilleEdition);
	}
	//inserer_nouvel_ouvrage($ISBN,$AnneeEdition,$TitreOuvrage,$sousTitreOuvrage,$CoordinationOuvrage,$CollectionOuvrage,$Editeur,$Edition){
	inserer_nouvel_ouvrage($ISBN,$AnneeEdition,$TitreOuvrage,$SousTitreOuvrage,$CoordinationOuvrage,$CollectionOuvrage,$Editeur_id,$Edition);
	//sleep(10);
	echo '<script language="javascript">document.location.replace("choisir_type_critique.php");</script>';
?>