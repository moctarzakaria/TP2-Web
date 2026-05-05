<?php
// --- LOGIQUE DE TRAITEMENT ---
$donneesRecues = false;
$origine = "";
$etape = "inscription"; // Étape par défaut

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donneesRecues = true;
    $origine = isset($_POST['origine']) ? $_POST['origine'] : "Inconnue";

    // Détermination de l'étape suivante en fonction du bouton cliqué
    if ($origine == "Création de Compte") {
        $etape = "lien_connexion"; 
    } elseif ($origine == "Connexion") {
        $etape = "surveillance";
    } elseif ($origine == "Demande de Surveillance") {
        $etape = "termine";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP9-A : Opération Tranquillité Vacances</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        h1 { text-align: center; color: #2c3e50; }
        .container { display: flex; flex-direction: column; align-items: center; gap: 20px; }
        
        form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; border-top: 5px solid #3498db; }
        h2 { font-size: 1.1em; margin-top: 0; color: #2980b9; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        
        .field { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9em; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        
        .buttons { display: flex; gap: 10px; margin-top: 20px; }
        button { flex: 1; padding: 10px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button[type="submit"] { background-color: #3498db; color: white; }
        
        .message-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; text-align: center; border: 1px solid #c3e6cb; max-width: 400px; }
        .link-btn { display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #2ecc71; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Opération Tranquillité Vacances</h1>

    <div class="container">

        <?php if ($etape == "inscription"): ?>
            <form action="" method="POST">
                <h2>1. Création de votre compte</h2>
                <div class="field"><label>Nom :</label><input type="text" name="nom" required></div> 
                <div class="field"><label>Prénom :</label><input type="text" name="prenom" required></div> 
                <div class="field"><label>Email :</label><input type="email" name="email" required></div>
                <div class="field"><label>Mot de passe :</label><input type="password" name="mdp" required></div> 
                
                <div class="buttons">
                    <button type="submit" name="origine" value="Création de Compte">S'inscrire</button> 
                </div>
            </form>
        <?php endif; ?>

        <?php if ($etape == "lien_connexion"): ?>
            <div class="message-success">
                <h3>Compte créé avec succès !</h3>
                <p>Veuillez maintenant vous identifier pour continuer.</p>
                <form action="" method="POST" style="box-shadow: none; border: none; background: transparent; padding: 0;">
                    <button type="submit" name="origine" value="Aller Vers Connexion" style="background-color: #2ecc71;">Accéder à la connexion</button>
                </form>
            </div>
        <?php endif; ?>

        <?php if (isset($_POST['origine']) && $_POST['origine'] == "Aller Vers Connexion" || ($donneesRecues && $origine == "Aller Vers Connexion")): ?>
            <form action="" method="POST">
                <h2>2. Connexion</h2>
                <div class="field"><label>Email :</label><input type="email" name="login_email" required></div> 
                <div class="field"><label>Mot de passe :</label><input type="password" name="login_mdp" required></div> 
                
                <div class="buttons">
                    <button type="submit" name="origine" value="Connexion">Se connecter</button> 
                </div>
            </form>
        <?php endif; ?>

        <?php if ($etape == "surveillance"): ?>
            <form action="" method="POST">
                <h2>3. Informations de surveillance</h2>
                <p style="font-size: 0.8em; color: green;">✔ Connecté avec succès.</p>
                <div class="field"><label>Date de début :</label><input type="date" name="date_debut" required></div>
                <div class="field"><label>Date de fin :</label><input type="date" name="date_fin" required></div> 
                <div class="field"><label>Personne à prévenir :</label><input type="text" name="contact_nom" required></div> 
                <div class="field"><label>Téléphone contact :</label><input type="tel" name="contact_tel" required></div> 
                
                <div class="buttons">
                    <button type="submit" name="origine" value="Demande de Surveillance">Valider la surveillance</button> 
                </div>
            </form>
        <?php endif; ?>

        <?php if ($etape == "termine"): ?>
            <div class="message-success">
                <h2>Merci !</h2>
                <p>Votre demande de surveillance a bien été enregistrée.</p>
                <a href="" class="link-btn">Retour à l'accueil</a>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>