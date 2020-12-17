@extends('gabarit')

@section('contenu')
    @if(isset($_SESSION['tValidation']) == true)
        <?php
        $tValidation = $_SESSION['tValidation'];
        $_SESSION['tValidation']=null;
        ?>
    @endif
    <h2 class="titreCreerCompte">{{$titrePage}}</h2>
    <div class="creerCompte">
        <form action="index.php?controleur=site&action=insererCompte" method="POST" class="creerCompte__form" novalidate>
            <div class="creerCompte__form__prenom">
                <div class="creerCompte__form__prenom__icone">
                    <i class="icone__prenom fas fa-user fa-2x"></i>
                    <span class="icone__prenom" aria-hidden="true"></span>
                    <p class="screen-reader-only">Icône du prénom</p>
                </div>
                <p class="creerCompte__form__prenom__infos">
                    <label for="prenom">Prénom</label>
                    <input type="text"
                           name="prenom"
                           id="prenom"
                           @if($tValidation != "")
                           value="{{$tValidation[0]['valeur']}}"
                           @endif
                           @if($tValidation != "")
                           @if($tValidation[0]['valide'] == false)
                           class="erreur"
                           @endif
                           @endif
                           pattern="^[a-zA-ZÀ-ÿ '-]+$"
                           title="Caractères alphabétiques français seulement."
                           required
                    >
                </p>
            </div>
            @if($tValidation != "")
                @if($tValidation[0]['valide'] == false)
                    <p class="erreur__message erreurPrenomCompte"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation[0][0]}}</p>
                @endif
            @endif
            <div class="creerCompte__form__nom">
                <div class="creerCompte__form__nom__icone">
                    <i class="icone__nom fas fa-user fa-2x"></i>
                    <span class="icone__nom" aria-hidden="true"></span>
                    <p class="screen-reader-only">Icône du nom</p>
                </div>
                <p class="creerCompte__form__nom__infos">
                    <label for="nom">Nom</label>
                    <input type="text"
                           name="nom" id="nom"
                           @if($tValidation != "")
                           value="{{$tValidation[1]['valeur']}}"
                           @endif
                           @if($tValidation != "")
                           @if($tValidation[1]['valide'] == false)
                           class="erreur"
                           @endif
                           @endif
                           pattern="^[a-zA-ZÀ-ÿ '-]+$"
                           title="Caractères alphabétiques français seulement."
                           required
                    >
                </p>
            </div>
            @if($tValidation != "")
                @if($tValidation[1]['valide'] == false)
                    <p class="erreur__message erreurNomCompte"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation[1][0]}}</p>
                @endif
            @endif
            <div class="creerCompte__form__courriel">
                <div class="creerCompte__form__courriel__icone">
                    <i class="icone__courriel fas fa-envelope fa-2x"></i>
                    <span class="icone__courriel" aria-hidden="true"></span>
                    <p class="screen-reader-only">Icône du courriel</p>
                </div>
                <p class="creerCompte__form__courriel__infos">
                    <label for="courriel">Courriel</label>
                        <input type="text"
                               id="courriel"
                               name="courriel"
                               @if($tValidation != "")
                               value="{{$tValidation[2]['valeur']}}"
                               @endif
                               @if($tValidation != "")
                               @if($tValidation[2]['valide'] == false)
                               class="erreur"
                               @endif
                               @endif
                               pattern="^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$"
                               required
                        >
                </p>
            </div>
            @if($tValidation != "")
                @if($tValidation[2]['valide'] == false)
                    <p class="erreur__message erreurCourrielCompte"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation[2][0]}}</p>
                @endif
            @endif

            <div class="creerCompte__form__motDePasse">
                <div class="creerCompte__form__motDePasse__icone">
                    <i class="icone__motDePasse fas fa-lock fa-2x"></i>
                    <span class="icone__motDePasse" aria-hidden="true"></span>
                    <p class="screen-reader-only">Icône du mot de passe</p>
                </div>
                <p class="creerCompte__form__motDePasse__infos">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input
                           type="password"
                           id="mot_de_passe"
                           name="mot_de_passe"
                           @if($tValidation != "")
                           value="{{$tValidation[3]['valeur']}}"
                           @endif
                           @if($tValidation != "")
                           @if($tValidation[3]['valide'] == false)
                           class="erreur"
                           @endif
                           @endif
                           maxlength="10"
                           pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$"
                           required
                    >
                </p>
                <p class="creerCompte__form__motDePasse__instructions">8 à 10 caractères, lettres et chiffres, une majuscule.</p>

                <a class="creerCompte__form__motDePasse__iconeVoirPlus">
                    <label class="creerCompte__form__motDePasse__iconeVoirPlus__cocher" for="checkbox">
                        <input hidden type="checkbox" id="checkbox" name="checkbox">
                        <i class="icone__afficher fas fa-eye fa-2x" id="icoMdp"></i>
                        <span class="icone__afficher" aria-hidden="true"></span>
                        <span class="creerCompte__form__motDePasse__iconeVoirPlus__cocher__texte" id="MotDePasse">Afficher le mot de passe</span>
                    </label>
                    <p class="screen-reader-only">Afficher/Cacher le mot de passe</p>
                </a>
            </div>
            @if($tValidation != "")
                @if($tValidation[3]['valide'] == false)
                    <p class="erreur__message erreurMDPCompte"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation[3][0]}}</p>
                @endif
            @endif
            <div class="creerCompte__form__boutonsActions">
                <button type="submit" class="boutons boutons--btnGeneral" name="btCreerCompte" >Créer mon compte</button>
            </div>
        </form>
        <div class="creerCompte__dejaCompte">
            <h3 class="creerCompte__dejaCompte__titre">Vous avez déjà un compte à La Pastèque?</h3>
            <form action="index.php?controleur=site&action=connexionCompte" method="POST">
                <div class="creerCompte__dejaCompte__boutonsActions">
                    <button type="submit" class="boutons boutons--btnGeneral" name="btConnexion">Se connecter</button>
                </div>
            </form>
        </div>
        <div class="creerCompte__invite">
            <h3 class="creerCompte__invite__titre">Continuer vos achats à La Pastèque de façon anonyme?</h3>
            <form action="index.php?controleur=site&action=accueil" method="POST">
                <div class="creerCompte__invite__boutonsActions">
                    <button type="submit" class="boutons boutons--btnGeneral" name="btConnexionInvite">Poursuivre en tant qu’invité</button>
                </div>
            </form>
        </div>
    </div>
@endsection