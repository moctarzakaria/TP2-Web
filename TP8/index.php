<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portail Personnel - BTS SIO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --text-color: #1e293b;
            --border-color: #cbd5e1;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--bg-gradient);
            color: var(--text-color);
        }

        header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            width: 108px;
            height: 105px;
            border: 2px dashed var(--primary-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            overflow: hidden;
        }

        .logo-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        header nav ul {
            display: flex;
            list-style: none;
            gap: 10px;
            margin: 0;
            padding: 0;
        }

        header nav a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        header nav a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .container {
            display: flex;
            flex: 1;
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            width: 220px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 15px;
            height: fit-content;
            position: sticky;
            top: 140px;
        }

        .sidebar h3 {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: var(--primary-color);
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .sidebar li {
            margin-bottom: 5px;
        }

        .sidebar li a {
            text-decoration: none;
            color: var(--text-color);
            font-size: 0.85rem;
            display: block;
            padding: 8px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar li a:hover {
            background: #eff6ff;
            color: var(--primary-color);
        }

        main {
            flex: 1;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        footer {
            padding: 1.5rem;
            text-align: center;
            font-size: 0.85rem;
            background: white;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        .footer-links {
            margin-top: 5px;
        }

        .footer-links a {
            color: var(--primary-color);
            text-decoration: none;
            margin-left: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 60%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-modal:hover { color: black; }

        html { scroll-behavior: smooth; }
    </style>
</head>

<body>

    <header>
        <div class="logo-container">
            <img src="Image/zak.png" alt="Mon Logo">
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php
                // Boucle pour TP1 à TP7
                for ($i = 1; $i <= 7; $i++) {
                    echo "<li><a href='?page=tp$i'>TP$i</a></li>";
                }
                // Ajout manuel du TP9a et TP9b
                echo "<li><a href='?page=tp9a'>TP9a</a></li>";
                echo "<li><a href='?page=tp9b'>TP9b</a></li>";
                echo "<li><a href='?page=tp6a'>TP6a</a></li>";
                echo "<li><a href='?page=tp10'>TP10</a></li>";
                ?>
            </ul>
        </nav>
    </header>

    <div class="container">
        <aside class="sidebar">
            <?php
            $currentPage = isset($_GET['page']) ? strtolower($_GET['page']) : '';
            
            // Configuration du menu latéral mise à jour avec TP9b
            $menu_exos = [
                'tp4' => 3,
                'tp5' => 3,
                'tp7' => 7,
                'tp9a' => 1,
                'tp9b' => 1,
                'tp6a' => 1,
                'tp10' => 1,
            ];

            if (array_key_exists($currentPage, $menu_exos)) {
                echo "<h3>Exercices " . strtoupper($currentPage) . "</h3>";
            } else {
                echo "<h3>Informations</h3>";
                echo "<p style='text-align:center; color: #94a3b8; font-size: 0.8rem;'>Sélectionnez un TP pour voir les détails.</p>";
            }
            ?>
        </aside>

        <main>
            <?php
            if (isset($_GET['page'])) {
                $page = strtolower($_GET['page']);
                
                $paths = [
                    strtoupper($page) . ".php",
                    strtoupper($page) . ".html",
                    $page . ".php",
                    $page . ".html"
                ];

                if($page == 'tp7') array_unshift($paths, "TP7/index.html", "TP7/index.php");

                $found = false;
                foreach ($paths as $path) {
                    if (file_exists($path)) {
                        include $path;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    echo "<div style='color:#ef4444; background:#fef2f2; padding:15px; border-radius:8px; border:1px solid #fecaca;'>
                            Fichier <b>" . strtoupper($page) . "</b> introuvable.
                          </div>";
                }
                
            } else {
                echo "<h1>Bienvenue</h1><p>Veuillez choisir un TP dans le menu supérieur.</p>";
            }
            ?>
        </main>
    </div>

    <footer>
        <div>BTS SIO_1 | Lycée Algoud-Laffemas | 2026</div>
        <div class="footer-links">
            <a href="#" id="openModal">Mentions Légales</a>
        </div>
    </footer>

    <div id="legalModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Mentions Légales</h2>
            <hr>
            <h3>1. Éditeur du site</h3>
            <p>Ce site est réalisé dans le cadre pédagogique du BTS Services Informatiques aux Organisations (SIO).<br>
            <strong>Auteur :</strong> ZAKARIA <br>
            <strong>Établissement :</strong> Lycée Algoud-Laffemas, Valence.</p>

            <h3>2. Hébergement</h3>
            <p>Ce site est hébergé localement ou sur les serveurs de l'établissement scolaire à des fins d'apprentissage.</p>

            <h3>3. Propriété intellectuelle</h3>
            <p>Les codes sources et travaux présentés sont le résultat d'exercices pratiques. Sauf mention contraire, les contenus sont la propriété de l'auteur.</p>

            <h3>4. Protection des données</h3>
            <p>Ce site ne collecte aucune donnée personnelle et n'utilise aucun cookie de traçage publicitaire.</p>
        </div>
    </div>

    <script>
        const modal = document.getElementById("legalModal");
        const btn = document.getElementById("openModal");
        const span = document.getElementsByClassName("close-modal")[0];

        btn.onclick = function(e) {
            e.preventDefault();
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>