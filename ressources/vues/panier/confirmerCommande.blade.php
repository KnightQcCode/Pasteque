@extends('panier.gabarit')
@section('contenu')
    <div class="flex">
        <div class="confirmationIcon">
            <i class="far fa-check-circle"></i>
        </div>
        <div class="confirmation">
            <h2 class="confirmation__titre">Confirmation de votre commande.</h2>
            <p class="confirmation__numero">Votre numéro de commande est le: XXXXXXX</p>

        </div>
    </div>
    <div class="remerciement">
        <div class="remerciement__contenu">
            <p class="remerciement__para">Bonjour <b>{{$infoClient[0]->prenom}} {{$infoClient[0]->nom}}</b>,</p>
            <p class="remerciement__para">Merci d'avoir magasiné chez La Pastèque Éditeur. Sachez que vous pouvez toujours commander nos livres chez votre libraire favori.</p>
            <p class="remerciement__para">La commande vous sera expédiée selon les modalités choisies. N'hésitez pas à consulter notre service à la clientèle pour plus d'informations relatives à votre commande ou votre compte.</p>
            <p class="remerciement__para">Vous recevrez une confirmation de votre commande par courriel.</p>
        </div>
    </div>

    <div class="livraison">
        <div class="livraison__contenu">
            <p>Votre date de livraison prévue est le</p>
            <p><b>{{$date["weekday"]}} {{$date["mday"]}} {{$date["month"]}}</b></p>{{--  date dynamique qui rajoute 2 semaine a la date actuelle.--}}
            <p>Mode de livraison: <b>Livraison standard (gratuite)</b></p>
        </div>
    </div>

    <div class="details">
        <div class="details__contenu">
            <h3>Détails de la commande</h3>
            @foreach($livres as $livre)
            <div class="details__contenu__livre">
                <picture>
                    <source media="(min-width:600px)" srcset="liaisons/images/Panier/{{$livre['isbn_papier']}}_w150.png 1x,
                                                                                  liaisons/images/Panier/{{$livre['isbn_papier']}}_w300@2x.png 2x">

                    <source media="(max-width:599px)" srcset="liaisons/images/Panier/{{$livre['isbn_papier']}}_w150.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre['isbn_papier']}}_w286.png 2x">
                    <img class="panier__conteneur__livre--img" src="liaisons/images/Panier/{{$livre['isbn_papier']}}_w300@2x.png" alt="Image du livre">
                </picture>
                <div class="details__info">
                    <p class="details__contenu__livre__infoPara"><b>{{$livre['titre']}}</b></p>
                    <p class="details__contenu__livre__infoPara">{{$livre['prenom']}} {{$livre['nom']}}</p>
                    <p class="details__contenu__livre__infoPara"><b>{{$livre['prix_can']}}$</b></p>
                    <p class="details__contenu__livre__infoPara">Quantité : {{$livre['quantite']}}</p>

                </div>
            </div>
                <div class="details__total__livre">
                    <p class="details__total">Total: <b> {{$livre['quantite'] * $livre['prix_can']}}$</b></p>
                    <hr>
                </div>
            @endforeach
            <div>
                <div class="details__total__nbreArticle cinq">
                    <p>Nombre article</p>
                    <p>{{$quantite}}</p>
                </div>
                <div class="details__total__livraison cinq">
                    <p>Livraison</p>
                    <p>0.00$</p>
                </div>
                <div class="details__total__sousTotal cinq">
                    <p>Sous-total</p>
                    <p>{{$prix}}$</p>
                </div>
                <hr class="cinq">
                <div class="details__total__tps cinq">
                    <p>TPS</p>
                    <p>{{$tps}}$</p>
                </div>
                <div class="details__total__total ">
                    <p><b>Total</b> de la commande</p>
                    <p><b>{{$total}}$</b></p>
                </div>
            </div>
        </div>
    </div>
    <button class="imprimer boutons boutons--btnGeneral">Imprimer le reçu</button><br>
    <div class="hyperlien">
        <a href="index.php?controleur=site&action=accueil" class="hyperlien">Retourner à la Pastèque</a>
    </div>
@endsection
