<?php
header('Content-type: text/json');
header('Content-type: application/json');
$json = file_get_contents("http://viaf.org/viaf/AutoSuggest?term=Chartron") or die('ne peut charger');
$arr = json_decode(utf8_decode($json));
$json_propre = json_encode($arr, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
print($json_propre);
?>