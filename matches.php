<?php
session_start();
require_once 'data.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matchs et tournois - INFRASPORT</title>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Matchs et tournois près de chez toi</h2>
        <a href="create_match.php" class="btn btn-primary-custom">
            <i class="fas fa-plus"></i> Créer un match
        </a>
    </div>

    <!-- Matchs existants -->
    <div class="row">
        <?php foreach($matches as $match): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <?= $match['sport'] ?> - <?= $match['lieu'] ?>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-calendar"></i>  <?= $match['date'] ?></p>
                        <p><i class="fas fa-users"></i>  <?= $match['joueurs'] ?>/<?= $match['max'] ?> participants</p>
                        <p><i class="fas fa-chart-line"></i>  Niveau : <?= $match['niveau'] ?></p>
                        <p><i class="fas fa-user"></i>  Organisé par : <?= $match['organisateur'] ?></p>

                        <div class="d-flex gap-2 mt-3">
                            <button class="btn btn-join" onclick="alert(' Vous avez rejoint le match ! Notification envoyée à l\'organisateur.')">
                                <i class="fas fa-check"></i> Rejoindre
                            </button>
                            <button class="btn btn-recommend" onclick="alert(' Invitation envoyée à vos amis !')">
                                <i class="fas fa-user-plus"></i> Inviter des amis
                            </button>
                        </div>

                        <!-- Bouton recommandation personnalisée -->
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-robot"></i>
                                <a href="#" onclick="alert(' Recommandation : Karim (500m) aime aussi le football et cherche un match !')">
                                     Voir participants recommandés
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Section tournois -->
    <h3 class="mt-5 mb-3"> Tournois à venir</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-warning bg-opacity-10">
                <div class="card-body">
                    <h5> Tournoi de Football</h5>
                    <p> Samedi 15 Mars - Parc Central</p>
                    <p> 12 équipes inscrites</p>
                    <button class="btn btn-sm btn-primary-custom" onclick="alert('Inscription au tournoi confirmée !')">
                        S'inscrire
                    </button>
                    <div class="mt-2">
                        <small><i class="fas fa-robot"></i> <a href="#"> 3 amis intéressés</a></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success bg-opacity-10">
                <div class="card-body">
                    <h5> 3x3 Basketball</h5>
                    <p> Dimanche 16 Mars - City Stade</p>
                    <p> 8 équipes inscrites</p>
                    <button class="btn btn-sm btn-primary-custom" onclick="alert('Inscription au tournoi confirmée !')">
                        S'inscrire
                    </button>
                    <div class="mt-2">
                        <small><i class="fas fa-robot"></i> <a href="#"> Niveau intermédiaire recommandé</a></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info bg-opacity-10">
                <div class="card-body">
                    <h5> Marathon 5km</h5>
                    <p> Dimanche 20 Mars - Jardin Bouregreg</p>
                    <p> 78 participants</p>
                    <button class="btn btn-sm btn-primary-custom" onclick="alert('Inscription au marathon confirmée !')">
                        S'inscrire
                    </button>
                    <div class="mt-2">
                        <small><i class="fas fa-robot"></i> <a href="#"> Challenge : 10km pour les avancés</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
