<?php
session_start();
include 'config.php';
include 'lib_fonctions.php';
if(!isset($_SESSION['user'])){
	echo '<script language="javascript">document.location.replace("index.php");</script>';
}
?>
<legend>Saisie d'un chapitre dans un ouvrage général</legend>        
                <div id="chercherouvrage">
                <p>Vous allez saisir un nouveau chapitre d'ouvrage ou une préface, postface, introduction dans un ouvrage.<br><br>
                    <label class="control-label col-sm-8">Rechercher le titre de l'ouvrage</label>
                        <input list="TitreOuvrage" name="TitreOuvrage" size="55" maxlength="255" required>
                        <datalist id='TitreOuvrage'>
                        	<?php afficherTousLesOuvragesFormOption(); ?>
                        </datalist>
                   	<br>ou <a onClick="nouvel_ouvrage();" style="color: #1f398f;">proposer un ouvrage collectif</a>
                </p>
                </div>
                        <p>
                        <label class="control-label col-sm-8">Titre du chapitre, de la préface, postface ou introduction</label>
                        <input name="TitreChapitre" type="text" size="55" maxlength="255" required />
                        </p>
                        <p>
                        <label class="control-label col-sm-8">Complément de Titre du chapitre, de la préface, postface ou introduction</label>
                        <input name="ComplémentTitreChapitre" type="text" size="55" maxlength="255" />
                        </p>
                        <p>
                        <label class="control-label col-sm-8">Pagination</label>
                        <input name="pagination_chapitre" type="text" size="20" maxlength="20" />
                   		</p>