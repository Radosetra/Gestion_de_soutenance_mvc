<?php

require_once 'models/Etudiant.php';
require_once("functions/isVariableSet.php");
// Connexion base de donnee
require_once("../../config/database.php");

class EtudiantController
{
    public function index()
    {
        // Récupérer tous les étudiants depuis la base de données
        $allEtudiants = Etudiant::readAll();
        
        $allKeyEtudiants = array_keys($allEtudiants[0]);

        // Charger la vue pour afficher la liste des étudiants
        require_once '../views/pages/etudiants/afficheEtudiant.php';
    }

    public function create()
    {
        // Charger la vue pour afficher le formulaire d'ajout d'un étudiant
        require_once 'views/etudiants/ajouterEtudiant.php';
    }

    public function store()
    {
        // Verifier si la variable post est definit
        
        $isDevine = isVariableSet($_POST, ['matricule', 'nom_etudiant', 'prenom_etudiant', 'niveau', 'parcours', 'adr_email']);
        //Traitements
        if ($isDevine) {
            $etudiant = new Etudiant($_POST['matricule'], $_POST['nom_etudiant'], $_POST['prenom_etudiant'], $_POST['niveau'], $_POST['parcours'], $_POST['adr_email'], true);
            if ($etudiant->create()) {
                // success
            } else {
                echo "<div class='alert alert-danger'>Echec</div>";
            }
        }

        // Rediriger l'utilisateur vers la liste des étudiants
        header('Location: /app/views/pages/afficheEtudiant.php');
    }

    public function edit()
    {
        // Récupérer l'identifiant de l'étudiant à modifier
        // $_GET['id'];

        // Récupérer l'étudiant correspondant depuis la base de données
        $etudiant = Etudiant::getEtudiant($_GET['matricule']);

        // Charger la vue pour afficher le formulaire de modification de l'étudiant
        require_once 'views/etudiants/edit.php';

        // affidher ny view anaovana edit avec champs fenoina aminy alalany $etudiant d rhf soumettre edit iz d anstoina ny methode update
    }

    public function update()
    {
        // Récupérer les données du formulaire de modification d'un étudiant

        // Mettre à jour l'étudiant correspondant dans la base de données
        if(Etudiant::update($_POST['id'],$_POST)){

        }else {
            // echec
        }
        

        // Rediriger l'utilisateur vers la liste des étudiants
        header('Location: /app/views/pages/afficheEtudiant.php');
    }

    public function delete()
    {
        // Récupérer l'identifiant de l'étudiant à supprimer
        

        // Supprimer l'étudiant correspondant dans la base de données
        Etudiant::delete($_POST['matricule']);
        // $etudiant->delete();

        // Rediriger l'utilisateur vers la liste des étudiants
        header('Location: /app/views/pages/afficheEtudiant.php');
    }

    public function show(){
        // mampiseo etudiant ray
        if(isset($_POST['matricule']) || isset($_POST[''])){
            $allEtudiants = Etudiant::getEtudiant($_POST);
            $allKeyEtudiants = array_keys($allEtudiants[0]);   
            if($allEtudiants){
                require_once("/views/afficheEtudiant.php");
            } else {
                // etudiant introuvable
            }
        } else {
            // redirection vers la page d'acceille
        }
    }
}
