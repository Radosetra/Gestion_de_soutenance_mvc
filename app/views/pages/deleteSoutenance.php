<?php
require_once("../../models/soutenirModel.php");
require_once("../../config/database.php");
if(isset($_POST['id'])){
    $matricule = strval($_POST['id']);
    
    if(!Soutenir::delete($matricule)){
        die("Erreur suppression");
    }
}