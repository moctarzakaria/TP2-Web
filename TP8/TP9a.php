<?php
// --- LOGIQUE DE TRAITEMENT (CODE 2) ---
$donneesRecues = false;
$origine = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donneesRecues = true;
    $origine = isset($_POST['origine']) ? $_POST['origine'] : "Inconnue";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP9-A : Les Formulaires - Tranquillité Vacances</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        h1 { text-align: center; color: #2c3e50; }
        .container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; align-items: flex-start; }
        
        /* Style des formulaires */
        form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 320px; border-top: 5px solid #3498db; }
        h2 { font-size: 1.1em; margin-top: 0; color: #2980b9; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        
        .field { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9em; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        
        .buttons { display: flex; gap: 10px; margin-top: 20px; }
        button { flex: 1; padding: 10px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button[type="submit"] { background-color: #3498db; color: white; }
        button[type="reset"] { background-color: #e74c3c; color: white; }

        /* Style du tableau de résultat */
        .resultat { background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 2px solid #2ecc71; width: 80%; margin-left: auto; margin-right: auto; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #2ecc71; color: white; }
    </style>
</head>
<body>

    <h1>Opération Tranquillité Vacances</h1>

    <?php if ($donneesRecues): ?>
        <div class="resultat">
            <h2>Données reçues du formulaire : <?php echo htmlspecialchars($origine); ?></h2>
            <table>
                <thead>
                    <tr><th>Champ</th><th>Valeur transmise</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($_POST as $cle => $valeur): ?>
                        <?php if ($cle !== 'origine'): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($cle); ?></strong></td>
                                <td><?php echo htmlspecialchars($valeur); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><a href="tp9a.php">Remplir un autre formulaire</a></p>
        </div>
    <?php endif; ?>

    <div class="container">
        <form action="tp9a.php" method="POST">
            <h2>Création d'un compte</h2>
            <div class="field"><label>Nom :</label><input type="text" name="nom" required></div> 
           <div class="field"><label>Prénom :</label><input type="text" name="prenom" required></div> 
           <div class="field"><label>Adresse :</label><input type="text" name="adresse" required></div> 
           <div class="field"><label>Téléphone :</label><input type="tel" name="telephone" pattern="[0-9]{10}" required></div> 
            <div class="field"><label>Email :</label><input type="email" name="email" required></div>
            <div class="field"><label>Mot de passe :</label><input type="password" name="mdp" required></div> 
            <div class="field"><label>Confirmation du mot de passe :</label><input type="password" name="mdp_conf" required></div> 
            
            <div class="buttons">
                <button type="submit" name="origine" value="Création de Compte">Créer le compte</button> 
                <button type="reset">Annuler</button>
            </div>
        </form>

        <form action="tp9a.php" method="POST">
            <h2>Connexion</h2>
            <div class="field"><label>Email :</label><input type="email" name="login_email" required></div> 
            <div class="field"><label>Mot de passe :</label><input type="password" name="login_mdp" required></div> 
            
            <div class="buttons">
                <button type="submit" name="origine" value="Connexion">Se connecter</button> 
                <button type="reset">Annuler</button>
            </div>
        </form>

        <form action="tp9a.php" method="POST">
            <h2>Demande de surveillance</h2>
            <div class="field"><label>Date de début d'absence :</label><input type="date" name="date_debut" required></div>
            <div class="field"><label>Date de fin d'absence :</label><input type="date" name="date_fin" required></div> 
            <div class="field"><label>Personne à contacter :</label><input type="text" name="contact_nom" required></div> 
            <div class="field"><label>Téléphone de la personne à contacter :</label><input type="tel" name="contact_tel" pattern="[0-9]{10}" required></div> 
            
            <div class="buttons">
                <button type="submit" name="origine" value="Demande de Surveillance">Envoyer la demande</button> 
                <button type="reset">Annuler</button>
            </div>
        </form>
    </div>

</body>
</html>