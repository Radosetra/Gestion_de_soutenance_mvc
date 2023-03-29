<?php
require_once("../../models/professeursModel.php");
require_once("../../config/database.php");
if(isset($_POST['id'])){
    $id_prof = $_POST['id'];
    if(!Professeur::delete($id_prof)){
        die("Erreur suppression");
    }
}

