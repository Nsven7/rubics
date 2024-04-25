<?php
try{
  $bdd = new PDO('mysql:host=localhost;dbname=rubics;charset=utf8', 'root', 'root');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Return an alert to each failed connection
  global $bdd; // Define globale variable to the data base
}

// Return an error message if the connection to the database fails
catch (\Exception $e){
 echo $e->getMessage();
}
