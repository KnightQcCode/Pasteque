
@extends('gabarit')

@section('contenu')
    <div class="accueil">
        @if($_SESSION['client2'] == null)
            <span class="visuallyhidden">{{$_SESSION['client2']=100}}</span>
        @elseif($_SESSION['client2'] != null)
            <span class="visuallyhidden">{{$_SESSION['client2']=$infoClient[0]->client_id}}</span>
        @endif
        <span class="visuallyhidden">{{$_SESSION['clientNom']=$infoClient[0]->nom}}</span>
        <span class="visuallyhidden">{{$_SESSION['clientPrenom']=$infoClient[0]->prenom}}</span>
        <div class="accueil__nouveautes">
            <h2 class="accueil__nouveautes__titre">Nos nouveautés</h2>
            <div id="nouveautes" class="accueil__nouveautes__livres">
            @foreach($nouveautes as $nouveaute)
                    <div class="accueil__nouveautes__livres__fiche">
                        <div class="accueil__nouveautes__livres__fiche__vignette">
                            <div class="container accueil__nouveautes__livres__fiche__vignette__titre">

                                    <a href="index.php?controleur=livre&action=fiche&idLivre={{$nouveaute->id}}&idAuteur={{$auteur->id}}">
                                        <div class="overlay">
                                            <h3 class="text accueil__nouveautes__livres__fiche__vignette__titre__nom titreLivresNouveautes">{{$nouveaute->titre}}</h3>
                                            <p class="textCategorie accueil__nouveautes__livres__fiche__vignette__titre__categorie">[ {{$nouveaute->getCategories()->nom}} ]</p>
                                        </div>
                                        <picture>
                                            <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w286.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w470@2x.png 2x">

                                            <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w235.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w574@2x.png 2x">
                                            <img class="accueil__nouveautes__livres__fiche__vignette__titre__img" src="liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w574@2x.png" alt="Photo du livre de la section Nouveautés">
                                        </picture>
                                    </a>
                            </div>
                            @foreach($nouveaute->getAuteurs() as $auteur)
                                <div class="accueil__nouveautes__livres__fiche__vignette__auteurs">
                                        <a href="index.php?controleur=auteur&action=fiche&idAuteur={{$auteur->id}}">
                                            <p class="accueil__nouveautes__livres__fiche__vignette__auteurs__nom">{{$auteur->getNomPrenom()}}</p>
                                        </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
            @endforeach
            </div>
            <div id="nouveautesPlus" class="accueil__nouveautes__livres visuallyhidden">
            @foreach($nouveautesPlus as $nouveaute)
                <div class="accueil__nouveautes__livres__fiche">
                    <div class="accueil__nouveautes__livres__fiche__vignette">
                        <div class="container accueil__nouveautes__livres__fiche__vignette__titre">
                            @foreach($nouveaute->getAuteurs() as $auteur)
                                <a href="index.php?controleur=livre&action=fiche&idLivre={{$nouveaute->id}}&idAuteur={{$auteur->id}}">
                                    <div class="overlay">
                                        <h3 class="text accueil__nouveautes__livres__fiche__vignette__titre__nom titreLivresNouveautes">{{$nouveaute->titre}}</h3>
                                        <p class="textCategorie accueil__nouveautes__livres__fiche__vignette__titre__categorie">[ {{$nouveaute->getCategories()->nom}} ]</p>
                                    </div>
                                    @endforeach
                                    <picture>
                                        <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w286.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w470@2x.png 2x">

                                        <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w235.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w574@2x.png 2x">
                                        <img class="accueil__nouveautes__livres__fiche__vignette__titre__img" src="liaisons/images/ListeLivres/{{$nouveaute->isbn_papier}}_w235@2x.png" alt="Photo du livre de la section Nouveautés">
                                    </picture>
                                </a>
                        </div>
                        @foreach($nouveaute->getAuteurs() as $auteur)
                        <div class="accueil__nouveautes__livres__fiche__vignette__auteurs">
                            <a href="index.php?controleur=auteur&action=fiche&idAuteur={{$auteur->id}}">
                                <p class="accueil__nouveautes__livres__fiche__vignette__auteurs__nom">{{$auteur->getNomPrenom()}}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            </div>
            <p class="accueil__nouveautes__afficherTout">
                <a id="more">Afficher toutes nos nouveautés</a>
            </p>
        </div>
        <div class="accueil__aParaitre">
            <h2 class="accueil__aParaitre__titre">Les livres à paraître prochainement</h2>
            <div class="accueil__aParaitre__livres">
            @foreach($aParaitres as $aParaitre)
                    <div class="accueil__aParaitre__livres__fiche">
                        <div class="accueil__aParaitre__livres__fiche__vignette">
                            <div class="container accueil__aParaitre__livres__fiche__vignette__titre">
                            @foreach($aParaitre->getAuteurs() as $auteur)
                                    <a href="index.php?controleur=livre&action=fiche&idLivre={{$aParaitre->id}}&idAuteur={{$auteur->id}}">
                                        <div class="overlay">
                                        <h3 class="text accueil__aParaitre__livres__fiche__vignette__titre__nom titreLivresAParaitre">{{$aParaitre->titre}}</h3>
                                        <p class="textCategorie accueil__aParaitre__livres__fiche__vignette__titre__categorie">[ {{$aParaitre->getCategories()->nom}} ]</p>
                                        </div>
                                        @endforeach
                                        <picture>
                                            <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w286.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w470@2x.png 2x">

                                            <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w235.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w574@2x.png 2x">
                                            <img class="accueil__aParaitre__livres__fiche__vignette__titre__img" src="liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w235.png" alt="Photo du livre de la section Paraîtres">
                                        </picture>
                                    </a>
                            </div>
                            <div class="accueil__aParaitre__livres__fiche__vignette__auteurs">
                                @foreach($aParaitre->getAuteurs() as $auteur)
                                    <a href="index.php?controleur=auteur&action=fiche&idAuteur={{$auteur->id}}">
                                        <p class="accueil__aParaitre__livres__fiche__vignette__auteurs__nom">{{$auteur->getNomPrenom()}}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div>

                            <p class="accueil__aParaitre__livres__fiche__date">
                                <i class="icone__date far fa-clock fa-1x"></i>
                                <span class="icone__date" aria-hidden="true"></span>
                                {{$aParaitre->date_parution_quebec}}</p>
                            <p class="screen-reader-only">Icône de la date du parution</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="aParaitrePlus" class="accueil__nouveautes__livres visuallyhidden">
                @foreach($aParaitresPlus as $aParaitre)
                    <div class="accueil__nouveautes__livres__fiche">
                        <div class="accueil__nouveautes__livres__fiche__vignette">
                            <div class="container accueil__nouveautes__livres__fiche__vignette__titre">
                                @foreach($aParaitre->getAuteurs() as $auteur)
                                    <a href="index.php?controleur=livre&action=fiche&idLivre={{$aParaitre->id}}&idAuteur={{$auteur->id}}">
                                        <div class="overlay">
                                            <h3 class="text accueil__nouveautes__livres__fiche__vignette__titre__nom titreLivresAParaitre">{{$aParaitre->titre}}</h3>
                                            <p class="textCategorie accueil__nouveautes__livres__fiche__vignette__titre__categorie">[ {{$aParaitre->getCategories()->nom}} ]</p>
                                        </div>
                                        @endforeach
                                        <picture>
                                            <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w286.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w470@2x.png 2x">

                                            <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w235.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w574@2x.png 2x">
                                            <img class="accueil__nouveautes__livres__fiche__vignette__titre__img" src="liaisons/images/ListeLivres/{{$aParaitre->isbn_papier}}_w235.png" alt="Photo du livre de la section Nouveautés">
                                        </picture>
                                    </a>
                            </div>
                            @foreach($aParaitre->getAuteurs() as $auteur)
                                <div class="accueil__nouveautes__livres__fiche__vignette__auteurs">
                                    <a href="index.php?controleur=auteur&action=fiche&idAuteur={{$auteur->id}}">
                                        <p class="accueil__nouveautes__livres__fiche__vignette__auteurs__nom">{{$auteur->getNomPrenom()}}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div>

                            <p class="accueil__aParaitre__livres__fiche__date">
                                <i class="icone__date far fa-clock fa-1x"></i>
                                <span class="icone__date" aria-hidden="true"></span>
                                {{$aParaitre->date_parution_quebec}}</p>
                            <p class="screen-reader-only">Icône de la date du parution</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="accueil__aParaitre__afficherTout">
                <a id="more2">Afficher tous les livres à paraîtres</a>
            </p>
        </div>
        <div class="accueil__evenements">
            <h2 class="accueil__evenements__titre">Les évènements</h2>
            <div class="accueil__evenements__liste">
                @foreach($evenements as $evenement)
                    <div class="accueil__evenements__liste__sections">
                        <div class="accueil__evenements__liste__sections__carte">
                            <picture>
                                <source media="(min-width:600px)" srcset="liaisons/images/evenements/{{$evenement->id}}_evenement_w280.png 1x,
                                                                                  liaisons/images/evenements/{{$evenement->id}}_evenement_w558@2x.png 2x">
                                <source media="(max-width:599px)" srcset="liaisons/images/evenements/{{$evenement->id}}_evenement_w480.png 1x,
                                                                                  liaisons/images/evenements/{{$evenement->id}}_evenement_w980@2x.png 2x">
                                <img class="accueil__evenements__liste__sections__carte__img" src="https://via.placeholder.com/490x210" alt="Photo de l'activité de la section Évènements">
                            </picture>
                            <h3 class="h3-bold accueil__evenements__liste__sections__carte__titre">{{$evenement->titre}}</h3>
                            <p class="accueil__evenements__liste__sections__carte__editeur">Nom de l'éditeur</p>
                            <p class="accueil__evenements__liste__sections__carte__description">{{ $evenement->getDescriptionCourte() }}</p>
                            <div class="accueil__evenements__liste__sections__carte__reseauxSociaux">
                                <a class="accueil__evenements__liste__sections__carte__reseauxSociaux__icones" href="http://instagram.com">
                                    <i class="icone__insta fab fa-instagram fa-3x"></i>
                                    <span class="icone__instagram" aria-hidden="true"></span>
                                    <p class="screen-reader-only">Instagram</p>
                                </a>
                                <a class="accueil__evenements__liste__sections__carte__reseauxSociaux__icones" href="https://fr-ca.facebook.com/">
                                    <i class="icone__fb fab fa-facebook-square fa-3x"></i>
                                    <span class="icone__facebook" aria-hidden="true"></span>
                                    <p class="screen-reader-only">Facebook</p>
                                </a>
                            </div>
                        </div>
                        <p class="accueil__evenements__liste__sections__date">{{$evenement->date}}</p>
                    </div>
                @endforeach
            </div>
        <p class="accueil__evenements__afficherTout">
            <a href="#">Afficher toutes les évènements</a>
        </p>
        </div>
        <div class="accueil__actualites">
            <h2 class="accueil__actualites__titre">Dernières actualités</h2>
            <div class="accueil__actualites__liste">
                @foreach($actualites as $actualite)
                    <div class="accueil__actualites__liste__carte">
                        <picture>
                            <source media="(min-width:600px)" srcset="liaisons/images/actualites/{{$actualite->id}}_actualite_w280.png 1x,
                                                                                  liaisons/images/actualites/{{$actualite->id}}_actualite_w558@2x.png 2x">
                            <source media="(max-width:599px)" srcset="liaisons/images/actualites/{{$actualite->id}}_actualite_w480.png 1x,
                                                                                  liaisons/images/actualites/{{$actualite->id}}_actualite_w980@2x.png 2x">
                            <img class="accueil__actualites__liste__carte__img" src="https://via.placeholder.com/490x210" alt="Photo de l'activité de la section Actualités">
                        </picture>
                        <h3 class="h3-bold accueil__actualites__liste__carte__titre">{{$actualite->titre}}</h3>
                        <p class="accueil__evenements__liste__carte__editeur">Un nom éditeur</p>
                        <p class="accueil__actualites__liste__carte__description">{{ $actualite->getDescriptionCourte() }}</p>
                        <div class="accueil__actualites__liste__carte__reseauxSociaux">
                            <a class="accueil__actualites__liste__carte__reseauxSociaux__icones" href="http://instagram.com">
                                <i class="icone__insta fab fab fa-instagram fa-3x"></i>
                                <span class="icone__instagram" aria-hidden="true"></span>
                                <p class="screen-reader-only">Instagram</p>
                            </a>
                            <a class="accueil__actualites__liste__carte__reseauxSociaux__icones" href="https://fr-ca.facebook.com/">
                                <i class="icone__fb fab fa-facebook-square fa-3x"></i>
                                <span class="icone__facebook" aria-hidden="true"></span>
                                <p class="screen-reader-only">Facebook</p>
                            </a>
                        </div>
                        <p class="accueil__actualites__liste__carte__date">{{$actualite->date}}</p>
                    </div>
                @endforeach
            </div>
            <p class="accueil__actualites__afficherTout">
                <a href="#">Afficher toutes les actualités</a>
            </p>
        </div>
        <div class="accueil__galerieBoutique">
            <h2 class="accueil__galerieBoutique__titre">Les évènements du mois à la galerie-boutique</h2>
        </div>
    </div>
@endsection