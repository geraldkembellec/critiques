<?php
	error_reporting (0);
	
	session_start();
	include 'config.php';
	include 'lib_fonctions.php';
	include 'html_habillage.php';
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
	echo $debut_main;
	echo $debut_article;
?>
		<p align="justify" class="paragraphe" style="margin-bottom: 30px;">
			Les formulaires de recherche permettent d’exploiter une base de données constituée des références issues des bibliographies primaires des critiques répertoriés dans le site. 
			La base est interopérable avec les technologies du Web de données et donc interrogeable via Isidore, Hal et les outils comme Zotero ou Mendeley.
		</p>
		
        <form id="simple" action="simple.php" method="get">
			<h3 style="color: #1f398f; float: left; margin-left: 90px;">Recherche simple</h3><h3>&nbsp;/&nbsp;<a href="javascript:recherche_avancee();">Recherche avancée</a></h3>
			<br />
			<fieldset class="rechercher_fieldset">
				<p>
					<label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Chercher un mot ou un groupe de mots</label>
					<input style="width: 350px;" list="quicksearch" name="quicksearch" size="55" maxlength="255" autocomplete='off' required >
					<datalist id="quicksearch">
						<?php 
						  	//affichierToutesLesCritiquesFormOptionSansDoublon();
							afficherToutesLesRevuesFormOptionSansDateNiDoublon();
							//afficherTousLesOuvragesFormOptionSansAnneeNiDoublon();
							afficherTousLesAuteursFormOptionSansId();
						?>
					</datalist>
				</p>
			</fieldset>
			<div class="rechercher_div_bouton">
		       	<input type="submit" name="button" id="button" value="Lancer la recherche" />
				<input type="reset" name="raz" id="raz" value="Réinilialiser la requête" style="margin-top: 10px;" />
			</div>
		</form>
		<form id="avancee" style="visibility: hidden; display:none;" action="avance.php" method="get">
 			<h3 style="float: left; margin-left: 90px;"><a href="javascript:recherche_simple();">Recherche simple</a>&nbsp;/&nbsp;</h3><h3 style="color: #1f398f;">Recherche avancée</h3>
			<!-- Si vous n'avez qu'un auteur à selectionner; cliquez <a href="javascript:mono()">ici</a>) -->
			<fieldset class="rechercher_fieldset">
				<legend class="rechercher_legend">Rechercher dans le titre ou le complément de titre</legend>
				<p><label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Chercher un mot ou un groupe de mots</label>
				<input name="Titre_SousTitre" type="text" size="35" maxlength="100" style="width: 350px;" /></p>
				<p><label class="control-label col-sm-8" style="display: block; width: 450px; float: left;">dans</label>
	            <input type="radio" name="choix" value="choix_titre" />
	            le titre
	            <input type="radio" name="choix" value="choix_sous_titre"/>
	            le complément de titre
	            <input type="radio" name="choix" value="choix_sous_titre_et_titre" checked />
	            les deux<br /></p>
			</fieldset>

			<fieldset class="rechercher_fieldset">
				<legend class="rechercher_legend">Sur le critique</legend>
				<label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Choisir un critique</label>
				<select name="auteur" id="auteurs" class="rechercher_comboBox">
		            <option label=""></option>
		            <?php
		            	afficherTousLesAuteursFormOption();
				 	?>
				</select>
				<p>
		        <label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Attribution<br /></label>
		        <select name="type" class="rechercher_comboBox">
		            <option label=""></option>
		            <option value="certifie">Auteur certifié</option>
		            <option value="attribue">Attribué àl'auteur</option>
		        </select>
		        </p>
		        <p>
				<label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Type de signature <br /></label>
	        	<select name="typeSignature" class="rechercher_comboBox">
	               <option label=""></option>
				   <option value="patronyme">Patronyme(s)</option>
	               <option value="initiales">Initiales</option>
	               <option value="pseudonyme">Pseudonyme</option>
	               <option value="anonyme">Anonyme</option>
	        	</select>
	            <span id="autre_signature" style="visibility: hidden; display:none;">
					<label style="display: block; width: 450px;float: left;">Vous pouvez préciser le pseudonyme</label>
						<input name="pseudonyme" id="pseudonyme">
		        	</span>
				</p>  
		        <p>
	        	<label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Rechercher par année(s) de publication entre</label>
	        	<input name="anneeEditionMin" type="text" size="4" maxlength="4" />&nbsp;&nbsp;&nbsp;et&nbsp;&nbsp;&nbsp;<input name="anneeEditionMax" type="text" size="4" maxlength="4" />
	     		</p>
	     </fieldset>
	  	 <fieldset class="rechercher_fieldset">
	       <legend class="rechercher_legend">Recherche d'ouvrage ou de revue</legend>
	        <p>
	        <label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Type de texte<br /></label>
	        <select name="typeCritique" onChange="avance();" class="rechercher_comboBox"> 
	        <option label=""></option>
	            <optgroup label="Périodique">
	            	<option value="article">Article de périodique</option>
	            </optgroup>
	            <optgroup label="Partie d'ouvrage">
	                <option value="preface">Préface</option>
	                <option value="chapitre">Chapitre d'ouvrage</option>
	                <option value="introduction">Introduction</option>
	                <option value="postface">Postface</option>
	                <option value="direction">Direction</option>
	          </optgroup>
	             <optgroup label="Ouvrage complet">
	            	<option value="monographie">Monographie</option>
	             </optgroup>
	        </select>
	        </p>
	        <div id="LesRevues" style="visibility: hidden; display:none;">
	        <label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Titre de la revue</label>
	            <input list="revue" name="revue" size="55" maxlength="255" autocomplete="off">
	            <datalist id="revue">
						<?php 
						  	//affichierToutesLesCritiquesFormOptionSansDoublon();
							afficherToutesLesRevuesFormOptionSansDateNiDoublon();
						?>
				</datalist>
	         </div>
	         <div id="LesOuvrages" style="visibility: hidden; display:none;">
	         <label class="control-label col-sm-8" style="display: block; width: 450px;float: left;">Titre de l'ouvrage</label>
	            <input list="ouvrage" name="ouvrage" size="55" maxlength="255" autocomplete="off">
	            <datalist id="ouvrage">
						<?php 
						  	afficherTousLesOuvragesFormOptionSansAnneeNiDoublon();
						?>
				</datalist>
	        </div>
	  </fieldset>
	  
