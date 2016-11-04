<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>pageauteurcollectif</title>
    <script language="javascript">

            function cacher(article) {
                    document.getElementById(article).style.visibility="hidden";
                    document.getElementById(article).style.display="none";
            }

            function afficher(article) {
                    //alert(article);
                    document.getElementById(article).style.visibility="visible";
                    document.getElementById(article).style.display="block";
            }
            </script>
</head>
<body>      
    
        <form method="GET" action="action_page.php">
        <h1>Vous êtes dans l'espace de saisie</h1>
            <fieldset>
                <legend><em><b>Saisie d'un chapitre d'ouvrage général</b></em></legend>
                
                    Rechercher le Titre de l'ouvrage<br>
                        <br>
                        <input type="text" name="Titre de l'ouvrage" autocomplete default: on />
                        <br>
                        <br>
                            <br>
                            <input type="submit" value="valider le choix de l'ouvrage">
                            <br>
                            <br>  
                    <button type="button"
                    onclick="javascript:afficher('nouvelouvrage')">je ne trouve pas l'ouvrage dans la liste</button>
                    <br>

                <!--caché-->

                <pre id="nouvelouvrage" style="visibility: hidden; display:none;" >

                    <h2> Vous allez saisir un nouvel ouvrage</h2>
                        Titre de l'ouvrage<br>
                        <input type="text" name="Titre de l'ouvrage" />
                        <br>
                        <br> 
                    Sous-Titre de l'ouvrage<br>
                        <input type="text" name="Sous-Titre de l'ouvrage" />
                        <br>
                        <br>
                    Coordination de l'ouvrage<br>
                        <input type="text" name="Coordination de l'ouvrage" />
                        <br>
                        <br>
                    Collection de l'ouvrage<br>
                        <input type="text" name="Collection de l'ouvrage" />
                        <br>
                        <br> 
                    Année de publication
                    <br>
                        <input type="number" name="Année de naissance"
                                
                                onkeypress="return isNumeric(event)"
                                oninput="maxLengthCheck(this)"
                                type = "number"
                                maxlength = "4"
                               />

                            <script>
                              function maxLengthCheck(object) {
                                if (object.value.length > object.maxLength)
                                  object.value = object.value.slice(0, object.maxLength)
                              }
                                
                              function isNumeric (evt) {
                                var theEvent = evt || window.event;
                                var key = theEvent.keyCode || theEvent.which;
                                key = String.fromCharCode (key);
                                var regex = /[0-9]|\./;
                                if ( !regex.test(key) ) {
                                  theEvent.returnValue = false;
                                  if(theEvent.preventDefault) theEvent.preventDefault();
                                }
                              }
                            </script>   
                        <br>
                        <br>
                        Lieu d'édition<br>
                        <input type="text" name="Lieu d'édition" />
                        <br> 
                        <br>
                        ISBN<br>
<!--le script utilisé ne permet pas de mettre des espaces ni des tirets entre les 5 segments de chiffres qui composent l'ISBN, à revoir -->  

                        <input type="number" name="ISNI" 
                                
                                onkeypress="return isNumeric(event)"
                                oninput="maxLengthCheck(this)"
                                type = "number"
                                maxlength = "19"
                               />

                        <script>
                              function maxLengthCheck(object) {
                                if (object.value.length > object.maxLength)
                                  object.value = object.value.slice(0, object.maxLength)
                              }
                                
                              function isNumeric (evt) {
                                var theEvent = evt || window.event;
                                var key = theEvent.keyCode || theEvent.which;
                                key = String.fromCharCode (key);
                                var regex = /[0-9]|\./;
                                if ( !regex.test(key) ) {
                                  theEvent.returnValue = false;
                                  if(theEvent.preventDefault) theEvent.preventDefault();
                                }
                              }
                        </script>
                        <br>
                        <br>
                        <input type="submit" value="valider la saisie de l'ouvrage">
                        <br>
                        <br> 
                        <button type="button"
                        onclick="javascript:cacher('nouvelouvrage')">fermer</button>
                        <br>       
                    </pre>

            </fieldset>
            <br>
            <br>
            <fieldset>
                <legend>Saisie d'un chapitre dans un ouvrage général</legend><br>

                    <h2> Vous allez saisir un nouveau chapitre d'ouvrage</h2>
                        Titre du chapitre<br>
                        <input type="text" name="Titre du chapitre" />
                        <br>
                        <br> 
                        Complément de titre du chapitre<br>
                        <input type="text" name="Complément de titre du chapitre" />
                        <br>
                        <br>
                        Pagination
                        <br>
                        <input type="number" name="Nombre de pages" maxlength = "4"/>
                        <br>
                        <br>                
                        <h3> Renseigner l'attribution du texte à l'auteur</h3><br>                              
                            <input type="radio" name="Attribué" value="Attribué">Attribué   
                            <input type="radio" name="Certifié" value="Certifié">Certifié
                            <br>
                            <br>
                            <input type="submit" value="valider la saisie de la Notice">
                            <br>
                            <br> 
            </fieldset>
        </form>
    
    </body>
</html>