<?php


	// Connexion sur la base de données 
	// En utilisant l'extension Mysqli

// $dbConn = mysqli_connect('localhost', 'root', '', 'pagination') or die('MySQL connect failed. ' . mysqli_connect_error());
$dbConn = new mysqli('localhost', 'root', '', 'pagination') ;

    // Fonction pour exécuter une requête SQL 
	// Retourner le resultat 
function dbQuery($sql) {
	global $dbConn;   
	$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	return $result;
}
    // Pour chercher au niveau du resultat d'une requête SQL
function dbFetchAssoc($result) {
	return mysqli_fetch_assoc($result);
}
    // Fermer une connexion  
function closeConn() {
	global $dbConn;
	mysqli_close($dbConn);
}
	
