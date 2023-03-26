<?php 
require_once("../../models/professeursModel.php");
// Connexion base de donnee
require_once("../../config/database.php");

// Verifier si la variable post est definit
require_once("../../functions/isVariableSet.php");
$isDevine = isVariableSet($_POST,['id_prof', 'nom_prof', 'prenom_prof', 'civilite', 'grade']);
//Traitements
if($isDevine){
    $professeur = new Professeur($_POST['id_prof'], $_POST['nom_prof'], $_POST['prenom_prof'], $_POST['civilite'], $_POST['grade'],true);
    if($professeur->create()){
        // header('Location: index.php');
        header('Location: /app/views/pages/afficheProf.php');
    }else{
        echo "<div class='alert alert-danger'>Echec</div>";
    }
}

require_once("../layout/header.php");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ajouter un Professeur</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_prof">Identifiant du professeur</label>
                                    <input type="text" class="form-control" id="id_prof" name="id_prof" placeholder="Enter Matricule" required>
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom_prof" required placeholder="Enter nom">
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prenom(s)</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom_prof" required placeholder="Enter prenom">
                                </div>
                                <div class="form-group">
                                    <label for="civilite">Civilite</label>
                                    <select class="form-select form-control" name="civilite" id="civilite" required>
                                      <option value="Mr">Mr</option>
                                      <option value="Mme">Mdme</option>
                                      <option value="Mlle">Mlle</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" class="form-control" name="grade" id="grade" required placeholder="Enter le grade">
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php 
require_once("../layout/footer.php");
?>