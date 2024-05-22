<!-- views/email/send-password-to-manager.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de connexion</title>
    <style>
        /* Réglez la taille maximale de l'image pour qu'elle s'adapte à la largeur de son conteneur */
        .logo {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Utilisez asset() pour générer le chemin de l'image -->
        <img src="https://www.subliwear.fr/wp-content/uploads/2020/09/Logo.png" alt="Logo" class="logo" width="700" height="auto">

        <h2>Informations de connexion</h2>
        <p>Bonjour {{$user->name}},</p>
        
        <div class="message">
            <p>Voici les informations de connexion que vous avez demandées :</p>
            <ul>
                <li><strong>E-mail :</strong> {{$user->email}}</li>
                <li><strong>Mot de passe :</strong> {{$password}}</li>
            </ul>
        </div>
        
        <p>Vous pouvez utiliser ces informations pour accéder à votre compte en tant que manager.</p>
        
        <p>Merci,<br>
        Société Subliwear - Développé par Ali Quamar</p>
    </div>
</body>
</html>
