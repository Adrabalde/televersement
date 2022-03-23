<?php

require_once 'db.php';
// Recupérer le contenu 
// Formater le texte et masquer les apostrophes
$contenu= $dbConn->real_escape_string($_POST['contenu']);
// Recupérer date system dans la variable $date
$date= date("d-m-Y H:i:s");

// Une requête pour insérer le nouveau commentaire 
$sql = "insert into commentaire(contenu,date) values('$contenu','$date')";
// Exécution de la requête 
$result = dbQuery($sql);
// Redirection vers la page d'accueil 
header('location:index.php');




//End of file