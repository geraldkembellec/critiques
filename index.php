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

?>
 	<article class="std">
			<h2 class="std__title">
				Présentation</h2>
			<aside class="std__sidecol">
				<div class="std__sidebloc">
					<span class="label">Financement</span>
                    <div class="std__partner">
							<a href="http://labexcap.fr/">
								<img class="std__partnerlogo" src="logos/labex-logo_RVB_version-courte+mention.jpg" width="200" height="100" alt="Labex CAP" title="Logo Labex CAP">
							</a>
					</div>
                    <div class="std__partner">
							<a href="http://www.hesam.eu/">
								<img class="std__partnerlogo" src="logos/HeSam_logo.jpg" width="176" height="176" alt="Hésam Université" title="Logo Hésam Université">
							</a>
					</div>
                    <div class="std__partner">
							<a href="http://hicsa.univ-paris1.fr/">
								<img class="std__partnerlogo" src="logos/Logo_HiCSA.jpg" width="200" height="100" alt="HiCSA" title="Logo HiCSA">
							</a>
					</div>
                    <div class="std__partner">
							<a href="http://www.univ-paris1.fr/">
								<img class="std__partnerlogo" src="logos/Logo_Paris_1.jpg" width="200" height="100" alt="Université Paris_1" title="Logo Paris 1">
							</a>
					</div>
                </div>
				<div class="std__sidebloc">
					<span class="label">Partenaires</span>
							
							<div class="std__partner">
							<a href="http://www.citechaillot.fr/">
								<img class="std__partnerlogo" src="logos/Logo_cite_architecture_patrimoine.png" width="200" height="60" alt="Cite de l'architecture et du patrimoine" title="Logo de la Cite de l'architecture et du patrimoine">
							</a>
							</div>
                            <div class="std__partner">
							<a href="http://www.ecoledulouvre.fr/">
								<img class="std__partnerlogo" src="logos/logo_ecoledulouvre_format2.jpeg" width="200" height="60" alt="Logo École du Louvre" title="Logo École du Louvre">
							</a>
							</div>
                            <div class="std__partner">
							<a href="http://www.enc-sorbonne.fr/">
								<img class="std__partnerlogo" src="logos/logo-enc2.jpg" width="200" height="100" alt="École nationale des chartes" title="Logo École nationale des chartes">
							</a>
							</div>
						</div>			
				</aside>
				<div class="std__maincol">
					<div class="std__body">
					<!--<h3>Présentation</h3>-->
                    <p align="justify">Ce site est consacré aux auteurs francophones ayant exercé la critique d'art actifs entre le milieu du XIX<sup>e</sup> siècle et l'Entre-deux-guerres.&nbsp;Les bornes chronologiques peuvent être étendues en fonction de l'activité de chaque critique, toujours considérée dans son ensemble. En effet, les critiques ayant débuté leur carrière dans l'Entre-deux-guerres ont souvent été actifs jusque dans les années 1970 et l'ensemble des références mis en ligne couvre une large période, du début du XIX<sup>e</sup> siècle au deuxième tiers du X<sup>e</sup> siècle. Il prend en compte les auteurs pour lesquels des travaux de recherche approfondis ont permis de constituer une bibliographie primaire considérée comme complète. Il a pour but de la rendre accessible à la communauté scientifique et au public et de valoriser la recherche dans ce domaine.<br />
                      Non discriminant, puisqu'il ne prévoit pas de typologie ou de classement autre que le support de diffusion du texte (ouvrage, chapitre d'ouvrage, article), pluridisciplinaire, le site ne prétend pas à l'appréciation de la valeur critique du texte et privilégie une vision d'ensemble, la plus complète possible, de la production littéraire des auteurs concernés, quel que soit le champ (littérature, arts, politique, histoire, etc.) ou les médiums (photographie, cinéma, beaux-arts, architecture, etc.) sur lesquels leur regard s'est porté. <br />
                      Portant sur les critiques d'art francophones, le site est susceptible d'accueillir des acteurs des scènes artistiques françaises, belges ou suisses, tout en prenant également en compte le contexte colonial. Les auteurs ayant écrit dans plusieurs langues seront également retenus.<br />
                      Ce site et cette base de données sont évolutifs. Ils ont vocation à être enrichis progressivement, aussi bien par l'ajout de nouveaux auteurs que par la complétion des bibliographies déjà mises en ligne.</p>
                    <p align="justify">L'onglet «&nbsp;critiques&nbsp;» permet d'accéder à un <strong>répertoire alphabétique</strong>. Chaque page consacrée à un critique met à disposition des chercheurs trois documents .pdf&nbsp;: la <strong>bibliographie primaire</strong> la plus exhaustive possible, la <strong>littérature secondaire</strong> correspondante et un référencement des <strong>archives</strong> identifiées. Dans le cas particulier d'auteurs ayant principalement exercé une activité poétique ou littéraire pour lesquels une édition complète existe, seuls les écrits sur l'art sont recensés. </p>
                    <p align="justify">
                      Ce répertoire en ligne se double d'une <strong>base de données</strong> qui comprend les bibliographies primaires des critiques répertoriés dans le site (onglet «&nbsp;rechercher&nbsp;»). Elle permet ainsi de faire des recherches non seulement par nom, mais également par date, par revue ou par titre d'article. La base est interopérable avec les technologies du Web de données et donc interrogeables <em>via</em> Isidore, Hal et les outils comme Zotero ou Mendeley.<br />
  <strong>L'annuaire des chercheurs</strong> répertorie les coordonnées des chercheurs ayant collaboré à une ou plusieurs pages consacrées à un critique, que ce soit pour la recherche et/ou l'édition, ou encore une expertise scientifique.</p>
