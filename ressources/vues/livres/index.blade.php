@extends('gabarit')
@section('contenu')
    <div class="listeLivres">
        <h2 class="listeLivres__titre">{{$titrePage}}</h2>
        <form class="listeLivres__form" method="POST" action="">
            <label for="tri"></label>
            <select id="tri" name="tri" class="listeLivres__form__tri__liste" onchange="document.location.href='index.php?controleur=livre&action=' + this.value">
                <option value="index">Trier par</option>
                <option value="trierRecence">Trier les livres par récence</option>
                <option value="trierAZ">Trier les livres par titre A-Z</option>
                <option value="trierZA">Trier les livres par titre Z-A</option>
                <option value="trierAuteurAZ">Trier par artiste A-Z</option>
                <option value="trierAuteurZA">Trier par artiste Z-A</option>
                <option value="trierIsbn">Trier les livres par ISBN</option>
                <option value="trierCategorie">Trier les livres par catégorie</option>
            </select>
        </form>
        <div class="listeLivres__gallerie">
                <div class="listeLivres__gallerie__btnCategorie mobile-only">
                    <a id="btnCategorie">Catégorie</a>
                </div>
                <div id="categorie" class="listeLivres__gallerie__categories">
                    <ul class="listeLivres__gallerie__categories__liste">
                        @foreach($categories as $categorie)
                            <a href="index.php?controleur=livre&action={{$categorie->id}}" class="listeLivres__gallerie__categories__liste__liens">
                                <li class="listeLivres__gallerie__categories__liste__liens__item">{{$categorie->nom}}</li>
                            </a>
                        @endforeach
                    </ul>
                    <div class="listeLivres__gallerie__categories__telechargement">
                        <p class="listeLivres__gallerie__categories__telechargement__titre">Téléchargement</p>
                        <ul class="listeLivres__gallerie__categories__telechargement__liste">
                            <li class="listeLivres__gallerie__categories__telechargement__liste__items">Catalogue PDF</li>
                            <li class="listeLivres__gallerie__categories__telechargement__liste__items">Bon de commande</li>
                            <li class="listeLivres__gallerie__categories__telechargement__liste__items">Foreign rights</li>
                        </ul>
                    </div>

                </div>
                <div class="listeLivres__gallerie__fiches">
                    @foreach($livres as $livre)
                        <div class="listeLivres__gallerie__fiches__item">
                            <div class="container listeLivres__gallerie__fiches__item__conteneur">
                                @foreach($livre->getAuteurs() as $artiste)
                                    <a href='index.php?controleur=livre&action=fiche&idLivre={{$livre->id}}&idAuteur={{$artiste->id}}'>
                                        @endforeach
                                        <div class="overlay">
                                            <h3 class="titreLivresListe text">{{$livre->titre}}</h3>
                                            <p class="texteCategorieListeLivres">[ {{$livre->getCategories()->nom}} ]</p>
                                        </div>
                                        <picture>
                                            <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w286.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w470@2x.png 2x">

                                            <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w235.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 2x">
                                            <img class="livres__listeLivre--img" src="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png" alt="Image du livre">
                                        </picture>
                                        @if($livre->statut == 2)
                                            <i class="icone__nouveaute fab fa-hotjar fa-2x"></i>
                                            <span class="icone__nouveaute" aria-hidden="true"></span>
                                            <p class="screen-reader-only">Icône de nouveauté</p>
                                        @endif
                                    </a>
                            </div>
                            @foreach($livre->getAuteurs() as $auteur)
                                <a class="nomAuteurs" href="index.php?controleur=auteur&action=fiche&idAuteur={{$auteur->id}}">
                                    <p class="nomAuteurs__titre titreLivres">{{$auteur->getNomPrenom()}}</p>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                        </div>
                    <div class="pagination">
                        @include('fragments.pagination')
                    </div>
                </div>
            </div>
    </div>
@endsection