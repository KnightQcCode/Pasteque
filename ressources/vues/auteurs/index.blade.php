@extends('gabarit')
@section('contenu')
        <h2 class="nomPage__auteurs">{{$titrePage}}</h2>
        <p class="filArian"><a href="index.php?controleur=site&action=accueil">Accueil</a> > Liste des artistes</p>
        <div class="rangee">
            <div class="cols_8_de_12">
                <form class="listeLivres__form" method="POST">
                    <label for="tri"></label>
                    <select id="tri" name="tri" class="listeLivres__form__tri__liste" onchange="document.location.href='index.php?controleur=auteur&action=' + this.value">
                        <option value="index">Trier par</option>
                        <option value="trierAuteurAZ">Trier par artistes A-Z</option>
                        <option value="trierAuteurZA">Trier par artistes Z-A</option>
                    </select>
                </form>
                <div class="auteur__flex">
                    @foreach($artistes as $artiste)
                        <div class="liste">
                            <div class="liste__auteur">
                                <a class="liste__auteur--itemLiens" href='index.php?controleur=auteur&action=fiche&idAuteur={{$artiste->id}}'>
                                    @if(file_exists('liaisons/images/ListeAuteurs/' . $artiste->nom . '_w235.png'))
                                    <picture>
                                        <source media="(min-width:600px)" srcset="liaisons/images/ListeAuteurs/{{$artiste->nom}}_w235.png 1x,
                                                                                  liaisons/images/ListeAuteurs/{{$artiste->nom}}_w470@2x.png 2x">

                                        <source media="(max-width:599px)" srcset="liaisons/images/ListeAuteurs/{{$artiste->nom}}_w286.png 1x,
                                                                                  liaisons/images/ListeAuteurs/{{$artiste->nom}}_w574@2x.png 2x">
                                        <img class="liste__auteur--img" src="liaisons/images/auteur.svg" alt="Image de l'artiste" onerror="this.onerror=null;this.src='liaisons/images/auteur.svg';">
                                    </picture>
                                    @else
                                        <picture>
                                            <source media="(min-width:600px)" srcset="liaisons/images/auteur.svg 1x,
                                                                                  liaisons/images/auteur.svg 2x">

                                            <source media="(max-width:599px)" srcset="liaisons/images/auteur.svg 1x,
                                                                                  liaisons/images/auteur.svg 2x">
                                            <img class="liste__auteur--img" src="liaisons/images/auteur.svg" alt="Image de l'artiste">
                                        </picture>
                                    @endif
                                    <p class="liste__auteur--item">{{$artiste->getNomPrenom()}}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination__auteurs">
                    @include('fragments.pagination')
                </div>
            </div>
        </div>
@endsection
