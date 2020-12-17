@extends('panier.gabarit')
@section('contenu')
    <div class="picture__transaction">
        <picture>
            <source media="(min-width:600px)" srcset="liaisons/images/stepleft_etape2.svg">
            <img src="liaisons/images/stepleft_etape2.svg" alt="stepleft etape 2">
        </picture>
    </div>
    <div class="facturation">
        <h2 class="facturation__titre">{{$nomPage}}</h2>

        <form class="livraison__form" method="POST" action="index.php?controleur=panier&action=insererFacturationInvite" novalidate>
            <div class="facturation__form__info">
                <div class="facturation__form__info__titre">
                    <h4 class="facturation__form__info__titre__h4">Information de contact</h4>
                    <a class="facturation__form__info__titre__lien" href="#">Modifier</a>
                </div>
                <p class="livraison__info--item">{{$adresse['nom']['valeur']}}</p>
                <p class="livraison__info--item">{{$adresse['courriel']['valeur']}}</p>
                <p class="livraison__info--notice">Elles seront utilisées uniquement pour confirmer votre commande ou vous joindre en cas de besoin pour le suivi de votre commande.</p>
            </div>
            <div class="infoPaiement">
                <div class="infoPaiement__paiement">
                    <h3 class="infoPaiement__paiement--sousTitre">Information de paiement</h3>
                    <div class="infoPaiement__paiement__typePaiement">
                        <div>
                            <input
                                    type="radio"
                                    name="typePaiement"
                                    id="paypal"
                                    value="paypal"
                            >
                            <label for="paypal">Paypal</label>
                        </div>
                        <div>
                            <input
                                    class="credit"
                                    type="radio"
                                    name="typePaiement"
                                    id="credit"
                                    value="credit"
                                    required
                                    @if($tValidation != null) @if($tValidation['type_paiement']['valeur'] == "credit") checked @endif @endif
                            >
                            <label for="credit">Carte de credit</label>
                        </div>
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['type_paiement']['valide'] == false)
                            <p class="erreur__message erreurTypePaiementFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['type_paiement']['message']}}</p>
                        @endif
                    @endif
                    <div id="creditInfo" class="infoPaiement__paiement__info">
                        <p class="infoPaiement__paiement__info__soustitre">Carte de credit accepter</p>
                        <div class="infoPaiement__paiement__info__icon">
                            <i class="fab fa-cc-visa fa-2x"></i>
                            <i class="fab fa-cc-mastercard fa-2x"></i>
                            <i class="fab fa-cc-amex fa-2x"></i>
                        </div>
                        <div class="infoPaiement__paiement__info__nom">
                            <label for="nom_carte">Titulaire de la carte</label>
                            <input
                                    @if($tValidation != null)
                                    @if($tValidation['nom']['message'] != "")
                                    class="erreur infoPaiement__paiement__info__nom--input"
                                    @else
                                    class="infoPaiement__paiement__info__nom--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="nom_carte"
                                    id="nom_carte"
                                    required
                                    value="@if($tValidation != null){{$tValidation['nom']['valeur']}}@endif"
                                    pattern="^[a-zA-ZÀ-ÿ '-]+$">
                        </div>
                        <p class="erreurMessage erreurNomFacturation">
                            @if($tValidation != null)
                            @if($tValidation['nom']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['nom']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="infoPaiement__paiement__info__numero">
                            <label for="num_carte">Numéro de la carte</label>
                            <input
                                    @if($tValidation != null)
                                    @if($tValidation['numero_carte']['message'] != "")
                                    class="erreur infoPaiement__paiement__info__numero--input"
                                    @else
                                    class="infoPaiement__paiement__info__numero--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="num_carte"
                                    id="num_carte"
                                    maxlength="16"
                                    pattern="^[0-9]{16}$"
                                    value="@if($tValidation != null){{$tValidation['numero_carte']['valeur']}}@endif"
                                    required
                            >
                        </div>
                        <p class="erreurMessage erreurNumCarteFacturation">
                            @if($tValidation != null)
                            @if($tValidation['numero_carte']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['numero_carte']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="infoPaiement__paiement__info__codeSecurite">
                            <label for="codeSecurite">Code de sécurité</label>
                            <input
                                    @if($tValidation != null)
                                    @if($tValidation['numero_securite']['message'] != "")
                                    class="erreur infoPaiement__paiement__info__codeSecurite--input"
                                    @else
                                    class="infoPaiement__paiement__info__codeSecurite--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="codeSecurtie"
                                    id="codeSecurite"
                                    maxlength="3"
                                    pattern="^[0-9]{3}$"
                                    value="@if($tValidation != null){{$tValidation['numero_securite']['valeur']}}@endif"
                                    required
                            >
                        </div>
                        <p class="erreurMessage erreurNumSecuriteFacturation">
                            @if($tValidation != null)
                            @if($tValidation['numero_securite']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['numero_securite']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="infoPaiement__paiement__info__date">
                            <label class="infoPaiement__paiement__info__date__label">Date d'expiration</label>
                            <div class="infoPaiement__paiement__info__date__label__selectGroup">
                                <select
                                        @if($tValidation != null)
                                        @if($tValidation['mois']['message'] != "")
                                        class="erreur infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @else
                                        class="infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @endif
                                        @endif
                                        id="mois"
                                        name="mois_expiration"
                                        pattern="^[0-9]{1,2}$"
                                        required>
                                    <option value="">MM</option>
                                    <option value="01" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "01") selected @endif @endif>01</option>
                                    <option value="02" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "02") selected @endif @endif>02</option>
                                    <option value="03" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "03") selected @endif @endif>03</option>
                                    <option value="04" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "04") selected @endif @endif>04</option>
                                    <option value="05" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "05") selected @endif @endif>05</option>
                                    <option value="06" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "06") selected @endif @endif>06</option>
                                    <option value="07" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "07") selected @endif @endif>07</option>
                                    <option value="08" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "08") selected @endif @endif>08</option>
                                    <option value="09" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "09") selected @endif @endif>09</option>
                                    <option value="10" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "10") selected @endif @endif>10</option>
                                    <option value="11" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "11") selected @endif @endif>11</option>
                                    <option value="12" @if($tValidation != null) @if($tValidation['mois']['valeur'] == "12") selected @endif @endif>12</option>
                                </select>
                                <select
                                        @if($tValidation != null)
                                        @if($tValidation['mois']['message'] != "")
                                        class="erreur infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @else
                                        class="infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @endif
                                        @endif
                                        id="annee"
                                        name="annee_expiration"
                                        pattern="^[0-9]{1,2}$"
                                        required>
                                    <option value="">AAAA</option>
                                    <option value="2020" @if($tValidation != null) @if($tValidation['annee']['valeur'] == "2020") selected @endif @endif>2020</option>
                                    <option value="2021" @if($tValidation != null) @if($tValidation['annee']['valeur'] == "2021") selected @endif @endif>2021</option>
                                    <option value="2022" @if($tValidation != null) @if($tValidation['annee']['valeur'] == "2022") selected @endif @endif>2022</option>
                                    <option value="2023" @if($tValidation != null) @if($tValidation['annee']['valeur'] == "2023") selected @endif @endif>2023</option>
                                    <option value="#2024" @if($tValidation != null) @if($tValidation['annee']['valeur'] == "2024") selected @endif @endif>2024</option>
                                </select>
                                <p class="erreurMessage erreurMoisFacturation">
                                    @if($tValidation != null)
                                    @if($tValidation['mois']['message'] != "")
                                        <span class="spriteRETRO spriteRETRO--warning"></span>
                                        {{ $tValidation['mois']['message'] }}
                                    @endif
                                    @endif
                                </p>
                                <p class="erreurMessage erreurAnneeFacturation">
                                    @if($tValidation != null)
                                    @if($tValidation['annee']['message'] != "")
                                        <span class="spriteRETRO spriteRETRO--warning"></span>
                                        {{ $tValidation['annee']['message'] }}
                                    @endif
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pageFacturation">
                <div class="pageFacturation__adresseFacturation">
                    <h3 class="pageFacturation__adresseFacturation__sousTitre">Adresse de facturation</h3>
                    @if(isset($adresse['memeAdresse']) == true && $adresse['memeAdresse']['valeur'] == "on")
                        <div class="pageFacturation__adresseFacturation__adresse">
                            <label for="adresse">Adresse</label>
                            <input @if($tValidation != null) @if($tValidation['adresse_facturation']['message'] != "")
                                   class="erreur pageFacturation__adresseFacturation__adresse--input"
                                   @else
                                   class="pageFacturation__adresseFacturation__adresse--input"
                                   @endif
                                   @endif
                                   type="text"
                                   name="adresse_facturation"
                                   id="adresse_facturation"
                                   pattern="^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$"
                                   value="{{$adresse['adresse_livraison']['valeur']}}"
                                   required
                            >
                        </div>
                        <p class="erreurMessage erreurAdresseFacturation">
                            @if($tValidation != null)
                            @if($tValidation['adresse_facturation']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['adresse_facturation']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="pageFacturation__adresseFacturation__ville">
                            <label for="ville">Ville</label>
                            <input
                                    @if($tValidation != null)
                                    @if($tValidation['adresse_facturation']['message'] != "")
                                    class="erreur pageFacturation__adresseFacturation__ville--input"
                                    @else
                                    class="pageFacturation__adresseFacturation__ville--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="ville_facturation"
                                    id="ville_facturation"
                                    pattern="^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$"
                                    value="{{$adresse['ville_livraison']['valeur']}}"
                                    required
                            >
                        </div>
                        <p class="erreurMessage erreurVilleFacturation">
                            @if($tValidation != null)
                            @if($tValidation['ville_facturation']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['ville_facturation']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="pageFacturation__adresseFacturation__province">
                            <label class="pageFacturation__adresseFacturation__province__label">Province
                                <select
                                        @if($tValidation != null)
                                        @if($tValidation['province_facturation']['message'] != "")
                                        class="erreur pageFacturation__adresseFacturation__province__label--input"
                                        @else
                                        class="pageFacturation__adresseFacturation__province__label--input"
                                        @endif
                                        @endif
                                        name="province_facturation"
                                        id="province_facturation"
                                        for="province_facturation"
                                        required>
                                    <option value="">Sélectionnez une province</option>
                                    <option value="QC" @if($adresse['province_livraison']['valeur'] == "QC") selected @endif>Québec</option>
                                    <option value="ON" @if($adresse['province_livraison']['valeur'] == "ON") selected @endif>Ontario</option>
                                    <option value="TNL" @if($adresse['province_livraison']['valeur'] == "TNL") selected @endif>Terre-Neuve et Labrador</option>
                                    <option value="NB" @if($adresse['province_livraison']['valeur'] == "NB") selected @endif>Nouveau-Brunswick</option>
                                </select>
                            </label>
                        </div>
                        <p class="erreurMessage erreurProvinceFacturation">
                            @if($tValidation != null)
                            @if($tValidation['province_facturation']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['province_facturation']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="pageFacturation__adresseFacturation__pays">
                            <label class="pageFacturation__adresseFacturation__pays__label">Pays
                                <select
                                        @if($tValidation != null)
                                        @if($tValidation['pays_facturation']['message'] != "")
                                        class="erreur pageFacturation__adresseFacturation__pays__label--input"
                                        @else
                                        class="pageFacturation__adresseFacturation__pays__label--input"
                                        @endif
                                        @endif
                                        name="pays_facturation"
                                        id="pays_facturation"
                                        for="pays"
                                        required>
                                    <option value="Canada" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "Canada") selected @endif @endif>Canada </option>
                                    <option value="Etats_Unis" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "Etats_Unis") selected @endif @endif>États-Unis </option>
                                    <option value="Belgique" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "Belgique") selected @endif @endif>Belgique </option>
                                    <option value="France" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "France") selected @endif @endif>France </option>
                                    <option value="Suisse" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "Suisse") selected @endif @endif>Suisse </option>
                                    <option value="Cote_Ivoire" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "Cote_Ivoire") selected @endif @endif>Côte d’Ivoire </option>
                                    <option value="Senegal" @if($adresse != null) @if($adresse['pays_livraison']['valeur'] == "Senegal") selected @endif @endif>Sénégal </option>
                                </select>
                            </label>
                        </div>
                        <p class="erreurMessage erreurPaysFacturation">
                            @if($tValidation != null)
                            @if($tValidation['pays_facturation']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['pays_facturation']['message'] }}
                            @endif
                            @endif
                        </p>
                        <div class="pageFacturation__adresseFacturation__codePostal">
                            <label for="codePostal">Code postal  <i>(Ex: G1W 4S2)</i></label>
                            <input  @if($tValidation != null)
                                    @if($tValidation['code_postal_facturation']['message'] != "")
                                    class="erreur pageFacturation__adresseFacturation__codePostal--input"
                                    @else
                                    class="pageFacturation__adresseFacturation__codePostal--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="codePostal_facturation"
                                    id="codePostal_facturation"
                                    pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]"
                                    value="{{$adresse['code_postal_livraison']['valeur']}}"
                                    required
                            >
                        </div>
                        <p class="erreurMessage erreurCodePostalFacturation">
                            @if($tValidation != null)
                            @if($tValidation['code_postal_facturation']['message'] != "")
                                <span class="spriteRETRO spriteRETRO--warning"></span>
                                {{ $tValidation['code_postal_facturation']['message'] }}
                            @endif
                            @endif
                        </p>
                    @else
                        <div class="pageFacturation__adresseFacturation__adresse">
                            <label for="adresse_facturation">Adresse</label>
                            <input
                                    @if($tValidation != "")
                                    @if($tValidation['adresse_facturation']['valide'] == false)
                                    class="erreur pageFacturation__adresseFacturation__adresse--input"
                                    @else
                                    class="pageFacturation__adresseFacturation__adresse--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="adresse_facturation"
                                    id="adresse_facturation"
                                    value="@if(isset($tValidation['adresse_facturation']['valeur'])) {{$tValidation['adresse_facturation']['valeur']}} @endif"
                                    pattern="^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$"
                                    required
                            >
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['adresse_facturation']['valide'] == false)
                                <p class="erreur__message erreurAdresseFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['adresse_facturation']['message']}}</p>
                            @endif
                        @endif
                        <div class="pageFacturation__adresseFacturation__ville">
                            <label for="ville">Ville</label>
                            <input
                                    @if($tValidation != "")
                                    @if($tValidation['ville_facturation']['valide'] == false)
                                    class="erreur pageFacturation__adresseFacturation__ville--input"
                                    @else
                                    class="pageFacturation__adresseFacturation__ville--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="ville_facturation"
                                    id="ville_facturation"
                                    pattern="^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$"
                                    value="@if(isset($tValidation['ville_facturation']['valeur'])){{$tValidation['ville_facturation']['valeur']}}@endif"
                                    required
                            >
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['ville_facturation']['valide'] == false)
                                <p class="erreur__message erreurVilleFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['ville_facturation']['message']}}</p>
                            @endif
                        @endif
                        <div class="pageFacturation__adresseFacturation__province">
                            <label class="pageFacturation__adresseFacturation__province__label">Province
                                <select
                                        @if($tValidation != "")
                                        @if($tValidation['province_facturation']['valide'] == false)
                                        class="erreur pageFacturation__adresseFacturation__province__label--input"
                                        @else
                                        class="pageFacturation__adresseFacturation__province__label--input"
                                        @endif
                                        @endif
                                        name="province_facturation"
                                        id="province_facturation"
                                        for="province_facturation"
                                        value="@if(isset($tValidation['province_facturation']['valeur'])){{$tValidation['province_facturation']['valeur']}}@endif"
                                        required
                                >
                                    <option value="">Sélectionnez une province</option>
                                    <option value="QC">Québec</option>
                                    <option value="ON">Ontario</option>
                                    <option value="TNL">Terre-Neuve et Labrador</option>
                                    <option value="NB">Nouveau-Brunswick</option>
                                </select>
                            </label>
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['province_facturation']['valide'] == false)
                                <p class="erreur__message erreurProvinceFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['province_facturation']['message']}}</p>
                            @endif
                        @endif
                        <div class="pageFacturation__adresseFacturation__pays">
                            <label class="pageFacturation__adresseFacturation__pays__label">Pays
                                <select
                                        @if($tValidation != "")
                                        @if($tValidation['pays_facturation']['valide'] == false)
                                        class="erreur pageFacturation__adresseFacturation__pays__label--input"
                                        @else
                                        class="pageFacturation__adresseFacturation__pays__label--input"
                                        @endif
                                        @endif
                                        name="pays_facturation"
                                        id="pays_facturation"
                                        value="@if(isset($tValidation['pays_facturation']['valeur'])){{$tValidation['pays_facturation']['valeur']}}@endif"
                                        for="pays"
                                        required
                                >
                                    <option value="">Sélectionnez un pays</option>
                                    <option value="Canada">Canada </option>
                                    <option value="Belgique">Belgique </option>
                                    <option value="France">France </option>
                                    <option value="Suisse">Suisse </option>
                                    <option value="Cote_Ivoire">Côte d’Ivoire </option>
                                    <option value="Senegal">Sénégal </option>
                                </select>
                            </label>
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['pays_facturation']['valide'] == false)
                                <p class="erreur__message erreurPaysFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['pays_facturation']['message']}}</p>
                            @endif
                        @endif
                        <div class="pageFacturation__adresseFacturation__codePostal">
                            <label for="codePostal_facturation">Code postal  <i>(Ex: G1W 4S2)</i></label>
                            <input
                                    @if($tValidation != "")
                                    @if($tValidation['code_postal_facturation']['valide'] == false)
                                    class="erreur pageFacturation__adresseFacturation__codePostal--input"
                                    @else
                                    class="pageFacturation__adresseFacturation__codePostal--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="codePostal_facturation"
                                    id="codePostal_facturation"
                                    pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]"
                                    title="Le format attendu est X1X 1X1"
                                    value="@if(isset($tValidation['code_postal_facturation']['valeur'])){{$tValidation['code_postal_facturation']['valeur']}}@endif"
                                    required
                            >
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['code_postal_facturation']['valide'] == false)
                                <p class="erreur__message erreurCodePostalFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['code_postal_facturation']['message']}}</p>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            <button class="btnFacturation boutons boutons--btnGeneral" type="submit" id="btnFacturation">Continuer</button>
        </form>
    </div>
@endsection
