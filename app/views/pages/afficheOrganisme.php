<?php
require_once("../../models/organismesModel.php");
require_once("../../config/database.php");
$allOrganisme = Organisme::readAll();
$allKeyOrganismes = array_keys($allOrganisme[0]);
require_once("../layout/header.php");
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Liste des Organismes</h1>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-6 ml-auto" style="width: 400px;">
          <form action="" POST="">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Rechercher">
              <select class="form-select mr-0" aria-label="Filtre de recherche">
                <option selected>Filtre...</option>
                <option value="id_org">Identifiant</option>
                <option value="design">Designation</option>
                <option value="lieu">Lieu</option>
              </select>
              <button type="submit" class="btn btn-outline-secondary" type="button">
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
                <thead>
                  <tr>
                    <?php
                    foreach ($allKeyOrganismes as $key) {
                      echo "<th scope='col'>$key</th>";
                    }
                    ?>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($allOrganisme as $rows) {
                    echo "<tr>";
                    foreach ($rows as $rowElem) {
                      echo "<td scope='col'>$rowElem</td>";
                    }
                    $btnCol =
                    "<td scope='col'>
                    <button type='button' class='btn btn-primary btn-md editBtn' data-num=\"" . $rows['Identifiant'] . "\"><i class=\"fas fa-edit\"></i></button>
                    <button type=\"button\" class=\"btn btn-danger btn-md deleteBtn\" data-num=\"" . $rows['Identifiant'] . "\"><i class=\"fas fa-trash\"></i></button>
                    </td>";
                    echo $btnCol;
                    echo "</tr>";
                  }
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