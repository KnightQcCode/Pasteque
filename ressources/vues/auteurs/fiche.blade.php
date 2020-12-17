@extends('gabarit')
@section('contenu')
    <div class="ficheAuteur">
        <p class="ficheAuteur__filArian"><a href="index.php?controleur=site&action=accueil">Accueil</a> > <a href="index.php?controleur=auteur&action=index">Liste des artistes</a> > {{$ficheArtiste->getNomPrenom()}}</p>
        <p class="ficheAuteur__lienRetour"><a href="index.php?controleur=auteur&action={{$_SESSION['trierAuteur']}}">< Retourner à la liste des artistes</a></p>
        <div class="ficheAuteur__informations">
            @if(file_exists('liaisons/images/FicheAuteurs/' . $ficheArtiste->nom . '_w490.png'))
            <picture>
                <source media="(min-width:600px)" srcset="liaisons/images/FicheAuteurs/{{$ficheArtiste->nom}}_w490.png 1x, liaisons/images/FicheAuteurs/{{$ficheArtiste->nom}}_w980@2x.png 2x, liaisons/images/auteur.svg">

                <source media="(max-width:599px)" srcset="liaisons/images/FicheAuteurs/{{$ficheArtiste->nom}}_w294.png 1x, liaisons/images/FicheAuteurs/{{$ficheArtiste->nom}}_w588@2x.png 2x, liaisons/images/auteur.svg">
                <img class="ficheAuteur__informations__image" src="liaisons/images/FicheAuteurs/{{$ficheArtiste->nom}}_w980@2x.png" alt="Image de {{$ficheArtiste->nom}}" onerror="this.onerror=null;this.src='liaisons/images/auteur.svg';">
            </picture>
            @else
                <picture>
                    <source media="(min-width:600px)" srcset="liaisons/images/auteur.svg 1x,
                                                                                  liaisons/images/auteur.svg 2x">

                    <source media="(max-width:599px)" srcset="liaisons/images/auteur.svg 1x,
                                                                                  liaisons/images/auteur.svg 2x">
                    <img class="ficheAuteur__informations__image" src="liaisons/images/auteur.svg" alt="Image de l'artiste">
                </picture>
            @endif
            <div class="ficheAuteur__informations__texte">
                <h2 class="ficheAuteur__informations__texte__titre">{{$ficheArtiste->getNomPrenom()}}</h2>
                <p class="ficheAuteur__informations__texte__biographie">{{$ficheArtiste->notice}}</p>
                <p class="ficheAuteur__informations__texte__siteWeb"><a href="{{$ficheArtiste->site_web}}">{{$ficheArtiste->site_web}}</a></p>
            </div>
        </div>
        <div class="ficheAuteur__memeLivres">
            <h2 class="ficheAuteur__memeLivres__titre">Livres du même artiste</h2>
            <div class="ficheAuteur__memeLivres__liste">
                @foreach($listeLivres as $livre)
                    <div class="ficheAuteur__memeLivres__liste__fiche">
                        <div class="container ficheAuteur__memeLivres__liste__fiche__titre">

                                <a href="index.php?controleur=livre&action=fiche&idLivre={{$livre->id}}&idAuteur={{$ficheArtiste->id}}">
                                    <div class="overlay">
                                        <h3 class="text ficheAuteur__memeLivres__liste__fiche__titre__nom titreLivresAuteur">{{$livre->titre}}</h3>
                                        <p class="ficheAuteur__memeLivres__liste__fiche__titre__categorie">[ {{$livre->nom}} ]</p>
                                    </div>
                                    <picture>
                                        <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 2x">

                                        <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 2x">
                                        <img class="ficheAuteur__memeLivres__liste__fiche__titre__img" src="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png" alt="Image du livre">
                                    </picture>
                                </a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div  class="ficheAuteur__boutonsActions">
            @if($ficheArtiste->id == 1)
                <button disabled class="boutons boutons--btnGeneral" name="btPrecedent"><span class="icones icone--precedent"></span>Artiste précédent</button>
            @else
                <button class="boutons boutons--btnGeneral" name="btPrecedent" onclick="window.location.href='index.php?controleur=auteur&action=fiche&idAuteur={{$ficheArtiste->id - 1}}';"><span class="icones icone--precedent"></span>Artiste précédent</button>
            @endif
            @if($ficheArtiste-> id == $nbId)
                <button disabled class="boutons boutons--btnGeneral" name="btSuivant"><span class="icones icone--suivant"></span>Artiste suivant</button>
            @else
                <button class="boutons boutons--btnGeneral" name="btPrecedent" onclick="window.location.href='index.php?controleur=auteur&action=fiche&idAuteur={{$ficheArtiste->id + 1}}';"><span class="icones icone--suivant"></span>Artiste suivant</button>
            @endif
        </div>
    </div>
@endsection
