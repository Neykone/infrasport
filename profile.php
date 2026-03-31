<?php
session_start();
require_once 'data.php';

// Initialiser les stats en session si pas existantes
if(!isset($_SESSION['stats'])) {
    $_SESSION['stats'] = [
        'matches_played' => 3,
        'hours' => 8,
        'tournaments' => 2,
        'friends_invited' => 2,
        'terrains_visited' => 2
    ];
}

// Simuler l'ajout d'une séance
if(isset($_GET['complete_workout'])) {
    $_SESSION['stats']['hours'] += 1;
    $_SESSION['stats']['matches_played'] += 1;
    header('Location: profile.php');
    exit();
}

// Vérifier les badges débloqués
$unlocked_badges = [];
foreach($badges as $badge) {
    if($badge['condition'] == 'join_match' && $_SESSION['stats']['matches_played'] >= 1) {
        $unlocked_badges[] = $badge;
    } elseif($badge['condition'] == 'explore' && $_SESSION['stats']['terrains_visited'] >= 3) {
        $unlocked_badges[] = $badge;
    } elseif($badge['condition'] == 'invite' && $_SESSION['stats']['friends_invited'] >= 3) {
        $unlocked_badges[] = $badge;
    } elseif($badge['condition'] == 'tournaments' && $_SESSION['stats']['tournaments'] >= 5) {
        $unlocked_badges[] = $badge;
    } elseif($badge['condition'] == 'hours' && $_SESSION['stats']['hours'] >= 10) {
        $unlocked_badges[] = $badge;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil - INFRASPORT</title>
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
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-circle fa-4x text-primary mb-3"></i>
                    <h4><?= $_SESSION['user_name'] ?? 'Utilisateur' ?></h4>
                    <p class="text-muted">Membre depuis fevrier 2026</p>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h3><?= $_SESSION['stats']['matches_played'] ?></h3>
                            <small>Matchs joués</small>
                        </div>
                        <div class="col-6">
                            <h3><?= $_SESSION['stats']['hours'] ?></h3>
                            <small>Heures de sport</small>
                        </div>
                    </div>
                    <a href="?complete_workout=1" class="btn btn-primary-custom mt-3 w-100">
                        <i class="fas fa-plus"></i> Ajouter une séance
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">🏅 Mes badges</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach($badges as $badge): ?>
                            <?php
                            $isUnlocked = false;
                            foreach($unlocked_badges as $ub) {
                                if($ub['name'] == $badge['name']) $isUnlocked = true;
                            }
                            ?>
                            <div class="col-md-6 mb-2">
                                <div class="badge-item <?= !$isUnlocked ? 'badge-locked' : '' ?>">
                                    <i class="fas fa-<?= $isUnlocked ? 'trophy' : 'lock' ?>"></i>
                                    <strong><?= $badge['name'] ?></strong>
                                    <small class="d-block"><?= $badge['description'] ?></small>
                                    <?php if(!$isUnlocked): ?>
                                        <small class="d-block text-warning">🔒 Non débloqué</small>
                                    <?php else: ?>
                                        <small class="d-block text-success">✅ Débloqué !</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">📊 Progression</h5>
                </div>
                <div class="card-body">
                    <p><strong>Prochain badge :</strong> Explorateur (découvre 3 terrains)</p>
                    <div class="progress mb-3">
                        <div class="progress-bar" style="width: <?= min(100, ($_SESSION['stats']['terrains_visited'] / 3) * 100) ?>%">
                            <?= $_SESSION['stats']['terrains_visited'] ?>/3 terrains
                        </div>
                    </div>
                    <p><strong>Prochain badge :</strong> Champion de l'amitié (invite 3 amis)</p>
                    <div class="progress mb-3">
                        <div class="progress-bar" style="width: <?= min(100, ($_SESSION['stats']['friends_invited'] / 3) * 100) ?>%">
                            <?= $_SESSION['stats']['friends_invited'] ?>/3 amis
                        </div>
                    </div>
                    <p><strong>Prochain badge :</strong> Marathonien (10h de sport)</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?= min(100, ($_SESSION['stats']['hours'] / 10) * 100) ?>%">
                            <?= $_SESSION['stats']['hours'] ?>/10 heures
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>