<?php

session_start();
// Le dossier destinataire
$dossier_dest = "telechargement/";
// Le chemin absolu
$fichier_uploade = $dossier_dest . basename($_FILES["fichier"]["name"]);
$fichier_taille = $_FILES["fichier"]["size"];
$fichier_type = $_FILES["fichier"]["type"];

$televerseOk = 1;

$typedefichier = strtolower(pathinfo($fichier_uploade,PATHINFO_EXTENSION));

// Vérifier si le fichier existe déjà
if (file_exists($fichier_uploade)) {
  echo " Désolé le fichier existe déjà.";
  $_SESSION['message'] = "Désolé le fichier existe déjà." ;
  $televerseOk  = 0;
 // header('location:index.php', TRUE, 301);

}

// Autoriser seulement les images de type : jpeg, pgng
if($typedefichier != "jpg" && $typedefichier != "png" && $typedefichier != "jpeg"
&& $typedefichier != "pgng") {
  echo " Désolé seulement les formats jpeg, pgng sont accepetés";
  $_SESSION['message'] = "Désolé seulement les formats jpeg, pgng sont accepetés." ;

  $televerseOk = 0;
 // header('location:index.php', TRUE, 301);

}
// La taille max autorisée est : 5
if ($_FILES["fichier"]["size"] > 5000000) {
  echo " Désolé le fichier est trop volumineux";
  $_SESSION['message'] = "Désolé le fichier est trop volumineux" ;

  $televerseOk   = 0;
 // header('location:index.php', TRUE, 301);

}

// Vérifier si le televersersement est autorisé ou non 
if ($televerseOk  == 0) {
  echo " Désolé le fichier n'est pas televersé";
 // $_SESSION['message'] = "Désolé le fichier n'est pas televersé" ;
 
  
 // header('location:index.php', TRUE, 301);

// Si le televersement est autorisé
} else {
  if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $fichier_uploade)) {
    echo "Le fichier ". htmlspecialchars( basename( $_FILES["fichier"]["name"])). " est bien televersé";


    require_once 'db.php';

    // Recupérer date system dans la variable $date
    $date= date("d-m-Y H:i:s");
   $nomFichier=  htmlspecialchars( basename( $_FILES["fichier"]["name"]));

    // Une requête pour insérer le nouveau commentaire 
    $sql = "insert into fichier(nom,taille, type) values('$nomFichier', '$fichier_taille', '$fichier_type')";
    // Exécution de la requête 
    $result = dbQuery($sql);
    // Redirection vers la page d'accueil 
    $_SESSION['message'] = "Le fichier est bien televersé" ;

  } else {
    echo " Désolé il y'a un problème au moment de televersement";
    $_SESSION['message'] = "Désolé il y'a un problème au moment de televersement" ;

    
  }
  //header('location:index.php', TRUE, 301);

}
header('location:index.php', TRUE);

?>