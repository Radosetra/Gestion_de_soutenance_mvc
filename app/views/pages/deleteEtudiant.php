<?php
require_once("../../models/etudiantsModel.php");
require_once("../../config/database.php");
if(isset($_POST['id'])){
    $matricule = $_POST['id'];
    if(!Etudiant::delete($matricule)){
        die("Erreur suppression");
    }
}

