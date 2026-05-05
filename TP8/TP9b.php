 <?php

session_start();

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);



// --- CONFIGURATION CONNEXION BDD ---

$host = 'localhost';

$dbname = 'c60b1web';

$user = 'c60b1web';  

$pass = 'Yazakimoctar';


try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

} catch (PDOException $e) {

    die("Erreur de connexion : " . $e->getMessage());

}


// --- GESTION DE LA DÉCONNEXION ---

if (isset($_GET['action']) && $_GET['action'] == 'logout') {

    session_destroy();

    header("Location: tp9b.php"); // Redirige vers la page propre

    exit();

}


// --- DÉTERMINATION DE L'ÉTAPE PAR DÉFAUT ---

$etape = "inscription";

$message = "";


// Si l'utilisateur est déjà connecté, on saute l'étape inscription

if (($_SESSION['admin']) && $_SESSION['admin'] == true) {

    $etape = "admin_panel";

} elseif (isset($_SESSION['user_id'])) {

    $etape = "surveillance";

}


// --- LOGIQUE DE TRAITEMENT DES FORMULAIRES ---

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $origine = $_POST['origine'] ?? "";


    // 1. Traitement Inscription

    if ($origine == "Inscription") {

        $sql = "INSERT INTO utilisateur (nom, prenom, adresse, telephone, email, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['telephone'], $_POST['email'], $_POST['mdp']]);

        $etape = "lien_connexion";

    }


    // 2. Traitement Connexion

    elseif ($origine == "Connexion") {

        if ($_POST['login_email'] == "admin" && $_POST['login_mdp'] == "1234") {

            $_SESSION['admin'] = true;

            $etape = "admin_panel";

        } else {

            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ? AND mot_de_passe = ?");

            $stmt->execute([$_POST['login_email'], $_POST['login_mdp']]);

            $user = $stmt->fetch();

            if ($user) {

                $_SESSION['user_id'] = $user['id_utilisateur'];

                $_SESSION['user_nom'] = $user['nom'];

                $etape = "surveillance";

            } else {

                $message = "Identifiants incorrects.";

                $etape = "inscription";

            }

        }

    }


    // 3. Traitement Demande de Surveillance

    elseif ($origine == "Surveillance") {

        $sql = "INSERT INTO demande (date_debut, date_fin, contact_nom, contact_telephone, id_utilisateur) VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$_POST['date_debut'], $_POST['date_fin'], $_POST['contact_nom'], $_POST['contact_tel'], $_SESSION['user_id']]);

        $etape = "termine";

    }


    // 4. Traitement Affectation Agent (Admin)

    elseif ($origine == "Affecter") {

        $stmt = $pdo->prepare("UPDATE demande_surveillance SET agent_affecte = ? WHERE id_demande = ?");

        $stmt->execute([$_POST['agent'], $_POST['id_demande']]);

        $etape = "admin_panel";

    }

}

?>


