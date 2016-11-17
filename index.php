<?php
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
?>
 	<article class="std">
		<div class="std__sidebloc">
			<div style="margin-top: 50px;">
			<h3 class="std__title">Partenaires</h3>
				<div>
					<ul class="side_panel_ul">
						<li>Cité de l’architecture et du patrimoine</li>
						<li>Ecole du Louvre</li>
						<li>Ecole nationale des Chartes</li>
						<li>Université Paris 1 Panthéon-Sorbonne</li>
					</ul>
				</div>
				<h3 class="std__title" style="margin-top: 10px;">Financement</h3>
				<div>
					<ul class="side_panel_ul">
						<li>Labex CAP (Laboratoire d’excellence Création Arts Patrimoine)</li>
						<li>HeSam Université</li>
						<li>HiCSA (Laboratoire Histoire culturelle et sociale de l’art, Université Paris 1 Panthéon-Sorbonne)</li>
						<li>Université Paris 1 Panthéon-Sorbonne</li>
					</ul>
				</div>
				<br>
				<br>
				<h3 class="std__title" style="margin-top: 10px;">Nous contacter</h3>
				<div>
					<ul class="side_panel_ul">
						<li style="color: #1f398f;">critiquesdart@univ-paris1.fr</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="std__maincol">
			<h2 class="std__title">Présentation</h2>
			<div class="std__body">
				<p align="justify" class="paragraphe">
					Ce site est consacré aux auteurs francophones ayant exercé la critique d’art et actifs entre le milieu du XIXe siècle et la première moitié du XXe siècle. Pour chaque auteur répertorié, une page met à disposition du public ses bibliographies primaires et secondaires, ainsi que les sources d’archives identifiées. Ces documents ont été édités à partir de travaux de recherche approfondis permettant de constituer des bibliographies primaires considérées comme complètes. Dans le cas particulier d’écrivains dont les &oelig;uvres complètes ont été publiées, seuls les écrits sur l’art sont recensés. Ce répertoire en ligne se double d’une base de données qui comprend les bibliographies primaires des critiques répertoriés dans le site.
				</p>
				<p align="justify" class="paragraphe">
					Non discriminant, puisqu’il ne prévoit pas de typologie ou de classement autre que le support de diffusion du texte, pluridisciplinaire, le site ne prétend pas à l’appréciation de la valeur critique du texte et privilégie une vision d’ensemble, la plus complète possible, de la production littéraire des auteurs concernés, quel que soit le champ (littérature, arts, politique, histoire, etc.) ou les médiums (photographie, cinéma, beaux-arts, architecture, etc.) sur lesquels leur regard s’est porté.
				</p>
				<p align="justify" class="paragraphe">
					Portant sur les critiques d’art francophones, le site est susceptible d’accueillir des acteurs des scènes artistiques françaises, belges ou suisses, tout en prenant également en compte le contexte colonial. Les auteurs ayant écrit dans plusieurs langues sont également retenus.
				</p>
				<p align="justify" class="paragraphe">
					Le site a pour but de valoriser la recherche dans le domaine de la critique d’art, de faciliter l’accès aux documents et de créer des liens entre les chercheurs. Evolutif, il a pour vocation à être enrichi progressivement, aussi bien par l’ajout de nouveaux auteurs que par la complétion des bibliographies déjà mises en ligne.
				</p>
			</div>
		</div>
		
		<hr style="width: 40%; margin-top: 35px;">
		
		<h2 class="std__title" style="width: 100%; margin-top: 30px;">Équipe</h2>
		<div class="std__equipe">
			<h4>Responsables du programme</h4>
			<p align="justify" class="par_equipe">Marie GISPERT (Université Paris 1-HiCSA), Catherine MENEUX (Université Paris 1-HiCSA).</p>
			<h4>Comité d’organisation</h4>
			<p align="justify" class="par_equipe">Anne-Sophie AGUILAR (Labex CAP-HiCSA), Eléonore CHALLINE (ENS Cachan), Christophe GAUTHIER (Ecole nationale des Chartes), Marie GISPERT, Gérald KEMBELLEC (CNAM, Dicen-IDF), Lucie LACHENAL (Université Paris 1-HiCSA), Eléonore MARANTZ (Université Paris 1-HiCSA), Catherine MENEUX.</p>
			<h4>Comité scientifique</h4>
			<p align="justify" class="par_equipe">Jean-Paul BOUILLON (PR émérite), Yves CHEVREFILS DESBIOLLES (IMEC), Franck DELORME (Cité de l’architecture et du patrimoine), Jean Philippe GARRIC (Université Paris 1-HiCSA), Thierry LAUGEE (Centre André Chastel), Natacha PERNAC (Ecole du Louvre), Michel POIVERT (HiCSA), Nolwenn RANNOU (Cité de l’architecture et du patrimoine), Didier SCHULMANN (Centre Georges Pompidou), Claude SCHVALBERG (Libraire).</p>
			<br><br>
			<h4>Modélisation et réalisation du système d’information</h4>
			<p align="justify" class="par_equipe">Orélie DESFRICHES DORIA (Université Lyon 3, ELICO), Gérald KEMBELLEC (CNAM, Dicen-IDF).</p>
			<h4>Responsable numérique</h4>
			<p align="justify" class="par_equipe">Vincenzo CAPOZZOLI (Pôle images et technologies numériques, Paris 1).</p>
			<h4>Développement du site web</h4>
			<p align="justify" class="par_equipe">Gérald KEMBELLEC.</p>
			<h4>Graphisme du site web</h4>
			<p align="justify" class="par_equipe">Perrine BALTZ, Juan-Mauro BOZZANO.</p>
			<h4>Vacations scientifiques</h4>
			<p align="justify" class="par_equipe">Anne-Sophie AGUILAR, Lucie LACHENAL.</p>
			<h4>Vacations techniques</h4>
			<p align="justify" class="par_equipe">Thomas BUSCIGLIO. Esther JAKUBEC, Stéphanie PRENANT.</p>
			<h4>Édition</h4>
			<p align="justify" class="par_equipe">Anne-Sophie AGUILAR, Hortense ALBISSON, Margaux AUTECHAUD, Andres AVILA GOMEZ, Fanny BACOT, Marion BALDENBERGER, Perrine BALTZ, Laurence BASSIERE, Thomas BEDERE, Indira BERAUD, Julien BOBOT, Lucie BRUGUIERE, Paula BRUZZI, Thomas BUSCIGLIO, Nicole CAPPELLARI, Aurélia CERVONI, Eléonore CHALLINE, Marines Erica CHAMPEAU, Emmanuelle CHAMPOMIER, Alexandra CHUSSEAU, Maud CHOINARD, Barbara DRAME, Caroline DUBOIS, Anna DUFOUR MONTUORI, Sarah DUCHEMIN, Emma DUMARTHERAY, Claire DUPIN, Julien FAURE-CONORTON, Lilie FAURIAC, Flaurette GAUTIER, Violette GIAQUINTO, Lauren GRAS ROBET, Anna HALTER, Laurent HUSSON, Esther JAKUBEC, Anemone JASEMIN, Lucie LACHENAL, Diane LE CORRE, Zoé LEPEULE, Marine NEDELEC, Cindy OLOHOU, Félix ORANGE, Candide PATRY-DELANGLE, Ophilia RAMNAUTH, Cathleen ROBITAILLE, Jessica RONCEAU, Andrea SCHELLINO, Elvira SHAHMIRI, Aphélandra SIASSIA, Fabienne STAHL, Pauline TEKATLIAN, Léonie THIROUX, Laura VALETTE, Véronique ZERATH.</p>
			<h4>Remerciements à</h4>
			<p align="justify" class="par_equipe">Philippe DAGEN, Zinaïda POLIMENOVA, Jeanne Marie PORTEVIN  et tous les chercheurs qui, par leur généreuse contribution et leur vision collective de la recherche, ont permis à ce programme d’exister.</p>
		</div>
<?php
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
