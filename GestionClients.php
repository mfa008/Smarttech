<?php
include 'config.php';
$sql = "SELECT idclient, societe, contact, email, telephone, date_ajout FROM client";
$result = $conn->query($sql); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Système de Gestion - Clients</title>
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

    .client-card {
      transition: transform 0.3s;
    }

    .client-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .client-card .card-header {
      background-color: var(--primary-color);
      color: white;
    }

    .tabs-container .nav-tabs .nav-link {
      color: var(--primary-color);
    }

    .tabs-container .nav-tabs .nav-link.active {
      color: var(--dark-blue);
      font-weight: bold;
      border-bottom: 3px solid var(--primary-color);
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
            <a class="nav-link" href="#">Employés</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Clients</a>
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
      <h1>Gestion des Clients</h1>
      <p>Suivez et gérez vos relations avec les clients</p>
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="container">
    <!-- Options de vue -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Rechercher un client..." />
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 text-end">
                <div class="btn-group" role="group">
                  <button
                    type="button"
                    class="btn btn-outline-primary active"
                    id="tableViewBtn">
                    <i class="fas fa-list"></i> Vue Liste
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-primary"
                    id="cardViewBtn">
                    <i class="fas fa-th-large"></i> Vue Carte
                  </button>
                </div>
                <button
                  class="btn btn-primary ms-2"
                  data-bs-toggle="modal"
                  data-bs-target="#addClientModal">
                  <i class="fas fa-plus-circle"></i> Nouveau Client
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Vue tableau (par défaut) -->
    <div class="row" id="tableView">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Liste des clients</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Société</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date d'ajout</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['idclient']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['societe']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['date_ajout']) . "</td>";
                      echo "<td class='action-buttons'>
                                        <button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#viewClientModal'>
                                            <i class='fas fa-eye'></i>
                                        </button>
                                        <button class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editClientModal'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                        <button class='btn btn-sm btn-danger' onclick='confirmDelete(" . $row['idclient'] . ")'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7' class='text-center'>Aucun client trouvé</td></tr>";
                  }
                  $conn->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="addClientModal"
      tabindex="-1"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Ajouter un client</h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action='traitementCreationClient.php' method='POST'>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="firstName" class="form-label">Societe</label>
                  <input
                    type="text"
                    name="societe"
                    class="form-control"
                    id="firstName"
                    required />
                </div>
                <div class="col-md-6">
                  <label for="lastName" class="form-label">Contact</label>
                  <input
                    type="text"
                    name="contact"
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
                <div class="col-md-6">
                  <label for="phone" class="form-label">Téléphone</label>
                  <input type="telephone" name="telephone" class="form-control" id="phone" />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="hireDate" class="form-label">Date Ajout</label>
                  <input
                    type="date"
                    class="form-control"
                    id="hireDate"
                    required
                    name="date_ajout" />
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
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
      function confirmDelete(idclient) {
        if (confirm("Voulez-vous vraiment supprimer cet client ?")) {
          window.location.href = "supprimerClient.php?idclient=" + idclient;
        }
      }
    </script>
</body>

</html>