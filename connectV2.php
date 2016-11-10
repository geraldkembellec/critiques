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
	echo $debut_article;
?>
<body>					
	<div id="connexion"> 
	<?php
		if(isset($_POST['username']) && isset($_POST['password'])){
			//echo 'Level1';
			$login=$_POST['username'];
			$password=$_POST['password'];
			if(testLogin($login,$password,$users)){
				session_start();
				$_SESSION['user'] = $_POST['username'];
				$_SESSION['level'] = $users[$_SESSION['user']]['level'];
				$_SESSION['label'] = $users[$_SESSION['user']]['label'];
				//echo "Bonjour ". $_SESSION['user']; 
				//print_r($_SESSION);
				echo '<script language="javascript">document.location.replace("index.php");</script>';       
			 } else { // Sinon
				echo "<div class=\"form_error_message\">Les informations saisies sont inexactes.</div>";
			 }
		}
		
		if(!isset($_SESSION['user'])){
			$form.='<div class="container connect_page">
			  <h2 style="font-size: 18px;">Se connecter</h2>
			  <form class="connect_form" role="form" method="post" action="connectV2.php">
			    <div class="form_group">
			      <label class="form_control" for="username">Nom d\'utilisateur : </label>
			      <div class="form_input_div">
					<input type="text" class="form_control" id="username" name="username" placeholder="Entrez votre nom d\'utilisateur">
			      </div>
			    </div>
			    <div class="form_group">
			      <label class="form_control" for="password">Mot de passe :</label>
			      <div class="form_input_div">          
			        <input type="password" class="form_control" name="password" id="password" placeholder="Entrez votre mot de passe">
			      </div>
			    </div>
			    <div class="form_group">        
			      <div class="col-sm-offset-2 col-sm-10">
			        <div class="checkbox">
			          <label><input type="checkbox">Se souvenir</label>
			        </div>
			      </div>
			    </div>
			    <div class="form_group">        
			      <div class="col-sm-offset-2 col-sm-10">
			        <button type="submit" class="btn btn-default">Connexion</button>
			      </div>
			    </div>
			  </form>
			</div>';
			echo $form;
		}
	?>
	</div>
<?php
	echo $fin_article;
	echo $footer;
	echo $fin_container;
?>