<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Opération Tranquillité Vacances</title>

    <style>

        body { font-family: sans-serif; background: #f4f7f6; display: flex; flex-direction: column; align-items: center; }

        .logo { width: 100px; margin-top: 20px; }

        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 400px; margin-top: 20px; border-top: 5px solid #d32f2f; }

        .admin-container { width: 80%; }

        h1, h2 { color: #2c3e50; text-align: center; }

        .field { margin-bottom: 15px; }

        label { display: block; font-size: 0.9em; font-weight: bold; }

        input, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }

        button { width: 100%; padding: 10px; background: #d32f2f; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }

        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }

        th { background: #2c3e50; color: white; }

        .logout-btn { background: #7f8c8d; margin-top: 10px; display: inline-block; padding: 5px 10px; color: white; text-decoration: none; border-radius: 4px; font-size: 0.8em; }

    </style>

</head>

<body>


    <img src="Image/zak.png" alt="Mon Logo">


    <h1>Opération Tranquillité Vacances</h1>


    <div class="container <?php echo ($etape == 'admin_panel') ? 'admin-container' : ''; ?>">

       

        <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>


        <?php if ($etape == "inscription"): ?>

            <form action="" method="POST">

                <h2>1. Inscription</h2>

                <div class="field"><label>Nom</label><input type="text" name="nom" required></div>

                <div class="field"><label>Prénom</label><input type="text" name="prenom" required></div>

                <div class="field"><label>Adresse</label><input type="text" name="adresse" required></div>

                <div class="field"><label>Téléphone</label><input type="text" name="telephone" required></div>

                <div class="field"><label>Email</label><input type="email" name="email" required></div>

                <div class="field"><label>Mot de passe</label><input type="password" name="mdp" required></div>

                <button type="submit" name="origine" value="Inscription">Créer mon compte</button>

            </form>

            <form action="" method="POST" style="margin-top:10px;">

                <button type="submit" name="origine" value="AllerConnexion" style="background:#3498db;">Déjà inscrit ? Se connecter</button>

            </form>

        <?php endif; ?>


        <?php if ($etape == "lien_connexion" || (isset($_POST['origine']) && $_POST['origine'] == "AllerConnexion")): ?>

            <form action="" method="POST">

                <h2>2. Connexion</h2>

                <div class="field"><label>Email / Login</label><input type="text" name="login_email" required></div>

                <div class="field"><label>Mot de passe</label><input type="password" name="login_mdp" required></div>

                <button type="submit" name="origine" value="Connexion">Se connecter</button>

            </form>

        <?php endif; ?>


        <?php if ($etape == "surveillance"): ?>

            <form action="" method="POST">

                <h2>3. Ma Demande (Bonjour <?php echo $_SESSION['user_nom']; ?>)</h2>

                <div class="field"><label>Date début</label><input type="date" name="date_debut" required></div>

                <div class="field"><label>Date fin</label><input type="date" name="date_fin" required></div>

                <div class="field"><label>Nom contact</label><input type="text" name="contact_nom" required></div>

                <div class="field"><label>Tel contact</label><input type="text" name="contact_tel" required></div>

                <button type="submit" name="origine" value="Surveillance">Envoyer la demande</button>

            </form>

            <a href="?action=logout" class="logout-btn">Se déconnecter</a> //bouton de deconnexion qui vide la session et renvoie a l'accueil
        

        <?php endif; ?>


        <?php if ($etape == "admin_panel"): ?>

            <h2>PLANNING DE SURVEILLANCE</h2>

            <p>Mode Administrateur connecté</p>

            <table>

                <tr>

                    <th>N° Demande</th>

                    <th>Détail demande</th>

                    <th>Agent Affecté</th>

                    <th>Action</th>

                </tr>

                <?php

                $reponse = $pdo->query("SELECT d.*, u.nom, u.prenom, u.adresse FROM demande_surveillance d JOIN utilisateur u ON d.id_utilisateur = u.id_utilisateur");

                $agents = $pdo->query("SELECT * FROM agent")->fetchAll();

               

                while ($donnees = $reponse->fetch()) {

                    echo "<tr>";

                    echo "<td>".$donnees['id_demande']."</td>";

                    echo "<td>M. ".$donnees['nom'].", ".$donnees['adresse']."</td>";

                    echo "<form action='' method='POST'>";

                    echo "<td><select name='agent'>";

                    echo "<option value=''>Choisir Agent</option>";

                    foreach ($agents as $agent) {

                        $sel = ($donnees['agent_affecte'] == $agent['nom_agent']) ? "selected" : "";

                        echo "<option value='".$agent['nom_agent']."' $sel>".$agent['nom_agent']."</option>";

                    }

                    echo "</select></td>";

                    echo "<td>

                            <input type='hidden' name='id_demande' value='".$donnees['id_demande']."'>

                            <button type='submit' name='origine' value='Affecter' style='background:#2ecc71;'>Affecter</button>

                          </td>";

                    echo "</form></tr>";

                }

                ?>

            </table>

            <br><a href="?action=logout" class="logout-btn">Déconnexion Admin</a>

        <?php endif; ?>


        <?php if ($etape == "termine"): ?>

            <h2>Merci !</h2>

            <p>Votre demande a été enregistrée.</p>

            <a href="?action=logout" class="logout-btn">Quitter et se déconnecter</a>

        <?php endif; ?>


    </div>

</body>

</html> 