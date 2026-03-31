<?php
// data.php - Toutes les données du prototype

// Terrains sportifs
$terrains = [
    ['id' => 1, 'name' => '🌳 Parc Central', 'lat' => 33.5731, 'lng' => -7.5898,
        'sports' => 'Football, Running, Fitness', 'places' => 50, 'type' => 'Parc',
        'horaires' => '8h-20h', 'prix' => 'Gratuit'],
    ['id' => 2, 'name' => '🏀 City Stade', 'lat' => 33.5720, 'lng' => -7.5905,
        'sports' => 'Basketball, Football', 'places' => 20, 'type' => 'Terrain',
        'horaires' => '24h/24', 'prix' => 'Gratuit'],
    ['id' => 3, 'name' => '🏋️ Gymnase Universitaire', 'lat' => 33.5740, 'lng' => -7.5880,
        'sports' => 'Volleyball, Badminton, Handball', 'places' => 100, 'type' => 'Gymnase',
        'horaires' => '9h-21h', 'prix' => '50 DH/séance'],
    ['id' => 4, 'name' => '🏃 Jardin Bouregreg', 'lat' => 33.5710, 'lng' => -7.5870,
        'sports' => 'Running, Yoga, Fitness', 'places' => 30, 'type' => 'Jardin',
        'horaires' => '6h-22h', 'prix' => 'Gratuit'],
    ['id' => 5, 'name' => '🎾 Tennis Club', 'lat' => 33.5750, 'lng' => -7.5910,
        'sports' => 'Tennis, Padel', 'places' => 8, 'type' => 'Club',
        'horaires' => '8h-22h', 'prix' => '100 DH/h'],
];

// Matchs existants
$matches = [
    ['id' => 1, 'sport' => '⚽ Football', 'lieu' => 'Parc Central', 'date' => 'Samedi 15h',
        'joueurs' => 3, 'max' => 10, 'niveau' => 'Débutant', 'organisateur' => 'Karim'],
    ['id' => 2, 'sport' => '🏀 Basketball', 'lieu' => 'City Stade', 'date' => 'Dimanche 10h',
        'joueurs' => 4, 'max' => 8, 'niveau' => 'Intermédiaire', 'organisateur' => 'Sofia'],
    ['id' => 3, 'sport' => '🏃 Running', 'lieu' => 'Jardin Bouregreg', 'date' => 'Lundi 18h',
        'joueurs' => 2, 'max' => 15, 'niveau' => 'Tous niveaux', 'organisateur' => 'Amine'],
    ['id' => 4, 'sport' => '🎾 Tennis', 'lieu' => 'Tennis Club', 'date' => 'Mercredi 16h',
        'joueurs' => 1, 'max' => 4, 'niveau' => 'Intermédiaire', 'organisateur' => 'Leila'],
];

// Événements associations
$events = [
    ['id' => 1, 'asso' => '🏆 Sport pour Tous', 'titre' => 'Tournoi de Football',
        'date' => 'Samedi 14 Mars', 'lieu' => 'Parc Central', 'participants' => 45, 'max' => 100,
        'prix' => 'Gratuit', 'description' => 'Tournoi amical ouvert à tous'],
    ['id' => 2, 'asso' => '🧘 Yoga City', 'titre' => 'Cours de Yoga en plein air',
        'date' => 'Dimanche 10 Mars', 'lieu' => 'Jardin Bouregreg', 'participants' => 12, 'max' => 30,
        'prix' => '50DH', 'description' => 'Séance de yoga avec vue sur le fleuve'],
    ['id' => 3, 'asso' => '🏀 Hoop Club', 'titre' => 'Initiation Basketball',
        'date' => 'Mercredi 16 Mars', 'lieu' => 'City Stade', 'participants' => 8, 'max' => 20,
        'prix' => 'Gratuit', 'description' => 'Pour les débutants et enfants'],
    ['id' => 4, 'asso' => '🏃 Running Casablanca', 'titre' => 'Marathon du Quartier',
        'date' => 'Dimanche 20 Mars', 'lieu' => 'Parc Central', 'participants' => 78, 'max' => 200,
        'prix' => '150DH', 'description' => '5km et 10km - Inscription sur place'],
];

// Amis (pour simulation)
$friends = [
    ['id' => 1, 'name' => 'Karim', 'sport' => 'Football', 'niveau' => 'Intermédiaire', 'distance' => '500m'],
    ['id' => 2, 'name' => 'Sofia', 'sport' => 'Basketball', 'niveau' => 'Avancé', 'distance' => '1.2km'],
    ['id' => 3, 'name' => 'Amine', 'sport' => 'Running', 'niveau' => 'Débutant', 'distance' => '800m'],
    ['id' => 4, 'name' => 'Leila', 'sport' => 'Tennis', 'niveau' => 'Intermédiaire', 'distance' => '2km'],
];

// Badges
$badges = [
    ['name' => '🏅 Premier match', 'description' => 'A participé à ton premier match', 'condition' => 'join_match'],
    ['name' => '🌍 Explorateur', 'description' => 'Découvert 3 terrains différents', 'condition' => 'explore'],
    ['name' => '🤝 Champion de l\'amitié', 'description' => 'Invité 3 amis', 'condition' => 'invite'],
    ['name' => '⚡ 5 tournois', 'description' => 'Participé à 5 tournois', 'condition' => 'tournaments'],
    ['name' => '🏃 Marathonien', 'description' => '10h de sport', 'condition' => 'hours'],
];
?>