<script>
function raz() {
	//alert('tester');
	document.getElementById('raz').value="true";
}

function avance(){
	// Selecteur de formulaire
	switch (document.forms.avancee.typeCritique.selectedIndex) {
		case 1:
			// Revue
			document.getElementById('LesRevues').style.visibility="visible";
			document.getElementById('LesRevues').style.display="block";
			document.getElementById('LesOuvrages').style.visibility="hidden";
			document.getElementById('LesOuvrages').style.display="none";
		break;
		case 2:
			// Chapitre
			document.getElementById('LesOuvrages').style.visibility="visible";
			document.getElementById('LesOuvrages').style.display="block";
			document.getElementById('LesRevues').style.visibility="hidden";
			document.getElementById('LesRevues').style.display="none";
		break;
		case 3: 
			document.getElementById('LesOuvrages').style.visibility="visible";
			document.getElementById('LesOuvrages').style.display="block";
			document.getElementById('LesRevues').style.visibility="hidden";
			document.getElementById('LesRevues').style.display="none";
		break;
		case 4: 
			document.getElementById('LesOuvrages').style.visibility="visible";
			document.getElementById('LesOuvrages').style.display="block";
			document.getElementById('LesRevues').style.visibility="hidden";
			document.getElementById('LesRevues').style.display="none";
		break;
		case 5: 
			document.getElementById('LesOuvrages').style.visibility="visible";
			document.getElementById('LesOuvrages').style.display="block";
			document.getElementById('LesRevues').style.visibility="hidden";
			document.getElementById('LesRevues').style.display="none";
		break;
		case 6:
			document.getElementById('LesOuvrages').style.visibility="visible";
			document.getElementById('LesOuvrages').style.display="block";
			document.getElementById('LesRevues').style.visibility="hidden";
			document.getElementById('LesRevues').style.display="none";
		break;
		default:
			document.getElementById('LesOuvrages').style.visibility="hidden";
			document.getElementById('LesOuvrages').style.display="none";
			document.getElementById('LesRevues').style.visibility="hidden";
			document.getElementById('LesRevues').style.display="none";
		break;
	}
}

</script>

	<div class="rechercher_div_bouton">
       <input type="submit" value="Lancer la recherche" />
       <input type="reset" name="raz" id="raz" value="Réinilialiser la requête" style="margin-top: 10px;" />
	</div>
  	</form>
  	
	<br />
	
<?php
	if($_GET['raz']=='true'){
		unset($_GET);
	}

	if(isset($_GET['quicksearch']) && sizeof($_GET)>0 && $_GET['raz']!='true')
	{
		print('<h2>Résultats</h2><div id="resultat"><pre>');
		$idAuteur=rechercherIdAuteurByPrenom_NOM($_GET['quicksearch']);
		if($idAuteur!=''){
			//print_r($_GET);
			//rechercherIdAuteurByPrenom_NOM($_GET['Titre']));
			print("Votre recherche semble porter sur un critique d'art : ");
			//echo $idAuteur;
			afficherAuteurById($idAuteur);
		}


		$idRevue=revue_id_sans_date($_GET['quicksearch']);
		if($idRevue!=''){
			//print_r($_GET);
			//rechercherIdAuteurByPrenom_NOM($_GET['Titre']));
			print("Votre recherche semble porter sur une revue : ");
			print("<a href='avance.php?Titre_SousTitre=&choix=choix_sous_titre_et_titre&auteur=&type=&typeSignature=&pseudonyme=&anneeEditionMin=&anneeEditionMax=&typeCritique=article&revue=");
			print(get_revue_by_id_sans_date($idRevue));
			print("'>");
			afficher_revue_by($idRevue);
			print("</a>");
			//echo $idAuteur;
			//afficherAuteurById($idAuteur);
		} elseif($idRevue='' && $idAuteur='') {
			echo "Pas de résultat, veuillez tenter une recherche avancée ou réinitialiser la requête";
			//print_r($_GET);
		}

		print('</pre></div>');
	}
?>
	
<!-- <form>
	<button id="raz" name="raz" value="true">Réinilialiser la requête</button>
</form> -->
        
<?php
	if($_GET['opt']=='avance')echo "<script>recherche_avancee();</script>";
	///
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
