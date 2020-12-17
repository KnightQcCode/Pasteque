define(["require", "exports", "./MenuMobile", "./MotDePasse", "./AfficherPlus", "./AfficherPlusParaitre", "./AjoutFenetre", "./recherche", "./ItemPanier", "./ModeLivraison", "./TypePaiement", "./ValidationLivraison", "./ValidationFacturation"], function (require, exports, MenuMobile_1, MotDePasse_1, AfficherPlus_1, AfficherPlusParaitre_1, AjoutFenetre_1, recherche_1, ItemPanier_1, ModeLivraison_1, TypePaiement_1, ValidationLivraison_1, ValidationFacturation_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var app = {
        initialiserApp: function () {
            {
                // this.document.body.classList.add("js");
                if (window.location.href.indexOf('controleur=panier&action=index') != -1) {
                    this.ModeLivraison = new ModeLivraison_1.ModeLivraison();
                    this.Recherche = new recherche_1.Recherche();
                    this.MenuMobile = new MenuMobile_1.MenuMobile();
                }
                if (window.location.href.indexOf('controleur=panier&action=livraison') != -1) {
                    this.ValidationLivraison = new ValidationLivraison_1.ValidationLivraison();
                }
                if (window.location.href.indexOf('controleur=panier&action=facturation') != -1) {
                    this.TypePaiement = new TypePaiement_1.TypePaiement();
                    this.ValidationFacturation = new ValidationFacturation_1.ValidationFacturation();
                }
                if (window.location.href.indexOf('controleur=site&action=connexionCompte') != -1 || window.location.href.indexOf('controleur=site&action=creerCompte') != -1) {
                    this.MotDePasse = new MotDePasse_1.MotDePasse();
                    this.Recherche = new recherche_1.Recherche();
                    this.MenuMobile = new MenuMobile_1.MenuMobile();
                }
                if (window.location.href.indexOf('controleur=site&action=accueil') != -1) {
                    this.AfficherPlus = new AfficherPlus_1.AfficherPlus();
                    this.AfficherPlusParaitre = new AfficherPlusParaitre_1.AfficherPlusParaitre();
                    this.Recherche = new recherche_1.Recherche();
                    this.MenuMobile = new MenuMobile_1.MenuMobile();
                }
                if (window.location.href.indexOf('controleur=livre&action=fiche') != -1) {
                    console.log('allo');
                    this.AjoutFenetre = new AjoutFenetre_1.AjoutFenetre();
                    this.ItemPanier = new ItemPanier_1.ItemPanier();
                    this.Recherche = new recherche_1.Recherche();
                    this.MenuMobile = new MenuMobile_1.MenuMobile();
                }
                if (window.location.href.indexOf('controleur=auteur&action=index') != -1 || window.location.href.indexOf('controleur=auteur&action=fiche') != -1 || window.location.href.indexOf('controleur=livre&action=index') != -1 || window.location.href.indexOf('controleur=site&action=index') != -1) {
                    this.MenuMobile = new MenuMobile_1.MenuMobile();
                    this.Recherche = new recherche_1.Recherche();
                }
            }
        }
    };
    app.initialiserApp();
});
//# sourceMappingURL=app.js.map