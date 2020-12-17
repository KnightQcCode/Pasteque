@extends('panier.gabarit')
@section('contenu')
    <?php
    $identifiant=$_SESSION['tValidationLivraison']['courriel']['valeur'];

    ?>
    <div class="picture__transaction">
        <picture>
            <source media="(min-width:600px)" srcset="liaisons/images/stepleft_etape2.svg">
            <source media="(max-width:599px)" srcset="liaisons/images/stepleft_mobile_etape2.svg">
            <img src="liaisons/images/stepleft_etape2.svg" alt="stepleft etape 2">
        </picture>
    </div>
    <div class="facturation">
        <h2 class="facturation__titre">{{$nomPage}}</h2>
        <form class="facturation__form" method="POST" action="index.php?controleur=panier&action=insererFacturation" novalidate>
            <div class="facturation__form__info">
                <div class="facturation__form__info__titre">
                    <h4 class="facturation__form__info__titre__h4">Information de contact</h4>
                    <a class="facturation__form__info__titre__lien" href="#">Modifier</a>
                </div>
                <p class="facturation__form__info__item">{{$adresse['nom']['valeur']}}</p>
                <p class="facturation__form__info__item">{{$adresse['courriel']['valeur']}}</p>
                <p class="facturation__form__info__notice">Elles seront utilisées uniquement pour confirmer votre commande ou vous joindre en cas de besoin pour le suivi de votre commande.</p>
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
                                    @if($infoClient[0]->type == 2)checked @endif
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
                                    @if($infoClient[0]->type == 1) checked @endif>
                            <label for="credit">Carte de credit</label>
                        </div>
                    </div>
                    @if($tValidation != "")
                        @if($tValidation['type_paiement']['valide'] == false)
                            <p class="erreur__message erreurTypePaiementFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['type_paiement']['message']}}</p>
                        @endif
                    @endif
                    <div id="creditInfo" class="infoPaiement__paiement__info">
                        <p class="infoPaiement__paiement__info__soustitre">Cartes de credits acceptées</p>
                        <div class="infoPaiement__paiement__info__icon">
                            <i class="fab fa-cc-visa fa-2x"></i>
                            <i class="fab fa-cc-mastercard fa-2x"></i>
                            <i class="fab fa-cc-amex fa-2x"></i>
                        </div>
                        <div class="infoPaiement__paiement__info__nom">
                            <label for="nom_carte">Titulaire de la carte</label>
                            <input
                                    @if($tValidation != "")
                                    @if($tValidation['nom_carte']['valide'] == false)
                                    class="erreur infoPaiement__paiement__info__nom--input"
                                    @else
                                    class="infoPaiement__paiement__info__nom--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="nom_carte"
                                    id="nom_carte"
                                    pattern="^[a-zA-ZÀ-ÿ '-]+$"
                                    value="@if(isset($identifiant)){{$infoClient[0]->prenom}} {{$infoClient[0]->nom}}@else{{$tValidation['nom_carte']['valeur']}}@endif"
                                    required
                            >
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['nom_carte']['valide'] == false)
                                <p class="erreur__message erreurNomFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['nom_carte']['message']}}</p>
                            @endif
                        @endif
                        <div class="infoPaiement__paiement__info__numero">
                            <label for="num_carte">Numéro de la carte</label>
                            <input
                                    @if($tValidation != "")
                                    @if($tValidation['num_carte']['valide'] == false)
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
                                    required
                                    value="@if(isset($identifiant)){{$infoClient[0]->numero}}@else{{$tValidation['num_carte']['valeur']}}@endif"
                            >
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['num_carte']['valide'] == false)
                                <p class="erreur__message erreurNumCarteFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['num_carte']['message']}}</p>
                            @endif
                        @endif
                        <div class="infoPaiement__paiement__info__codeSecurite">
                            <label for="code_securite">Code de sécurité</label>
                            <input
                                    @if($tValidation != "")
                                    @if($tValidation['code_securite']['valide'] == false)
                                    class="erreur infoPaiement__paiement__info__codeSecurite--input"
                                    @else
                                    class="infoPaiement__paiement__info__codeSecurite--input"
                                    @endif
                                    @endif
                                    type="text"
                                    name="code_securite"
                                    id="code_securite"
                                    maxlength="3"
                                    pattern="^[0-9]{3}$"
                                    value="@if(isset($identifiant)){{$infoClient[0]->code_securite}}@else{{$tValidation['code_securite']['valeur']}}@endif"
                                    required
                            >
                        </div>
                        @if($tValidation != "")
                            @if($tValidation['code_securite']['valide'] == false)
                                <p class="erreur__message erreurNumSecuriteFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['code_securite']['message']}}</p>
                            @endif
                        @endif
                        <div class="infoPaiement__paiement__info__date">
                            <label class="infoPaiement__paiement__info__date__label">Date d'expiration</label>
                            <div class="infoPaiement__paiement__info__date__label__selectGroup">
                                <select
                                        @if($tValidation != "")
                                        @if($tValidation['mois_expiration']['valide'] == false)
                                        class="erreur infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @else
                                        class="infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @endif
                                        @endif
                                        id="mois_expiration"
                                        name="mois_expiration"
                                        pattern="^[0-9]{1,2}$"
                                        required>
                                    <option value="">MM</option>
                                    <option value="1" @if($infoClient[0]->expiration_mois == 1) selected @endif>1</option>
                                    <option value="2" @if($infoClient[0]->expiration_mois == 2) selected @endif>2</option>
                                    <option value="3" @if($infoClient[0]->expiration_mois == 3) selected @endif>3</option>
                                    <option value="4" @if($infoClient[0]->expiration_mois == 4) selected @endif>4</option>
                                    <option value="5" @if($infoClient[0]->expiration_mois == 5) selected @endif>5</option>
                                    <option value="6" @if($infoClient[0]->expiration_mois == 6) selected @endif>6</option>
                                    <option value="7" @if($infoClient[0]->expiration_mois == 7) selected @endif>7</option>
                                    <option value="8" @if($infoClient[0]->expiration_mois == 8) selected @endif>8</option>
                                    <option value="9" @if($infoClient[0]->expiration_mois == 9) selected @endif>9</option>
                                    <option value="10" @if($infoClient[0]->expiration_mois == 10) selected @endif>10</option>
                                    <option value="11" @if($infoClient[0]->expiration_mois == 11) selected @endif>11</option>
                                    <option value="12" @if($infoClient[0]->expiration_mois == 12) selected @endif>12</option>
                                </select>
                                <select

                                        @if($tValidation != "")
                                        @if($tValidation['annee_expiration']['valide'] == false)
                                        class="erreur infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @else
                                        class="infoPaiement__paiement__info__date__label__selectGroup--select"
                                        @endif
                                        @endif
                                        id="annee_expiration"
                                        name="annee_expiration"
                                        pattern="^[0-9]{1,2}$"
                                        required>
                                    <option value="">AAAA</option>
                                    <option value="20" @if($infoClient[0]->expiration_annnee == 20) selected @endif>2020</option>
                                    <option value="21" @if($infoClient[0]->expiration_annnee == 21) selected @endif>2021</option>
                                    <option value="22" @if($infoClient[0]->expiration_annnee == 22) selected @endif>2022</option>
                                    <option value="23" @if($infoClient[0]->expiration_annnee == 23) selected @endif>2023</option>
                                    <option value="24" @if($infoClient[0]->expiration_annnee == 24) selected @endif>2024</option>
                                    <option value="25" @if($infoClient[0]->expiration_annnee == 25) selected @endif>2025</option>
                                </select>
                            </div>
                            @if($tValidation != "")
                                @if($tValidation['mois_expiration']['valide'] == false)
                                    <p class="erreur__message erreurMoisFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['mois_expiration']['message']}}</p>
                                @endif
                                @if($tValidation['annee_expiration']['valide'] == false)
                                    <p class="erreur__message erreurAnneeFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['annee_expiration']['message']}}</p>
                                @endif
                            @endif
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
                                        pattern="^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$"
                                        value="{{$adresse['adresse_livraison']['valeur']}}"
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
                                        value="{{$adresse['ville_livraison']['valeur']}}"
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
                                            required>
                                        <option value="">Sélectionnez une province</option>
                                        <option value="QC" @if($adresse['province_livraison']['valeur'] == "QC") selected @endif>Québec</option>
                                        <option value="ON" @if($adresse['province_livraison']['valeur'] == "ON") selected @endif>Ontario</option>
                                        <option value="TNL" @if($adresse['province_livraison']['valeur'] == "TNL") selected @endif>Terre-Neuve et Labrador</option>
                                        <option value="NB" @if($adresse['province_livraison']['valeur'] == "NB") selected @endif>Nouveau-Brunswick</option>
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
                                            for="pays"
                                            required>
                                        <option value="Canada" @if($adresse['pays_livraison']['valeur'] == "Canada") selected @endif>Canada </option>
                                        <option value="Etats_Unis" @if($adresse['pays_livraison']['valeur'] == "Etats_Unis") selected @endif>États-Unis </option>
                                        <option value="Belgique" @if($adresse['pays_livraison']['valeur'] == "Belgique") selected @endif>Belgique </option>
                                        <option value="France" @if($adresse['pays_livraison']['valeur'] == "France") selected @endif>France </option>
                                        <option value="Suisse" @if($adresse['pays_livraison']['valeur'] == "Suisse") selected @endif>Suisse </option>
                                        <option value="Cote_Ivoire" @if($adresse['pays_livraison']['valeur'] == "Cote_Ivoire") selected @endif>Côte d’Ivoire </option>
                                        <option value="Senegal" @if($adresse['pays_livraison']['valeur'] == "Senegal") selected @endif>Sénégal </option>
                                    </select>
                                </label>
                            </div>
                            @if($tValidation != "")
                                @if($tValidation['pays_facturation']['valide'] == false)
                                    <p class="erreur__message erreurPaysFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['pays_facturation']['message']}}</p>
                                @endif
                            @endif
                            <div class="pageFacturation__adresseFacturation__codePostal">
                                <label for="codePostal">Code postal  <i>(Ex: G1W 4S2)</i></label>
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
                                        value="{{$adresse['code_postal_livraison']['valeur']}}"
                                        required
                                >
                            </div>
                            @if($tValidation != "")
                                @if($tValidation['code_postal_facturation']['valide'] == false)
                                    <p class="erreur__message erreurCodePostalFacturation"><span class="spriteRETRO"><i class="fas fa-exclamation-triangle"></i></span>{{$tValidation['code_postal_facturation']['message']}}</p>
                                @endif
                            @endif
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
                                       value="@if(isset($tValidation['adresse_facturation']['valeur'])){{$tValidation['adresse_facturation']['valeur']}}@endif"
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
                                            required>
                                        <option value="">Sélectionnez une province</option>
                                        <option value="QC" @if($tValidation['province_facturation']['valeur'] == "QC") selected @endif>Québec</option>
                                        <option value="ON" @if($tValidation['province_facturation']['valeur'] == "ON") selected @endif>Ontario</option>
                                        <option value="TNL" @if($tValidation['province_facturation']['valeur'] == "TNL") selected @endif>Terre-Neuve et Labrador</option>
                                        <option value="NB" @if($tValidation['province_facturation']['valeur'] == "NB") selected @endif>Nouveau-Brunswick</option>
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
                                            value=""
                                            for="pays"
                                            required>
                                        <option value="">Sélectionnez un pays</option>
                                        <option value="Canada" @if($tValidation['pays_facturation']['valeur'] == "Canada") selected @endif>Canada </option>
                                        <option value="Etats_Unis" @if($tValidation['pays_facturation']['valeur'] == "Etats_Unis") selected @endif>États-Unis </option>
                                        <option value="Belgique" @if($tValidation['pays_facturation']['valeur'] == "Belgique") selected @endif>Belgique </option>
                                        <option value="France" @if($tValidation['pays_facturation']['valeur'] == "France") selected @endif>France </option>
                                        <option value="Suisse" @if($tValidation['pays_facturation']['valeur'] == "Suisse") selected @endif>Suisse </option>
                                        <option value="Cote_Ivoire" @if($tValidation['pays_facturation']['valeur'] == "Cote_Ivoire") selected @endif>Côte d’Ivoire </option>
                                        <option value="Senegal" @if($tValidation['pays_facturation']['valeur'] == "Senegal") selected @endif>Sénégal </option>
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