<?php
session_start();
require_once 'data.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte interactive - INFRASPORT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .info-window { padding: 10px; }
        .info-window h6 { color: #1e3c72; margin-bottom: 5px; }
        .info-window .badge { margin: 2px; }
        .recommend-card { background: #e8f5e9; border-left: 4px solid #4caf50; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-futbol"></i> INFRASPORT
        </a>
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
        <h1>🗺️ Découvre les terrains près de chez toi</h1>
        <p>Parcs, gymnases, terrains universitaires... Trouve ton spot idéal !</p>
    </div>
</div>

<div class="container mt-4">
    <!-- Carte interactive -->
    <div id="map"></div>

    <!-- Bouton de recommandation -->
    <div class="recommend-card card p-3 mt-3 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <i class="fas fa-robot text-success me-2"></i>
                <strong>💡 Recommandation :</strong> Basé sur ta localisation, nous te suggérons <strong>Parc Central</strong> (500m) - Idéal pour le football !
            </div>
            <div class="col-md-4 text-md-end">
                <button class="btn btn-recommend" onclick="alert('🔔 Notification : Parc Central recommandé !')">
                    <i class="fas fa-thumbs-up"></i> Voir la recommandation
                </button>
            </div>
        </div>
    </div>

    <!-- Liste des terrains -->
    <h3 class="mb-3">📋 Tous les terrains disponibles</h3>
    <div class="row">
        <?php foreach($terrains as $terrain): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <?= $terrain['name'] ?>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-tag"></i> <strong>Type :</strong> <?= $terrain['type'] ?></p>
                        <p><i class="fas fa-futbol"></i> <strong>Sports :</strong> <?= $terrain['sports'] ?></p>
                        <p><i class="fas fa-clock"></i> <strong>Horaires :</strong> <?= $terrain['horaires'] ?></p>
                        <p><i class="fas fa-coins"></i> <strong>Prix :</strong> <?= $terrain['prix'] ?></p>
                        <p><i class="fas fa-users"></i> <strong>Capacité :</strong> <?= $terrain['places'] ?> personnes</p>
                        <button class="btn btn-sm btn-primary-custom" onclick="alert('📍 Itinéraire vers <?= $terrain['name'] ?>')">
                            <i class="fas fa-directions"></i> Y aller
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Initialiser la carte
    var map = L.map('map').setView([33.5731, -7.5898], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Données des terrains
    var terrains = <?= json_encode($terrains) ?>;

    // Ajouter les marqueurs
    terrains.forEach(function(terrain) {
        var marker = L.marker([terrain.lat, terrain.lng]).addTo(map);
        marker.bindPopup(`
                <div class="info-window">
                    <h6>${terrain.name}</h6>
                    <p><strong>🏀 Sports :</strong> ${terrain.sports}<br>
                    <strong>⏰ Horaires :</strong> ${terrain.horaires}<br>
                    <strong>💰 Prix :</strong> ${terrain.prix}</p>
                    <button class="btn btn-sm btn-primary-custom" onclick="alert('Réservation simulée pour ${terrain.name}')">
                        Réserver
                    </button>
                </div>
            `);
    });
</script>
</body>
</html>
