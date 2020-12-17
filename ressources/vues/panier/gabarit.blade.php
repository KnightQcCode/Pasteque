<!DOCTTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>La Pastèque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/liaisons/css/styles.min.css">
    <link href="../public/liaisons/images/favicon.svg" type="image/svg" rel="icon" />
    <script src="https://kit.fontawesome.com/45ab3eb1c1.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    @include('panier.fragments.entete')
</header>

<main class="conteneur">
    @yield('contenu')
</main>

<footer class="pied" role="contentinfo">
    @include('panier.fragments.pieddepage')
</footer>
<script type="text/javascript" src="../node_modules/requirejs/require.js" data-main="liaisons/js/app/app.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script type="text/javascript">
</script>
</body>
</html>




