@extends('panier.gabarit')
@section('contenu')
    <?php
    $identifiant=$_POST['courriel']

    ?>
    <div class="picture__transaction">
        <picture>
            <source media="(min-width:600px)" srcset="liaisons/images/stepleft_etape1.svg">
            <source media="(max-width:599px)" srcset="liaisons/images/stepleft_mobile_etape1.svg">
            <img src="liaisons/images/stepleft_etape1.svg" alt="stepleft etape 1">
        </picture>
    </div>
    <h2 class="livraison__titre">{{$nomPage}}</h2>
    <form class="livraison__form" method="POST" action="index.php?controleur=panier&action=insererLivraison" novalidate>
        <div class="pageLivraison">
            <div>
                <div class="pageLivraison__identification">
                    <h3 class="pageLivraison__identification__sousTitre">Identification</h3>
                    <div class="pageLivraison__identification__nom">
                        <label for="nom">Votre nom complet</label>
                        <input
                                @if($tValidation != "")
                                @if($tValidation['nom']['valide'] == false)
                                class="erreur pageLivraison__identification__nom--input"
                                @else
                                class="pageLivraison__identification__nom--input"
                                @endif
                                @endif
                                type="text"
                                name="nom"
                                id="nom"
                                value="@if(isset($identifiant)){{$infoClient[0]->prenom}} {{$infoClient[0]->nom}}@else{{$tValidation['nom']['valeur']}}@endif"
                                title="Caractères alphabétiques français seulement."
                                pattern="^[a-zA-ZÀ-ÿ '-]+$"
                                required
                        >
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['nom']['valide'] == false)
                            <p class="erreur__message erreurNomLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['nom']['message']}}</p>
                        @endif
                    @endif

                    <div class="pageLivraison__identification__courriel">
                        <label for="courriel_livraison">Courriel</label>
                        <input
                                @if($tValidation != "")
                                @if($tValidation['courriel']['valide'] == false)
                                class="erreur pageLivraison__identification__courriel--input"
                                @else
                                class="pageLivraison__identification__courriel--input"
                                @endif
                                @endif
                                type="text"
                                name="courriel"
                                id="courriel"
                                pattern="^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$"
                                value="@if(isset($identifiant)){{$identifiant}}@else{{$tValidation['courriel']['valeur']}}@endif"
                                required
                        >
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['courriel']['valide'] == false)
                            <p class="erreur__message erreurCourrielLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['courriel']['message']}}</p>
                        @endif
                    @endif
                    <div class="pageLivraison__identification__motDePasse">
                        <label for="mot_de_passe">Mot de passe</label>
                        <input
                                @if($tValidation != "")
                                @if($tValidation['mot_de_passe']['valide'] == false)
                                class="erreur pageLivraison__identification__motDePasse--input"
                                @else
                                class="pageLivraison__identification__motDePasse--input"
                                @endif
                                @endif
                                type="text"
                                id="mot_de_passe"
                                name="mot_de_passe"
                                pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$"
                                value="@if(isset($identifiant)){{$infoClient[0]->mot_de_passe}}@else{{$tValidation['mot_de_passe']['valeur']}}@endif"
                                title="8 à 10 caractères, lettres et chiffres, une majuscule."
                                maxlength="10"
                                required
                        >
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['mot_de_passe']['valide'] == false)
                            <p class="erreur__message erreurMDPLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['mot_de_passe']['message']}}</p>
                        @endif
                    @endif
                </div>
                <div class="pageLivraison__adresseLivraison">
                    <h3 class="pageLivraison__adresseLivraison__sousTitre">Adresse de livraison</h3>
                    <div class="pageLivraison__adresseLivraison__adresse">
                        <label for="adresse_livraison">Adresse</label>
                        <input
                                @if($tValidation != "")
                                @if($tValidation['adresse_livraison']['valide'] == false)
                                class="erreur pageLivraison__adresseLivraison__adresse--input"
                                @else
                                class="pageLivraison__adresseLivraison__adresse--input"
                                @endif
                                @endif
                                type="text"
                                name="adresse_livraison"
                                id="adresse_livraison"
                                pattern="^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$"
                                value="@if(isset($identifiant)){{$infoClient[0]->no_civique}} {{$infoClient[0]->voie}}@else{{$tValidation['adresse_livraison']['valeur']}}@endif"
                                required
                        >
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['adresse_livraison']['valide'] == false)
                            <p class="erreur__message erreurAdresseLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['adresse_livraison']['message']}}</p>
                        @endif
                    @endif

                    <div class="pageLivraison__adresseLivraison__ville">
                        <label for="ville_livraison">Ville</label>
                        <input
                                @if($tValidation != "")
                                @if($tValidation['ville_livraison']['valide'] == false)
                                class="erreur pageLivraison__adresseLivraison__ville--input"
                                @else
                                class="pageLivraison__adresseLivraison__ville--input"
                                @endif
                                @endif
                                type="text"
                                name="ville_livraison"
                                id="ville_livraison"
                                pattern="^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$"
                                value="@if(isset($identifiant)){{$infoClient[0]->ville}}@else{{$tValidation['ville_livraison']['valeur']}}@endif"
                                required
                        >
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['ville_livraison']['valide'] == false)
                            <p class="erreur__message erreurVilleLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['ville_livraison']['message']}}</p>
                        @endif
                    @endif

                    <div class="pageLivraison__adresseLivraison__province">
                        <label class="pageLivraison__adresseLivraison__province__label">Province
                            <select
                                    @if($tValidation != "")
                                    @if($tValidation['province_livraison']['valide'] == false)
                                    class="erreur pageLivraison__adresseLivraison__province__label--input"
                                    @else
                                    class="pageLivraison__adresseLivraison__province__label--input"
                                    @endif
                                    @endif
                                    name="province_livraison"
                                    id="province_livraison"
                                    for="province_livraison"
                                    required>
                                <option value="">Sélectionnez une province</option>
                                <option value="QC" @if($infoClient[0]->province == "QC") selected @endif>Québec</option>
                                <option value="ON" @if($infoClient[0]->province == "ON") selected @endif>Ontario</option>
                                <option value="TNL" @if($infoClient[0]->province == "TNL") selected @endif>Terre-Neuve et Labrador</option>
                                <option value="NB" @if($infoClient[0]->province == "NB") selected @endif>Nouveau-Brunswick</option>
                            </select>
                        </label>
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['province_livraison']['valide'] == false)
                            <p class="erreur__message erreurProvinceLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['province_livraison']['message']}}</p>
                        @endif
                    @endif



                    <div class="pageLivraison__adresseLivraison__pays">
                        <label class="pageLivraison__adresseLivraison__pays__label">Pays
                            <select
                                    @if($tValidation != "")
                                    @if($tValidation['pays_livraison']['valide'] == false)
                                    class="erreur pageLivraison__adresseLivraison__pays__label--input"
                                    @else
                                    class="pageLivraison__adresseLivraison__pays__label--input"
                                    @endif
                                    @endif
                                    name="pays_livraison"
                                    id="pays_livraison"
                                    for="pays_livraison"
                                    required>
                                <option value="">Choisissez votre pays </option>
                                <option value="Canada" @if($infoClient[0]->pays == "Canada") selected @endif>Canada </option>
                                <option value="Etats_Unis" @if($infoClient[0]->pays == "Etats_Unis") selected @endif>États-Unis </option>
                                <option value="Belgique" @if($infoClient[0]->pays == "Belgique") selected @endif>Belgique </option>
                                <option value="France" @if($infoClient[0]->pays == "France") selected @endif>France </option>
                                <option value="Suisse" @if($infoClient[0]->pays == "Suisse") selected @endif>Suisse </option>
                                <option value="Cote_Ivoire" @if($infoClient[0]->pays == "Cote_Ivoire") selected @endif>Côte d’Ivoire </option>
                                <option value="Senegal" @if($infoClient[0]->pays == "Senegal") selected @endif>Sénégal </option>
                            </select>
                        </label>
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['pays_livraison']['valide'] == false)
                            <p class="erreur__message erreurPaysLivraison"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['pays_livraison']['message']}}</p>
                        @endif
                    @endif
                    <div class="pageLivraison__adresseLivraison__codePostal">
                        <label for="codePostal">Code postal  <i>(Ex: G1W 4S2)</i></label>
                        <input
                                @if($tValidation != "")
                                @if($tValidation['code_postal_livraison']['valide'] == false)
                                class="erreur pageLivraison__adresseLivraison__codePostal--input"
                                @else
                                class="pageLivraison__adresseLivraison__codePostal--input"
                                @endif
                                @endif
                                type="text"
                                name="codePostal_livraison"
                                id="codePostal_livraison"
                                value="@if(isset($identifiant)){{$infoClient[0]->code_postal}}@else{{$tValidation['code_postal_livraison']['valeur']}}@endif"
                                pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]"
                                title="Le format attendu est X1X 1X1"
                                required
                        >
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['code_postal_livraison']['valide'] == false)
                            <p class="erreur__message messagesLOL"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['code_postal_livraison']['message']}}</p>
                        @endif
                    @endif
                    <div class="pageLivraison__adresseLivraison__memeAdresse">
                        <input type="checkbox" name="memeAdresse" id="memeAdresse" @if($tValidation != null) @if($tValidation['memeAdresse']['valeur'] == 'on') checked @endif @endif>
                        <label for="memeAdresse">Utiliser la même adresse de facturation</label>
                    </div>
                </div>
            </div>
        </div>
        <button class="btnLivraison boutons boutons--btnGeneral" type="submit" id="btnLivraison">Continuer</button>
    </form>
@endsection