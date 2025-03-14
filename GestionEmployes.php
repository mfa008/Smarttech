<?php
include 'config.php';
$sql = "SELECT id, nom, prenom, email, poste, departement, date_embauche FROM employes";
$result = $conn->query($sql); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Système de Gestion - Employés</title>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    rel="stylesheet" />
  <style>
    :root {
      --primary-color: #0d6efd;
      --secondary-color: #6c757d;
      --accent-color: #0dcaf0;
      --light-blue: #cfe2ff;
      --dark-blue: #084298;
    }

    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: var(--dark-blue);
    }

    .navbar-brand,
    .nav-link {
      color: white !important;
    }

    .card {
      border-color: var(--primary-color);
      margin-bottom: 20px;
    }

    .card-header {
      background-color: var(--primary-color);
      color: white;
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .btn-primary:hover {
      background-color: var(--dark-blue);
      border-color: var(--dark-blue);
    }

    .footer {
      background-color: var(--dark-blue);
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }

    .page-header {
      background: linear-gradient(135deg,
          var(--primary-color),
          var(--dark-blue));
      color: white;
      padding: 30px 0;
      margin-bottom: 30px;
    }

    .table thead {
      background-color: var(--primary-color);
      color: white;
    }

    .action-buttons .btn {
      margin-right: 5px;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
  </style>
</head>

<body>
  <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Système de Gestion</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Employés</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Clients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Documents</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- En-tête de page -->
  <div class="page-header">
    <div class="container">
      <h1>Gestion des Employés</h1>
      <p>Ajouter, modifier et supprimer des employés</p>
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Liste des employés</h5>
            <button
              class="btn btn-light"
              data-bs-toggle="modal"
              data-bs-target="#addEmployeeModal">
              <i class="fas fa-plus-circle"></i> Nouvel employé
            </button>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Rechercher un employé..." />
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 text-end">
                <div class="btn-group">
                  <button type="button" class="btn btn-outline-primary">
                    <i class="fas fa-filter"></i> Filtrer
                  </button>
                  <button type="button" class="btn btn-outline-primary">
                    <i class="fas fa-download"></i> Exporter
                  </button>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Poste</th>
                    <th>Département</th>
                    <th>Date d'embauche</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['poste']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['departement']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['date_embauche']) . "</td>";
                      echo "<td class='action-buttons'>
          <button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#viewEmployeeModal'>
              <i class='fas fa-eye'></i>
          </button>
          <button class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editEmployeeModal'>
              <i class='fas fa-edit'></i>
          </button>
          <button class='btn btn-sm btn-danger' onclick='confirmDelete(" . $row["id"] . ")'>
              <i class='fas fa-trash'></i>
          </button>
      </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='8' class='text-center'>Aucun employé trouvé</td></tr>";
                  }
                  // Fermer la connexion
                  $conn->close();
                  ?>

                </tbody>
              </table>
            </div>

            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a
                    class="page-link"
                    href="#"
                    tabindex="-1"
                    aria-disabled="true">Précédent</a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Suivant</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ajouter Employé -->
  <div
    class="modal fade"
    id="addEmployeeModal"
    tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Ajouter un employé</h5>
          <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action='traitementCreationEmploye.php' method='POST'>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="firstName" class="form-label">Prénom</label>
                <input
                  type="text"
                  name="prenom"
                  class="form-control"
                  id="firstName"
                  required />
              </div>
              <div class="col-md-6">
                <label for="lastName" class="form-label">Nom</label>
                <input
                  type="text"
                  name="nom"
                  class="form-control"
                  id="lastName"
                  required />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                  name="email"
                  class="form-control"
                  id="email"
                  required />
              </div>
              <!-- <div class="col-md-6">
                  <label for="phone" class="form-label">Téléphone</label>
                  <input type="tel" class="form-control" id="phone" />
                </div>
              </div> -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="position" class="form-label">Poste</label>
                  <input
                    type="text"
                    name="poste"
                    class="form-control"
                    id="position"
                    required />
                </div>
                <div class="col-md-6">
                  <label for="department" class="form-label">Département</label>
                  <select name="departement" class="form-select" id="department" required>
                    <option value="">Sélectionnez...</option>
                    <option value="IT">IT</option>
                    <option value="Marketing">Marketing</option>
                    <option value="RH">RH</option>
                    <option value="Finance">Finance</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="hireDate" class="form-label">Date d'embauche</label>
                  <input
                    type="date"
                    class="form-control"
                    id="hireDate"
                    required
                    name="date_embauche" />
                </div>
                <div class="col-md-6">
                  <label for="salary" class="form-label">Salaire</label>
                  <input
                    type="number"
                    class="form-control"
                    id="salary"
                    name="salaire"
                    required />
                </div>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <textarea class="form-control" id="address" rows="3"></textarea>
              </div>
              <input
                type="submit"
                value="Enregistrer"
                class="btn btn-primary" />
          </form>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Annuler
          </button>
          <!-- <button type="submit" class="btn btn-primary">Enregistrer</button> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Pied de page -->
  <footer class="footer">
    <div class="container text-center">
      <p>© 2025 Système de Gestion. Tous droits réservés.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    function confirmDelete(id) {
      if (confirm("Voulez-vous vraiment supprimer cet employé ?")) {
        window.location.href = "supprimerEmploye.php?id=" + id;
      }
    }
  </script>
</body>

</html>