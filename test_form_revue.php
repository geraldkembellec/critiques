<?php
                session_start();
                include 'config.php';
                include 'lib_fonctions.php';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Document sans titre</title>
</head>

<body>
<form action="suite.php" method="get">
  <input list="titres_revues" name="titres_revues" size="100" maxlength="255">
  <datalist id="titres_revues">
    <?php
	affichierToutesLesRevuesFormOption();
	?>
  </datalist>
  <input type="submit">
</form>

</body>
</html>