<hr />
<h3>Équipe</h3>
<h4>Responsables du programme</h4>
<p align="justify">
  Marie Gispert (Université Paris 1 Panthéon-Sorbonne-HiCSA), Catherine Méneux (Université Paris 1 Panthéon-Sorbonne-HiCSA).</p>
<h4>Comité d'organisation&nbsp;</h4>
<p align="justify">Anne-Sophie Aguilar (Labex CAP-HiCSA); Marie Gispert; Gérald Kembellec (CNAM, Dicen-IDF); Lucie Lachenal (Université Paris 1-HiCSA); Eléonore Marantz (Université Paris 1 Panthéon Sorbonne-HiCSA); Catherine Méneux; Eléonore Challine (ENS Cachan); Christophe Gauthier (Ecole nationale des Chartes).</p>

<h4>Comité scientifique</h4>
<p align="justify"> Jean-Paul Bouillon (PR émérite); Yves Chevrefils Desbiolles (IMEC); Franck Delorme (Cité de l'architecture et du patrimoine); Jean Philippe Garric (Université Paris 1-HiCSA); Thierry Laugée (Centre André Chastel); Natacha Pernac (Ecole du Louvre); Michel Poivert (HiCSA); Nolwenn Rannou (Cité de l'architecture et du patrimoine); Didier Schulmann (Centre Georges Pompidou); Claude Schvalberg (Libraire).</p>
<h4>Modélisation du système d'information&nbsp;</h4>
<p align="justify">Orélie Desfriches Doria (Université Lyon 3, ELICO); Gérald Kembellec (CNAM, Dicen-IDF).</p>
<h4>Réalisation du système d'information&nbsp;</h4>
<p align="justify">Gérald Kembellec (CNAM, Dicen-IDF).</p>
<h4>Responsable Pôle numérique, Paris 1&nbsp;</h4><p>Vincenzo Capozzoli.</p>
<h4>Graphisme&nbsp;</h4>
<p align="justify">Perrine Baltz.</p>
<h4>Vacations scientifiques</h4>
<p align="justify">Anne-Sophie Aguilar, Lucie Lachenal.</p>
<h4>Vacations techniques</h4>
<p align="justify">Thomas Busciglio. Esther Jakubec, Stéphanie Prenant.</p>
<h4>Édition</h4>
<p align="justify">Anne-Sophie Aguilar, Hortense Albisson, Margaux Autechaud, Andres Avila Gomez, Fanny Bacot, Marion Baldenberger, Perrine Baltz, Laurence Bassière, Thomas Bedere, Indira Beraud, Julien Bobot, Lucie Bruguiere, Paula Bruzzi, Thomas Busciglio, Nicole Cappellari, Aurélia Cervoni, Éléonore Challine, Marine Erica Champeau, Emmanuelle Champomier, Alexandra Chusseau, Maud Choinard, Barbara Drame, Caroline Dubois, Anna Dufour Montuori, Sarah Duchemin, Emma Dumartheray, Claire Dupin, Julien Faure-Conorton, Lilie Fauriac, Flaurette Gautier, Violette Giaquinto, Lauren Gras Robet, Anna Halter, Laurent Husson, Esther Jakubec, Anemone Jasemin, Lucie Lachenal, Diane Le Corre, Zoé Lepeule, Marine Nedelec, Cindy Olohou, Félix Orange, Candide Patry, Ophilia Ramnauth, Cathleen Robitaille, Jessica Ronceau, Andrea Schellino, Elvira Shahmiri, Aphélandra Siassia, Fabienne Stahl, Pauline Tekatlian, Léonie Thiroux, Laura Valette, Véronique Zerath.</p>
<h4>Remerciements à</h4>
<p align="justify">
Philippe Dagen, Zinaïda Polimenova, Jeanne Marie Portevin.
</p>
				</div>
			</div>
<?php
	echo $fin_article;
	echo $fin_main;
	echo $footer;
	echo $fin_container;
?>