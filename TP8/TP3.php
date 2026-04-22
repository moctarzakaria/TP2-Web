<h1>1. Le langage SQL</h1>

<h2>1.1. Définition</h2>

<p>
    Le langage SQL (<strong>Structured Query Language</strong> ou Langage de requêtes structuré) 
    est un langage comprenant à lui seul l’ensemble des ordres nécessaires à la création et à la 
    gestion d’une base de données relationnelle. Il a été créé en 1986...
</p>

<h2>1.2. Les différentes normes utilisées</h2>

<p>
    Il existe aujourd'hui plusieurs normes relatives à l'utilisation du langage SQL. 
    La différence entre ces deux normes se situe principalement dans l'écriture des 
    jointures et dans l'ajout de fonctionnalités :
</p>

<ul>
    <li>La norme SQL 89 qui est encore très utilisée actuellement.</li>
    <li>La norme SQL 92.</li>
    <li>Aujourd'hui SQL 2011.</li>
</ul>

<p>
    Bien qu'il existe des normes il peut y avoir des différences entre SGBDR dans la syntaxe. 
    Ainsi on peut lire sur le site de PostgreSQL :
</p>

<blockquote>
    <ul>
        <li>"Le développement de PostgreSQL respecte le standard en vigueur..."</li>
        <li>"SQL-92 définit trois niveaux de conformité : basique (ENTRY)..."</li>
    </ul>
</blockquote>

<h1>2. Le modèle de données utilisé dans le cours</h1>

<h2>2.1. Le modèle entité-association (ou MCD) d'un établissement hospitalier</h2>
<h2>2.2. Le modèle relationnel (ou MRD) d'un établissement hospitalier</h2>
<h2>2.3. La description textuelle des tables utilisées</h2>

<p>
    <code>fonction_personnel (<strong>code_fonction</strong>, libelle_fonction)</code><br>
    Clé primaire : code_fonction
</p>

<p>
    <code>service (<strong>num_service</strong>, libelle_service, capacite_accueil, date_ouverture)</code><br>
    Clé primaire : num_service
</p>