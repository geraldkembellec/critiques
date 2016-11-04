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
				<h3 class="std__title" style="margin-top: 53px;">Équipe</h3>
				<br />
				<h4>Responsables du programme</h4>
				<p align="justify">Marie GISPERT (Université Paris 1 Panthéon-Sorbonne-HiCSA), Catherine MENEUX (Université Paris 1 Panthéon-Sorbonne-HiCSA).</p>
				<br />
				<h4>Comité d’organisation</h4>
				<p align="justify">Anne-Sophie AGUILAR (Labex CAP-HiCSA), Eléonore CHALLINE (ENS Cachan), Christophe GAUTHIER (Ecole nationale des Chartes), Marie GISPERT, Gérald KEMBELLEC (CNAM, Dicen-IDF), Lucie LACHENAL (Université Paris 1-HiCSA), Eléonore MARANTZ (Université Paris 1-HiCSA), Catherine MENEUX.</p>
				<br />
				<h4>Comité scientifique</h4>
				<p align="justify">Jean-Paul BOUILLON (PR émérite), Yves CHEVREFILS DESBIOLLES (IMEC), Franck DELORME (Cité de l’architecture et du patrimoine), Jean Philippe GARRIC (Université Paris 1-HiCSA), Thierry LAUGEE (Centre André Chastel), Natacha PERNAC (Ecole du Louvre), Michel POIVERT (HiCSA), Nolwenn RANNOU (Cité de l’architecture et du patrimoine), Didier SCHULMANN (Centre Georges Pompidou), Claude SCHVALBERG (Libraire).</p>
				<br />
				<h4>Modélisation et réalisation du système d’information</h4>
				<p align="justify">Orélie DESFRICHES DORIA (Université Lyon 3, ELICO), Gérald KEMBELLEC (CNAM, Dicen-IDF).</p>
				<br />
				<h4>Responsable numérique</h4>
				<p align="justify">Vincenzo CAPOZZOLI (Pôle images et technologies numériques, Paris 1).</p>
				<br />
				<h4>Dérveloppement du site web et graphisme</h4>
				<p align="justify">Perrine BALTZ, Juan-Mauro BOZZANO, Gérald KEMBELLEC.</p>
				<br />
				<h4>Vacations scientifiques</h4>
				<p align="justify">Anne-Sophie AGUILAR, Lucie LACHENAL.</p>
				<br />
				<h4>Vacations techniques</h4>
				<p align="justify">Thomas BUSCIGLIO. Esther JAKUBEC, Stéphanie PRENANT.</p>
				<br />
				<h4>Édition</h4>
				<p align="justify">Anne-Sophie AGUILAR, Hortense ALBISSON, Margaux AUTECHAUD, Andres AVILA GOMEZ, Fanny BACOT, Marion BALDENBERGER, Perrine BALTZ, Laurence BASSIERE,Thomas BEDERE, Indira BERAUD, Julien BOBOT, Lucie BRUGUIERE, Paula BRUZZI, Thomas BUSCIGLIO, Nicole CAPPELLARI, Aurélia CERVONI, Eléonore CHALLINE, Marines Erica CHAMPEAU, Emmanuelle CHAMPOMIER, Alexandra CHUSSEAU, Maud CHOINARD, Barbara DRAME, Caroline DUBOIS, Anna DUFOUR MONTUORI, Sarah DUCHEMIN, Emma DUMARTHERAY, Claire DUPIN, Julien FAURE-CONORTON, Lilie FAURIAC, Flaurette GAUTIER, Violette GIAQUINTO, Lauren GRAS ROBET, Anna HALTER, Laurent HUSSON, Esther JAKUBEC, Anemone JASEMIN, Lucie LACHENAL, Diane LE CORRE, Zoé LEPEULE, Marine NEDELEC, Cindy OLOHOU, Félix ORANGE, Candide PATRY-DELANGLE, Ophilia RAMNAUTH, Cathleen ROBITAILLE, Jessica RONCEAU, Andrea SCHELLINO, Elvira SHAHMIRI, Aphélandra SIASSIA, Fabienne STAHL, Pauline TEKATLIAN, Léonie THIROUX, Laura VALETTE, Véronique ZERATH.</p>
				<br />
				<h4>Remerciements à</h4>
				<p align="justify">Philippe DAGEN, Zinaïda POLIMENOVA, Jeanne Marie PORTEVIN.</p>
			</div>
			<div class="std__maincol">
				<h2 class="std__title">Présentation</h2>
				<div class="std__body">
					<p align="justify">
						Ce site est consacré aux auteurs francophones ayant exercé la critique d’art et actifs entre le milieu du XIX<sup>e</sup> siècle et l’Entre-deux-guerres. Les bornes chronologiques peuvent être étendues en fonction de l’activité de chaque critique, toujours considérée dans son ensemble. En effet, les critiques ayant débuté leur carrière dans l’Entre-deux-guerres ont souvent été actifs jusque dans les années 1970 et l’ensemble des références mis en ligne couvre une large période, du début du XIX<sup>e</sup> siècle au deuxième tiers du XX<sup>e</sup> siècle. Il prend en compte les auteurs pour lesquels des travaux de recherche approfondis ont permis de constituer une bibliographie primaire considérée comme complète. Il a pour but de la rendre accessible  à la communauté scientifique et au public et de valoriser la recherche dans ce domaine.
	                    <br>
	                    Non discriminant, puisqu’il ne prévoit pas de typologie ou de classement autre que le support de diffusion du texte (ouvrage, chapitre d’ouvrage, article), pluridisciplinaire, le site ne prétend pas à l’appréciation de la valeur critique du texte et privilégie une vision d’ensemble, la plus complète possible, de la production littéraire des auteurs concernés, quel que soit le champ (littérature, arts, politique, histoire, etc.) ou les médiums (photographie, cinéma, beaux-arts, architecture, etc.) sur lesquels leur regard s’est porté.
	                    <br>
	                    Portant sur les critiques d’art francophones, le site est susceptible d’accueillir des acteurs des scènes artistiques françaises, belges ou suisses, tout en prenant également en compte le contexte colonial. Les auteurs ayant écrit dans plusieurs langues seront également retenus.
				 	</p>
					<p align="justify">
						Ce site et cette base de données sont évolutifs. Ils ont vocation à être enrichis progressivement, aussi bien par l’ajout de nouveaux auteurs que par la complétion des bibliographies déjà   mises en ligne.
						<br>
						L’onglet « critiques » permet d’accéder à un répertoire alphabétique. Chaque page consacrée à un critique met à disposition des chercheurs trois documents .pdf : la bibliographie primaire la plus exhaustive possible, la littérature secondaire correspondante et un référencement des archives identifiées. Dans le cas particulier d’auteurs ayant principalement exercé une activité poétique ou littéraire pour lesquels une édition complète existe, seuls les écrits sur l’art sont recensés. Ce répertoire en ligne se double d’une base de données qui comprend les bibliographies primaires des critiques répertoriés dans le site (onglet « rechercher »). Elle permet ainsi de faire des recherches non seulement par nom, mais également par date, par revue ou par titre d’article. La base est interopérable avec les technologies du Web de données et donc interrogeables via Isidore, Hal et les outils comme Zotero ou Mendeley.
						<br>
						L’annuaire des chercheurs répertorie les coordonnées des chercheurs ayant collaboré à  une ou plusieurs pages consacrées à un critique, que ce soit pour la recherche et/ou l’édition, ou encore une expertise scientifique.
					</p>
                    
				</div>
			</div>
<?php
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
