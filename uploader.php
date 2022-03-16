<?php
// Le dossier destinataire
$dossier_dest = "telechargement/";
// Le chemin absolu
$fichier_uploade = $dossier_dest . basename($_FILES["fichier"]["name"]);

$televerseOk = 1;

$typedefichier = strtolower(pathinfo($fichier_uploade,PATHINFO_EXTENSION));

// Vérifier si le fichier existe déjà
if (file_exists($fichier_uploade)) {
  echo " Désolé le fichier existe déjà.";
  $televerseOk  = 0;
}

// Autoriser seulement les images de type : jpeg, pgng
if($typedefichier != "jpg" && $typedefichier != "png" && $typedefichier != "jpeg"
&& $typedefichier != "pgng") {
  echo " Désolé seulement les formats jpeg, pgng sont accepetés";
  $televerseOk = 0;
}
// La taille max autorisée est : 5M
if ($_FILES["fichier"]["size"] > 5000000) {
  echo " Désolé le fichier est trop volumineux";
  $televerseOk   = 0;
}

// Vérifier si le televersersement est autorisé ou non 
if ($televerseOk  == 0) {
  echo " Désolé le fichier n'est pas televersé";
// Si le televersement est autorisé
} else {
  if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $fichier_uploade)) {
    echo "Le fichier ". htmlspecialchars( basename( $_FILES["fichier"]["name"])). " est bien televersé";


    require_once 'db.php';

    // Recupérer date system dans la variable $date
    $date= date("d-m-Y H:i:s");
   $nomFichier=  htmlspecialchars( basename( $_FILES["fichier"]["name"]));

    // Une requête pour insérer le nouveau commentaire 
    $sql = "insert into fichier(nom,chemin,date) values('$nomFichier', '$fichier_uploade', '$date')";
    // Exécution de la requête 
    $result = dbQuery($sql);
    // Redirection vers la page d'accueil 
    header('location:index.php');

  } else {
    echo " Désolé il y'a un problème au moment de televersement";
  }
}
?>