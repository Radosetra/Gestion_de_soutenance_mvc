<?php
require_once("../../models/etudiantsModel.php");
require_once("../../config/database.php");

$allEtudiants = null;
$allKeyEtudiants = null;
if(isset($_GET['searchEngine'])){
  // $allEtudiants = array(Etudiant::searchEngine($_GET['searchEngine']));
  $allEtudiants = Etudiant::searchEngine($_GET['searchEngine']);
  if(!empty($allEtudiants)){
    $allKeyEtudiants = array_keys($allEtudiants[0]);
  }
} else if (isset($_GET['filtre'])){

} else {
  $allEtudiants = Etudiant::readAll();
  $allKeyEtudiants = array_keys($allEtudiants[0]);
}

require_once("../layout/header.php");
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Liste des étudiants</h1>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-6 ml-auto" style="width: 400px;">
          <form action="afficheEtudiant.php" method="GET">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Rechercher par matricule ou par nom" name="searchEngine">
              <!-- <select class="form-select mr-0" aria-label="Filtre de recherche">
                <option selected>Filtre...</option>
                <option value="nom">Matricule</option>
                <option value="prenom">Nom & Prenom</option>
                <option value="email"></option>
              </select> -->
              <button class="btn btn-outline-secondary" type="submit" >
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">

          <!-- general form elements -->
          <div class="card">

            <div class="card-body">
              <table class="table">
                <?php 
                if (!empty($allEtudiants)):
                ?>
                <thead>
                  <tr>
                    <?php
                    foreach ($allKeyEtudiants as $key) {
                      echo "<th scope='col'>$key</th>";
                    }
                    ?>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($allEtudiants as $rows) {
                    echo "<tr>";
                    foreach ($rows as $rowElem) {
                      echo "<td scope='col'>$rowElem</td>";
                    }
                    $btnCol =
                      "<td scope='col'>
                    <button type='button' class='btn btn-primary btn-md editBtn' data-num=\"" . $rows['matricule'] . "\"><i class=\"fas fa-edit\"></i></button>
                    <button type=\"button\" class=\"btn btn-danger btn-md deleteBtn\" data-num=\"" . $rows['matricule'] . "\"><i class=\"fas fa-trash\"></i></button>
                    </td>";
                    echo $btnCol;
                    echo "</tr>";
                  }
                  ?>
                <?php 
                else:
                ?>
                <h1>Aucun resultat</h1>
                <?php 
                endif;
                ?>
                </tbody>
              </table>
            </div>

          </div>
          <!-- !general element -->
        </div>

      </div>
    </div>
  </section>
</div>
<?php
require_once("../layout/footer.php");
?>