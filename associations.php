<?php
session_start();
require_once 'data.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associations sportives - INFRASPORT</title>
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
        <h2>🏢 Associations sportives</h2>
        <button class="btn btn-primary-custom" onclick="alert('📢 Formulaire de création d\'association (simulation)')">
            <i class="fas fa-plus"></i> Créer une association
        </button>
    </div>

    <!-- Événements des associations -->
    <h3 class="mb-3">📅 Événements à venir</h3>
    <div class="row">
        <?php foreach($events as $event): ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <?= $event['asso'] ?>
                    </div>
                    <div class="card-body">
                        <h5><?= $event['titre'] ?></h5>
                        <p><i class="fas fa-calendar"></i> 📅 <?= $event['date'] ?></p>
                        <p><i class="fas fa-location-dot"></i> 📍 <?= $event['lieu'] ?></p>
                        <p><i class="fas fa-users"></i> 👥 <?= $event['participants'] ?>/<?= $event['max'] ?> participants</p>
                        <p><i class="fas fa-tag"></i> 💰 <?= $event['prix'] ?></p>
                        <p><?= $event['description'] ?></p>

                        <div class="d-flex gap-2">
                            <button class="btn btn-join" onclick="alert('✅ Inscription à l\'événement confirmée !')">
                                <i class="fas fa-check"></i> Participer
                            </button>
                            <button class="btn btn-secondary" onclick="alert('👀 Vous participerez en tant que spectateur')">
                                <i class="fas fa-eye"></i> Spectateur
                            </button>
                        </div>

                        <!-- Bouton recommandation -->
                        <div class="mt-2">
                            <small><i class="fas fa-robot text-success"></i>
                                <a href="#" onclick="alert('💡 Recommandation : 3 de vos amis participent déjà !')">
                                    🤝 3 amis participent
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Marketplace simple -->
    <div class="card mt-4 bg-light">
        <div class="card-body">
            <h4>🛍️ Marketplace locale</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center p-2">
                        <i class="fas fa-futbol fa-2x text-primary"></i>
                        <p>Ballon de foot<br><small>150 DH</small></p>
                        <button class="btn btn-sm btn-recommend" onclick="alert('Ajouté au panier (simulation)')">Acheter</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-2">
                        <i class="fas fa-bottle-water fa-2x text-primary"></i>
                        <p>Pack boissons<br><small>50 DH</small></p>
                        <button class="btn btn-sm btn-recommend" onclick="alert('Ajouté au panier (simulation)')">Acheter</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-2">
                        <i class="fas fa-tshirt fa-2x text-primary"></i>
                        <p>T-shirt INFRASPORT<br><small>200 DH</small></p>
                        <button class="btn btn-sm btn-recommend" onclick="alert('Ajouté au panier (simulation)')">Acheter</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-2">
                        <i class="fas fa-apple-alt fa-2x text-primary"></i>
                        <p>Snack sportif<br><small>30 DH</small></p>
                        <button class="btn btn-sm btn-recommend" onclick="alert('Ajouté au panier (simulation)')">Acheter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
