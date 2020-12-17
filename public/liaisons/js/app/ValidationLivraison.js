define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.ValidationLivraison = void 0;
    var ValidationLivraison = /** @class */ (function () {
        // -- Éléments de formulaire à valider
        // Constructeur
        function ValidationLivraison() {
            // ATTRIBUTS
            this.refNom = document.querySelector('#nom');
            this.refCourriel = document.querySelector('#courriel');
            this.refMotDePasse = document.querySelector('#mot_de_passe');
            this.refAdresse = document.querySelector('#adresse_livraison');
            this.refVille = document.querySelector('#ville_livraison');
            this.refProvince = document.querySelector('#province_livraison');
            this.refPays = document.querySelector('#pays_livraison');
            this.refCodePostal = document.querySelector('#codePostal_livraison');
            this.initialiser();
        }
        // Méthodes de validation
        ValidationLivraison.prototype.initialiser = function () {
            //créer les écouteurs d'événement
            document.querySelector('form').noValidate = true;
            this.refNom.addEventListener('blur', this.validerNom.bind(this));
            this.refCourriel.addEventListener('blur', this.validerCourriel.bind(this));
            this.refMotDePasse.addEventListener('blur', this.validerMotDePasse.bind(this));
            this.refAdresse.addEventListener('blur', this.validerAdresse.bind(this));
            this.refVille.addEventListener('blur', this.validerVille.bind(this));
            this.refProvince.addEventListener('blur', this.validerProvince.bind(this));
            this.refPays.addEventListener('blur', this.validerPays.bind(this));
            this.refCodePostal.addEventListener('blur', this.validerCodePostal.bind(this));
        };
        ValidationLivraison.prototype.validerPattern = function (element, motif) {
            if (motif === void 0) { motif = element.pattern; }
            var regexp = new RegExp(motif);
            return regexp.test(element.value);
        };
        ValidationLivraison.prototype.validerNom = function (evenement) {
            var elementNom = evenement.currentTarget;
            if (elementNom.value == "") {
                elementNom
                    .closest('.livraison__form')
                    .querySelector('.erreurNomLivraison')
                    .innerHTML = "Vous devez entrer votre nom complet.";
            }
            else {
                var patern = '^[a-zA-ZÀ-ÿ \'-]+$';
                if (this.validerPattern(elementNom, patern) == false) {
                    elementNom
                        .closest('.livraison__form')
                        .querySelector('.erreurNomLivraison')
                        .innerHTML = "Assurez-vous d'entrer un nom complet valide.";
                }
                else {
                    elementNom
                        .closest('.livraison__form')
                        .querySelector('.erreurNomLivraison')
                        .innerHTML = "";
                }
            }
            return elementNom.value;
        };
        ValidationLivraison.prototype.validerCourriel = function (evenement) {
            var elementCourriel = evenement.currentTarget;
            if (elementCourriel.value == "") {
                elementCourriel
                    .closest('.livraison__form')
                    .querySelector('.erreurCourrielLivraison')
                    .innerHTML = "Vous devez entrer votre adresse courriel.";
            }
            else {
                var patern = '^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$';
                if (this.validerPattern(elementCourriel, patern) == false) {
                    elementCourriel
                        .closest('.livraison__form')
                        .querySelector('.erreurCourrielLivraison')
                        .innerHTML = "Assurez-vous d'entrer une adresse courriel valide.";
                }
                else {
                    elementCourriel
                        .closest('.livraison__form')
                        .querySelector('.erreurCourrielLivraison')
                        .innerHTML = "";
                }
            }
            return elementCourriel.value;
        };
        ValidationLivraison.prototype.validerMotDePasse = function (evenement) {
            var elementMotDePasse = evenement.currentTarget;
            if (elementMotDePasse.value == "") {
                elementMotDePasse
                    .closest('.livraison__form')
                    .querySelector('.erreurMDPLivraison')
                    .innerHTML = "Vous devez entrer votre mot de passe.";
            }
            else {
                var patern = '^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$';
                if (this.validerPattern(elementMotDePasse, patern) == false) {
                    elementMotDePasse
                        .closest('.livraison__form')
                        .querySelector('.erreurMDPLivraison')
                        .innerHTML = "Vous devez entrer un mot de passe valide.";
                }
                else {
                    elementMotDePasse
                        .closest('.livraison__form')
                        .querySelector('.erreurMDPLivraison')
                        .innerHTML = "";
                }
            }
            return elementMotDePasse.value;
        };
        ValidationLivraison.prototype.validerAdresse = function (evenement) {
            var elementAdresse = evenement.currentTarget;
            if (elementAdresse.value == "") {
                elementAdresse
                    .closest('.livraison__form')
                    .querySelector('.erreurAdresseLivraison')
                    .innerHTML = "Vous devez entrer votre adresse.";
            }
            else {
                var patern = '^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$';
                if (this.validerPattern(elementAdresse, patern) == false) {
                    elementAdresse
                        .closest('.livraison__form')
                        .querySelector('.erreurAdresseLivraison')
                        .innerHTML = "Vous devez entrer une adresse valide.";
                }
                else {
                    elementAdresse
                        .closest('.livraison__form')
                        .querySelector('.erreurAdresseLivraison')
                        .innerHTML = "";
                }
            }
            return elementAdresse.value;
        };
        ValidationLivraison.prototype.validerVille = function (evenement) {
            var elementVille = evenement.currentTarget;
            if (elementVille.value == "") {
                elementVille
                    .closest('.livraison__form')
                    .querySelector('.erreurVilleLivraison')
                    .innerHTML = "Vous devez entrer le nom de votre ville ou de votre village.";
            }
            else {
                var patern = '^[A-ÿ]+(?:[\\s-][A-zÀ-ÿ\'-]+)*$';
                if (this.validerPattern(elementVille, patern) == false) {
                    elementVille
                        .closest('.livraison__form')
                        .querySelector('.erreurVilleLivraison')
                        .innerHTML = "Vous devez entrer une ville ou un village valide.";
                }
                else {
                    elementVille
                        .closest('.livraison__form')
                        .querySelector('.erreurVilleLivraison')
                        .innerHTML = "";
                }
            }
            return elementVille.value;
        };
        ValidationLivraison.prototype.validerProvince = function (evenement) {
            var elementProvince = evenement.currentTarget;
            if (elementProvince.value == "") {
                elementProvince
                    .closest('.livraison__form')
                    .querySelector('.erreurProvinceLivraison')
                    .innerHTML = "Vous devez choisir votre province.";
            }
            else {
                elementProvince
                    .closest('.livraison__form')
                    .querySelector('.erreurProvinceLivraison')
                    .innerHTML = "";
            }
            return elementProvince.value;
        };
        ValidationLivraison.prototype.validerPays = function (evenement) {
            var elementPays = evenement.currentTarget;
            if (elementPays.value == "") {
                elementPays
                    .closest('.livraison__form')
                    .querySelector('.erreurPaysLivraison')
                    .innerHTML = "Vous devez choisir votre pays.";
            }
            else {
                elementPays
                    .closest('.livraison__form')
                    .querySelector('.erreurPaysLivraison')
                    .innerHTML = "";
            }
            return elementPays.value;
        };
        ValidationLivraison.prototype.validerCodePostal = function (evenement) {
            var elementCodePostal = evenement.currentTarget;
            if (elementCodePostal.value == "") {
                elementCodePostal
                    .closest('.livraison__form')
                    .querySelector('.erreurCodePostalLivraison')
                    .innerHTML = "Vous devez entrer votre code postal.";
            }
            else {
                var patern = '^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$';
                if (this.validerPattern(elementCodePostal, patern) == false) {
                    elementCodePostal
                        .closest('.livraison__form')
                        .querySelector('.erreurCodePostalLivraison')
                        .innerHTML = "Le code postal doit respecter le format X1X 1X1.";
                }
                else {
                    elementCodePostal
                        .closest('.livraison__form')
                        .querySelector('.erreurCodePostalLivraison')
                        .innerHTML = "";
                }
            }
            return elementCodePostal.value;
        };
        return ValidationLivraison;
    }());
    exports.ValidationLivraison = ValidationLivraison;
});
//# sourceMappingURL=ValidationLivraison.js.map