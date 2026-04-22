<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Mémento HTML5</title>
    <link rel="stylsheet" href="style.css">
</head>
<body>

    <header>
        <h1>Mémento des balises HTML5</h1>
        <p>Ce document recense les balises observées sur Alsacréations.</p>
    </header>

    <main>
        <table>
                <tr>
                    <th>Balise</th>
                    <th>Rôle / Description</th>
                    <th>Exemple de code</th>
                    <th>Aperçu visuel</th>
                </tr>
            <tbody>
                <tr>
                    <td><code>&lt;section&gt;</code></td>
                    <td>Définit une section thématique dans un document.</td>
                    <td><code>&lt;section&gt;...&lt;/section&gt;</code></td>
                    <td class="preview"><em>(Bloc invisible sans style)</em></td>
                </tr>
                <tr>
                    <td><code>&lt;mark&gt;</code></td>
                    <td>Met en valeur (surligne) un texte important.</td>
                    <td><code>&lt;mark&gt;Texte important&lt;/mark&gt;</code></td>
                    <td class="preview"><mark>Texte important</mark></td>
                </tr>
                <tr>
                    <td><code>&lt;figure&gt;</code></td>
                    <td>Regroupe un contenu illustratif (image, schéma) et sa légende.</td>
                    <td><code>&lt;figure&gt;...&lt;/figure&gt;</code></td>
                    <td class="preview">Contenu illustré</td>
                </tr>
                <tr>
                    <td><code>&lt;time&gt;</code></td>
                    <td>Représente une date ou une heure précise (lisible par les machines).</td>
                    <td><code>&lt;time datetime="2026-02-02"&gt;Aujourd'hui&lt;/time&gt;</code></td>
                    <td class="preview"><time>02 Février</time></td>
                </tr>
                </tbody>
        </table>
    </main>
</body>
</html>