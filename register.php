<?php
session_start();

// Rediriger si déjà connecté
if(isset($_SESSION['user_name'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';
$name = '';
$email = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(isset($_POST['name']) ? $_POST['name'] : '');
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $terms = isset($_POST['terms']);

    if(empty($name) || empty($email) || empty($password)) {
        $error = 'Veuillez remplir tous les champs';
    } elseif(strlen($password) < 6) {
        $error = 'Le mot de passe doit contenir au moins 6 caractères';
    } elseif($password !== $confirm) {
        $error = 'Les mots de passe ne correspondent pas';
    } elseif(!$terms) {
        $error = 'Vous devez accepter les conditions';
    } else {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

        $success = 'Inscription réussie ! Redirection...';
        header("refresh:2;url=index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - INFRASPORT</title>
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

        .auth-container {
            width: 100%;
            max-width: 900px;
            margin: 20px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-4px);
        }

        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 28px 24px;
            text-align: center;
            color: white;
        }

        .auth-header i {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .auth-header h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .auth-header p {
            font-size: 0.75rem;
            opacity: 0.85;
            margin-bottom: 0;
        }

        .auth-form {
            padding: 28px 24px;
        }

        .auth-form h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 4px;
        }

        .auth-form .subtitle {
            color: #718096;
            font-size: 0.75rem;
            margin-bottom: 24px;
        }

        .input-group-custom {
            margin-bottom: 18px;
        }

        .input-group-custom label {
            display: block;
            font-size: 0.7rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 5px;
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
            font-size: 0.85rem;
            pointer-events: none;
        }

        .input-group-custom input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.85rem;
            transition: all 0.2s;
            background: #fafbfc;
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.08);
        }

        .double-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .terms-group {
            margin: 20px 0;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #4a5568;
            font-size: 0.7rem;
        }

        .checkbox-label input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #667eea;
        }

        .checkbox-label a {
            color: #667eea;
            text-decoration: none;
        }

        .btn-auth {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -8px rgba(102, 126, 234, 0.4);
        }

        .divider {
            text-align: center;
            margin: 18px 0;
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
            padding: 0 10px;
            position: relative;
            color: #a0aec0;
            font-size: 0.65rem;
            text-transform: uppercase;
        }

        .quick-register {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 16px;
        }

        .quick-btn {
            padding: 8px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            font-size: 0.7rem;
            cursor: pointer;
            transition: all 0.2s;
            color: #4a5568;
        }

        .quick-btn:hover {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
        }

        .login-link p {
            color: #718096;
            font-size: 0.75rem;
            margin-bottom: 0;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

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

        .alert-success {
            background: #dcfce7;
            border-left: 3px solid #22c55e;
            color: #166534;
        }

        @media (max-width: 480px) {
            .auth-container {
                max-width: 340px;
            }

            .auth-form {
                padding: 24px 20px;
            }

            .double-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
<div class="bg-shape"></div>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <i class="fas fa-user-plus"></i>
            <h3>INFRASPORT</h3>
            <p>Rejoignez la communauté</p>
        </div>

        <div class="auth-form">
            <h2>Créer un compte</h2>
            <p class="subtitle">Commencez votre aventure sportive</p>

            <?php if($error): ?>
                <div class="alert-custom alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if($success): ?>
                <div class="alert-custom alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="double-row">
                    <div class="input-group-custom">
                        <label>NOM COMPLET</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Jean Dupont" required>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label>EMAIL</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="exemple@email.com" required>
                        </div>
                    </div>
                </div>

                <div class="double-row">
                    <div class="input-group-custom">
                        <label>MOT DE PASSE</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label>CONFIRMER</label>
                        <div class="input-icon">
                            <i class="fas fa-check-circle"></i>
                            <input type="password" name="confirm_password" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>

                <div class="terms-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" required>
                        <span>J'accepte les <a href="#" onclick="alert('Conditions d\'utilisation (simulation)')">conditions</a></span>
                    </label>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="fas fa-user-plus"></i> Créer mon compte
                </button>
            </form>



            <div class="login-link">
                <p>Déjà inscrit ? <a href="login.php">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>


</body>
</html>