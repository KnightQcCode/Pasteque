@extends('gabarit')
@section('contenu')
    <div class="panier">
        <h2 class="panier__titre">{{$nomPage}}</h2>
        <div class="panier__info">
            <p>Sous-total ({{$quantite}} articles): CAD {{$prix}}$</p>
            <p>*Admissible à la livraison gratuite standard partout au Canada pour un achat de 60$ CDN et plus. </p>
        </div>
        <div class="panier__conteneur">
            <div class="panier__listeLivres">
                @foreach($livres as $livre)
                    <div class=" panier__conteneur__livre">
                        <picture>
                            <source media="(min-width:600px)" srcset="liaisons/images/Panier/{{$livre['isbn_papier']}}_w150.png 1x,
                                                                                  liaisons/images/Panier/{{$livre['isbn_papier']}}_w300@2x.png 2x">

                            <source media="(max-width:599px)" srcset="liaisons/images/Panier/{{$livre['isbn_papier']}}_w150.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre['isbn_papier']}}_w286.png 2x">
                            <img class="panier__conteneur__livre--img" src="liaisons/images/Panier/{{$livre['isbn_papier']}}_w300@2x.png" alt="Image du livre">
                        </picture>
                        <div class="panier__conteneur__livre__info">
                            <h3 class="panier__conteneur__livre__info--titre">{{$livre['titre']}}</h3>
                            <p class="panier__conteneur__livre__info--auteur">{{$livre['nom']}} {{$livre['prenom']}}</p>
                            <p class="panier__conteneur__livre__info--prix">{{$livre['prix_can']}}</p>
                            <div>
                                <form method="POST" action="index.php?controleur=panier&action=recalculer">
                                    <input type="hidden" id="idLivre" name="idLivre" value="{{$livre['2']}}">
                                    <label class="panier__conteneur__livre__info--quantite" for="quantite">Quantite:</label>
                                    <select class="panier__conteneur__livre__info--select" id="quantite" name="quantite">
                                        @for($i=1; $i <= 10;$i++);
                                        <option value="{{$i}}" @if($i == $livre['quantite']) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <input class="panier__conteneur__livre__info--btnRecalculer boutons boutons--btnGeneral" type="submit" value="Recalculer">
                                </form>
                            </div>
                            <div class="panier__conteneur__livre__info__total">
                                <a class="panier__conteneur__livre__info__total--lien" href="index.php?controleur=panier&action=delete&idLivre={{$livre['2']}}">Retirer du panier</a>
                                <p class="panier__conteneur__livre__info--total--prix">Total {{$livre['quantite'] * $livre['prix_can']}} $</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <form class="form_panier" action="index.php?controleur=site&action=connexionCompte" method="POST">
                <div class="panier__conteneur__sectionPrix">
                    <div class="panier__conteneur__sectionPrix__nbArticle">
                        <p class="panier__conteneur__sectionPrix__nbArticlequantite">{{$quantite}} articles</p>
                        <p class="panier__conteneur__sectionPrix__nbArticleprix">{{$prix}}$</p>
                    </div>
                    <div class="panier__conteneur__sectionPrix__livraison">
                        <p class="panier__conteneur__sectionPrix__livraison--choix">Livraison</p>
                        <p id="prix_livraison" class="panier__conteneur__sectionPrix__livraison--prix">0,00$</p>
                        <p id="prix_livraisonExpress" class="panier__conteneur__sectionPrix__livraison--prixExpress invisible__prixLivraison">8,00$</p>
                    </div>
                    <div>
                        <select id="modeLivraison" class="panier__conteneur__livre__info--select"  name="modeLivraison">
                            <option value="standart">Standard</option>
                            <option value="express">Express</option>
                        </select>
                    </div>
                    <p>Date livraison estimée:</p>
                    <p id="dateNormal">{{$date["weekday"]}} {{$date["mday"]}} {{$date["month"]}} {{$date["year"]}}</p>
                    <p class="invisible__prixLivraison" id="dateExpress">{{$dateExpress["weekday"]}} {{$dateExpress["mday"]}} {{$dateExpress["month"]}} {{$dateExpress["year"]}}</p>
                    <div class="panier__conteneur__sectionPrix__sousTotal">
                        <p>Sous-Total</p>
                        <p class="" id="prix_normal">{{$prix}}$</p>
                        <p class="invisible__prixLivraison" id="prix_express">{{$prix_express}}$</p>
                    </div>
                    <div class="panier__conteneur__sectionPrix__tps">
                        <p>TPS 5%</p>
                        <p class="" id="tps_normal">{{$tps}}$</p>
                        <p class="invisible__prixLivraison" id="tps_express">{{$tps_express}}$</p>
                    </div>
                    <div class="panier__conteneur__sectionPrix__total">
                        <p>Total</p>
                        <p class="" id="total_normal">{{$total}}$</p>
                        <p class="invisible__prixLivraison" id="total_express">{{$total_express}}$</p>
                    </div>
                </div>
                <div class="panier__conteneur__bouton">
                        <button type="submit" class="boutons boutons--btnGeneral panier__conteneur__bouton--btn">Passer la commande</button>
                    <a href="index.php?controleur=livre&action=index" class="panier__conteneur__bouton--lien hyperlien">Continuer à magasiner</a>
                </div>
            </form>
        </div>
    </div>
@endsection