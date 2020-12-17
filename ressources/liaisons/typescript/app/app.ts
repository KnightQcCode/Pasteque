import {MenuMobile} from './MenuMobile';
import {MotDePasse} from './MotDePasse';
import {AfficherPlus} from './AfficherPlus';
import {AfficherPlusParaitre} from './AfficherPlusParaitre';
import {AjoutFenetre} from './AjoutFenetre';
import {Recherche} from "./recherche";
import {ItemPanier} from './ItemPanier';
import {ModeLivraison} from './ModeLivraison';
import {TypePaiement} from './TypePaiement';
import {ValidationLivraison} from './ValidationLivraison';
import {ValidationFacturation} from './ValidationFacturation';

var app = {
    initialiserApp: function ():void {
        {
            // this.document.body.classList.add("js");
            if (window.location.href.indexOf('controleur=panier&action=index') != -1) {
                this.ModeLivraison = new ModeLivraison();
                this.Recherche = new Recherche();
                this.MenuMobile = new MenuMobile();
            }
            if (window.location.href.indexOf('controleur=panier&action=livraison') != -1) {
                this.ValidationLivraison = new ValidationLivraison();
            }
            if (window.location.href.indexOf('controleur=panier&action=facturation') != -1) {
                this.TypePaiement = new TypePaiement();
                this.ValidationFacturation = new ValidationFacturation();
            }
            if (window.location.href.indexOf('controleur=site&action=connexionCompte') != -1  || window.location.href.indexOf('controleur=site&action=creerCompte') != -1) {
                this.MotDePasse = new MotDePasse();
                this.Recherche = new Recherche();
                this.MenuMobile = new MenuMobile();
            }
            if (window.location.href.indexOf('controleur=site&action=accueil') != -1) {
                this.AfficherPlus = new AfficherPlus();
                this.AfficherPlusParaitre = new AfficherPlusParaitre();
                this.Recherche = new Recherche();
                this.MenuMobile = new MenuMobile();
            }
            if (window.location.href.indexOf('controleur=livre&action=fiche') != -1) {
                console.log('allo')
                this.AjoutFenetre = new AjoutFenetre();
                this.ItemPanier = new ItemPanier();
                this.Recherche = new Recherche();
                this.MenuMobile = new MenuMobile();
            }
            if (window.location.href.indexOf('controleur=auteur&action=index') != -1 || window.location.href.indexOf('controleur=auteur&action=fiche') != -1 || window.location.href.indexOf('controleur=livre&action=index') != -1 || window.location.href.indexOf('controleur=site&action=index') != -1) {
                this.MenuMobile = new MenuMobile();
                this.Recherche = new Recherche();
            }
        }
    }
};

app.initialiserApp();

