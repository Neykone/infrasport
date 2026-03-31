<?php
session_start();
require_once 'data.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFRASPORT - Le sport de proximité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-futbol"></i> INFRASPORT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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

<div class="hero">
    <div class="container">
        <h1>INFRASPORT</h1>
        <p class="lead">La solution contre le manque d'infrastructures sportives de proximité</p>
        <a href="map.php" class="btn btn-light btn-lg mt-3">
            <i class="fas fa-map-marked-alt"></i> Découvrir les terrains
        </a>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <p>Terrains disponibles</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">200+</div>
                <p>Matchs organisés</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">15+</div>
                <p>Associations partenaires</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">1000+</div>
                <p>Utilisateurs actifs</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                    <h5>Découvre les terrains</h5>
                    <p>Trouve les meilleurs spots près de chez toi</p>
                    <a href="map.php" class="btn btn-primary-custom">Explorer</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-futbol fa-3x text-primary mb-3"></i>
                    <h5>Organise des matchs</h5>
                    <p>Crée ou rejoins des parties avec d'autres sportifs</p>
                    <a href="matches.php" class="btn btn-primary-custom">Voir les matchs</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-trophy fa-3x text-primary mb-3"></i>
                    <h5>Gagne des badges</h5>
                    <p>Débloque des récompenses en pratiquant</p>
                    <a href="profile.php" class="btn btn-primary-custom">Mon profil</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <p class="mb-0">INFRASPORT - Transformons nos quartiers en terrains de sport</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>