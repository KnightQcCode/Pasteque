<div class="entete">
    <div class="contenu__entete conteneur">
        <a class="logo" href="index.php?controleur=site&action=accueil"><img class="" src="liaisons/images/Logo.png" alt="logo"></a>
        <a id="menu">
            <div id="menu" class="menuHamburger">
                <div id="pencet">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </a>
        <div class="sinscireRechercher">
            <div class="sinscrirePanier">

                <a class="connexion" href="index.php?controleur=site&action=connexionCompteAccueil">@if($_SESSION['client2'] != 100){{$_SESSION['clientPrenom']}} {{$_SESSION['clientNom']}}@else Se connecter (Invité) @endif</a>
                <p>|</p>
                <a class="sinscrire" href="index.php?controleur=site&action=creerCompte">S'inscrire</a>
                <div class="sinscrirePanier__panier">
                    <a class="panier__lien" href="index.php?controleur=panier&action=index">Votre panier<i class="fas fa-shopping-cart"></i><span id="panierEntete">@if(isset($_SESSION['nbItemPanier']))({{$_SESSION['nbItemPanier']}})@endif</span></a>
                </div>
            </div>
            <div class="champRechercher">
                <form method="POST" action="index.php?controleur=livre&action=rechercher">
                    <label class="champRechercher__parLabel" for="rechercherPar">
                        <select class="champRechercher__parSelect" name="rechercherPar">
                            <option value="isbn_papier">ISBN</option>
                            <option value="titre">Titre</option>
                            <option value="nom">Artiste</option>
                        </select>
                    </label>
                    <label class="champRechercher__label" for="rechercher">Rechercher</label>
                    <input class="champRechercher__input" type="text" id="rechercher" name="rechercher" placeholder="Rechercher">
                    <button class="champRechercher__search" type="submit"><i class="fas fa-search fa-2x"></i></button>
                </form>
            </div>
        </div>
    </div>

    <nav class="navigation">
        <div class="conteneur  menu__mobile">
            <div class="navigation__liste__section">
                <a id="jeRecherche"><i class="navigation__liste__section--recherche fas fa-search fa-2x"></i></a>
                <div class="sinscrirePanier__panier">
                    <a class="panier__lien" href="index.php?controleur=panier&action=index">Votre panier<i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
            <div class="menu__fermer" id="champRechercher">
                <form class="form__mobile" method="POST" action="index.php?controleur=livre&action=rechercher">
                    <label class="champRechercher__parLabel" for="rechercherPar">
                        <select class="champRechercher__parSelect" name="rechercherPar">
                            <option value="isbn_papier">ISBN</option>
                            <option value="titre">Titre</option>
                            <option value="nom">Artiste</option>
                        </select>
                    </label>
                    <label class="champRechercher__label" for="rechercher">Rechercher</label>
                    <input class="champRechercher__input" type="text" id="rechercher" name="rechercher" placeholder="Rechercher">
                </form>
            </div>
            <div id="nav" class="menu__fermer">
                <div class="nav navigation">
                    <ul class="navigation__liste">
                        <li class="navigation__liste--item"><a href="index.php?controleur=livre&action=index">Livres</a></li>
                        <li class="navigation__liste--item"><a href="index.php?controleur=auteur&action=index">Artistes</a></li>
                        <li class="navigation__liste--item"><a href="#">À propos</a></li>
                        <li class="navigation__liste--item"><a href="#">Galerie/Boutique</a></li>
                        <li class="navigation__liste--item"><a href="#">Productions La Pastèque</a></li>
                        <li class="navigation__liste--item"><a href="#">Contact</a></li>
                    </ul>
                    <div class="sinscireRechercher_mobile">
                        <div class="sinscrirePanier">
                            <a class="connexion" href="index.php?controleur=site&action=connexionCompte">Se connecter</a>
                            <p>|</p>
                            <a class="sinscrire" href="index.php?controleur=site&action=creerCompte">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
