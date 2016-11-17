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

<section>
	<header>
		<h1>Bases de données Critiques d'Art - <em>Saisie des critiques</em></h1>
	</header>
	<div class="saisie_container">
	<h3 class="std__title" style="font-size: 1.5em;">Espace de saisie</h3>
	
	<input type="reset" value="Abandonner la saisie de cette critique" onClick="document.location.replace('insertion.php');" style="margin: 20px 0;"/>
	
	<div id="transparent" style="visibility:hidden;"></div>
	<form name="critique" method="get" action="test.php">
	<!-- Type de critique -->
    <fieldset style="margin-bottom: 20px;">
    	<p>
        <label class="control-label col-sm-8">Type de critique</label>
        <select name="typeCritique" onChange="afficher_type_critique();" > 
             <option />
        	<optgroup label="Périodique">
            	<option value="article">Article de périodique</option>
            </optgroup>
            <optgroup label="Partie d'ouvrage">
                <option value="preface">Préface</option>
                <option value="chapitre">Chapitre d'ouvrage</option>
                <option value="introduction">Introduction</option>
                <option value="postface">Postface</option>
             </optgroup>
             <optgroup label="Ouvrage complet">
            	<option value="monographie">Monographie</option>
             </optgroup>
        </select>
        </p>
    </fieldset>
    <fieldset name="revue" id="revue" style="visibility: hidden; display:none;">
		<!-- Revue -->
     </fieldset>
    <fieldset name="chapitre_ouvrage" id="chapitre_ouvrage" style="visibility: hidden; display:none;">
        <!-- Chapitre -->
     </fieldset> 
	<fieldset name="monographie" id="monographie" style="visibility: hidden; display:none;">
	<!-- Monographie -->
    </fieldset>
    <br>
    <fieldset>
        <legend>Signature de la critique</legend>
                <?php
					if(isset($_SESSION['auteurs'])){
						//print_r($_SESSION['auteurs']);
						foreach($_SESSION['auteurs'] as $auteur){
							afficherAuteurById($auteur);
						}
					}
					if(isset($_POST['collectif'])){
						afficherCollectifById($_POST['collectif']);
						echo '<input type="hidden" name="collectif" value="'.$_POST['collectif'].'">';
					}
				?>
        <p>
        <div class="control-label col-sm-8">Attribution</div>
        <select name="type" required>
            <option value="certifié">Auteur certifié</option>
            <option value="attribué">Attribué à l'auteur</option>
        </select>
        </p>
        <p>
		<div class="control-label col-sm-8">Type de signature</div>
        	<select name="typeSignature" onChange="afficher_autre();" >
			   <option value="patronyme">Patronyme(s)</option>
               <option value="initiales">Initiales</option>
               <option value="pseudo">Pseudonyme</option>
               <option value="anonyme">Anonyme</option>
        	</select>
		<span name="autre_signature" id="autre_signature" style="visibility: hidden; display:none;">
			<label class="control-label col-sm-8">Précisez l'intitulé du pseudonyme</label>
			<input name="pseudonyme" id="pseudonyme" />
        </span>
		</p>   
    </fieldset>
    <fieldset style="border: 0;">
         <p>
            <input type="reset" value="Vider les champs du formulaire" onClick="location.reload();" />
            <input type="submit" value="Envoyer" />
        </p>
	</fieldset>
</form>
</div>
</section>
<?php
	echo $fin_container;
?>