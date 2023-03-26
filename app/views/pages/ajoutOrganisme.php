<?php
require_once("../../models/organismesModel.php");
require_once("../../config/database.php");

// Verifier si la variable post est definit
require_once("../../functions/isVariableSet.php");
$isDevine = isVariableSet($_POST,['id_org', 'design', 'lieu']);
//Traitements
if($isDevine){
    $organisme = new Organisme($_POST['id_org'], $_POST['design'], $_POST['lieu'], true);
    if($organisme->create()){
        // header('Location: index.php');
        // Note : fonction header dois etre appeler avant d'ecrire du html
        header('Location: /app/views/pages/afficheOrganisme.php');
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
          <h1 class="m-0">Ajouter un Organisme</h1>
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
                  <label for="id_org">Identifiant</label>
                  <input type="number" class="form-control" id="id_org" name="id_org" placeholder="Enter identifiant" required>
                </div>
                <div class="form-group">
                  <label for="design">Designation</label>
                  <input type="text" class="form-control" id="design" name="design" required placeholder="Enter Designation">
                </div>
                <div class="form-group">
                  <label for="lieu">Lieu</label>
                  <input type="text" class="form-control" id="lieu" name="lieu" required placeholder="Enter l'emplacement de l'organisme">
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