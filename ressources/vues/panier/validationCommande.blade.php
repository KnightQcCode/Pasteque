@extends('panier.gabarit')
@section('contenu')
    <div class="picture__transaction">
        <picture>
            <source media="(min-width:600px)" srcset="liaisons/images/stepleft_etape3.svg">
            <source media="(max-width:599px)" srcset="liaisons/images/stepleft_mobile_etape3.svg">
            <img src="liaisons/images/stepleft_etape3.svg" alt="stepleft etape 3">
        </picture>
    </div>
    <div class="validation">
        <h2 class="validation__titre">{{$nomPage}}</h2>
        <div class="validation__client">
            <p>Livraison à <b>{{$tValidationLivraison['nom']['valeur']}}</b><br/>
            Date de livraison: {{$date["weekday"]}} {{$date["mday"]}} {{$date["month"]}} {{$date["year"]}}</p>
        </div>
        <div class="validation__recapitulatif">
            <h3 class="soustitre">Récapitulatif de la commande</h3>
            <div class="validation__recapitulatif__flex">
                <div class="validation__recapitulatif__quantite">
                    <p class="validation__recapitulatif__quantite--nombre">{{$quantite}} articles</p>
                    <p class="validation__recapitulatif__quantite--prix">{{$prix}}$</p>
                </div>
                <div class="validation__recapitulatif__livraison">
                    <p>Livraison standard</p>
                    <p>0,00$</p>
                </div>
                <div class="validation__recapitulatif__sousTotal">
                    <p>Sous-Total</p>
                    <p>{{$prix}}$</p>
                </div>
                <div class="validation__recapitulatif__tps">
                    <p>TPS 5%</p>
                    <p>{{$tps}}$</p>
                </div>
                <div class="validation__recapitulatif__total">
                    <p>Total</p>
                    <p>{{$total}}</p>
                </div>
            </div>
        </div>
        <div class="validation__adresse">
            <h3 class="sousTitre">Adresse de livraison</h3>
            <div class="validation__adresse__info">
                <div class="">
                    <p>{{$tValidationLivraison['nom']['valeur']}}</p>
                    <p>{{$tValidationLivraison['adresse_livraison']['valeur']}}</p>
                    <p>{{$tValidationLivraison['ville_livraison']['valeur']}}</p>
                    <p>{{$tValidationLivraison['province_livraison']['valeur']}}</p>
                    <p>{{$tValidationLivraison['pays_livraison']['valeur']}}</p>
                    <p>{{$tValidationLivraison['code_postal_livraison']['valeur']}}</p>
                </div>
                <a class="lien_modifier" href="#">Modifier</a>
            </div>
        </div>
        <div class="validation__infoPaiement">
            <h3 class="sousTitre">Informations de facturation</h3>
            <div class="validation__infoPaiement__sectionCarte">
                <div class="validation__infoPaiement__sectionCarte__Carte">
                    <h4>Mode de paiement: </h4>
                    <div class="validation__infoPaiement__sectionCarte__Carte__paiement">
                        <i class="fab fa-cc-visa fa-2x"></i>
                        <p>{{$tValidationFacturation['num_carte']['valeur']}}</p>
                    </div>
                </div>
                <a class="lien_modifier" href="#">Modifier</a>
            </div>
            <div class="validation__infoPaiement__facturation">
                <div class="validation__infoPaiement__sectionCarte__info">
                    <h4>Adresse de facturation</h4>
                    <p>{{$tValidationLivraison['nom']['valeur']}}</p>
                    <p>{{$tValidationFacturation['adresse_facturation']['valeur']}}</p>
                    <p>{{$tValidationFacturation['ville_facturation']['valeur']}}</p>
                    <p>{{$tValidationFacturation['province_facturation']['valeur']}}</p>
                    <p>{{$tValidationFacturation['pays_facturation']['valeur']}}</p>
                    <p>{{$tValidationFacturation['code_postal_facturation']['valeur']}}</p>
                </div>
                <a class="lien_modifier" href="#">Modifier</a>
            </div>
        </div>
        <form method="POST" action="index.php?controleur=panier&action=confirmerCommande" class="formConfirmerCommande">
            <input type="hidden" id="total" name="total" value="{{$total}}">
            <input type="hidden" id="client_id" name="client_id" value="{{$panier[0]->client_id}}">
            <input type="submit" class="btnPasserCommande boutons boutons--btnGeneral" value="Confirmer la commande">
        </form>
    </div>
@endsection