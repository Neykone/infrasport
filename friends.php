<?php
session_start();
require_once 'data.php';

// Simuler l'invitation d'un ami
if(isset($_GET['invite'])) {
    $_SESSION['stats']['friends_invited'] += 1;
    header('Location: friends.php?success=1');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes amis - INFRASPORT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-futbol"></i> INFRASPORT</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="map.php">🗺️ Carte</a></li>
                <li class="nav-item"><a class="nav-link" href="matches.php">⚽ Matchs</a></li>
                <li class="nav-item"><a class="nav-link" href="associations.php">🏢 Associations</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">👤 Mon profil</a></li>
                <li class="nav-item"><a class="nav-link" href="friends.php">👥 Amis</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success"> Invitation envoyée !</div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"> Mes amis</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach($friends as $friend): ?>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 border rounded">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0"><?= $friend['name'] ?></h6>
                                        <small class="text-muted">
                                            <i class="fas fa-futbol"></i> <?= $friend['sport'] ?> ·
                                            <i class="fas fa-chart-line"></i> <?= $friend['niveau'] ?> ·
                                            <i class="fas fa-map-marker-alt"></i> <?= $friend['distance'] ?>
                                        </small>
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-recommend" onclick="alert(' Notification envoyée à <?= $friend['name'] ?>')">
                                                <i class="fas fa-bell"></i> Inviter à jouer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Inviter des amis -->
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"> Inviter des amis</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Email de l'ami</label>
                        <input type="email" class="form-control" id="friendEmail" placeholder="ami@email.com">
                    </div>
                    <button class="btn btn-success w-100" onclick="inviteFriend()">
                        <i class="fas fa-paper-plane"></i> Envoyer l'invitation
                    </button>

                    <!-- Recommandations -->
                    <hr>
                    <h6><i class="fas fa-robot text-success"></i> Recommandations</h6>
                    <div class="alert alert-light">
                        <small> Selon tes centres d'intérêt :</small>
                        <ul class="mt-2">
                            <li><a href="#" onclick="alert(' Karim aime aussi le football - Distance 500m')">Karim (Football) à 500m</a></li>
                            <li><a href="#" onclick="alert(' Sofia recherche des joueurs pour un match de basketball')">Sofia cherche des joueurs</a></li>
                            <li><a href="#" onclick="alert(' Groupe "Sportifs du quartier" - 15 membres')">Groupe "Sportifs du quartier"</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Groupes existants -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">👥 Groupes sportifs</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span> Les Footeux</span>
                        <button class="btn btn-sm btn-recommend" onclick="alert(' Demande d\'adhésion envoyée')">Rejoindre</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span> Basket City</span>
                        <button class="btn btn-sm btn-recommend" onclick="alert(' Demande d\'adhésion envoyée')">Rejoindre</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span> Running Club</span>
                        <button class="btn btn-sm btn-recommend" onclick="alert(' Demande d\'adhésion envoyée')">Rejoindre</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function inviteFriend() {
        let email = document.getElementById('friendEmail').value;
        if(email) {
            alert(' Invitation envoyée à ' + email + ' !');
            // Simuler l'incrémentation
            window.location.href = '?invite=1';
        } else {
            alert('Veuillez entrer un email');
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
