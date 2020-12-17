@extends('gabarit')

@section('contenu')
    <h2 class="titreConnexion">{{$titrePage}}</h2>
    <div class="connexion">
        <form action="index.php?controleur=panier&action=livraison" method="POST" class="connexion__form" novalidate>
            <div class="connexion__form__courriel">
                <div class="connexion__form__courriel__icone">
                    <i class="icone__courriel fas fa-envelope fa-2x"></i>
                    <span class="icone__courriel" aria-hidden="true"></span>
                    <p class="screen-reader-only">Icône du courriel</p>
                </div>
                <p class="connexion__form__courriel__infos">
                    <label for="courriel">Courriel</label>
                    @foreach($connexionCompte as $connexion)
                        <input type="text" id="courriel" name="courriel" value="{{ $connexion->courriel }}" placeholder="Courriel" required>
                    @endforeach
                </p>
            </div>
            <div class="connexion__form__motDePasse">
                <div class="connexion__form__motDePasse__iconeMdp">
                    <i class="icone__mdp fas fa-lock fa-2x"></i>
                    <span class="icone__mdp" aria-hidden="true"></span>
                    <p class="screen-reader-only">Icône du mot de passe</p>
                </div>
                <p class="connexion__form__motDePasse__infos">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input class="mot_de_passe" type="password" id="mot_de_passe" name="mot_de_passe" value="{{ $connexion->mot_de_passe }}" placeholder="Mot de passe" required>
                </p>
                <a class="connexion__form__motDePasse__iconeVoirPlus">
                    <label class="connexion__form__motDePasse__iconeVoirPlus__cocher" for="checkbox">
                        <input hidden type="checkbox" id="checkbox" name="checkbox" value="1">
                            <i class="icone__afficher fas fa-eye fa-2x" id="icoMdp"></i>
                            <span class="icone__afficher" aria-hidden="true"></span>
                            <span class="connexion__form__motDePasse__iconeVoirPlus__cocher__texte" id="MotDePasse">Afficher le mot de passe</span>
                    </label>
                    <p class="screen-reader-only">Afficher/Cacher le mot de passe</p>
                </a>
                <div class="connexion__form__motDePasse__lienOublie">
                    <a href="">Mot de passe oublié ?</a>
                </div>
            </div>
            <div class="connexion__form__boutonsActions">
                    <button type="submit" class="boutons boutons--btnGeneral" name="btConnexion" >Me connecter</button>
            </div>
        </form>
        <div class="connexion__invite">
            <h3 class="connexion__invite__titre">Continuer vos achats à La Pastèque comme invité.</h3>
            <form action="index.php?controleur=panier&action=livraisonInvite" method="POST">
                <div class="connexion__invite__boutonsActions">
                    <button type="submit" class="boutons boutons--btnGeneral" name="btConnexionInvite">Poursuivre en tant qu’invité</button>
                </div>
            </form>
        </div>
        <div class="connexion__dejaCompte">
            <h3 class="connexion__dejaCompte__titre">Vous n'avez pas de compte à La Pastèque?</h3>
            <form action="index.php?controleur=site&action=creerCompte" method="POST">
                <div class="connexion__dejaCompte__boutonsActions">
                    <button type="submit" class="boutons boutons--btnGeneral" name="btInscription">Créer un compte</button>
                </div>
            </form>
        </div>
    </div>
@endsection