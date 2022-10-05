<?php 

//configuration de la base de donnée
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "recherche"; 
 
// création de la connexion
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// vérifier la connexion
if ($db->connect_error) { 
    die("erreur de connexion: " . $db->connect_error); 
}
 
// Récupérer les éléments de la base de données 
$query = $db->query("SELECT * FROM data ORDER BY id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "stagiaires" . date('Y-m-d') . ".csv"; 
     
    // créer un dossier
    $f = fopen('php://memory', 'w'); 
     
    // Définir les en-têtes de colonne 
    $fields = array('NOM', 'PRENOM', 'email', 'dateInscription', 'nombreLecons', ' nombrechapitres ', ' nombreModules ', 'nombrePoints', 'nombreQuizz','derniereConnexion'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Sortie de chaque ligne de données, conversion de la ligne en csv et écriture dans le dossier du fichier. 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['id'], $row['nom'], $row['prenom'], $row['email'],$row['inscription'], $row['lecons'], $row['modules'], $row['chapitres'],$row['quizz'],$row['points'],$row['dercon']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Retourner au début du fichier 
    fseek($f, 0); 
     
    // Définir les en-têtes pour télécharger le fichier plutôt que de les afficher 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //sortie de toutes les données restantes sur le dossier du fichier 
    fpassthru($f); 
} 
exit; 
 
?>