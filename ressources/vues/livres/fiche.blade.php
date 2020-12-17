@extends('gabarit')
@section('contenu')
    <div id="fenetre" class="visuallyhidden">
        <div id="fenetre" class="fenetre">
            <div class="fenetre__image">
                <picture>
                    <source media="(min-width:600px)" srcset="liaisons/images/Panier/{{$fiche->isbn_papier}}_w150.png 1x,
                                                                                  liaisons/images/Panier/{{$fiche->isbn_papier}}_w300@2x.png 2x">

                    <source media="(max-width:599px)" srcset="liaisons/images/Panier/{{$fiche->isbn_papier}}_w150.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$fiche->isbn_papier}}_w286.png 2x">
                    <img class="" src="liaisons/images/Panier/{{$fiche->isbn_papier}}_w300@2x.png" alt="Image du livre">
                </picture>
            </div>
            <div class="fenetre__ajout">
                <div class="fenetre__titre">
                    <p class="fenetre__titre__titre"><b>{{ $fiche->titre }}</b> a été ajouté au panier!</p>
                    <i class="far fa-check-circle"></i>
                </div>
                <p class="espace"><b>{{ $fiche->prix_can }} $</b></p>
                <div class="espace">
                    <label for="quantite">Quantité:</label>
                    <select name="quantite" id="quantite" class="quantite">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select><br>
                </div>
                <button id="{{$fiche->id}}" class="boutonsPanier espace">Confirmer</button>
            </div>
        </div>
            <div class="fenetre__bas">
                <a class="boutonAction__lien" id="btnClose" href="#">Fermer la fenetre</a>
                <a class="btnAllezPanier" href="index.php?controleur=panier&action=index">Allez au panier</a>
            </div>
    </div>
    <div class="ficheLivre">
        <div class="ficheLivre__lienRetour">
            <a href="index.php?controleur=livre&action={{$_SESSION['trier']}}">< Retourner à la liste de livres</a>
        </div>
        <div class="ficheLivre__informations">
            <picture>
                <source media="(min-width:600px)" srcset="liaisons/images/FicheLivre/{{$fiche->isbn_papier}}_w964@2x.png 1x,
                                                                                  liaisons/images/FicheLivre/{{$fiche->isbn_papier}}_w964@2x.png 2x">

                <source media="(max-width:599px)" srcset="liaisons/images/FicheLivre/{{$fiche->isbn_papier}}_w964@2x.png 1x,
                                                                                  liaisons/images/FicheLivre/{{$fiche->isbn_papier}}_w574@2x.png 2x">
                <img class="ficheLivre__informationsImages1" src="liaisons/images/FicheLivre/{{$fiche->isbn_papier}}_w964@2x.png" alt="Image du livre">
            </picture>
            @if(file_exists('liaisons/images/petiteImages/' . $fiche->isbn_papier . '_001_w150.png'))
            <div class="ficheLivre__petitesImagesMobile">
                <img src="liaisons/images/petiteImages/{{$fiche->isbn_papier}}_001_w150.png" alt="Image du livre">
                <img src="liaisons/images/petiteImages/{{$fiche->isbn_papier}}_002_w150.png" alt="Image du livre">
                <img src="liaisons/images/petiteImages/{{$fiche->isbn_papier}}_003_w150.png" alt="Image du livre">
            </div>
            @endif
            <div class="ficheLivre__informationsTextes">
                <h2 class="ficheLivre__informationsTitre">{{ $fiche->titre }}</h2>
                @foreach($fiche->getAuteurs() as $artistes)
                <p class="ficheLivre__informationsTextes__infos">Artiste : <span class="ficheLivre__informationsTextes__infos__texte"><a href='index.php?controleur=auteur&action=fiche&idAuteur={{$artistes->id}}'>{{$artistes->getNomPrenom()}}</a></span></p>
                @endforeach
                @if($fiche->le_livre == null)
                    <p class="ficheLivre__informationsTextes__infos">Description : <span class="ficheLivre__informationsTextes__infos__texte">Aucune</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">Description : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->le_livre}}</span></p>
                @endif
                <p class="ficheLivre__informationsTextes__infos">Âge minimum : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->age_min }} ans</span></p>
                <p class="ficheLivre__informationsTextes__infos">Prix canadien : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->prix_can }}$</span></p>
                <p class="ficheLivre__informationsTextes__infos">Prix euro : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->prix_euro }}€</span></p>
                <p class="ficheLivre__informationsTextes__infos">Date de parution au Québec : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->date_parution_quebec }}</span></p>
                <p class="ficheLivre__informationsTextes__infos">Date de parution en France : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->date_parution_france }}</span></p>
                @if($fiche->arguments_commerciaux == null)
                    <p class="ficheLivre__informationsTextes__infos">Arguments commerciaux :  <span class="ficheLivre__informationsTextes__infos__texte">Aucuns</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">Arguments commerciaux : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->arguments_commerciaux }}</span></p>
                @endif
                @if($fiche->statut == 1)
                    <p class="ficheLivre__informationsTextes__infos">Statut : <span class="ficheLivre__informationsTextes__infos__texte">Régulier</span></p>
                @else
                    @if($fiche->statut == 2)
                    <p class="ficheLivre__informationsTextes__infos">Statut : <span class="ficheLivre__informationsTextes__infos__texte">Nouveautés</span></p>
                    @else
                        @if($fiche->statut == 3)
                            <p class="ficheLivre__informationsTextes__infos">Statut : <span class="ficheLivre__informationsTextes__infos__texte">À paraître prochainement</span></p>
                @endif
                @endif
                @endif
                @if($fiche->format == null)
                    <p class="ficheLivre__informationsTextes__infos">Format : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">Format : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->format }}</span></p>
                @endif
                <p class="ficheLivre__informationsTextes__infos">Tirage : <span class="ficheLivre__informationsTextes__infos__texte">{{ $fiche->tirage }}</span></p>
                @if($fiche->isbn_papier == null)
                    <p class="ficheLivre__informationsTextes__infos">ISBN papier : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">ISBN papier : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->isbn_papier}}</span></p>
                @endif
                @if($fiche->isbn_pdf == null)
                    <p class="ficheLivre__informationsTextes__infos">ISBN Pdf : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">ISBN Pdf : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->isbn_pdf}}</span></p>
                @endif
                @if($fiche->isbn_epub == null)
                    <p class="ficheLivre__informationsTextes__infos">ISBN Epub : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">ISBN Epub : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->isbn_epub}}</span></p>
                @endif
                @if($fiche->url_audio == null)
                    <p class="ficheLivre__informationsTextes__infos">URL audio : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">URL audio : <span class="ficheLivre__informationsTextes__infos__texte"><a href="{{$fiche->url_audio}}"{{$fiche->url_audio}}></a></span></p>
                @endif
                <p class="ficheLivre__informationsTextes__infos">Catégorie : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->getCategories()->nom}}</span></p>
                @if($fiche->type_impression_id == null)
                    <p class="ficheLivre__informationsTextes__infos">Type d'impression : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">Type d'impression : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->getImpressions()->nom}}</span></p>
                @endif
                @if($fiche->type_couverture_id == null)
                    <p class="ficheLivre__informationsTextes__infos">Type de couverture : <span class="ficheLivre__informationsTextes__infos__texte">Aucun</span></p>
                @else
                    <p class="ficheLivre__informationsTextes__infos">Type de couverture : <span class="ficheLivre__informationsTextes__infos__texte">{{$fiche->getCouvertures()->nom}}</span></p>
                @endif
                <div class="ficheLivre__informationsTextes__bouton">
                    <button id="{{$fiche->id}}" class="boutons boutons--btnGeneral">Ajouter au panier</button>
                </div>
            </div>
            @if(file_exists('liaisons/images/petiteImages/' . $fiche->isbn_papier . '_001_w150.png'))
            <div class="ficheLivre__petitesImagesDesktop">
                <img src="liaisons/images/petiteImages/{{$fiche->isbn_papier}}_001_w150.png" alt="Image du livre">
                <img src="liaisons/images/petiteImages/{{$fiche->isbn_papier}}_002_w150.png" alt="Image du livre">
                <img src="liaisons/images/petiteImages/{{$fiche->isbn_papier}}_003_w150.png" alt="Image du livre">
            </div>
            @endif
        </div>
            <div class="ficheLivre__auteur">
                <h2 class="ficheLivre__auteur__titre">Artiste(s)</h2>
                <div class="ficheLivre__auteur__liste">
                    @foreach($fiche->getAuteurs() as $artistes)
                        <div class="ficheLivre__auteur__liste__fiche">
                            <a href='index.php?controleur=auteur&action=fiche&idAuteur={{$artistes->id}}'>
                                @if(file_exists('liaisons/images/ListeAuteurs/' . $artistes->nom . '_w235.png'))
                                <picture>
                                    <source media="(min-width:600px)" srcset="liaisons/images/ListeAuteurs/{{$artistes->nom}}_w235.png 1x,
                                                                                  liaisons/images/ListeAuteurs/{{$artistes->nom}}_w470@2x.png 2x">

                                    <source media="(max-width:599px)" srcset="liaisons/images/ListeAuteurs/{{$artistes->nom}}_w286.png 1x,
                                                                                  liaisons/images/ListeAuteurs/{{$artistes->nom}}_w574@2x.png 2x">
                                    <img class="ficheLivre__auteur__liste__fiche__img" src="liaisons/images/ListeAuteurs/{{$artistes->nom}}_w574@2x.png" alt="Image de l'artiste">
                                </picture>
                                @else
                                    <picture>
                                        <source media="(min-width:600px)" srcset="liaisons/images/auteur.svg 1x,
                                                                                  liaisons/images/auteur.svg 2x">

                                        <source media="(max-width:599px)" srcset="liaisons/images/auteur.svg 1x,
                                                                                  liaisons/images/auteur.svg 2x">
                                        <img class="ficheLivre__auteur__liste__fiche__img" src="liaisons/images/auteur.svg" alt="Image de l'artiste">
                                    </picture>
                                @endif
                                <div class="ficheLivre__auteur__liste__fiche__titre">
                                    <p class="ficheLivre__auteur__liste__fiche__titre__nom">{{$artistes->getNomPrenom()}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="ficheLivre__memeAuteur">
                <h2 class="ficheLivre__memeAuteurTitre">Livres du même artiste</h2>

                <div class="ficheLivre__memeAuteur__liste">
                    @foreach($livres as $livre)
                        <div class="container ficheLivre__memeAuteur__listeLivre">
                            <a href="index.php?controleur=livre&action=fiche&idLivre={{$livre->id}}&idAuteur={{$artistes->id}}">
                                <div class="overlay">
                                    <h3 class="text ficheLivre__memeAuteur__listeLivre__titre titreLivresFiche">{{$livre->titre}}</h3>
                                    <p class="texteCategorieFicheLivre ficheLivre__memeAuteur__listeLivre__categorie">[ {{$livre->getCategories()->nom}} ]</p>
                                </div>
                                <picture>
                                    <source media="(min-width:600px)" srcset="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 2x">

                                    <source media="(max-width:599px)" srcset="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 1x,
                                                                                  liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png 2x">

                                    <img class="ficheLivre__memeAuteur__listeLivre__img" src="liaisons/images/ListeLivres/{{$livre->isbn_papier}}_w574@2x.png" alt="Image du livre">
                                </picture>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        <div class="ficheLivre__reconnaissance">
            <h2 class="ficheLivre__reconnaissance__titre">Prix et nominations</h2>
            <div class="ficheLivre__reconnaissance__prix">
                @if($reconnaissances == null)
                    <p class="ficheLivre__reconnaissance__prix__nom">Aucune nominations</p>
                @else
                    <p class="ficheLivre__reconnaissance__prix__nom">{{$reconnaissances[0]->la_reconnaissance}}</p>
                @endif
            </div>
        </div>
        <div class="ficheLivre__boutonsActions">
            @if($fiche->id == 1)
                <button disabled class="boutons boutons--btnGeneral" name="btPrecedent"><span class="icones icone--precedent"></span>Livre précédent</button>
            @else
                <button class="boutons boutons--btnGeneral" name="btPrecedent" onclick="window.location.href='index.php?controleur=livre&action=fiche&idLivre={{$fiche->id - 1}}&idAuteur={{$artistes->id}}';"><span class="icones icone--precedent"></span>Livre précédent</button>
            @endif
            @if($fiche-> id == 146)
                <button disabled class="boutons boutons--btnGeneral" name="btSuivant"><span class="icones icone--suivant"></span>Livre suivant</button>
            @else
                <button class="boutons boutons--btnGeneral" name="btSuivant" onclick="window.location.href='index.php?controleur=livre&action=fiche&idLivre={{$fiche->id + 1}}&idAuteur={{$artistes->id}}';"><span class="icones icone--suivant"></span>Livre suivant</button>
            @endif
        </div>
    </div>
@endsection
