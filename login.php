<?php
session_start();

// Rediriger si déjà connecté
if(isset($_SESSION['user_name'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$email = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if(!empty($email) && !empty($password)) {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = explode('@', $email)[0];
        $_SESSION['user_email'] = $email;

        if($remember) {
            setcookie('remember_email', $email, time() + (86400 * 30), "/");
        }

        header('Location: index.php');
        exit();
    } else {
        $error = 'Email ou mot de passe incorrect';
    }
}

$saved_email = $_COOKIE['remember_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - INFRASPORT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Formes décoratives épurées */
        .bg-shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bg-shape::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: moveDots 30s linear infinite;
        }

        @keyframes moveDots {
            0% { transform: translate(0, 0); }
            100% { transform: translate(40px, 40px); }
        }

        /* Conteneur principal - PLUS ÉTROIT */
        .auth-container {
            width: 100%;
            max-width: 900px;
            margin: 20px;
            position: relative;
            z-index: 1;
        }

        /* Carte épurée */
        .auth-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 48px -12px rgba(0, 0, 0, 0.25);
        }

        /* Header épuré */
        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 32px 24px;
            text-align: center;
            color: white;
        }

        .auth-header i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: 0.95;
        }

        .auth-header h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .auth-header p {
            font-size: 0.8rem;
            opacity: 0.85;
            margin-bottom: 0;
        }

        /* Formulaire - Plus compact */
        .auth-form {
            padding: 32px 28px;
        }

        .auth-form h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .auth-form .subtitle {
            color: #718096;
            font-size: 0.8rem;
            margin-bottom: 28px;
        }

        /* Inputs épurés */
        .input-group-custom {
            margin-bottom: 20px;
        }

        .input-group-custom label {
            display: block;
            font-size: 0.75rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-group-custom .input-icon {
            position: relative;
        }

        .input-group-custom .input-icon i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 0.9rem;
            pointer-events: none;
        }

        .input-group-custom input {
            width: 100%;
            padding: 10px 14px 10px 42px;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #fafbfc;
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.08);
        }

        /* Checkbox épurée */
        .checkbox-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #4a5568;
            font-size: 0.75rem;
        }

        .checkbox-label input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #667eea;
        }

        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: #5a67d8;
        }

        /* Bouton principal */
        .btn-auth {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -8px rgba(102, 126, 234, 0.4);
        }

        /* Séparateur épuré */
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 12px;
            position: relative;
            color: #a0aec0;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        /* Comptes démo - Plus compact */
        .demo-accounts {
            background: #f8fafc;
            border-radius: 14px;
            padding: 14px;
            margin-top: 16px;
        }

        .demo-title {
            font-size: 0.7rem;
            color: #718096;
            text-align: center;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .demo-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .demo-btn {
            padding: 6px 12px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            font-size: 0.7rem;
            cursor: pointer;
            transition: all 0.2s;
            color: #4a5568;
        }

        .demo-btn:hover {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .demo-note {
            font-size: 0.65rem;
            color: #a0aec0;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 0;
        }

        /* Lien inscription */
        .signup-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .signup-link p {
            color: #718096;
            font-size: 0.8rem;
            margin-bottom: 0;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Alert */
        .alert-custom {
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-error {
            background: #fee2e2;
            border-left: 3px solid #ef4444;
            color: #b91c1c;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .auth-container {
                max-width: 340px;
            }

            .auth-form {
                padding: 28px 20px;
            }

            .auth-header {
                padding: 28px 20px;
            }
        }
    </style>
</head>
<body>
<div class="bg-shape"></div>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <i class="fas fa-futbol"></i>
            <h3>INFRASPORT</h3>
            <p>Le sport accessible à tous</p>
        </div>

        <div class="auth-form">
            <h2>Bienvenue</h2>
            <p class="subtitle">Connectez-vous à votre espace</p>

            <?php if($error): ?>
                <div class="alert-custom alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="input-group-custom">
                    <label>EMAIL</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="<?= htmlspecialchars($saved_email ?: $email) ?>" placeholder="exemple@email.com" required>
                    </div>
                </div>

                <div class="input-group-custom">
                    <label>MOT DE PASSE</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" <?= $saved_email ? 'checked' : '' ?>>
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="#" class="forgot-link" onclick="alert('📧 Lien de réinitialisation envoyé (simulation)')">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="fas fa-arrow-right-to-bracket"></i> Se connecter
                </button>
            </form>

            <div class="divider">
                <span>ou</span>
            </div>



            <div class="signup-link">
                <p>Nouveau sur INFRASPORT ? <a href="register.php">Créer un compte</a></p>
            </div>
        </div>
    </div>
</div>


</body>
</html>