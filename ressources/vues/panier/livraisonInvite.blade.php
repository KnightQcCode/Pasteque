@extends('panier.gabarit')
@section('contenu')
    <div class="picture__transaction">
        <picture>
            <source media="(min-width:600px)" srcset="liaisons/images/stepleft_etape1.svg">
            <img src="liaisons/images/stepleft_etape1.svg" alt="stepleft etape 1">
        </picture>
    </div>
    <h2 class="livraison__titre">{{$nomPage}}</h2>
    <form class="livraison__form" method="POST" action="index.php?controleur=panier&action=insererLivraisonInvite">
        <div class="pageLivraison">
            <div>
                <div class="pageLivraison__identification">
                    <h3 class="pageLivraison__identification__sousTitre">Identification</h3>
                    <div class="pageLivraison__identification__nom">
                        <label for="nom">Votre nom</label>
                        <input
                                @if($tValidation != null)
                                @if($tValidation['nom']['message'] != "")
                                class="erreur pageLivraison__identification__nom--input"
                                @else
                                class="pageLivraison__identification__nom--input"
                                @endif
                                @endif
                                type="text"
                                name="nom"
                                id="nom"
                                pattern="^[a-zA-ZÀ-ÿ '-]+$"
                                @if($tValidation != null)
                                value="{{ $tValidation['nom']['valeur'] }}"
                                @endif
                                title="Caractères alphabétiques français seulement."
                                required
                        >

                    </div>
                    <div class="pageLivraison__identification__nom">
                        <label for="prenom">Votre prenom</label>
                        <input
                                @if($tValidation != null)
                                @if($tValidation['prenom']['message'] != "")
                                class="erreur pageLivraison__identification__nom--input"
                                @else
                                class="pageLivraison__identification__nom--input"
                                @endif
                                @endif
                                type="text"
                                name="prenom"
                                id="prenom"
                                pattern="^[a-zA-ZÀ-ÿ\-\s]*"
                                @if($tValidation != null)
                                value="{{ $tValidation['prenom']['valeur'] }}"
                                @endif
                                title="Caractères alphabétiques français seulement."
                                required
                        >
                    </div>
                    <p class="erreurMessage erreurNomLivraison">
                        @if($tValidation != null)
                            @if($tValidation['prenom']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['prenom']['message'] }}
                            @endif
                        @endif
                    </p>
                    <div class="pageLivraison__identification__courriel">
                        <label for="courriel_livraison">Courriel</label>
                        <input
                                @if($tValidation != null)
                                @if($tValidation['courriel']['message'] != "")
                                class="erreur pageLivraison__identification__courriel--input"
                                @else
                                class="pageLivraison__identification__courriel--input"
                                @endif
                                @endif
                                type="text"
                                name="courriel"
                                id="courriel"
                                pattern="^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$"
                                @if($tValidation != null)
                                value="{{$tValidation['courriel']['valeur']}}"
                                @endif
                                required>
                    </div>
                    <p class="erreurMessage erreurCourrielLivraison">
                        @if($tValidation != null)
                        @if($tValidation['courriel']['message'] != "")
                            <span class="spriteRETRO spriteRETRO--warning"></span>
                            {{ $tValidation['courriel']['message'] }}
                        @endif
                        @endif
                    </p>
                <div class="pageLivraison__adresseLivraison">
                    <h3 class="pageLivraison__adresseLivraison__sousTitre">Adresse de livraison</h3>
                    <div class="pageLivraison__adresseLivraison__adresse">
                        <label for="adresse_livraison">Adresse</label>
                        <input
                                @if($tValidation != null)
                                @if($tValidation['adresse_livraison']['message'] != "")
                                class="erreur pageLivraison__adresseLivraison__adresse--input"
                                @else
                                class="pageLivraison__adresseLivraison__adresse--input"
                                @endif
                                @endif
                                type="text"
                                name="adresse_livraison"
                                id="adresse_livraison"
                                pattern="^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$"
                                @if($tValidation != null)
                                value="{{$tValidation['adresse_livraison']['valeur']}}"
                                @endif
                                required
                        >
                    </div>
                    <p class="erreurMessage erreurAdresseLivraison">
                        @if($tValidation != null)
                        @if($tValidation['adresse_livraison']['message'] != "")
                            <span class="spriteRETRO spriteRETRO--warning"></span>
                            {{ $tValidation['adresse_livraison']['message'] }}
                        @endif
                        @endif
                    </p>
                    <div class="pageLivraison__adresseLivraison__ville">
                        <label for="ville_livraison">Ville</label>
                        <input
                                @if($tValidation != null)
                                @if($tValidation['ville_livraison']['message'] != "")
                                class="erreur pageLivraison__adresseLivraison__ville--input"
                                @else
                                class="pageLivraison__adresseLivraison__ville--input"
                                @endif
                                @endif
                                type="text"
                                name="ville_livraison"
                                id="ville_livraison"
                                pattern="^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$"
                                @if($tValidation != null)
                                value="{{$tValidation['ville_livraison']['valeur']}}"
                                @endif
                                required
                        >
                    </div>
                    <p class="erreurMessage erreurVilleLivraison">
                        @if($tValidation != null)
                        @if($tValidation['ville_livraison']['message'] != "")
                            <span class="spriteRETRO spriteRETRO--warning"></span>
                            {{ $tValidation['ville_livraison']['message'] }}
                        @endif
                            @endif
                    </p>
                    <div class="pageLivraison__adresseLivraison__province">
                        <label class="pageLivraison__adresseLivraison__province__label">Province
                            <select
                                    @if($tValidation != null)
                                    @if($tValidation['province_livraison']['message'] != "")
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
                                <option @if($tValidation != null) @if($tValidation['province_livraison']['valeur'] == "QC") selected @endif @endif value="QC">Québec</option>
                                <option @if($tValidation != null) @if($tValidation['province_livraison']['valeur'] == "ON") selected @endif @endif value="ON">Ontario</option>
                                <option @if($tValidation != null) @if($tValidation['province_livraison']['valeur'] == "TNL") selected @endif @endif value="TNL">Terre-Neuve et Labrador</option>
                                <option @if($tValidation != null) @if($tValidation['province_livraison']['valeur'] == "NB") selected @endif @endif value="NB">Nouveau-Brunswick</option>
                            </select>
                        </label>
                    </div>
                    <p class="erreurMessage erreurProvinceLivraison">
                        @if($tValidation != null)
                        @if($tValidation['province_livraison']['message'] != "")
                            <span class="spriteRETRO spriteRETRO--warning"></span>
                            {{ $tValidation['province_livraison']['message'] }}
                        @endif
                        @endif
                    </p>
                    <div class="pageLivraison__adresseLivraison__pays">
                        <label class="pageLivraison__adresseLivraison__pays__label">Pays
                            <select
                                    @if($tValidation != null)
                                    @if($tValidation['pays_livraison']['message'] != "")
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
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "Canada") selected @endif @endif value="Canada">Canada</option>
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "Etats_Unis") selected @endif @endif  value="Etats_Unis">États-Unis</option>
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "Belgique") selected @endif @endif  value="Belgique">Belgique</option>
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "France") selected @endif @endif  value="France">France</option>
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "Suisse") selected @endif @endif  value="Suisse">Suisse</option>
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "Cote_Ivoire") selected @endif @endif value="Cote_Ivoire">Côte d’Ivoire </option>
                                <option @if($tValidation != null) @if($tValidation['pays_livraison']['valeur'] == "Senegal") selected @endif @endif  value="Senegal">Sénégal</option>
                            </select>
                        </label>
                    </div>
                    <p class="erreurMessage erreurPaysLivraison">
                        @if($tValidation != null)
                        @if($tValidation['pays_livraison']['message'] != "")
                            <span class="spriteRETRO spriteRETRO--warning"></span>
                            {{ $tValidation['pays_livraison']['message'] }}
                        @endif
                        @endif
                    </p>
                    <div class="pageLivraison__adresseLivraison__codePostal">
                        <label for="codePostal">Code postal  <i>(Ex: G1W 4S2)</i></label>
                        <input
                                @if($tValidation != null)
                                @if($tValidation['code_postal_livraison']['message'] != "")
                                class="erreur pageLivraison__adresseLivraison__codePostal--input"
                                @else
                                class="pageLivraison__adresseLivraison__codePostal--input"
                                @endif
                                @endif
                                type="text"
                                name="codePostal_livraison"
                                id="codePostal_livraison"
                                @if($tValidation != "")
                                value="{{$tValidation['code_postal_livraison']['valeur']}}"
                                @endif
                                pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]"
                                title="Le format attendu est X1X 1X1"
                                required
                        >
                    </div>
                    <p class="erreurMessage erreurCodePostalLivraison">
                        @if($tValidation != null)
                        @if($tValidation['code_postal_livraison']['message'] != "")
                            <span class="spriteRETRO spriteRETRO--warning"></span>
                            {{ $tValidation['code_postal_livraison']['message'] }}
                        @endif
                        @endif
                    </p>
                    <div class="pageLivraison__adresseLivraison__memeAdresse">
                        <input type="checkbox" for="memeAdresse" name="memeAdresse" id="memeAdresse" @if($tValidation != null) @if($tValidation['memeAdresse']['valeur'] == 'on') checked @endif @endif>
                        <label for="memeAdresse">Utiliser la même adresse de facturation</label>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <button class="btnLivraison boutons boutons--btnGeneral" type="submit" id="btnLivraison">Continuer</button>
    </form>
@endsection