<?php
	session_start();
	include 'config.php';
 	include 'lib_fonctions.php';
    if(!isset($_SESSION['user'])){
        	echo '<script language="javascript">document.location.replace("index.php");</script>'; 
	}
?>
<legend>Saisie d'un article de périodique</legend>
       <p>
      <label class="control-label col-sm-8">Rechercher le Titre du périodique</label>
                        <input list="titres_revues" name="titres_revues" size="55" maxlength="255" required >
                        <datalist id="titres_revues">
                      		<?php affichierToutesLesRevuesFormOption(); ?>
                        </datalist>
                        <br>ou <a onClick="nouvelle_revue();" style="color: #1f398f">proposer un autre périodique</a>
                        </p>
                        <p>
	                        <label class="control-label col-sm-8">Titre de l'article</label>
	                        <input name="TitreArticlePeriodique" type="text" size="55" maxlength="512" required />
                        </p>
                        <p>
	                        <label class="control-label col-sm-8">Complement de titre de l'article</label>
	                        <input name="ComplementTitreArticlePeriodique" type="text" size="55" maxlength="1024" />
                        </p>
                        <p>
	                        <label class="control-label col-sm-8">Pagination</label>
	                        <input name="pagination" type="text" size="20" maxlength="20" required />
                        </p>
                        <div id="numéroperiodique">
                            <p>
	                            <label class="control-label col-sm-8">Titre du Numéro de Périodique</label>
	                            <input name="TitreNumeroPeriodique" type="text" size="55" maxlength="255" />
                            <p>
	                            <label class="control-label col-sm-8">Complément de titre numéro de périodique</label>
	                            <input name="ComplementTitrePeriodique" type="text" size="55" maxlength="255" />
                            <p>
	                            <label class="control-label col-sm-8">Volume</label>
	                            <input name="Volume" type="text" size="6" maxlength="16" /> 
                            <p>
	                            <label class="control-label col-sm-8">Numéro</label>
	                            <input name="Numero" type="text" size="6" maxlength="6" /> 
                            <p>
	                            <label class="control-label col-sm-8">Année de publication</label>
	                            <input name="AnneePublication" type="year" size="4" maxlength="4" min="1800" max="1999" required />
                            <p>
	                            <label class="control-label col-sm-8">Date précise (<span title="Firefox : AAAA-MM-JJ , Chrome : JJ/MM/AAAA">aide</span>)</label>
	                            <input type="date" name="DatePrecise" type="text" min="1800-01-01" max="1999-12-31" />
                            	<!-- ça bugue ici-->
                            <p>
	                            <label class="control-label col-sm-8">Nombre de pages du numéro</label>
	                            <input name="nb_page_numero" type="text" size="3" maxlength="3" />
                            </p>     
                    	</div>